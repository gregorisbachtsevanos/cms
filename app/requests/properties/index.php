<?php
if(!defined('estatedrive')) {
   die('Direct access not permitted');
}
if(isset($_GET['load-names'])){
	if(!isset($_POST['searchTerm']) || $_POST['searchTerm'] == ''){
		$sql = 'SELECT id, title FROM properties ORDER BY id DESC LIMIT 0,10';
		$rows = $db->fetch($sql);
	}
	else{ 
		$search = $_POST['searchTerm'];   
		$sql = 'SELECT id, title FROM properties WHERE address LIKE ? OR title LIKE ? OR city LIKE ? ORDER BY id DESC LIMIT 0,10';
		$params = array('%'.$search.'%', '%'.$search.'%', '%'.$search.'%');
		$rows = $db->fetch($sql, $params);
	} 
	$data[] = array("id"=>0, "text"=>'Επιλογή');
	foreach($rows as $row)
	  $data[] = array("id"=>$row->id, "text"=>$row->title);
	echo json_encode($data);
	exit();
}
elseif(isset($_POST['show-table']) && $privs->view_contacts == 1){
	$sLimit = " LIMIT 0,10";
	if ( isset( $_REQUEST['start'] ) && $_REQUEST['length'] != '-1' ) {
		$sLimit = " LIMIT ".intval( $_REQUEST['start'] ).", ".intval( $_REQUEST['length'] );
	}
	if(isset($_REQUEST['order'])){
		$columns = array('title', 'type', 'floor', 'double_beds', 'contact', 'city', 'address');
		$order = ' ORDER BY '.$columns[$_REQUEST['order'][0]['column']].' '.$_REQUEST['order'][0]['dir'];
	}
	else
		$order = ' ORDER BY id DESC';
	if(isset($_REQUEST['search']))
		$_REQUEST['q'] = $_REQUEST['search']['value'];

	$sql1 = "SELECT * FROM `properties` WHERE id > ?";
	$params1 = array(0);
	if(isset($_REQUEST['q'])) {
		$sql1 .= " AND (title LIKE ? OR address LIKE ? OR city LIKE ?)";
		array_push($params1, '%'.$_REQUEST['q'].'%');
		array_push($params1, '%'.$_REQUEST['q'].'%');
		array_push($params1, '%'.$_REQUEST['q'].'%');
	}
	if(isset($_POST['contact']) && $_POST['contact'] > 0) {
		$sql1 .= ' AND contact = ?';
		array_push($params1, $_POST['contact']);
	}
	$sql1 .= $order;
	$rows = $db->fetch($sql1, $params1);
	$total = Count($rows);
	$sql1 .= $sLimit;
	//echo $sql1; exit();
	$rows = $db->fetch($sql1, $params1);
	$total2 = Count($rows);
	if(isset($_REQUEST['searchpage']))
		$blank = ' target="_blank"';
	else
		$blank = '';
	$data = array(
		'draw'=>$_REQUEST['draw'],
		'recordsTotal'=>$total,
		'recordsFiltered'=>$total,
		'iTotalRecords'=>$total,
		'iTotalDisplayRecords '=>$total2);
	$data['data'] = array();
	$types = array();
	foreach(fetchTable('property_types') as $row)
		$types[$row->id] = $row->name;
	$floors = array();
	foreach(fetchTable('property_floors') as $row)
		$floors[$row->id] = $row->name;
	foreach($rows as $row){
		$beds = array();
		if($row->double_beds > 0)
			array_push($beds, $row->double_beds.'(Δ)');
		if($row->single_beds > 0)
			array_push($beds, $row->single_beds.'(Μ)');
		if($row->sofa_beds > 0)
			array_push($beds, $row->single_beds.'(Ρ)');
		$owner = fetchRow('contacts', 'id, name, surname', 'id = ?', array($row->contact));
		$datarow = array();
		array_push($datarow, '<a href="properties/view/'.$row->id.'">'.$row->title.'</a>');
		array_push($datarow, $types[$row->type]);
		array_push($datarow, $floors[$row->floor]);
		array_push($datarow, implode(', ', $beds));
		array_push($datarow, '<a href="contacts/view/'.$owner->id.'">'.$owner->surname.' '.$owner->name.'</a>');
		array_push($datarow, $row->city);
		array_push($datarow, $row->address);
	   array_push($data['data'], $datarow);
	}
	echo json_encode($data);
	exit();
}
if(isset($_POST['add']) && $privs->add_contacts == 1){
	$data = array(
		'date_created'=>date('Y-m-d H:i:s', time())
	);
	foreach($_POST as $key=>$val){
		if($key != 'fileuploader-list-files' && $key != 'add' && $key != 'files')
			$data[$key] = $val;
	}
	//print_r($_FILES);
	//exit();
	if($newId = $db->insert('properties', $data)){
		$success = 'Το κατάλυμα προστέθηκε';
		if(isset($_FILES['files'])){
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
				$order = 1;
				foreach($upload['files'] as $file){
					$db->insert('images', array('property'=>$newId, 'image'=>$file['name'], 'ordernum'=>$order));
					$order++;
				}
			}
		}
	}
}
elseif(isset($_GET['delete']) && $privs->delete_contacts == 1){
	$sql = 'SELECT * FROM properties WHERE id = ?';
	$params = array($_GET['delete']);
	$row = $db->row($sql, $params);
	if(isset($row->id)){
		$db->delete('images', array('property'=>$row->id));
		$db->delete('properties_notes', array('property'=>$row->id));
		if($db->delete('properties', array('id'=>$row->id))){
			$success = 'Το κατάλυμα αφαιρέθηκε';
		}
	}
}
