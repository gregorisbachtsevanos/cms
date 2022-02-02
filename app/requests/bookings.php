<?php
if(!defined('estatedrive')) {
   die('Direct access not permitted');
}
if(isset($_POST['show-table'])){
	$sLimit = " LIMIT 0,10";
	if ( isset( $_REQUEST['start'] ) && $_REQUEST['length'] != '-1' ) {
		$sLimit = " LIMIT ".intval( $_REQUEST['start'] ).", ".intval( $_REQUEST['length'] );
	}
	if(isset($_REQUEST['order'])){
		$columns = array('id', 'customer', 'property', 'date_booked', 'date_starting', 'date_ending', 'amount', 'source');
		$order = ' ORDER BY '.$columns[$_REQUEST['order'][0]['column']].' '.$_REQUEST['order'][0]['dir'];
	}
	else
		$order = ' ORDER BY id DESC';
	if(isset($_REQUEST['search']))
		$_REQUEST['q'] = $_REQUEST['search']['value'];

	$sql1 = "SELECT * FROM `bookings` WHERE id > ?";
	$params1 = array(0);
	if(isset($_REQUEST['q'])) {
		$sql1 .= " AND (amount LIKE ? OR notes LIKE ?)";
		array_push($params1, '%'.$_REQUEST['q'].'%');
		array_push($params1, '%'.$_REQUEST['q'].'%');
	}
	if(isset($_POST['customer']) && $_POST['customer'] > 0) {
		$sql1 .= ' AND customer = ?';
		array_push($params1, $_POST['customer']);
	}
	if(isset($_POST['property']) && $_POST['property'] > 0) {
		$sql1 .= ' AND property = ?';
		array_push($params1, $_POST['property']);
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
	$statuses = array();
	foreach(fetchTable('bookings_statuses') as $row)
		$statuses[$row->id] = array('name'=>$row->name, 'color'=>$row->color, 'background'=>$row->background);
	$sources = array();
	foreach(fetchTable('bookings_sources') as $row)
		$sources[$row->id] = $row->name;
	foreach($rows as $row){
		$customer = fetchRow('customers', 'id, name, surname', 'id = ?', array($row->customer));
		$property = fetchRow('properties', 'id, title', 'id = ?', array($row->property));
		$datarow = array();
		if(isset($_POST['customer']) || isset($_POST['property'])){
			array_push($datarow, '<a href="'.$appURL.'bookings?view='.$row->id.'" target="_blank">'.$row->id.'</a>');
		}
		else
			array_push($datarow, '<a onclick="showBooking('.$row->id.')" style="cursor:pointer">'.$row->id.'</a>');
		array_push($datarow, '<a href="'.$appURL.'customers/view/'.$customer->id.'">'.$customer->surname.' '.$customer->name.'</a>');
		array_push($datarow, '<a href="'.$appURL.'properties/view/'.$property->id.'">'.$property->title.'</a>');
		array_push($datarow, date('d/m/Y', strtotime($row->date_booked)));
		array_push($datarow, date('d/m/Y', strtotime($row->date_starting)));
		array_push($datarow, date('d/m/Y', strtotime($row->date_ending)));
		array_push($datarow, number_format($row->amount, 2, ',', '.').'€');
		array_push($datarow, number_format(($row->amount - $row->paid), 2, ',', '.').'€');
		array_push($datarow, '<span class="badge" style="color:'.$statuses[$row->status]['color'].';background:'.$statuses[$row->status]['background'].';">'.$statuses[$row->status]['name'].'</span>');
		array_push($datarow, $sources[$row->source]);
	   array_push($data['data'], $datarow);
	}
	echo json_encode($data);
	exit();
}
elseif(isset($_GET['show-calendar'])){
	$statuses = array();
	foreach(fetchTable('bookings_statuses') as $row)
		$statuses[$row->id] = array('name'=>$row->name, 'color'=>$row->color, 'background'=>$row->background);
	$start = $_REQUEST['start'];
	$end = $_REQUEST['end'];
	$sql1 = "SELECT bookings.id as id, bookings.customer as customer, bookings.date_starting, bookings.date_ending, customers.name as name, customers.surname as surname, bookings.property as  property, properties.title as title, customers.phone as phone, customers.mobile as mobile, bookings.status as status, bookings_statuses.name as status_name FROM `bookings` LEFT JOIN customers ON bookings.customer = customers.id LEFT JOIN properties ON bookings.property = properties.id LEFT JOIN bookings_statuses ON bookings_statuses.id = bookings.status WHERE bookings.property = ? AND ((bookings.date_starting >= ? AND bookings.date_starting <= ?) OR (bookings.date_ending >= ? AND bookings.date_ending <= ?))";
	$params1 = array($_GET['show-calendar'], $start, $end, $start, $end);
	
	$rows = $db->fetch($sql1, $params1);
	$data = array();
	foreach($rows as $row){
		$datarow = array('id'=>$row->id, 'title'=>$row->surname.' '.$row->name, 'start'=>$row->date_starting, 'end'=>$row->date_ending);
		$phones = array();
		if($row->phone != '')
			array_push($phones, $row->phone);
		if($row->mobile != '')
			array_push($phones, $row->mobile);
		if(Count($phones) > 0)
			$datarow['title'] .= ' ('.implode(', ', $phones).')';
		$datarow['color'] = $statuses[$row->status]['background'];

		$datarow['allDay'] = true;

		array_push($data, $datarow);
	}
	function prettyPrint( $json )
	{
		$result = '';
		$level = 0;
		$in_quotes = false;
		$in_escape = false;
		$ends_line_level = NULL;
		$json_length = strlen( $json );
	
		for( $i = 0; $i < $json_length; $i++ ) {
			$char = $json[$i];
			$new_line_level = NULL;
			$post = "";
			if( $ends_line_level !== NULL ) {
				$new_line_level = $ends_line_level;
				$ends_line_level = NULL;
			}
			if ( $in_escape ) {
				$in_escape = false;
			} else if( $char === '"' ) {
				$in_quotes = !$in_quotes;
			} else if( ! $in_quotes ) {
				switch( $char ) {
					case '}': case ']':
						$level--;
						$ends_line_level = NULL;
						$new_line_level = $level;
						break;
	
					case '{': case '[':
						$level++;
					case ',':
						$ends_line_level = $level;
						break;
	
					case ':':
						$post = " ";
						break;
	
					case " ": case "\t": case "\n": case "\r":
						$char = "";
						$ends_line_level = $new_line_level;
						$new_line_level = NULL;
						break;
				}
			} else if ( $char === '\\' ) {
				$in_escape = true;
			}
			if( $new_line_level !== NULL ) {
				$result .= "\n".str_repeat( "\t", $new_line_level );
			}
			$result .= $char.$post;
		}
	
		return $result;
	}
	echo prettyPrint(json_encode($data));
	exit();
}
elseif(isset($_POST['add']) && $privs->add_contacts == 1){
	$data = array(
		'date_created'=>date('Y-m-d H:i:s', time())
	);
	foreach($_POST as $key=>$val){
		if($key == 'date_starting' || $key == 'date_ending' || $key == 'date_booked'){
			$vals = explode('/', $val);
			if(Count($vals) == 3){
				$dtime = DateTime::createFromFormat("d/m/Y", $val);
				$timestamp = $dtime->getTimestamp();
				$data[$key] = date('Y-m-d', $timestamp);
			}
		}
		elseif($key == 'amount' || $key == 'paid' || $key == 'cleaning_fee'){
			$val = str_replace(' ', '', $val);
			$val = str_replace(',', '.', $val);
			$data[$key] = $val;
		}
		elseif($key != 'add')
			$data[$key] = $val;
	}
	if($newId = $db->insert('bookings', $data)){
		$success = 'Η κράτηση προστέθηκε';
	}
}
elseif(isset($_POST['edit']) && $privs->add_contacts == 1){
	$row = fetchRow('properties', '*', 'id = ?', array($_POST['id']));
	if(isset($row->id)){
		$data = array();
		foreach($_POST as $key=>$val){
			if($key == 'date_starting' || $key == 'date_ending' || $key == 'date_booked'){
				$vals = explode('/', $val);
				if(Count($vals) == 3){
					$dtime = DateTime::createFromFormat("d/m/Y", $val);
					$timestamp = $dtime->getTimestamp();
					$data[$key] = date('Y-m-d', $timestamp);
				}
			}
			elseif($key == 'amount' || $key == 'paid' || $key == 'cleaning_fee'){
				$val = str_replace(' ', '', $val);
				$val = str_replace(',', '.', $val);
				$data[$key] = $val;
			}
			elseif($key != 'edit' && $key != 'id')
				$data[$key] = $val;
		}
		if($db->update('bookings', $data, array('id'=>$row->id))){
			$success = 'Η κράτηση αποθηκεύτηκε';
		}
		
	}
}
elseif(isset($_POST['show'])){
	$sql = 'SELECT * FROM bookings WHERE id = ?';
	$params = array($_POST['show']);
	$row = $db->row($sql, $params);
	if(isset($row->id)){
		$customer = fetchRow('customers', 'id, name, surname', 'id = ?', array($row->customer));
		$property = fetchRow('properties', 'id, title', 'id = ?', array($row->property));
		$data = array();
		foreach($row as $key=>$val){
			if($key == 'date_starting' || $key == 'date_ending' || $key == 'date_booked'){
				$data[$key] = date('d/m/Y', strtotime($val));
			}
			elseif($key == 'customer'){
				$data[$key] = '<option value="'.$customer->id.'" selected>'.$customer->surname.' '.$customer->name.'</option>';
			}
			elseif($key == 'property'){
				$data[$key] = '<option value="'.$property->id.'" selected>'.$property->title.'</option>';
			}
			elseif($key == 'amount' || $key == 'paid' || $key == 'cleaning_fee'){
				$val = number_format($val, 2, ',', '.');
				$val = str_replace(',00', '', $val);
				$data[$key] = $val;
			}
			elseif($key != 'date_created'){
				$data[$key] = $val;
			}
		}
		echo json_encode($data);
	}
	exit();
}
elseif(isset($_GET['delete']) && $privs->delete_contacts == 1){
	$sql = 'SELECT * FROM bookings WHERE id = ?';
	$params = array($_GET['delete']);
	$row = $db->row($sql, $params);
	if(isset($row->id)){
		if($db->delete('bookings', array('id'=>$row->id))){
			$success = 'Η κράτηση αφαιρέθηκε';
		}
	}
}
