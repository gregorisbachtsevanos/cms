<?php
if(!defined('estatedrive')) {
   die('Direct access not permitted');
}
if($privs->view_contacts == 0)
	die('No access');
loadLang('contacts/index');
loadLang('datatables');
include_once($appRequests.'contacts/index.php'); //load all $_POST	
$styles = array(
    'assets/js/datatables/datatables.css',
    'assets/js/select2/select2-bootstrap.css',
    'assets/js/select2/select2.css'
);
$extra_css = '
.delete-task, .edit-task {text-align: right; display: inline-block}
.modal-content {
    min-height: 530px;
}
.select2-container {width:100%!important}
span.select2-container.select2-container--default.select2-container--open {z-index:9999999}
.select2-container--default .select2-selection--single {
    border: 1px solid #ebebeb;
    height: 42px;
}
.select2-container--default .select2-selection--single .select2-selection__rendered {
    padding-top: 5px;
}
';
$title = lang('title');
$scripts = array(
	'assets/js/datatables/datatables.js',
	'assets/js/select2/select2.min.js'
);

include($appViews.'/contacts/index.php');