<?php
	require_once("dbconfig.php");
	try {
		$conn = new PDO("mysql:host=$servername", $username, $password);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		#echo "Connected successfully"; 
		}
	catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
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
