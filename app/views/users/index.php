<?php loadHeader($title, $styles, $extra_css); ?>	  
<ol class="breadcrumb bc-3" >
	<li>
		<a href="<?php echo $appURL; ?>"><i class="fa-home"></i><?php slang('HOME'); ?></a>
	</li>
	<li class="active">
		<strong><?php echo $title; ?></strong>
	</li>
</ol>
					
		<div class="row">
			<div class="col-xs-6">
				<h2><?php echo $title; ?></h2>
			</div>
			<div class="col-xs-6 text-right">
				<?php if($privs->add_users == 1) { ?>
				<a data-toggle="modal" data-target="#add-modal" class="btn btn-success pull-right"><?php slang('new_user'); ?></a>
				<?php } ?>
			</div>
		</div>
		
		<br />
		
		<div class="table-responsive">
			<table class="table table-bordered datatable" id="table-1">
				<thead>
					<tr>
						<th><?php slang('id'); ?></th>
						<th><?php slang('name'); ?></th>
						<th><?php slang('surname'); ?></th>
						<th><?php slang('username'); ?></th>
						<th><?php slang('mobile'); ?></th>
						<th><?php slang('email'); ?></th>
						<th><?php slang('usergroup'); ?></th>
						<th><?php slang('last_login'); ?></th>
					</tr>
				</thead>
				<tbody>
					
				</tbody>
				<tfoot>
					<tr>
						<th><?php slang('id'); ?></th>
						<th><?php slang('name'); ?></th>
						<th><?php slang('surname'); ?></th>
						<th><?php slang('username'); ?></th>
						<th><?php slang('mobile'); ?></th>
						<th><?php slang('email'); ?></th>
						<th><?php slang('usergroup'); ?></th>
						<th><?php slang('last_login'); ?></th>
					</tr>
				</tfoot>
			</table>
		</div>
		
		<br />
<?php if($privs->add_users == 1) { ?>
<div class="modal fade" id="add-modal">
    <div class="modal-dialog">
        <div class="modal-content">
			<form action="<?php echo $appURL.$controllerName; ?>" method="post" id="add-new-form">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title"><?php slang('new_user'); ?></h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="field-1" class="control-label"><?php slang('name'); ?></label>
								<input required type="text" name="name" class="form-control" placeholder="<?php slang('name_placeholder'); ?>"> 
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="field-1" class="control-label"><?php slang('surname'); ?></label>
								<input required type="text" name="surname" class="form-control" placeholder="<?php slang('surname_placeholder'); ?>"> 
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="field-3" class="control-label"><?php slang('EMAIL'); ?></label>
								<input required type="email" name="email" class="form-control" placeholder="<?php slang('email_placeholder'); ?>"> 
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="field-4" class="control-label"><?php slang('mobile'); ?></label>
								<input required type="text" name="mobile" class="form-control" placeholder="<?php slang('mobile_placeholder'); ?>"> 
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="field-3" class="control-label"><?php slang('username'); ?></label>
								<input required type="text" name="username" class="form-control" placeholder="<?php slang('username_placeholder'); ?>"> 
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="field-2" class="control-label"><?php slang('usergroup'); ?></label>
								<select name="usergroup" class="form-control" required>
									<option value=""><?php slang('select_usergroup'); ?></option>
									<?php
									echo arrayToSelect($usergroups, 'id', 'name');
									?>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="field-3" class="control-label"><?php slang('password1'); ?></label>
								<input required type="password" name="password1" class="form-control" placeholder="<?php slang('password1_placeholder'); ?>"> 
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="field-4" class="control-label"><?php slang('password2'); ?></label>
								<input required type="password" name="password2" class="form-control" placeholder="<?php slang('password2_placeholder'); ?>"> 
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><?php slang('CANCEL'); ?></button>
					<button type="submit" name="add" value="1" class="btn btn-info"><?php slang('SAVE'); ?></button>
				</div>
			</form>
        </div>
    </div>
</div>			
<?php } ?>	

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
				   url: "<?php echo $appURL.$controllerName; ?>",
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