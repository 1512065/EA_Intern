<?php 
	require_once('dbconnect.php');
	#QUERY
    $stmt = $connection->prepare("INSERT INTO room(ID,Name,RoomNum,Branch) values(?,?,?,?);");
	$stmt->bind_param("isis", $iID, $iName, $iRoomNum, $iBranch);
	if(isset($_POST['iID']))
	{
		$iID = $_POST['iID'];
	}
	if(isset($_POST['iName']))
	{
		$iName = $_POST['iName'];
	}
	if(isset($_POST['iRoom']))
	{
		$iRoomNum = $_POST['iRoom'];
	}
	if(isset($_POST['iBranch']))
	{
		$iBranch = $_POST['iBranch'];
	}
	#execute
	$stmt->execute();
	$stmt->close();
	mysqli_close($connection);
	unset($_POST['iID'],$_POST['iName'],$_POST['iRoom'],$_POST['iBranch']);
?>