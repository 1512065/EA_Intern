<?php
/*
//$to = "duyennt@fastmail.com";
$to = "thduyen2397@gmail.com";
$subject = "My こんにちは";
$txt = "hello こんにちは ";
$subject = "=?utf-8?b?".base64_encode($subject)."?=";

//$headers = "From: duyen@mywebmail.com" . "\r\n";
//$header = 'Content-type: text/html;charset=UTF-8'."\r\n";
$header = "From: thduyen2397@gmail.com";
$result = mail($to,$subject,$txt,$header);
var_dump($result);
*/
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
//error_reporting(-1)
//ini_set('display_errors', 'On');
//set_error_handler("var_dump");
//------------------------------------------

/*
$to = "thduyen2397@gmail.com";
$subject = "Mail with attachment";
$body = "This demo mail is delivered!";

$file = "image.jpg";
$file_size = filesize($file);
$handle = fopen($file, "r");
$content = fread($handle, $file_size);
fclose($handle);

$content = chunk_split(base64_encode($content));
$uid = md5(uniqid(time()));
$name = basename($file);

$eol = PHP_EOL;

//headers
$header = "From: Duyen Nguyen<thduyen2397@gmail.com>";
$header .= $eol;
$header .= "MIME-Version: 1.0\r\n";
$header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"";

// $message
$message = "--".$uid.$eol;
$message .= "Content-Type: text/html; charset=ISO-8859-1".$eol;
$message .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
$message .= $body.$eol;
$message .= "--".$uid.$eol;
$message .= "Content-Type: application/octet-stream; name=\"".$file."\"".$eol;
$message .= "Content-Transfer-Encoding: base64".$eol;
$message .= "Content-Disposition: attachment; filename=\"".$file."\"".$eol;
$message .= $content.$eol;
$message .= "--".$uid."--";

if (mail($to, $subject, $message, $header)!==TRUE)
{
    echo "failed";
}
else
{
    echo "sent";
}
*/
$to = "duyennguyen_vt97@yahoo.com.vn, thduyen2397@gmail.com";
$subject = "Demo こんにちは mail";
$body = "This demo mail is delivered!! こんにちは ";
$header = "From: <thduyen2397@gmail.com>\r\n";
$header.= "MIME-Vesion: 1.0\r\n";
//$header.= "Content-type: text/html\r\n";
$header.= "Content-type: multipart/mixed\r\n";
$header.= "CharSet=UTF-8\r\n";
$header.= "X-Piority: 1\r\n";
$res=mail($to, $subject, $body, $header);
if ($res!==FALSE)
	echo 'mail sent';
?>

