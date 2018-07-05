<div <div align="center"> 
<form action="POST.php" method="post">
     Name: <input type="text" name="name"><br><br>
	 Class: <input type="text" name="class"><br><br>
     <button type="submit">Send</button>
</form>

<?php 
	print "Name: ";
	if(isset($_POST["name"])) 
		{ echo $_POST["name"]; } 
	print "<br>Class: ";
	if(isset($_POST["class"]))
		{ echo $_POST["class"]; } 
?>
</div>