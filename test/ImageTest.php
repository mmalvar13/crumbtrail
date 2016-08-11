<?php
namespace Edu\Cnm\Crumbtrail\Test;

use Edu\Cnm\Crumbtrail\{Image, Company};
//why is company greyed out?

//grab the project test parameters
require_once("CrumbTrailTest.php");

//grab the class under scrutiny
require_once(dirname(__DIR__) . "/public_html/php/classes/autoload.php");

/**
 * Unit test for the image class 
 * 
 * All mySQL/PDO enabled methods tested for valid and invalid inputs.
 * 
 * @see Image
 * @author Victoria Chacon <victoriousdesignco@gmail.com>
 */
class ImageTest extends CrumbTrailTest {
	//setting up made up variables to test
	/**
	 * content of the image file type
	 * @var string $VALID_IMAGEFILETYPE
	 **/
	protected $VALID_IMAGEFILETYPE = ".jpg";
	/**
	 * content of the updated image?
	 * @var string $VALID_IMAGEFILETYPE
	 **/
	protected $VALID_IMAGEFILETYPE2 = ".jpeg";
	/**
	 * content of the image file name
	 * @var string $VALID_FILENAME
	 **/
	protected $VALID_IMAGEFILENAME = "TheAwesomeCuisineOrder";
	/**
	 * content for the updated image file name
	 * @var string $VALID_FILENAME
	 **/
	protected $VALID_IMAGEFILENAME2 = "SomeAwesomeUnderstatedCuisineEatery";
	/**
	 * Company that the Image belongs to; this is a foreign key relationship
	 * @var Company company
	 **/
	protected $company = null;
	/**
	/**
	 * create dependent objects before running each test
	 **/
	//run the default setUp() method first (creating a fake company to house the test image)
	public final function setUp() {
		//run the default setUp() method first
		parent::setUp();

		//create and insert a Company to own the test image
		$this->company= new Company(null, "Terry's Tacos", "terrytacos@tacos.com", "12345", "2345", "Terry Jane", "345 Taco Street", "Albuquerque", "NM", "87654");//"We are a Taco truck description", "Tacos, Tortillas, Burritos" "5052345678","1");
		$this->company->insert($this->getPDO());
	}
	/**
	 * insert valid image and verify that the actual mySQL data matches
	 **/ 
	public function testInsertValidImage() {
		$numRows = $this->getConnection()->getRowCount("image");

		//create a new Image and insert it into mySQL
		$image = new Image(null, $this->company->getCompanyId, $this->VALID_IMAGEFILENAME, $this->VALID_IMAGEFILETYPE);
		$image->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields to match our expectations
		$pdoImage = Image::getImageByImageId($this->getPDO(), $image->getImageId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("image"));
		$this->assertEquals($pdoImage->getImageId(), $this->company->getCompanyId());
		$this->assertEquals($pdoImage->getImageFileName(), $this->VALID_IMAGEFILENAME);
		$this->assertEquals($pdoImage->getImageFileType(), $this->VALID_IMAGEFILETYPE);
	}
	/**
	 * test inserting an Image that already exists
	 *
	 * @expectedException PDOException
	 **/

	public function testInsertInvalidImage() {
		//create an image with a non null image id and it will fail
		$image = new Image(CrumbTrailTest::INVALID_KEY, $this->company->getCompanyId(), $this->VALID_IMAGEFILENAME);
		$image->insert($this->getPDO());
	}
	/**
	 * test inserting an Image, editing it, and then updating it
	 **/
	public function  testUpdateValidImage() {

	}
}
