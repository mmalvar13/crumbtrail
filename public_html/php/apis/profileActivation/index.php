<?php

require_once(dirname(__DIR__, 2) . "/classes/autoload.php");
require_once(dirname(__DIR__, 2) . "/lib/xsrf.php");
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
require_once(dirname(__DIR__, 4) . "/vendor/autoload.php");
//do i add something here for swiftmailer?

use Edu\Cnm\CrumbTrail\{
	Company, Employ, Profile
};

/**
 * api for Profile Activation. This sets profileActivationTokens to null, and uses swiftmailer to send an email to Crumbtrail admins, notifying them that a new person has activated an account and their credentials should be checked.
 *
 * @author Monica Alvarez <mmalvar13@gmail.com>
 **/

//verify the session, start if not active
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

//prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null; //making a placeholder for the variable reply. you will store stuff here later!!


try {
	//grab the mySQL connection
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/crumbtrail.ini");

	//determine which HTTP method was used. first one is the method you use, second is the fall back if the first is not available
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	//sanitize input
	$profileId = filter_input(INPUT_GET, "profileId", FILTER_VALIDATE_INT);
	$companyApproved = filter_input(INPUT_GET, "companyApproved", FILTER_VALIDATE_BOOLEAN);
	$companyId = filter_input(INPUT_GET, "companyId", FILTER_VALIDATE_INT); //todo so where do we get this companyId from?? is it in the url?
	$profileActivationToken = filter_input(INPUT_GET, "profileActivationToken", FILTER_SANITIZE_STRING);


	/*You can get here one of two ways. First way: a food truck owner is signing up for the first time, via SignUp API. They have clicked the link to activate their profile. Second way: an employee or co-owner was invited to join a pre-existing company. They have clicked the link to activate their profile*/
	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie();
		//todo: this one had worked before
//		if((empty($profileId))=== false){
//			$profile = Profile::getProfileByProfileId($pdo, $profileId);
//			if($profileActivationToken !== null){
//				$profile->setProfileActivationToken(null);
//				$profile->update($pdo);
//			}else{
//				throw(new InvalidArgumentException("Account has already been activated", 404));
//			}
//		}
//todo this is another idea i had.
		if((empty($profileActivationToken)) === false) {
			$profile = Profile::getProfileByProfileActivationToken($pdo, $profileActivationToken);
			if($profile->getProfileActivationToken() !== null) {
				$profile->setProfileActivationToken(null);
				$profile->update($pdo);
			} else {
				throw(new InvalidArgumentException("Account has already been activated", 404));
			}
		} else {
			throw (new InvalidArgumentException("no profile activation token", 404));
		}

////todo: this is how i originally had it. getting error "call to method function setProfileActivationToken on null.
//		if($profileActivationToken !== null) {
//			$profile = Profile::getProfileByProfileActivationToken($pdo, $profileActivationToken);
//			//verify that the profile itself is not null. what if its an invalid activation token. if profile === null throw exception.
//			$profile->setProfileActivationToken(null);
//			$profile->update($pdo);
//		} else {
//			throw(new InvalidArgumentException("Account has already been activated", 404));
//		}
		$reply->message = "Thanks for activating your account! You're my best friend! Crumbtrail needs to confirm your company information. Please keep an eye out for an email from us in the next 48 hours to find out if you've been approved to use Crumbtrail. Have the best day ever!";


		if(empty($companyId) === false) {
			$employ = Employ::getEmployByEmployCompanyIdAndEmployProfileId($pdo, $companyId, $profileId);
			if($employ === null) {
				throw (new \InvalidArgumentException("this relationship does not exist"));
			}
			$company = Company::getCompanyByCompanyId($pdo, $companyId);
			if($company === null) {
				throw(new \InvalidArgumentException("this company does not exist"));
			}
			$companyActivationToken = $company->getCompanyActivationToken();
			if($companyActivationToken === null) { //this is for employee path.
				$reply->redirectUrl = "something/here/angular";
			} else {
				if($company->getCompanyAccountCreatorId() === $profile->getProfileId()) {
					/*----------------------------------swiftmailer code here-------------------------------------------*/

					/**
					 * To send a message with swiftmailer, you create a transport, use it to create the Mailer, and then y ou use the
					 * Mailer to send the message
					 *
					 * We are using the SMTP Transport Type. A transport is the component that actually does the sending.
					 * SMTP (Simple Message Transfer Protocol). It is the most commonly used Transport because it will work on 99% of web
					 * servers, according to the PIDOMA analysis.
					 **/

					//Create the Transport
					$transport = Swift_SmtpTransport::newInstance('localhost', 25); //can add third parameter for SSL encryption. need?

					//Create the Mailer using your created Transport
					$mailer = Swift_Mailer::newInstance($transport);

					//Create a message
					$message = Swift_Message::newInstance();//to set a subject line you can pass it as a parameter in newInstance or set it afterwards. I chose to set it afterwards. Same with body.

					/*new stuff dylan sent*/

					//you should use $_SERVER["SCRIPT_NAME"] insteead
					$scriptPath = $_SERVER["SCRIPT_NAME"];
					$linkPath = dirname($scriptPath, 2) . "/companyActivation/?companyActivationToken=$companyActivationToken";
					/*end of stuff dylan sent*/

					//attach a sender to the message
					$message->setFrom(['mmalvar13@gmail.com' => 'Crumbtrail Admin']);//is this the same as setFrom(array('someaddress'=>'name'));

					//attach recipients to the message. you can add
					$recipients = ['mmalvar13@gmail.com' => 'Admin who needs to verify business license'];
					$message->setTo($recipients);//we will just send to one person.

					//attach a subject line to the message
					$message->setSubject("Someone has activated their profile and need you to verify their business credentials");

					//the body of the message-seen when the user opens the message
					$message->setBody('Hi Crumbtrail Admin, a user has confirmed their email and activated their profile. Please take a look at their business license and health permit to verify their business. Once you have made the decision to confirm or deny them, click on this link. This link will set their companyActivationToken to null, and allow you to choose whether you confirm or deny' . "<a href=\"$linkPath\">Click Here To Activate Company</a>", 'text/html');

					//add alternative parts with addPart() for those who can only read plaintext or dont wwant to view in html
					$message->addPart('Crumbtrail  Admin, a user has confirmed their emai and activated their profile. Please take a look at their business license and health permit to verify their business. One you have made the decision to confirm or deny them, click on this link. This link will set their companyActivationToken to null, and allow you to choose whether you confirm or deny ' . "<a href=\"$linkPath\">Click Here To Activate Company</a>", 'text/plain');
					$message->setReturnPath('mmalvar13@gmail.com');//return path address specifies where bounce notifications should be sent


					//building the activation link that can travel to another server and still work. this is the link that will be clicked on to confirm. maybe this is not actually h ere, but in companyActivation/ProfileActivation/EmployeeActivation.
					//this is from breadbasket. must be changed to reflect crumbtrail stuff.




					//Send the message
					$numSent = $mailer->send($message);
					/**
					 * the send method returns the number of recipients that accepted the Email
					 * so if the number attempted is not the number accepted, this is the exception (number attempted should only be one at a time)
					 **/
					if($numSent !== count($recipients)) {
						//the $failedRecipients parameter passed in the send() method now contains an array of the Emails that failed
						throw(new RuntimeException("unable to send email"));
					}
					/*----------------------------------SwiftMailer Code Ends Here--------------------------------------*/

				}
			}
		} else {
			throw(new \InvalidArgumentException("There is no companyId"));
		}
	} else {
		throw (new InvalidArgumentException("Invalid HTTP method request"));
	}
} catch(Exception $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
	$reply->trace = $exception->getTraceAsString();
} catch(TypeError $typeError) {
	$reply->status = $typeError->getCode();
	$reply->message = $typeError->getMessage();
}

header("Content-type: application/json");
if($reply->data === null) {
	unset($reply->data);
}

//encode and return reply to front end caller
echo json_encode($reply);

