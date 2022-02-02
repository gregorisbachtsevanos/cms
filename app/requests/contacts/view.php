<?php
if(!defined('estatedrive')) {
   die('Direct access not permitted');
}
if(isset($_POST['load_note_data'])){
	$sql = 'SELECT id, date, info FROM contacts_notes WHERE id = ?';
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
		if($db->update('contacts_notes', $data, array('id'=>$_POST['id']))){
			$success = lang('contact_note_saved');
			$sql = 'SELECT * FROM contacts_notes WHERE contact = ? ORDER BY date DESC';
			$params = array($contact->id);
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
			'contact'=>$contact->id
		);
		if($db->insert('contacts_notes', $data)){
			$success = lang('contact_note_added');
			$sql = 'SELECT * FROM contacts_notes WHERE contact = ? ORDER BY date DESC';
			$params = array($contact->id);
			$notes = $db->fetch($sql, $params);
		}
	}
}
elseif(isset($_POST['edit']) && $privs->edit_contacts == 1){
	if($_POST['name'] == '' && $_POST['surname'] == ''){
		$error = lang('name_error');
	}
	else {
		$data = array(
			'name'=>$_POST['name'],
			'surname'=>$_POST['surname'],
			'info'=>$_POST['info'],
			'phone'=>$_POST['phone'],
			'mobile'=>$_POST['mobile'],
			'email'=>$_POST['email'],
			'address'=>$_POST['address'],
			'country'=>$_POST['country'],
			'iban'=>$_POST['iban'],
			'status'=>$_POST['status']
		);
		if($db->update('contacts', $data, array('id'=>$contact->id))){
			$success = lang('contact_saved');
			foreach($data as $key=>$val)
				$contact->$key = $val;
		}
	}
}
elseif(isset($_GET['delete_note']) && $privs->delete_notes == 1){
	if($db->delete('contacts_notes', array('id'=>$_GET['delete_note']))){
		$success = lang('contact_note_deleted');
		$sql = 'SELECT * FROM contacts_notes WHERE contact = ? ORDER BY date DESC';
		$params = array($contact->id);
		$notes = $db->fetch($sql, $params);
		
	}
}