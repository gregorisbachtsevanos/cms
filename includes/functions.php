<?php
if(!defined('estatedrive')) {
   die('Direct access not permitted');
}
REQUIRE_ONCE  dirname(__FILE__) . ('/settings.php');
function loadLang($file = 'main'){
	global $lang;
	global $lang_strings;
	global $defaultLang;
	if($lang == '')
		$lang = $defaultLang; //for controllers outside session
	if($lang == $defaultLang){
		REQUIRE_ONCE  dirname(__FILE__) . ('/lang/'.$lang.'/'.$file.'.php');
		foreach($txt as $key=>$val)
			$lang_strings[$key] = $val;
		unset($txt);
	}
	else {
		REQUIRE_ONCE  dirname(__FILE__) . ('/lang/'.$lang.'/'.$file.'.php');
		foreach($txt as $key=>$val)
			$lang_strings[$key] = $val;
		unset($txt);
		
		REQUIRE_ONCE  dirname(__FILE__) . ('/lang/'.$defaultLang.'/'.$file.'.php');
		foreach($txt as $key=>$val){
			if(!isset($lang_strings[$key]))
				$lang_strings[$key] = $val;
		}
		unset($txt);
	}
}
function lang($string, $var=''){
	global $lang_strings;
	if(!isset($lang_strings[$string])){
		return $string;
	}
	else{
		if($var == '')
			return $lang_strings[$string];
		else {
			$return_string = $lang_strings[$string];
			if(!is_array($var)){
				$var = array($var);
			}
			$i = 1;
			foreach($var as $val){
				$return_string = str_replace('{$'.$i.'}', $val, $return_string);
				$i++;
			}
			return $return_string;
		}
	}
}
function slang($string, $var=''){
	global $lang_strings;
	if(!isset($lang_strings[$string])){
		echo $string;
	}
	else{
		if($var != '')
			echo str_replace('{$1}', $var, $lang_strings[$string]);
		else
			echo $lang_strings[$string];
	}
}
function fetchTable($table, $columns = '*', $where='', $params=null){
	global $db;
	$sql = 'SELECT '.$columns.' FROM '.$table;
	if($where != '')
		$sql .= ' WHERE '.$where;
	if(is_array($params))
		return $db->fetch($sql, $params);
	else
		return $db->fetch($sql);
}
function fetchRow($table, $columns = '*', $where='', $params=null, $return=0){
	global $db;
	$sql = 'SELECT '.$columns.' FROM '.$table;
	if($where != '')
		$sql .= ' WHERE '.$where;
	if(is_array($params))
		$row = $db->row($sql, $params);
	else
		$row = $db->row($sql);
	if($return == 1)
		return $row->$columns;
	else
		return $row;
}
function fetchTotal($table, $column = 'id', $where='', $params=null){
	global $db;
	$sql = 'SELECT COUNT('.$column.') as total FROM '.$table;
	if($where != '')
		$sql .= ' WHERE '.$where;
	if(is_array($params))
		$row = $db->row($sql, $params);
	else
		$row = $db->row($sql);
	return $row->total;
}
function arrayToSelect($rows, $value, $name, $replace_string = null, $selected_values = array()){
	$options = '';
	foreach($rows as $row){
		if($replace_string){
			$row->$value = str_replace($replace_string, "\$replace_string", $row->$value);
			$row->$name = str_replace($replace_string, "\$replace_string", $row->$name);
		}
		if(in_array($row->$value, $selected_values))
			$options .= '<option value="'.$row->$value.'" selected>'.$row->$name.'</option>';
		else
			$options .= '<option value="'.$row->$value.'">'.$row->$name.'</option>';
	}
	return $options;
}
function randHash($len=32)
{
	return substr(md5(openssl_random_pseudo_bytes(20)),-$len);
}
function addLog($controller='', $action='', $target='', $old='', $new=''){
	global $db;
	global $user;
	$db->insert('actions_log', array(
		'user'=>$user->id,
		'date'=>date('Y-m-d H:i:s', time()),
		'controller'=>$controller,
		'action'=>$action,
		'target_id'=>$target,
		'old_value'=>$old,
		'new_value'=>$new
	));
}