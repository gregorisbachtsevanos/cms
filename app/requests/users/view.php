<?php
if(!defined('estatedrive')) {
   die('Direct access not permitted');
}
if(isset($_POST['save_tab1']) && $privs->edit_users == 1){
	$sql = 'SELECT id FROM users WHERE username = ? AND id != ?';
	$row = $db->row($sql, array($_POST['username'], $contact->id));
	if(isset($row->id)){
		$error = lang('username_exists');
	}
	elseif(!ctype_digit(str_replace(' ', '', $_POST['mobile'])) || strlen(str_replace(' ', '', $_POST['mobile'])) != 10) {
		$error = lang('wrong_mobile');
	}
	else {
		$data = array(
			'name'=>$_POST['name'],
			'surname'=>$_POST['surname'],
			'mobile'=>str_replace(' ', '', $_POST['mobile']),
			'email'=>str_replace(' ', '', $_POST['email']),
			'username'=>str_replace(' ', '', $_POST['username']),
			'status'=>str_replace(' ', '', $_POST['status']),
			'usergroup'=>str_replace(' ', '', $_POST['usergroup'])
		);
		if($db->update('users', $data, array('id'=>$contact->id))){
			$success = lang('info_updated');
			foreach($data as $key=>$val)
				$contact->$key = $val;
		}
	}
}
if(isset($_POST['save_tab2']) && $privs->edit_users == 1){
	if($_POST['pass1'] == $_POST['pass2']){
		$newpass = password_hash($_POST['pass1'], PASSWORD_DEFAULT);
		$newKey = Google2FA::generate_secret_key().Google2FA::generate_secret_key();
		if($db->update('users', array('auth_hash'=>$newKey, 'password'=>$newpass), array('id'=>$contact->id))){
			$_SESSION['auth_hash'] = $newKey;
			$success = lang('password_changed');
		}
	}
	else {
		$error = lang('passwords_do_not_match');
	}
}
if(isset($_POST['show-table'])){
	$sLimit = " LIMIT 0,10";
	if ( isset( $_REQUEST['start'] ) && $_REQUEST['length'] != '-1' ) {
		$sLimit = " LIMIT ".intval( $_REQUEST['start'] ).", ".intval( $_REQUEST['length'] );
	}
	if(isset($_REQUEST['order'])){
		$columns = array('date', 'controller', 'type', '', '');
		$order = ' ORDER BY '.$columns[$_REQUEST['order'][0]['column']].' '.$_REQUEST['order'][0]['dir'];
	}
	else
		$order = ' ORDER BY id DESC';
	if(isset($_REQUEST['search']))
		$_REQUEST['q'] = $_REQUEST['search']['value'];

	$sql1 = "SELECT * FROM `actions_log` WHERE user = ?";
	$params1 = array($contact->id);
	if(isset($_REQUEST['q'])) {
		$sql1 .= " AND (old_value LIKE ? OR new_value LIKE ?)";
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

	$data = array(
		'draw'=>$_REQUEST['draw'],
		'recordsTotal'=>$total,
		'recordsFiltered'=>$total,
		'iTotalRecords'=>$total,
		'iTotalDisplayRecords '=>$total2);
	$data['data'] = array();
	
	foreach($rows as $row){
			$datarow = array();
			$a_link = '<a>';
			if($row->controller == 'contacts'){
				$a_link = '<a href="'.$appURL.'contacts/view/'.$row->target_id.'" target="_blank">';
			}
			elseif($row->controller == 'calendar'){
				$a_link = '<a href="'.$appURL.'contacts/calendar?show='.$row->target_id.'" target="_blank">';
			}
			array_push($datarow, $a_link.date('d/m/Y H:i', strtotime($row->date)).'</a>');
			array_push($datarow, lang('controller_'.$row->controller));
			array_push($datarow, lang('action_'.$row->action));
			array_push($datarow, $row->old_value);
			array_push($datarow, $row->new_value);
		   array_push($data['data'], $datarow);
	}
	echo json_encode($data);
	exit();
}