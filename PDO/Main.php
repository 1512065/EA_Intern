<?php
	require_once('Db_connect.php');
	include('Student.php');
	
	#demo fetch class
	$sql ="SELECT * from student";
	$res = $conn->query($sql);
	#$result = $conn->fetchALL(PDO::FETCH_CLASS,'student');
	echo '<table><tr>
		<th>ID</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Class</th></tr>';
	foreach ($res->fetchALL(PDO::FETCH_CLASS,'student') as $r)
	{
		$r->showInfo();
	}
	echo '</table>';
?>