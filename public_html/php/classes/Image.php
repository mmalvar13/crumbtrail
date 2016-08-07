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
	 * @var int $imageCompanyId;
	 **/
	private $imageCompanyId;
	/**
	 * this is the id that will identify what type of image the company is using. JPG, PNG etc (will add filetypes later).
	 * @var string $imageFileType;
	 */
	private $imageFileType;
	/**
	 * this is the id that informs the user of the name of said image.
	 * @var string $imageFileName;
	 */
	private $imageFileName;

	/**
	 * constructor for this Image
	 *
	 * @param int|null $newImageId id of this Image or null if a new Image
	 * @param int $newImageCompanyId id of the Image that relates to a company
	 * @param string $newImageFileType string containing the file type of an image
	 * @param string $newImageFileName string containing the name of each image
	 * @throws \InvalidArgumentException if the data type is invalid
	 * @throw \InvalidArgumentException if the id is negative
	 * @throw \InvalidArgumentException if the image is not the correct file type
	 * @throw \RangeException if the image name is longer than 255 characters
	 */
// WHAT WOULD I NEED TO DO IF I WANTED TO DEFINE FILE TYPE? //
	public function __construct(int $newImageId = null, int $newImageCompanyId, string $newImageFileType, string $newImageFileName) {
		try {
			$this->setImageId($newImageId);
			$this->setImageCompanyId($newImageCompanyId);
			$this->setImageFileType($newImageFileType);
			$this->setImageFileName($newImageFileName);
		} catch(\InvalidArgumentException $invalidArgument) {
			//rethrows exception to the caller//
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\InvalidArgumentException $invalidArgument) {
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\InvalidArgumentException $invalidArgument) {
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			throw(new \RangeException($range->getMessage(), 0, $range));
		}
	}

	//adding in the accessor method for image.php
	/**
	 * accessor method for image id
	 *
	 * @return int|null value of image id
	 **/
	public function getImageId() {
			return($this->imageId);
	}
//DOES THE EXCEPTIONS DEFINED ABOVE APPLY SPECIFICALLY TO EACH ATTRIBUTE? EX., CAN I ONLY THROW THE INVALID ARGUMENT EXPRESSION FOR IMAGE ID?
	/**
	 * mutator method for image id
	 *
	 * @param int|null $newImageId
	 */

}