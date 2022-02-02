<?php
if(!defined('estatedrive')) {
   die('Direct access not permitted');
}
function showFilter($key, $filter, $parent = ""){
	if(isset($filter['filter_values']) && Count($filter['filter_values']) > 0)
		showMultiFilter($key, $filter, $parent);
	else
		showSingleFilter($key, $filter, $parent);
	
}
function showMultiFilter($key, $filter, $parent = ""){
	if(isset($filter['default_state']) && $filter['default_state'] == 1)
		$class = ' active';
	else
		$class = '';
	echo '<div class="dropdown dropleft dropdown-submenu"><button class="dropdown-item dropdown-toggle'.$class.'" type="button" data-filter="'.$key.'" data-parent="'.$parent.'">'.$filter['filter_name'].'</button><div class="dropdown-menu">';
	foreach($filter['filter_values'] as $key2=>$filter2){
		showFilter($key2, $filter2, $key);
	}
	echo '</div></div>';
}
function showSingleFilter($key, $filter, $parent = ""){
	if(isset($filter['default_state']) && $filter['default_state'] == 1)
		$class = ' active';
	else
		$class = '';
	if(isset($filter['filter_type'])){
		if($filter['filter_type'] == 'text')
			echo '<li class="dropdown-item last_item'.$class.'" data-parent="'.$parent.'" data-filter="'.$key.'"><input type="text" name="'.$key.'" placeholder="'.$filter['filter_name'].'" class="form-control"></li>';
		elseif($filter['filter_type'] == 'date')
			echo '<li class="dropdown-item date-input last_item'.$class.'" data-parent="'.$parent.'" data-filter="'.$key.'"><input type="text" name="'.$key.'" placeholder="'.$filter['filter_name'].'" class="form-control single-daterange" autocomplete="off" value=""></li>';
	}
	else
		echo '<button class="dropdown-item last_item'.$class.'" data-parent="'.$parent.'" data-filter="'.$key.'" type="button">'.$filter['filter_name'].'</button>';
}
function formatDateRangePicker($format){
	switch($format){
		case "d/m/Y H:i":
			return "DD/MM/YYYY";
		case "m/d/Y H:i":
			return "MM/DD/YYYY";
		case "m-d-Y H:i":
			return "MM-DD-YYYY";
		case "d-m-Y H:i":
			return "DD-MM-YYYY";
		case "Y/m/d H:i":
			return "YYYY/MM/DD";
		case "Y-m-d H:i":
			return "YYYY-MM-DD";
	}
	return "MM/DD/YYYY";
}