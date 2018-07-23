<?php

//$to = "duyennt@fastmail.com";
$to = "duyennguyen_vt97@yahoo.com.vn";
$subject = "My こんにちは";
$txt = "こんにちは";
$subject = "=?utf-8?b?".base64_encode($subject)."?=";

//$headers = "From: duyen@mywebmail.com" . "\r\n";
$header = 'Content-type: text/html;charset=UTF-8'."\r\n";

$result = mail($to,$subject,$txt,$header);
var_dump($result);

/*
require_once('vendor/autoload.php');
use PHPMailer\PHPMailer\PHPMailer;
$mail = new PHPMailer();

$mail->CharSet = 'UTF-8';
$mail->IsSMTP();
$mail->SMTPDebug = 1;
$mail->SMTPAuth = TRUE;
$mail->SMTPSecure = "ssl"; //tsl
$mail->Port     = 465;  //587

$mail->Username = "thduyen2397@gmail.com";
$mail->Password = "Khongco123";
$mail->Host     = "smtp.gmail.com";
$mail->Mailer   = "smtp";
$mail->SetFrom("thduyen2397@gmail.com", "Duyen Nguyen");
//$mail->AddReplyTo("thduyen2397@gmail.com", "demo");
$mail->AddAddress("thduyen2397@gmail.com");
$mail->Subject = "こんにちは";
$mail->WordWrap   = 80;
//$mail ->addAttachment('abcd.txt','myatt.txt');
$mail->isHTML(true);
$mail->Body="tiếng việt";
var_dump($mail->send());


*/

	
?>

