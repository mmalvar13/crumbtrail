<?php

require_once "autoloader.php";
require_once "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");   // TODO Check this path.

// TODO  require_once(any other class that you need)  ???

use Edu\Cnm\{Profile, Foo, Bar};   		// TODO Check this path, and the classes we need here.

/**
 * Outline of what the Profile API needs to do:
 * 	Setup
 * 		Check the session status. If not active, start a session.
 * 		Create a new stdClass called $reply; an empty bucket.
 * 			$reply->status is a state variable that stores the session status.
 * 			$reply->data is a state variable that stores the results of the API call.
 * 			($reply->message to be updated later).
 * 		$pdo = ..., connect to the database.
 *   		$method = array_key_exists(..., finds which HTTP method needs to be processed.
 * 		$id = filter_input(INPUT_GET, "id", ...,  stores the primary key in $id.
 * 			$id is the primary key for GET, DELETE, and PUT.
 * 			The URL from the frontend will contain the primary key value.
 *
 * 	GET  =  read requests (SELECT) from the database
 * 		GET all Profiles
 * 		GET a specific Profile by primary key (id)
 * 		GET a specific Profile by Profile name
 * 		Get a specific Profile by Profile email
 * 	POST  =  create a new Profile object, then INSERT it into the database
 * 	PUT  =  modify an existing object and UPDATE the database
 * 	DELETE  =  delete an object from the database
 * 	Finishing up
 *
 *   And control the access to the data, based on type of person.	TODO If blocks for this.
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
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/profile.ini");	// TODO Check this path.

	// Determine which HTTP method was used: GET, POST, PUT, or DELETE.
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	// Sanitize the input.
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
	$name = filter_input(INPUT_GET, "name", FILTER_SANITIZE_STRING);	// TODO Check the FILTER_
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

// --------------------------- GET --------------------------------
	if($method === "GET") {
		setXsrfCookie();

		// Get a specific profile by profile Id, then update the reply.
		if(empty($id) === false) {
			$profile = Profile::getProfileByProfileId($pdo, $id);
			if($profile !== null) {
				$reply->data = $profile;
			}

			// Get a profile by profile Name, then update the reply.
		} elseif(empty($name) === false) {
			$name = Profile::getProfileByProfileName($pdo, $name);
			if($profile !== null) {
				$reply->data = $profile;
			}

			// Get a profile by profile Email, then update the reply.
		} elseif(empty($name) === false) {
			$email = Profile::getProfileByProfileEmail($pdo, $email);
			if($profile !== null) {
				$reply->data = $profile;
			}

			// Get all profiles, then update the reply.
		} else {
			$profile = Profile::getAllProfile($pdo);
			if($profile !== null) {
				$reply->data = $profile;
			}
		}

// --------------------------- PUT or POST --------------------------------
	} elseif($method === "PUT" || $method === "POST") {
		verifyXsrf();
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);

		// Make sure profileName is available.
		if(empty($requestObject->profileName) === true) {
			throw(new \InvalidArgumentException ("No content for Profile name.", 405));
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
				throw(new RuntimeException("The profile does not exist", 404));
			}

			// Update profileName and profileEmail in this profile.
			$profile->setProfileName($requestObject->profileName);
			$profile->setProfileEmail($requestObject->profileEmail);
			$profile->update($pdo);

			// Update the reply message.
			$reply->message = "The profile was updated OK";

		} else if($method === "POST") {
			// Create a new profile, give it an id, then POST it into the database.
			// null, null, null: For the phone, activation token, access token, profile type, salt, hash.
			// TODO: Check the above ???
			// TODO: What if a person wants to update their phone number ???
			// TODO: Remove either the first null, or $...->profileId ???
			$profile = new Profile(null, $requestObject->profileId, $requestObject->profileName, $requestObject->profileEmail, null, null, null, null, null, null);
			$profile->insert($pdo);

			// Update the reply message.
			$reply->message = "Profile created OK";
		}

// --------------------------- DELETE --------------------------------
	} else if($method === "DELETE") {
		verifyXsrf();

		// Retrieve the Profile that will be deleted.
		$profile = Profile::getProfileByProfileId($pdo, $id);
		if($profile === null) {
			throw(new RuntimeException("Profile does not exist", 404));
		}

		// Delete the profile, then update the reply message.
		$profile->delete($pdo);
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