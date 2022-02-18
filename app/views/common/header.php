<?php
$sql = "SELECT calendar.id as id, contacts.name as name, calendar.notes, calendar.date as date, calendar.contact, contacts.phone as phone, contacts.mobile as mobile, contacts.surname as surname, calendar.status FROM `calendar` LEFT JOIN contacts ON calendar.contact = contacts.id WHERE calendar.status = ? AND calendar.date <= NOW() ORDER BY calendar.date ASC";
$params = array(0);
$rows = $db->fetch($sql, $params);
?><div class="main-content">
			
		<div class="row">
		
			<!-- Profile Info and Notifications -->
			<div class="col-md-6 col-sm-8 clearfix">
		
				<ul class="user-info pull-left pull-right-xs pull-none-xsm">
		
					<!-- Raw Notifications -->
					<li class="notifications dropdown">
		
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
							<i class="entypo-calendar"></i>
							<?php if(Count($rows) > 0) echo '<span class="badge badge-secondary">'.Count($rows).'</span>'; ?>
						</a>

						<ul class="dropdown-menu">
							<?php 
							if(Count($rows) == 0) {
								echo '
							<li class="top">
								<p class="small">
									<a href="'.$appURL.'calendar" class="pull-right">'.lang('VIEW_ALL').'</a>
									'.lang('NO_CALENDAR_WARNINGS').'
								</p>
							</li>';
							}
							else {
								echo '<li>
								<ul class="dropdown-menu-list scroller">';
								foreach($rows as $row) {
									echo '<li class="unread notification-success">
									<a href="'.$appURL.'calendar?show='.$row->id.'">
										<i class="entypo-calendar pull-right"></i>
										
										<span class="line">
											<strong>'.$row->surname.' '.$row->name.'</strong>
										</span>
										
										<span class="line small">
											'.date('d/m/Y H:i', strtotime($row->date)).'
										</span>
									</a>
								</li>';

								}
								echo '</ul></li>';
							}
							?>
							
						</ul>
		
					</li>
					<?php
$sql = "SELECT tasks.id as id, tasks.title as title, tasks.deadline as deadline FROM tasks WHERE tasks.deadline < ? AND tasks.status = ? ORDER BY tasks.deadline ASC";
$params = array(date('Y-m-d', time()).' 00:00:00', 0);
$rows = $db->fetch($sql, $params);
?>		
					<!-- Message Notifications -->
					<li class="notifications dropdown">
		
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
							<i class="entypo-bell"></i>
							<?php if(Count($rows) > 0) echo '<span class="badge badge-secondary">'.Count($rows).'</span>'; ?>
						</a>
		
						<ul class="dropdown-menu">
							<?php 
							if(Count($rows) == 0) {
								echo '
							<li class="top">
								<p class="small">
									<a href="'.$appURL.'tasks" class="pull-right">'.lang('VIEW_ALL').'</a>
									'.lang('NO_TASK_WARNINGS').'
								</p>
							</li>';
							}
							else {
								echo '
							<li class="top">
								<p class="small">
									<a href="'.$appURL.'tasks" class="pull-right">'.lang('VIEW_ALL').'</a>
									'.lang('UNFINISHED_TASKS', Count($rows)).'
								</p>
							</li>
							<li>
								<ul class="dropdown-menu-list scroller">';
								foreach($rows as $row) {
									echo '<li class="unread notification-success">
									<a href="'.$appURL.'tasks?show='.$row->id.'">
										<i class="entypo-bell pull-right"></i>
										
										<span class="line">
											<strong>'.$row->title.'</strong>
										</span>
										
										<span class="line small">
											'.date('d/m/Y', strtotime($row->deadline)).'
										</span>
									</a>
								</li>';

								}
								echo '</ul></li>';
							}
							?>
						</ul>
		
					</li>
		
				</ul>
				<!-- <div class="col-md-2">
					<a data-toggle="modal" data-target="#transaction-modal">
						<button>Transactions</button>
					</a>
				</div> -->
			</div>
		
			

					
			
			<!-- Raw Links -->
			<div class="col-md-6 col-sm-4 clearfix hidden-xs">
				
				<ul class="user-info pull-right pull-none-xsm">

					<!-- Profile Info -->
					<li class="profile-info dropdown"><!-- add class "pull-right" if you want to place this from right -->
		
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<img src="assets/images/avatars/<?php if($user->avatar != '') echo $user->avatar; else echo 'member.jpg'; ?>" alt="" class="img-circle" width="44" />
							<?php echo $user->name.' '.$user->surname; ?>
						</a>
		
						<ul class="dropdown-menu">
		
							<!-- Reverse Caret -->
							<li class="caret"></li>
		
							<!-- Profile sub-links -->
							<li>
								<a href="<?php echo $appURL; ?>profile">
									<i class="entypo-user"></i>
									<?php slang('EDIT_PROFILE'); ?>
								</a>
							</li>
		
							<li>
								<a href="<?php echo $appURL; ?>login/logout">
									<i class="entypo-clipboard"></i>
									<?php slang('LOGOUT'); ?>
								</a>
							</li>
						</ul>
					</li>
		
				</ul>
		
				<ul class="list-inline links-list pull-right">
		
					<!-- Language Selector -->
					<li class="dropdown language-selector">
		
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true">
							<img src="assets/images/flags/flag-<?php echo $user->lang; ?>.png" width="16" height="16" />
						</a>
		
						<ul class="dropdown-menu pull-right">
							<li>
								<a href="<?php echo $appURL; ?>dashboard?setLang=de">
									<img src="assets/images/flags/flag-de.png" width="16" height="16" />
									<span>Deutsch</span>
								</a>
							</li>
							<li class="active">
								<a href="<?php echo $appURL; ?>dashboard?setLang=en">
									<img src="assets/images/flags/flag-en.png" width="16" height="16" />
									<span>English</span>
								</a>
							</li>
							<li>
								<a href="<?php echo $appURL; ?>dashboard?setLang=el">
									<img src="assets/images/flags/flag-el.png" width="16" height="16" />
									<span>Ελληνικά</span>
								</a>
							</li>
						</ul>
		
					</li>
				</ul>
		
			</div>

			<!-- transaction section -->
			<div class="col-md-2">
					<a data-toggle="modal" data-target="#transaction-modal">
						<button>Transactions</button>
					</a>
			</div>

			<div class="modal fade" id="transaction-modal">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<form action="<?php echo $appURL; ?>properties" method="post" id="transactions-form" enctype="multipart/form-data">
						<div id="msg" style=" width:100%;padding: 2% 20%;opacity:0;text-align:center;position:absolute;transition:.5s;border-radius:3px;color:black"></div>
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title">Συναλλαγές</h4>
							</div>
							<div class="modal-body">
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">	
											<label class="control-label">Επιλέξτε ακίνητο *</label>
											<select name="property_id" class="form-control" id="property_id" required>
												<option value="0" default>Επιλογή</option>
												<?php
												$sql = "SELECT id, `title`, `address` FROM properties ORDER BY title ASC";
												$rows = $db->fetch($sql);
												foreach($rows as $row){
													echo '<option value="'.$row->id.'">'.$row->title.' - '.$row->address.'</option>';
												}
												?>
											</select>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">	
											<label class="control-label">Τύπος συναλλαγής *</label>
											<select name="type" class="form-control" id="select" required>
												<option value="0" default>Επιλογή</option>
												<option value="income">Έσοδα</option>
												<option value="expenses">Έξοδα</option>
											</select>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">	
											<label class="control-label">Κατηγορία *</label>
											<select name="category" id="category" class="form-control" value="s"required>
												<option value="0" default>Επιλογή</option>
												<option value="1">Κατηγορία 1</option>
												<option value="2">Κατηγορία 2</option>
												<option value="3">Κατηγορία 3</option>
												<option value="4">Κατηγορία 4</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Περιγραφή *</label>
											<input type="text" id="description" class="form-control" name="description" required placeholder="Εισάγετε περιγραφή της συναλλαγής">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Ποσο *</label>
											<input type="number" min='0' class="form-control" id="amount" name="amount" required placeholder="Ποσό συναλλαγής">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Ποσο που έχει καλυφθεί </label>
											<input type="number" min='0' class="form-control" name="paid_amount" id="paid_amount" placeholder="Ποσο που έχει καλυφθεί">
										</div>
									</div>

								</div>
								<div class="row">
									<div class="col-md-12">
										<fieldset class="form-fieldset mg-t-30">
											<legend>Φωτογραφίες</legend>
											<div class="wd-md-50p mg-l-auto mg-r-auto">
												<input type="file" class="photos_upload" id="file" name="files">
											</div>
										</fieldset>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal"><?php slang('CANCEL'); ?></button>
								<button type="submit" name="add-transaction" id="more-transaction" value="1" class="btn btn-danger"><?php slang('ADD'); ?> </button>
								<button type="submit" name="add-transaction" value="1" class="btn btn-info"><?php slang('SAVE'); ?></button>
							</div>
						</form>
					</div>
				</div>
			</div>	

		</div>
		
		
		<hr>
		
	
		