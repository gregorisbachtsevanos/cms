<?php
if(!defined('estatedrive')) {
   die('Direct access not permitted');
}
function loadHeader($title, $styles1=array(), $styles2='', $sidebar = false){
	global $appDir;
	global $appViews;
	global $appName;
	global $appURL;
	global $companyName;
	global $companyLogo;
	global $lang;
	global $user;
	global $controllerName;
	global $privs;
	global $db;
	echo 
'<!DOCTYPE html>
<html lang="el">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="author" content="" />

	<link rel="icon" href="assets/images/favicon.ico">
	<base href="'.$appDir.'">
	<title>'.$title.'</title>

	<link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="assets/css/neon-core.css">

	
	<link rel="stylesheet" href="assets/css/custom.css">
	';
	foreach($styles1 as $style)
		echo '<link href="'.$style.'" rel="stylesheet" type="text/css">';
	echo '
    <link rel="stylesheet" type="text/css" href="laiki-assets/css/custom/custom.css">';
	if($styles2 != '')
		echo '<style>'.$styles2.'</style>';
	echo '
	
	<script src="assets/js/jquery-1.11.3.min.js"></script>

	<!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
	
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

  </head>
  <body class="page-body  page-fade" data-url="http://neon.dev">
	<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->';    
	include($appViews.'common/menu.php');
	include($appViews.'common/header.php');
	
}
function endBody(){
	global $appName;
	echo '
	<footer class="main">
			
			&copy; '.date('Y', time()).' <strong>'.$appName.'</strong>
		
		</footer></div>';
}
function loadScripts($scripts = array()){
	global $appViews;
	global $success;
	global $error;
	echo '
	<!-- Bottom scripts (common) -->

	<script src="assets/js/resizeable.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<!-- JavaScripts initializations and stuff -->
	<script src="assets/js/neon-custom.js"></script>
	<!-- my js -->
	<script src="../js/app.js"></script>
	<!-- Demo Settings -->
	<script src="assets/js/neon-demo.js"></script>';
	if(isset($success) && $success != ''){
		echo '
		<script>
		var opts = {
			"closeButton": true,
			"debug": false,
			"positionClass": "toast-top-right",
			"onclick": null,
			"showDuration": "300",
			"hideDuration": "1000",
			"timeOut": "5000",
			"extendedTimeOut": "1000",
			"showEasing": "swing",
			"hideEasing": "linear",
			"showMethod": "fadeIn",
			"hideMethod": "fadeOut"
		};
		toastr.success("'.$success.'", "'.lang('SUCCESS').'", opts);
		</script>
		';
	}
	if(isset($error) && $error != ''){
		echo '
		<script>
		var opts = {
			"closeButton": true,
			"debug": false,
			"positionClass": "toast-top-right",
			"onclick": null,
			"showDuration": "300",
			"hideDuration": "1000",
			"timeOut": "5000",
			"extendedTimeOut": "1000",
			"showEasing": "swing",
			"hideEasing": "linear",
			"showMethod": "fadeIn",
			"hideMethod": "fadeOut"
		};
		toastr.error("'.$error.'", "'.lang('ERROR').'", opts);
		</script>
		';
	}
	foreach($scripts as $script)
		echo '<script src="'.$script.'"></script>';
}