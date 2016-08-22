<?php

require_once "autoloader.php";
require_once "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
//do i add something here for swiftmailer?

use Edu\Cnm\Crumbtrail\{Company}; //por que greasy grissss????

/**
 * api for Profile Activation. Getting a confirmation email from a new user
 *
 * @author Monica Alvarez <mmalvar13@gmail.com>
 *
 * help from breadbasket
 **/

//verify the session, start if not active
if(session_status() !== PHP_SESSION_ACTIVE){
	session_start();
}

//prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null; //making a placeholder for the variable reply. you will store stuff here later!!


try{
	//grab the mySQL connection
	$pdo = connectToEncyptedMySQL("/etc/apache2/capstone-mysql/profileActivation.ini"); //??

	//determine which HTTP method was used. first one is the method you use, second is the fall back if the first is not available
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"]; //do i use this?

	//sanitize input
	$companyAccountCreatorEmailActivation = filter_input(INPUT_GET, "companyAccountCreatorEmailActivation", FILTER_SANITIZE_STRING);

	//what is this supposed to do?? it is placed here in the breadbasket example but is within an if block under the GET methods block in the paper example
	$company = Company::getCompanyByCompanyAccountCreatorId($pdo, $companyAccountCreatorEmailActivation);



	//this one is probably the GET dylan was talking about! since the others were POSTs
	//handle GET request - if id is present, that profile is returned, otherwise all profiles are returned??
	if($method === "GET"){
		//set XSRF cookie
		setXsrfCookie();

		//check if empty activation token, that means the account has already been activated or doesnt exist.
		if(empty($companyAccountCreatorEmailActivation) === true){
			throw(new InvalidArgumentException("Account has already been activated or does not exist", 404));

		}else {
			$companyAccountCreatorEmailActivation->setCompanyAccountCreatorId(null);
			$companyAccountCreatorEmailActivation->update($pdo);

			//use swiftmailer hereish
		}
	}
}