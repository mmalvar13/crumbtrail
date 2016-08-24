<?php

require_once "autoloader.php";
require_once "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php"); //dirnamedirs

use Edu\Cnm\Crumbtrail\{Profile};

/**
 * api for sign in
 *
 * @author Monica Alvarez <mmalvar13@gmail.com>
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
	//grab the mySQL connection
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/signin.ini"); // what do i write here?

	//determine which HTTP method was used
	$method = array_key_exists("HTTP_x_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	//sanitize input
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);//do not need

	//handle POST request - if id is present, that account is returned, otherwise all accounts are returned?? nooo.

	if($method === "POST") {
		//set XSRF cookie
		setXsrfCookie();

		verifyXsrf();
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);

		//check that profile activation token is null. if not, throw an exception.
		if($requestObject->profileActivationToken !== null) {
			throw(new InvalidArgumentException("Your account has not been activated or does not exist"));
		}

		//check that email and password fields are not empty, and sanitize that filthy input
		if(empty($requestObject->profileEmail) === true) {
			throw(new \InvalidArgumentException("You must enter your email address", 405));
		} else {
			$profileEmail = filter_var($requestObject->profileEmail, FILTER_SANITIZE_EMAIL);
		}

		//checking the password field for user input
		if(empty($requestObject->profilePassword) === true) {
			throw(new \InvalidArgumentException("Please enter your password", 405));
		} else {
			$password = filter_input($requestObject->profilePassword, FILTER_SANITIZE_STRING);
		}

		$profile = Profile::getProfileByProfileEmail($pdo, $profileEmail);

		//use profile salt to hash password
		$salt = $profile->getProfileSalt();

		//create the hash
		$confirmHash = hash_pbkdf2("sha512", $requestObject->confirmProfilePassword, $salt, 262144);

		//matches hashes
		//put profile into session
		if($confirmHash === $profile->getProfileHash()) {
			$_SESSION["profile"] = $profile;
			$reply->status = 200;
			$reply->message = "Successfully logged in";
		} else {
			throw(new InvalidArgumentException("email or password is invalid", 401));
		}
	else{
			throw(new InvalidArgumentException("email or password is invalid", 401));
		}
	}


	//create the user's profile session somehow here
	//throw an exception if they have an activation token. BRO, do you even profile?!
	//get those secret potatoes and compare it with the user input --if there isn't a match then BRO DO YOU EVEN PASSWORD???
	//something happens with a session somewhere in here.

//catch(Exception $exception){
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





