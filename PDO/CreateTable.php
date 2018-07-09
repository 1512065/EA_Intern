<?php
	require_once('Db_connect.php');
	try
	{
		$sql = "CREATE TABLE student (
		ID int(5) PRIMARY KEY,
		FirstName varchar(30) NOT NULL,
		LastName varchar(30) NOT NULL,
		ClassNo int(5)
		)";
		$conn->exec($sql);
		echo "Table created";
	}
	catch (PDOException $e)
	{
		echo $sql."<br>".$e->getMessage();
	}
	$conn= null;
?>