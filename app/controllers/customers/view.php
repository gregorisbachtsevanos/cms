<?php
if(!defined('estatedrive')) {
	die('Direct access not permitted');
 }
 if($privs->view_contacts == 0)
	 die('No access');
loadLang('customers/view');
loadLang('datatables');
$sql = "SELECT * FROM customers WHERE id = ?";
$params = array($cParams[0]);
$contact = $db->row($sql, $params);
if(!isset($contact->id)){
	header("Location: ".$controllerName);
	exit();
}
$sql = 'SELECT * FROM customers_notes WHERE contact = ? ORDER BY date DESC';
$params = array($contact->id);
$notes = $db->fetch($sql, $params);
include_once($appRequests.$controllerName.'/view.php'); //load all $_POST	
$styles = array(
	'assets/js/datatables/datatables.css',
	'assets/js/vertical-timeline/css/component.css',
	'//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css'
);
$extra_css = '
.select2-container {width:100%!important}
.select2-container--default .select2-selection--single {
    border: 1px solid #ebebeb;
    height: 42px;
}
.select2-container--default .select2-selection--single .select2-selection__rendered {
    padding-top: 5px;
}
.modal-content {
    min-height: 530px;
}
';
$title = $contact->surname .' '.$contact->name;
$scripts = array(
	'assets/js/datatables/datatables.js',
	'//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js'
);
include($appViews.'/'.$controllerName.'/view.php');