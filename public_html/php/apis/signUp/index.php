<?php


require_once(dirname(__DIR__, 2) . "/classes/autoload.php");//need to add these
require_once(dirname(__DIR__, 2) . "/lib/xsrf.php");
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
require_once (dirname(__DIR__,4) . "/vendor/autoload.php"); //idk, composer.json. this is just what the documentation had.


use Edu\Cnm\CrumbTrail\{Company, Employ, Profile};

/**
 * api for signUp
 *
 * @author Monica Alvarez <mmalvar13@gmail.com>
 **/


//verify the session, start if not active
if(session_status() !== PHP_SESSION_ACTIVE){
	session_start();
}

//prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;

try {
	//grab the mySQL connection

	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/crumbtrail.ini");

	//determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	//sanitize input, put more stuff here
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
	$profileName = filter_input(INPUT_POST, "profileName", FILTER_SANITIZE_STRING);
	$profileEmail = filter_input(INPUT_POST, "profileEmail", FILTER_SANITIZE_EMAIL);
	$profilePhone = filter_input(INPUT_POST, "profilePhone", FILTER_SANITIZE_STRING);
	$profilePassword = filter_input(INPUT_POST, "profilePassword", FILTER_SANITIZE_STRING);
	$confirmProfilePassword = filter_input(INPUT_POST, "confirmProfilePassword", FILTER_SANITIZE_STRING);
	$companyName = filter_input(INPUT_POST, "companyName", FILTER_SANITIZE_STRING);
	$companyEmail = filter_input(INPUT_POST,"companyEmail", FILTER_SANITIZE_EMAIL);
	$companyPhone = filter_input(INPUT_POST, "companyPhone", FILTER_SANITIZE_STRING);
	$companyPermit = filter_input(INPUT_POST, "companyPermit", FILTER_SANITIZE_STRING);
	$companyLicense = filter_input(INPUT_POST, "companyLicense", FILTER_SANITIZE_STRING);
	$companyAttn = filter_input(INPUT_POST, "companyAttn", FILTER_SANITIZE_STRING);
	$companyStreet1 = filter_input(INPUT_POST, "companyStreet1", FILTER_SANITIZE_STRING);
	$companyStreet2 = filter_input(INPUT_POST, "companyStreet2", FILTER_SANITIZE_STRING);
	$companyCity = filter_input(INPUT_POST, "companyCity", FILTER_SANITIZE_STRING);
	$companyState = filter_input(INPUT_POST, "companyState", FILTER_SANITIZE_STRING);
	$companyZip = filter_input(INPUT_POST, "companyZip", FILTER_SANITIZE_STRING);


	if($method === "POST") {
		//verify XSRF cookie
		verifyXsrf();

		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);

		//make sure all required fields are entered
		if(empty($requestObject->profileName) === true){
			throw(new \InvalidArgumentException("Must provide your name", 405));
		}
		if(empty($requestObject->profileEmail) === true ){
			throw(new \InvalidArgumentException("Must provide an email address", 405));
		}
		if(empty($requestObject->profilePhone)=== true){
			throw(new \InvalidArgumentException("Must provide a phone number", 405));
		}
		if(empty($requestObject->profilePassword)===true){
			throw(new \InvalidArgumentException("Must provide a password", 405));
		}
		if(empty($requestObject->confirmProfilePassword)=== true){
			throw(new \InvalidArgumentException("Must confirm your password", 405));
		}
//		if(empty($requestObject->profileAccessToken) === true){
//			$requestObject->profileAccessToken = null; //todo type hinting wants this a string, i want it a null
////		}
		if(empty($requestObject->profileType)=== true){
			$requestObject->profileType = "O";
		}
		if(empty($requestObject->companyName)=== true){
			throw(new \InvalidArgumentException("You must enter a company name", 405));
		}
		if(empty($requestObject->companyEmail)===true){
			throw(new\InvalidArgumentException("You must enter a company email address", 405));
		}
		if(empty($requestObject->companyPhone)=== true){
			throw(new \InvalidArgumentException("You must enter a company phone number", 405));
		}
		if(empty($requestObject->companyPermit)=== true){
			throw(new \InvalidArgumentException("You must enter your businesses health permit number", 405));
		}
		if(empty($requestObject->companyLicense) === true){
			throw(new \InvalidArgumentException("Must provide a company business license number", 405));
		}
		if(empty($requestObject->companyAttn)=== true){
			throw(new \InvalidArgumentException("Must provide company attention contact", 405));
		}
		if(empty($requestObject->companyStreet1) === true){
			throw(new \InvalidArgumentException("Must provide company address", 405));
		}
		if(empty($requestObject->companyStreet2)=== true){
			$requestObject->companyStreet2 = "company street"; //todo type hinting wants this a string, i  want it null
		}
		if(empty($requestObject->companyCity)=== true){
			throw(new \InvalidArgumentException("Must provide city", 405));
		}
		if(empty($requestObject->companyState)=== true){
			throw(new \InvalidArgumentException("Must provide state", 405));
		}
		if(empty($requestObject->companyZip)=== true){
			throw(new \InvalidArgumentException("Must provide zip code", 405));
		}
		if(empty($requestObject->companyDescription) === true){
			$requestObject->companyDescription = "Tell everyone who you are!"; //todo type hinting wants this a string, i want it null. Company Line 593
		}
		if(empty($requestObject->companyMenuText) === true){
			$requestObject->companyMenuText = "What do you serve?";//todo type hinting wants this a string, i want it null
		}

		//sanitize the email. Make sure there is not already an account attached to this email
//		$profileEmail = filter_var($requestObject->profileEmail, FILTER_SANITIZE_EMAIL);
//		$profile = Profile::getProfileByProfileEmail($pdo, $profileEmail);
//		if(empty($profile) === false){ //correct?? or set to not null?
//			throw(new \InvalidArgumentException("this email already has an account",422));
//		}//todo lines 128-132, keeps throwing this exception. por que?


		//create a new salt and email activation
		$salt = bin2hex(random_bytes(16));

		/*before hashing  and salting, angular sends a password and confirmed password. Throw an exception if they are not the same*/
		if($requestObject->profilePassword !== $requestObject->confirmProfilePassword) {
			throw (new InvalidArgumentException("the passwords you provided do not match"));
		}

		//create profile and company activation tokens
		$profileActivationToken = bin2hex(random_bytes(16));
		$companyActivationToken = bin2hex(random_bytes(16)); //do i need company activation token.
		$profileAccessToken = bin2hex(random_bytes(32)); //todo do i need this? it wont let me set it to null. should i just make this random thing?

		//create the hash
		$hash = hash_pbkdf2("sha512", $requestObject->profilePassword, $salt, 262144);

		//create a new profile and insert it into the databases
		$profile = new Profile(null, $requestObject->profileName, $requestObject->profileEmail, $requestObject->profilePhone, $profileAccessToken, $profileActivationToken, $requestObject->profileType, $hash, $salt);
//todo type hinting profileAccessToken
		$profile->insert($pdo);

		//create a new company and insert it into the database
		$company = new Company(null, $profile->getProfileId(), $requestObject->companyName, $requestObject->companyEmail, $requestObject->companyPhone, $requestObject->companyPermit, $requestObject->companyLicense, $requestObject->companyAttn, $requestObject->companyStreet1, $requestObject->companyStreet2, $requestObject->companyCity, $requestObject->companyState, $requestObject->companyZip, $requestObject->companyDescription , $requestObject->companyMenuText, $companyActivationToken, null);

		$company->insert($pdo);

		//create employ
		$employ = new Employ($company->getCompanyId(), $profile->getProfileId());
		$employ->insert($pdo);

		//update reply
		$reply->message = "We have sent you an email to the personal address you have provided. Please confirm your account by clicking on the link in that email.";

		/*----------------------------------swiftmailer code here-------------------------------------------------*/

		/**
		 * we're sending an email upon sign up to notify them that we have received their request for a CrumbTrail account, and that we need them to confirm their email (which activates their profile). This email should also explain that their account is not ready to use until we have verified the business information they have provided, and they should recieve an acceptance email from us soon.
		 *
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

		//building the profile activation link. this is the link that will be clicked on to confirm the companyAccountCreators email address and set their profileActivationToken to null. This triggers an email (over in profileActivation API) to be send to crumbtrail admins to check out this businesses credentials.
		/*new stuff dylan sent*/

		//you should use $_SERVER["SCRIPT_NAME"] insteead
		$scriptPath = $_SERVER["SCRIPT_NAME"];
//		$linkPath = dirname($scriptPath, 2) . "/profileActivation/?profileActivationToken=$profileActivationToken";
		$linkPath = dirname($scriptPath, 2) . "/profileActivation/?profileActivationToken=" . $profileActivationToken . "&companyId=" . $company->getCompanyId();
		/*end of stuff dylan sent*/

		//attach a sender to the message
		$message->setFrom(['mmalvar13@gmail.com'=> 'Crumbtrail Admin']);//is this the same as setFrom(array('someaddress'=>'name'));

		//attach recipients to the message. you can add
		$recipients = [$company->getCompanyEmail() => $company->getCompanyName()]; //TODO is this the correct way to attach email to name?
		$message->setTo($recipients);//we will just send to one person.

		//attach a subject line to the message
		$message->setSubject('Thanks for signing up with Crumbtrail. Please confirm your email');

		//the body of the message-seen when the user opens the message
		$message->setBody('Thanks for signing your company up with Crumbtrail. Please confirm your email by clicking on this link. Once you have confirmed your email, Crumbtrail admins can get to work on verifying your business and approving you to use the app. You will receive an email when you have been approved.  '."<a href=\"$linkPath\">Click Here To Activate</a>", 'text/html');

			//add alternative parts with addPart() for those who can only read plaintext or dont wwant to view in html
		$message->addPart('Thanks for signing your company up with Crumbtrail. Please confirm your email by clicking on this link. Once you have confirmed your email, Crumbtrail admins can get to work on verifying your business and approving you to use the app. You will receive an email when you have been approved.  '."<a href=\"$linkPath\">Click Here To Activate</a>", 'text/plain');
		$message->setReturnPath('mmalvar13@gmail.com');//return path address specifies where bounce notifications should be sent todo what is thiss for?





		//Send the message
		$numSent = $mailer->send($message);
		/**
		 * the send method returns the number of recipients that accepted the Email
		 * so if the number attempted is not the number accepted, this is the exception (number attempted should only be one at a time)
		 **/
		if($numSent !== count($recipients)){
			//the $failedRecipients parameter passed in the send() method now contains an array of the Emails that failed
			throw(new RuntimeException("unable to send email"));
		}
		/*----------------------------------SwiftMailer Code Ends Here------------------------------------------*/
	} else {
		throw(new InvalidArgumentException("Invalid HTTP method request"));
	}

	//update reply with exception information
}catch(Exception $exception){
		$reply->status = $exception->getCode();
		$reply->message = $exception->getMessage();
		$reply->trace = $exception->getTraceAsString();
	}catch(TypeError $typeError){
		$reply->status = $typeError->getCode();
		$reply->message = $typeError->getMessage();
	}

header("Content-type: application/json");
if($reply->data === null){
	unset($reply->data);
}

//encode and return reply to front end caller
echo json_encode($reply);

