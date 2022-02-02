<?php
loadLang('dashboard');
loadLang('calendar');
if(isset($_POST['editMsg'])){
    if($db->update('wall', array('message'=>$_POST['message']), array('id'=>$_POST['id'])))
        $success = lang('message_saved');
}
elseif(isset($_POST['message'])){
	if($db->insert('wall', array('user'=>$user->id, 'message'=>$_POST['message'], 'date'=>date('Y-m-d H:i:s', time()), 'parent'=>$_POST['parent'])))
        $success = lang('message_saved');
}
elseif(isset($_GET['delMsg'])){
    if($db->delete('wall', array('id'=>$_GET['delMsg'])))
        $success = lang('message_deleted');
}
elseif(isset($_GET['edit-wall-msg'])) {
    echo fetchRow('wall', 'message', 'id = ?', array($_POST['id']), 1);
    exit();
}
elseif(isset($_GET['show_wall'])){
    $start = $_REQUEST['page'] * 5;
    $sql = 'SELECT wall.message, wall.user, wall.date, wall.id, wall.parent, users.surname as surname, users.name as name FROM wall LEFT JOIN users ON wall.user = users.id WHERE wall.parent = ? ORDER BY id DESC LIMIT '.$start.',5';
    $params = array(0);
    $rows = $db->fetch($sql, $params); 
    if(Count($rows) == 0){
        echo 'error';
        exit();
    }
    foreach($rows as $row){
        echo '
        <div class="sl-item" id="msgitem'.$row->id.'">
            <div class="sl-right">
                <div class=""><a href="#" class="text-info">'.$row->name.' '.$row->surname.'</a> <span  class="sl-date">'.date('d/m/Y H:i', strtotime($row->date)).'</span>';
                if($row->user == $user->id) echo ' &nbsp;&nbsp; <a class="edit" onclick="editMsg('.$row->id.')" style="cursor: pointer; color: #ffca4a"><i class="entypo-pencil"></i></a> <a class="delete" onclick="delMsg('.$row->id.')" style="cursor: pointer; color: #f96262"><i class="entypo-cancel"></i></a>';
                    echo '
                    <p class="m-t-10">'.nl2br($row->message).'</p>
                    <br />';
                    $sql = 'SELECT wall.message, wall.user, wall.date, wall.id, wall.parent, users.surname as surname, users.name as name FROM wall LEFT JOIN users ON wall.user = users.id WHERE wall.parent = ? ORDER BY id ASC';
                    $params = array($row->id);
                    $rows2 = $db->fetch($sql, $params); 
                    foreach($rows2 as $row2) {
                        echo '
                    <div class="sl-item">
                        <div class="sl-right" style="padding-left: 0px;">
                            <div class="m-l-40"><a href="#" class="text-info">'.$row->name.' '.$row->surname.'</a> <span  class="sl-date">'.date('d/m/Y H:i', strtotime($row2->date)).'</span>';
                            if($row2->user == $user->id) echo ' &nbsp;&nbsp; <a class="edit" onclick="editMsg('.$row2->id.')" style="cursor: pointer; color: #ffca4a"><i class="entypo-pencil"></i></a> <a class="delete" onclick="delMsg('.$row2->id.')" style="cursor: pointer; color: #f96262"><i class="entypo-cancel"></i></a>';
                            echo '
                                <p class="m-t-10">'.nl2br($row2->message).'</p>
                            </div>
                        </div>
                    </div>';
                    }
                    echo '
                    <div class="sl-item">
                        <div class="sl-right" style="padding-left: 0px;">
                            <form id="msg'.$row->id.'" method="post" action="'.$appURL.'dashboard">
                            <div class="m-l-40"><input type="text" name="message" class="form-control" placeholder="'.lang('leave_a_reply').'" autocomplete="off"></div>
                            <input type="hidden" name="parent" value="'.$row->id.'">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr />
        ';
        
    }
    exit();
}

$styles = array(
	'laiki-assets/vendors/chartist-js/chartist.min.css',
    'laiki-assets/vendors/chartist-js/chartist-plugin-tooltip.css',
    'laiki-assets/css/pages/dashboard-modern.css',
    'laiki-assets/css/pages/intro.css'
);
$extra_css = '
.steamline .sl-left {
    float: left;
    margin-left: -20px;
    z-index: 1;
    margin-right: 15px;
}
.m-l-40 {
    margin-left: 40px!important;
}
.sl-date {
    font-size: 10px;
    color: #98a6ad;
}
.m-t-10 {
    margin-top: 10px!important;
}

';
$title = lang('TITLE');
$scripts = array(
	'laiki-assets/vendors/chartjs/chart.min.js',
    'laiki-assets/vendors/chartist-js/chartist.min.js',
    'laiki-assets/vendors/chartist-js/chartist-plugin-tooltip.js',
    'laiki-assets/vendors/chartist-js/chartist-plugin-fill-donut.min.js',
    'laiki-assets/js/scripts/dashboard-modern.js',
	'laiki-assets/js/scripts/intro.js'
);

$sql = 'SELECT COUNT(id) as total FROM contacts WHERE date_created >= ?';
$params = array(date('Y-m', time()).'-01 00:00:00');
$row = $db->row($sql, $params);
$total_contacts = $row->total;

$sql = 'SELECT COUNT(id) as total FROM customers WHERE date_created >= ?';
$params = array(date('Y-m', time()).'-01 00:00:00');
$row = $db->row($sql, $params);
$total_customers = $row->total;

$sql = 'SELECT COUNT(id) as total FROM bookings WHERE date_starting >= ? AND  date_starting <= ?';
$params = array(date('Y-m', time()).'-01', date('Y-m-t', time()));
$row = $db->row($sql, $params);
$total_bookings = $row->total;

$sql = 'SELECT COUNT(id) as total FROM properties WHERE date_created >= ?';
$params = array(date('Y-m', time()).'-01 00:00:00');
$row = $db->row($sql, $params);
$total_properties = $row->total;

$sql = "SELECT bookings.id as id, bookings.customer as customer, customers.name as name, customers.surname as surname, bookings.property as  property, properties.title as title, customers.phone as phone, customers.mobile as mobile, bookings.status as status, bookings_statuses.name as status_name FROM `bookings` LEFT JOIN customers ON bookings.customer = customers.id LEFT JOIN properties ON bookings.property = properties.id LEFT JOIN bookings_statuses ON bookings_statuses.id = bookings.status WHERE bookings.date_starting = ?";
$params = array(date('Y-m-d'));
$incoming = $db->fetch($sql, $params);
$sql = "SELECT bookings.id as id, bookings.customer as customer, customers.name as name, customers.surname as surname, bookings.property as  property, properties.title as title, customers.phone as phone, customers.mobile as mobile, bookings.status as status, bookings_statuses.name as status_name FROM `bookings` LEFT JOIN customers ON bookings.customer = customers.id LEFT JOIN properties ON bookings.property = properties.id LEFT JOIN bookings_statuses ON bookings_statuses.id = bookings.status WHERE bookings.date_ending = ?";
$params = array(date('Y-m-d'));
$leaving = $db->fetch($sql, $params);

include($appViews.'/dashboard/index.php');
?>