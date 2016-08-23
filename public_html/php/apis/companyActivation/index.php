<?php
/**
 * API for Company Activation.
 * The response to a confirmation email to a new company owner, i.e. the companyAccountCreator.
 *
 * Does this API send out the confirmation email message???
 * Or does it receive the information that a new user has clicked the confirmation email???
 * Or both???
 *
 * @author Kevin Lee Kirk
 **/
require_once "autoloader.php";
require_once "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
// TODO A require_once for  swiftmailer/mailgun?

use Edu\Cnm\Crumbtrail\{Company};

// Verify the session, start a session if not active.
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

// Prepare an empty $reply "bucket".
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;

try{
	// Get the mySQL connection.
	$pdo = connectToEncyptedMySQL("/etc/apache2/capstone-mysql/companyActivation.ini"); // TODO Check path.

	// Determine which HTTP method was used. first one is the method you use, second is the fall back if the first is not available.
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"]; //do i use this?

	// Sanitize the input.
	$companyAccountCreatorEmailActivation = filter_input(INPUT_GET, "companyAccountCreatorEmailActivation", FILTER_SANITIZE_STRING);

	// what is this supposed to do?? it is placed here in the breadbasket example but is within an if block under the GET methods block in the paper example
	$company = Company::getCompanyByCompanyAccountCreatorId($pdo, $companyAccountCreatorEmailActivation);

	//handle GET request - if id is present, that profile is returned, otherwise all profiles are returned??
	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie();

		//check if empty activation token, that means the account has already been activated or doesnt exist.
		if(empty($companyAccountCreatorEmailActivation) === true) {
			throw(new InvalidArgumentException("Account has already been activated or does not exist", 404));

		} else {
			$companyAccountCreatorEmailActivation->setCompanyAccountCreatorId(null);
			$companyAccountCreatorEmailActivation->update($pdo);

			// TODO Swiftmailer/Mailgun ???

		}
	}
}