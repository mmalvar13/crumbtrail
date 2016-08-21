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


	}elseif($method === "PUT" || "POST"){
		verifyXsrf();
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);

//		create company to pull stuff from, DO I EVEN NEED THIS??? IM GUESSING NOT
		$company = Company::getCompanyByCompanyId($pdo, $id);

		if($requestObject->profileType !== 'a' || 'o') {
			throw(new \InvalidArgumentException("profile type must be admin('a') or owner('o') in order to make changes to an image"));
		}

		//make sure the image foreign key is available (required field)
		if(empty($requestObject->imageCompanyId) === true){
			throw(new \InvalidArgumentException("The foreign key does not exist", 405);
		}

		//make sure the image name is available (required field)
		if(empty($requestObject->imageName) === true){
			throw(new \InvalidArgumentException("The image name does not exist", 405);
		}

		//make sure the image file type is available (required field)
		if(empty($requestObject->imageFileType) === true){
			throw(new \InvalidArgumentException("The image file type does not exist", 405);
		}

		if($method === "PUT"){

			//retrieve the image to update
			$image = Image::getImageByImageId($pdo, $id);
			if(!$image){
				throw(new \RuntimeException("The image does not exist", 404));
			}

			//here is where we have to sanitize the image input, create an image out of it
			//need to have a check for the image file type, so i know to use createImageFrom(jpeg/png) what about jpg????
			//need to make sure we change the name from whatever they uploaded to something we like

			//assume I will need FILTER_SANITIZE_URL and FILTER_SANITIZE_STRING at some point for the file names??


		}

	}
}

