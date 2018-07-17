<?php

	function getDatatype($subject, $type)
	{
		$pattern ="/(?<=\'$type\'\s=>\s)[^(,)]*/";
		preg_match_all($pattern, $subject, $result);
		$result = $result[0];
		return $result;
	}
	
	function DayStatistic($day,$month)
	{
		$day = sprintf("%02d", $day);
		$month = sprintf("%02d", $month);
		$date = '2018-'.$month.'-'.$day;
		$my_file= $date.'.log';
		$handle = fopen($my_file, 'r');
		$log = fread($handle,filesize($my_file));
		echo '<pre>';
		echo '<br>**** '.$date.' ****<br>';
		$type = getDatatype($log,'type');
		//type
		echo "TYPE\t\tCOUNT <br>";
		echo "BC\t\t".count(array_keys($type, '\'BC\'')).'<br>';
		echo "BM\t\t".count(array_keys($type, '\'BM\'')).'<br>';
		echo "PC\t\t".count(array_keys($type, '\'PC\'')).'<br>';
		echo "TM\t\t".count(array_keys($type, '\'TM\'')).'<br>';
		//result 
		echo '<br>';
		$result = getDatatype($log,'result');
		echo "RESULT\t\tCOUNT<br>";
		echo "Success\t\t";
		echo count($result)-count(array_keys($result, '\'null\'')).'<br>';
		echo "Total\t\t";
		echo count($result);
	}
	
	// JUNE
	for ($d = 27; $d <= 30; $d++)
	{
		DayStatistic($d,6);
	}
	//JULY
	for ($d = 1; $d <= 17; $d++)
	{
		DayStatistic($d,7);
	}
	
	
	
?>