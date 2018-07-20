<?php

	require_once ('.\function.php');
	//list port
	$place = array('Tokyo(TYO)','Tokyo(HND)','Tokyo(NRT)','Sapporo(SPK)',
	'Seoul(SEL)','Busan(PUS)','Jeju(CJU)','Daegu(TAE)',
	'Taipei(TPE)','Kaohsiung(KHH)','Magong(MZG)','Tainan(TNN)',
	'Bangkok(BKK)','Phuket(HKT)','Ko Samui(USM)','Chiang Mai(CNX)',
	'New York(NYC)','Los Angeles(LAX)','San Francisco(SFO)','Chicago(CHI)',
	'Ho Chi Minh City(SGN)','Hanoi(HAN)','Da Nang(DAD)',
	'Sydney(SYD)','Perth(PER)','Cairns(CNS)','Melbourne(MEL)',
	'Singapore(SIN)');
	
	//select menu
	echo'<form method="post">';
	//dep_place
	echo '<br> Choose departure port: <br><select name ="dep_port_name0">';
	foreach ($place as $depart)
	{
		echo '<option value="'."$depart".'">'.$depart.'</option>';
	}
	echo '</select><br><br>';
	//arr_place
	echo '<br> Choose arrival port: <br><select name ="arr_port_name0">';
	foreach ($place as $arrive)
	{
		echo '<option value="'."$arrive".'">'.$arrive.'</option>';
	}
	echo '</select><br><br>';
	//day
	echo '<br> Choose day: <br>';
	echo '<input type="date" name="dep_date">';
	//cabin_class
	$cabin_arr = array('Economy'=>'Y','Bussiness' => 'C','First'=>'F');
	echo '<br><br><br> Choose seat class: <br><select name ="cabin_class">';
	foreach ($cabin_arr as $cabin => $value)
	{
		echo '<option value='.$value.'>'.$cabin.'</option>';
	}
	echo '</select><br><br>';
	//num of passenger: 
	echo '<br><br> Number of Passenegers: <br>';
	echo 'Adults: <input type ="text" name="adt_pax">';
	echo ' --- Child: <input type ="text" name="chd_pax">';
	echo ' --- Infant: <input type ="text" name="inf_pax">';
	echo '<br><br><input type ="submit" name="submit" value ="Search"/></form>';
	
	// after submit
	if (isset($_POST['submit']))
	{
		$url = 'https://skyticket.com/international-flights/ia_fare_result_mix.php?';
		$html = get_site_html($url);

		$data = getResultTbl($html);
		// get Data
		$flight_arr = getDetail($data); //store all record
		
		//show result
		echo '_____________________________<br>';
		echo '<br>Number of record: '.count($flight_arr).'<br><br>';
		$details = array ('airlines', 'dep_date' ,'arr_date', 'arr_place','total_time','price', 
		'flight_no', '1_dep_time_filter','flight_seat_warning_round','flight_seat_warning_round sold_out','fare_breakdown_total_amount');
		if (count($flight_arr)==0)
		{
			echo 'No result found!';
		}
		else
		{
			//style setting
			echo '<style>
			table, th, td {border: 1px solid black;}
			th, td {padding: 5px;text-align: left;} </style>';
			
			//heading
			echo '<table><tr>';
			echo '<th>ID</th>';
			foreach ($details as $props)
			{
				echo '<th>'.$props.'</th>';
			}
			echo '</tr>';

			//flight_info
			$count =1;
			foreach ($flight_arr as $flight)
			{
				echo '<tr>';
				echo '<td>'.$count.'</td>';
				foreach ($details as $props)
				{
					echo '<td>'.$flight["$props"].'</td>';
				}
				echo '</tr>';
				$count++;
			}
			echo '</table><br>';
		}
	}
	
?>