<?php
namespace Edu\Cnm\Crumbtrail\Test;

use Edu\Cnm\Crumbtrail\{Image};

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
	protected $VALID_IMAGEFILETYPE1 = ".jpg";
	/**
	 * content of the updated image?
	 * @var string $VALID_IMAGEFILETYPE
	 **/
	protected $VALID_IMAGEFILETYPE2 = ".jpeg";
	/**
	 * content of the image file name
	 * @var string $VALID_FILENAME
	 **/
	protected $VALID_IMAGEFILENAME1 = "TheAwesomeCuisineOrder";
	/**
	 * content for the updated image file name
	 * @var string $VALID_FILENAME
	 **/
	protected $VALID_IMAGEFILENAME2 = "SomeAwesomeUnderstatedCuisineEatery";
	/**
	 * create dependent objects before running each test
	 **/
}