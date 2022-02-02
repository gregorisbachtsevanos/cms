<?php
if(!defined('estatedrive')) {
   die('Direct access not permitted');
}
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
function sendAppEmail($to, $subject, $body){
	global $appHelpers;
	REQUIRE_ONCE  $appHelpers.'phpmailer/autoload.php';
	global $appName, $appEmail;
	$mail = new PHPMailer(true);
	try {
		$mail->SMTPDebug = 0;
		$mail->isSMTP();
		$mail->Host = 'globalconcept.gr';
		$mail->SMTPAuth = true;
		$mail->Username = 'info@laikiapp.gr';
		$mail->Password = 'gku8V~19';
		$mail->SMTPSecure = 'tls';
		$mail->SMTPOptions = array(
			 'ssl' => array(
				 'verify_peer' => false,
				 'verify_peer_name' => false,
				 'allow_self_signed' => true
			 )
		);		
		$mail->Port = 587;
		$mail->setFrom($appEmail, $appName);
		$mail->addAddress($to);
		$mail->addReplyTo($appEmail, $appName);
		$mail->isHTML(true);
		$mail->CharSet = 'UTF-8';
		$mail->Subject = $subject;
		$mail->Body    = $body;
		$mail->send();
		return 'success';
	} catch (Exception $e) {
		return 'Message could not be sent. Mailer Error: '. $mail->ErrorInfo;
	}
}