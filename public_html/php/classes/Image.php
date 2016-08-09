<?php

//namespace?
//namespace //

//autoload?//
//require_once("autoload.php");//

//Begin Docblock//

/**
 * Image that a company will provide
 *
 * This image will be what the company uses to identify themselves to the user. In future goals we are hoping to use this in order to give the companies a gallery to work with.
 *
 * @author Victoria Chacon <victoriousdesignco@gmail.com>
 **/
//what does version apply to in the tweet example? is it necessary here?//
class Image {
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
	 * this is the id that will identify what type of image the company is using. JPG, PNG etc (will add filetypes later).
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
	 * @throws RangeException
	 * @throws InvalidArgumentException
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

	/** accessor method for image file type
	 *
	 * @return string value of imageFileType
	 */
	public function getImageFileType() {
		return $this->imageFileType;
	}

	/**
	 * mutator for image file type
	 *
	 * @param string $newImageFileType new value of image file type
	 * @throw \InvalidArgumentException if $newImageFileType is not a string
	 * @throw \RangeException if $newImageFileType > 10 characters
	 */
	public function setImageFileType(string $newImageFileType) {
		$validFileType = ["image/jpeg", "image/png"];
		$newImageFileType = strtolower($newImageFileType);
		if(in_array($newImageFileType, $validFileType) === false) {
			throw(new \InvalidArgumentException("This is not the proper image type. Please insert jpeg, or png"));
		}
		//convert and store
		$this->imageFileType = $newImageFileType;
	}

	/**
	 * accessor for the image file name
	 *
	 * @return string value for imageFileName
	 **/
	public function getImageFileName() {
		return $this->imageFileName;
	}

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
	// start the PDO section here
	/**
	 * inserts this image into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws |PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo) {
		//enforcer image id...essentially...don't put in an image that already exists.
		if($this->imageId !==null) {
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
}
	
