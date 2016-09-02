<?php

//Api for the Event class

require_once(dirname(__DIR__, 2) . "/classes/autoload.php");
require_once(dirname(__DIR__, 2) . "/lib/xsrf.php");
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

use Edu\Cnm\CrumbTrail\ {
	Event, Point
};

/**
 * api for the Event class
 *
 * @author Victoria Chacon <victoriousdesignco@gmail.com>
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
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/crumbtrail.ini");

	//determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	//sanitize input
	$eventId = filter_input(INPUT_GET, "eventId", FILTER_VALIDATE_INT);
	//$eventId = filter_input(INPUT_GET, "eventId", FILTER_VALIDATE_INT);// TODO: I had a seperate "id" that is the same as eventId correct? or do i need to put in one with "id"???
	$eventTruckId = filter_input(INPUT_GET, "eventTruckId", FILTER_VALIDATE_INT);
	//TODO: Sure this is totally wrong, how do i work with event start time and event end time...Getting event start and end time would be seperate things here, even though they are together on line 76?
	//$eventStart = filter_input(INPUT_GET, "eventStart", DATE_ATOM);
	$eventLocationLat = filter_input(INPUT_GET, "eventLocationLat", FILTER_VALIDATE_FLOAT);
	$eventLocationLng = filter_input(INPUT_GET, "eventLocationLng", FILTER_VALIDATE_FLOAT);

	//make sure the id is valid for methods that require it
	if(($method === "DELETE" || $method === "PUT") && (empty($id) === true || $id < 0)) {
		throw(new InvalidArgumentException("id cannot be empty or negative", 405));
	}

	//copy from here...so far no issues in PHPstorm
	//handle the GET request- if id is present, that event is returned. Otherwise, all Events are returned
	if($method === "GET") {
		//set xsrf cookie
		setXsrfCookie();

		//get a specific event or all events and update reply
		if(empty($EventId) === false && empty($eventTruckId) === false) {
			$event = Event::getEventByEventIdAndEventTruckId($pdo, $eventId, $eventTruckId);
			if($event !== null) {
				$reply->data = $event;
			}
		} elseif((empty($truckId)) === false) {
			$event = Event::getEventByEventTruckId($pdo, $eventTruckId);
			if($event !== null) {
				$reply->data = $event;
			}
			//TODO: Would I need to have an elseif for event location, no right? if that were the case we would need to know the exact location? unecessesary?? "
		} elseif((empty($id)) === false) {
			$event = Event::getEventByEventId($pdo, $eventId);
			if($event !== null) {
				$reply->data = $event;
			}
		} elseif((empty($event)) === false) {
			$event = Event::getEventByEventEndAndEventStart($pdo);
			if($event !== null) {
				$reply->data = $event;
			}
		} //TODO: do we need to have a get all Events?? event end and event start get all active events which is waht we want.....having every event that was ever made would be  a disaster to have stored in the database right?
		//else {
			//$events = Event::getAllEvents($pdo);
			//if($events !== null) {
				//$reply->data = $events;
			//}
		//}
	} //
	elseif($method === "PUT" || $method === "POST") {

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
		//ToDO: is this correct??????? Event start time defaults to current correct?
		if(empty($requestObject->eventStart) === true) {
			throw(new InvalidArgumentException("No event start time found", 405));
		}
		if(empty($requestObject->eventEnd) === true) {
			throw(new InvalidArgumentException("No event end time set", 405));
		}
	}
//Perform actual PUT
	if($method === "PUT") {
		//retrieve the event to update
		$event = Event::getEventByEventId($pdo, $eventId);
		if($event === null) {
			throw (new RuntimeException("Event does not exist.", 404));
		}
		//put new event content into the event and update
		//TODO: why isnt this $requestObject working???
		$point = new Point(null, $requestObject->location->lat, $requestObject->location->lng);
		$event->setEventLocation($point);
		//TODO: Do we need event start...this is done as current, but the user still set it???
		$event->setEventStart($requestObject->eventStart);
		$event->setEventEnd($requestObject->eventEnd);
		$event->update($pdo);
		//update reply
		$reply->message = "Event end time updated successfully.";

	} elseif($method === "POST") {
		if(empty($requestObject->eventId) === true) {
			throw(new \InvalidArgumentException("No Event Id.", 405));
		}
		//because this is how angular will send the associate array.......
		$point = new Point($requestObject->location->lat, $requestObject->location->lng);
		$event = new Event(null, $requestObject->eventId, $requestObject->eventEnd, $requestObject->eventStart, $requestObject->eventLocation, null);
		$event->insert($pdo);;
		//update reply
		$reply->message = "Event created successfully.";
		//TODO Do i need a delete block???
	} elseif($method === "DELETE") {
		verifyXsrf();
		//retrieve event to be deleted
		$event = Event::getEventByEventId($pdo, $eventId);
		if($event === null) {
			throw(new RuntimeException("Event does not exist.", 404));
		}
		//delete the Event
		$event->delete($pdo);

		//update the reply
		$reply->message = "Event deleted successfully.";

	} else {
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




