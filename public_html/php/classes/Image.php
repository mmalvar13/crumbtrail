<?php

//namespace //
namespace Edu\Cnm\CrumbTrail; 


//autoload?//
require_once("autoload.php");

//Begin Docblock//

/**
 * Image that a company will provide
 *
 * This image will be what the company uses to identify themselves to the user. In future goals we are hoping to use this in order to give the companies a gallery to work with.
 *
 * @author Victoria Chacon <victoriousdesignco@gmail.com>
 **/
//what does version apply to in the tweet example? is it necessary here?//
class Image implements \JsonSerializable {
	/**
	 * id for this Image; this is the primary key
	 * @var int $imageId
	 **/
	private $imageId;
	/**
	 * this is the id of the image that relates to which company. This is a foreign key.
	 * @var int $imageCompanyId ;
	 **/
	private $imageCompanyId;
	/**
	 * this is the id that will identify what type of image the company is using. JPG, Jpeg, PNG.
	 * @var string $imageFileType ;
	 */
	private $imageFileType;
	/**
	 * this is the id that informs the user of the name of said image.
	 * @var string $imageFileName ;
	 */
	private $imageFileName;
//
	//constructor will go here//
	/**
	 * Image constructor.
	 * @param int|null $newImageId
	 * @param int $newImageCompanyId
	 * @param string $newImageFileType
	 * @param string $newImageFileName
	 * @throws \RangeException
	 * @throws \InvalidArgumentException if the image is not a JPG, Jpeg, or PNG
	 * @throws \PDOException
	 */
	public function __construct(int $newImageId = null, int $newImageCompanyId, string $newImageFileType, string $newImageFileName) {
		try {
			$this->setImageId($newImageId);
			$this->setImageCompanyId($newImageCompanyId);
			$this->setImageFileType($newImageFileType);
			$this->setImageFileName($newImageFileName);
		} catch(\RangeException $range) {
			//rethrows exception to the caller//
			throw(new \RangeException($range->getMessage(), 0, $range));
		} catch(\InvalidArgumentException $invalidArgument) {
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		}

	}
	//adding in the accessor method for image.php

	/**
	 * gets image by image id
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $imageId image id to search for
	 * @return Image|null Image found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getImageByImageId(\PDO $pdo, int $imageId) {
		//sanitize the imageId before searching
		if($imageId <=0) {
			throw(new \PDOException("Image Id is not positive"));
		}
		//query template
		$query = "SELECT imageId, imageCompanyId, imageFileType, imageFileName FROM image WHERE imageId =:imageId";
		$statement = $pdo->prepare($query);
		//bind the image id to the place holder in the template
		$parameters = ["imageId" => $imageId];
		$statement->execute($parameters);

		//grab image from mySQL
		try {
			$image =null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$image = new Image($row["imageId"], $row["imageCompanyId"], $row["imageFileType"], $row["imageFileName"]);
			}
		} catch(\Exception $exception) {
			//if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($image);
	}

	/**
	 * gets image by company??
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int, $imageCompanyId image to search for
	 * @return \SplFixedArray SplFixedArray of images found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are nor the correct data type
	 **/
	public static function getImageByImageCompanyId(\PDO $pdo, int $imageCompanyId) {
		//sanitize the description? before searching
		if($imageCompanyId <=0) {
			throw(new \PDOException("Image Company Id is not positive"));
		}
		//query template
		$query ="SELECT imageId, imageCompanyId, imageFileType, imageFileName FROM image WHERE imageCompanyId= :imageCompanyId";
		$statement = $pdo->prepare($query);
		//bind the image company Id to the placeholder template
		$parameters = ["imageCompanyId" => $imageCompanyId];
		$statement->execute($parameters);
		//build an array of images
		//getting a single image, do i need a fixed array?
		$images = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !==false) {
			try {
				$image = new Image($row["imageId"], $row["imageCompanyId"], $row["imageFileType"], $row["imageFileName"]);
				$images[$images->key()] = $image;
				$images->next();
			} catch(\Exception $exception) {
				//if row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(),0, $exception));
			}
		}
		return($images);
	}

	/**
	 *gets images by image file name
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $imageFileName image file name to search for
	 * @return \SplFixedArray SplFixedArray of Images found
	 * @throws \PDOException whe mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getImageByImageFileName(\PDO $pdo, string $imageFileName) {
		//sanitize the description before searching
		$imageFileName = trim($imageFileName);
		$imageFileName = filter_var($imageFileName, FILTER_SANITIZE_STRING);
		if(empty($imageFileName) === true) {
			throw(new \PDOException("image file name is invalid"));
		}
		//query template
		$query = "SELECT imageId, imageCompanyId, imageFileType, imageFileName FROM image WHERE imageFileName LIKE :imageFileName";
		$statement = $pdo->prepare($query);
		//bind the image file name to the place holder in the template
		$imageFileName = "%imageFileName%";
		$parameters = ["imageFileName" => $imageFileName];
		$statement->execute($parameters);
		//array of images?
		$images = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$image = new Image($row["imageId"], $row["imageCompanyId"], $row["imageFileType"], ["imageFileName"]);
				$images[$image->key()] =$image;
				$images->next();
			} catch(\Exception $exception) {
				//if the row can't be converted,rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($images);
	}

	/** gets all images
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of Images found or null if not found
	 * @throws \PDOException when mySQL related error occur
	 * @throws \TypeError when variables are nor the correct data type
	 **/
	public static function getAllimages(\PDO $pdo) {
		//query template
		//Do I need to select all attributes? Should I exclude file type?
		$query = "SELECT imageId, imageCompanyId, imageFileType, imageFileName FROM image";
		$statement = $pdo->prepare($query);
		$statement->execute();
		//build an array of images
		$images = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$image = new Image($row["imageId"], ["imageCompanyId"], ["imageFileType"], ["imageFileName"]);
				$images[$images->key()] =$image;
				$images->next();
			} catch(\Exception $exception) {
				//if row can't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($images);
	}

	/**
	 * accessor method for image id
	 *
	 * @return int|null value of image id
	 **/
	public function getImageId() {
		return ($this->imageId);
	}

	/**
	 * mutator method for image id
	 *
	 * @param int|null $newImageId new value of image id
	 * @throw \RangeException if $newImageId is negative
	 **/
	public function setImageId(int $newImageId = null) {
		if($newImageId === null) {
			$this->imageId = null;
			return;
		}
		//verifying that the image id is positive??
		if($newImageId <= 0) {
			throw(new \RangeException ("image id is not positive"));
		}
		//converting and storing Image Id
		$this->imageId = $newImageId;
	}

	/**
	 * accessor method for image company id
	 *
	 * @return int|null value of ImageCompanyId
	 */
	public function getImageCompanyId() {
		return $this->imageCompanyId;
	}

	/**
	 * mutator method for image company id
	 * @param int|null $newImageCompanyId new value of image company id
	 * @throw \RangeException if $ImageCompanyId is negative
	 **/
	public function setImageCompanyId(int $newImageCompanyId = null) {
		if($newImageCompanyId <= 0) {
			throw(new \RangeException ("Image Company Id is not positive"));
		}
		//convert and store
		$this->imageCompanyId = $newImageCompanyId;
	}
	// start the PDO section here
	//insert method here

	/** accessor method for image file type
	 *
	 * @return string value of imageFileType
	 */
	public function getImageFileType() {
		return $this->imageFileType;
	}

	//delete method here

	/**
	 * mutator for image file type
	 *
	 * @param string $newImageFileType new value of image file type
	 * @throws \InvalidArgumentException if $newImageFileType is not a string
	 * @throws \RangeException if $newImageFileType > 10 characters
	 * @throws \PDOException
	 */
	public function setImageFileType(string $newImageFileType) {
		$validFileType = ["image/jpeg", "image/jpg", "image/png"];
		$newImageFileType = strtolower($newImageFileType);
		if(in_array($newImageFileType, $validFileType) === false) {
			throw(new \PDOException("This is not the proper image type. Please insert jpeg, or png"));
		}
		//convert and store
		$this->imageFileType = $newImageFileType;
	}
	//update method here

	/**
	 * accessor for the image file name
	 *
	 * @return string value for imageFileName
	 **/
	public function getImageFileName() {
		return $this->imageFileName;
	}
	//getFooByBar
	//need this explained?

	/**
	 * mutator for image file name
	 *
	 * @param string $newImageFileName new value of image file name
	 * @throw /RangeException if $newImageFileName > 255 characters
	 */
	public function setImageFileName(string $newImageFileName) {
		if($newImageFileName > 255) {
			throw(new \RangeException("Image file name is too long"));
		}
		//convert and store
		$this->imageFileName = $newImageFileName;
	}

	/**
	 * inserts this image into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws |PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo) {
		//enforce image id...essentially...don't put in an image that already exists.
		if($this->imageId !== null) {
			throw(new \PDOException("Not a new image"));
		}
		//query template
		//why yellow????
		$query = "INSERT INTO image(imageCompanyId, imageFileType, imageFileName) VALUES(:imageCompanyId, :imageFileType, :imageFileName)";
		$statement =$pdo->prepare($query);

		$parameters = ["imageCompanyId" => $this->imageCompanyId, "imageFileType" => $this ->imageFileType, "imageFileName" => $this->imageFileName];
		$statement->execute($parameters);

		//update the null imageId with what SQL just gave us
		$this->imageId = intval($pdo->lastInsertId());
	}

	/**
	 * deletes this image from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws |PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo) {
		//don't delete an image that hasn't been inserted
		if($this->imageId === null) {
			throw(new \PDOException("unable to delete an image that does not exist"));
		}
		//query template
		$query = "DELETE FROM image WHERE imageId = :imageId";
		$statement =$pdo->prepare($query);

		//bind the member variables to the place holder in the template????
		$parameters = ["imageId" =>$this->imageId];
		$statement->execute($parameters);
	}

	/**
	 *updates the image in mySQL
	 * @param \PDO $pdo PDO connection object
	 * @throws |PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo) {
		//don't update an image that hasn't been inserted
		if($this->imageId === null) {
			throw(new \PDOException("unable to update an image that does not exist"));
		}
		$query = "UPDATE image SET imageCompanyId = :imageCompanyId, imageFileType = :imageFileType, imageFileName =:imageFileName WHERE imageId = :imageId ";
		$statement = $pdo->prepare($query);

		$parameters = ["imageCompanyId" => $this->imageCompanyId, "imageFileType" =>$this->imageFileType, "imageFileName" =>$this->imageFileName];
		$statement->execute($parameters);
	}

	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		//$fields[?no date needed here "tweetDate"] = $this->tweetDate->getTimestamp() 8 1000;
		return($fields);
	}
}
//The end of Image Class