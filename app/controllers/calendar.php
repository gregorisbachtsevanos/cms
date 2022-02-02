<?php
loadlang('calendar');
include_once($appRequests.'calendar.php'); //load all $_POST	
$styles = array(
    'assets/js/fullcalendar-2/fullcalendar.min.css',
    '//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css'
);
$extra_css = '
.modal-content {
    min-height: 530px;
}
.ui-timepicker-container, .select2-container {z-index:9999999!important;}
.page-body .select2-container {
    width: 100%!important;
}
.select2-container--default .select2-selection--single {
    display: block;
    width: 100%;
    height: 42px;
    padding: 6px 12px;
    font-size: 12px;
    line-height: 1.42857143;
    color: #555555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ebebeb;
    border-radius: 3px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    -webkit-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
}
';
$title = lang('CALENDAR');
$scripts = array(
	'assets/js/moment.min.js',
	'assets/js/fullcalendar-2/fullcalendar.min.js',
    '//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js'
);
if($user->lang == 'el'){
    array_push($scripts, 'assets/js/fullcalendar-2/lang/el.js');
}
elseif($user->lang == 'de'){
    array_push($scripts, 'assets/js/fullcalendar-2/lang/de.js');
}
include($appViews.'calendar.php');