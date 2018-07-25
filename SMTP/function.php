<?php
function check_reply($socket, $response)
{
    $server_response = fgets($socket, 256);
//	var_dump($server_response);
	//check error
	while (!preg_match('/(\d{3})\s.*/', $server_response,$matches))
	{
		$server_response = fgets($socket, 256);
	}
	// get response number
    if ($matches[1] !== $response)
    {
      echo 'Mail can not be sent<br>';
	  echo $matches[0];
	  exit();
    }
}

function send_smtp_mail($authen, $to, $subject, $message, $file_path, $cc, $bcc)
{
    $recipients = explode(',', $to);
    $user = $authen['user'];
    $pass = $authen['password'];
    $smtp_host = 'ssl://smtp.gmail.com';
    $smtp_port = 465;
	//connect
    if (!($socket = fsockopen($smtp_host, $smtp_port, $errno, $errstr, 15)))
    {
      echo "Error connecting to '$smtp_host' ($errno) ($errstr)";
    }
    else 
    {
    	echo 'Connected to server<br>';
    }
    check_reply($socket, '220');
	
    fwrite($socket, 'HELO '.'smtp.gmail.com'."\r\n");
    check_reply($socket, '250');
	
	// authenticate
    fwrite($socket, 'AUTH LOGIN'."\r\n");
    check_reply($socket, '334');
    fwrite($socket, base64_encode($user)."\r\n");
    check_reply($socket, '334');
	fwrite($socket, base64_encode($pass)."\r\n");
    check_reply($socket, '235');
	
	//mail from
	fwrite($socket, 'MAIL FROM: <'.$user.'>'."\r\n");
    check_reply($socket, '250');

	//to
	foreach ($recipients as $email)
    {
        fwrite($socket, 'RCPT TO: <'.$email.'>'."\r\n");
        check_reply($socket, '250');
    }

	//body
	fwrite($socket, 'DATA'."\r\n");
    check_reply($socket, '354');
 
	fwrite($socket,"From: <$user>"."\r\n");
	if ($cc!='')
	{
		fwrite($socket,"Cc: $cc"."\r\n");
	}
	if ($bcc!='')
	{
		fwrite($socket,"Bcc: $bcc"."\r\n");
	}
	fwrite($socket,"MIME-Version: 1.0\r\n");
	fwrite($socket, 'Subject: '.$subject."\r\n");
	if ($file_path=='') //no attachments
	{
		fwrite($socket,"Content-Type: text/html\r\n");
		fwrite($socket, $message."\r\n");
	}
	else //attach file
	{
		//file process
		$file = $file_path;
		$file_size = filesize($file);
		$handle = fopen($file, "r");
		$content = fread($handle, $file_size);
		fclose($handle);

		$content = chunk_split(base64_encode($content));
		$name = basename($file);
		$uid = md5(uniqid(time()));	
		fwrite($socket,"Content-Type: multipart/mixed; boundary=\"".$uid."\""."\r\n");
		fwrite($socket,"\r\n");
		fwrite($socket,'--'.$uid."\r\n");
		fwrite($socket,"Content-Type: text/html"."\r\n");
		fwrite($socket,"Content-Transfer-Encoding: 8bit\r\n\r\n");
		fwrite($socket,"$message\r\n");
		fwrite($socket,"--$uid\r\n");
		// attach
		fwrite($socket,"Content-Type: application/octet-stream; name=\"".$name."\""."\r\n");
		fwrite($socket,"Content-Transfer-Encoding: base64\r\n");
		fwrite($socket,"Content-Disposition: attachment; filename=\"".$name."\""."\r\n");
		fwrite($socket, $content."\r\n");
		fwrite($socket,"$uid--\r\n\r\n");
		
	}
	//end mail
    fwrite($socket, '.'."\r\n");
    check_reply($socket, '250');
 
    fwrite($socket, 'QUIT'."\r\n");
    fclose($socket);
   
	return true;
}
?>