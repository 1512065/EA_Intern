<?php
class history{
	private $Staff_ID;
	private $Old_dept;
	private $New_dept;
	private $Time_stamp;
	public function show()
	{
		echo '<tr>';
		echo '<td>'.$this->Staff_ID.'</td>';
		echo '<td>'.$this->Old_dept.'</td>';
		echo '<td>'.$this->New_dept.'</td>';
		echo '<td>'.$this->Time_stamp.'</td>';
		echo '</tr>';
	}
}
?>
<?php 
	require_once('db_connect.php');
	echo '<form action="main">
		<input type="submit" value="BACK TO MENU"/><br><br></form>';
		
	echo "HISTORY<br>";
	GLOBAL $conn;
		$sql ="SELECT * from history";
		$res = $conn->query($sql);
		echo '<table><table border=1>
			<tr>
			<th>Staff ID</th>
			<th>Old_dept</th>
			<th>New_dept</th>
			<th>Timestamp</th></tr>';
		foreach ($res->fetchALL(PDO::FETCH_CLASS,'history') as $r)
		{
			$r->show();
		}
		echo '</table>';
		$conn=null;
?>