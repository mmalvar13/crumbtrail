<?php

require_once "autoloader.php";
require_once "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
require_once(dirname(__DIR__, 4) . "/vendor/autoload.php");
//do i add something here for swiftmailer?

use Edu\Cnm\Crumbtrail\{
	Profile
};

/**
 * api for Profile Activation. Getting a confirmation email from a new user
 *
 * @author Monica Alvarez <mmalvar13@gmail.com>
 *
 * help from breadbasket
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
	$pdo = connectToEncyptedMySQL("/etc/apache2/capstone-mysql/profileActivation.ini"); //??

	//determine which HTTP method was used. first one is the method you use, second is the fall back if the first is not available
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	//sanitize input
	$profileActivationToken = filter_input(INPUT_GET, "profileActivationToken", FILTER_SANITIZE_STRING);

	//what is this supposed to do?? it is placed here in the breadbasket example but is within an if block under the GET methods block in the paper example
	//$company = Company::getCompanyByCompanyAccountCreatorId($pdo, $companyAccountCreatorEmailActivation);

	//this one is probably the GET dylan was talking about! since the others were POSTs
	//handle GET request - if id is present, that profile is returned, otherwise all profiles are returned??
	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie();

		if(empty($profileActivationToken) === true) {
			throw(new InvalidArgumentException("Account has already been activated or does not exist", 404));
		} else {
			$profile = Profile::getProfileByProfileActivationToken($pdo, $profileActivationToken);
			$profileActivationToken->setProfileActivationToken(null);
			$profileActivationToken->update($pdo);
		}//update activation token to null when activation link is clicked. that means its activated. is this done within swiftmailer code or right here?


		//use swiftmailer hereish
		//api gets profile by profile activation token
		//update activation token to null when activation link is clicked. that means its activated
		//same link in same email to approve company activation and profile activation tokens.
		/*----------------------------------swiftmailer code here-------------------------------------------------*/

		/**
		 * we're sending an email upon approval of company to notify the companyAccountCreator that their company has been approved. we provide them with a link, and when they click that link, both the company and the personal profile are activated. This happens over in companyActivation, but this file, the profile activation, is called as well, so both companyActivationToken and profileActivationToken are set to null simultaneously.
		 *
		 * Here in profile activation, we activate EVERYONE'S profiles. so in order to activate a companyAccountCreatorProfile, companyActivation must call profile activation to do it simultaneously. We also need to activate profiles of employees who are invited to join the company page (as either employees or co-owners). Profile activation sends emails to employees invited that way. These emails have an activation link. The profiles have already been submitted and created by the owner(person who invited). They submitted the employee's name, email, phone(will be submitted as a filler number), and profile type(which will be selected by the owner who invited). WHen this email is sent to the employee, it has a link. when they click on the link, their profileActivationToken is set to null. Cool, well how is the employee API connected to the profileActivation API?
		 *
		 *In Employee API we are inviting new employees. But Victoria said that she does not need swiftmailer
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
		$message->setFrom(['admin@crumbtrail.com' => 'Crumbtrail Admin']);//is this the same as setFrom(array('someaddress'=>'name'));

		//attach recipients to the message. you can add
		$recipients = ['originalAccountCreator@foodtruck.org' => 'Truckina McTruckerson'];
		$message->setTo($recipients);//we will just send to one person.

		//attach a subject line to the message
		$message->setSubject("You've been invited to join Crumbtrail");

		//the body of the message-seen when the user opens the message
		$message->setBody('You have been invited to join Crumbtrail by your supervisor. Click this link to activate your account ', 'text/html');

		//add alternative parts with addPart() for those who can only read plaintext or dont wwant to view in html
		$message->addPart('You have been invited to join Crumbtrail by your supervisor. Click this link to activatet your account. ', 'text/plain');
		$message->setReturnPath('bounces@address.tld');//return path address specifies where bounce notifications should be sent


		//building the activation link that can travel to another server and still work. this is the link that will be clicked on to confirm. maybe this is not actually h ere, but in companyActivation/ProfileActivation/EmployeeActivation.
		//this is from breadbasket. must be changed to reflect crumbtrail stuff.

		/*new stuff dylan sent*/
		//this sshould already have been retrieved earlier on
		$profileActivationToken = "feeddeadbeefcafe"; //what do i put here?

		//you should use $_SERVER["SCRIPT_NAME"] insteead
		$scriptPath = $_SERVER["SCRIPT_NAME"];
		$linkPath = dirname($scriptPath, 2) . "/profileActivation/?profileActivationToken";
		/*end of stuff dylan sent*/

		$confirmLink = "https://" . $_SERVER["SERVER_NAME"] . $urlglue; //maybe dont need this. this is from breadbasket.
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
		if($numSent !== count($recipients)) {
			//the $failedRecipients parameter passed in the send() method now contains an array of the Emails that failed
			throw(new RuntimeException("unable to send email"));
		}
		/*----------------------------------SwiftMailer Code Ends Here------------------------------------------*/
	}
}

