<?php loadHeader($title, $styles, $extra_css); ?>	  
<ol class="breadcrumb bc-3" >
	<li>
		<a href="<?php echo $appURL; ?>"><?php slang('HOME'); ?></a>
	</li>
	<li class="active">
		<strong><?php echo $title; ?></strong>
	</li>
</ol>
				
		
		<ul class="nav nav-tabs bordered"><!-- available classes "bordered", "right-aligned" -->
			<li class="active">
				<a href="#tab1" data-toggle="tab">
					<span><?php slang('personal_info'); ?></span>
				</a>
			</li>
			<li>
				<a href="#tab2" data-toggle="tab">
					<span><?php slang('change_password'); ?></span>
				</a>
			</li>
		</ul>
		
		<div class="tab-content">
			<div class="tab-pane active" id="tab1">
				<div class="row">
					<div class="col-xs-12">
						<h2><?php slang('personal_info'); ?></h2>
					</div>
				</div>
				<br>
				<form action="<?php echo $appURL; ?>profile" method="post" id="editTab1">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="field-1" class="control-label"><?php slang('name'); ?></label>
								<input type="text" name="name" class="form-control" id="field-1" placeholder="<?php slang('insert_name'); ?>" value="<?php echo $user->name; ?>" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="field-2" class="control-label"><?php slang('surname'); ?></label>
								<input type="text" name="surname" class="form-control" id="field-2" placeholder="<?php slang('insert_surname'); ?>" value="<?php echo $user->surname; ?>" required> </div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="field-8" class="control-label"><?php slang('mobile'); ?></label>
								<input type="text" name="mobile" class="form-control" id="field-8" placeholder="<?php slang('insert_mobile'); ?>" value="<?php echo $user->mobile; ?>"> </div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="field-9" class="control-label"><?php slang('EMAIL'); ?></label>
								<input type="email" name="email" class="form-control" id="field-9" placeholder="<?php slang('insert_email'); ?>" value="<?php echo $user->email; ?>"> </div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<div class="form-group">
								<button type="submit" name="save_tab1" value="1" class="btn btn-success"><?php slang('SAVE'); ?></button>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="tab-pane" id="tab2">
				<div class="row">
					<div class="col-xs-12">
						<h2><?php slang('change_password'); ?></h2>
					</div>
				</div>
				<br>
				<form action="<?php echo $appURL; ?>profile" method="post" id="editTab2">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="field-10" class="control-label"><?php slang('current_password'); ?></label>
								<input type="password" name="password" class="form-control" id="field-10" placeholder="<?php slang('insert_current_password'); ?>" required autocomplete="off">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="field-11" class="control-label"><?php slang('new_password'); ?></label>
								<input type="password" name="pass1" class="form-control" id="field-11" placeholder="<?php slang('insert_new_password'); ?>" required autocomplete="off"> </div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="field-12" class="control-label"><?php slang('new_password_repeat'); ?></label>
								<input type="password" name="pass2" class="form-control" id="field-12" placeholder="<?php slang('insert_new_password_repeat'); ?>" required autocomplete="off">
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-xs-12">
							<div class="form-group">
								<button type="submit" name="save_tab2" value="1" class="btn btn-success"><?php slang('SAVE'); ?></button>
							</div>
						</div>
					</div>
				</form>
			</div>
			
		</div>
		
		<br />
		

		

<?php
	endBody(); 
	loadScripts($scripts); ?>
  </body>
</html>