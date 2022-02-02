<?php loadHeader($title, $styles, $extra_css); ?>	  
<ol class="breadcrumb bc-3" >
	<li>
		<a href="<?php echo $appURL; ?>"><?php slang('HOME'); ?></a>
	</li>
	<li>
		<a href="<?php echo $appURL; ?>users"><?php slang('USERS'); ?></a>
	</li>
	<li class="active">
		<strong><?php echo $contact->surname.' '.$contact->name; ?></strong>
	</li>
</ol>
				
		
		<ul class="nav nav-tabs bordered"><!-- available classes "bordered", "right-aligned" -->
			<li class="active">
				<a href="#tab1" data-toggle="tab">
					<span><?php slang('user_info'); ?></span>
				</a>
			</li>
			
			<?php if($privs->edit_users == 1) { ?>
			<li>
				<a href="#tab2" data-toggle="tab">
					<span><?php slang('change_password'); ?></span>
				</a>
			</li>
			<?php } ?>
			<li>
				<a href="#tab3" data-toggle="tab">
					<span><?php slang('action_history'); ?></span>
				</a>
			</li>
		</ul>
		
		<div class="tab-content">
			<div class="tab-pane active" id="tab1">
				<div class="row">
					<div class="col-xs-12">
						<h2><?php slang('user_info'); ?></h2>
					</div>
				</div>
				<br>
				<?php if($privs->edit_users == 1) { ?>
				<form action="<?php echo $appURL.$controllerName; ?>/view/<?php echo $contact->id; ?>" method="post" id="editTab1">
				<?php } ?>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="field-1" class="control-label"><?php slang('name'); ?></label>
								<input required type="text" name="name" class="form-control" placeholder="<?php slang('name_placeholder'); ?>" value="<?php echo $contact->name; ?>"> 
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="field-1" class="control-label"><?php slang('surname'); ?></label>
								<input required type="text" name="surname" class="form-control" placeholder="<?php slang('surname_placeholder'); ?>" value="<?php echo $contact->surname; ?>"> 
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="field-3" class="control-label"><?php slang('EMAIL'); ?></label>
								<input required type="email" name="email" class="form-control" placeholder="<?php slang('email_placeholder'); ?>" value="<?php echo $contact->email; ?>"> 
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="field-4" class="control-label"><?php slang('mobile'); ?></label>
								<input required type="text" name="mobile" class="form-control" placeholder="<?php slang('mobile_placeholder'); ?>" value="<?php echo $contact->mobile; ?>"> 
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="field-3" class="control-label"><?php slang('username'); ?></label>
								<input required type="text" name="username" class="form-control" placeholder="<?php slang('username_placeholder'); ?>" value="<?php echo $contact->username; ?>"> 
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="field-2" class="control-label"><?php slang('usergroup'); ?></label>
								<select name="usergroup" class="form-control select2" data-allow-clear="true" data-placeholder="<?php slang('select_usergroup'); ?>" required>
									<option value=""><?php slang('select_usergroup'); ?></option>
									<?php
									echo arrayToSelect($usergroups, 'id', 'name', null, array($contact->usergroup));
									?>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="field-2" class="control-label"><?php slang('status'); ?></label>
								<select name="status" class="form-control select2" data-allow-clear="true" data-placeholder="<?php slang('select_status'); ?>" required>
									<option value=""><?php slang('select_status'); ?></option>
									<option value="0"<?php if($contact->status == 0) echo ' selected'; ?>><?php slang('inactive'); ?></option>
									<option value="1"<?php if($contact->status == 1) echo ' selected'; ?>><?php slang('active'); ?></option>
								</select>
							</div>
						</div>
					</div>
					
				<?php if($privs->edit_users == 1) { ?>
					<div class="row">
						<div class="col-xs-12">
							<div class="form-group">
								<button type="submit" name="save_tab1" value="1" class="btn btn-success"><?php slang('SAVE'); ?></button>
							</div>
						</div>
					</div>
				</form>
				<?php } ?>
			</div>
			<?php if($privs->edit_users == 1) { ?>
			<div class="tab-pane" id="tab2">
				<div class="row">
					<div class="col-xs-12">
						<h2><?php slang('change_password'); ?></h2>
					</div>
				</div>
				<br>
				<form action="<?php echo $appURL.$controllerName; ?>/view/<?php echo $contact->id; ?>" method="post" id="editTab2">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="field-11" class="control-label"><?php slang('new_password'); ?></label>
								<input type="password" name="pass1" class="form-control" id="field-11" placeholder="<?php slang('insert_new_password'); ?>" required autocomplete="off"> </div>
						</div>
						<div class="col-md-6">
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
			<?php } ?>
			<div class="tab-pane" id="tab3">
				<div class="row">
					<div class="col-xs-12">
						<h2><?php slang('action_history'); ?></h2>
					</div>
				</div>
				<br>
				<div class="table-responsive">
					<table class="table table-bordered datatable" id="table-1">
						<thead>
							<tr>
								<th><?php slang('date'); ?></th>
								<th><?php slang('controller'); ?></th>
								<th><?php slang('action'); ?></th>
								<th><?php slang('old_value'); ?></th>
								<th><?php slang('new_value'); ?></th>
							</tr>
						</thead>
						<tbody>
							
						</tbody>
						<tfoot>
							<tr>
								<th><?php slang('date'); ?></th>
								<th><?php slang('controller'); ?></th>
								<th><?php slang('action'); ?></th>
								<th><?php slang('old_value'); ?></th>
								<th><?php slang('new_value'); ?></th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
			
		</div>
		
		<br />
		

		

<?php
	endBody(); 
	loadScripts($scripts); ?>
<script type="text/javascript">
jQuery( document ).ready( function( $ ) {
	var $table1 = jQuery( '#table-1' );
	
	// Initialize DataTable
	$table1.DataTable( {
		"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		dom: 'lBfrtip',
		buttons: [
			'excelHtml5',
			'csvHtml5',
			'pdfHtml5'
		],
		"aaSorting": [], 
		"bSortClasses": false,
		"processing": true,
		"serverSide": true,
		"aLengthMenu": [[10, 25, 50, 100,500,1000,2000], [10, 25, 50,100,500,1000,2000]],
		"ajax": {
			url: "<?php echo $appURL; ?>users/view/<?php echo $contact->id; ?>",
			type: 'POST',
			data: {  
				'show-table': 1			
			}
				
		},
		"language": {
			"sDecimal":           ",",
			"sEmptyTable":        "<?php slang('sEmptyTable'); ?>",
			"sInfo":              "<?php slang('sInfo'); ?>",
			"sInfoEmpty":         "<?php slang('sInfoEmpty'); ?>",
			"sInfoFiltered":      "<?php slang('sInfoFiltered'); ?>",
			"sInfoPostFix":       "",
			"sInfoThousands":     ".",
			"sLengthMenu":        "<?php slang('sLengthMenu'); ?>",
			"sLoadingRecords":    "<?php slang('sLoadingRecords'); ?>",
			"sProcessing":        "<?php slang('sProcessing'); ?>",
			"sSearch":            "<?php slang('sSearch'); ?>",
			"sSearchPlaceholder": "<?php slang('sSearchPlaceholder'); ?>",
			"sThousands":         ".",
			"sUrl":               "",
			"sZeroRecords":       "<?php slang('sZeroRecords'); ?>",
			"oPaginate": {
				"sFirst":    "<i class=\"os-icon os-icon-arrow-left5\"></i>",
				"sPrevious": "<i class=\"os-icon os-icon-arrow-left3\"></i>",
				"sNext":     "<i class=\"os-icon os-icon-arrow-right\"></i>",
				"sLast":     "<i class=\"os-icon os-icon-arrow-right3\"></i>",
				"sPage":     "<?php slang('sPage'); ?>",
				"sOf":     "<?php slang('sOf'); ?>"
			},
			"oAria": {
				"sSortAscending":  "<?php slang('sSortAscending'); ?>",
				"sSortDescending": "<?php slang('sSortDescending'); ?>"
			},
			buttons: {
				copy: '<?php slang('copy'); ?>',
				copyTitle: '<?php slang('copyTitle'); ?>',
				copySuccess: {
					_: '<?php slang('copySuccess1'); ?>',
					1: '<?php slang('copySuccess2'); ?>'
				},
				excel: '<?php slang('excel'); ?>',
				csv: '<?php slang('csv'); ?>',
				pdf: '<?php slang('pdf'); ?>',
				colvis: '<?php slang('colvis'); ?>'
			}
		}
	});
	
	// Initalize Select Dropdown after DataTables is created
	$table1.closest( '.dataTables_wrapper' ).find( 'select' ).select2( {
		minimumResultsForSearch: -1
	});
} );
</script>
  </body>
</html>