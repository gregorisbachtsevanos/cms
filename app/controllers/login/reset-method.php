<?php
if(!defined('estatedrive')) {
   die('Direct access not permitted');
}
loadlang('login/reset');
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
function sendSMS($to, $message, $from) {
	global $smsAppKey;
	global $smsProvider;
	$URL = $smsProvider."/send?key=" . $smsAppKey . "&to=" . $to;
	$URL .= "&text=" . urlencode( $message ) . '&from=' . $from;
	$fp = fopen( $URL, 'r' );
	return fread( $fp, 1024 );
}
$user_agent     = $_SERVER['HTTP_USER_AGENT'];
$user_os        = getOS();
$user_browser   = getBrowser();
$user_ip        = getIP();
$sql = 'SELECT * FROM users WHERE username = ? AND status = ?';
$contact = $db->row($sql, array($cParams[0], 1));
if(!isset($contact->id)){
	header("Location: ".$appURL."login");
	exit();
}
if(isset($_GET['send'])){
	$new_code = rand(1,9).rand(0,9).rand(0,9).rand(0,9).rand(1,9);
	$db->update('users', array('reset_code'=>$new_code), array('id'=>$contact->id));
	if($_GET['send'] == 'sms'){
		$string = $contact->mobile;
		$length = strlen($string);
		$mobile = '';
		for ($i=0; $i<$length; $i++) {
			if($i < 3 || $i >= ($length - 2))
				$mobile .= $string[$i];
			else
				$mobile .= '*';
		}
		if(sendSMS(str_replace(' ', '', $contact->mobile), 'Ο 5ψήφιος κωδικός είναι: '.$new_code, 'GLOBAL') != 0)
			$success = lang('sms_success', $mobile);
	}
	elseif($_GET['send'] == 'email'){
		$string = explode('@', $contact->email);
		$email = '';
		$length = strlen($string[0]);
		for ($i=0; $i<$length; $i++) {
			if($i < 1 || $i > ($length - 2))
				$email .= $string[0][$i];
			else
				$email .= '*';
		}
		$email .= '@';
		$length = strlen($string[1]);
		$show = 0;
		for ($i=0; $i<$length; $i++) {
			if($show == 0) {
				if($string[1][$i+1] == '.')
					$show = 1;
			}
			if($i < 1 || $i > ($length - 2) || $show == 1)
				$email .= $string[1][$i];
			else
				$email .= '*';
		}
		$html_body = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
		<html>
		<head>
		  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		  <title>5ψήφιος Κωδικός Επαλήθευσης</title>
		</head>
		<body>
		<div style="max-width: 640px; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; font-size: 16px; display:block;margin:0 auto;">
		  
		  <center><a href="'.$appURL.'"><img src="'.$appURL.'assets/images/logo-light@2x.png" height="56" width="241" alt="'.$appName.'"></a>
		  </center><br>
		  <center><h1 style="color: #222222; font-size: 25px;">Κωδικός Επαλήθευσης</h1></center>
		  <center><h1 style="font-size: 50px">'.$new_code.'</h1></center>
		  <p style="line-height: 26px;">Αυτό το email περιέχει προσωπικές πληροφορίες. Παρακαλούμε μην το προωθήσετε σε τρίτους. Για οποιαδήποτε απορία, απευθυνθείτε στο <a href="mailto:'.$appEmail.'" style="color: #108eb7; text-decoration: none; font-weight: bold">'.$appEmail.'</a>.</p>
		  <p style="line-height: 26px;">Με εκτίμηση,<br>Η ομάδα του '.$appName.'</p>
		  <p style="text-align: center"><span style="font-size: 28px">🏠 👨 🏡 👩 🏠 👨 🏡 👩 🏠 👨 🏡 👩</p>
		  <p style="text-align: center"><span style="font-size: 12px">Δημιουργήθηκε από την <a href="https://globalconcept.gr" style="color: #108eb7; text-decoration: none;">Global Concept</a>.<br>Λαέρτου 22, 2ος όροφος - Θεσσαλονίκη - 555 35.</p>
		</div>
		</body>
		</html>
		';
		if(sendAppEmail($contact->email, '5ψήφιος Κωδικός Επαλήθευσης', $html_body))
			$success = lang('email_success', $email);
		/*$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= "From: ".$appName." <".$appEmail.">\r\n";
		$headers .= "Reply-To: ".$appEmail."\r\n";
		if(mail($contact->email, '5ψήφιος Κωδικός Επαλήθευσης', $html, $headers))
			$success = 'Σας έχουμε στείλει Email στο '.$email.'.';*/
	}
}
elseif(isset($_POST['code'])){
	if($contact->reset_code == trim($_POST['code'])){
		$reset_password = 1;
	}
	else
		$error = 'Ο κωδικός που εισάγατε είναι λάθος.';
}
elseif(isset($_POST['pass1'])){
	$reset_password = 1;
	if($_POST['pass1'] != $_POST['pass2']){
		$error = 'Οι κωδικοί δεν ταιριάζουν.';
	}
	elseif(strlen($_POST['pass1']) < 4) {
		$error = 'Ο νέος κωδικός πρέπει αν αποτελείται από τουλάχιστον 4 χαρακτήρες.';
	}
	else {
		$newpass = password_hash($_POST['pass1'], PASSWORD_DEFAULT);
		$newKey = Google2FA::generate_secret_key().Google2FA::generate_secret_key();
		if($db->update('users', array('auth_hash'=>$newKey, 'password'=>$newpass), array('id'=>$contact->id))){
			header("Location: ".$appURL."login?changed");
			exit();
		}
	}
}
include($appViews.'login/reset-method.php');