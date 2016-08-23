<?php

/**
 * API for the Profile class
 * @author Kevin Lee Kirk
 *
 * This API does not need a POST, since other APIs will handle the creation of a new profile.
 *
 *  Set up to make the all of the profile information confidential, i.e. allow only the person who created a profile to view or modify that profile.
 *
 * Attributes involved: profileId, profileName, profileEmail, profilePhone.
 *
 **/

require_once "autoloader.php";
require_once "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");   // TODO Check this path.

use Edu\Cnm\{Profile};   // TODO Check this path.

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
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/profile.ini");    // TODO Check this path.

	// Determine which HTTP method was used: GET, (POST), PUT, or DELETE.
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	// Sanitize the input.
	$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
	$name = filter_input(INPUT_GET, "name", FILTER_SANITIZE_STRING);
	$email = filter_input(INPUT_GET, "email", FILTER_SANITIZE_EMAIL);
	$phone = filter_input(INPUT_GET, "phone", FILTER_SANITIZE_STRING);

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

	// Make sure the profile phone is valid for the methods that require it.
	if(($method === "DELETE" || $method === "PUT") && (empty($phone) === true)) {
		throw(new InvalidArgumentException("Name cannot be empty or negative", 405));
	}

	/**
	 * Make the profile information confidential.
	 * If it's not your profile, you can't see it, modify it, or delete it.
	 **/
	if((empty($_SESSION["profile"]) === false) && (($_SESSION["profile"]->getProfileId()) === $id)) {

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

// --------------------------- PUT  --------------------------------
		} elseif($method === "PUT") {
			verifyXsrf();
			$requestContent = file_get_contents("php://input");
			$requestObject = json_decode($requestContent);

			//  Make sure profileId is available.
			if(empty($requestObject->profileId) === true) {
				throw(new \InvalidArgumentException ("No Profile ID.", 405));
			}

			// Make sure profileName is available.
			if(empty($requestObject->profileName) === true) {
				throw(new \InvalidArgumentException ("No content for Profile name.", 405));
			}

			// Make sure profileEmail is available.
			if(empty($requestObject->profileEmail) === true) {
				throw(new \InvalidArgumentException ("No content for Profile email.", 405));
			}

			// Retrieve the profile that will be updated in this PUT.
			$profile = Profile::getProfileByProfileId($pdo, $id);
			if($profile === null) {
				throw(new RuntimeException("The profile does not exist", 404));
			}

			// Update profileName, profileEmail and profilePhone in this profile.
			$profile->setProfileName($requestObject->profileName);
			$profile->setProfileEmail($requestObject->profileEmail);
			$profile->setProfilePhone($requestObject->profilePhone);
			$profile->update($pdo);

			// Update the reply message.
			$reply->message = "The profile was updated OK";

// --------------------------- DELETE --------------------------------
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
	}

// Here's the catches: Update the reply error message with the exception information.
} catch (Exception $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();

} catch (TypeError $typeError) {
	$reply->status = $typeError->getCode();
	$reply->message = $typeError->getMessage();
}


// Encode and return the reply to the frontend caller.
header("Content-type: application/json");
if($reply->data === null) {
	unset($reply->data);
}

echo json_encode($reply);
