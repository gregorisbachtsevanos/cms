<?php
if(!defined('estatedrive')) {
   die('Direct access not permitted');
}
if(isset($_POST['load_note_data'])){
	$sql = 'SELECT id, date, info FROM properties_notes WHERE id = ?';
	$row = $db->row($sql, array($_POST['load_note_data']));
	$row->date = date('d/m/Y', strtotime($row->date));
	echo json_encode($row);
	exit();
}
elseif(isset($_POST['edit_note']) && $privs->edit_notes == 1){
	$vals = explode('/', $_POST['date']);
	if(Count($vals) == 3){
		$dtime = DateTime::createFromFormat("d/m/Y", $_POST['date']);
		$timestamp = $dtime->getTimestamp();
		$data = array(
			'date'=>date('Y-m-d', $timestamp),
			'info'=>$_POST['info']
		);
		if($db->update('properties_notes', $data, array('id'=>$_POST['id']))){
			$success = 'Η σημείωση αποθηκεύτηκε';
			$sql = 'SELECT * FROM properties_notes WHERE property = ? ORDER BY date DESC';
			$params = array($property->id);
			$notes = $db->fetch($sql, $params);
		}
	}
	
}
elseif(isset($_POST['add_note']) && $privs->add_notes == 1){
	$vals = explode('/', $_POST['date']);
	if(Count($vals) == 3){
		$dtime = DateTime::createFromFormat("d/m/Y", $_POST['date']);
		$timestamp = $dtime->getTimestamp();
		$data = array(
			'date'=>date('Y-m-d', $timestamp),
			'info'=>$_POST['info'],
			'user'=>$user->id,
			'property'=>$property->id
		);
		if($db->insert('properties_notes', $data)){
			$success = 'Η σημείωση προστέθηκε';
			$sql = 'SELECT * FROM properties_notes WHERE property = ? ORDER BY date DESC';
			$params = array($property->id);
			$notes = $db->fetch($sql, $params);
		}
	}
}
elseif(isset($_POST['edit']) && $privs->edit_contacts == 1){
	$data = array();
	foreach($_POST as $key=>$val){
		if($key != 'fileuploader-list-files' && $key != 'edit' && $key != 'files')
			$data[$key] = $val;
	}
	if($db->update('properties', $data, array('id'=>$property->id))){
		$success = 'Τα στοιχεία αποθηκεύτηκαν';
		foreach($data as $key=>$val)
			$property->$key = $val;
	}
}
elseif(isset($_POST['add_photos']) && isset($_FILES['files'])){
	$photos = array();
	include($appLibraries.'fileuploader.php');
	$FileUploader = new FileUploader('files', array(
		'uploadDir' => $appUploads,
		'extensions' => array('image/*'),
		'replace' => false
	));
	$upload = $FileUploader->upload();
	$errors = 0;
	$success_files = 0;
	if(isset($upload['warnings']) && Count($upload['warnings']) > 0){
		foreach($upload['files'] as $file){
			
			unlink($appUploads.$file['name']);
		}
		$response = array(
			'type'=>'error',
			'message'=>$upload['warnings'][0],
			'title'=>'Σφάλμα'
		);
		echo json_encode($response);
		exit();
	}
	if(count($upload['files']) > 0) {
		$sql = 'SELECT ordernum FROM images WHERE property = ? ORDER BY ordernum DESC LIMIT 0,1';
		$params = array($property->id);
		$row = $db->row($sql, $params);
		if(isset($row->ordernum))
			$order = $row->ordernum+1;
		else
			$order = 1;
		foreach($upload['files'] as $file){
			$db->insert('images', array('property'=>$property->id, 'image'=>$file['name'], 'ordernum'=>$order));
			$order++;
		}
		$success = 'Προστέθηκαν '.Count($upload['files']).' φωτογραφίες';
		$sql = 'SELECT * FROM images WHERE property = ? ORDER BY ordernum ASC';
		$params = array($property->id);
		$images = $db->fetch($sql, $params);
	}
	
}
elseif(isset($_GET['delete_note']) && $privs->delete_notes == 1){
	if($db->delete('properties_notes', array('id'=>$_GET['delete_note']))){
		$success = 'Η σημείωση αφαιρέθηκε';
		$sql = 'SELECT * FROM properties_notes WHERE property = ? ORDER BY date DESC';
		$params = array($property->id);
		$notes = $db->fetch($sql, $params);
		
	}
}