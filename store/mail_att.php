<?php
$header = "From: Duyen Nguyen (thduyen2397@gmail.com)";
echo $header;
echo '<form method="post">
  Send to:<br>
  <input type="text" name="send_to">
  <br>
  CC:<br>
  <input type="text" name="cc_to">
  <br>
  BCC:<br>
  <input type="text" name="bcc_to">
  <br>
  Subject:<br>
  <input type="text" name="subject">
  <br>
  Message:<br>
  <textarea name="message" cols="40" rows="5"></textarea>
  <br>
  Attachs: input full directory<br>
  <input type="text" name="file">
  <br><br>  
  <input type="submit" name="send" value="Send">
</form> ';

if (isset($_POST['send']))
{	

	if(isset($_POST['send_to']) and isset($_POST['subject']) and isset($_POST['message']))
	{
		$to = $_POST['send_to'];
		$subject = $_POST['subject'];
		$body = $_POST['message'];
	}
	else
	{
		echo 'Missing input';
		exit();
	}
	if (isset($_POST['file']) && $_POST['file']!="")
	{
		$file = $_POST['file'];
		$file_size = filesize($file);
		$handle = fopen($file, "r");
		$content = fread($handle, $file_size);
		fclose($handle);

		$content = chunk_split(base64_encode($content));
		$name = basename($file);		
			
		$uid = md5(uniqid(time()));	
		$eol = PHP_EOL;

		//headers
		$header = "From: Duyen Nguyen<thduyen2397@gmail.com>".$eol;
		if (isset($_POST['cc_to']))
			$header .= "CC: $_POST['cc_to']".$eol;
		if (isset($_POST['bcc_to']))
			$header .= "BCC: $_POST['bcc_to']".$eol;
		$header .= "MIME-Version: 1.0\r\n";
		$header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"";

		// $message
		$message = "--".$uid.$eol;
		$message .= "Content-Type: text/html; charset=ISO-8859-1".$eol;
		$message .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
		$message .= $body.$eol;
		$message .= "--".$uid.$eol;
		$message .= "Content-Type: application/octet-stream; name=\"".$name."\"".$eol;
		$message .= "Content-Transfer-Encoding: base64".$eol;
		$message .= "Content-Disposition: attachment; filename=\"".$name."\"".$eol;
		$message .= $content.$eol;
		$message .= "--".$uid."--";
	}
	else
	// no attach
	{
		$header = "From: Duyen Nguyen<thduyen2397@gmail.com>\r\n";
		if (isset($_POST['cc_to']))
			$header .= "CC: $_POST['cc_to']\r\n";
		if (isset($_POST['bcc_to']))
			$header .= "BCC: $_POST['bcc_to']\r\n";
		$header .= "MIME-Vesion: 1.0\r\n";
		$header .= "Content-Type: text/html\r\n";
		$message=$body;
	}
	//send mail
	if (mail($to, $subject, $message, $header)!==TRUE)
	{
		echo "Can not send your mail!!";
	}
	else
	{
		echo "Mail sent successfully!!";
	}
}
?>

