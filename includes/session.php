<?php
$sql = 'SELECT * FROM users WHERE id = ? AND auth_hash = ?';
$params = array(@$_SESSION['userId'], @$_SESSION['auth_hash']);
$user = $db->row($sql, $params);
if(!@$user->id) {
	session_destroy();
	if($controllerName != '' && $controllerName != 'dashboard'){
		$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$actual_link = strstr($actual_link, $controllerName);
		header("Location: ".$appURL."login?returnURL=".$actual_link);
	}
	else
		header("Location: ".$appURL."login");
	exit();
}
if($user->auth_hash != $_SESSION['auth_hash'] || $user->status == 0 || @$_SESSION['last_login'] == ''){
	session_destroy();
	header("Location: ".$appURL."login");
	exit();
}
$_SESSION['userId'] = $_SESSION['userId'];
$_SESSION['auth_hash'] = $_SESSION['auth_hash'];
$_SESSION['last_login'] = $_SESSION['last_login'];
$db->update('login_history', array('last_online'=>date('Y-m-d H:i:s', time())), array('id'=>$_SESSION['last_login']));
$lang = $user->lang;

$sql = 'SELECT privs.name, usergroups_access.value FROM privs LEFT JOIN usergroups_access ON privs.id = usergroups_access.privs WHERE  usergroups_access.usergroup = ?';
$params = array($user->usergroup);
$rows = $db->fetch($sql, $params);
$privs = new stdClass();
foreach($rows as $row){
	$key = $row->name;
    $privs->$key = $row->value;
}
unset($rows);
if(isset($_GET['setLang'])){
	$db->update('users', array('lang'=>$_GET['setLang']), array('id'=>$user->id));
	$lang = $_GET['setLang'];
	$user->lang = $lang;
}
REQUIRE_ONCE  dirname(__FILE__) . ('/template.php');