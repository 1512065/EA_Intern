<?php
//
// var_dump($_SERVER['REQUEST_URI']);

// Load libs

die($_SERVER['REQUEST_URI']);
switch ($_SERVER['REQUEST_URI']) {
	/*case '/staff':
		require_once('./controllers/Staff.php');
	break;
	case '/department':
		require_once('./controllers/Department.php');
	break;
	*/
	case './Staff_Management/authen_login.php':
		require_once('./Staff_Management/authen_login.php');
		break;
	
		
	default:
		require_once('./Staff_Management/login.php');
		
	break;
}