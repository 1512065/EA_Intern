<?php
	require_once('Db_connect.php');
	try
	{
		$sql = "SELECT * FROM student";
		foreach($conn->query($sql) as $row)
		{
			echo "ID: ";
			echo $row['ID']."<br>";
			echo "Name: ";
			echo $row['FirstName']." ".$row['LastName'];
			echo " -- Class: ".$row['ClassNo'];
			echo "<br>";
		}
	}
	catch (PDOException $e)
	{
		echo $sql."<br>".$e->getMessage();
	}
	$conn= null;
?>