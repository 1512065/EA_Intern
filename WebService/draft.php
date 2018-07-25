<?php
/*	$str = "Khongco123";
	echo base64_encode($str);
	echo chunk_split(base64_encode($str));
	
	$res='250 OK';
	preg_match('/\d{3}\s.',$res,$matches);
	print_r ($matches);
*/	

	echo '<form method="post">
	Attach:<br>
	<input type="file" name="file">
	<br> <br>   
	<input type="submit" name="submit" value="submit">
	</form> ';

	if (isset($_POST['submit']))
	{
		echo '<pre>';
		print_r ($_POST);
		print_r ($_FILE);
	}
	
?>