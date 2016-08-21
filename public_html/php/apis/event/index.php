<?php

//Api for the event class

//POST a new event?

//POST end time?

//GET location?
//do i need my cnm user id for "use"

use Edu\Cnm\CrumbTrail\ {
	Event, Truck
};

require_once "autoloader.php";
require_once "/lib/xsrf.php";
require_once ("/etc/apache2/capstone-mysql/encrypted-config.php");

/**
 * api for the Event class
 *
 * @author Victoria Chacon <victoriousdesignco@gmail.com>
 **/

//verify the session, start if not active
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

//prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;

try {
	//grab mySQL connection
	//event.ini ?????
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/event.ini");

	//determine which HTTP method was used
	//WAT!!! need the code here explained....
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	//sanitize input
	//using the Get method here right? Would i need this for event Id??
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

}

