<?php

//Api for the employee class

//POST a new employee?
//GET employee?
//do i need my cnm user id for "use"


require_once "autoloader.php";
require_once "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

use Edu\Cnm\CrumbTrail\ {
	Employ, Profile
};

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
	$profileName = filter_input(INPUT_POST, "profileName", FILTER_SANITIZE_STRING);
	$profileType = filter_input(INPUT_POST, "profileType", FILTER_SANITIZE_STRING);
	$profileEmail = filter_input(INPUT_POST, "profileEmail", FILTER_SANITIZE_EMAIL);
	//may possible write in GET to link to company------//
	//make sure the id is valid for methods that require it
	If(($method === "DELETE" || $method === "PUT") && (empty($id) === true || $id < 0)) {
		throw(new InvalidArgumentException("id cannot be empty or negative", 405));
	}

	//handle GET request - if id is present, that employee is returned, otherwise all employees get returned???
	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie();

		//get specific employee or all employees and update reply
		if(empty($id) === false) {
			$employ = Employ::getEmployByEmployCompanyIdAndEmployProfileId($pdo, $employCompanyId, $employProfileId);
			if($employ !== null) {
				$reply->data = $employ;
			}
		} elseif((empty($id)) === false) {
			$employ = Employ::getEmployByEmployProfileId($pdo, $employProfileId);
			if($employ !== null) {
				{
					$reply->data = $employ;
				}
			} elseif
			((empty($id)) === false) {
				$employ = Employ::getEmployByEmployCompanyId($pdo, $employCompanyid);
				if($employ !== null) {
					{
						$reply->data = $employ;
					}
				} else {
					$employs = Employ::getAllEmploys($pdo);
					if($employs !== null) {
						$reply->data = $employs;
					}
				}
			} elseif(($method === "PUT" || "POST")) {
				//verify Xsrf
				$requestContent = file_get_contents("php://input");
				$requestObject = json_decode($requestContent);

				//make sure employ profile is available
				if(empty($requestObject->employProfileId) === true) {
					throw(new InvalidArgumentException("No profile exists.", 405));
				}
				//make sure employ company id exists
				if(empty($requestObject->employCompanyId) === true) {
					throw(new InvalidArgumentException("No company exists.", 405));
				}
				//make sure the company id and the profile id exist
				if(empty($requestObject->employ) === true) {
					throw(new InvalidArgumentException("No employ Company id and employ Profile combination exists ", 405));
				}
				//here??
				if(empty($requestObject->profileName) === true) {
					throw(new InvalidArgumentException("No profile name exists", 405));
				}


				//perform actual PUT or POST
/*-------------------------------WHy is this here again?---------------*/
				if($method === "POST") {
					//makes sure tht everything I put in filter_sanitize exists
					if(empty($requestObject->profileName) === true) {
						throw(new InvalidArgumentException("Need to input employee name.", 405));
					}
					if(empty($requestObject->profileType) === true) {
						throw(new InvalidArgumentException("Need to input the owner or employee status.", 405));
					}
					if(empty($requestObject->profileEmail) === true) {
						throw(new InvalidArgumentException("Need to insert employee email.", 405));
					}
					$employ = Employ::getEmployByEmployCompanyIdAndEmployProfileId($pdo, $employCompanyId, $employProfileId);
					if($employ === null) {
						////create new relationship between profile and company id
						$employ = new Employ($requestObject->employCompanyId, $requestObject->employProfileId);
						$employ->insert($pdo);
						$profile = Profile::getProfileByProfileId($pdo, $requestObject->employProfileId);
						$profile->setProfileType($requestObject->profileType);
						$profile->update($pdo);
						// update profile here
					} else {
						throw (new InvalidArgumentException("This profile Id and Profile type combination does not exist.", 405));
					}
				}
			}
		}
	} elseif($method === "DELETE") {
		verifyXsrf();
		//retrieve employ to be deleted
		//would I want employ by company and profile id, in the case that a worker/co owner is part of many companies??
		$employ = Employ::getEmployByEmployCompanyIdAndEmployProfileId($pdo, $employCompanyId, $employProfileId);
		if($employ === null) {
			throw(new RuntimeException("No employ Company Id and employ Profile Id combination exists.", 404));
		}
		//delete employ
		$employ->delete($pdo);
		//update reply
		$reply->message = "Employee or CoOwner deleted successfully";

	} else {
		throw (new InvalidArgumentException("Invalid HTTP method Request"));
	}
	//update reply with exception information
} catch(Exception $exception) {
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


