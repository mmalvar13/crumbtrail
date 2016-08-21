<?php

require_once "autoloader.php";
require_once "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

use Edu\Cnm\Crumbtrail\; //something weird here

/**
 * api for sign in
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
$reply->data = null;

try {
	//grab the mySQL connection
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/signin.ini"); // what do i write here?

	//determine which HTTP method was used
	$method = array_key_exists("HTTP_x_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	//sanitize input
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

	//skipping "make sure the id is valid for the methods that require it"


	//handle POST request - if id is present, that account is returned, otherwise all accounts are returned?? nooo.

	if($method === "POST") {
		//set XSRF cookie
		setXsrfCookie();

		verifyXsrf();
		$requestContent = file_get_contents("php://input"); //what is the directory reference here??
		$requestObject = json_decode($requestContent);

		//check that email and password fields are not empty, and sanitize that filthy input
		if(empty($requestObject->profileEmail)=== true){
			throw(new \InvalidArgumentException("You must enter your email address", 405));
		}else {
			$profileEmail = filter_input(INPUT_GET, "profileEmail", FILTER_VALIDATE_EMAIL); //is this right? do i do filter_input or filter_var???
		}
		//checking the password field for user input //wait!! we dont even have a password attribute, where does the user input their password123?? why does it even say that it can find it??
		if(empty($requestObject->profilePassword)=== true){
			throw(new \InvalidArgumentException("Please enter your password", 405));
		}else{
			$password = filter_input($requestObject->profilePassword, FILTER_SANITIZE_STRING); //is this correct? filter_input or filter_var here??
		}
	}

	//create the user's profile session somehow here
	//throw an exception if they have an activation token. BRO, do you even profile?!
	//get those secret potatoes and compare it with the user input --if there isn't a match then BRO DO YOU EVEN PASSWORD???
	//something happens with a session somewhere in here.


}




