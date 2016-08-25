<?php
/**
 * API for Company Activation.
 * @author Kevin Lee Kirk
 *
 * The sign-up API sends the new company owner an activation email.
 * The new company owner clicks a link in the activation email.
 * The click calls this company activation API.
 * This API sets the company activation token to null.
 *
 * How much of this does Angular do?
 * In what form does the information from Angular arrive?
 *
 * Must do this:
 * getCompanyByCompanyActivationToken
 * check that there is an activation token
 * then set the activation token = null
 **/

require_once "autoloader.php";
require_once "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
require_once '/path/to/swift-mailer/lib/swift_required.php';  // TODO Path?

use Edu\Cnm\Crumbtrail\{Company};

// TODO SwiftMailer things: ----------------------------------------

// Create the Transport
$transport = Swift_SmtpTransport::newInstance('smtp.example.org', 25)
	->setUsername('your username')
	->setPassword('your password')
;

// Create the Mailer using your created Transport
$mailer = Swift_Mailer::newInstance($transport);

// Create a message
$message = Swift_Message::newInstance('Wonderful Subject')
	->setFrom(array('john@doe.com' => 'John Doe'))
	->setTo(array('receiver@domain.org', 'other@domain.org' => 'A name'))
	->setBody('Here is the message itself')
;

// Send the message
$result = $mailer->send($message);

// TODO: How to include an activation link that the new company account creator clicks???
// And what responds to that click?  This API?  Another API?





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
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	// Only accept GET method.  Reject all other methods. ???

	// Sanitize the input.
	$companyAccountCreatorEmailActivation = filter_input(INPUT_GET, "companyAccountCreatorEmailActivation", FILTER_SANITIZE_STRING);

	$company = Company::getCompanyByCompanyAccountCreatorId($pdo, $companyAccountCreatorEmailActivation);
	// Or:
	$company = Company::getCompanyByCompanyActivationToken($pdo, $companyActivationToken);


	//handle GET request - if id is present, that profile is returned
	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie();

		//check if empty activation token, that means the account has already been activated or doesnt exist.
		if(empty($companyAccountCreatorEmailActivation) === true) {
			throw(new InvalidArgumentException("Account has already been activated or does not exist", 404));

		} else {
			$companyAccountCreatorEmailActivation->setCompanyActivationToken(null);  // ???
			$companyAccountCreatorEmailActivation->update($pdo);

			// TODO After receiving the click from the activation email,
			// set the companyActivationToken to null.

		}
	}
}


// Encode and return reply to front end caller.
echo json_encode($reply);