<?php
//
// var_dump($_SERVER['REQUEST_URI']);

// Load libs
// $rootPath = 

#die($_SERVER['REQUEST_URI']);

$request = $_SERVER['REQUEST_URI'];
$rootPath = strtok($request,'/');
#echo $rootPath;
$rootPath = $rootPath."/";
$request= str_replace($rootPath,'',$request);

#echo $request;
/*$str = $request_uri;
$url_part =  explode("/", $str);
*/
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
?>