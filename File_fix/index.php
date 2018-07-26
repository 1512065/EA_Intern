<?php
	$request = $_SERVER['REQUEST_URI'];
	if (preg_match('/\/\?file=.*&mode=(view|download)/',$request))
	{
		require_once('main.php');
	}
	else
	{
		require_once('main.php');
	}
?>