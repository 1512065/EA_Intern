<?php
	ob_start();
	require_once('class.php');
	$staff = new Staff();
	echo '<form action="main">
		<input type="submit" value="BACK TO MENU"/><br><br></form>';
	echo "STAFF<br>";
	// TABLE
	$staff->show_all();
	
	//UPDATE
	if (isset($_POST['update']))
	{
//		var_dump($_POST);
		$staff->update_row($_POST['ID'],$_POST['First_name'],$_POST['Last_name'],$_POST['Dept_ID'],$_POST['Status'],$_POST['Avatar'],$_POST['Created_datetime']);
		header("Location: staff.php");
	}
	//DELETE
	if (isset($_POST['delete']))
	{
		$staff->delete_row($_POST['ID']);
		header("Location: staff.php");
	}
	//INSERT
	
	echo '<br>INSERT<br>
			<table border=1>
			<form method="post">
			<td><input type="int" name="ID"></td>
			<td><input type="text" name="First_name"></td>
			<td><input type="text" name="Last_name"></td>
			<td><input type="int" name="Dept_ID"></td>
			<td><input type="int" name="Status"></td>
			<td><input type="text" name="Avatar"></td>
			<td><input type="date" name="Created_datetime"></td>		
			<td><button type="submit" name="insert">INSERT</button></td></tr>
			</form></table>';
	if ($_POST['ID']!=0 and isset($_POST['insert']))
	{
		$staff->insert_row($_POST['ID'],$_POST['First_name'],$_POST['Last_name'],$_POST['Dept_ID'],$_POST['Status'],$_POST['Avatar'],$_POST['Created_datetime']);
		header("Location: staff.php");
	}
	
	//var_dump($_POST);

	$_POST = array();
	ob_end_flush();
?>