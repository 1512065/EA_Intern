<?php
//	$html = file_get_contents('');

	ini_set("pcre.recursion_limit", "524");
//	include_once('simple_html_dom.php');
	$handle = fopen('craw.txt', 'r');
	$html = fread($handle,filesize('craw.txt'));
	$pattern ='/(<table\sid)[\w\W]*(<\/table>)/';
	preg_match($pattern, $html, $matches);
	echo '<pre>';

	$allflight = $matches[0];
	$split_patt = '/\/form/';
	$flight_arr = preg_split($split_patt, $allflight);
	array_pop($flight_arr);
	echo 'Number of record: '.count($flight_arr);
	echo '<br>';
	
	// get Data
	$data = array(); //store all record
	//$pattern ="/(?<=airlines\">)[^(<)]*/";
	function getData($subject, $type)
	{
		$pattern ="/(?<=".$type."\">)[^(<)]*/";
		if(preg_match_all($pattern, $subject, $result))
		{
			return $result[0][0];
		}
	}
	foreach ($flight_arr as $flight)
	{
		$sgl_flight = array(); //single flight
		$prop_arr = array ('airlines','flight_seat_warning_round','flight_seat_warning_round sold_out','dep_date','arr_date','1_dep_time_filter','total_time');
		//airlines
		foreach ($prop_arr as $prop)
		{
			$value = getData($flight, $prop);
			//echo $value.'<br>';
			$sgl_flight["$prop"] = $value;
			
		}
		//get price
		$pattern ="/(?<=data-price=\')[^(\')]*/";
		if(preg_match($pattern, $flight, $result))
		{
			$sgl_flight["price"] = $result[0];
		}
		//get route info
		$pattern ='/(<table>)[\w\W]*(<\/table>)/';
		if(preg_match($pattern, $flight, $result))
		{
			$route_tbl = $result[0];
		}			
		//get detail route info
		if(preg_match('/(?<=Route<\/td><td><p>)[^(<)]*/', $route_tbl, $result))
		{
			$plane = $result[0];
		}
		if(preg_match("/(?<=\"flight_no\">)[\w\W]*(?:）)/", $route_tbl, $result))
		{
			$sgl_flight["flight_no"] = $plane.$result[0];
		}	
		//get place
//		if(preg_match_all("/(?<=\"place\">)[^\/]*/", $route_tbl, $result))
		if(preg_match_all("/(?<=\"place\">)[^\/]*(?=<)/", $route_tbl, $result))
		{
			//print_r ($result);
			$sgl_flight["dep_place"] = $result[0][0];
			$sgl_flight["arr_place"] = $result[0][1];
		}
		array_push($data, $sgl_flight);
	}
	print_r ($data);
?>