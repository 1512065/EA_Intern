<?php
$_SESSION['isLogIn']=0;
echo 'User loged out successful!';
?>
<div <div align="center"> 
	<form action="authen_login" method="post">
		Username: <input type="text" name="iusername"><br><br>
		Password: <input type="text" name="ipassword"><br><br>
		<button type="submit">LOG IN</button>
	</form>
</div>
