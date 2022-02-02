<?php
if(!defined('estatedrive')) {
   die('Direct access not permitted');
}
loadlang('login/login');
include_once($appLibraries.'emails.php');
function getOS(){    
    global $user_agent;
    $os_platform = "Unknown OS Platform";
    $os_array = array(
        '/windows nt 10/i' => 'Windows 10',
        '/windows nt 6.3/i' => 'Windows 8.1',
        '/windows nt 6.2/i' => 'Windows 8',
        '/windows nt 6.1/i' => 'Windows 7',
        '/windows nt 6.0/i' => 'Windows Vista',
        '/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
        '/windows nt 5.1/i' => 'Windows XP',
        '/windows xp/i' => 'Windows XP',
        '/windows nt 5.0/i' => 'Windows 2000',
        '/windows me/i' => 'Windows ME',
        '/win98/i' => 'Windows 98',
        '/win95/i' => 'Windows 95',
        '/win16/i' => 'Windows 3.11',
        '/macintosh|mac os x/i' => 'Mac OS X',
        '/mac_powerpc/i' => 'Mac OS 9',
        '/linux/i' => 'Linux',
        '/ubuntu/i' => 'Ubuntu',
        '/iphone/i' => 'iPhone',
        '/ipod/i' => 'iPod',
        '/ipad/i' => 'iPad',
        '/android/i' => 'Android',
        '/blackberry/i' => 'BlackBerry',
        '/webos/i' => 'Mobile'
    );
    foreach ($os_array as $regex => $value)
        if (preg_match($regex, $user_agent))
            $os_platform = $value;
    return $os_platform;
}
function getBrowser(){
    global $user_agent;
    $browser = "Unknown Browser";
    $browser_array = array(
        '/msie/i' => 'Internet Explorer',
        '/firefox/i' => 'Firefox',
        '/safari/i' => 'Safari',
        '/chrome/i' => 'Google Chrome',
        '/edge/i' => 'Microsoft Edge',
        '/opera/i' => 'Opera',
        '/OPR/i' => 'Opera',
        '/netscape/i' => 'Netscape',
        '/maxthon/i' => 'Maxthon',
        '/konqueror/i' => 'Konqueror',
        '/mobile/i' => 'Handheld Browser',
        '/Trident/i' => 'Internet Explorer'
    );
    foreach ($browser_array as $regex => $value)
        if (preg_match($regex, $user_agent))
            $browser = $value;
    return $browser;
}
function getIP(){
    $ip = '';
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
class Google2FA {

	const keyRegeneration 	= 30;	// Interval between key regeneration
	const otpLength		= 6;	// Length of the Token generated

	private static $lut = array(	// Lookup needed for Base32 encoding
		"A" => 0,	"B" => 1,
		"C" => 2,	"D" => 3,
		"E" => 4,	"F" => 5,
		"G" => 6,	"H" => 7,
		"I" => 8,	"J" => 9,
		"K" => 10,	"L" => 11,
		"M" => 12,	"N" => 13,
		"O" => 14,	"P" => 15,
		"Q" => 16,	"R" => 17,
		"S" => 18,	"T" => 19,
		"U" => 20,	"V" => 21,
		"W" => 22,	"X" => 23,
		"Y" => 24,	"Z" => 25,
		"2" => 26,	"3" => 27,
		"4" => 28,	"5" => 29,
		"6" => 30,	"7" => 31
	);

	/**
	 * Generates a 16 digit secret key in base32 format
	 * @return string
	 **/
	public static function generate_secret_key($length = 16) {
		$b32 	= "234567QWERTYUIOPASDFGHJKLZXCVBNM";
		$s 	= "";

		for ($i = 0; $i < $length; $i++)
			$s .= $b32[rand(0,31)];

		return $s;
	}

	/**
	 * Returns the current Unix Timestamp devided by the keyRegeneration
	 * period.
	 * @return integer
	 **/
	public static function get_timestamp() {
		return floor(microtime(true)/self::keyRegeneration);
	}

	/**
	 * Decodes a base32 string into a binary string.
	 **/
	public static function base32_decode($b32) {

		$b32 	= strtoupper($b32);

		if (!preg_match('/^[ABCDEFGHIJKLMNOPQRSTUVWXYZ234567]+$/', $b32, $match))
			throw new Exception('Invalid characters in the base32 string.');

		$l 	= strlen($b32);
		$n	= 0;
		$j	= 0;
		$binary = "";

		for ($i = 0; $i < $l; $i++) {

			$n = $n << 5; 				// Move buffer left by 5 to make room
			$n = $n + self::$lut[$b32[$i]]; 	// Add value into buffer
			$j = $j + 5;				// Keep track of number of bits in buffer

			if ($j >= 8) {
				$j = $j - 8;
				$binary .= chr(($n & (0xFF << $j)) >> $j);
			}
		}

		return $binary;
	}

	/**
	 * Takes the secret key and the timestamp and returns the one time
	 * password.
	 *
	 * @param binary $key - Secret key in binary form.
	 * @param integer $counter - Timestamp as returned by get_timestamp.
	 * @return string
	 **/
	public static function oath_hotp($key, $counter)
	{
	    if (strlen($key) < 8)
		throw new Exception('Secret key is too short. Must be at least 16 base 32 characters');

	    $bin_counter = pack('N*', 0) . pack('N*', $counter);		// Counter must be 64-bit int
	    $hash 	 = hash_hmac ('sha1', $bin_counter, $key, true);

	    return str_pad(self::oath_truncate($hash), self::otpLength, '0', STR_PAD_LEFT);
	}

	/**
	 * Verifys a user inputted key against the current timestamp. Checks $window
	 * keys either side of the timestamp.
	 *
	 * @param string $b32seed
	 * @param string $key - User specified key
	 * @param integer $window
	 * @param boolean $useTimeStamp
	 * @return boolean
	 **/
	public static function verify_key($b32seed, $key, $window = 4, $useTimeStamp = true) {

		$timeStamp = self::get_timestamp();

		if ($useTimeStamp !== true) $timeStamp = (int)$useTimeStamp;

		$binarySeed = self::base32_decode($b32seed);

		for ($ts = $timeStamp - $window; $ts <= $timeStamp + $window; $ts++)
			if (self::oath_hotp($binarySeed, $ts) == $key)
				return true;

		return false;

	}

	/**
	 * Extracts the OTP from the SHA1 hash.
	 * @param binary $hash
	 * @return integer
	 **/
	public static function oath_truncate($hash)
	{
	    $offset = ord($hash[19]) & 0xf;

	    return (
	        ((ord($hash[$offset+0]) & 0x7f) << 24 ) |
	        ((ord($hash[$offset+1]) & 0xff) << 16 ) |
	        ((ord($hash[$offset+2]) & 0xff) << 8 ) |
	        (ord($hash[$offset+3]) & 0xff)
	    ) % pow(10, self::otpLength);
	}

}
$user_agent     = $_SERVER['HTTP_USER_AGENT'];
$user_os        = getOS();
$user_browser   = getBrowser();
$user_ip        = getIP();
if(@$cParams[0] == 'logout' || @$cParams[0] == 'reset-password'){
	unset($_SESSION['userId']);
	unset($_SESSION['last_login']);
	unset($_SESSION['auth_hash']);
	unset($_COOKIE['rememberme']);
	setcookie('rememberme', 'test', intval(time()+3600));
	if(@$cParams[0] == 'logout'){
		header("Location: ".$appURL."login");
		exit();
	}
}
if(isset($_SESSION['userId'])){
	$sql = 'SELECT id, auth_hash FROM users WHERE id = ? AND auth_hash = ?';
	$params = array($_SESSION['userId'], $_SESSION['auth_hash']);
	$row = $db->row($sql, $params);
	if(isset($row->id)){
		header("Location: dashboard");
		exit();
	}
	else {
		unset($_SESSION['userId']);
		unset($_SESSION['auth_hash']);
		unset($_SESSION['last_login']);
	}
}
elseif(isset($_COOKIE['rememberme'])){
	$cookie = base64_decode($_COOKIE['rememberme']);
	$cookie = explode('-', $cookie);
	$sql = 'SELECT id, auth_hash FROM users WHERE id = ? AND auth_hash = ?';
	$params = array($cookie[0], $cookie[1]);
	$row = $db->row($sql, $params);
	if(isset($row->id)){
		$_SESSION['userId'] = $cookie[0];
		$_SESSION['auth_hash'] = $cookie[1];
		$login = $db->insert('login_history', array('browser'=>$user_browser.' on '.$user_os, 'ip'=>$user_ip, 'user'=>$row->id, 'type'=>1, 'date_logged'=>date('Y-m-d H:i:s', time())));
		$_SESSION['last_login'] = $login;
		header("Location: dashboard");
		exit();
	}
	else {
		unset($_COOKIE['rememberme']);
	}
}
if(@$cParams[0] == 'submit'){
	$resp = array();


	// Fields Submitted
	$username = $_POST["username"];
	$password = $_POST["password"];


	// This array of data is returned for demo purpose, see assets/js/neon-forgotpassword.js
	//$resp['submitted_data'] = $_POST;


	// Login success or invalid login data [success|invalid]
	// Your code will decide if username and password are correct
	$login_status = 'invalid';

	
	
	$sql = 'SELECT * FROM users WHERE username = ? AND status = ?';
	$params = array($username, 1);
	$row = $db->row($sql, $params);
	if(isset($row->id)){
		if(password_verify($password, $row->password)){
			
			$login = $db->insert('login_history', array('browser'=>$user_browser.' on '.$user_os, 'ip'=>$user_ip, 'user'=>$row->id, 'type'=>1, 'date_logged'=>date('Y-m-d H:i:s', time())));
			$_SESSION['userId'] = $row->id;
			$_SESSION['auth_hash'] = $row->auth_hash;
			$_SESSION['last_login'] = $login;
			$login_status = 'success';
			if(isset($_POST['rememberme'])){
				$cookie = $row->id.'-'.$row->auth_hash;
				$cookie = base64_encode($cookie);
				setcookie("rememberme", $cookie, intval(time()+2592000000));
			}
		}
	}
	$resp['login_status'] = $login_status;


	// Login Success URL
	if($login_status == 'success')
	{
		// If you validate the user you may set the user cookies/sessions here
			#setcookie("logged_in", "user_id");
			#$_SESSION["logged_user"] = "user_id";
		
		// Set the redirect url after successful login
		$resp['redirect_url'] = $appURL.'dashboard';
	}


	echo json_encode($resp);
	exit();
}
$success = 0;
$error = 0;
$can_proceed = 0;
if(isset($_POST['login'])){
	$sql = 'SELECT id, account, auth_hash, status, password, name, login_method FROM users WHERE email = ?';
	$params = array($_POST['email']);
	$rows = $db->fetch($sql, $params);
	foreach($rows as $row){
		if($row->status == 0){
			$error = 1; //no access
		}
		elseif(password_verify($_POST["password"], $row->password)){
			if($row->login_method == 2) { //email verification on each login
				$can_proceed = 2; //send email and show form
				if(isset($_POST['code'])){
					$sql = 'SELECT email FROM users_verification WHERE user = ?';
					$code = $db->row($sql, array($row->id));
					if($code->email == $_POST['code'])
						$can_proceed = 1;
					else
						$error = 4; //wrong verification code
				}
				else {
					$newcode = mt_rand(10000, 99999);
					$db->update('users_verification', array('email'=>$newcode), array('user'=>$row->id));
					//send email about the login
					include($appViews.'login/emails/login_verification.php');
					sendAppEmail($_POST['email'], 'Verify that it\'s you', $html_body);
				}
			}
			elseif($row->login_method == 3) { //google authenticator
				$can_proceed = 3; //send email and show form
				if(isset($_POST['code'])){
					$sql = 'SELECT authenticator FROM users_verification WHERE user = ?';
					$code = $db->row($sql, array($row->id));
					$TimeStamp = Google2FA::get_timestamp();
					$secretkey = Google2FA::base32_decode($code->authenticator);	// Decode it into binary
					$otp = Google2FA::oath_hotp($secretkey, $TimeStamp);	// Get current token
					if($otp == $_POST['code'])
						$can_proceed = 1;
					else
						$error = 5; //wrong verification code
				}
			}
			else
				$can_proceed = 1;
			if($can_proceed == 1){
				$login = $db->insert('login_history', array('browser'=>$user_browser.' on '.$user_os, 'ip'=>$user_ip, 'user'=>$row->id, 'type'=>1, 'date_logged'=>date('Y-m-d H:i:s', time())));
				if(isset($_POST['rememberme'])){
					$cookie = $row->id.'-'.$row->auth_hash;
					$cookie = base64_encode($cookie);
					setcookie("rememberme", $cookie, intval(time()+2592000000));
				}
				$_SESSION['userId'] = $row->id;
				$_SESSION['auth_hash'] = $row->auth_hash;
				$_SESSION['last_login'] = $login;
				$sql = 'select count(id) as total from login_history WHERE user = ?';
				$total = $db->row($sql, array($row->id));
				if($total->total == 1){
					header("Location: ".$appURL."dashboard?welcome"); //first time logged in
				}
				else{
					if($row->login_method == 1){ //notify by email if it's a new ip
						$sql = 'select count(id) as total from login_history WHERE user = ? AND ip = ?';
						$total = $db->row($sql, array($row->id, $user_ip));
						if($total->total == 1) {
							//send email about the login
							include($appViews.'login/emails/login_ip.php');
							sendAppEmail($_POST['email'], 'Login notification', $html_body);
						}
					}
					if(isset($_GET['returnURL']))
						header("Location: ".$_GET['returnURL']);
					else
						header("Location: dashboard");
					exit();
				}
			}
		}
		else {
			$db->insert('login_history', array('browser'=>$user_browser.' on '.$user_os, 'ip'=>$user_ip, 'user'=>$row->id, 'type'=>0, 'date_logged'=>date('Y-m-d H:i:s', time())));
			$error = 2; //wrong password
		}
	}
	if(Count($rows) == 0)
		$error = 7; //wrong email
}
elseif(isset($_POST['reset'])){
	$sql = 'SELECT id, auth_hash, status, name FROM users WHERE email = ?';
	$params = array($_POST['email']);
	if($row = $db->row($sql, $params)) {
		if($row->status == 0){
			$error = 1; //no access
		}
		else {
			include($appViews.'login/emails/reset_password.php');
			if(sendAppEmail($_POST['email'], 'Reset your password', $html_body) == 'success')
				$success = 1;
			else
				$error = 6; //something went wrong while sending reset email
		}
	}
	else
		$error = 7; //email not found
}
elseif(@$cParams[0] == 'reset-password'){
	$ids = explode('-', $cParams[1]);
	$id = $ids[0];
	$hash = strtoupper($ids[1]);
	$sql = 'SELECT users.id, users.email, users.login_method, users.auth_hash, users_verification.authenticator FROM users INNER JOIN users_verification ON users.id = users_verification.user WHERE users.id = ?';
	$row = $db->row($sql, array($id));
	$newKey = Google2FA::generate_secret_key().Google2FA::generate_secret_key();
	
	if($row->auth_hash == $hash){
		if(isset($_POST['reset-pass'])){
			if(strlen($_POST['pass1']) > 3){
				if($_POST['pass1'] == $_POST['pass2']){
					$newpass = password_hash($_POST['pass1'], PASSWORD_DEFAULT);
					if($db->update('users', array('auth_hash'=>$newKey, 'password'=>$newpass, 'login_method'=>$_POST['login_method']), array('email'=>$row->email))){
						header("Location: ".$appDir."login?changed");
						exit();
					}
					else
						$error = 10; //something went wrong
				}
				else
					$error = 8; //passwords do not match
			}
			else
				$error = 9; //passwords must be at least 4 characters long	
		}
	}
	else {
		header("Location: ".$appDir."login?wrong-url");
		exit();
	}
	
}
include($appViews.'login/index.php');