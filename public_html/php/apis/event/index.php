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

