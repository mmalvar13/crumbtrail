<?php

require_once "autoloader.php";
require_once "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");   // TODO Check this path.
// TODO  require_once(any other class that you need)  ???

use Edu\Cnm\{Profile, Foo, Bar};   			         // TODO Check this path, and the classes we need here.

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
 * 	GET  =  read requests (SELECT) from the database
 * 		Get all Profiles
 * 		Get a specific Profile by primary key
 * 	POST  =  create a new object, then INSERT it into the database
 * 		Create a new Profile
 * 	PUT  =  Modify an existing object and UPDATE the database
 * 		Update Profile by primary key
 * 	DELETE  =  delete an object from the database
 * 		Delete a Profile by primary key
 * 	Finishing up
 *
 * The Profile class has these getFooByBars:
 * 	getProfileByProfileId
 * 	getProfileByProfileName
 *  	getProfileByProfileEmail
 * 	getAllProfiles
 *
 * And control the access, based on type of person. TODO If blocks for this.
 * Throw the various exceptions.       TODO Check this.
 *
 * After looking at the class, ... we want our API to do:
 *    GET all Tweets
 *    GET a specific Tweet by Primary Key (tweetId)
 *    POST - Create a brand new Tweet
 *    PUT - Update Tweet by Primary Key
 *    DELETE - Delete a Tweet by Primary Key
 **/

/**
 * API for the Profile class
 *
 * @author Kevin Lee Kirk
 **/

// Verify the session, start a session if not active.
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

// Prepare an empty reply.
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;

try {
	// Connect to mySQL.
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/profile.ini");			// TODO Check this path.

	// Determine which HTTP method was used.
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	// Sanitize the input.
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
	$name = filter_input(INPUT_GET, "name", FILTER_VALIDATE_???);		// TODO filter for a string ???
	$email = filter_input(INPUT_GET, "email", FILTER_VALIDATE_EMAIL);

	// Make sure the id (primary key) is valid for the methods that require it.
	if(($method === "DELETE" || $method === "PUT") && (empty($id) === true || $id < 0)) {
		throw(new InvalidArgumentException("ID cannot be empty or negative", 405));
	}

	// Make sure the profile name is valid for the methods that require it.
	if(($method === "DELETE" || $method === "PUT") && (empty($name) === true)) {
		throw(new InvalidArgumentException("Name cannot be empty or negative", 405));
	}

	// Make sure the profile email is valid for the methods that require it.
	if(($method === "DELETE" || $method === "PUT") && (empty($email) === true)) {
		throw(new InvalidArgumentException("Email cannot be empty or negative", 405));
	}

	// Handle a GET request:
	//		If id (primary key) is present, then return that profile,
	//		otherwise return all profiles.
	// 	TODO Do you need a separate GET request for EACH getFooByBar in the Profile class ???

	if($method === "GET") {
		// Set XSRF cookie, to prevent cross-site request forgery attacks.
		setXsrfCookie();

		if(empty($id) === false) {
			// Get a specific profile by profile Id, then update the reply.
			$profile = Profile::getProfileByProfileId($pdo, $id);
			$company = Company::getCompanyeByCompanyId($pdo, $id); // TODO Call this $is something else.  Will this work?

			if($profile !== null) {
				$reply->data = $profile;
			}

		} elseif()    				// TODO  Need a $name variable, and an $email variable



		} else {
			// Get all profiles, then update the reply.
			$profile = Profile::getAllProfile($pdo);
			if($profile !== null) {
				$reply->data = $profile;
			}
		}


		if ($a > $b) {
			echo "a is bigger than b";
		} elseif ($a == $b) {
			echo "a is equal to b";
		} else {
			echo "a is smaller than b";
		}

		// 	getProfileByProfileName
		//  	getProfileByProfileEmail


		// Here are the PUT and POST methods.
	} else if($method === "PUT" || $method === "POST") {

		verifyXsrf();
		// Retrieve the JSON package that the front end sent, then store it in $requestContent.
		$requestContent = file_get_contents("php://input");
		// Decodes the JSON package, then store it in $requestObject.
		$requestObject = json_decode($requestContent);

		// Make sure profile is available, i.e. is not empty (required field).
		if(empty($requestObject->profileFoo) === true) {
			throw(new \InvalidArgumentException ("No content for Profile.", 405));
		}

		// Make sure profile bar   *****   is accurate (optional field).
		if(empty($requestObject->profileBar) === true) {
			$requestObject->profileBar = new \DateTime();
		}

		//  Make sure profileId is available.
		if(empty($requestObject->profileId) === true) {
			throw(new \InvalidArgumentException ("No Profile ID.", 405));
		}

		// Perform the actual PUT or POST.
		if($method === "PUT") {

			// Retrieve the profile that will be updated in this PUT.
			$profile = Profile::getProfileByProfileId($pdo, $id);
			if($profile === null) {
				throw(new RuntimeException("Profile does not exist", 404));
			}

			// PUT the new foo into the Profile object.               TODO  Foo = a profile attribute ???
			$profile->setProfileFoo($requestObject->profileFoo);
			$profile->update($pdo);

			// Update the reply message.
			$reply->message = "Profile updated OK";

		} else if($method === "POST") {              // TODO  Do we need a POST, to allow a new profile???

			// Create a new profile, give it an id, then insert it (POST it) into the database.   TODO Foo = ???
			$profile = new Profile(null, $requestObject->profileId, $requestObject->profileFoo, null);
			$profile->insert($pdo);

			// Update the reply message.
			$reply->message = "Profile created OK";
		}

	} else if($method === "DELETE") {
		verifyXsrf();

		// Retrieve the Profile that will be deleted.
		$profile = Profile::getProfileByProfileId($pdo, $id);     // TODO Need a path in front of Profile???
		if($profile === null) {
			throw(new RuntimeException("Profile does not exist", 404));
		}

		// Delete the profile.
		$profile->delete($pdo);

		// Update the reply message.
		$reply->message = "Profile deleted OK";
	} else {
		throw (new InvalidArgumentException("Invalid HTTP method request"));
	}

	// Update the reply message with the exception information.
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

// Encode and return the reply to frontend caller.
echo json_encode($reply);
