<?php 
	session_start();
	//generate file_id
	if (!isset($_SESSION['file_id']))
	{
		$char= '0123456789';
		$id = '';
		for ($i = 0; $i < 14; $i++) 
		{
			$id .= $char[mt_rand(0, strlen($char) - 1)];
		}
		$_SESSION['file_id'] = $id;

	}
	$ROUTE_PREFIX = './File/';
	$request = $_SERVER['REQUEST_URI'];
	if (preg_match('/\/\?file=.*&mode=(view|download)/',$request))
	{
		require_once("$ROUTE_PREFIX".'file_process.php');
	}
	else
	{
		require_once("$ROUTE_PREFIX".'upload.php');
	}
?>
