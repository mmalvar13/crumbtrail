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


}