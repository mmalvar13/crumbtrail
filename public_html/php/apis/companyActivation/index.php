<?php
/**
 * API for Company Activation, AKA "company approval API".
 * @author Kevin Lee Kirk
 *
 * This API gets information from the profileActivation API,
 * via the secret Approve or Deny page for admins only.
 * This company's id.
 * This company has been approved or not.
 * This company's activation token === null (whether approved or not).
 **/

require_once "autoloader.php";
require_once "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
require_once (dirname(__DIR__, 4)) . "/vendor/autoload.php";

use Edu\Cnm\Crumbtrail\{
	Company
};

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
	$pdo = connectToEncyptedMySQL("/etc/apache2/capstone-mysql/crumbtrail.ini");

	// Determine which HTTP method was used.
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	$companyActivationToken = filter_input(INPUT_GET, "companyActivationToken", FILTER_SANITIZE_STRING);

	// Only accept a POST request.  Catch all other methods and exceptions.
	if($method === "POST") {
		verifyXsrf();
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);

		$company = Company::getCompanyByCompanyActivationToken($pdo, $companyActivationToken);

	}

} catch(Exception $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();

} catch(TypeError $typeError) {
	$reply->status = $typeError->getCode();
	$reply->message = $typeError->getMessage();
}

// check comActTok not null, then set to null
//Angular will send us the companyApproved

if($requestObject->companyApproved === null) {
	throw(new \RuntimeException('company has not been approved yet'));
} else {

// ------------ SwiftMailer: send Approve or Deny email to companyAccountCreator ------------
//Create the Transport
	$transport = Swift_SmtpTransport::newInstance('localhost', 25); //can add third parameter for SSL encryption. need?

//Create the Mailer using your created Transport
	$mailer = Swift_Mailer::newInstance($transport);

//Create a message
	$message = Swift_Message::newInstance();

//attach a sender to the message
	$message->setFrom(['admin@crumbtrail.com' => 'Crumbtrail Admin']);

//attach recipients to the message. you can add
	$recipients = ['companyEmail' => $company->getCompanyEmail()];
//$message->setTo($recipients);	//we will just send to one person.

//attach a subject line to the message
	$message->setSubject("Message from CrumbTrail");

//the body of the message-seen when the user opens the message
	if($company->getCompanyApproved() === 1) {
		$message->setBody('Welcome to CrumbTrail! Your company account has been approved. Please go to crumbtrail.com to add the description and menu of your food truck company.', 'text/html');
	} else {
		$message->setBody('CrumbTrail has been unable to verify your business license and/or health permit.', 'text/html');
	}


//Send the message
	$numSent = $mailer->send($message);

	printf("Sent %d messages\n", $numSent);

	if($numSent !== count($recipients)) {
		//the $failedRecipients parameter passed in the send() method now contains an array of the Emails that failed
		throw(new RuntimeException("unable to send email"));
	}
	/*----------------------------------SwiftMailer Code Ends Here------------------------------------------*/
}
// Encode and return reply to front end caller.
echo json_encode($reply);