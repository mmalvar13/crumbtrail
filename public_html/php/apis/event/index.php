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
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

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
	//make sure the id is valid for methods that require it
	if(($method === "DELETE" || $method === "PUT") && (empty($id) === true || $id < 0)) {
		throw(new InvalidArgumentException("id cannot be empty or negative", 405));
	}

	//handle GET request - if id is present, that event is returned, otherwise all Events are returned
	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie();

		//get a specific event or all events and update reply
		if(empty($id) === false) {
			$event = Event::getEventByEventId($pdo, $id);
			if($event !== null) {
				$reply->data = $event;
			}
		} elseif((empty($id)) === false) {
			$event = Event::getEventByEventTruckId($pdo, $id);
			if($event !== null) {
				$reply->data = $event;
			}
		} elseif((empty($id)) === false) {
			$event = Event::getEventByEventLocation($pdo, $id);
			if($event !== null) {
				$reply->data = $event;
			}
		} elseif((empty($id)) === false) {
			$event = Event::getEventByEventIdAndEventTruckId($pdo, $id);
			if($event !== null) {
				$reply->data = $event;
			}
		} elseif((empty($id)) === false) {
			$event = Event::getEventByEventEndAndEventStart($pdo, $id);
			if($event !== null) {
				$reply->data = $event;
			}
		} else {
			$events = Event::getAllEvents($pdo);
			if($events !== null) {
				$reply->data = $events;
			}
		}
	} elseif ((method === "PUT" || "POST")) {
	}
}


