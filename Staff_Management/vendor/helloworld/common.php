<?php

$ROUTE_PREFIX = './Staff_Management/';

$ROUTE_ARR = array();

function registerRoute($path, $file = null, $prefix = null) {
	GLOBAL $ROUTE_PREFIX;
	GLOBAL $ROUTE_ARR;
	if (is_null($prefix)) {
		$prefix = $ROUTE_PREFIX;
	}
	if (is_null($file)) {
		$file = $path . '.php';
	}
	$file = $prefix . $file;
	
	$ROUTE_ARR[] = array(
		"path"=> $path,
		"file"=> $file,
	);
	
}

function initRoutes() {
	$request = $_SERVER['REQUEST_URI'];
	$rootPath = strtok($request,'/');
	#echo $rootPath;
	#$rootPath = $rootPath."/";
	#$request= str_replace($rootPath,'',$request);
	
	switch ($rootPath) {
	case 'login/':
		require_once('./Staff_Management/login.php');
		break;
	case 'history/':
	case 'history.php/':
		require_once('./Staff_Management/history.php');
		break;
	case 'authen_login.php/':
		require_once('./Staff_Management/authen_login.php');
		break;
		## ROOM
	case 'room/':
	case 'manage_room_delete.php?/':
	case 'manage_room_delete.php/':
		require_once('./Staff_Management/manage_room_delete.php');
		break;
	case 'delete_room.php/':
		require_once('./Staff_Management/delete_room.php');
		break;
	case 'insert_room.php/':
		require_once('./Staff_Management/insert_room.php');
		break;
	case 'updateroom.html?/':
	case 'update_room/':
		require_once('./Staff_Management/updateroom.html');
		break;
	case 'update_room.php/':
		require_once('./Staff_Management/update_room.php');
		break;
		## STAFF
	case 'staff/':
	case 'manage_staff.php?/':
	case 'manage_staff.php/':
		require_once('./Staff_Management/manage_staff.php');
		break;

	case 'delete_staff.php/':
		require_once('./Staff_Management/delete_staff.php');
		break;	
	case 'insert_staff.php/':
		require_once('./Staff_Management/insert_staff.php');
		break;
	case 'updatestaff.html?/':
	case 'update_staff':
		require_once('./Staff_Management/updatestaff.html');
		break;
	case 'update_room.php/':
		require_once('./Staff_Management/update_staff.php');
		break;
		
	default:
		require_once('./Staff_Management/login.php');
		break;
	
	}
}

function bootstrap() {
	initRoutes();
}