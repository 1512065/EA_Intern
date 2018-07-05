<?php
	GLOBAL $connection;
	$connection = mysqli_connect('localhost', $_POST['iusername'], $_POST['ipassword']);
	if (!$connection)
	{
		die("Database Connection Failed" . mysqli_error($connection));
	}
	$select_db = mysqli_select_db($connection, 'staff_manage');
	if (!$select_db){
    die("Database Selection Failed" . mysqli_error($connection));
}
?>