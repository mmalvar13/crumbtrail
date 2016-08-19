<?php


//We need to:
//get all companies
//get a specific company by primary key
//create a new company
//update a company by primary key
//delete a company by primary key

require_once "autoloader.php";
require_once "/lib/xsrf.php";
require_once("/etc/apache2/crumbtrail-mysql/encrypted-config.php");

/**
 * api for the Company class
 *
 * @author Loren Baca baca.loren@gmail.com
 */

//verify the session, start one if not active
if(session_status() !== PHP_SESSION_ACTIVE){
	session_start();
}

//prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;

//begin try section

try{
	//grab the mySQL connection
	$pdo = connectToEncryptedMySQL("/etc/apache2/crumbtrail-mysql/company.ini");


}