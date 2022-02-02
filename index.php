<?php
define('estatedrive', TRUE);
require_once('includes/functions.php');
require_once('includes/template.php');
require_once('includes/settings.php');
// $requestUrl = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$requestUrl = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$requestString = substr($requestUrl, strlen($appURL));
$urlParams = explode('/', $requestString);
$requestString = rtrim($requestString, '/');
$controllerName = filter_var(strtolower(array_shift($urlParams)), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$controllerName = strstr($controllerName, '?', true) ?: $controllerName;;
if($controllerName == ''){
	// die("Location: ".$appURL."dashboard.php");
	include('app/controllers/dashboard.php');
	exit();
}
if(substr($requestUrl , -1)=='/'){
    $requestUrl = rtrim($requestUrl, '/');
	header("Location: ".$requestUrl);
	exit();
}
$cParams = array();
while(Count($urlParams) > 0){
	$actionName = filter_var(strtolower(array_shift($urlParams)), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
	$actionName = strstr($actionName, '?', true) ?: $actionName;
	if($actionName != '')
		array_push($cParams, $actionName);
}
if($controllerName != 'login' && $controllerName != '404' && $controllerName != 'api')
	require_once('includes/session.php');
$lang_strings = array();
loadLang();
if(isset($cParams[0]) && file_exists($appControllers.$controllerName.'/'.$cParams[0].'.php')){
	$file = $cParams[0];
	unset($cParams[0]);
	$cParams = array_values($cParams);
	include($appControllers.$controllerName.'/'.$file.'.php');
}
elseif(file_exists($appControllers.$controllerName.'/index.php')){
	include($appControllers.$controllerName.'/index.php');
}
elseif(file_exists($appControllers.$controllerName.'.php')){
	include($appControllers.$controllerName.'.php');
}
else
	header("Location: ".$appURL."404");
?>