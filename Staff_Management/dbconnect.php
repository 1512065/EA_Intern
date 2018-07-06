<?php
	require_once('dbconfig.php');
	GLOBAL $connection;
	$connection = mysqli_connect($host,$username, $password);
	mysqli_set_charset($connection, 'UTF8');
	if (!$connection)
	{
		die("Database Connection Failed" . mysqli_error($connection));
	}
	$select_db = mysqli_select_db($connection, $database);
	if (!$select_db){
    die("Database Selection Failed" . mysqli_error($connection));
}
?>