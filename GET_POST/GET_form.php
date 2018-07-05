<div <div align="center"> 
<form action="GET_form.php" method="get">
     Name: <input type="text" name="name"><br><br>
	 Class: <input type="text" name="class"><br>
     <button type="submit">Send</button>
</form>

<?php 
	print "Name: ";
	if(isset($_GET["name"])) 
		{ echo $_GET["name"]; } 
	print "<br>Class: ";
	if(isset($_GET["class"]))
		{ echo $_GET["class"]; } 
?>
</div>