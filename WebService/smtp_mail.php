<?php
/**
 * Connecto to an SMTP and send the given message
 */
function smtp_mail($to, $from, $message, $user, $pass, $host, $port)
{
	if ($h = fsockopen($host, $port))
	{
		$data = array(
			0,
			"EHLO smtp.gmail.com",
			'AUTH LOGIN',
			base64_encode($user),
			base64_encode($pass),
			"MAIL FROM: <$from>",
			"RCPT TO: <$to>",
			'DATA',
			$message
		);
		$count =1;
		foreach($data as $c)
		{
			echo $count.'<br>';
			fwrite($h, "$c\r\n");
			while(substr(fgets($h, 256), 3, 1) != ' '){
				exit();
			}
			$count++;
		}
		fwrite($h, "QUIT\r\n");
		return fclose($h);
	}
}

ini_set('default_socket_timeout', 10);
$user = '<thduyen2397@gmail.com>';
$pass = '<Khongco123>';
$host = 'ssl://smtp.gmail.com';
//$host = 'ssl://email-smtp.us-east-1.amazonaws.com'; //Amazon SES
$port = 465;
$to = 'thduyen2397@gmail.com';
$from = 'thduyen2397@gmail.com';
$template = "Subject: =?UTF-8?B?VGVzdCBFbWFpbA==?=\r\n"
."To: <thduyen2397@gmail.com>\r\n"
."From: thduyen2397@gmail.com\r\n"
."MIME-Version: 1.0\r\n"
."Content-Type: text/html; charset=utf-8\r\n"
."Content-Transfer-Encoding: base64\r\n\r\n"
."PGgxPlRlc3QgRW1haWw8L2gxPjxwPkhlbGxvIFRoZXJlITwvcD4=\r\n.";
if(smtp_mail($to, $from, $template, $user, $pass, $host, $port))
{
	echo "Mail sent\n\n";
}
else
{
	echo "Some error occured\n\n";
}
?>

