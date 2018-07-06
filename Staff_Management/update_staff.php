<?php 
	require_once('dbconnect.php');
	#QUERY
    $stmt = $connection->prepare("CALL UpdateStaff(?,?,?,?,?);");
	$stmt->bind_param("issis", $uID, $uName, $uPhone, $uRoomID, $uJoin_date);
	if (isset($_POST['uID']))
	{
		$uID = $_POST['uID'];
	}
	if (isset($_POST['uName']))
	{
		$uName = $_POST['uName'];
	}
	if (isset($_POST['uPhone']))
	{
		$uPhone = $_POST['uPhone'];
	}
	if (isset($_POST['uRoomID']))
	{
		$uRoomID = $_POST['uRoomID'];
	}
	if (isset($_POST['uJoin_date']))
	{
		$uJoin_date = $_POST['uJoin_date'];
	}	
	#execute
	$stmt->execute();
	$stmt->close();
	mysqli_close($connection);
	unset($_POST['uID'],$_POST['uName'],$_POST['uPhone'],$_POST['uRoomID'],$_POST['uJoin_date']);
?>