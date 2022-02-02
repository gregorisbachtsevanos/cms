<?php
if(!defined('estatedrive')) {
   die('Direct access not permitted');
}
if(isset($_POST['show-table']) && $privs->view_users == 1){
	$sLimit = " LIMIT 0,10";
	if ( isset( $_REQUEST['start'] ) && $_REQUEST['length'] != '-1' ) {
		$sLimit = " LIMIT ".intval( $_REQUEST['start'] ).", ".intval( $_REQUEST['length'] );
	}
	if(isset($_REQUEST['order'])){
		$columns = array('users.id', 'users.name', 'users.surname', 'users.username', 'users.mobile', 'users.email', '');
		$order = ' ORDER BY '.$columns[$_REQUEST['order'][0]['column']].' '.$_REQUEST['order'][0]['dir'];
	}
	else
		$order = ' ORDER BY users.id ASC';
	if(isset($_REQUEST['search']))
		$_REQUEST['q'] = $_REQUEST['search']['value'];

	$sql1 = "SELECT users.id as id, users.name as name, users.surname as surname, users.username as username, users.mobile as mobile, users.email as email, users.status as status, users.usergroup as usergroup, usergroups.name as usergroup_name FROM `users` INNER JOIN usergroups ON users.usergroup = usergroups.id WHERE users.id > ?";
	$params1 = array(0);
	if(isset($_REQUEST['q'])) {
		$sql1 .= " AND (users.name LIKE ? OR users.surname LIKE ? OR users.email LIKE ? OR users.mobile LIKE ? OR usergroups.name LIKE ?)";
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
		$sql = 'SELECT last_online FROM login_history WHERE user = ? ORDER BY last_online DESC LIMIT 0,1';
		$params = array($row->id);
		$last_login = $db->row($sql, $params);
		if(isset($last_login->last_online) && $last_login->last_online != ''){
			$last_login = date('d/m/Y H:i', strtotime($last_login->last_online));
		}
		else{
			$last_login = '';
		}
		$datarow = array();
		array_push($datarow, '<a href="'.$controllerName.'/view/'.$row->id.'">'.$row->id.'</a>');
		array_push($datarow, '<a href="'.$controllerName.'/view/'.$row->id.'">'.$row->name.'</a>');
		array_push($datarow, '<a href="'.$controllerName.'/view/'.$row->id.'">'.$row->surname.'</a>');
		array_push($datarow, '<a href="'.$controllerName.'/view/'.$row->id.'">'.$row->username.'</a>');
		array_push($datarow, $row->mobile);
		array_push($datarow, $row->email);
		array_push($datarow, $row->usergroup_name);
		array_push($datarow, $last_login);
		
		if($row->status == 0){
			for($i = 0; $i < Count($datarow); $i++){
				$datarow[$i] = '<del>'.$datarow[$i].'</del>';
			}
		}
		array_push($data['data'], $datarow);
	}
	echo json_encode($data);
	exit();
}
if(isset($_POST['add']) && $privs->add_users == 1){
	$sql = 'SELECT id FROM users WHERE username = ?';
	$row = $db->row($sql, array(str_replace(' ', '', $_POST['username'])));
	if(isset($row->id)){
		$error = lang('username_exists');
	}
	elseif($_POST['password1'] != $_POST['password2']){
		$error = lang('passwords_do_not_match');
	}
	else {
		$newpass = password_hash($_POST['password1'], PASSWORD_DEFAULT);
		$newKey = Google2FA::generate_secret_key().Google2FA::generate_secret_key();
		$data = array(
			'name'=>trim($_POST['name']),
			'surname'=>trim($_POST['surname']),
			'mobile'=>str_replace(' ', '', $_POST['mobile']),
			'email'=>str_replace(' ', '', $_POST['email']),
			'lang'=>$defaultLang,
			'usergroup'=>$_POST['usergroup'],
			'date_created'=>date('Y-m-d H:i:s', time()),
			'username'=>str_replace(' ', '', $_POST['username']),
			'status'=>1,
			'password'=>$newpass,
			'auth_hash'=>$newKey
		);
		if($db->insert('users', $data)){
			$success = lang('user_created');
		}
		
	}
}
