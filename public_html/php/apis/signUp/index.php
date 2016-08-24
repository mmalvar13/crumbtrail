<?php

require_once (dirname(__DIR__)) . "autoloader.php";//where is this? same autoload.php as before or a new one?
require_once (dirname(__DIR__)) . "/lib/xsrf.php"; //when do we make this?
require_once("/etc/apache2/capstone-mysql/encrypted-config.php"); //do i put crumbtrail-mysql here?
require_once (dirname(__DIR__)) . "lib/swift_required.php"; //idk, composer.json. this is just what the documentation had.

use Edu\Cnm\Crumbtrail\{Company, Profile}; //is this correct? i dont have to add mmalvar13 right? do i add company and profile like this?

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
	$pdo = connectionToEncryptedMySQL("/etc/apache2/capstone-mysql/crumbtrail.ini"); //check notes for this

	//determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	//sanitize input
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

	//skipping "make sure the id is valid for the methods that require it"

	if($method === "POST") {
		//set XSRF cookie
		setXsrfCookie();

		verifyXsrf();
		$requestContent = file_get_contents("php://input"); //what is the directory reference here??
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
		if(empty($requestObject->profileType)=== true){
			$requestObject->profileType = "o"; //is this the correct default value for profileType? anyone signing up via this route
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
			$requestObject->companyStreet2 = null;
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
			$requestObject->companyDescription = null;
		}
		if(empty($requestObject->companyMenuText) === true){
			$requestObject->companyMenuText = null;
		}

		//sanitize the email
		$profileEmail = filter_var($requestObject->profileEmail, FILTER_SANITIZE_EMAIL);
		$profile = Profile::getProfileByProfileEmail($pdo, $profileEmail);
		if($profile !== null){
			throw(new \InvalidArgumentException("this email already has an account",422));
		}

		//hash and salt it here. before hashing and salting, angular sends a password and confirmed password. throw an exception if they are not the same.
		//create a new salt and email activation
		$salt = bin2hex(random_bytes(16));
		//do i create email activation here? see line 176

		if($requestObject->profilePassword !== $requestObject->confirmProfilePassword) {
			throw (new InvalidArgumentException("the passwords you provided do not match"));
		}
		$profileActivationToken = bin2hex(random_bytes(16));
		$companyActivationToken = bin2hex(random_bytes(16));

		//create the hash
		$hash = hash_pbkdf2("sha512", $requestObject->profilePassword, $salt, 262144);

		//create a new profile and insert it into the databases
		$profile = new Profile(null, $requestObject->profileName, $requestObject->profileEmail, $requestObject->profilePhone, null, $profileActivationToken, $requestObject->profileType = null, $hash, $salt);

		$profile->insert($pdo);

		//create a new company and insert it into the database
		$company = new Company(null, $profile->getProfileId(), $requestObject->companyName, $requestObject->companyEmail, $requestObject->companyPhone, $requestObject->companyPermit, $requestObject->companyLicense, $requestObject->companyAttn, $requestObject->companyStreet1, $requestObject->companyStreet2, $requestObject->companyCity, $requestObject->companyState, $requestObject->companyZip, $requestObject->companyDescription , $requestObject->companyMenuText, $companyActivationToken, false);

		$company->insert($pdo);

		//update reply
		$reply->message = "In the next 48 hours you will receive your approval notice from Crumbtrail. Check your email to activate your account";

		/*----------------------------------swiftmailer code here-------------------------------------------------*/

		/**
		 * we're sending an email upon sign up to notify them that we have received their request for a CrumbTrail account, and
		 * they should check their email in the next few days for their approval message.
		 *
		 * To send a message with swiftmailer, you create a transport, use it to create the Mailer, and then y ou use the
		 * Mailer to send the message
		 *
		 * We are using the SMTP Transport Type. A transport is the component that actually does the sending.
		 * SMTP (Simple Message Transfer Protocol). It is the most commonly used Transport because it will work on 99% of web
		 * servers, according to the PIDOMA analysis.
		 **/


		//Create the Transport
		$transport = Swift_SmtpTransport::newInstance('smtp.example.org', 25); //can add third parameter for SSL encryption. need?

		//Create the Mailer using your created Transport
		$mailer = Swift_Mailer::newInstance($transport);

		//Create a message
		$message = Swift_Message::newInstance();//to set a subject line you can pass it as a parameter in newInstance or set it afterwards. I chose to set it afterwards. Same with body.

		//attach a sender to the message
		$message->setFrom(['admin@crumbtrail.com'=> 'Crumbtrail Admin']);//is this the same as setFrom(array('someaddress'=>'name'));

		//attach recipients to the message. you can add
		$recipients = ['originalAccountCreator@foodtruck.org' => 'Truckina McTruckerson'];
		$message->setTo($recipients);//we will just send to one person.

		//attach a subject line to the message
		$message->setSubject('Thanks for signing up with Crumbtrail');

		//the body of the message-seen when the user opens the message
		$message->setBody('Thanks for signing your company up with Crumbtrail. Our team will get to work on approving your account. You should receive an approval email in the next 48 hours with a link to confirm and activate your account. ','text/html');

			//add alternative parts with addPart() for those who can only read plaintext or dont wwant to view in html
		$message->addPart('Thanks for signing your company up with Crumbtrail. Our team will get to work on approving your account. You should receive an approval email in the next 48 hours with a link to confirm and activate your account. ', 'text/plain');
		$message->setReturnPath('bounces@address.tld');//return path address specifies where bounce notifications should be sent


		//building the activation link that can travel to another server and still work. this is the link that will be clicked on to confirm. maybe this is not actually h ere, but in companyActivation/ProfileActivation/EmployeeActivation.
		//this is from breadbasket so it might be old or something, idk!
		$lastSlash = strrpos($_SERVER["SCRIPT_NAME"], "/");
		$basePath = substr($_SERVER["SCRIPT_NAME"], 0, $lastSlash + 1);
		$urlglue = $basePath . "email-confirmation?emailActivation=" . $volEmailActivation;

		$confirmLink = "https://" . $_SERVER["SERVER_NAME"] . $urlglue;
		$message = <<< EOF
<h1>You have been approved to start serving with CrumbTrail</h1>
<p>Please click the following link to confirm your email and activate your account: </p>
<a href="$confirmLink">$confirmLink</a></p>
EOF;

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
		//this is where my own swiftmailer code ends
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

