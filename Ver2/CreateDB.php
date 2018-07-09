<?php
	require_once('Db_connect.php');
	
	# CREATE DATABASE
	try
	{
		$sql = "CREATE DATABASE pdoDemo";
		$conn->exec($sql);
		echo "Database created";
	}
	catch(PDOException $e)
	{
		echo $sql."<br>".$e->getMessage();
	}
	# 
?>
