<?php 
	require_once('dbconnect.php');
	#QUERY
	$query = "SELECT * from `history`";
	$result = mysqli_query($connection, $query) or die(mysqli_error($connection));	
	$count = mysqli_num_rows($result);
	#SHOW RESULT
	if ($result->num_rows > 0) 
	{
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Time " . $row["Stamp_Time"]. " -- Old Room " . $row["OldRoom"]. " -- New Room " . $row["NewRoom"]. "<br>";
    }
	} else {
    echo "0 results";
	}
	mysqli_close($connection);
?>