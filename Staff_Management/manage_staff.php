<?php
	require_once('dbconnect.php');
	#QUERY
	$query = "SELECT * from `staff`";
	$result = mysqli_query($connection, $query) or die(mysqli_error($connection));	
	$count = mysqli_num_rows($result);
	#SHOW RESULT
	if ($result->num_rows > 0) {
		echo "<table border='1'>
		<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Phone</th>
		<th>Room Number</th>
		<th>Join date</th>
		</tr>";

	while($row = mysqli_fetch_array($result))
	{
		echo "<tr>";
		echo "<td>" . $row['ID'] . "</td>";
		echo "<td>" . $row['Name'] . "</td>";
		echo "<td>" . $row['Phone'] . "</td>";
		echo "<td>" . $row['RoomID'] . "</td>";
		echo "<td>" . $row['Join_date'] . "</td>";
		echo "</tr>";
	}
	echo "</table>";
	
	mysqli_close($connection);
	
	# CHOOSE FUNCTION
	echo "<br><br><br>";
	# DELETE
	# delete
	echo '<form action="delete_staff.php" method="post"> DELETE ID: <input type="int" name="iID">
		<button type="submit">DELETE</button>
		</form>';
	# INSERRT
	echo '<br><br>INSERT NEW STAFF: <br>';
	echo '<form action="insert_staff.php" method="post">
		ID:<br>
		<input type="int" name="iID"><br>
		Name:<br>
		<input type="text" name="iName"><br>
		Phone:<br>
		<input type="int" name="iPhone"><br>
		Room ID:<br>
		<input type="int" name="iRoomID"><br>
		Join_date:<br>
		<input type="date" name="iJoin_date"><br><br>
		<button type="submit">INSERT</button>
		</form>';
		
}
?>
