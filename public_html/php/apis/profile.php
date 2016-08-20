<?php

require_once "autoloader.php";
require_once "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

use Edu\Cnm\Mmalvar13\Profile;   // TODO Check this path

/**
 * Outline of what the Profile API needs to do:
 * 	Setup
 * 		Check the session status. If not active, start a session.
 * 		Create a new stdClass called $reply; an empty bucket.
 * 			$reply->status is a state variable that stores the session status.
 * 			$reply->data is a state variable that stores the results of the API call.
 * 			($reply->message be updated later).
 * 		$pdo = ..., connect to the database.
 *   		$method = array_key_exists(..., finds which HTTP method needs to be processed.
 * 		$id = filter_input(INPUT_GET, "id", ...,  stores the primary key in $id.
 * 			$id is the primary key for GET, DELETE, and PUT.
 * 			The URL from the frontend will contain the primary key value.
 * 		if(($method === "DELETE" ..., makes sure that we have the primary key for DELETE and PUT.
 *
 *
 * 	GET  =  read requests (SELECT) from the database
 * 		Get all Profiles
 * 		Get a specific Profile by primary key
 *
 * 	POST  =  create a new object, then INSERT it into the database
 * 		Create a new Profile
 *
 * 	PUT  =  Modify an existing object and UPDATE the database
 * 		Update Profile by primary key
 *
 * 	DELETE  =  delete an object from the database
 * 		Delete a Profile by primary key
 *
 * 	Finishing up
 *
 *
 *
 * Tweet example:
 * The Tweet class's getFooByBars:
 *		getTweetByTweetId
 * 	getTweetByTweetContent
 * 	getTweetByTweetProfileId
 * 	getAllTweets
 *
 * After looking at the class, ... we want our API to do:
 *    GET all Tweets
 *    GET a specific Tweet by Primary Key
 *    POST - Create a brand new Tweet
 *    PUT - Update Tweet by Primary Key
 *    DELETE - Delete a Tweet by Primary Key
 *
 **/




/**
 * API for the Profile class
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
	//grab the mySQL connection        TODO Check this path
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