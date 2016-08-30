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

use Edu\Cnm\Crumbtrail\{Company};

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

	// Only accept a GET request.  Catch all other methods and throw exceptions.
	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie();

		$company = Company::getCompanyByCompanyId($pdo, $companyId);
		$companyEmail = Company($pdo, $companyEmail);
		$companyApproved = Company($pdo, $companyApproved);
		$companyActivationToken = Company($pdo, $companyActivationToken);
	}

		try {
			if($companyActivationToken !== null) {
				$companyActivationToken = null;
			}
		} catch (Exception $exception) {
			$reply->status = $exception->getCode();
			$reply->message = $exception->getMessage();
		} catch (TypeError $typeError) {
			$reply->status = $typeError->getCode();
			$reply->message = $typeError->getMessage();
		}

	} catch (Exception $exception) {
		$reply->status = $exception->getCode();
		$reply->message = $exception->getMessage();

	} catch (TypeError $typeError) {
		$reply->status = $typeError->getCode();
		$reply->message = $typeError->getMessage();
}

// ------------ SwiftMailer: send Approve or Deny email to companyAccountCreator ------------
//Create the Transport
$transport = Swift_SmtpTransport::newInstance('smtp.example.org', 25); //can add third parameter for SSL encryption. need?

//Create the Mailer using your created Transport
$mailer = Swift_Mailer::newInstance($transport);

//Create a message
$message = Swift_Message::newInstance();

//attach a sender to the message
$message->setFrom(['admin@crumbtrail.com' => 'Crumbtrail Admin']);

//attach recipients to the message. you can add
$recipients = ['companyEmail' => '???'];			// TODO ???
$message->setTo($recipients);	//we will just send to one person.

//attach a subject line to the message
$message->setSubject("Message from CrumbTrail");

//the body of the message-seen when the user opens the message
if($companyApproved = 1) {
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

// Encode and return reply to front end caller.
echo json_encode($reply);