<?php


namespace Edu\Cnm\Mmalvar13\CrumbTrail\Test;  /*LOOK INTO THIS FOR ACCURACY */

use Edu\Cnm\CrumbTrail\Test\CrumbTrailTest;
use Edu\Cnm\Mmalvar13\CrumbTrail\Test\{Profile};

//grab the parameters for the test, go the the abstract test file
require_once("CrumbTrailTest.php");

//grab the class being tested
//so we are jumping a couple (4?) directories to the autoloader which will then load our class.
//wtf is that period for? to concatenate on the file path?
require_once(dirname(__DIR__) . "/public_html/php/classes/autoload.php"); //wtf us going on here?

/**
 * Full PHPUnit test for the Profile class
 *
 * This is a complete PHPUnit test of the Profile class. It is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see Profile\
 * @author Lo-B <baca.loren@gmail.com>
 **/

class ProfileTest extends CrumbTrailTest {

	/*----------------------------Declare Protected State Variables ----------------*/

	/**
	 * Default input data set for name
	 * @var string $VALID_PROFILENAME1     //why is this in all caps, what's up with this syntax?
	 */
	protected $VALID_PROFILENAME1 = "Name";

/**
 * default input data for updated name
 * @var string  $VALID_PROFILENAME2
 */
protected $VALID_PROFILENAME2 = "NameUpdated";





	/**
 * Default input data set for email
 * @var string $VALID_PROFILEEMAIL1
 */
	protected $VALID_PROFILEEMAIL1 = "email.cnm.edu";

	/**
	 * Default input data set for updated email
	 * @var string $VALID_PROFILEEMAIL2
	 */
	protected $VALID_PROFILEEMAIL2 = "emailupdated.cnm.edu";





	/**
	 * Default input data set profile phone 10 chars
	 * @var string $VALID_PROFILEPHONE1
	 */
	protected $VALID_PROFILEPHONE1 = "1111111111";

	/**
	 * Default input data set UPDATED profile phone 10 chars
	 * @var string $VALID_PROFILEPHONE2
	 */
	protected $VALID_PROFILEPHONE2 = "2222222222";




	/**
	 * Default input data set profile access token 64 chars
	 * @var string $VALID_PROFILEACCESSTOKEN1
	 */
	protected $VALID_PROFILEACCESSTOKEN1 = "0000000000000000000000000000000000000000000000000000000000004444";

	/**
	 * Default input data set UPDATED profile access token 64 chars
	 * @var string $VALID_PROFILEACCESSTOKEN2
	 */
	protected $VALID_PROFILEACCESSTOKEN2 = "9999999999999999999999999999999999999999999999999999999999994444";





	/**
	 * Default input data set profile activation token 32 chars
	 * @var string $VALID_PROFILEACTIVATIONTOKEN1
	 */
	protected $VALID_PROFILEACTIVATIONTOKEN1 = "00000000000000000000000000000022";

	/**
	 * Default input data set UPDATED profile activation token 32 chars
	 * @var string $VALID_PROFILEACTIVATIONTOKEN2
	 */
	protected $VALID_PROFILEACTIVATIONTOKEN2 = "99999999999999999999999999999922";





	/**
	 * Default input data set profile type
	 * @var string $VALID_PROFILETYPE1
	 */
	protected $VALID_PROFILETYPE1 = "a";

	/**
	 * Default input data set UPDATED profile type
	 * @var string $VALID_PROFILETYPE2
	 */
	protected $VALID_PROFILETYPE2 = "o";





	/**
	 * Default input data set profile hash 128 chars
	 * @var string $VALID_PROFILEHASH1
	 */
	protected $VALID_PROFILEHASH1 = "00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000088888888";

	/**
	 * Default input data set UPDATED profile hash 128 chars
	 * @var string $VALID_PROFILEHASH2
	 */
	protected $VALID_PROFILEHASH2 = "99999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999988888888";





	/**
 * Default input data set profile salt 64 chars
 * @var string $VALID_PROFILESALT1
 */
	protected $VALID_PROFILESALT1 = "0000000000000000000000000000000000000000000000000000000000004444";

	/**
	 * Default input data set UPDATED profile salt 64 chars
	 * @var string $VALID_PROFILESALT2
	 */
	protected $VALID_PROFILESALT2 = "9999999999999999999999999999999999999999999999999999999999994444";




	//AM I CORRECT IN ASSUMING i DONT NEED ANYTHING FOR THE PRIMARY KEY, AND i DONT HAVE ANY FOREIGN KEYS, SO NOTHING FOR THAT


	/**
	 * create dependent objects before running each test
	 */
	public final function setUp(){
		//run the default abstract setUp() method from parent first
		parent::setUp();

		//create an insert a mock profile to test with

		//what order should I put values into the class call on Profile?? The order that I listed the state variables?
		$this->profile = new Profile(null, "Arya Stark", "Astark@gmail.com", "5051234567", "1111111111222222222233333333334444444444555555555566666666667777", "11111111112222222222333333333344", "a", "11111111112222222222333333333344444444445555555555666666666677771111111111222222222233333333334444444444555555555566666666667777", "1111111111222222222233333333334444444444555555555566666666667777");
		$this->profile->insert($this->getPDO());

		//I shouldnt have to calculate the date since it isnt a part of the profile class correct??

		// calculate the date (just use the time the unit test was setup...)
//		$this->VALID_TWEETDATE = new \DateTime();
		}

		//test inserting a valid profile and verify that what's in mySQL matches what was input
	public function testInsertValidProfile(){
		// count the number of rows....being selected?.....being input? what number of rows?......and save them for later
		$numRows = $this->getConnection()->getRowCount("profile");  // so..get connection to SQL, and get the count of rows for a particular profile??

		//create a new profile and insert it into SQL
		$profile = new Profile(null, $this->profile->getProfileId())

	}
	}




