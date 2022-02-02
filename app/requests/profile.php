<?php
if(!defined('estatedrive')) {
   die('Direct access not permitted');
}
if(isset($_POST['save_tab1'])){
	if(!ctype_digit(str_replace(' ', '', $_POST['mobile'])) || strlen(str_replace(' ', '', $_POST['mobile'])) != 10) {
		$error = lang('wrong_mobile');
	}
	else {
		$data = array(
			'name'=>$_POST['name'],
			'surname'=>$_POST['surname'],
			'mobile'=>str_replace(' ', '', $_POST['mobile']),
			'email'=>str_replace(' ', '', $_POST['email'])
		);
		if($db->update('users', $data, array('id'=>$user->id))){
			$success = lang('info_updated');
			foreach($data as $key=>$val)
				$user->$key = $val;
		}
	}
}
if(isset($_POST['save_tab2'])){
	if(password_verify($_POST['password'], $user->password)){
		if($_POST['pass1'] == $_POST['pass2']){
			$newpass = password_hash($_POST['pass1'], PASSWORD_DEFAULT);
			$newKey = Google2FA::generate_secret_key().Google2FA::generate_secret_key();
			if($db->update('users', array('auth_hash'=>$newKey, 'password'=>$newpass), array('id'=>$user->id))){
				$_SESSION['auth_hash'] = $newKey;
				$success = lang('password_changed');
			}
		}
		else
			$error = lang('passwords_do_not_match');
	}
	else {
		$error = lang('wrong_password');
	}
}