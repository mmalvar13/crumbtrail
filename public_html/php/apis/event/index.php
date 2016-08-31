<?php

//Api for the Event class

require_once (dirname(__DIR__, 2) . "classes/autoload.php");
require_once (dirname(__DIR__, 2) . "/lib/xsrf.php");
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

use Edu\Cnm\CrumbTrail\ {Event, Truck, Point};

/**
 * api for the Event class
 *
 *@author Victoria Chacon <victoriousdesignco@gmail.com>
 **/

//verify the session start if not active
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

//prepare and empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;

try {
	//grab mySQL connection
	//capital SQL???
	//lowercase c in crumbtrail???
	$pdo = connectToEncryptedMySql("/etc/apache2/capstone-mysql/crumbtrail.ini");

	//determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	//sanitize input
	$id = filter_input(INPUT_GET, "eventId", FILTER_VALIDATE_INT);
	//$eventId = filter_input(INPUT_GET, "eventId", FILTER_VALIDATE_INT);// 39
	$eventTruckId = filter_input(INPUT_GET, "eventTruckId", FILTER_VALIDATE_INT);
	$eventLocationLat = filter_input(INPUT_GET, "eventLocationLat", FILTER_VALIDATE_FLOAT);
	$eventLocationLng = filter_input(INPUT_GET, "eventLocationLng", FILTER_VALIDATE_FLOAT);

	//make sure the id is valid for methods that require it
	if(($method === "DELETE" || $method === "PUT") && (empty($id) === true || $id < 0)) {
		throw(new InvalidArgumentException("id cannot be empty or negative", 405));
	}

	//copy from here...so far no issues in PHPstrom
	//handle the GET request- if id is present, that event is returned. Otherwise, all Events are returned
	if($method === "GET") {
		//set xsrf cookie
		setXsrfCookie();

		//get a specific event or all events and update reply
		if(empty($id) === false && empty($eventTruckId) === false) {
			$event = Event::getEventByEventIdAndEventTruckId($pdo, $id, $eventTruckId);
			if($event !== null) {
				$reply->data = $event;
			}
		} elseif ((empty($truckId)) === false) {
			$event = Event::getEventByEventTruckId($pdo, $eventTruckId);
			if($event !== null) {
				$reply->data = $event;
			}
			//TODO: WAT!!!!
		} elseif ((empty($id)) === false) {
			$event = Event::getEventByEventId ($pdo, $id);
			if($event !== null) {
				$reply->data = $event;
			}
		} elseif ((empty($event)) === false) {
			$event = Event::getEventByEventEndAndEventStart ($pdo);
			if($event !== null) {
				$reply->data = $event;
			}
		} else {
			$events = Event::getAllEvents($pdo);
			if($events !== null) {
				$reply->data = $events;
			}
		}
	}

//elseif here? Since there is no PUT
	elseif(($method === "POST")) {
		//what does "verifyXsrf" and the "php://input" do again?
		verifyXsrf();
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);

		//make sure the event is available
		if(empty($requestObject->eventId) === true) {
			throw(new \InvalidArgumentException("No event exists.", 405));
		}
		//make sure event truck id is available
		if(empty($requestObject->eventTruckId) === true) {
			throw(new \InvalidArgumentException("No event truck id exists.", 405));
		}
		//make sure event location is available
		//since all are used to find a location should all be used to ensure that a location is available??
		//TODO: location lat and long?? explanation
		if(empty($requestObject->eventLocationLat->eventLocationLng->point) === true) {
			throw(new \InvalidArgumentException("No event location exists.", 405));
		}
	}
//Perform actual PUT
	if($method === "PUT") {
		//retrieve the event to update
		$event = Event::getEventByEventId($pdo, $id);
		if($event === null) {
			throw (new RuntimeException("Event does not exist.", 404));
		}
		//put new event content into the event and update
		//TODO: why isnt this working???
		$point = new Point(null, $requestObject->location->lat, $requestObject->location->lng);
		$event->setEventLocation($point);
		//TODO: Do we need event start...this is done as current, but the user still set it???
		$event->setEventStart($requestObject->eventStart);
		$event->setEventEnd($requestObject->eventEnd);
		$event->update($pdo);
		//update reply
		$reply->message = "Event end time updated successfully.";

	} elseif ($method === "POST") {
		if(empty($requestObject->eventId) === true) {
			throw(new \InvalidArgumentException("No Event Id.", 405));
		}
		//because this is how angular will send the associate array.......
		$point = new Point($requestObject->location->lat, $requestObject->location->lng);
		$event = new Event(null, $requestObject->eventId, $requestObject->eventEnd, $requestObject->eventStart,$requestObject->eventLocation, null);
		$event->insert($pdo);;
		//update reply
		$reply->message = "Event created successfully.";
	//TODO Do i need a delete block???
	} elseif ($method === "DELETE") {
		verifyXsrf();
		//retrieve event to be deleted
		$event = Event::getEventByEventId($pdo, $id);
		if($event === null) {
			throw(new RuntimeException("Event does not exist.", 404));
		}
		//delete the Event
		$event->delete($pdo);

		//update the reply
		$reply->message = "Event deleted successfully.";

	}else {
		throw (new InvalidArgumentException("Invalid HTTP method request"));
	}
	//update the reply with exception information

} catch
(Exception $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
	$reply->trace = $exception->getTraceAsString();
} catch(TypeError $typeError) {
	$reply->status = $typeError->getCode();
	$reply->message = $typeError->getMessage();
}
header("Content-type: application.json");
if($reply->data === null) {
	unset($reply->data);
}
//encode and return reply to front end caller
echo json_encode($reply);




