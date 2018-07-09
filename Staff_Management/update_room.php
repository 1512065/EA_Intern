<?php 
	require_once('dbconnect.php');
	#QUERY
    $stmt = $connection->prepare("CALL UpdateRoom (?,?,?,?);");
	$stmt->bind_param("isis", $uID, $uName, $uRoomNum, $uBranch);
	if(isset($_POST['uID']))
	{
		$uID=$_POST['uID'];
	}
	if(isset($_POST['uName']))
	{
		$uName=$_POST['uName'];
	}
	if(isset($_POST['uRoom']))
	{
		$uRoomNum=$_POST['uRoom']; 
	}
	if(isset($_POST['uBranch']))
	{
		$uBranch=$_POST['uBranch'];
	}
	$stmt->execute();
	$stmt->close();
	mysqli_close($connection);
	unset($_POST['uID'],$_POST['uName'],$_POST['uRoom'],$_POST['uBranch']);
	header("Location: manage_room_delete.php");
?>