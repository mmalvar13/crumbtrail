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

		//this is a check to make sure only a profile type of ADMIN or OWNER can make changes
	}elseif((empty($_SESSION["profile"]) === false) && (($_SESSION["profile"]->getProfileId()) === $id) && (($_SESSION["profile"]->getProfileType()) === "a") || (($_SESSION["profile"]->getProfileType())) === "o") {

		if($method ==="POST"){
		verifyXsrf();
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);

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

			//image sanitization----------------------------------------------------------------

			//create arrays for valid image extensions and valid image MIME types
			$validExtensions = array(".jpg", ".jpeg",".png");
			$validTypes = array("image/jpeg", "image/jpg", "image/png");


			//assigning variables to the user image name, MIME type, and image extension
			$userFileName = $_FILES["userImage"]["name"];
			$userFileType = $_FILES["userImage"]["type"];
			$userFileExtension = strrchr($_FILES["userImage"]["name"], ".");

			//check to ensure the file has correct extension and MIME type
			if(!in_array($userFileExtension, $validExtensions) || (!in_array($userFileType, $validTypes))){
				throw(new \InvalidArgumentException("That isn't a valid image"));
			}else{
				//would I even need to make a new assignment, can I just use $userFileName??
				$tempFileName = $userFileName;
				$newFileExtension = $userFileExtension;
				$newFileType = $userFileType;
			}

			//image creation if file is .jpg/.jpeg or .png--------------------------------------------------------------------
			if($newFileExtension === ".jpg" || $newFileExtension === ".jpeg"){
				$sanitizedUserImage = imagecreatefromjpeg($tempFileName);
			}elseif($newFileExtension === ".png"){
				$sanitizedUserImage = imagecreatefrompng($tempFileName);
			}
			//WTF does imageCreateFromFoo actually output?? returns an image identifier what is that??

			//image scale to 500px width, leave height auto---------------------------------------------------------------------
			$scaledImage = imagescale($sanitizedUserImage, 500);

			//split new name so we can add custom name
			$scaledExplode = explode(".", $scaledImage);
			$scaledExtension = end($scaledExplode);

			//use microtime to give file new name
			$newImageName = round(microtime(true)) . "." . $scaledExtension;

			if($scaledExtension === ".jpg" || $scaledExtension === ".jpeg"){
				$createdProperly = imagejpeg($sanitizedUserImage);
			}elseif($scaledExtension === ".png"){
				$createdProperly = imagepng($sanitizedUserImage);
			}

			//put new image into the database
			if($createdProperly === true) {
				$image = new Image(null, $requestObject->imageCompanyId, $newFileType, $newImageName);
				$image->insert($pdo);
			}

		}

		}

	}
} //for delete 1) get image by ID, 2) get image file path 3) delete image from server 4) delete image from database
//look for delete file function PHP for files

