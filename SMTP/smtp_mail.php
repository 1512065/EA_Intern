<?php
require_once ('function.php'); 
echo '<form method="post">
	___ Send mail with gmail account ___<br>
	Gmail address:<br>
	<input type="text" name="auth_user">
	<br>
	Password:<br>
	<input type="password" name="auth_pass">
	<br><br>
	-- MAIL --<br>
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
	Attachs: (input file name)<br>
	<textarea name="file" cols="40"></textarea>
	<br><br>  
	<input type="submit" name="send" value="Send">
	</form> ';

// submitted	
if (isset($_POST['send']))
{	
	if(isset($_POST['send_to']) and isset($_POST['subject']) and isset($_POST['message'])and isset($_POST['auth_user'])and isset($_POST['auth_pass']))
	{
		$to = $_POST['send_to'];
		$subject = $_POST['subject'];
		$message = $_POST['message'];
		$authen=array();
		$authen['user']=$_POST['auth_user'];
		$authen['password']=$_POST['auth_pass'];
	}
	else
	{
		echo 'Missing input';
		exit();
	}
	//file
	if (isset($_POST['file']))
	{
		
		$file_path = getcwd().'/'.$_POST['file'];
	} else {
		$file_path ='';
	}
	//cc
	if (isset($_POST['cc']))
	{
		$cc = $_POST['cc'];
	} else {
		$cc ='';
	}
	//bcc
	if (isset($_POST['bcc']))
	{
		$bcc = $_POST['bcc'];
	} else {
		$bcc ='';
	}
	
	//send mail
	if (!send_smtp_mail($authen, $to, $subject, $message, $file_path, $cc, $bcc))
	{
		echo '<br> Can not send mail <br>';
	}
	else
	{
		echo '<br> Mail sent successfully <br>';
	}
	
}
?>


