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
		
		</div>
		
		<hr />
		
	
		