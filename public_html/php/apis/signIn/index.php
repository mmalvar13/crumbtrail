<?php

require_once (dirname(__DIR__, 2) ."/classes/autoload.php");
require_once (dirname(__DIR__,2) . "/lib/xsrf.php");
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
require_once (dirname(__DIR__,4) . "/vendor/autoload.php");
use Edu\Cnm\CrumbTrail\{Company, Employ, Profile};

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
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/crumbtrail.ini");

	//determine which HTTP method was used
	$method = array_key_exists("HTTP_x_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	//sanitize input deleted
	//todo do i put all the input sanitization up here? this is stuff from the URL, and at this point there is nothing, so i guess not

	//handle POST request
	if($method === "POST") { //todo why a post? because its a temporary?
		//set XSRF cookie
//		setXsrfCookie(); //TODO do i set this here?
//		verifyXsrf();

		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);

		/*-----checking and sanitizing profileEmail, profilePassword--------------*/
		//check that email and password fields are not empty, and sanitize that input
		if(empty($requestObject->profileEmail) === true) {
			throw(new \InvalidArgumentException("You must enter your email address", 405));
		} else {
			$profileEmail = filter_var($requestObject->profileEmail, FILTER_SANITIZE_EMAIL);
		}

		//checking the password field for user input
		if(empty($requestObject->profilePassword) === true) { //TODO profile password, do i also have confirm profile password?
			throw(new \InvalidArgumentException("Please enter your password", 405));
		} else {
			$password = filter_input(INPUT_POST, $requestObject->profilePassword, FILTER_SANITIZE_STRING);
		}

		//retrieve the data for profileEmail
		$profile = Profile::getProfileByProfileEmail($pdo, $profileEmail);

		//use profile salt to hash password
		$salt = $profile->getProfileSalt();

		//create the hash
		$confirmHash = hash_pbkdf2("sha512", $requestObject->profilePassword, $salt, 262144); //TODO is this the correct requestObject to be put in here?

		//todo is this how i check for profile activation token? on the test i get this error, but thats because in the database no PAT have been set to null
		$profile->getProfileActivationToken();
		if($profile->getProfileActivationToken() !== null){
			throw(new InvalidArgumentException("your account has not been activated yet", 404));
		}

		//matches hashes
		//put profile into session
		if($confirmHash === $profile->getProfileHash()) {
			$_SESSION["profile"] = $profile;

			$_SESSION["companies"] = [];
			if($_SESSION["profile"]->getProfileType() === "a" || $_SESSION["profile"]->getProfileType() === "o") {
				$whoIWorkFor = Employ::getEmployByEmployProfileId($pdo, $_SESSION["profile"]->getProfileId());
				foreach($whoIWorkFor as $employ) {
					$_SESSION["companies"][] = Company::getCompanyByCompanyId($pdo, $employ->getEmployCompanyId());
				}
			}

			$reply->status = 200;
			$reply->message = "Successfully logged in";
		} else {
			throw(new InvalidArgumentException("email or password is invalid", 401));
		}
	} else {
		throw(new InvalidArgumentException("Invalid HTTP method request"));
	}
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





