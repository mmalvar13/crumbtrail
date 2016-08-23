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
	$imageCompanyId = filter_input(INPUT_GET, "imageCompanyId", FILTER_VALIDATE_INT);
	$imageFileName = filter_input(INPUT_GET, "imageFileName", FILTER_VALIDATE_INT);


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
			$image = Image::getImageByImageCompanyId($pdo, $imageCompanyId);
			if($image !== null) {
				$reply->data = $image;
			}
		}elseif(empty($id) === false) {
			$image = Image::getImageByImageFileName($pdo, $imageFileName);
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
			throw(new \InvalidArgumentException("The foreign key does not exist", 405));
		}

		//make sure the image name is available (required field)
		if(empty($requestObject->imageName) === true){
			throw(new \InvalidArgumentException("The image name does not exist", 405));
		}

		//make sure the image file type is available (required field)
		if(empty($requestObject->imageFileType) === true){
			throw(new \InvalidArgumentException("The image file type does not exist", 405));
		}

		if($method === "POST"){

			//retrieve the image to update
			$image = Image::getImageByImageId($pdo, $id);
			if($image === null){
				throw(new \RuntimeException("The image does not exist", 404));
			}

			//image sanitization----------------------------------------------------------------
			$validExts = array(".jpg", ".jpeg",".png");
			//what does ("image/jpeg") and ("image/png") do??
			$validTypes = array();

			//strrchr — Find the last occurrence of a character in a string.
			//     returns the portion of haystack which starts at the last occurrence of needle and goes until the end of haystack.
			//$_FILES['file']['name']-----The original name of the file on the client machine.


			$userFileExt = strrchr($_FILES["userImage"]["name"], ".");

			if(!in_array($userFileExt, $validExts)){
				throw(new InvalidArgumentException("That isn't a valid image"));
			}





			//1) move image to image directory (safe place to work with it) default
			//2) sanitize image name/type ---------image_type_to_extension & sanitize string?? getimagesize
//			  3) create image--------imagecreatefromjpeg/imagecreatefrompng
			//4) scale image down to the size I want------imagescale should be in px
			//5) rename image to something I want
//			  6)imagefoo to save


//			when they go to POST an image, you must first make a call to delete the image currently in there
//			THEN, you can make a call to POST the new image







		}

	}
}

