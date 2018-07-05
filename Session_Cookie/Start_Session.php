<?php
	session_start();
	if (isset($_SESSION['demo'])) 
	{
		$_SESSION['demo']+=1;
	}else
	{
		$_SESSION['demo']=1;
	}
	echo $_SESSION['demo'];
?>