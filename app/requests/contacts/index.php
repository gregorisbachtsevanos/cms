<?php
if(!defined('estatedrive')) {
   die('Direct access not permitted');
}
if(isset($_GET['load-names'])){
	if(!isset($_POST['searchTerm']) || $_POST['searchTerm'] == ''){
		$sql = 'SELECT id, name, surname FROM contacts ORDER BY id DESC LIMIT 0,10';
		$rows = $db->fetch($sql);
	}
	else{ 
		$search = $_POST['searchTerm'];   
		$sql = 'SELECT id, name, surname FROM contacts WHERE name LIKE ? OR surname LIKE ? OR phone LIKE ? or mobile LIKE ? OR email LIKE ? ORDER BY id DESC LIMIT 0,10';
		$params = array('%'.$search.'%', '%'.$search.'%', '%'.$search.'%', '%'.$search.'%', '%'.$search.'%');
		$rows = $db->fetch($sql, $params);
	} 
	$data[] = array("id"=>0, "text"=>'Επιλογή');
	foreach($rows as $row)
	  $data[] = array("id"=>$row->id, "text"=>$row->surname.' '.$row->name);
	echo json_encode($data);
	exit();
}
if(isset($_POST['show-table']) && $privs->view_contacts == 1){
	$sLimit = " LIMIT 0,10";
	if ( isset( $_REQUEST['start'] ) && $_REQUEST['length'] != '-1' ) {
		$sLimit = " LIMIT ".intval( $_REQUEST['start'] ).", ".intval( $_REQUEST['length'] );
	}
	if(isset($_REQUEST['order'])){
		$columns = array('full_name', 'contacts.phone', 'contacts.mobile', 'contacts.email', 'contacts.id');
		$order = ' ORDER BY '.$columns[$_REQUEST['order'][0]['column']].' '.$_REQUEST['order'][0]['dir'];
	}
	else
		$order = ' ORDER BY id DESC';
	if(isset($_REQUEST['search']))
		$_REQUEST['q'] = $_REQUEST['search']['value'];

	$sql1 = "SELECT contacts.id as id, contacts.name as name, contacts.date_created as date_created, contacts.email as email, contacts.surname as surname, contacts.mobile as mobile, CONCAT(contacts.surname, ' ', contacts.name) as 'full_name', contacts.status FROM `contacts` WHERE contacts.id > ?";
	$params1 = array(0);
	if(isset($_REQUEST['q'])) {
		$sql1 .= " AND (contacts.name LIKE ? OR contacts.surname LIKE ? OR contacts.mobile LIKE ? OR contacts.email LIKE ? OR CONCAT(contacts.surname, ' ', contacts.name) LIKE ?)";
		array_push($params1, '%'.$_REQUEST['q'].'%');
		array_push($params1, '%'.$_REQUEST['q'].'%');
		array_push($params1, '%'.$_REQUEST['q'].'%');
		array_push($params1, '%'.$_REQUEST['q'].'%');
		array_push($params1, '%'.$_REQUEST['q'].'%');
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

	foreach($rows as $row){
			$datarow = array();
			array_push($datarow, '<a href="contacts/view/'.$row->id.'">'.$row->id.'</a>');
			array_push($datarow, '<a href="contacts/view/'.$row->id.'">'.$row->name.'</a>');
			array_push($datarow, '<a href="contacts/view/'.$row->id.'">'.$row->surname.'</a>');
			array_push($datarow, lang('status_'.$row->status));
			array_push($datarow, $row->mobile);
			array_push($datarow, $row->email);
			array_push($datarow, date('d/m/Y H:i', strtotime($row->date_created)));
		   array_push($data['data'], $datarow);
	}
	echo json_encode($data);
	exit();
}
if(isset($_POST['add']) && $privs->add_contacts == 1){
	if($_POST['name'] == '' && $_POST['surname'] == ''){
		$error = lang('name_error');
	}
	else {
		$data = array(
			'user'=>$user->id,
			'date_created'=>date('Y-m-d H:i:s', time()),
			'name'=>$_POST['name'],
			'surname'=>$_POST['surname'],
			'info'=>$_POST['info'],
			'phone'=>$_POST['phone'],
			'mobile'=>$_POST['mobile'],
			'email'=>$_POST['email'],
			'country'=>$_POST['country'],
			'address'=>$_POST['address']
		);
		if($newId = $db->insert('contacts', $data)){
			$success = lang('contact_created');
			addLog('contacts', 'create', $newId, '', $data['surname'].' '.$data['name']);
		}
	}
}
elseif(isset($_GET['load-contacts-list'])){
	$sql = 'SELECT id, name, surname, mobile, phone FROM contacts WHERE id > ?';
	$params = array(0);
	if(isset($_POST['searchTerm']) && $_POST['searchTerm'] != ''){
		$search = $_POST['searchTerm'];
		$sql .= ' AND (surname LIKE ? OR phone LIKE ? OR mobile LIKE ? OR email LIKE ? OR CONCAT(surname, \' \', name) LIKE ?)';
		array_push($params, '%'.$search.'%');
		array_push($params, '%'.$search.'%');
		array_push($params, '%'.$search.'%');
		array_push($params, '%'.$search.'%');
		array_push($params, '%'.$search.'%');
	}
	$sql .= ' ORDER BY id DESC LIMIT 0,10';
	$rows = $db->fetch($sql, $params);
	$data[] = array(
		//"id"=>0, "text"=>'Επιλογή'
	);
	foreach($rows as $row)
	  $data[] = array("id"=>$row->id, "text"=>$row->surname.' '.$row->name);
	
	echo json_encode($data);
	exit();
}
elseif(isset($_GET['delete']) && $privs->delete_contacts == 1){
	$sql = 'SELECT id, name, surname FROM contacts WHERE id = ?';
	$params = array($_GET['delete']);
	$row = $db->row($sql, $params);
	if(isset($row->id)){
		$db->delete('contacts_notes', array('contact'=>$row->id));
		if($db->delete('contacts', array('id'=>$row->id, 'user'=>$user->id))){
			$success = lang('contact_deleted');
			addLog('contacts', 'delete', $row->id, $row->surname.' '.$row->name, '');
		}
	}
}
