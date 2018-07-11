<?php

$ROUTE_PREFIX = './Staff_Ver2/';

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

function bootstrap() {
	initRoutes();
}