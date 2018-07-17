<?php
	$my_file = '2018-06-28.log';
	$handle = fopen($my_file, 'r');
	$log = fread($handle,filesize($my_file));
	
	echo '<pre>';
	
	function getDatatype($subject, $type)
	{
		$pattern ="/(?<=\'$type\'\s=>\s)[^(,)]*/";
		preg_match_all($pattern, $subject, $result);
		$result = $result[0];
		return $result;
	}
	$type = getDatatype($log,'type');
	echo '<br>TYPE: <br>';
	print_r (array_count_values($type));
	
	$site_id = getDatatype($log,'site_id');
	echo '<br>SITE ID: <br>';
	print_r (array_count_values($site_id));

	
	$result = getDatatype($log,'result');
	echo '<br>RESULT: <br>';
	print_r (array_count_values($result));
	
	$member_seq = getDatatype($log,'member_seq');
	echo '<br>MEMBER SEQ: <br>';
	print_r (array_count_values($member_seq));
	
?>