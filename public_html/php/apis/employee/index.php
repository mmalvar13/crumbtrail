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
	//...hmmm employee.ini???
	$pdo = connectToEncryptedMySQL
	("/etc/apache2/capstone-mysql/crumbtrail.ini");

	//determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP-METHOD"] : $_SERVER["REQUEST_METHOD"];

	//sanitize input
}