<?php
if(!defined('estatedrive')) {
	die('Direct access not permitted');
 }
 if($privs->view_contacts == 0)
	 die('No access');
loadLang('contacts/view');
loadLang('datatables');
$sql = "SELECT * FROM properties WHERE id = ?";
$params = array($cParams[0]);
$property = $db->row($sql, $params);
if(!isset($property->id)){
	header("Location: ".$controllerName);
	exit();
}
$sql = 'SELECT * FROM properties_notes WHERE property = ? ORDER BY date DESC';
$params = array($property->id);
$notes = $db->fetch($sql, $params);
$sql = 'SELECT * FROM images WHERE property = ? ORDER BY ordernum ASC';
$params = array($property->id);
$images = $db->fetch($sql, $params);
include_once($appRequests.$controllerName.'/view.php'); //load all $_POST	
$styles = array(
	'assets/js/datatables/datatables.css',
	'assets/js/vertical-timeline/css/component.css',
    'assets/js/select2/select2-bootstrap.css',
    'assets/js/select2/select2.css',
    'assets/js/fullcalendar-2/fullcalendar.min.css',
	'assets/libraries/fileuploader/jquery.fileuploader.min.css'
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
.pac-container.pac-logo {z-index:9999999}
';
$title = $property->title;
$scripts = array(
	'assets/js/datatables/datatables.js',
	'assets/js/select2/select2.min.js',
	'assets/js/moment.min.js',
	'assets/libraries/fileuploader/jquery.fileuploader.min.js',
	'https://maps.google.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyCgbEtlyRJ2jufUn9A2ziJjhkrgqL-Qt_Q&language=el-GR',
	'https://cozy.estateplus.gr/js/custom-map.js',
	'assets/js/fullcalendar-2/fullcalendar.min.js',
	'assets/js/fullcalendar-2/lang/el.js',
	'https://cozy.estateplus.gr/js/markerwithlabel_packed.js'
);
$owner = fetchRow('contacts', '*', 'id = ?', array($property->contact));

include($appViews.'/'.$controllerName.'/view.php');