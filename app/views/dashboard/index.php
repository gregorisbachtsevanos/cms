<?php loadHeader($title, $styles, $extra_css, true); ?>	 
<div class="row">
			<div class="col-sm-3 col-xs-6">
		
				<div class="tile-stats tile-red">
					<div class="icon"><i class="entypo-users"></i></div>
					<div class="num" data-start="0" data-end="<?php echo $total_contacts; ?>" data-postfix="" data-duration="1500" data-delay="0">0</div>
		
					<h3>Ιδιοκτήτες μήνα</h3>
				</div>
		
			</div>
		
			<div class="col-sm-3 col-xs-6">
		
				<div class="tile-stats tile-green">
					<div class="icon"><i class="entypo-calendar"></i></div>
					<div class="num" data-start="0" data-end="<?php echo $total_customers; ?>" data-postfix="" data-duration="1500" data-delay="600">0</div>
		
					<h3>Πελάτες μήνα</h3>
				</div>
		
			</div>
			
			<div class="clear visible-xs"></div>
		
			<div class="col-sm-3 col-xs-6">
		
				<div class="tile-stats tile-aqua">
					<div class="icon"><i class="entypo-check"></i></div>
					<div class="num" data-start="0" data-end="<?php echo $total_properties; ?>" data-postfix="" data-duration="1500" data-delay="1200">0</div>
		
					<h3>Ακίνητα μήνα</h3>
				</div>
		
			</div>
		
			<div class="col-sm-3 col-xs-6">
		
				<div class="tile-stats tile-blue">
					<div class="icon"><i class="entypo-publish"></i></div>
					<div class="num" data-start="0" data-end="<?php echo $total_bookings; ?>" data-postfix="" data-duration="1500" data-delay="1800">0</div>
		
					<h3>Κρατήσεις μήνα</h3>
				</div>
		
			</div>
		</div>
		
		<br />
		
		<div class="row">
			<div class="col-sm-8">
		
				
		
				<div class="panel panel-primary">
					<div class="panel-heading">
						<div class="panel-title"><?php slang('announcements'); ?></div>
					</div>
					<div class="panel-body">
					<form id="newmsg" method="post" action="<?php echo $appURL; ?>dashboard" id="nMF">
						<textarea name="message" class="form-control wysiwyg" id="newmsgtext" rows=4 placeholder="<?php slang('publish_placeholder'); ?>"></textarea>
						<input type="hidden" name="parent" value="0">
						<input type="submit" class="btn btn-primary pull-right" name="newmsgbtn" value="<?php slang('publish'); ?>">
					</form>
					<br>
					<hr>
					<div class="steamline" id="steamline">
						
						<?php
						$sql = 'SELECT wall.message, wall.user, wall.date, wall.id, wall.parent, users.surname as surname, users.name as name FROM wall LEFT JOIN users ON wall.user = users.id WHERE wall.parent = ? ORDER BY id DESC LIMIT 0,5';
						$params = array(0);
						$rows = $db->fetch($sql, $params); 
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
						?>
					</div>
					<?php if(Count($rows) == 5) { ?><p id="loading" class="text-center">
						
						<span class="sr-only"><?php slang('please_wait'); ?></span>
					</p>
					<?php } ?>
					</div>
					
				</div>
		
			</div>
		
			<div class="col-sm-4">
				<div class="panel panel-primary" data-collapsed="0">
					
					<!-- panel head -->
					<div class="panel-heading">
						<div class="panel-title">Αφίξεις</div>
					</div>
					
					<!-- panel body -->
					<div class="panel-body">
						
						<table class="table">
							<thead>
								<th>Ακίνητο</th>
								<th><?php slang('contact'); ?></th>
								<th><?php slang('phones'); ?></th>
								<th><?php slang('status'); ?></th>
							</thead>
							<tbody>
							<?php foreach($incoming as $row){
								$phone = $row->phone;
								if($row->mobile != ''){
									if($phone != '')
										$phone .= ', '.$row->mobile;
									else
										$phone = $row->mobile;
								}
								echo '<tr>
								<td><a href="'.$appURL.'properties/view/'.$row->property.'">'.$row->title.'</a></td>
								<td><a href="'.$appURL.'customers/view/'.$row->customer.'">'.$row->surname.' '.$row->name.'</a></td>
								<td>'.$phone.'</td>
								<td>'.$row->status_name.'</td>
								</tr>';
							}?>
							</tbody>
						</table>
						
						
					</div>
					
				</div>
				<div class="panel panel-primary" data-collapsed="0">
					
					<!-- panel head -->
					<div class="panel-heading">
						<div class="panel-title">Αναχωρήσεις</div>
					</div>
					
					<!-- panel body -->
					<div class="panel-body">
						
						<table class="table">
							<thead>
								<th>Ακίνητο</th>
								<th><?php slang('contact'); ?></th>
								<th><?php slang('phones'); ?></th>
								<th><?php slang('status'); ?></th>
							</thead>
							<tbody>
							<?php foreach($leaving as $row){
								$phone = $row->phone;
								if($row->mobile != ''){
									if($phone != '')
										$phone .= ', '.$row->mobile;
									else
										$phone = $row->mobile;
								}
								echo '<tr>
								<td><a href="'.$appURL.'properties/view/'.$row->property.'">'.$row->title.'</a></td>
								<td><a href="'.$appURL.'customers/view/'.$row->customer.'">'.$row->surname.' '.$row->name.'</a></td>
								<td>'.$phone.'</td>
								<td>'.$row->status_name.'</td>
								</tr>';
							}?>
							</tbody>
						</table>
						
						
					</div>
					
				</div>
				
				
				
			</div>
		</div>
		
		<br />
		
<div id="editmsgmodal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
				 
		<form id="edmsg" method="post" action="<?php echo $appURL; ?>dashboard"> 
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title"><?php slang('edit_message'); ?></h4>
		  </div>
		  <div class="modal-body">
					<textarea name="message" class="form-control wysiwyg" id="editmsgtext" rows="10" style="height: 600px" placeholder="<?php slang('publish_placeholder'); ?>"></textarea>
					<input type="hidden" name="id" id="editmsgid" value="">
		  </div>
		  <div class="modal-footer">
			<button type="submit" class="btn btn-primary" name="editMsg" id="editMsg"><?php slang('SAVE'); ?></button> &nbsp; 
			<button type="button" class="btn btn-default" data-dismiss="modal"><?php slang('CANCEL'); ?></button>
		  </div>
		  
		</form>
    </div>

  </div>
</div>		
<div id="delMsgModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php slang('delete_message'); ?></h4>
      </div>
      <div class="modal-body">
        <p><?php slang('delete_message_confirm'); ?></p>
      </div>
      <div class="modal-footer" id="del-footer">
        
      </div>
    </div>

  </div>
</div>		
<?php

	endBody(); 
	loadScripts($scripts); ?>
	
<script type="text/javascript">
$(document).ready(function() {
	var win = $(window);
	var page = 0;
	var error = 0;
	// Each time the user scrolls
	win.scroll(function() {
	// End of the document reached?
		if(error == 0){
			if ($(document).height() - win.height() == win.scrollTop()) {
				$('#loading').show();
				page = page + 1;
				$.ajax({
					url: '<?php echo $appURL; ?>dashboard?show_wall=1',
					data: {page: page},
					success: function(html) {
						if(html == 'error'){
							error = 1;
							$('#loading').hide();
						}
						else {
							$('#steamline').append(html);
							$('#loading').hide();
						}
					}
				});
			}
		}
	});
});
function editMsg(id){
	$.post("<?php echo $appURL; ?>dashboard?edit-wall-msg", {id: id}, function(data){
	if(data == 'error')
		alert('Κάτι πήγε στραβά...');
	else {
		$('#editmsgtext').html(data);
		$('#editmsgid').val(id);
		$('#editmsgmodal').modal('toggle');
	}
	});
}
function delMsg(id) {
	$('#del-footer').html('<a href="<?php echo $appURL; ?>dashboard?delMsg=' + id + '" class="btn btn-primary"><?php slang('DELETE'); ?></a> <a class="btn btn-default" data-dismiss="modal"><?php slang('CANCEL'); ?></a>');
	$('#delMsgModal').modal();
}
</script>
  </body>
</html>
