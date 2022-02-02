<?php
loadlang('datatables');
include_once($appRequests.'tasks.php'); //load all $_POST	
$styles = array(
    'assets/js/datatables/datatables.css',
);

$title = lang('title');
$scripts = array(
	'assets/js/datatables/datatables.js',
	'assets/js/select2/select2.min.js'
);

if(!isset($cParams[0]))
    $cParams[0] = 'upcoming';

//include($appViews.'tasks.php');