<?php
	require_once('Db_connect.php');
	try
	{
		$sql = "INSERT INTO student(ID,FirstName,LastName,ClassNo) VALUES (2,'Issac','Newron',1);";
		$conn->exec($sql);
		echo "Inserted";
	}
	catch (PDOException $e)
	{
		echo $sql."<br>".$e->getMessage();
	}
	$conn= null;
?>