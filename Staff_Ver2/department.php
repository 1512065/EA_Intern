<?php
	ob_start();
	require_once('class.php');
	$dept = new Department();
	echo '<form action="main">
		<input type="submit" value="BACK TO MENU"/><br><br></form>';
//	$dept->select_all();
/*	$dept->delete_row(1);
	$dept->insert_row(1,'IT',1,'HCM','2018-05-05');
	$dept->insert_row(2,'HR',1,'HCM','2018-05-04');
	$dept->insert_row(3,'HR',1,'HN','2018-03-04');
*/
//	$staff = new Staff();
/*	$staff->insert_row(1,'Elton','John',1,1,'Ava dir','2018-05-05');
	$staff->insert_row(2,'Thomas','Edison',1,1,'Ava dir','2018-05-04');	
	$staff->insert_row(3,'James','Michael',2,1,'Ava dir','2018-05-05');
*/	

//	$staff->select_all();

	
	echo "DEPARTMENT<br>";
	// TABLE
	$dept->show_all();
	
	//UPDATE
	if (isset($_POST['update']))
	{
		$dept->update_row($_POST['ID'],$_POST['Name'],$_POST['Status'],$_POST['Note'],$_POST['Created_datetime']);
		header("Location: department.php");
	}
	//DELETE
	if (isset($_POST['delete']))
	{
		$dept->delete_row($_POST['ID']);
		header("Location: department.php");
	}
	//INSERT
	echo '<br>INSERT<br>
			<table border=1>
			<form method="post">
			<td><input type="int" name="iID"></td>
			<td><input type="text" name="iName"></td>
			<td><input type="int" name="iStatus"></td>
			<td><input type="text" name="iNote"></td>
			<td><input type="date" name="iCreated_datetime"></td>			
			<td><button type="submit" name="insert">INSERT</button></td></tr>
			</form></table>';
	if ($_POST['iID']!=0 and isset($_POST['insert']))
	{
		$dept->insert_row($_POST['iID'],$_POST['iName'],$_POST['iStatus'],$_POST['iNote'],$_POST['iCreated_datetime']);
		header("Location: department.php");
	}

	
	
//	var_dump($_POST);

	$_POST = array();
	ob_end_flush();
?>