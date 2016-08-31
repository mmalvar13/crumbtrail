<?php

//Api for the employee class

//POST a new employee?
//GET employee?
//do i need my cnm user id for "use"


require_once(dirname(__DIR__,2) . "/classes/autoloader.php");
require_once(dirname(__DIR__,2) . "/lib/xsrf.php");
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
require_once (dirname(__DIR__,4) . "/vendor/autoload.php");


use Edu\Cnm\CrumbTrail\ {Employ, Profile};

/**
 * api for the Employee class
 *
 * @author Victoria Chacon <victoriousdesignco@gmail.com>
 **/

//verify the session, start if not active
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();

}
//prepare and empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;

try {
	//grab mySQL conection
	$pdo = connectToEncryptedMySQL
	("/etc/apache2/capstone-mysql/crumbtrail.ini");

	//determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP-METHOD"] : $_SERVER["REQUEST_METHOD"];

	//sanitize input
	//using the Get method here...so I am not writing the "employ class" but a bridge between employ and profile?
//we wouldn't need an Id since this wouldn't be tracked right, this is destroyed once the employee verifies that they are part of the profile?
	$employProfileId = filter_input(INPUT_GET, "employProfileId", FILTER_VALIDATE_INT);
	$employCompanyId = filter_input(INPUT_GET, "employCompanyId", FILTER_VALIDATE_INT);
	$profileName = filter_input(INPUT_POST, "profileName", FILTER_SANITIZE_STRING);
	$profileType = filter_input(INPUT_POST, "profileType", FILTER_SANITIZE_STRING);
	$profileEmail = filter_input(INPUT_POST, "profileEmail", FILTER_SANITIZE_EMAIL);
	//may possible write in GET to link to company------//
	//make sure the id is valid for methods that require it
	//TODO: if an owner takes an employee of their profile how does that work? DO i need the delete method, maybe set profile type to null, and possibly i  a PUT method if we wanted to dirupt the connedction betweent employee and company profile...."//
	If(($method === "DELETE" || $method === "PUT") && (empty($id) === true || $id < 0)) {
		throw(new InvalidArgumentException("id cannot be empty or negative", 405));
	}

	//handle GET request - if id is present, that employee is returned, otherwise all employees get returned???
	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie();
//TODO: we get the company by.....so we cant attach to the company...
		//get specific employee or all employees and update reply
		if(empty($id) === false) {
			$employ = Employ::getEmployByEmployCompanyIdAndEmployProfileId($pdo, $employCompanyId, $employProfileId);
			if($employ !== null) {
				$reply->data = $employ;
			}
		} elseif((empty($id)) === false) {
			$employ = Employ::getEmployByEmployProfileId($pdo, $employProfileId);
			if($employ !== null) {
				{
					$reply->data = $employ;
				}
			} elseif
			((empty($id)) === false) {
				$employ = Employ::getEmployByEmployCompanyId($pdo, $employCompanyid);
				if($employ !== null) {
					{
						$reply->data = $employ;
					}
				} else {
					$employs = Employ::getAllEmploys($pdo);
					if($employs !== null) {
						$reply->data = $employs;
					}
				}
			} elseif(($method ===  "POST")) {
				//verify Xsrf
				$requestContent = file_get_contents("php://input");
				$requestObject = json_decode($requestContent);

				//make sure employ profile is available
				if(empty($requestObject->profileName) === true) {
					throw(new InvalidArgumentException("Need to input employee name.", 405));
				}
				if(empty($requestObject->profileType) === true) {
					throw(new InvalidArgumentException("Need to input the owner or employee status.", 405));
				}
				if(empty($requestObject->profileEmail) === true) {
					throw(new InvalidArgumentException("Need to insert employee email.", 405));
				}
				//Todo----GET COMPANY BY COMPANYEMAIL....POSSIBLY....IF WE NEED TO LINK BACK TO COMPANY
				//-----here im making Salt, DummyPassword, profile activation token and hash---//
				$salt = bin2hex(random_bytes(16));
				$dummyPassword = bin2hex(random_bytes(16));
				$profileActivationToken = bin2hex(random_bytes(16));
				//what is the number at the end of the hash??
				$hash = hash_pbkdf2("sha512", $dummyPassword, $salt, 262144);

				//created new profile and insert into database
				$profile = new Profile(null, $requestObject->profileName, $requestObject->profileEmail,$profilePhone = "555-555-5555", $profileAccessToken = null, $profileActivationToken, $requestObject->profileType, $hash, $salt);

				$profile->insert($pdo);
				//update reply
				$reply->message = "A link has been sent to your employee/CoOwner for verification.";

//-----------------------------adding in swiftmailer------------------------------------//
				//sends email between owner and employee??
				$transport = Swift_SmtpTransport::newInstance('localhost', 25);

				//Create the Mailer using your created Transport
				$mailer = Swift_Mailer::newInstance($transport);

				//Create a message
				$message = Swift_Message::newInstance();//to set a subject line you can pass it as a parameter in newInstance or set it afterwards. I chose to set it afterwards. Same with body.

				//attach a sender to the message
				$message->setFrom(['vchacon8@cnm.edu'=> 'Crumbtrail Admin']);//is this the same as setFrom(array('someaddress'=>'name'));

				//attach recipients to the message. you can add
				$recipients = [($profile->getProfileEmail()) => $profile->getProfileName()];
				$message->setTo($recipients);//we will just send to one person.
				//include owner and employee name here???
				//attach a subject line to the message
				$message->setSubject('You have been invited to join crumbtrail. Please verify your email.');

				//the body of the message-seen when the user opens the message
				$message->setBody('Thanks for signing your company up with Crumbtrail. Please confirm your email by clicking on this link. Once you have confirmed your email, Crumbtrail admins can get to work on verifying your business and approving you to use the app. You will recieve an email when you have been approved.  ','text/html');

				//add alternative parts with addPart() meant for those who cannot read in html???
				$message->addPart('Thanks for signing your company up with Crumbtrail. Please confirm your email by clicking on this link. Once you have confirmed your email, Crumbtrail admins can get to work on verifying your business and approving you to use the app. You will recieve an email when you have been approved.  ', 'text/plain');
				$message->setReturnPath('bounces@address.tld');//return path address specifies where bounce notifications should be sent


				//Link that will be clicked on to confirm the employess email address? and set their profileActivationToken to null. This triggers an email (over in profileActivation API)

				//you should use $_SERVER["SCRIPT_NAME"]
				$scriptPath = $_SERVER["SCRIPT_NAME"];
				$linkPath = dirname($scriptPath, 2) . "/profileActivation/?profileActivationToken =$profileActivationToken";


				//Send the message
				$numSent = $mailer->send($message);

				printf("Sent %d messages\n", $numSent);

				/**
				 * the send method returns the number of recipients that accepted the Email
				 * so if the number attempted is not the number accepted, this is the exception (number attempted should only be one at a time)
				 **/
				if($numSent !== count($recipients)){
					//the $failedRecipients parameter passed in the send() method now contains an array of the Emails that failed
					throw(new RuntimeException("unable to send email"));
				}
//-----------------------------------------------SWIFTMAILER END-----------------------------------------------//
				//------DO I NEED ALL OF THIS HERE???WHY???-------//
				//---if(empty($requestObject->employProfileId) === true) {
				//--	throw(new InvalidArgumentException("No profile exists.", 405));
				//--}
				//make sure employ company id exists
				//--if(empty($requestObject->employCompanyId) === true) {
				//--	throw(new InvalidArgumentException("No company exists.", 405));
				//}
				//make sure the company id and the profile id exist
				//--if(empty($requestObject->employ) === true) {
					//--throw(new InvalidArgumentException("No employ Company id and employ Profile combination exists ", 405));
				//}
				//here??
				//--if(empty($requestObject->profileName) === true) {
					//--throw(new InvalidArgumentException("No profile name exists", 405));
				//}


				//perform actual PUT or POST
/*-------------------------------WHy is this here again?---------------*/
/*-----------NEED TO GET THIS EXTRA POST OUT---------------------------*/
				//if($method === "POST") {
					//makes sure tht everything I put in filter_sanitize exists
					//$employ = Employ::getEmployByEmployCompanyIdAndEmployProfileId($pdo, $employCompanyId, $employProfileId);
					//if($employ === null) {
						////create new relationship between profile and company id
						//$employ = new Employ($requestObject->employCompanyId, $requestObject->employProfileId);
						//$employ->insert($pdo);
						//$profile = Profile::getProfileByProfileId($pdo, $requestObject->employProfileId);
						//$profile->setProfileType($requestObject->profileType);
						//$profile->update($pdo);
						// update profile here
					//} else {
						//throw (new InvalidArgumentException("This profile Id and Profile type combination does not exist.", 405));
					}
				}
			//}
		//}
	} elseif($method === "DELETE") {
		verifyXsrf();
		//retrieve employ to be deleted
		//would I want employ by company and profile id, in the case that a worker/co owner is part of many companies??
		$employ = Employ::getEmployByEmployCompanyIdAndEmployProfileId($pdo, $employCompanyId, $employProfileId);
		if($employ === null) {
			throw(new RuntimeException("No employ Company Id and employ Profile Id combination exists.", 404));
		}
		//delete employ
		$employ->delete($pdo);
		//update reply
		$reply->message = "Employee or CoOwner deleted successfully";

	} else {
		throw (new InvalidArgumentException("Invalid HTTP method Request"));
	}
	//update reply with exception information
} catch(Exception $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
	$reply->trace = $exception->getTraceAsString();
} catch(TypeError $typeError) {
	$reply->status = $typeError->getCode();
	$reply->message = $typeError->getMessage();
}

header("Content-type: application.json");
if($reply->data === null) {
	unset($reply->data);
}
//encode and return reply to front end caller
echo json_encode($reply);


