<?php

require_once "autoloader.php";
require_once "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");   // TODO Check this path.

use Edu\Cnm\{Profile};   										// TODO Check this path.

/**
 * API for the Profile class
 *
 * @author Kevin Lee Kirk
 *
 *  Control the ACCESS to the data, based on type of person,
 * using the if blocks, ABOVE the PUT and DELETE blocks.
 *
 * 	Can "use" another class, at the top of this file,
 * 	and then grab an attribute from another class,
 * 	using standard object oriented methods.
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
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/profile.ini");		// TODO Check this path.

	// Determine which HTTP method was used: GET, POST, PUT, or DELETE.
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	// Sanitize the input.
	$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
	$name = filter_input(INPUT_GET, "name", FILTER_SANITIZE_STRING);
	$email = filter_input(INPUT_GET, "email", FILTER_SANITIZE_EMAIL);

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


	// Wrap the following 2-3 conditions around every PUT, or DELETE:
	// do they have a profileId?
	// do they have the correct profileId?
	// do they have access to this profile attribute, to PUT, POST, or DELETE it? (Not for this API)


// --------------------------- GET --------------------------------
	elseif((empty($_SESSION["profile"]) === false) && (($_SESSION["profile"]->getProfileId()) === $id))

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

// --------------------------- PUT  --------------------------------
	// Do they have the correct profileId?
	//   So that a person can only change their own profile attributes.

	elseif((empty($_SESSION["profile"]) === false) && (($_SESSION["profile"]->getProfileId()) === $id))

	} elseif($method === "PUT") {

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


// --------------------------- DELETE --------------------------------
		// Do they have the correct profileId?
		//   So that a person can only delete their own profile.

	elseif((empty($_SESSION["profile"]) === false) && (($_SESSION["profile"]->getProfileId()) === $id))

	} elseif($method === "DELETE") {
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

// Encode and return the reply to the frontend caller.
header("Content-type: application/json");
if($reply->data === null) {
	unset($reply->data);
}

echo json_encode($reply);