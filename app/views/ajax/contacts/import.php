<?php if(isset($_POST['upload'])){
	if(isset($errors)){ ?>
	<div class="onboarding-media">
	  <img alt="Import" src="assets/img/bigicon3.png" width="200px">
	</div>
	<div class="onboarding-content with-gradient">
	  <h4 class="onboarding-title">
		<?php echo lang('error'); ?>
	  </h4>
	  <div class="onboarding-text">
		<?php 
		$i = 1;
        foreach($errors as $val){
			echo $i.'. '.$val.'<br>';
			$i++;
		}
		?>
	  </div>
	</div>
	<?php }
	else { ?>
	<div class="onboarding-content with-gradient">
	  <h4 class="onboarding-title">
		<?php echo lang('preview'); ?>
	  </h4>
	  <div class="onboarding-text">
		<?php echo lang('before_process').' '; 
		$total = Count($sheetData) - 1; 
		if($total > 2000) 
			$total = 2000; 
		if($total < 6) 
			echo lang('preview_text1', $total); 
		else 
			echo lang('preview_text2', $total); ?>
	  </div>
		<div class="row">
		  <div class="col-sm-12">
			<div class="table-responsive" style="overflow-x: scroll;">
				<table class="table">
					<thead>
						<tr>
							<th><?php echo lang('table_1'); ?></th>
							<th><?php echo lang('table_2'); ?></th>
							<th><?php echo lang('EMAIL'); ?></th>
							<th><?php echo lang('table_3'); ?></th>
							<th><?php echo lang('table_4'); ?></th>
							<th><?php echo lang('table_5'); ?></th>
							<th><?php echo lang('table_6'); ?></th>
							<th><?php echo lang('table_7'); ?></th>
							<th><?php echo lang('table_8'); ?></th>
							<th><?php echo lang('table_9'); ?></th>
						</tr>
					</thead>
					<tbody>
					<?php
					$i = 0;
					foreach($sheetData as $row){
						if($i > 0 && $i < 6){
							echo '<tr>
							<td>'.$row['A'].'</td>
							<td>'.$row['B'].'</td>
							<td>'.$row['C'].'</td>
							<td>'.$row['D'].'</td>
							<td>'.$row['E'].'</td>
							<td>'.$row['F'].'</td>
							<td>'.$row['G'].'</td>
							<td>'.$row['H'].'</td>
							<td>'.$row['I'].'</td>
							<td>'.$row['J'].'</td>
							</tr>';
						}
						$i++;
					}
					?>
					</tbody>
				</table>
			</div>
		  </div>
		  <div class="col-sm-6 text-left">
		   <button type="button" onclick="submitImportModal(0)" class="btn btn-primary" style="margin-top: 28px;"><i class="os-icon os-icon-arrow-left"></i> <?php echo lang('back'); ?></button>
		  </div>
		  <div class="col-sm-6 text-right">
		  <input type="hidden" name="import" value="<?php echo $inputFileName; ?>">
			<button type="button" onclick="submitImportModal('<?php echo $inputFileName; ?>')" class="btn btn-primary importBtn" style="margin-top: 28px;"><?php echo lang('import'); ?> <i class="os-icon os-icon-arrow-right2"></i></button>
		  </div>
		</div>
	</div>
	<?php }
}
elseif(isset($_POST['import'])) { ?>
<div class="onboarding-media">
  <img alt="Import" src="assets/img/bigicon3.png" width="200px">
</div>
<div class="onboarding-content with-gradient">
  <h4 class="onboarding-title">
	<?php echo lang('success'); ?>
  </h4>
  <div class="onboarding-text">
	<?php echo lang('contacts_imported', $k); ?>
  </div>
  <div class="row">
	  <div class="col-sm-6 text-left">
		<button type="button" onclick="submitImportModal(0)" class="btn btn-primary"><i class="os-icon os-icon-grid-18"></i> <?php echo lang('import_more_contacts'); ?></button>
	  </div>
	  <div class="col-sm-6 text-right">
		<a class="btn btn-primary" href="<?php echo $appDir; ?>contacts"><?php echo lang('see_your_contacts'); ?> <i class="os-icon os-icon-arrow-right2"></i></a>
	  </div>
   </div>
</div>
<?php }
else { ?>
<div class="onboarding-media">
  <img alt="Import" src="assets/img/bigicon3.png" width="200px">
</div>
<div class="onboarding-content with-gradient">
  <h4 class="onboarding-title">
	<?php echo lang('title'); ?>
  </h4>
  <div class="onboarding-text">
	<?php echo lang('information', 'https://google.gr'); ?>
  </div>
	<div class="row">
	  <div class="col-sm-6">
		<div class="form-group">
		  <label for=""><?php echo lang('select_file'); ?></label><input class="form-control" id="import_file" type="file" name="file2" required accept=".csv,.xls,.xlsx">
		</div>
	  </div>
	  <div class="col-sm-6 text-right">
		<button type="button" class="btn btn-primary importBtn" onclick="submitImportModal(1)" style="margin-top: 28px;"><?php echo lang('upload'); ?> <i class="os-icon os-icon-arrow-right2"></i></button>
		<input name="upload" type="hidden" value="1">
	  </div>
	  <div class="col-sm-12 text-center" id="import_file_error" style="display: none">
		<div class="alert alert-warning" role="alert">
			<?php echo lang('error1'); ?>
		</div>
	  </div>
	</div>
</div>
<?php } ?>