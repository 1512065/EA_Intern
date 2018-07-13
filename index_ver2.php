<?php session_start(); ?>
<?php

require_once('./Staff_Ver2/vendor/common.php');
#require_once('./Staff_Ver2/dbconfig.php');
// authenticate + authorize

//register route
$PATH_ARR = array('login','history','main','department','staff','authen_login','logout'
);
foreach ($PATH_ARR as $path)
{
	registerRoute($path);
}

GLOBAL $ROUTE_ARR;
// get rootPath
$request = $_SERVER['REQUEST_URI'];
$rootPath = strtok($request,'/');
$rootPath = strtok($request,'?');
$rootPath = str_replace('?','',$rootPath);
$rootPath = str_replace('/','',$rootPath);

$flag = 0;

//init Route
foreach ($ROUTE_ARR as $route)
{
	switch ($route['path']){
		case $rootPath:
			if ($_SESSION['isLogIn']==1 OR $rootPath=='main') //loged in or checking log in
			{
				require_once($route['file']);
				$flag = 1;
			}
			else //not loged in
			{
				echo 'Please Log in first';
				$_SESSION['wait'] = $rootPath; // save waiting page
				require_once('./Staff_Ver2/login.php');
				$flag = 1;
			}		
			break;
	}
}
if ($flag == 0)
{
	echo 'version 2';
	require_once('./Staff_Ver2/login.php');
}
