<?php

require_once "autoloader.php";//where is this? same autoload.php as before or a new one?
require_once "/lib/xsrf.php"; //when do we make this?
require_once("/etc/apache2/capstone-mysql/encrypted-config.php"); //do i put crumbtrail-mysql here?

use Edu\Cnm\Crumbtrail\{Company, Profile}; //is this correct? i dont have to add mmalvar13 right? do i add company and profile like this?

/**
 * api for signUp
 *
 * @author Monica Alvarez <mmalvar13@gmail.com>
 **/

//verify the session, start if not active
if(session_status() !== PHP_SESSION_ACTIVE){
	session_start();
}

//prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;

try {
	//grab the mySQL connection
	$pdo = connectionToEncryptedMySQL("/etc/apache2/capstone-mysql/crumbtrail.ini"); //check notes for this

	//determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	//sanitize input
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

	//skipping "make sure the id is valid for the methods that require it"

	if($method === "POST") {
		//set XSRF cookie
		setXsrfCookie();

		verifyXsrf();
		$requestContent = file_get_contents("php://input"); //what is the directory reference here??
		$requestObject = json_decode($requestContent);

		//make sure profileId is empty because we are creating a new profile
		//is this where we throw exceptions for email and stuff?
		if(empty($requestObject->profileId) === false) {
			throw(new \InvalidArgumentException("This profile already exists", 405));
		}
		//make sure comapnyId is empty because we are signing up a new company
		if(empty($requestObject->companyId) === false) {
			throw(new \InvalidArgumentException("This company already exists", 405));
		}
		//make sure profileEmail is unique
		if(empty($requestObject->profileEmail) ===false ){
			throw(new \InvalidArgumentException("This email is already attached to another profile", 405)); //what error code would i throw. what do i compare the inserted profile email too? do I have to traverse an array of getAllEmails???
		}
		//make sure comapny business license is unique
		if(empty($requestObject->companyLicense) === false){
			throw(new \InvalidArgumentException("A company already exists under this business license", 405));
		}

		//what other exceptions do i throw here? what am i trying to catch here? and what do i try to catch in angular??
		//before hashing and salting, angular sends password and confirmed password. throw exception if they are not the same. requestObject->password/confirm password
		//hash and salt it here. same as in the test. whatever is in the setup method in test

		//create a new profile and insert it into the databases
		$profile = new Profile(null, $requestObject->profileName, $requestObject->profileEmail, $requestObject->profilePhone, $requestObject->profileAccessToken, $requestObject->profileActivationToken, $requestObject->profileType, $requestObject->profileHash, $requestObject->profileSalt);

		$profile->insert($pdo);

		//here i have companyDescription and companyMenuText.
		$company = new Company(null, $requestObject->companyAccountCreatorId, $requestObject->companyName, $requestObject->companyEmail, $requestObject->companyPhone, $requestObject->companyPermit, $requestObject->companyLicense, $requestObject->companyAttn, $requestObject->companyStreet1, $requestObject->companyStreet2, $requestObject->companyCity, $requestObject->companyState, $requestObject->companyZip, null , null, $requestObject->companyActivationToken, $requestObject->companyApproved);

		$company->insert($pdo);
		//swiftmailer code here

		//update reply
		$reply->message = "Check your email to activate";

	} else {
		throw(new InvalidArgumentException("Invalid HTTP method request"));
	}

	//update reply with exception information
}catch(Exception $exception){
		$reply->status = $exception->getCode();
		$reply->message = $exception->getMessage();
		$reply->trace = $exception->getTraceAsString();
	}catch(TypeError $typeError){
		$reply->status = $typeError->getCode();
		$reply->message = $typeError->getMessage();
	}

header("Content-type: application/json");
if($reply->data === null){
	unset($reply->data);
}

//encode and return reply to front end caller
echo json_encode($reply);

