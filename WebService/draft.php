<?php
/*	$str = "Khongco123";
	echo base64_encode($str);
	echo chunk_split(base64_encode($str));
	*/
	$res='250 OK';
	preg_match('/\d{3}\s.*/',$res,$matches);
	print_r ($matches);
?>