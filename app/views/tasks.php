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
			<div class="col-lg-6 col-xs-12">
				<h2><?php echo $title; ?></h2>
			</div>
			<div class="col-lg-6 col-xs-12 text-right">
				<div class="btn-group"> 
					<a href="<?php echo $appURL; ?>tasks/<?php echo $cParams[0]; ?>/in_progress" class="filter_btn btn btn-<?php if(!isset($cParams[1]) || $cParams[1] == 'in_progress') echo 'blue'; else echo 'default'; ?>"><?php slang('in_progress'); ?></a>
					<a href="<?php echo $appURL; ?>tasks/<?php echo $cParams[0]; ?>/completed" class="filter_btn btn btn-<?php if(isset($cParams[1]) && $cParams[1] == 'completed') echo 'blue'; else echo 'default'; ?>"><?php slang('completed'); ?></a> 
				</div>
				<div class="btn-group second-group"> 
					<a href="<?php echo $appURL; ?>tasks/incoming/<?php echo $cParams[1]; ?>" class="filter_btn btn btn-<?php if(!isset($cParams[0]) || $cParams[0] == 'incoming') echo 'blue'; else echo 'default'; ?>"><?php slang('incoming'); ?></a>
					<a href="<?php echo $appURL; ?>tasks/outgoing/<?php echo $cParams[1]; ?>" class="filter_btn btn btn-<?php if(isset($cParams[0]) && $cParams[0] == 'outgoing') echo 'blue'; else echo 'default'; ?>"><?php slang('outgoing'); ?></a> 
				</div>
				<?php if($privs->add_contacts == 1) { ?>
					<a data-toggle="modal" data-target="#add-modal" class="filter_btn btn btn-success second-group"><span class="visible-xs hidden-sm hidden-md">+</span><span class="hidden-xs visible-sm visible-md visible-lg"><?php slang('new_task'); ?></span></a>
				<?php } ?>
			</div>
		</div>
		
		<br />
		
		<div class="table-responsive">
			<table class="table table-bordered datatable" id="table-1">
				<thead>
					<tr>
						<th><?php slang('task_name'); ?></th>
						<th><?php slang('sender'); ?></th>
						<th><?php slang('recipients'); ?></th>
						<th><?php slang('deadline'); ?></th>
						<th><?php slang('status'); ?></th>
						<th><?php slang('date_created'); ?></th>
					</tr>
				</thead>
				<tbody>
					
				</tbody>
				<tfoot>
					<tr>
          <th><?php slang('task_name'); ?></th>
						<th><?php slang('sender'); ?></th>
						<th><?php slang('recipients'); ?></th>
						<th><?php slang('deadline'); ?></th>
						<th><?php slang('status'); ?></th>
						<th><?php slang('date_created'); ?></th>
					</tr>
				</tfoot>
			</table>
		</div>
		
		<br />
<?php if($privs->add_tasks == 1) { ?>	
<div class="modal fade" id="add-modal">
    <div class="modal-dialog">
        <div class="modal-content">
			<form action="<?php echo $appURL.$controllerName.'/'.$cParams[0].'/'.$cParams[1]; ?>" method="post" id="add-new-form">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title"><?php slang('new_task'); ?></h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="field-1" class="control-label"><?php slang('task_name'); ?></label>
								<input type="text" name="title" class="form-control" id="field-1" placeholder="<?php slang('task_name_placeholder'); ?>" required required autocomplete="off">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="field-2" class="control-label"><?php slang('deadline'); ?></label>
								<input type="text" name="deadline" class="form-control datepicker" id="field-2" placeholder="<?php slang('deadline_placeholder'); ?>" required autocomplete="off"> </div>
						</div>
					</div>
          <div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="field-4" class="control-label"><?php slang('recipients'); ?></label>
								<select name="recipients[]" data-placeholder="<?php slang('recipients_placeholder'); ?>" multiple class="form-control select2" id="field-4" placeholder="<?php slang('recipients_placeholder'); ?>" required><?php echo arrayToSelect(fetchTable('users', 'id, CONCAT(name, \' \', surname) as full_name'), 'id', 'full_name'); ?></select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="field-3" class="control-label"><?php slang('contacts'); ?></label>
								<select name="contacts[]" multiple class="form-control select2_ajax_tags" class="form-control" id="field-3" placeholder="<?php slang('contacts_placeholder'); ?>"> <option value=""><?php slang('recipients_placeholder'); ?></option></select>
              </div>
						</div>
          </div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group no-margin">
								<label for="field-7" class="control-label"><?php slang('notes'); ?></label>
								<textarea class="form-control autogrow" name="notes" id="field-7" placeholder="<?php slang('notes_placeholder'); ?>"></textarea>
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
<?php if($privs->edit_tasks == 1) { ?>	
<div class="modal fade" id="edit-task">
    <div class="modal-dialog">
        <div class="modal-content">
			<form action="<?php echo $appURL.$controllerName.'/'.$cParams[0].'/'.$cParams[1]; ?>" method="post" id="edit-task-form">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title"><?php slang('edit_task'); ?></h4>
				</div>
				<div class="modal-body" id="edit-task-body">
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><?php slang('CANCEL'); ?></button>
					<button type="submit" name="edit" value="1" class="btn btn-info"><?php slang('SAVE'); ?></button>
				</div>
			</form>
        </div>
    </div>
</div>		
<?php } ?>
<div class="modal fade" id="view-task">
    <div class="modal-dialog">
      <div class="modal-content" id="view-task-content">
				
      </div>
    </div>
</div>		
<?php
	endBody(); 
	loadScripts($scripts); ?>
	
		<script type="text/javascript">
		jQuery( document ).ready( function( $ ) {
      $('.select2_ajax_tags').select2({
        tags: false,
        placeholder: "<?php slang('contacts_placeholder'); ?>",
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
				   url: "<?php echo $appURL; ?>tasks",
				   type: 'POST',
				   data: {  
						'show-table': 1,
            'status': '<?php echo $cParams[1]; ?>',
            'type': '<?php echo $cParams[0]; ?>'	
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

      <?php if(isset($_GET['addTask'])){
        $val = fetchRow('contacts', 'id, name, surname', 'id = ?', array($_GET['addTask'])); ?>
        $('.select2_ajax_tags').html('<option value="<?php echo $val->id; ?>" selected><?php echo $val->surname.' '.$val->name; ?></option>');
        $('.select2_ajax_tags').select2({
            tags: false,
            placeholder: "<?php slang('contacts_placeholder'); ?>",
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
        $('#add-modal').modal('show');

      <?php } ?>


		} );
    function viewTask(id){
      $.post('<?php echo $appURL; ?>tasks', {view_task: id}, function(data){
        $('#view-task-content').html(data);
        $('#view-task').modal('show');
      });
    }
    function editTask(id){
      $.post('<?php echo $appURL; ?>tasks', {edit_task: id}, function(data){
        $('#edit-task-body').html(data);

        $('.select2_ajax_tags2').select2({
            tags: false,
            placeholder: "<?php slang('contacts_placeholder'); ?>",
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
        $('.datepicker2').datepicker({
          format: 'dd/mm/yyyy',
          language: "el"
        });
        $('.select3').select2();

        $('#view-task').modal('hide');
        setTimeout(function(){ $('#edit-task').modal('show'); }, 500);
      });
    }
    <?php if(isset($_GET['show'])) echo 'viewTask('.$_GET['show'].');'; ?>
		</script>
  </body>
</html>