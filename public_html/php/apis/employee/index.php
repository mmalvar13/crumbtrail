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
