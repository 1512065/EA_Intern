<?php session_start(); ?>
<?php

require_once('./Staff_Management/vendor/helloworld/common.php');
require_once('./Staff_Management/dbconfig.php');
// authenticate + authorize

//register route
$PATH_ARR = array('login','history','authen_login','manage_room',
'delete_room','insert_room','update_room','manage_staff','delete_staff',
'insert_staff','update_staff','dbconnect','updateroom','dbconfig','updatestaff','logout'
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
foreach ($ROUTE_ARR as $aaa)
{
	switch ($aaa['path']){
		case $rootPath:
			if ($_SESSION['isLogIn']==1 OR $rootPath=='authen_login') //loged in or checking log in
			{
				require_once($aaa['file']);
				$flag = 1;
			}
			else //not loged in
			{
				echo 'Please Log in first';
				require_once('./Staff_Management/login.php');
				$flag = 1;
			}		
			break;
	}
}
if ($flag == 0)
{
	echo 'Incorrect URL';
}
