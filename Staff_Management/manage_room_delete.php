<?php
	require_once('dbconnect.php');
	#QUERY
	$query = "SELECT * from `room`";
	$result = mysqli_query($connection, $query) or die(mysqli_error($connection));	
	$count = mysqli_num_rows($result);
	#SHOW RESULT
	if ($result->num_rows > 0) {
		echo "<table border='1'>
		<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Room Number</th>
		<th>Branch</th>
		</tr>";

	while($row = mysqli_fetch_array($result))
	{
		echo "<tr>";
		echo "<td>" . $row['ID'] . "</td>";
		echo "<td>" . $row['Name'] . "</td>";
		echo "<td>" . $row['RoomNum'] . "</td>";
		echo "<td>" . $row['Branch'] . "</td>";
		echo "</tr>";
	}
	echo "</table>";
	mysqli_close($connection);
	# CHOOSE FUNCTION
	echo "<br><br><br>";
	# delete
	echo '<form action="delete_room.php" method="post"> DELETE ID: <input type="int" name="iID">
		<button type="submit">DELETE</button>
		</form>';
	# insert
	echo "<br><br>INSERT NEW ROOM <br>";
	echo '<form action="insert_room.php" method="post">
	ID:<br>
	<input type="int" name="iID"><br>
	Name:<br>
	<input type="text" name="iName"><br>
	Room Number:<br>
	<input type="int" name="iRoom"><br>
	Branch:<br>
	<input type="text" name="iBranch"><br><br>
	<button type="submit">INSERT</button>
	</form>';
	
}
?>
