<?php

require_once(dirname(__DIR__, 2) . "/classes/autoload.php");//need to add these
require_once(dirname(__DIR__, 2) . "/lib/xsrf.php");
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
require_once(dirname(__DIR__, 4) . "/vendor/autoload.php");
require_once(dirname(__DIR__, 2) . "/lib/authorization.php");


use Edu\Cnm\CrumbTrail\{
	Profile, Company, Truck
};

/**
 * api for the Truck class
 *
 * @author Loren Baca baca.loren@gmail.com
 **/

//verify the session, start one if not active

if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

//prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null; //todo i added this today 9/3

//begin try section

try {
	//grab mySQL connection

	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/crumbtrail.ini");

	//determine which HTTP method was used, what does the ? mean??
	$method = array_key_exists("HTTP_X_HTTP-METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	//sanitize input(Explain this) Where is the input coming from??
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
	$truckCompanyId = filter_input(INPUT_GET, "truckCompanyId", FILTER_VALIDATE_INT);
//	$companyId = filter_input(INPUT_GET, "companyId", FILTER_VALIDATE_INT);//todo i just added this today 9/3


	//make sure the id is valid for methods that require it, Remember that $id is the primary key!
//	if(($method === "DELETE") && (empty($id) === true || $id < 0)) {
//		throw(new InvalidArgumentException("id cannot be empty or negative", 405));
//	}

	//handle GET request. if a truckId is present that truck is returned, otherwise all trucks are returned

	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie();

		//get a specific truck or all trucks and update reply
		if(empty($id) === false) {
			$truck = Truck::getTruckByTruckId($pdo, $id);
			if($truck !== null) {
				$reply->data = $truck;
			}
		} elseif(empty($truckCompanyId) === false) {
			$truck = Truck::getTruckByTruckCompanyId($pdo, $truckCompanyId);
			if($truck !== null) {
				$reply->data = $truck;
			}
		} else {
			$trucks = Truck::getAllTrucks($pdo);
			if($trucks !== null) {
				$reply->data = $trucks;
			}
		}

		//TODO need to ensure person adding/deleting trucks links back to the right company AND profile
		//todo i changed $pdo, $id to $pdo, $companyId
	} elseif($method === "POST") {
		verifyXsrf();
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);

		$companyId = $requestObject->truckCompanyId;

		if(empty($companyId) === true) {
			throw(new \InvalidArgumentException("No companyId", 405));
		}

		if(isEmployeeAuthorized($pdo, $companyId) === false) {
			throw(new \InvalidArgumentException("You are not authorized to modify a truck", 405));
		}

		//create a new truck and insert it into the database
		$truck = new Truck(null, $companyId); //TODO what information does $requestObject-> give you??
		$truck->insert($pdo);

		//update reply
		$reply->message = "Truck created A-OK";
	} elseif($method === "DELETE") {
		verifyXsrf();

		//retrieve the company to be deleted
		$truck = Truck::getTruckByTruckId($pdo, $id);

		//check if empty
		if($truck === null) {
			throw(new RuntimeException("The truck does not exist", 404));
		}

		if(isEmployeeAuthorized($pdo, $truck->getTruckCompanyId()) === false) {
			throw(new \InvalidArgumentException("You are not authorized to delete a truck", 405));
		}

		//delete the truck
		$truck->delete($pdo);

		//update the reply
		$reply->message = "Truck deleted A-OK";
	} else {
		throw (new InvalidArgumentException("Invalid HTTP method request"));
	}

//		else {
//		throw(new \InvalidArgumentException("Employee is not authorized to make changes"));
//	}

	//end of try, begging of catches
} catch(Exception $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
} catch(TypeError $typeError) {
	$reply->status = $typeError->getCode();
	$reply->message = $typeError->getMessage();
}

header("Content-type: application/json");
if($reply->data === null) {
	unset($reply->data);
}

// encode and return reply to front end caller
echo json_encode($reply);


