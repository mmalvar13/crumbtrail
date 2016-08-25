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
 * Must do this:
 * getCompanyByCompanyActivationToken
 * check that there is an activation token
 * then set the activation token = null
 *
 * Does this API need to do this????:
 * Call the profileActivation API, to getProfileByProfileActivationToken.
 * When the new company owner clicks the link in the activation email,
 * this API then tells the profileActivation API that the new account has been activated,
 * so that not only is the companyActivationToken = null,
 * but also the profileActivationToken = null.
 **/

require_once "autoloader.php";
require_once "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
require_once '/path/to/swift-mailer/lib/swift_required.php';     // TODO Path?

use Edu\Cnm\Crumbtrail\{Company};

// SwiftMailer things.  Move this block. ---------------
// Create the Transport
$transport = Swift_SmtpTransport::newInstance('smtp.example.org', 25)
	->setUsername('your username')
	->setPassword('your password')
;

// Create the Mailer, using your created Transport
$mailer = Swift_Mailer::newInstance($transport);

// Create a message
$message = Swift_Message::newInstance('Welcome to CrumbTrail')
	->setFrom(array('john@doe.com' => 'John Doe'))
	->setTo(array('receiver@domain.org', 'other@domain.org' => 'A name'))
	->setBody('Here is the message itself')
;

/**
 * Draft of the email message body:
 * "Welcome to CrumbTrail!
 * Thank you for waiting for our response to your request for a CrumbTrail account.
 * We have verified the business license and health permit of your food truck company.
 * To complete your company's CrumbTrail sign-up, and to fill in the description of your
 * company, please click this link:  LINK."
 **/

// Send the message
$result = $mailer->send($message);
// --------------------------------------------------------


// Verify the session, start a session if not active.
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}
// Prepare an empty $reply "bucket".
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;

try {
	// Get the mySQL connection.
	$pdo = connectToEncyptedMySQL("/etc/apache2/capstone-mysql/companyActivation.ini"); // TODO Check path.

	// Determine which HTTP method was used.
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	// Sanitize the input.
	$companyAccountCreatorEmailActivation = filter_input(INPUT_GET, "companyAccountCreatorEmailActivation", FILTER_SANITIZE_STRING);

	// Only accept a GET request.  Catch all other methods and throw an exception.
	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie();


		$company = Company::getCompanyByCompanyAccountCreatorId($pdo, $companyAccountCreatorEmailActivation);
		// TODO Or ... ???
		$company = Company::getCompanyByCompanyActivationToken($pdo, $companyActivationToken);



		//check if empty activation token, that means the account has already been activated or doesnt exist.
		if(empty($companyAccountCreatorEmailActivation) === true) {
			throw(new InvalidArgumentException("Account has already been activated or does not exist", 404));

			// TODO After receiving the click from the activation email,
			// set the companyActivationToken to null.
			// And tell the profileActivation API to set the profileActivationToken to null?

		} else {
			$companyAccountCreatorEmailActivation->setCompanyActivationToken(null);    // ???
			$companyAccountCreatorEmailActivation->update($pdo);

		}
	}

} catch (Exception $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();

} catch (TypeError $typeError) {
	$reply->status = $typeError->getCode();
	$reply->message = $typeError->getMessage();
}

// Encode and return reply to front end caller.
echo json_encode($reply);