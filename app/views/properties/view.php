<?php loadHeader($title, $styles, $extra_css); ?>	  
<ol class="breadcrumb bc-3" >
	<li>
		<a href="<?php echo $appURL; ?>"><?php slang('HOME'); ?></a>
	</li>
	<li>
		<a href="<?php echo $appURL; ?><?php echo $controllerName; ?>"><?php slang('PROPERTIES'); ?></a>
	</li>
	<li class="active">
		<strong><?php echo $title; ?></strong>
	</li>
</ol>
				
		
		<ul class="nav nav-tabs bordered"><!-- available classes "bordered", "right-aligned" -->
			<li class="active">
				<a href="#tab1" data-toggle="tab">
					<span>Στοιχεία καταλύματος</span>
				</a>
			</li>
			<li>
				<a href="#tab3" data-toggle="tab">
					<span>Φωτογραφίες</span>
				</a>
			</li>
			<li>
				<a href="#tab4" data-toggle="tab">
					<span>Κρατήσεις</span>
				</a>
			</li>
			<li>
				<a href="#tab5" data-toggle="tab">
					<span>Ημερολόγιο</span>
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
						<h2>Στοιχεία καταλύματος</h2>
					</div>
				</div>
				<br>
				<?php if($privs->edit_contacts == 1) { ?>
				<form action="<?php echo $appURL.$controllerName; ?>/view/<?php echo $property->id; ?>" method="post" id="editC">
				<?php } ?>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Τίτλος</label>
								<input type="text" class="form-control" name="title" required placeholder="Εισάγετε έναν τίτλο για το κατάλυμα" value="<?php echo $property->title; ?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Ιδιοκτήτης (<a target="_blank" href="<?php echo $appURL.'contacts/view/'.$owner->id.'">Προβολή</a>'; ?>)</label>
								<select name="contact" class="form-control select2_ajax_tags" required>
									<option value="<?php echo $owner->id; ?>"><?php echo $owner->surname.' '.$owner->name; ?></option>
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
									<?php echo arrayToSelect(fetchTable('property_types'), 'id', 'name', null, array($property->type)); ?>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label">Όροφος</label>
								<select name="floor" class="form-control select2" required>
									<option value="">Επιλογή</option>
									<?php echo arrayToSelect(fetchTable('property_floors'), 'id', 'name', null, array($property->floor)); ?>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label">Εμβαδόν</label>
								<input type="number" min="0" class="form-control" name="size" required placeholder="Εισάγετε το εμβαδόν του καταλύματος" value="<?php echo $property->size; ?>">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label"><?php slang('address'); ?></label>
								<input type="text" autocomplete="off" name="address" class="form-control" id="address-map" placeholder="<?php slang('address_placeholder'); ?>" required value="<?php echo $property->address; ?>"> </div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label class="control-label">Πόλη</label>
								<input type="text" autocomplete="off" name="city" class="form-control" id="city" placeholder="Εισάγετε την πόλη" required value="<?php echo $property->city; ?>"> </div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label class="control-label">T.K.</label>
								<input type="text" id="postal" name="postal" class="form-control" placeholder="Εισάγετε τον Τ.Κ." required value="<?php echo $property->postal; ?>"> 
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label class="control-label"><?php slang('country'); ?></label>
								<select name="country" class="form-control select2" data-allow-clear="true" data-placeholder="<?php slang('select_country'); ?>" required>
								<option value=""><?php slang('select_country'); ?></option>
								<?php echo arrayToSelect(fetchTable('countries'), 'code', 'name', null, array($property->country)); ?>
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
									for($i = 0; $i <= 20; $i++){
										if($i == $property->double_beds)
											echo '<option value="'.$i.'" selected>'.$i.'</option>';
										else
											echo '<option value="'.$i.'">'.$i.'</option>';
									}
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
									for($i = 0; $i <= 20; $i++){
										if($i == $property->single_beds)
											echo '<option value="'.$i.'" selected>'.$i.'</option>';
										else
											echo '<option value="'.$i.'">'.$i.'</option>';
									}
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
									for($i = 0; $i <= 20; $i++){
										if($i == $property->sofa_beds)
											echo '<option value="'.$i.'" selected>'.$i.'</option>';
										else
											echo '<option value="'.$i.'">'.$i.'</option>';
									}
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
									for($i = 0; $i <= 20; $i++){
										if($i == $property->udults)
											echo '<option value="'.$i.'" selected>'.$i.'</option>';
										else
											echo '<option value="'.$i.'">'.$i.'</option>';
									}
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
									for($i = 0; $i <= 20; $i++){
										if($i == $property->children)
											echo '<option value="'.$i.'" selected>'.$i.'</option>';
										else
											echo '<option value="'.$i.'">'.$i.'</option>';
									}
									?>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label class="control-label">Κουζίνα</label>
								<select name="kitchen" class="form-control select2" required>
									<option value="">Επιλογή</option>
									<option value="0"<?php if($property->kitchen == '0') echo ' selected'; ?>>Όχι</option>
									<option value="1"<?php if($property->kitchen == '1') echo ' selected'; ?>>Ναι</option>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label class="control-label">Κατοικίδια</label>
								<select name="pets" class="form-control select2" required>
									<option value="">Επιλογή</option>
									<option value="0"<?php if($property->pets == '0') echo ' selected'; ?>>Απαγορεύονται</option>
									<option value="1"<?php if($property->pets == '1') echo ' selected'; ?>>Επιτρέπονται</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group no-margin">
								<label for="field-7" class="control-label"><?php slang('notes'); ?></label>
								<textarea class="form-control autogrow" name="info" id="field-7" placeholder="<?php slang('notes_placeholder'); ?>"><?php echo $property->info; ?></textarea>
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
								<input type="text" required class="form-control" name="latitude" id="latitude" value="<?php echo $property->latitude; ?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Συντεταγμένες (longitude)</label>
								<input type="text" required class="form-control" name="longitude" id="longitude" value="<?php echo $property->longitude; ?>">
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
			<div class="tab-pane" id="tab5">
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<h2>Ημερολόγιο</h2>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-12">
						<div id="calendar"></div>
					</div>
				</div>
			</div>
			<div class="tab-pane" id="tab4">
				<div class="row">
					<div class="col-xs-12 col-sm-6">
						<h2>Κρατήσεις</h2>
					</div>
					<div class="col-xs-12 col-sm-6">
						<a href="<?php echo $appURL; ?>bookings?newProperty=<?php echo $property->id; ?>" class="btn btn-success pull-right">Νέα κράτηση</a>
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
			<div class="tab-pane" id="tab3">
				<div class="row">
					<div class="col-xs-12">
						<h2>Φωτογραφίες</h2>
					</div>
				</div>
				<br>
				<div class="row">
					<?php foreach($images as $image) {
						echo '<div class="col-md-4"><img src="'.$appUploads.$image->image.'" class="img-responsive"></div>';
					} ?>
				</div>
				<div class="row">
					<div class="col-md-12">
						<form action="<?php echo $appURL.$controllerName; ?>/view/<?php echo $property->id; ?>" method="post" id="addPhotos" enctype="multipart/form-data">
							<h3>Ανέβασμα νέων</h3>
							<fieldset class="mg-t-30">
								<div class="wd-md-50p mg-l-auto mg-r-auto">
									<input type="file" class="photos_upload" name="files">
								</div>
							</fieldset>
							<div class="col-xs-12 text-right">
								<div class="form-group">
									<button type="submit" name="add_photos" value="1" class="btn btn-success">Ανέβασμα</button>
								</div>
							</div>
						</form>
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
				<p>Διαγραφή καταλύματος</p>
				
				<p>Διαγράφοντας το κατάλυμα θα χάσετε όλες τις πληροφορίες του, όπως τις φωτογραφίες και τις κρατήσεις.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php slang('CANCEL'); ?></button>
				<a href="<?php echo $appURL.$controllerName; ?>?delete=<?php echo $property->id; ?>" class="btn btn-danger"><?php slang('DELETE'); ?></a>
			</div>
        </div>
    </div>
</div>
<?php } ?>
<?php if($privs->add_notes == 1) { ?>
<div class="modal fade" id="add-note">
    <div class="modal-dialog">
        <div class="modal-content">
			<form action="<?php echo $appURL.$controllerName; ?>/view/<?php echo $property->id; ?>" method="post" id="add-note-form">
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
			<form action="<?php echo $appURL.$controllerName; ?>/view/<?php echo $property->id; ?>" method="post" id="edit-note-form">
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
					<input type="hidden" name="property" value="<?php echo $property->id; ?>">
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
		});
	function editNote(id){
		$("#delete_note_button").attr("href", "<?php echo $appURL; ?>properties/view/<?php echo $property->id; ?>?delete_note="+id);
		$.post('<?php echo $appURL; ?>properties/view/<?php echo $property->id; ?>', {load_note_data: id}, function (data){
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
				'property': <?php echo $property->id; ?>
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
	$(document).ready(function () {
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            $('#calendar').fullCalendar('render');
        });
    });


	$('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay,listWeek'
        },
        defaultDate: '<?php echo date('Y-m-d', time()); ?>',
        <?php echo 'locale: \'el\','; ?>
        editable: false,
        navLinks: true, // can click day/week names to navigate views
        eventLimit: true, // allow "more" link when too many events
        selectable: true,
        selectHelper: true,
        timeFormat: 'HH:mm',
        defaultView: 'month',
        events: {
            url: '<?php echo $appURL; ?>bookings?show-calendar=<?php echo $property->id; ?>',
            error: function() {
                
            }
        },
        eventResize: function(event, delta, revertFunc) {
            console.log(event);
            //alert(event.id + ") " + event.title + " end is now " + event.end.format());

            if (!confirm("is this okay?")) {
                revertFunc();
            }

        },
        eventDrop: function(event, delta, revertFunc) {
            console.log(event);
           // alert(event.id + ") " + event.title + " was dropped on " + event.start.format());
            if (!confirm("Are you sure about this change?")) {
                revertFunc();
            }

        },
        eventClick: function(event, delta) {
            console.log(event);
            editCalendar(event.id);			
        },
        loading: function(bool) {
            //$('#loading').toggle(bool);
        }
    });
	</script>
  </body>
</html>