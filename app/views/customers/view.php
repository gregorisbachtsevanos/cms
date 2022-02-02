<?php loadHeader($title, $styles, $extra_css); ?>	  
<ol class="breadcrumb bc-3" >
	<li>
		<a href="<?php echo $appURL; ?>"><?php slang('HOME'); ?></a>
	</li>
	<li>
		<a href="<?php echo $appURL; ?><?php echo $controllerName; ?>"><?php slang('CUSTOMERS'); ?></a>
	</li>
	<li class="active">
		<strong><?php echo $title; ?></strong>
	</li>
</ol>
				
		
		<ul class="nav nav-tabs bordered"><!-- available classes "bordered", "right-aligned" -->
			<li class="active">
				<a href="#tab1" data-toggle="tab">
					<span><?php slang('contact_info'); ?></span>
				</a>
			</li>
			<li>
				<a href="#tab3" data-toggle="tab">
					<span>Κρατήσεις</span>
				</a>
			</li>
			<?php if($privs->view_notes == 1) { ?>
			<li>
				<a href="#tab2" data-toggle="tab">
					<span><?php slang('notes'); ?></span>
				</a>
			</li>
			<?php } ?>
		</ul>
		
		<div class="tab-content">
			<div class="tab-pane active" id="tab1">
				<div class="row">
					<div class="col-xs-12">
						<h2><?php slang('contact_info'); ?></h2>
					</div>
				</div>
				<br>
				<?php if($privs->edit_contacts == 1) { ?>
				<form action="<?php echo $appURL.$controllerName; ?>/view/<?php echo $contact->id; ?>" method="post" id="editC">
				<?php } ?>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="field-1" class="control-label"><?php slang('name'); ?></label>
								<input type="text" name="name" class="form-control" id="field-1" placeholder="<?php slang('name_placeholder'); ?>" value="<?php echo $contact->name; ?>">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="field-2" class="control-label"><?php slang('surname'); ?></label>
								<input type="text" name="surname" class="form-control" id="field-2" placeholder="<?php slang('surname_placeholder'); ?>" value="<?php echo $contact->surname; ?>"> </div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label"><?php slang('status'); ?></label>
								<select name="status" class="form-control select2" data-allow-clear="true" data-placeholder="<?php slang('select_status'); ?>" required>
									<option value="0"<?php if($contact->status == '0') echo ' selected'; ?>><?php slang('status_inactive'); ?></option>
									<option value="1"<?php if($contact->status == '1') echo ' selected'; ?>><?php slang('status_lead'); ?></option>
									<option value="2"<?php if($contact->status == '2') echo ' selected'; ?>><?php slang('status_active'); ?></option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8">
							<div class="form-group">
								<label for="field-3" class="control-label"><?php slang('address'); ?></label>
								<input type="text" name="address" class="form-control" id="field-3" placeholder="<?php slang('address_placeholder'); ?>" value="<?php echo $contact->address; ?>"> 
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="field-9" class="control-label"><?php slang('country'); ?></label>
								<select name="country" class="form-control select2" data-allow-clear="true" data-placeholder="<?php slang('select_country'); ?>" required>
								<option value=""><?php slang('select_country'); ?></option>
								<?php echo arrayToSelect(fetchTable('countries'), 'code', 'name', null, array($contact->country)); ?>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="field-4" class="control-label"><?php slang('phone'); ?></label>
								<input type="text" name="phone" class="form-control" id="field-4" placeholder="<?php slang('phone_placeholder'); ?>" value="<?php echo $contact->phone; ?>"> </div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="field-5" class="control-label"><?php slang('mobile'); ?></label>
								<input type="text" name="mobile" class="form-control" id="field-5" placeholder="<?php slang('mobile_placeholder'); ?>" value="<?php echo $contact->mobile; ?>"> </div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="field-6" class="control-label"><?php slang('email'); ?></label>
								<input type="email" name="email" class="form-control" id="field-6" placeholder="<?php slang('email_placeholder'); ?>" value="<?php echo $contact->email; ?>"> </div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="field-7" class="control-label"><?php slang('notes'); ?></label>
								<textarea class="form-control autogrow" name="info" id="field-7" placeholder="<?php slang('notes_placeholder'); ?>"><?php echo $contact->info; ?></textarea>
							</div>
						</div>
					</div>
				<?php if($privs->edit_contacts == 1) { ?>
					<div class="row">
						<div class="col-xs-6">
							<div class="form-group">
								<button type="submit" name="edit" value="1" class="btn btn-success"><?php slang('SAVE'); ?></button>
							</div>
						</div>
						<?php if($privs->delete_contacts == 1) { ?>
						<div class="col-xs-6 text-right">
							<div class="form-group text-right">
								<a data-toggle="modal" data-target="#delete" class="btn btn-danger"><?php slang('DELETE'); ?></a>
							</div>
						</div>
						<?php } ?>
					</div>
				</form>
				<?php } ?>
			</div>
			<div class="tab-pane" id="tab3">
				<div class="row">
					<div class="col-xs-12 col-sm-6">
						<h2>Κρατήσεις</h2>
					</div>
					<div class="col-xs-12 col-sm-6">
						<a href="<?php echo $appURL; ?>bookings?newCustomer=<?php echo $contact->id; ?>" class="btn btn-success pull-right">Νέα κράτηση</a>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-bordered datatable" id="table-3">
								<thead>
									<tr>
										<th>Κωδικός</th>
										<th>Πελάτης</th>
										<th>Ακίνητο</th>
										<th>Ημ/νία κράτησης</th>
										<th>Άφιξη</th>
										<th>Αναχώρηση</th>
										<th>Ποσό</th>
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
										<th>Κατάσταση</th>
										<th>Πηγή</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
			<?php if($privs->view_notes == 1) { ?>
			<div class="tab-pane" id="tab2">
				<div class="row">
					<div class="col-xs-12 col-sm-6">
						<h2><?php slang('notes'); ?></h2>
					</div>
					<div class="col-xs-12 col-sm-6">
						<a data-toggle="modal" data-target="#add-note" class="btn btn-success pull-right"><?php slang('add_note'); ?></a>
					</div>
				</div>
				<br>
				<div class="row">
				
					<ul class="cbp_tmtimeline">
					<?php 
					foreach($notes as $note){
						echo '<li>
						<time class="cbp_tmtime"><span class="large">'.date('d/m/Y', strtotime($note->date)).'</span></time>
						
						<div class="cbp_tmicon bg-success">
							<i class="entypo-user"></i>
						</div>
						
						<div class="cbp_tmlabel">
							<button onclick="editNote('.$note->id.')" class="btn btn-warning btn-xs" style="position: absolute;top: 0;right: 0;"><i class="entypo-pencil"></i></button>
							<p>'.nl2br($note->info).'</p>
						</div>
					</li>
						';
					} 
					?>
						
					</ul>
				</div>
			</div>
			<?php } ?>
			
		</div>
		
		<br />
		
<?php if($privs->delete_contacts == 1) { ?>
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><?php slang('delete_client'); ?></h4>
			</div>
			<div class="modal-body">
				<p><?php slang('delete_client_info1'); ?></p>
				
				<p><?php slang('delete_confirm'); ?></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php slang('CANCEL'); ?></button>
				<a href="<?php echo $appURL.$controllerName; ?>?delete=<?php echo $contact->id; ?>" class="btn btn-danger"><?php slang('DELETE'); ?></a>
			</div>
        </div>
    </div>
</div>
<?php } ?>
<?php if($privs->add_notes == 1) { ?>
<div class="modal fade" id="add-note">
    <div class="modal-dialog">
        <div class="modal-content">
			<form action="<?php echo $appURL.$controllerName; ?>/view/<?php echo $contact->id; ?>" method="post" id="add-note-form">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title"><?php slang('add_note'); ?></h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label"><?php slang('date'); ?></label>
								<input required type="text" name="date" class="form-control datepicker" value="<?php echo date('d/m/Y', time()); ?>"> 
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label"><?php slang('notes'); ?></label>
								<textarea name="info" class="form-control" required></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><?php slang('CANCEL'); ?></button>
					<button type="submit" name="add_note" value="1" class="btn btn-info"><?php slang('SAVE'); ?></button>
				</div>
			</form>
        </div>
    </div>
</div>	
<?php } ?>
<?php if($privs->edit_notes == 1) { ?>
<div class="modal fade" id="edit-note">
    <div class="modal-dialog">
        <div class="modal-content">
			<form action="<?php echo $appURL.$controllerName; ?>/view/<?php echo $contact->id; ?>" method="post" id="edit-note-form">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title"><?php slang('edit_note'); ?></h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label"><?php slang('date'); ?></label>
								<input required type="text" name="date" class="form-control datepicker" id="edit_note_date"> 
							</div>
						</div>
					</div>
					<input type="hidden" name="id" required id="edit_note_id">
					<input type="hidden" name="contact" value="<?php echo $contact->id; ?>">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label"><?php slang('notes'); ?></label>
								<textarea name="info" class="form-control" id="edit_note_info" required></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><?php slang('CANCEL'); ?></button>
					<?php if($privs->delete_notes == 1) { ?>
					<button type="button" class="btn btn-danger" id="delete_note_btn"><?php slang('DELETE'); ?></button>
					<?php } ?>
					<button type="submit" name="edit_note" value="1" class="btn btn-info"><?php slang('SAVE'); ?></button>
				</div>
			</form>
        </div>
    </div>
</div>	
<?php } ?>
<?php if($privs->delete_notes == 1) { ?>
<div class="modal fade" id="delete_note">
    <div class="modal-dialog">
        <div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><?php slang('delete_note'); ?></h4>
			</div>
			<div class="modal-body">
				<p><?php slang('delete_confirm'); ?></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php slang('CANCEL'); ?></button>
				<a href="#" class="btn btn-danger" id="delete_note_button"><?php slang('DELETE'); ?></a>
			</div>
        </div>
    </div>
</div>
<?php } ?>	

<?php
	endBody(); 
	loadScripts($scripts); ?>
	
	<script type="text/javascript">
	function editNote(id){
		$("#delete_note_button").attr("href", "<?php echo $appURL; ?>customers/view/<?php echo $contact->id; ?>?delete_note="+id);
		$.post('<?php echo $appURL; ?>customers/view/<?php echo $contact->id; ?>', {load_note_data: id}, function (data){
			data = $.parseJSON(data);
			$('#edit_note_date').val(data.date);
			$('#edit_note_info').val(data.info);
			$('#edit_note_id').val(data.id);
			$('#edit-note').modal('show');
			$('#delete_note_btn').on('click', function (e){
				$('#edit-note').modal('hide');
				setTimeout(function(){ $('#delete_note').modal('show'); }, 500);
				
			});
		});
	}
	$('.select2').select2();
	var $table3 = jQuery( '#table-3' );
			
			// Initialize DataTable
	$table3.DataTable( {
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
				'show-table': 1,
				'customer': <?php echo $contact->id; ?>
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
	$table3.closest( '.dataTables_wrapper' ).find( 'select' ).css( 'height', '30px');
	</script>
  </body>
</html>