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
				<a data-toggle="modal" data-target="#add-modal" class="btn btn-success pull-right">Νέο κατάλυμα</a>
			<?php } ?>
			</div>
		</div>
		
		<br />
		
		<div class="table-responsive">
			<table class="table table-bordered datatable" id="table-1">
				<thead>
					<tr>
						<th>Τίτλος</th>
						<th>Τύπος</th>
						<th>Όροφος</th>
						<th>Κρεβάτια</th>
						<th>Ιδιοκτήτης</th>
						<th>Πόλη</th>
						<th>Διεύθυνση</th>
					</tr>
				</thead>
				<tbody>
					
				</tbody>
				<tfoot>
					<tr>
						<th>Τίτλος</th>
						<th>Τύπος</th>
						<th>Όροφος</th>
						<th>Κρεβάτια</th>
						<th>Ιδιοκτήτης</th>
						<th>Πόλη</th>
						<th>Διεύθυνση</th>
					</tr>
				</tfoot>
			</table>
		</div>
		
		<br />
<?php if($privs->add_contacts == 1) { ?>	
<div class="modal fade" id="add-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
			<form action="<?php echo $appURL.$controllerName; ?>" method="post" id="add-new-form" enctype="multipart/form-data">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Νέο κατάλυμα</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Τίτλος</label>
								<input type="text" class="form-control" name="title" required placeholder="Εισάγετε έναν τίτλο για το κατάλυμα">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Ιδιοκτήτης</label>
								<select name="contact" class="form-control select2_ajax_tags" required>
									<option value="">Επιλογή</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label">Τύπος</label>
								<select name="type" class="form-control select2" required>
									<option value="">Επιλογή</option>
									<?php echo arrayToSelect(fetchTable('property_types'), 'id', 'name'); ?>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label">Όροφος</label>
								<select name="floor" class="form-control select2" required>
									<option value="">Επιλογή</option>
									<?php echo arrayToSelect(fetchTable('property_floors'), 'id', 'name'); ?>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label">Εμβαδόν</label>
								<input type="number" min="0" class="form-control" name="size" required placeholder="Εισάγετε το εμβαδόν του καταλύματος">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label"><?php slang('address'); ?></label>
								<input type="text" autocomplete="off" name="address" class="form-control" id="address-map" placeholder="<?php slang('address_placeholder'); ?>" required> </div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label class="control-label">Πόλη</label>
								<input type="text" autocomplete="off" name="city" class="form-control" id="city" placeholder="Εισάγετε την πόλη" required> </div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label class="control-label">T.K.</label>
								<input type="text" id="postal" name="postal" class="form-control" placeholder="Εισάγετε τον Τ.Κ." required> 
							</div>
						</div>
						<div class="col-md-3">
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
								<label class="control-label">Διπλά κρεβάτια</label>
								<select name="double_beds" class="form-control select2" required>
									<option value="">Επιλογή</option>
									<?php
									for($i = 0; $i <= 20; $i++)
										echo '<option value="'.$i.'">'.$i.'</option>';
									?>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label">Μονά κρεβάτια</label>
								<select name="single_beds" class="form-control select2" required>
									<option value="">Επιλογή</option>
									<?php
									for($i = 0; $i <= 20; $i++)
										echo '<option value="'.$i.'">'.$i.'</option>';
									?>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label">Ράντζα / Καναπέδες</label>
								<select name="sofa_beds" class="form-control select2" required>
									<option value="">Επιλογή</option>
									<?php
									for($i = 0; $i <= 20; $i++)
										echo '<option value="'.$i.'">'.$i.'</option>';
									?>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label class="control-label">Ενήλικες</label>
								<select name="udults" class="form-control select2" required>
									<option value="">Επιλογή</option>
									<?php
									for($i = 0; $i <= 20; $i++)
										echo '<option value="'.$i.'">'.$i.'</option>';
									?>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label class="control-label">Παιδιά</label>
								<select name="children" class="form-control select2" required>
									<option value="">Επιλογή</option>
									<?php
									for($i = 0; $i <= 20; $i++)
										echo '<option value="'.$i.'">'.$i.'</option>';
									?>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label class="control-label">Κουζίνα</label>
								<select name="kitchen" class="form-control select2" required>
									<option value="">Επιλογή</option>
									<option value="0">Όχι</option>
									<option value="1">Ναι</option>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label class="control-label">Κατοικίδια</label>
								<select name="pets" class="form-control select2" required>
									<option value="">Επιλογή</option>
									<option value="0">Απαγορεύονται</option>
									<option value="1">Επιτρέπονται</option>
								</select>
							</div>
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
					<div class="row">
						<div class="col-md-12">
							<div id="map" style="height: 300px; margin-top: 10px; margin-bottom: 10px;">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Συντεταγμένες (latitude)</label>
								<input type="text" required class="form-control" name="latitude" id="latitude">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Συντεταγμένες (longitude)</label>
								<input type="text" required class="form-control" name="longitude" id="longitude">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<fieldset class="form-fieldset mg-t-30">
								<legend>Φωτογραφίες</legend>
								<div class="wd-md-50p mg-l-auto mg-r-auto">
									<input type="file" class="photos_upload" name="files">
								</div>
							</fieldset>
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
	var _latitude = '40.00589835907488';
    var _longitude = '23.561965196728536';
	google.maps.event.addDomListener(window, 'load', initSubmitMap(_latitude,_longitude));
    function initSubmitMap(_latitude,_longitude){
		var mapCenter = new google.maps.LatLng(_latitude,_longitude);
        var mapOptions = {
            zoom: 15,
            center: mapCenter,
            disableDefaultUI: false,
            styles: mapStyles
        };
        var mapElement = document.getElementById('map');
        var map = new google.maps.Map(mapElement, mapOptions);
		var marker = new MarkerWithLabel({
            position: mapCenter,
            map: map,
            labelAnchor: new google.maps.Point(50, 0),
            draggable: true
        });
		google.maps.event.addListener(marker, "mouseup", function (event) {
            var latitude = this.position.lat();
            var longitude = this.position.lng();
            $('#latitude').val( this.position.lat() );
            $('#longitude').val( this.position.lng() );
        });
		var input = /** @type {HTMLInputElement} */( document.getElementById('address-map') );
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);
        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                return;
            }
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);
            $('#latitude').val( marker.getPosition().lat() );
            $('#longitude').val( marker.getPosition().lng() );
            var address = '';
            if (place.address_components) {
                address = [
                    (place.address_components[0] && place.address_components[0].short_name || ''),
                    (place.address_components[1] && place.address_components[1].short_name || ''),
                    (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
				console.log(place.address_components);
				$('#address-map').val((place.address_components[1].short_name.replace( /\s/g, "")) +' '+(place.address_components[0].short_name.replace( /\s/g, "")));
				if(place.address_components[2].short_name)
					$('#city').val((place.address_components[2].short_name.replace( /\s/g, "")));
				if(place.address_components[5].short_name)
					$('#postal').val((place.address_components[5].short_name.replace( /\s/g, "")));
            }
        });
	}
		
		jQuery( document ).ready( function( $ ) {
			
			$('.photos_upload').fileuploader({
				addMore: true,
				captions: {
					button: function(options) {
						return 'Επιλέξτε ' + (options.limit == 1 ? 'αρχείο' : 'αρχεία');
					},
					feedback: function(options) {
						return 'Επιλέξτε ' + (options.limit == 1 ? 'αρχείο' : 'αρχεία') + ' για ανέβασμα';
					},
					feedback2: function(options) {
						return options.length + ' ' + (options.length > 1 ? 'αρχεία' : 'αρχείο') + ' επιλέχτηκαν';
					},
					confirm: 'Επιβεβαίωση',
					cancel: 'Ακύρωση',
					name: 'Όνομα',
					type: 'Τύπος',
					size: 'Μέγεθος',
					dimensions: 'Διαστάσεις',
					duration: 'Διάρκεια',
					crop: 'Crop',
					rotate: 'Rotate',
					sort: 'Sort',
					download: 'Λήψη',
					remove: 'Διαγραφή',
					drop: 'Σύρετε εδώ τα αρχεία προς ανέβασμα',
					paste: '<div class="fileuploader-pending-loader"></div> Γίνεται επικόλληση αρχείου. Πατήστε εδώ για ακύρωση.',
					removeConfirmation: 'Θέλετε να αφαιρέσετε το αρχείο;',
					errors: {
						filesLimit: function(options) {
							return 'Μόνο ${limit} ' + (options.limit == 1 ? 'αρχείο' : 'αρχεία') + ' επιτρέπονται.'
						},
						filesType: 'Μόνο τύποι ${extensions} αρχείων επιτρέπονται.',
						fileSize: 'Το ${name} είναι πολύ μεγάλο! Παρακαλούμε επιλέξτε αρχεία έως και ${fileMaxSize}MB.',
						filesSizeAll: 'Τα επιλεγμένα αρχεία είναι πολύ μεγάλα! Παρακαλούμε επιλέξτε αρχεία έως και ${maxSize} MB.',
						fileName: 'Ένα αρχείο με όνομα ${name} είναι ήδη επιλεγμένο.',
						remoteFile: 'Τα απομακρυσμένα αρχεία δεν υποστηρίζονται.',
						folderUpload: 'Το ανέβασμα φακέλων δεν υποστηρίζεται.'
					}
				}
			});
			
			var thisAjaxUrl = '<?php echo $appURL; ?>contacts?load-names=1';
			$('.select2_ajax_tags').select2({
				tokenSeparators: [','],
				ajax: { 
					url: thisAjaxUrl,
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
				   url: "<?php echo $appURL; ?>properties",
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
		<?php if(isset($_GET['newClient'])) {
			$contact = fetchRow('contacts', 'id,name,surname', 'id = ?', array($_GET['newClient']));
			if(isset($contact->id)){ ?>
			$('.select2_ajax_tags').html('<option value="<?php echo $contact->id; ?>" selected><?php echo $contact->surname.' '.$contact->name; ?></option>');
			$('.select2_ajax_tags').trigger('change');
			setTimeout(function(){ $('#add-modal').modal('show'); }, 600);
			
		<?php }} ?>
		</script>
  </body>
</html>