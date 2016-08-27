<?php
/**
 * API for Company Activation, AKA "company approval API".
 * @author Kevin Lee Kirk
 *
 * Company activation- is like company approved.
 * This sends an email to company account creators to let them know they have been approved or denied.
 * companyActivation API does not send a link.
 * It only sends a message on the basis that companyActivationToken has been set to null
 * (which is a link sent to developer team by profileActivationAPI),
 * and depending on the value of companyApproved (true or false)
 * it sends an email that says “you’ve been approved” or “you’ve been denied”.
 *
 **/

require_once "autoloader.php";
require_once "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
require_once (dirname(__DIR__, 4)) . "/vendor/autoload.php";

use Edu\Cnm\Crumbtrail\{Company};

// Somehow, this API gets the information from the profileActivation API:
//  This company's id.
//  This company has been approved or not.
//  This company's activation token === null (whether approved or not).


// Verify the session, start a session if not active.
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}
// Prepare an empty $reply "bucket".
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;

//  if($companyActivationToken !== null) {
//	  $companyActivationToken = null;}
// Instead, check that it's null, if not then throw an exception ...
//  (so a try catch block, probably)

try {
	// Get the mySQL connection.
	$pdo = connectToEncyptedMySQL("/etc/apache2/capstone-mysql/companyActivation.ini"); // TODO Check path.

	// Determine which HTTP method was used.
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	// Sanitize the input.
	$companyAccountCreatorEmailActivation = filter_input(INPUT_GET, "companyAccountCreatorEmailActivation", FILTER_SANITIZE_STRING);

	// Only accept a GET request.  Catch all other methods and throw exceptions.
	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie();

		// TODO Fix this object oriented stuff:
		$company = Company::getCompanyByCompanyId($pdo, $companyId);
		$companyEmail = Company($pdo, $companyEmail);
		$companyApproved = Company($pdo, $companyApproved);
		}
	}

} catch (Exception $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();

} catch (TypeError $typeError) {
	$reply->status = $typeError->getCode();
	$reply->message = $typeError->getMessage();
}

// --------- From Course Materials: Sending email in PHP  -------
try {
	// sanitize the inputs from the form: name, email, subject, and message
	// this assumes jQuery (not Angular will be submitting the form, so we're using the $_POST superglobal

	$name = Profile(profileName);
	$email = Profile(profileEmail);
	$subject = "Message from Crumbtrail";

	if($companyApproved === 1) {
		$message = $approvalMessage;
	} else {
		$message = $denialMessage;
	}

	// create Swift message
	$swiftMessage = Swift_Message::newInstance();

	// attach the sender to the message
	// this takes the form of an associative array where the Email is the key for the real name
	$swiftMessage->setFrom([$email => $name]);

	// $recipients = ["$emailRecipient"];
	$swiftMessage->setTo($recipients);

	// attach the subject line to the message
	$swiftMessage->setSubject($subject);

	/**
	 * attach the actual message to the message
	 * here, we set two versions of the message: the HTML formatted message and a special filter_var()ed
	 * version of the message that generates a plain text version of the HTML content
	 * notice one tactic used is to display the entire $confirmLink to plain text; this lets users
	 * who aren't viewing HTML content in Emails still access your links
	 **/
	$swiftMessage->setBody($message, "text/html");
	$swiftMessage->addPart(html_entity_decode($message), "text/plain");

	/**
	 * send the Email via SMTP; the SMTP server here is configured to relay everything upstream via CNM
	 **/
	$smtp = Swift_SmtpTransport::newInstance("localhost", 25);
	$mailer = Swift_Mailer::newInstance($smtp);
	$numSent = $mailer->send($swiftMessage, $failedRecipients);

	/**
	 * the send method returns the number of recipients that accepted the Email
	 * so, if the number attempted is not the number accepted, this is an Exception
	 **/
	if($numSent !== count($recipients)) {
		// the $failedRecipients parameter passed in the send() method now contains contains an array of the Emails that failed
		throw(new RuntimeException("unable to send email"));
	}

	// report a successful send
	echo "<div class=\"alert alert-success\" role=\"alert\">Email successfully sent.</div>";
} catch(Exception $exception) {
	echo "<div class=\"alert alert-danger\" role=\"alert\"><strong>Oh snap!</strong> Unable to send email: " . $exception->getMessage() . "</div>";
}


// Encode and return reply to front end caller.
echo json_encode($reply);