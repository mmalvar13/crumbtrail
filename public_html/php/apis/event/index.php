<?php
//Api for the Event class
require_once(dirname(__DIR__, 2) . "/classes/autoload.php");
require_once(dirname(__DIR__, 2) . "/lib/xsrf.php");
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
use Edu\Cnm\CrumbTrail\ {
	Event, Point, Truck, Company
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
	$reply->method = $method;
	//sanitize input
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
	//keep as id........keep an eye out for event id....switch to id.....
	$eventTruckId = filter_input(INPUT_GET, "eventTruckId", FILTER_VALIDATE_INT);
	// Sure this is totally wrong, how do i work with event start time and event end time...Getting event start and end time would be seperate things here, even though they are together on line 76? FIXED BELOW having these seperate is fine, fixed on line 76
	$eventStart = filter_input(INPUT_GET, "eventStart", FILTER_VALIDATE_INT);
	$eventEnd = filter_input(INPUT_GET, "eventEnd", FILTER_VALIDATE_INT);
	$eventLocationLat = filter_input(INPUT_GET, "eventLocationLat", FILTER_VALIDATE_FLOAT);
	$eventLocationLng = filter_input(INPUT_GET, "eventLocationLng", FILTER_VALIDATE_FLOAT);
	$companyId = filter_input(INPUT_GET, "companyId", FILTER_VALIDATE_INT);
	//make sure the id is valid for methods that require it
	if(($method === "PUT") && (empty($id) === true || $id < 0)) {
		throw(new InvalidArgumentException("id cannot be empty or negative", 405));
	}
	//copy from here...so far no issues in PHPstorm
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
		} elseif(empty($eventTruckId) === false) {
			$event = Event::getEventByEventTruckId($pdo, $eventTruckId);
			if($event !== null) {
				$reply->data = $event;
			}
			// Would I need to have an elseif for event location, no right? if that were the case we would need to know the exact location? unecessesary?? We dont need it this statement is correct"
		} elseif((empty($id)) === false) {
			$event = Event::getEventByEventId($pdo, $id);
			if($event !== null) {
				$reply->data = $event;
			}
		} // do we need to have a get all Events?? event end and event start get all active events which is waht we want.....having every event that was ever made would be  a disaster to have stored in the database right?
		else {
			//gets all active events.....
			$events = Event::getEventByEventEndAndEventStart($pdo);
			if($events !== null) {
				$reply->data = $events;
			}
		}
	} elseif($method === "PUT" || $method === "POST") {
		verifyXsrf();
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);
		//make sure event truck id is available
		//todo I just commented these two lines out to test. 9/3

		//make sure eventEnd is available
		if(empty($requestObject->eventEnd)=== true){
			throw(new \InvalidArgumentException("no event end time", 405));
		}
		//make sure event location is available
		//since all are used to find a location should all be used to ensure that a location is available??
		//location lat and long?? explanation...Angular will be aware of location, angular's representation will be different...Angular will have an object with two state variables 0) sate variable :lat (latitude) 1) lng (longitude) fixed on lines below....yay
		//todo commented out lines 110-123
		//angular event end and start.....milliseconds since the beginning of time.... 01, 01, 1970 12:00am UTC
		$ngEventEnd = filter_var($requestObject->eventEnd, FILTER_VALIDATE_INT);
		//floor? rounds a number down to the nearest integer......
		$eventEnd = DateTime::createFromFormat("U", floor($ngEventEnd / 1000), new DateTimeZone("UTC"));

//Perform actual PUT
		if($method === "PUT") {
			//retrieve the event to update
			$event = Event::getEventByEventId($pdo, $id);
			if($event === null) {
				throw (new RuntimeException("Event does not exist.", 404));
			}
			//put new event content into the event and update
			//$point = new Point($requestObject->location->lat, $requestObject->location->lng);//
			//$event->setEventLocation($point);
			//$event->setEventStart($requestObject->eventStart);
			$event->setEventEnd($eventEnd);
			$event->update($pdo);
			//update reply
			$reply->message = "Event end time updated successfully.";
		} elseif($method === "POST") {

			if(empty($requestObject->eventTruckId) === true) {
				throw(new \InvalidArgumentException("No event truck id exists.", 405));
			}
			if(empty($requestObject->eventLocation->lat) === true) {
				throw(new \InvalidArgumentException("No event latitude exists.", 405));
			}
			if(empty($requestObject->eventLocation->long) === true) {
				throw(new \InvalidArgumentException("No event longitude exists.", 405));
			}
			// is this correct??????? Event start time defaults to current correct? YES WooHoo!!!!

			if(empty($requestObject->eventStart) === true) {
				throw(new \InvalidArgumentException("No event start time found", 405));
			}
			$ngEventStart = filter_var($requestObject->eventStart, FILTER_VALIDATE_INT);
			$eventStart = DateTime::createFromFormat("U", floor($ngEventStart / 1000), new DateTimeZone("UTC"));


			//because this is how angular will send the associate array.......null given->consistency
			$reply->start = $eventStart;
			$point = new Point($requestObject->eventLocation->long, $requestObject->eventLocation->lat);
			$event = new Event(null, $requestObject ->eventTruckId, $eventEnd, $point, $eventStart);
			$event->insert($pdo);;
			//update reply≤
			$reply->message = "Event created successfully.";
		}
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