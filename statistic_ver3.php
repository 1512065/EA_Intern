<?php
	
	ini_set("pcre.recursion_limit", "524");
	require_once('controller.php');	
	
	$directory = "C:\\xampp\htdocs\HelloWorld\RegularExpression\log";
	$file_arr = getLogFile($directory);
	
	// Show selection
	echo 'Choose day:'.'<br>';
	echo'<form method="post"> <select name ="day" >';
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
	echo '<input type ="submit" name="submit" value ="View Statistics"/></form>';
	
	if (isset($_POST['submit']))
	{
		$day = $_POST['day'];
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
	

		
?>