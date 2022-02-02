<?php
if(!defined('estatedrive')) {
   die('Direct access not permitted');
}
function getFieldValue($id, $contact_id){
    global $user;
    global $db;
    $sql = 'SELECT id FROM contacts WHERE id = ? AND account = ?';
    $contact = $db->row($sql, array($contact_id, $user->account));
    $sql = 'SELECT contacts_fields.id as id, contacts_fields.field as field, contacts_fields.value as value, fields.name as name, fields.field_type as type FROM contacts_fields RIGHT JOIN fields ON contacts_fields.field = fields.id WHERE contacts_fields.contact = ? AND contacts_fields.id = ?';
    $params = array($contact->id, $id);
    $field = $db->row($sql, $params);
    $field->default_value = $field->value;
    if($field->type == 2){
        $field->value = fetchRow('fields_options', 'name', 'field = ? AND id = ?', array($field->field, $field->value), 1);
    }
    elseif($field->type == 3){
        $allValues = fetchTable('fields_options', 'id, name', 'field = ?', array($field->field));
        $allFieldValues = array();
        foreach($allValues as $val)
            $allFieldValues[$val->id] = $val->name;
        $field_values = array();
        foreach(explode(';', $field->value) as $val){
            if($val != '')
                array_push($field_values, $allFieldValues[$val]);
        }
        $field->value = implode(', ', $field_values);
    }
    elseif($field->type == 7){
        $allValues = fetchRow('contacts', 'id, name, surname', 'id = ?  AND account = ?', array($field->value, $user->account));
        if(isset($allValues->id)){
            $field->value = '<a href="contacts/view/'.$allValues->id.'" target="_blank">'.$allValues->name.' '.$allValues->surname.'</a>';
        }
        else
            $field->value = '';
    }
    return $field->value;
}