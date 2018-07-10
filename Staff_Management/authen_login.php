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
			$_SESSION['isLogIn']=$count;			
	}
	// SHOW MENU
	if ($_SESSION['isLogIn'] == 1){
				//LOG IN SUCCESS
				$_SESSION['login_true']=1;
				echo "Log in success";
				echo '<div <div align="center"><br><br><br>-- CHOOSE FUNCTION --<br><br></div>';
				//BUTTON				
				//ROOM 			
				echo '<div <div align="center"> <form action="manage_room">
				<input type="submit" value="MANAGE ROOM"/></button><br></form> </div>';
				# UPDATE ROOM
				echo '<div <div align="center"> <form action="updateroom">
				<input type="submit" value="UPDATE ROOM"/></button><br></form> </div>';
				//STAFF			
				echo '<div <div align="center"> <form action="manage_staff">
				<input type="submit" value="MANAGE STAFF"/></button><br></form> </div>';
				# UPDATE STAFF
				echo '<div <div align="center"> <form action="updatestaff">
				<input type="submit" value="UPDATE STAFF"/></button><br></form> </div>';
				
				//HISTORY
				echo '<div <div align="center"> <form action="history" method="post">
				<input type="submit" value="HISTORY"/><br></form> </div>';
				//LOG OUT				
				echo '<div <div align="center"> <form action="logout">
				<input type="submit" value="LOG OUT"/></button>
				</form> </div>';
				}				
	else{
			//LOG IN DENIED
			echo "Incorrect username or password"; 			
			echo '<div <div align="center"> <form action="authen_login" method="post">
			Username: <input type="text" name="iusername"><br><br>
			Password: <input type="text" name="ipassword"><br><br>
			<input type="submit" value="LOG IN"/></button>
			</form> </div>';
			$_SESSION['isLogIn']=0;
		}
;	
?>
