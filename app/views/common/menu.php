<div class="sidebar-menu">

		<div class="sidebar-menu-inner">
			
			<header class="logo-env">

				<!-- logo -->
				<div class="logo">
					<a href="<?php echo $appURL; ?>">
						<img class="visible-lg visible-md hidden-sm hidden-xs" src="<?php echo 'assets/images/' . $companyLogo; ?>" width="161" alt="<?php echo $appName; ?>" />
						<img class="visible-xs visible-sm hidden-md hidden-lg" src="assets/images/logo-mobile.png" width="161" alt="<?php echo $appName; ?>" />
					</a>
				</div>

				<!-- logo collapse icon -->
				<div class="sidebar-collapse">
					<a href="#" class="sidebar-collapse-icon"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
						<i class="entypo-menu"></i>
					</a>
				</div>

								
				<!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
				<div class="sidebar-mobile-menu visible-xs">
					<a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
						<i class="entypo-menu"></i>
					</a>
				</div>

			</header>
			
									
			<ul id="main-menu" class="main-menu">
				<!-- add class "multiple-expanded" to allow multiple submenus to open -->
				<!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
				<li<?php if($controllerName == 'dashboard') echo ' class="active"'; ?>>
					<a href="<?php echo $appURL; ?>dashboard">
						<i class="entypo-monitor"></i>
						<span class="title"><?php slang('HOME'); ?></span>
					</a>
				</li>
				<?php if($privs->view_properties == 1) { ?>
				<li<?php if($controllerName == 'properties') echo ' class="active"'; ?>>
					<a href="<?php echo $appURL; ?>properties">
						<i class="entypo-home"></i>
						<span class="title"><?php slang('PROPERTIES'); ?></span>
					</a>
				</li>
				<?php } ?>
				<?php if($privs->view_contacts == 1) { ?>
				<li<?php if($controllerName == 'contacts') echo ' class="active"'; ?>>
					<a href="<?php echo $appURL; ?>contacts">
						<i class="entypo-users"></i>
						<span class="title"><?php slang('CONTACTS'); ?></span>
					</a>
				</li>
				<?php } ?>
				<?php if($privs->view_contacts == 1) { ?>
				<li<?php if($controllerName == 'customers') echo ' class="active"'; ?>>
					<a href="<?php echo $appURL; ?>customers">
						<i class="entypo-users"></i>
						<span class="title"><?php slang('CUSTOMERS'); ?></span>
					</a>
				</li>
				<?php } ?>
				<li<?php if($controllerName == 'bookings') echo ' class="active"'; ?>>
					<a href="<?php echo $appURL; ?>bookings">
						<i class="entypo-calendar"></i>
						<span class="title"><?php slang('BOOKINGS'); ?></span>
					</a>
				</li>
				<?php if($privs->view_users == 1) { ?>
				<li<?php if($controllerName == 'users') echo ' class="active"'; ?>>
					<a href="<?php echo $appURL; ?>users">
						<i class="entypo-flow-tree"></i>
						<span class="title"><?php slang('USERS'); ?></span>
					</a>
				</li>
				<?php } ?>
				<li>
					<a href="<?php echo $appURL; ?>login/logout">
						<i class="entypo-logout"></i>
						<span class="title"><?php slang('LOGOUT'); ?></span>
					</a>
				</li>
			</ul>
			
		</div>

	</div>