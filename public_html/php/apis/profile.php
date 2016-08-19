<?php

require_once "autoloader.php";
require_once "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

use Edu\Cnm\Mmalvar13\Profile;   // TODO check this path

/**
 * api for the Profile class
 *
 * @author Kevin Lee Kirk
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
	//grab the mySQL connection        TODO Check this
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/profile.ini");

	//determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	//sanitize input
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

	//make sure the id is valid for methods that require it
	if(($method === "DELETE" || $method === "PUT") && (empty($id) === true || $id < 0)) {
		throw(new InvalidArgumentException("id cannot be empty or negative", 405));
	}


	// handle GET request - if id is present, that tweet is returned, otherwise all tweets are returned
	// You need a separate GET request for each getFooByBar in the Company class.

	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie();


		//get a specific profile or all profiles and update reply
		if(empty($id) === false) {
			$tweet = Profile::getProfileByProfileId($pdo, $id);
			if($profile !== null) {
				$reply->data = $profile;
			}
		} else {
			$profile = Profile::getAllProfile($pdo);
			if($profile !== null) {
				$reply->data = $profile;
			}
		}


	} else if($method === "PUT" || $method === "POST") {

		verifyXsrf();
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);

		// make sure profile foo   ******   is available (required field)
		if(empty($requestObject->profileFoo) === true) {
			throw(new \InvalidArgumentException ("No content for Profile.", 405));
		}

		// make sure profile bar   *****   is accurate (optional field)
		if(empty($requestObject->profileBar) === true) {
			$requestObject->profileBar = new \DateTime();
		}

		//  make sure profileId is available
		if(empty($requestObject->profileId) === true) {
			throw(new \InvalidArgumentException ("No Profile ID.", 405));
		}

		//perform the actual put or post
		if($method === "PUT") {

			// retrieve the profile to update
			$tweet = Profile::getProfileByProfileId($pdo, $id);
			if($tweet === null) {
				throw(new RuntimeException("Profile does not exist", 404));
			}

			// put the new profile foo   ********    into the tweet and update
			$profile->setProfileFoo($requestObject->profileFoo);
			$profile->update($pdo);

			// update reply
			$reply->message = "Profile updated OK";

		} else if($method === "POST") {

			// create new profile and insert into the database
			$profile = new Profile(null, $requestObject->profileId, $requestObject->profileFoo, null);
			$profile->insert($pdo);

			// update reply
			$reply->message = "Profile created OK";
		}

	} else if($method === "DELETE") {
		verifyXsrf();

		// retrieve the Profile to be deleted
		$profile = Profile::getProfileByProfileId($pdo, $id);
		if($profile === null) {
			throw(new RuntimeException("Profile does not exist", 404));
		}

		// delete profile
		$profile->delete($pdo);

		// update reply
		$reply->message = "Profile deleted OK";
	} else {
		throw (new InvalidArgumentException("Invalid HTTP method request"));
	}

	// update reply with exception information
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