<?php
namespace Edu\Cnm\CrumbTrail\Test;

use Edu\Cnm\CrumbTrail\{Company, Profile, Image};

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
	 * create dependent objects before running each test
	 **/
	//run the default setUp() method first (creating a fake company to house the test image)
	public final function setUp() {
		//run the default setUp() method first
		parent::setUp();

		//create and insert a company to own the test image
		$this->company = new Company(null, 578123, "Terry's Tacos", "terrytacos@tacos.com", "5052345678", "12345", "2345", "attn: MR Taco", "345 Taco Street", "Taco Street 2", "Albuquerque", "NM", 87654, "We are a Taco truck description", "Tacos, Tortillas, Burritos", 84848409878765432123456789099999, 1);
		$this->company->insert($this->getPDO());


		//create and insert a Profile to own the test image
		$this->profile = new Profile(null, "Victoria C", "victorious-design.com", "5057303164", "0000000000000000000000000000000000000000000000000000000000004444", "00000000000000000000000000000022","a","12345678909876545432123456789098" , "11223344556677889900009988776655443322111122334455667788990000998877665544332211112233445566778899000099887766554433221112345678");
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
	 * @expectedException \PDOException
	 **/

	public function testInsertInvalidImage() {
		//create an image with a non null image id and it will fail
		$image = new Image(CrumbTrailTest::INVALID_KEY, $this->company->getCompanyId(), $this->VALID_IMAGEFILENAME, $this->VALID_IMAGEFILETYPE);
		$image->insert($this->getPDO());
	}
	/**
	 * test inserting an Image, editing it, and then updating it
	 **/
	public function  testUpdateValidImage() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("image");

		// create a new Image and insert into mySQL
		$image = new Image(null, $this->company->getCompanyId(),$this->VALID_IMAGEFILENAME, $this->VALID_IMAGEFILETYPE);
		$image->insert($this->getPDO());

		//edit the Image and update it in mySQL
		$image->setImageFileName($this->VALID_IMAGEFILENAME2);
		$image->setImageFileType($this->VALID_IMAGEFILETYPE2);
		// now set this up to update
		$image->update($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$pdoImage = Image::getImageByImageId($this->getPDO(), $image->getImageId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("tweet"));
		$this->assertEquals($pdoImage->getCompanyId(), $this->company->getCompanyId());
		$this->assertEquals($pdoImage->getImageFileName(), $this->VALID_IMAGEFILENAME2);
		$this->assertEquals($pdoImage->getImageFileType(), $this->VALID_IMAGEFILETYPE2);
	}
	/**
	 * test updating and image that does not exist
	 *
	 * @expectedException \PDOException
	 **/
	public function testUpdateInvalidImage() {
		// create an Image, try to update it without actually updating it, watch if fail.
		$image = new Image(null, $this->company->getCompanyId(), $this->VALID_IMAGEFILENAME,$this->VALID_IMAGEFILETYPE);
		$image->update($this->getPDO());
	}
	/**
	 * test creating an image and deleting it
	 */
	public function testDeleteValidImage() {
		//count the number of rows and save it for later
		$numRows =$this->getConnection()->getRowCount("Image");

		//create new Image and insert into mySQL
		$image = new Image(null, $this->company->getCompanyId(),$this->VALID_IMAGEFILENAME, $this->VALID_IMAGEFILETYPE);
		$image->insert($this->getPDO());

		//delete the image from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("image"));
		$this->delete($this->getPDO());

		//grab the data from mySQL and enforce that the Image does not exist.
		$pdoImage = Image::getImageByImageId($this->getPDO(), $image->getImageId());
		$this->assertNull($pdoImage);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("image"));
	}
	/**
	 * test deleting an Image that does not exist
	 *
	 * @expectedException \PDOException
	 **/
	public function testDeleteInvalidImage() {
		//create an Image and try to delete it without actually inserting it
		$image = new Image(null, $this->company->getCompanyId(), $this->VALID_IMAGEFILENAME, $this->VALID_IMAGEFILETYPE);
		$image->delete($this->getPDO());
	}
	/**
	 * test grabbing an Image by image content
	 **/
	public function testGetValidImageByImageContent() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("image");

		//create a new Image and insert it into mySQL
		$image = new Image(null, $this->company->getCompanyId(), $this->VALID_IMAGEFILENAME, $this->VALID_IMAGEFILETYPE);
		$image->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match out expectations
		$results = Image::getImageByImageFileName($this->getPDO(), $image->getImageFileName());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("image"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\CrumbTrail\\Image", $results);

		//grab the result from teh array and validate it
		$pdoImage = $results[0];
		$this->assertEquals($pdoImage->getCompanyId(), $this->company->getCompanyId());
		$this->assertEquals($pdoImage->getImageFileName(), $this->VALID_IMAGEFILENAME);
		$this->assertEquals($pdoImage->getImageFileType(), $this->VALID_IMAGEFILETYPE);
	}
	/**
	 * test grabbing an Image by content that does not exist
	 **/
	public function testGetInvalidImageByImageContent() {
	//grab an image by searching for content that does not exist
		//this is a test!! (keep getting thrown out of the database
		$image = Image::getImageByImageContent($this->getPDO(), "You will find nothing");
		$this->assertCount(0, $image);

	}
	/**
	 * test grabbing all Images
	 */
	public function testGetAllValidImages() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("image");

		// create a new Image and insert to mySQL
		$image = new Image(null, $this->company->getCompanyId(), $this->VALID_IMAGEFILENAME, $this->VALID_IMAGEFILETYPE);
		$image->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$results = Image::getAllImages($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("image"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\CrumbTrail\\Image", $results);

		//grab the result from the array and validate it
		$pdoImage = $results[0];
		$this->assertEquals($pdoImage->getCompanyId(), $this->company->getCompanyId());
		$this->assertEquals($pdoImage->getImageFileName(), $this->VALID_IMAGEFILENAME);
		$this->assertEquals($pdoImage->getImageFileType(), $this->VALID_IMAGEFILETYPE);
	}

}

//This is the end of the Image unit test, trial one//