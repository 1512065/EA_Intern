<?php
	$str = "hello world 2018";
	echo base64_encode($str);
	echo chunk_split(base64_encode($str));
?>