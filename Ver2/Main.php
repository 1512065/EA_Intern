<?php
	require_once('Db_connect.php');
	include('Room.php');
	$stmt = $conn->prepare("SELECT * from staff");
	$stmt->setFetchMode(PDO::FETCH_CLASS.'Room');
	$stmt->fetchAll();
	
	for each
?>
