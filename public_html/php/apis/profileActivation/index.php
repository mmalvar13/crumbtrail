<?php

require_once "autoloader.php";
require_once "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

use Edu\Cnm\Crumbtrail; //por que greasy grissss????

/**
 * api for the profile activation API
 *
 * @author Monica Alvarez <mmalvar13@gmail.com>
 **/

//verify the session, start if not active
if(session_status() !== PHP_SESSION_ACTIVE){
	session_start();
}

//prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null; //making a placeholder for the variable reply. you will store stuff here later!!


try{
	//grab the mySQL connection
	$pdo = connectToEncyptedMySQL("/etc/apache2/capstone-mysql/profileActivation.ini");

	//determine which HTTP method was used. first one is the method you use, second is the fall back if the first is not available
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];


	//sanitize input
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

	//this one is probably the GET dylan was talking about! since the others were POSTs

	//handle GET request - if id is present, that profile is returned, otherwise all profiles are returned??
	if($method === "GET"){
		//set XSRF cookie
		setXsrfCookie();
	}
}