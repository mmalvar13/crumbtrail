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
	 * Default input data set for a string 1
	 * @var string $VALID_STRING1     //why is this in all caps, what's up with this syntax?
	 */
	protected $VALID_STRING1 = "A man needs a name...";

/**
 * default input data for a string 2
 * @var string  $VALID_STRING2
 */
protected $VALID_STRING2 = "A girl has no name";

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

	}
	}




