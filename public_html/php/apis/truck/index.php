<?php

use Edu\Cnm\CrumbTrail\{
	Profile, Company, Truck
};

require_once "autoloader.php";
require_once "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

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

//begin try section

try {
	//grab mySQL connection

	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/tweet.ini");

	//determine which HTTP method was used, what does the ? mean??
	$method = array_key_exists("HTTP_X_HTTP-METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	//sanitize input(Explain this) Where is the input coming from??
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);


	//make sure the id is valid for methods that require it, Remember that $id is the primary key!
	if(($method === "DELETE" || $method === "PUT") && (empty($id) === true || $id < 0)) {
		throw(new InvalidArgumentException("id cannot be empty or negative", 405));
	}

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
		} elseif(empty($id) === false) {
			$truck = Truck::getTruckByTruckCompanyId($pdo, $id);
			if($truck !== null) {
				$reply->data = $truck;
			}
		}


	} elseif($method === "PUT" || "POST") { //this will probably only be POST right? we have nothing to update for the trucks
		verifyXsrf();
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);


		//Do i even need to create these???
		$profile = Profile::getProfileByProfileId($pdo, $id);
		$company = Company::getCompanyByCompanyId($pdo, $id);

		if($requestObject->profileType !== 'a' || 'o') {
			throw(new \InvalidArgumentException("profile type must be admin('a') or owner('o') in order to make changes to a truck"));
		}

		//make sure the truck foreign key is available (required field)
		if(empty($requestObject->truckCompanyId) === true) {
			throw(new \InvalidArgumentException("No foreign Id for truck", 405));
		}

		if($method === "POST") {
			//craete a new truck and insert it into the database
			$truck = new Truck(null, $requestObject->companyId);
			$truck->insert($pdo);

			//update reply
			$reply->message = "Truck created A-OK";
		}

		//delete section here
	} elseif($method === "DELETE") {
		verifyXsrf();
		//retrieve the company to be deleted
		$company = Company::getCompanyByCompanyId($pdo, $id);

		//check if empty
		if($company === null) {
			throw(new RuntimeException("The company does not exist", 404));
		}

		//delete the company
		$company->delete($pdo);

		//update the reply
		$reply->message = "Company deleted A-OK";
	} else {
		throw (new InvalidArgumentException("Invalid HTTP method request"));
	}

	//end of try, begging of catches
}catch(Exception $exception) {
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


