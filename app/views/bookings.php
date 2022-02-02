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
				<a data-toggle="modal" data-target="#add-modal" class="btn btn-success pull-right">Νέα κράτηση</a>
			</div>
		</div>
		
		<br />
		
		<div class="table-responsive">
			<table class="table table-bordered datatable" id="table-1">
				<thead>
					<tr>
						<th>Κωδικός</th>
						<th>Πελάτης</th>
						<th>Ακίνητο</th>
						<th>Ημ/νία κράτησης</th>
						<th>Άφιξη</th>
						<th>Αναχώρηση</th>
						<th>Ποσό</th>
						<th>Υπόλοιπο</th>
						<th>Κατάσταση</th>
						<th>Πηγή</th>
					</tr>
				</thead>
				<tbody>
					
				</tbody>
				<tfoot>
					<tr>
						<th>Κωδικός</th>
						<th>Πελάτης</th>
						<th>Ακίνητο</th>
						<th>Ημ/νία κράτησης</th>
						<th>Άφιξη</th>
						<th>Αναχώρηση</th>
						<th>Ποσό</th>
						<th>Υπόλοιπο</th>
						<th>Κατάσταση</th>
						<th>Πηγή</th>
					</tr>
				</tfoot>
			</table>
		</div>
		
		<br />
<div class="modal fade" id="add-modal">
    <div class="modal-dialog">
        <div class="modal-content">
			<form action="<?php echo $appURL.$controllerName; ?>" method="post" id="add-new-form">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Νέα κράτηση</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Πελάτης</label>
								<select name="customer" class="form-control select2_ajax_tags_customer" required>
									<option value="">Επιλογή</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Ακίνητο</label>
								<select name="property" class="form-control select2_ajax_tags_property" required>
									<option value="">Επιλογή</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Άφιξη</label>
								<input type="text" name="date_starting" class="form-control datepicker" placeholder="Ημερομηνία άφιξης" required> 
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Αναχώρηση</label>
								<input type="text" name="date_ending" class="form-control datepicker" placeholder="Ημερομηνία αναχώρησης" required> 
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Ημερομηνία κράτησης</label>
								<input type="text" name="date_booked" class="form-control datepicker" placeholder="Ημερομηνία κράτησης" required> 
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Πηγή</label>
								<select name="source" class="form-control select2" data-allow-clear="true" data-placeholder="Επιλέξτε πηγή" required>
								<option value="">Επιλέξτε πηγή</option>
								<?php echo arrayToSelect(fetchTable('bookings_sources'), 'id', 'name'); ?>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label">Κατάσταση</label>
								<select name="status" class="form-control select2" data-allow-clear="true" data-placeholder="Επιλέξτε πηγή" required>
								<option value="">Επιλέξτε κατάσταση</option>
								<?php echo arrayToSelect(fetchTable('bookings_statuses'), 'id', 'name'); ?>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label">Ποσό (€)</label>
								<input type="text" name="amount" class="form-control" placeholder="Εισάγετε το ποσό"> </div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label">Πληρώθηκε (€)</label>
								<input type="text" name="paid" value="0" class="form-control" placeholder="Εισάγετε το ποσό"> </div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">Χρέωση καθαριότητας (€)</label>
								<input type="text" name="cleaning_fee" class="form-control" placeholder="Εισάγετε το ποσό"> 
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group no-margin">
								<label class="control-label">Σημειώσεις</label>
								<textarea class="form-control autogrow" name="notes" placeholder="Εισάγετε σημειώσεις"></textarea>
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
<div class="modal fade" id="edit-modal">
    <div class="modal-dialog">
        <div class="modal-content">
			<form action="<?php echo $appURL.$controllerName; ?>" method="post" id="edit-new-form">
				<input type="hidden" name="id" required id="edit_id">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Προβολή κράτησης</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Πελάτης</label>
								<select name="customer" class="form-control select2_ajax_tags_customer2" required id="edit_customer">
									<option value="">Επιλογή</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Ακίνητο</label>
								<select name="property" class="form-control select2_ajax_tags_property2" required id="edit_property">
									<option value="">Επιλογή</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Άφιξη</label>
								<input type="text" name="date_starting" class="form-control datepicker" placeholder="Ημερομηνία άφιξης" required id="edit_date_starting"> 
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Αναχώρηση</label>
								<input type="text" name="date_ending" class="form-control datepicker" placeholder="Ημερομηνία αναχώρησης" required id="edit_date_ending"> 
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Ημερομηνία κράτησης</label>
								<input type="text" name="date_booked" class="form-control datepicker" placeholder="Ημερομηνία κράτησης" required id="edit_date_booked"> 
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Πηγή</label>
								<select name="source" class="form-control select2" data-allow-clear="true" data-placeholder="Επιλέξτε πηγή" required id="edit_source">
								<option value="">Επιλέξτε πηγή</option>
								<?php echo arrayToSelect(fetchTable('bookings_sources'), 'id', 'name'); ?>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label">Κατάσταση</label>
								<select name="status" class="form-control select2" data-allow-clear="true" data-placeholder="Επιλέξτε πηγή" required id="edit_status">
								<option value="">Επιλέξτε κατάσταση</option>
								<?php echo arrayToSelect(fetchTable('bookings_statuses'), 'id', 'name'); ?>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label">Ποσό (€)</label>
								<input type="text" name="amount" class="form-control" placeholder="Εισάγετε το ποσό" id="edit_amount"> </div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label">Πληρώθηκε (€)</label>
								<input type="text" name="paid" class="form-control" placeholder="Εισάγετε το ποσό" id="edit_paid"> </div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">Χρέωση καθαριότητας (€)</label>
								<input type="text" name="cleaning_fee" class="form-control" placeholder="Εισάγετε το ποσό" id="edit_cleaning_fee"> 
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group no-margin">
								<label class="control-label">Σημειώσεις</label>
								<textarea class="form-control autogrow" name="notes" placeholder="Εισάγετε σημειώσεις" id="edit_notes"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<a class="btn btn-danger" id="del_button"><?php slang('DELETE'); ?></a>
					<button type="button" class="btn btn-default" data-dismiss="modal"><?php slang('CANCEL'); ?></button>
					<button type="submit" name="edit" value="1" class="btn btn-info"><?php slang('SAVE'); ?></button>
				</div>
			</form>
        </div>
    </div>
</div>		

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
				   url: "<?php echo $appURL; ?>bookings",
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
			
			
			
			var thisAjaxUrl1 = '<?php echo $appURL; ?>customers?load-names=1';
			$('.select2_ajax_tags_customer').select2({
				tokenSeparators: [','],
				ajax: { 
					url: thisAjaxUrl1,
					type: "post",
					dataType: 'json',
					delay: 250,
					data: function (params) {
						return {
							searchTerm: params.term // search term
						};
					},
					processResults: function (response) {
						return {
							results: response
						};
					},
					cache: true
				}
			});
			$('.select2_ajax_tags_customer2').select2({
				tokenSeparators: [','],
				ajax: { 
					url: thisAjaxUrl1,
					type: "post",
					dataType: 'json',
					delay: 250,
					data: function (params) {
						return {
							searchTerm: params.term // search term
						};
					},
					processResults: function (response) {
						return {
							results: response
						};
					},
					cache: true
				}
			});
			var thisAjaxUrl2 = '<?php echo $appURL; ?>properties?load-names=1';
			$('.select2_ajax_tags_property').select2({
				tokenSeparators: [','],
				ajax: { 
					url: thisAjaxUrl2,
					type: "post",
					dataType: 'json',
					delay: 250,
					data: function (params) {
						return {
							searchTerm: params.term // search term
						};
					},
					processResults: function (response) {
						return {
							results: response
						};
					},
					cache: true
				}
			});
			$('.select2_ajax_tags_property2').select2({
				tokenSeparators: [','],
				ajax: { 
					url: thisAjaxUrl2,
					type: "post",
					dataType: 'json',
					delay: 250,
					data: function (params) {
						return {
							searchTerm: params.term // search term
						};
					},
					processResults: function (response) {
						return {
							results: response
						};
					},
					cache: true
				}
			});
		} );
		
		function showBooking(id){
			$.post('<?php echo $appURL; ?>bookings', {show: id}, function(data){
				var obj = jQuery.parseJSON(data);
				$('#edit_id').val(obj.id);
				$('#del_button').attr("href", "<?php echo $appURL; ?>bookings?delete="+obj.id);
				$('#edit_customer').html(obj.customer).trigger('change');
				$('#edit_property').html(obj.property).trigger('change');
				$('#edit_notes').val(obj.notes);
				$('#edit_amount').val(obj.amount);
				$('#edit_cleaning_fee').val(obj.cleaning_fee);
				$('#edit_paid').val(obj.paid);
				$('#edit_date_starting').val(obj.date_starting);
				$('#edit_date_ending').val(obj.date_ending);
				$('#edit_date_booked').val(obj.date_booked);
				$('#edit_source').val(obj.source).trigger('change');
				$('#edit_status').val(obj.status).trigger('change');
				$('#edit-modal').modal('show');
			});
		}
		$('#del_button').on('click', function(e){
			if(!confirm('Είστε σίγουρος πως θέλετε να διαγράψετε την κράτηση;'))
				return false;
		});
		<?php if(isset($_GET['view'])) { echo 'setTimeout(function(){ showBooking('.$_GET['view'].'); }, 500);'; } ?>
		
		<?php if(isset($_GET['newCustomer'])) {
			$contact = fetchRow('customers', 'id,name,surname', 'id = ?', array($_GET['newCustomer']));
			if(isset($contact->id)){ ?>
			$('.select2_ajax_tags_customer').html('<option value="<?php echo $contact->id; ?>" selected><?php echo $contact->surname.' '.$contact->name; ?></option>');
			$('.select2_ajax_tags_customer').trigger('change');
			setTimeout(function(){ $('#add-modal').modal('show'); }, 600);
			
		<?php }} ?>
		<?php if(isset($_GET['newProperty'])) {
			$property = fetchRow('properties', 'id,title', 'id = ?', array($_GET['newProperty']));
			if(isset($property->id)){ ?>
			$('.select2_ajax_tags_property').html('<option value="<?php echo $property->id; ?>" selected><?php echo $property->title; ?></option>');
			$('.select2_ajax_tags_property').trigger('change');
			setTimeout(function(){ $('#add-modal').modal('show'); }, 600);
			
		<?php }} ?>
		</script>
  </body>
</html>