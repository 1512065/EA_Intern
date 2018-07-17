<?php
	ob_start();
	require_once('db_connect.php');
	if ($_SESSION['isLogIn']!=1)
	{
	if (isset($_POST['iusername']) and isset($_POST['ipassword'])){	
	// Assigning values to variables.
		$a_username = $_POST['iusername'];
		$a_password = $_POST['ipassword'];
	// CHECK LOG IN
		GLOBAL $conn;
		$sql ="SELECT * from account WHERE Username='$a_username' and Password='$a_password'";
		$res = $conn->query($sql);
		$count = $res->rowCount();
		//echo $count;
		$_SESSION['isLogIn']=$count;	
		if ($count==1)
		{
			header("Location: main");
			$_SESSION['user_name']=$a_username;
		}		
	}			
	}
	if ($_SESSION['isLogIn'] == 1){
	//	echo $_SESSION['wait'];
		//check waiting page
		if (isset($_SESSION['wait']))
		{
			$page =$_SESSION['wait'];
			unset($_SESSION['wait']);
			//redirect
			header("Location: ".$page);
		}
		else // no page waiting
		{
			// SHOW MENU
			echo "Log in as ".$_SESSION['user_name'];
			echo '<div <div align="center"><br><br><br>-- CHOOSE FUNCTION --<br><br></div>';
			//BUTTON				
			//DEPARTMENT			
			echo '<div <div align="center"> <form action="department">
				<input type="submit" value="MANAGE DEPARTMENT"/></button><br></form> </div>';
			//STAFF
			echo '<div <div align="center"> <form action="staff">
				<input type="submit" value="MANAGE STAFF"/></button><br></form> </div>';
			//HISTORY		
			echo '<div <div align="center"> <form action="history">
				<input type="submit" value="HISTORY"/></button><br></form> </div>';
			//LOG OUT
			echo '<div <div align="center"> <form action="logout">
				<input type="submit" value="LOG OUT"/></button>
				</form> </div>';
		}
	}
	else{
			//LOG IN DENIED
			echo "Incorrect username or password"; 			
			echo '<div <div align="center"> <form action="main" method="post">
			Username: <input type="text" name="iusername"><br><br>
			Password: <input type="password" name="ipassword"><br><br>
			<input type="submit" value="LOG IN"/></button>
			</form> </div>';
			$_SESSION['isLogIn']=0;
		}
	ob_end_flush();
?>
