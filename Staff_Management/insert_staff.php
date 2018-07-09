<?php 
	require_once('dbconnect.php');
	#QUERY
    $stmt = $connection->prepare("INSERT INTO staff(ID,Name,Phone,RoomID,Join_date) values(?,?,?,?,?);");
	$stmt->bind_param("issis", $iID, $iName, $iPhone, $iRoomID, $iJoin_date);
	
	if (isset($_POST['iID']))
	{
		$iID = $_POST['iID'];
	}
	if (isset($_POST['iName']))
	{
		$iName = $_POST['iName'];
	}
	if (isset($_POST['iPhone']))
	{
		$iPhone = $_POST['iPhone'];
	}
	if (isset($_POST['iRoomID']))
	{
		$iRoomID = $_POST['iRoomID'];
	}
	if (isset($_POST['iJoin_date']))
	{
		$iJoin_date = $_POST['iJoin_date'];
	}	
	#execute
	$stmt->execute();
	$stmt->close();
	mysqli_close($connection);
	unset($_POST['iID'],$_POST['iName'],$_POST['iPhone'],$_POST['iRoomID'],$_POST['iJoin_date']);
	header("Location: manage_staff.php");
?>