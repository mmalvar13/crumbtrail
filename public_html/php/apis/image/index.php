<?php

use Edu\Cnm\CrumbTrail\{
	Company, Image
};

require_once "autoloader.php";
require_once "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");


/**
 * api for the image class
 *
 * @author Lo-Bak baca.loren@gmail.com
 **/


//verify the session, start one if not active

if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

//prepare an empty reply
$reply = new stdClass();
$reply->status = 200;

//begin try section

try {
	//grab mySQL connection

	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/tweet.ini");

	//determine which HTTP method was used, what does the ? mean??
	$method = array_key_exists("HTTP_X_HTTP-METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	//sanitize input(Explain this) Where is the input coming from??
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);


	//make sure the id is valid for methods that require it, Remember that $id is the primary key!
	if(($method === "DELETE" || $method === "PUT") && (empty($id) === true || $id < 0)) {
		throw(new InvalidArgumentException("id cannot be empty or negative", 405));
	}

	//handle GET request. if a imageId is present, that image is returned, otherwise all images are returned
	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie();

		//get a specific image or all images and update reply
		if(empty($id) === false) {
			$image = Image::getImageByImageId($pdo, $id);
			if($image !== null) {
				$reply->data = $image;
			}
		}elseif(empty($id) === false) {
			$image = Image::getImageByImageCompanyId($pdo, $id);
			if($image !== null) {
				$reply->data = $image;
			}
		}elseif(empty($id) === false) {
			$image = Image::getImageByImageFileName($pdo, $id);
			if($image !== null) {
				$reply->data = $image;
			}
		}else{
			$images = Image::getAllImages($pdo);
			if($images !== null){
				$reply->data = $images;
			}
		}


	}elseif()
}

