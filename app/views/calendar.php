<?php loadHeader($title, $styles, $extra_css); ?>	  
<ol class="breadcrumb bc-3" >
	<li>
		<a href="<?php echo $appURL; ?>"><?php slang('HOME'); ?></a>
	</li>
	<li class="active">
		<strong><?php echo $title; ?></strong>
	</li>
</ol>
<a data-toggle="modal" data-target="#add-calendar" class="btn btn-success btn-sm pull-right" style="margin-left: 12px;"><?php slang('add_calendar'); ?></a>
<div id="calendar"></div>		
		
		
<?php if($privs->add_calendar == 1) { ?>
<div class="modal fade" id="add-calendar">
    <div class="modal-dialog">
        <div class="modal-content">
			<form action="<?php echo $appURL.$controllerName; ?>" method="post" id="add-calendar-form">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title"><?php slang('add_calendar'); ?></h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-8">
							<div class="form-group">
								<label class="control-label"><?php slang('date'); ?></label>
								<input required type="text" name="date" class="form-control datepicker" autocomplete="off" placeholder="<?php slang('date_placeholder'); ?>"> 
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label"><?php slang('time'); ?></label>
								<input required type="text" name="time" class="form-control timepicker3" autocomplete="off" placeholder="<?php slang('time_placeholder'); ?>"> 
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label"><?php slang('contact'); ?></label>
								<select name="contact" title="<?php slang('contact_placeholder'); ?>" class="form-control select2_ajax_tags" required></select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label"><?php slang('notes'); ?></label>
								<textarea name="notes" class="form-control" placeholder="<?php slang('notes_placeholder'); ?>"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><?php slang('CANCEL'); ?></button>
					<button type="submit" name="add_calendar" value="1" class="btn btn-info"><?php slang('SAVE'); ?></button>
				</div>
			</form>
        </div>
    </div>
</div>	
<?php } ?>
<?php if($privs->edit_calendar == 1) { ?>
<div class="modal fade" id="edit-calendar">
    <div class="modal-dialog">
        <div class="modal-content">
			<form action="<?php echo $appURL.$controllerName; ?>" method="post" id="edit-calendar-form">
				
			</form>
        </div>
    </div>
</div>	
<?php } ?>
<?php if($privs->delete_calendar == 1) { ?>
<div class="modal fade" id="delete_calendar">
    <div class="modal-dialog">
        <div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><?php slang('delete_calendar'); ?></h4>
			</div>
			<div class="modal-body">
				<p><?php slang('delete_confirm'); ?></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php slang('CANCEL'); ?></button>
				<a href="#" class="btn btn-danger" id="delete_calendar_button"><?php slang('DELETE'); ?></a>
			</div>
        </div>
    </div>
</div>
<?php } ?>
		

<?php
	endBody(); 
	loadScripts($scripts); ?>
<script>
$(document).ready(function() {
    $('.select2_ajax_tags').select2({
        tags: false,
        placeholder: "<?php slang('contact_placeholder'); ?>",
        ajax: { 
            url: '<?php echo $appURL; ?>contacts?load-contacts-list=1',
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
    $('.timepicker3').timepicker({
        timeFormat: 'HH:mm',
        interval: 15,
        minTime: '9',
        maxTime: '22',
        //defaultTime: '09:00',
        startTime: '09:00',
        dynamic: true,
        dropdown: true,
        scrollbar: true
    });

	function editCalendar(id){
		$("#delete_calendar_button").attr("href", "<?php echo $appURL; ?>calendar?delete_calendar="+id);
		$.post('<?php echo $appURL; ?>calendar', {load_calendar_data: id}, function (data){
			$('#edit-calendar-form').html(data);
			$('.datepicker2').datepicker({
				format: 'dd/mm/yyyy',
				language: "el"
			});
			$('.timepicker2').timepicker({
				timeFormat: 'HH:mm',
				interval: 15,
				minTime: '9',
				maxTime: '22',
				//defaultTime: '09:00',
				startTime: '09:00',
				dynamic: true,
				dropdown: true,
				scrollbar: true
			});
            $('.select2_ajax_tags2').select2({
                tags: false,
                placeholder: "<?php slang('contact_placeholder'); ?>",
                ajax: { 
                    url: '<?php echo $appURL; ?>contacts?load-contacts-list=1',
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
			$('#edit-calendar').modal('show');
			$('#delete_calendar_btn').on('click', function (e){
				$('#edit-calendar').modal('hide');
				setTimeout(function(){ $('#delete_calendar').modal('show'); }, 500);
				
			});
		});
	}
    <?php if(isset($_GET['show'])){ ?>
    editCalendar(<?php echo $_GET['show']; ?>);
    <?php } ?>
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay,listWeek'
        },
        defaultDate: '<?php echo date('Y-m-d', time()); ?>',
        <?php if($user->lang == 'el'){ echo 'locale: \'el\','; } ?>
        <?php if($user->lang == 'de'){ echo 'locale: \'de\','; } ?>
        editable: false,
        navLinks: true, // can click day/week names to navigate views
        eventLimit: true, // allow "more" link when too many events
        selectable: true,
        selectHelper: true,
        timeFormat: 'HH:mm',
        defaultView: 'agendaWeek',
        minTime: '08:00:00',
        events: {
            url: '<?php echo $appURL; ?>calendar?show-calendar=1',
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
    
});
</script>
  </body>
</html>