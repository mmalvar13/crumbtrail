<?php
/**
 * API for Company Activation, AKA "company approval API".
 * @author Kevin Lee Kirk
 *
 * This API gets information from the profileActivation API,
 * via the secret Approve or Deny page for admins only.
 *    This company's id.
 *    This company has been approved or not.
 *    This company's activation token === null (whether approved or not).
 **/

require_once(dirname(__DIR__, 2) . "/classes/autoload.php");
require_once(dirname(__DIR__, 2) . "/lib/xsrf.php");
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
require_once(dirname(__DIR__, 4) . "/vendor/autoload.php");

use Edu\Cnm\CrumbTrail\{Company};

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
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/crumbtrail.ini");

	// Determine which HTTP method was used.
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
	$companyActivationToken = filter_input(INPUT_GET, "companyActivationToken", FILTER_SANITIZE_STRING);
	$companyApproved = filter_input(INPUT_GET, "companyApproved", FILTER_VALIDATE_INT);

	if($method === "GET") {
		setXsrfCookie();

		if((empty($id)) === false) {
			$company = Company::getCompanyByCompanyId($pdo, $id);
			if($company === null) {
				throw(new \InvalidArgumentException("This company does not exist"));
			}
			$companyActivationToken = $company->getCompanyActivationToken();
			if($companyActivationToken !== null) {
				$company->setCompanyActivationToken(null);
				$company->update($pdo);
			} else {
				throw(new \InvalidArgumentException("Company account has already been activated", 404));
			}

			$companyApproved = $company->getCompanyApproved();
			if($companyApproved === null) {
				throw(new \RunTimeException('Company has not been approved yet'));
			} else {

// ------------------  Start of SwiftMailer code -----------------------
				$transport = Swift_SmtpTransport::newInstance('localhost', 25);
				$mailer = Swift_Mailer::newInstance($transport);
				$message = Swift_Message::newInstance();

				$message->setFrom(['kkirk4@cnm.edu' => 'Crumbtrail Admin']);
				$recipients = [$company->getCompanyEmail() => $company->getCompanyName()];
				$message->setTo($recipients);
				$message->setSubject("Message from CrumbTrail");

				// If we approved the company, send this email:
				// $companyApproved is used directly, below:


				$companyApproved = $company->getCompanyApproved();
				if($companyApproved === 1) {
					$message->setBody('Welcome to CrumbTrail! Your company account has been approved. Please go to crumbtrail.com to add the description and menu of your food truck company.', 'text/html');
					$message->addPart('Welcome to CrumbTrail! Your company account has been approved. Please go to crumbtrail.com to add the description and menu of your food truck company.', 'text/plain');
				// If we could not approve the company, send this email:
				} else {
					$message->setBody('CrumbTrail has been unable to verify your business license and/or health permit.', 'text/html');
					$message->addPart('CrumbTrail has been unable to verify your business license and/or health permit.', 'text/plain');
				}

				$numSent = $mailer->send($message);
				if($numSent !== count($recipients)) {
					throw(new RuntimeException("Unable to send email"));
				}
			}
// ------------------  End of SwiftMailer code -----------------------

		} else {
			throw (new InvalidArgumentException("There is no company id"));
		}

	} else {
		throw (new InvalidArgumentException("Invalid HTTP method request"));
		}

} catch(Exception $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();

} catch(TypeError $typeError) {
	$reply->status = $typeError->getCode();
	$reply->message = $typeError->getMessage();
}

// Encode and return reply to front end caller.
echo json_encode($reply);