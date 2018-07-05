<?php 
header("Content-type: text/html; charset=utf-8");
?>
<?php
	require_once('dbconnect.php');
	if (isset($_POST['iusername']) and isset($_POST['ipassword'])){	
	// Assigning values to variables.
			$username = $_POST['iusername'];
			$password = $_POST['ipassword'];

	// CHECK LOG IN
			mysqli_set_charset($connection, 'UTF8');
			$query = "SELECT * from `account` WHERE Username='$username' and U_Password='$password'";
			$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
			$count = mysqli_num_rows($result);
			if ($count >= 1){
				//LOG IN SUCCESS
				echo "Log in success";
				echo '<div <div align="center"><br><br><br>-- CHOOSE FUCTION --<br><br></div>';
				//BUTTON				
				
				// demo
				$query = "SELECT * from `history`";
				$result = mysqli_query($connection, $query) or die(mysqli_error($connection));	
				$count2 = mysqli_num_rows($result);
				
				
				//ROOM 			
				echo '<div <div align="center"> <form action="manage_room.php">
				<button type="submit">MANAGE ROOM</button><br></form> </div>';
				//STAFF			
				echo '<div <div align="center"> <form action="manage_staff.php">
				<button type="submit">MANAGE STAFF</button><br></form> </div>';
				//HISTORY
				echo '<div <div align="center"> <form action="history.php">
				<button type="submit">HISTORY</button><br></form> </div>';
				//LOG OUT
				
				echo '<div <div align="center"> <form action="login.php">
				<button type="submit">LOG OUT</button>
				</form> </div>';
				}				
			else{
				//LOG IN DENIED
				echo "Incorrect username or password"; 	
				echo '<div <div align="center"> <form action="authen_login.php" method="post">
				Username: <input type="text" name="iusername"><br><br>
				Password: <input type="text" name="ipassword"><br><br>
				<button type="submit">LOG IN</button>
				</form> </div>';
				}
	}
;	
?>
