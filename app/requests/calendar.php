<?php
if(!defined('estatedrive')) {
   die('Direct access not permitted');
}
if(isset($_POST['show-table']) && $privs->view_calendar == 1){
	$sLimit = " LIMIT 0,10";
	if ( isset( $_REQUEST['start'] ) && $_REQUEST['length'] != '-1' ) {
		$sLimit = " LIMIT ".intval( $_REQUEST['start'] ).", ".intval( $_REQUEST['length'] );
	}
	if(isset($_REQUEST['order'])){
		if(!isset($_REQUEST['contact'])){
			$columns = array('calendar.date', 'contacts.id', 'calendar.status', 'calendar.notes');
		}
		else {
			$columns = array('calendar.date', 'calendar.status', 'calendar.notes');
		}
		$order = ' ORDER BY '.$columns[$_REQUEST['order'][0]['column']].' '.$_REQUEST['order'][0]['dir'];
	}
	else
		$order = ' ORDER BY calendar.date DESC';
	if(isset($_REQUEST['search']))
		$_REQUEST['q'] = $_REQUEST['search']['value'];

	$sql1 = "SELECT calendar.id as id, contacts.name as name, calendar.notes, calendar.date as date, calendar.contact, contacts.surname as surname, calendar.status FROM `calendar` LEFT JOIN contacts ON calendar.contact = contacts.id WHERE calendar.id > ?";
	$params1 = array(0);
	if(isset($_REQUEST['q'])) {
		$sql1 .= " AND (contacts.name LIKE ? OR contacts.surname LIKE ? OR contacts.mobile LIKE ? OR contacts.email LIKE ? OR CONCAT(contacts.surname, ' ', contacts.name) LIKE ?)";
		array_push($params1, '%'.$_REQUEST['q'].'%');
		array_push($params1, '%'.$_REQUEST['q'].'%');
		array_push($params1, '%'.$_REQUEST['q'].'%');
		array_push($params1, '%'.$_REQUEST['q'].'%');
		array_push($params1, '%'.$_REQUEST['q'].'%');
	}
	if(isset($_REQUEST['contact'])){
		$sql1 .= ' AND calendar.contact = ?';
		array_push($params1, $_REQUEST['contact']);
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

	foreach($rows as $row){
			$datarow = array();
			array_push($datarow, '<a style="cursor: pointer" onclick="editCalendar('.$row->id.')">'.date('d/m/Y H:i', strtotime($row->date)).'</a>');
			if(!isset($_REQUEST['contact']))
				array_push($datarow, '<a href="contacts/view/'.$row->id.'">'.$row->name.'</a>');
			array_push($datarow, lang('status_'.$row->status));
			array_push($datarow, $row->notes);
		   array_push($data['data'], $datarow);
	}
	echo json_encode($data);
	exit();
}
elseif(isset($_GET['show-calendar']) && $privs->view_calendar == 1){
	$start = $_REQUEST['start'];
	$end = $_REQUEST['end'];
	$sql1 = "SELECT calendar.id as id, contacts.name as name, contacts.phone as phone, contacts.mobile as mobile, calendar.notes, calendar.date as date, calendar.contact, contacts.surname as surname, calendar.status FROM `calendar` LEFT JOIN contacts ON calendar.contact = contacts.id WHERE calendar.date >= ? AND calendar.date <= ?";
	$params1 = array($start, $end);
	
	$rows = $db->fetch($sql1, $params1);
	$data = array();
	foreach($rows as $row){
		$datarow = array('id'=>$row->id, 'title'=>$row->surname.' '.$row->name, 'start'=>$row->date);
		$phones = array();
		if($row->phone != '')
			array_push($phones, $row->phone);
		if($row->mobile != '')
			array_push($phones, $row->mobile);
		if(Count($phones) > 0)
			$datarow['title'] .= ' ('.implode(', ', $phones).')';
		$datarow['end'] = date('Y-m-d H:i:s', strtotime($datarow['start']) + 1800);
		if($row->status == 0) //default
			$datarow['color'] = '#4c4c4c';
		elseif($row->status == 1) //completed
			$datarow['color'] = '#4CAF50';
		elseif($row->status == 2) //calcelled
			$datarow['color'] = '#e02700';

		$datarow['allDay'] = false;

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
elseif(isset($_GET['delete_calendar']) && $privs->delete_calendar == 1){
	$row = fetchRow('calendar', '*', 'id = ?', array($_GET['delete_calendar']));
	if($db->delete('calendar', array('id'=>$row->id))){
		$success = lang('calendar_deleted');
		$contact_row = fetchRow('contacts', 'name, surname', 'id = ?', array($row->contact));
		addLog('calendar', 'delete', $row->id, $contact_row->surname.' '.$contact_row->name.' ('.date('d/m/Y H:i', strtotime($row->date)).')', '');
	}
	
}
elseif(isset($_POST['add_calendar']) && $privs->add_calendar == 1){
	$vals = explode('/', $_POST['date']);
	if(Count($vals) == 3){
		$dtime = DateTime::createFromFormat("d/m/Y H:i", $_POST['date'].' '.$_POST['time']);
		$timestamp = $dtime->getTimestamp();
		$data = array(
			'date'=>date('Y-m-d H:i:s', $timestamp),
			'notes'=>$_POST['notes'],
			'user'=>$user->id,
			'date_created'=>date('Y-m-d H:i:s', time()),
			'contact'=>$_POST['contact']
		);
		if($newId = $db->insert('calendar', $data)){
			$success = lang('calendar_added');
			$contact_row = fetchRow('contacts', 'name, surname', 'id = ?', array($data['contact']));
			addLog('calendar', 'create', $newId, '', $contact_row->surname.' '.$contact_row->name.' ('.date('d/m/Y H:i', strtotime($data['date'])).')');
		}
	}
}
elseif(isset($_POST['load_calendar_data'])){
	$sql = 'SELECT * FROM calendar WHERE id = ?';
	$row = $db->row($sql, array($_POST['load_calendar_data']));
	$contact = fetchRow('contacts', 'name, surname, phone, mobile', $where='id = ?', $params=array($row->contact));
	$phones = array();
	if($contact->phone != '')
		array_push($phones, $contact->phone);
	if($contact->mobile != '')
		array_push($phones, $contact->mobile);
	
	echo '<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h4 class="modal-title">'.lang('edit_calendar').'</h4>
	</div>
	<div class="modal-body">
		<div class="row">
			<div class="col-md-8">
				<div class="form-group">
					<label class="control-label">'.lang('date').'</label>
					<input required type="text" name="date" class="form-control datepicker2" autocomplete="off" placeholder="'.lang('date_placeholder').'" value="'.date('d/m/Y', strtotime($row->date)).'"> 
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label class="control-label">'.lang('time').'</label>
					<input required type="text" name="time" class="form-control timepicker2" autocomplete="off" placeholder="'.lang('time_placeholder').'" value="'.date('H:i', strtotime($row->date)).'"> 
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label class="control-label">'.lang('contact').' (<a href="'.$appURL.'contacts/view/'.$row->contact.'" target="_blank">'.lang('VIEW').'</a>)</label>
					<select name="contact" class="form-control select2_ajax_tags2" required><option value="'.$row->contact.'" selected>'.$contact->surname.' '.$contact->name;
					if(Count($phones) > 0)
						echo ' ('.implode(', ', $phones).')';
					
					echo '</option></select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label class="control-label">'.lang('status').'</label>
					<select name="status" class="form-control">
					';
					for($i = 0; $i <= 2; $i++){
						echo '<option value="'.$i.'"';
						if($row->status == $i)
							echo ' selected';
						echo '>'.lang('status_'.$i).'</option>';
					}
					echo '
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label class="control-label">'.lang('notes').'</label>
					<textarea name="notes" class="form-control" placeholder="'.lang('notes_placeholder').'">'.$row->notes.'</textarea>
				</div>
			</div>
		</div>
		<input type="hidden" name="id" value="'.$row->id.'">
	</div>
	<div class="modal-footer">
		<input type="hidden" name="id" value="'.$row->id.'">
		<button type="button" class="btn btn-default" data-dismiss="modal">'.lang('CANCEL').'</button>';
		if($privs->delete_metrics == 1) { 
			echo '<button type="button" class="btn btn-danger" id="delete_calendar_btn">'.lang('DELETE').'</button>';
		}
		echo '
		<button type="submit" name="edit_calendar" value="1" class="btn btn-info">'.lang('SAVE').'</button>
	</div>';
	exit();
}
elseif(isset($_POST['edit_calendar']) && $privs->edit_calendar == 1){
	$vals = explode('/', $_POST['date']);
	if(Count($vals) == 3){
		$dtime = DateTime::createFromFormat("d/m/Y H:i", $_POST['date'].' '.$_POST['time']);
		$timestamp = $dtime->getTimestamp();
		$data = array(
			'date'=>date('Y-m-d H:i:s', $timestamp),
			'notes'=>$_POST['notes'],
			'status'=>$_POST['status'],
			'contact'=>$_POST['contact']
		);
		if($db->update('calendar', $data, array('id'=>$_POST['id']))){
			$success = lang('calendar_saved');
		}
	}
}