<?php
	
	ini_set("pcre.recursion_limit", "524");
	require_once('controller.php');	

	$directory = getcwd().'\log';
	$file_arr = getLogFile($directory);

	// Show selection
	echo 'Choose day:'.'<br>';
	echo'<form method="post"> <select name ="day1" >';
	//day
	foreach ($file_arr as $file)
	{
		$day = str_replace('.log','',$file);
		echo '<option value='.$day.'>'.$day.'</option>';
	}
	echo '</select><br><br>';
	//catory
	echo 'Choose catory:'.'<br>';
	echo '<select name ="catory">';
	echo '<option value="all" >Show all record</option>';
	echo '<option value="type" >Type</option>';
	echo '<option value="site_id" >Site ID</option>';
	echo '<option value="result">Result</option>';
	echo '</select><br><br>';
	echo '<input type ="submit" name="submit1" value ="View Statistics"/></form>';
	

	if (isset($_POST['submit1']))
	{
		$day = $_POST['day1'];
		$catory = $_POST['catory'];
		$result = Statistic($directory, $day, $catory);
		
		// show result:
		echo '<br>**** '.$day.' ****<br>';
		if ($catory != 'all')
		{
			echo "$catory\t\tcount<br>";
			foreach ($result as $name => $count)
			{
				echo $name."\t\t".$count.'<br>';
			}
		}
		else
		{
			foreach ($result as $rec)
			{
				print_r ($rec);
			}
		}
	}	
	
	// OPTIONAL STATISTIC
	echo '</pre>';
	echo '<br>____________________________________________<br><br>';
	echo 'Optional statistic:'.'<br>';
	echo'<form method="post"> <select name ="day2" >';
	//day
	foreach ($file_arr as $file)
	{
		$day = str_replace('.log','',$file);
		echo '<option value='.$day.'>'.$day.'</option>';
	}
	echo '</select><br><br>';
	//type
/*	echo 'Choose type:'.'<br>';
	echo '<select name ="type2">';
	GLOBAL $type_arr;
	echo '<option value="all" >all</option>';
	foreach ($type_arr as $type)
	{
		echo '<option value='.$type.'>'.$type.'</option>';
	}
	echo '</select><br><br>';
	// site_id
	echo 'Choose site_id:'.'<br>';
	echo '<select name ="site_id2">';
	GLOBAL $site_id_arr;
	echo '<option value="all" >all</option>';
	foreach ($site_id_arr as $site_id)
	{
		echo '<option value='.$site_id.'>'.$site_id.'</option>';
	}
	echo '</select><br><br>';
	// result
	echo 'Choose result:'.'<br>';
	echo '<select name ="result2">';
	GLOBAL $site_id_arr;
	echo '<option value="all" >all</option>';
	echo '<option value="success" >success</option>';
	echo '<option value="unsuccess" >unsuccess</option>';
	echo '</select><br><br>';	
	echo '<input type ="submit" name="submit2" value ="View Statistics"/></form>';
*/	
	echo '
	<form method="post">';
	GLOBAL $type_arr;
	echo '-- TYPE --<br>';
	foreach ($type_arr as $type)
	{
		echo '<input type="checkbox" name ="type2[]" value="'.$type.'">'.$type.'<br>';
	}
	//site
	GLOBAL $site_id_arr;
	echo '<br>-- SITE ID --<br>';
	foreach ($site_id_arr as $site_id)
	{
		echo '<input type="checkbox" name ="site_id2[]" value="'.$site_id.'">'.$site_id.'<br>';
	}
	//res
	echo '<br>-- RESULT -- <br><input type="checkbox" name ="result2[]" value="success"> SUCCESS <br>';
	echo '<input type="checkbox" name ="result2[]" value="unsuccess"> UNSUCCESS <br><br>';
	echo '<input type ="submit" name="submit2" value ="View Statistics"/></form>';
	
	if (isset($_POST['submit2']))
	{
		$day = $_POST['day2'];
		$type = $_POST['type2'];
		$site_id = $_POST['site_id2'];
		$result_arr = $_POST['result2'];
		
		// show result:
		$res = Statistic_Opt($directory, $day, $type, $site_id, $result_arr);
		echo '<br> NUMBER OF RECORD: ';
		echo count($res);
		echo '<br><br> RECORDS <br>';
		echo '<pre>';
		print_r ($res);
		echo '</pre>';
	
		
	}	
		
?>