<?php
if(!defined('estatedrive')) {
   die('Direct access not permitted');
}
if(isset($_POST['show-table']) && $privs->view_tasks == 1){
	$sLimit = " LIMIT 0,10";
	if ( isset( $_REQUEST['start'] ) && $_REQUEST['length'] != '-1' ) {
		$sLimit = " LIMIT ".intval( $_REQUEST['start'] ).", ".intval( $_REQUEST['length'] );
	}
	if(isset($_REQUEST['order'])){
		$columns = array('tasks.title', 'users.surname', '', 'tasks.deadline', 'tasks.status', 'tasks.date_created');
		$order = ' ORDER BY '.$columns[$_REQUEST['order'][0]['column']].' '.$_REQUEST['order'][0]['dir'];
	}
	else {
		if(isset($_POST['status']) && $_POST['status'] == 'in_progress')
			$order = ' ORDER BY tasks.deadline ASC';
		else
			$order = ' ORDER BY tasks.date_completed DESC';
	}
	if(isset($_REQUEST['search']))
		$_REQUEST['q'] = $_REQUEST['search']['value'];

	$sql1 = "SELECT tasks.id as id, users.name as name, users.surname as surname, tasks.status as status, tasks.title as title, tasks.recipients as recipients, tasks.date_created as date_created, tasks.date_completed as date_completed, tasks.deadline as deadline FROM `tasks` LEFT JOIN users ON tasks.user = users.id WHERE tasks.id > ?";
	$params1 = array(0);
	if(isset($_REQUEST['q']) && $_REQUEST['q'] != '') {
		$sql1 .= " AND tasks.title LIKE ?";
		array_push($params1, '%'.$_REQUEST['q'].'%');
	}
	if(isset($_POST['type']) && $_POST['type'] == 'incoming'){
		$sql1 .= ' AND tasks.recipients LIKE ?';
		array_push($params1, '%-'.$user->id.'-%');
	}
	elseif(isset($_POST['type']) && $_POST['type'] == 'outgoing'){
		$sql1 .= ' AND tasks.user = ?';
		array_push($params1, $user->id);
	}
	if(isset($_POST['status']) && $_POST['status'] == 'in_progress'){
		$sql1 .= ' AND tasks.status = ?';
		array_push($params1, 0);
	}
	elseif(isset($_POST['status']) && $_POST['status'] == 'completed'){
		$sql1 .= ' AND tasks.status = ?';
		array_push($params1, 1);
	}
	elseif(isset($_POST['contact']) && $_POST['contact'] != ''){
		$sql1 .= ' AND tasks.contacts LIKE ?';
		array_push($params1, '%-'.$_POST['contact'].'-%');
	}
	$task_statuses = array(
		0=>array('color'=>'default', 'name'=>lang('in_progress')),
		1=>array('color'=>'success', 'name'=>lang('completed')),
		9=>array('color'=>'danger', 'name'=>lang('completed'))
	);
	$sql1 .= $order;
	$rows = $db->fetch($sql1, $params1);
	$total = Count($rows);
	$sql1 .= $sLimit;
	$rows = $db->fetch($sql1, $params1);
	$total2 = Count($rows);
	$data = array(
		'draw'=>$_REQUEST['draw'],
		'recordsTotal'=>$total,
		'recordsFiltered'=>$total,
		'iTotalRecords'=>$total,
		'iTotalDisplayRecords '=>$total2
	);
	$data['data'] = array();
	$users = array();
	foreach(fetchTable('users') as $val){
		$users[$val->id] = $val->name.' '.$val->surname;
	}
	foreach($rows as $row){
			$datarow = array();
			$recipients = array();
			foreach(explode('-', $row->recipients) as $val){
				if($val != ''){
					array_push($recipients, $users[$val]);
				}
			}
			if(isset($_POST['contact']) && $_POST['contact'] != ''){
				$a_link = '<a href="'.$appURL.'tasks?show='.$row->id.'" target="_blank">';
			}
			else {
				$a_link = '<a style="cursor: pointer" onclick="viewTask('.$row->id.')">';
			}
			if($row->status == 1 && date('Y-m-d', strtotime($row->deadline)) < date('Y-m-d', strtotime($row->date_completed)))
				$row->status = 9;
			array_push($datarow, $a_link.$row->title.'</a>');
			array_push($datarow, $row->name.' '.$row->surname);
			array_push($datarow, implode(', ', $recipients));
			array_push($datarow, $a_link.date('d/m/Y', strtotime($row->deadline)).'</a>');
			array_push($datarow, '<span class="label label-'.$task_statuses[$row->status]['color'].'">'.$task_statuses[$row->status]['name'].'</div>');
			array_push($datarow, $a_link.date('d/m/Y H:i', strtotime($row->date_created)).'</a>');
		   array_push($data['data'], $datarow);
	}
	echo json_encode($data);
	exit();
}
elseif(isset($_POST['view_task'])){
	$row = fetchRow('tasks', '*', 'id = ?', array($_POST['view_task']));
	if(!isset($row->id))
		exit();
	$users = array();
	foreach(fetchTable('users') as $val){
		$users[$val->id] = $val->name.' '.$val->surname;
	}
	$recipients = array();
	foreach(explode('-', $row->recipients) as $val){
		if($val != ''){
			array_push($recipients, $users[$val]);
		}
	}
	$contacts = array();
	foreach(explode('-', $row->contacts) as $val){
		if($val != ''){
			$contact_row = fetchRow('contacts', 'name, surname', 'id = ?', array($val));
			array_push($contacts, '<a href="'.$appURL.'contacts/view/'.$val.'" target="_blank">'.$contact_row->surname.' '.$contact_row->name.'</a>');
		}
	}
	?>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title"><?php slang('view_task'); ?></h4>
	</div>
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12">
				<div class="table-response">
					<table class="table">
						<tr><td><strong><?php slang('task_name'); ?>:</strong></td><td><?php echo $row->title; ?></td></tr>
						<tr><td><strong><?php slang('sender'); ?>:</strong></td><td><?php echo $users[$row->user]; ?></td></tr>
						<tr><td><strong><?php slang('recipients'); ?>:</strong></td><td><?php echo implode(', ', $recipients); ?></td></tr>
						<tr><td><strong><?php slang('date_created'); ?>:</strong></td><td><?php echo date('d/m/Y H:i', strtotime($row->date_created)); ?></td></tr>
						<tr><td><strong><?php slang('deadline'); ?>:</strong></td><td><?php echo date('d/m/Y', strtotime($row->deadline)); ?></td></tr>
						<tr><td><strong><?php slang('contacts'); ?>:</strong></td><td><?php echo implode(', ', $contacts); ?></td></tr>
						<?php if($row->status == 1) { ?>
						<tr><td><strong><?php slang('date_completed'); ?>:</strong></td><td><?php if($row->date_completed == '') echo '-'; else echo date('d/m/Y H:i', strtotime($row->date_completed)); ?></td></tr>
						<?php } ?>
						<tr><td><strong><?php slang('notes'); ?>:</strong></td><td><?php echo nl2br($row->notes); ?></td></tr>
					</table>
				</div>
			</div>	
		</div>			
	</div>
	<div class="modal-footer">
		<?php if($privs->delete_tasks == 1 && $row->user == $user->id) { ?>
			<a href="<?php echo $appURL; ?>tasks?delete=<?php echo $row->id; ?>" class="btn btn-danger"><?php slang('DELETE'); ?></a>
		<?php } ?>
		<?php if($privs->edit_tasks == 1 && $row->user == $user->id) { ?>
			<a style="cursor: pointer" onclick="editTask(<?php echo $row->id; ?>)" class="btn btn-warning"><?php slang('EDIT'); ?></a>
		<?php } ?>
		<?php if($row->status == 0 && ($row->user == $user->id || $row->recipients == '-'.$user->id.'-' || strpos($row->recipients, '-'.$user->id.'-') !== false)) { ?>
			<a href="<?php echo $appURL; ?>tasks?complete=<?php echo $row->id; ?>" class="btn btn-success"><?php slang('complete'); ?></a>
		<?php } ?>
		<button type="button" class="btn btn-default" data-dismiss="modal"><?php slang('CANCEL'); ?></button>
	</div>
	<?php
	exit();
}
elseif(isset($_POST['edit_task'])){
	$row = fetchRow('tasks', '*', 'id = ?', array($_POST['edit_task']));
	if(!isset($row->id))
		exit();
	?>
	<input type="hidden" name="id" value="<?php echo $row->id; ?>">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="field-1" class="control-label"><?php slang('task_name'); ?></label>
				<input type="text" name="title" class="form-control" id="field-1" placeholder="<?php slang('task_name_placeholder'); ?>" required required autocomplete="off" value="<?php echo $row->title; ?>">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="field-2" class="control-label"><?php slang('deadline'); ?></label>
				<input type="text" name="deadline" class="form-control datepicker2" id="field-2" placeholder="<?php slang('deadline_placeholder'); ?>" required autocomplete="off" value="<?php echo date('d/m/Y', strtotime($row->deadline)); ?>"> </div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label for="field-4" class="control-label"><?php slang('recipients'); ?></label>
				<select name="recipients[]" data-placeholder="<?php slang('recipients_placeholder'); ?>" multiple class="form-control select3" id="field-4" placeholder="<?php slang('recipients_placeholder'); ?>" required>
				
				<?php 
				$values = fetchTable('users', 'id, CONCAT(name, \' \', surname) as full_name');
				foreach($values as $value){
					if($row->recipients == '-'.$value->id.'-' || strpos($row->recipients, '-'.$value->id.'-') !== false){
						echo '<option value="'.$value->id.'" selected>'.$value->full_name.'</option>';
					}
					else {
						echo '<option value="'.$value->id.'">'.$value->full_name.'</option>';
					}

				}
				?>
				
				</select>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label for="field-3" class="control-label"><?php slang('contacts'); ?></label>
				<select name="contacts[]" multiple class="form-control select2_ajax_tags2" class="form-control" id="field-3" data-placeholder="<?php slang('contacts_placeholder'); ?>">
				<?php
				foreach(explode('-', $row->contacts) as $value){
					if($value != ''){
						$val = fetchRow('contacts', 'id, name, surname', 'id = ?', array($value));
						echo '<option value="'.$val->id.'" selected>'.$val->surname.' '.$val->name.'</option>';
					}
				}
				?>
				
				</select>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="form-group no-margin">
				<label class="control-label"><?php slang('status'); ?></label>
				<select class="form-control select3" name="status" required>
					<option value="0"<?php if($row->status == 0) echo ' selected'; ?>><?php slang('in_progress'); ?></option>
					<option value="1"<?php if($row->status == 1) echo ' selected'; ?>><?php slang('completed'); ?></option>
				</select>
			</div>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-12">
			<div class="form-group no-margin">
				<label for="field-7" class="control-label"><?php slang('notes'); ?></label>
				<textarea class="form-control autogrow" name="notes" id="field-7" placeholder="<?php slang('notes_placeholder'); ?>"><?php echo $row->notes; ?></textarea>
			</div>
		</div>
	</div>

	<?php
	exit();
}
if(isset($_POST['add'])){
	$data = array(
		'user'=>$user->id,
		'date_created'=>date('Y-m-d H:i:s', time()),
		'title'=>$_POST['title'],
		'status'=>0,
		'contacts'=>'',
		'recipients'=>''
	);
	if(isset($_POST['notes']))
		$data['notes'] = $_POST['notes'];
	$dtime = DateTime::createFromFormat("d/m/Y", $_POST['deadline']);
	$timestamp = $dtime->getTimestamp();
	$data['deadline'] = date('Y-m-d H:i:s', $timestamp);

	foreach($_POST['contacts'] as $val){
		$data['contacts'] .= '-'.$val.'-';
	}
	foreach($_POST['recipients'] as $val){
		$data['recipients'] .= '-'.$val.'-';
	}
	if($db->insert('tasks', $data))
		$success = lang('task_created');
}
elseif(isset($_GET['delete']) && $privs->delete_tasks == 1){
	if($db->delete('tasks', array('id'=>$_GET['delete'])))
		$success = lang('task_deleted');
}
elseif(isset($_GET['complete'])){
	if($db->update('tasks', array('status'=>1, 'date_completed'=>date('Y-m-d H:i:s', time())), array('id'=>$_GET['complete'])))
		$success = lang('task_completed');
}
elseif(isset($_POST['edit']) && $privs->edit_tasks == 1 && isset($_POST['id'])){
	$sql = 'SELECT * FROM tasks WHERE id = ?';
	$params = array($_POST['id']);
	$row = $db->row($sql, $params);
	if(isset($row->id)){
		$data = array(
			'title'=>$_POST['title'],
			'notes'=>$_POST['notes'],
			'status'=>$_POST['status'],
			'contacts'=>'',
			'recipients'=>''
		);
		if($row->status != $data['status']){
			if($data['status'] == 1){
				$data['date_completed'] = date('Y-m-d H:i:s', time());
			}
			else {
				$data['date_completed'] = null;
			}
		}
		$dtime = DateTime::createFromFormat("d/m/Y", $_POST['deadline']);
		$timestamp = $dtime->getTimestamp();
		$data['deadline'] = date('Y-m-d H:i:s', $timestamp);
		foreach($_POST['contacts'] as $val){
			$data['contacts'] .= '-'.$val.'-';
		}
		foreach($_POST['recipients'] as $val){
			$data['recipients'] .= '-'.$val.'-';
		}
		if($db->update('tasks', $data, array('id'=>$row->id)))
			$success = lang('task_updated');
	}
}