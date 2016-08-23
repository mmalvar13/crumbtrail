<?php

//Api for the employee class

//POST a new employee?
//GET employee?
//do i need my cnm user id for "use"


require_once "autoloader.php";
require_once "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

use Edu\Cnm\CrumbTrail\ {Employ, Profile};

/**
 * api for the Employee class
 *
 * @author Victoria Chacon <victoriousdesignco@gmail.com>
 **/

//verify the session, start if not active
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();

}
//prepare and empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;

try {
	//grab mySQL conection
	$pdo = connectToEncryptedMySQL
	("/etc/apache2/capstone-mysql/crumbtrail.ini");

	//determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP-METHOD"] : $_SERVER["REQUEST_METHOD"];

	//sanitize input
	//using the Get method here...so I am not writing the "employ class" but a bridge between employ and profile?
//we wouldn't need an Id since this wouldn't be tracked right, this is destroyed once the employee verifies that they are part of the profile?
	$employProfileId = filter_input(INPUT_GET, "employProfileId", FILTER_SANITIZE_STRING);
	$employCompanyId = filter_input(INPUT_GET, "employCompanyId", FILTER_SANITIZE_STRING);
	//make sure the id is valid for methods that require it
	If(($method === "DELETE" || $method === "PUT") && (empty($id) === true || $id <0)) {
		throw(new InvalidArgumentException("id cannot be empty or negative", 405));
	}

	//handle GET request - if id is present, that employee is returned, otherwise all employees get returned???
}