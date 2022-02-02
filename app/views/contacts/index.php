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
			<?php if($privs->add_contacts == 1) { ?>
				<a data-toggle="modal" data-target="#add-modal" class="btn btn-success pull-right"><?php slang('new_contact'); ?></a>
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
						<th><?php slang('status'); ?></th>
						<th><?php slang('mobile'); ?></th>
						<th><?php slang('email'); ?></th>
						<th><?php slang('date_created'); ?></th>
					</tr>
				</thead>
				<tbody>
					
				</tbody>
				<tfoot>
					<tr>
						<th><?php slang('id'); ?></th>
						<th><?php slang('name'); ?></th>
						<th><?php slang('surname'); ?></th>
						<th><?php slang('status'); ?></th>
						<th><?php slang('mobile'); ?></th>
						<th><?php slang('email'); ?></th>
						<th><?php slang('date_created'); ?></th>
					</tr>
				</tfoot>
			</table>
		</div>
		
		<br />
<?php if($privs->add_contacts == 1) { ?>	
<div class="modal fade" id="add-modal">
    <div class="modal-dialog">
        <div class="modal-content">
			<form action="<?php echo $appURL.$controllerName; ?>" method="post" id="add-new-form">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title"><?php slang('new_contact'); ?></h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="field-1" class="control-label"><?php slang('name'); ?></label>
								<input type="text" name="name" class="form-control" id="field-1" placeholder="<?php slang('name_placeholder'); ?>">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="field-2" class="control-label"><?php slang('surname'); ?></label>
								<input type="text" name="surname" class="form-control" id="field-2" placeholder="<?php slang('surname_placeholder'); ?>"> </div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label"><?php slang('status'); ?></label>
								<select name="status" class="form-control select2" required>
									<option value=""><?php slang('select_status'); ?></option>
									<?php for($i = 0; $i <= 2; $i++){ 
										echo '<option value="'.$i.'">'.lang('status_'.$i).'</option>';
									} ?>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8">
							<div class="form-group">
								<label for="field-3" class="control-label"><?php slang('address'); ?></label>
								<input type="text" name="address" class="form-control" id="field-3" placeholder="<?php slang('address_placeholder'); ?>"> </div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label"><?php slang('country'); ?></label>
								<select name="country" class="form-control select2" data-allow-clear="true" data-placeholder="<?php slang('select_country'); ?>" required>
								<option value=""><?php slang('select_country'); ?></option>
								<?php echo arrayToSelect(fetchTable('countries'), 'code', 'name', null, array('GR')); ?>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="field-4" class="control-label"><?php slang('phone'); ?></label>
								<input type="text" name="phone" class="form-control" id="field-4" placeholder="<?php slang('phone_placeholder'); ?>"> </div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="field-5" class="control-label"><?php slang('mobile'); ?></label>
								<input type="text" name="mobile" class="form-control" id="field-5" placeholder="<?php slang('mobile_placeholder'); ?>"> </div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="field-6" class="control-label"><?php slang('email'); ?></label>
								<input type="email" name="email" class="form-control" id="field-6" placeholder="<?php slang('email_placeholder'); ?>"> </div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group no-margin">
								<label for="field-7" class="control-label"><?php slang('notes'); ?></label>
								<textarea class="form-control autogrow" name="info" id="field-7" placeholder="<?php slang('notes_placeholder'); ?>"></textarea>
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
				   url: "<?php echo $appURL; ?>contacts",
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
			$table1.closest( '.dataTables_wrapper' ).find( 'select' ).css( 'height', '30px');
		} );
		</script>
  </body>
</html>