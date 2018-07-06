<?php 
header("Content-type: text/html; charset=utf-8");
?>
<?php
	require_once('dbconnect.php');
	#require_once('login.php');
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
				echo '<div <div align="center"><br><br><br>-- CHOOSE FUNCTION --<br><br></div>';
				//BUTTON				
				//ROOM 			
				echo '<div <div align="center"> <form action="manage_room.php">
				<input type="submit" value="VIEW ALL ROOM"/></button><br></form> </div>';
				# INSERT ROOM
				echo '<div <div align="center"> <form action="insertroom.html">
				<input type="submit" value="INSERT ROOM"/></button><br></form> </div>';
				# UPDATE ROOM
				echo '<div <div align="center"> <form action="updateroom.html">
				<input type="submit" value="UPDATE ROOM"/></button><br></form> </div>';
				# DELETE ROOM
				echo '<div <div align="center"> <form action="deleteroom.html">
				<input type="submit" value="DELETE ROOM"/></button><br></form> </div>';
				//STAFF			
				echo '<div <div align="center"> <form action="manage_staff.php">
				<input type="submit" value="VIEW ALL STAFF"/></button><br></form> </div>';
				# INSERT STAFF
				echo '<div <div align="center"> <form action="insertstaff.html">
				<input type="submit" value="INSERT STAFF"/></button><br></form> </div>';
				# UPDATE STAFF
				echo '<div <div align="center"> <form action="updatestaff.html">
				<input type="submit" value="UPDATE STAFF"/></button><br></form> </div>';
				# DELETE STAFF
				echo '<div <div align="center"> <form action="deletestaff.html">
				<input type="submit" value="DELETE STAFF"/></button><br></form> </div>';
				//HISTORY
				echo '<div <div align="center"> <form action="history.php" method="post">
				<input type="submit" value="HISTORY"/><br></form> </div>';
				//LOG OUT				
				echo '<div <div align="center"> <form action="login.php">
				<input type="submit" value="LOG OUT"/></button>
				</form> </div>';
				}				
			else{
				//LOG IN DENIED
				echo "Incorrect username or password"; 	
				echo '<div <div align="center"> <form action="authen_login.php" method="post">
				Username: <input type="text" name="iusername"><br><br>
				Password: <input type="text" name="ipassword"><br><br>
				<input type="submit" value="LOG IN"/></button>
				</form> </div>';
				}
	}
;	
?>
