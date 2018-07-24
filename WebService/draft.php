<?php
	$str = "Khongco123";
	echo base64_encode($str);
	echo chunk_split(base64_encode($str));
?>