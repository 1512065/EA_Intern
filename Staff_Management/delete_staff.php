<?php 
	require_once('dbconnect.php');
	#QUERY
    $stmt = $connection->prepare("CALL DeleteStaff(?);");
	$stmt->bind_param("i", $iID);
	if(isset($_POST['iID']))
	{
		$iID=$_POST['iID'];
	}
	$stmt->execute();
	$stmt->close();
	mysqli_close($connection);
	unset($_POST['iID']);
	header("Location: manage_staff");
?>