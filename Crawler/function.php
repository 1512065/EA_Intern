<?php	
// get 
function get_site_html($site_url) 
{
    $ch = curl_init();
	//get dep_port + arr_port
	$pattern = '/(?<=\()[^(\))]*/';
	preg_match($pattern,$_POST['dep_port_name0'],$matches);
	$dep_port = $matches[0];
	preg_match($pattern,$_POST['arr_port_name0'],$matches);
	$arr_port = $matches[0];
	
	$adults =0;
	if (isset($_POST['adt_pax']))
	{
		$adults = $_POST['adt_pax'];
	}
	$data = array(
	'ia_common_js_select_airline' => null,
	'trip_type' => 1,
	'dep_port_name0' => $_POST['dep_port_name0'],
	'dep_port0' => $dep_port,
	'arr_port_name0' => $_POST['arr_port_name0'],
	'arr_port0'=> $arr_port,
	'dep_date[]'=> $_POST['dep_date'],
	'cabin_class'=> $_POST['cabin_class'],
	'adt_pax'=> $adults,
	'chd_pax' => $_POST['chd_pax'],
	'inf_pax' => $_POST['inf_pax']
	);
	$query_str = http_build_query($data);
	$res_url = $site_url.$query_str;
	
    curl_setopt($ch, CURLOPT_COOKIESESSION, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 4);
    curl_setopt($ch, CURLOPT_FORBID_REUSE, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($ch, CURLOPT_URL, $res_url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close ($ch);
	
    return $response; 
	
}

function getResultTbl($html)
{
	$pattern = '/(<table\sid)[\w\W]*(<\/table>)/';
	if(preg_match($pattern, $html, $matches))
	{
		$allflight = $matches[0];
		$split_patt = '/\/form/';
		$flight_arr = preg_split($split_patt, $allflight);
		array_pop($flight_arr);
		return $flight_arr;
	} else return array();
}
	
function getData($subject, $type)
{
		$pattern = "/(?<=".$type."\">)[^(<)]*/";
		if(preg_match_all($pattern, $subject, $result))
		{
			return $result[0][0];
		}
}	

function getDetail($flight_arr)
{
	$data = array();
	foreach ($flight_arr as $flight)
	{
		$sgl_flight = array(); //single flight
		$prop_arr = array ('airlines','flight_seat_warning_round','flight_seat_warning_round sold_out','dep_date','arr_date','1_dep_time_filter','total_time','fare_breakdown_total_amount');
		//get props
		foreach ($prop_arr as $prop)
		{
			$value = getData($flight, $prop);
			$sgl_flight["$prop"] = $value;
			
		}
		//get price
		$pattern ="/(?<=data-price=\')[^(\<)]*/";
		if(preg_match($pattern, $flight, $result))
		{
			$temp = $result[0];
			if(preg_match('/(?<=\>).*/', $temp, $result2))
			{
				$sgl_flight["price"] = $result2[0];
			}
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
		if(preg_match_all("/(?<=\"place\">)[^\/]*(?=<)/", $route_tbl, $result))
		{
			$sgl_flight["dep_place"] = $result[0][0];
			$sgl_flight["arr_place"] = $result[0][1];
		}
		array_push($data, $sgl_flight);
	}
	return $data;
}
?>