<?php
/**
 * API for Company Activation.
 * @author Kevin Lee Kirk

 * The response to a activation email to a new company owner (the companyAccountCreator).
 * So this API needs to receive information from the activation email.
 *
 * The sign-up API sends the new company owner an activation email.
 * The new company owner clicks a link in the activation email.
 * The click calls this company activation API.
 * This API sets the company activation token to null.
 *
 * How much of this does Angular do?
 * In what form does the information from Angular arrive?
 *
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


// TODO Insert code for receiving the information that the activation email link has been clicked.


try{
	// Get the mySQL connection.
	$pdo = connectToEncyptedMySQL("/etc/apache2/capstone-mysql/companyActivation.ini"); // TODO Check path.

	// Determine which HTTP method was used. first one is the method you use, second is the fall back if the first is not available.
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"]; //do i use this?

	// Sanitize the input.
	$companyAccountCreatorEmailActivation = filter_input(INPUT_GET, "companyAccountCreatorEmailActivation", FILTER_SANITIZE_STRING);

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

			// TODO After receiving the click from the activation email,
			// set the companyActivationToken to null.

		}
	}
}