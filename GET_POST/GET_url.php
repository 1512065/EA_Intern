<div <div align="center"> 
<?php
	print ("Demo get data from client by URL <br>");
	print 'URL sample: http://helloworld.php-projects.local/GET_POST/GET_url.php?name=Duyen&class=it1';
?>
<a href="GET_url.php?name=Duyen&class=it1">Click to view demo</a><br>
<?php	
	print "<br> Result: <br>";
	if(isset($_GET["name"])) 
	{
		print "Name: $_GET[name] <br>";
	}
	if(isset($_GET["class"])) 
	{
		print "Class: $_GET[class] <br>";
	}
?>
</div>