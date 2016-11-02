<?php

namespace Edu\Cnm\CrumbTrail\Test;  /*LOOK INTO THIS FOR ACCURACY */


use Edu\Cnm\CrumbTrail\{
	Profile, Company, ExtraServing
};

//grab the parameters for the test, go the the abstract test file
require_once("CrumbTrailTest.php");

//grab the class being tested
//so we are jumping a couple (4?) directories to the autoloader which will then load our class.
//wtf is that period for? to concatenate on the file path?
require_once(dirname(__DIR__) . "/public_html/php/classes/autoload.php"); //wtf us going on here?

/**
 * Full PHPUnit test for the Extra Serving class
 *
 * This is a complete PHPUnit test of the Extra Serving class. It is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see ExtraServing
 * @author Lo-BAK <baca.loren@gmail.com>
 **/
class ExtraServingTest extends CrumbTrailTest {

	/*----------------------------Declare Protected State Variables ----------------*/

	protected $profile = null;
	protected $company = null;

	/**
	 * Default input data set for extra serving description
	 * @var string $VALID_EXTRASERVINGDESCRIPTION1 //why is this in all caps, what's up with this syntax?
	 */
	protected $VALID_EXTRASERVINGDESCRIPTION1 = "Valid description 1";

	/**
	 * Default input data set for extra serving description
	 * @var string $VALID_EXTRASERVINGDESCRIPTION2
	 */
	protected $VALID_EXTRASERVINGDESCRIPTION2 = "UPDATED Valid description 2";


	/**
	 * timestamp for extraServingEndTime
	 * @var \DateTime $VALID_EXTRASERVINGENDTIME1
	 **/
	protected $VALID_EXTRASERVINGENDTIME1 = null;

	/**
	 * timestamp for extraServingEndTime
	 * @var \DateTime $VALID_EXTRASERVINGENDTIME2
	 **/
	protected $VALID_EXTRASERVINGENDTIME2 = null;


	/**
	 * Default input data set for extra serving location address
	 * @var string $VALID_EXTRASERVINGLOCATIONADDRESS1
	 */
	protected $VALID_EXTRASERVINGLOCATIONADDRESS1 = "1111 serving street dr NE albuquerque NM. 87111";

	/**
	 * Default input data set for extra serving location address
	 * @var string $VALID_EXTRASERVINGLOCATIONADDRESS2
	 */
	protected $VALID_EXTRASERVINGLOCATIONADDRESS2 = "2222 eating drive dr NE albuquerque NM. 87222";


	/**
	 * Default input data set for extra serving location name (name of the event the company is attending)
	 * @var string $VALID_EXTRASERVINGLOCATIONNAME1
	 */
	protected $VALID_EXTRASERVINGLOCATIONNAME1 = " 29th Eating Food Festival";

	/**
	 * Default input data set for extra serving location name (name of the event the company is attending)
	 * @var string $VALID_EXTRASERVINGLOCATIONNAME2
	 */
	protected $VALID_EXTRASERVINGLOCATIONNAME2 = " 30th Eating Food Festival part deu 'double trouble'";


	/**
	 * timestamp for extraServingStartTime
	 * @var \DateTime $VALID_EXTRASERVINGSTARTTIME1
	 **/
	protected $VALID_EXTRASERVINGSTARTTIME1 = null;

	/**
	 * timestamp for extraServingEndTime
	 * @var \DateTime $VALID_EXTRASERVINGSTARTTIME2
	 **/
	protected $VALID_EXTRASERVINGSTARTTIME2 = null;


//	----------------------CREATE DEPENDENT OBJECTS BEFORE TESTING--------------------------------------

	public final function setUp() {

		parent::setUp();

		//create a insert for a dummy company so we have a foreign key to profile
		//create and insert a Profile to own the test Employ
		$password = "abc123";
		$salt = bin2hex(random_bytes(16));
		$hash = hash_pbkdf2("sha512", $password, $salt, 262144);


		$this->profile = new Profile(null, "Loren", "lorenisthebest@gmail.com", "5057303164", "0000000000000000000000000000000000000000000000000000000000004444", "00000000000000000000000000000022", "a", $hash, $salt);
		$this->profile->insert($this->getPDO());

		$pdoProfile = Profile::getProfileByProfileId($this->getPDO(), $this->profile->getProfileId());


		//create and insert a Company to own the test Employ
		$this->company = new Company(null, $pdoProfile->getProfileId(), "Terry's Tacos", "terrytacos@tacos.com", "5052345678", "12345", "2345", "attn: MR taco", "345 Taco Street", "taco street 2", "Albuquerque", "NM", "87654", "We are a Taco truck description", "Tacos, Tortillas, Burritos", "848484", 0);
		$this->company->insert($this->getPDO());

//		$pdoCompany = Company::getCompanyByCompanyId($this->getPDO(), $this->company->getCompanyId());

		//set start time 1 by calling new instance of \DateTime() class, this will be formatted
		$this->VALID_EXTRASERVINGSTARTTIME1 = new \DateTime();
		//make end time 1 a copy of start time 1
		$this->VALID_EXTRASERVINGENDTIME1 = clone $this->VALID_EXTRASERVINGSTARTTIME1;
		//add one additional hour to the time of end time 1
		$this->VALID_EXTRASERVINGENDTIME1->add(new \DateInterval("PT1H"));

		//set start time 2
		$this->VALID_EXTRASERVINGSTARTTIME2 = new \DateTime();
		$this->VALID_EXTRASERVINGENDTIME2 = clone $this->VALID_EXTRASERVINGSTARTTIME2;
		//add 1 hour 30 min to end time 2
		$this->VALID_EXTRASERVINGENDTIME2->add(new \DateInterval("PT1H"));

	}


//	-----------------------------------------TEST SECTION------------------------------------------------------------

	/**
	 * TEST INSERTING A VALID ExtraServing object to SQL
	 */
	public function testInsertValidExtraServing() {
		//get number of rows and save for later....wouldnt it be zero....?
		$numRows = $this->getConnection()->getRowCount("extraServing");

		$extraServing = new ExtraServing(null, $this->company->getCompanyId(), $this->VALID_EXTRASERVINGDESCRIPTION1, $this->VALID_EXTRASERVINGENDTIME1, $this->VALID_EXTRASERVINGLOCATIONADDRESS1, $this->VALID_EXTRASERVINGLOCATIONNAME1, $this->VALID_EXTRASERVINGSTARTTIME1);

		$extraServing->insert($this->getPDO());

		//pull the data out of SQL and ensure its matches what we think it should be

		//$pdoExtraServing will have all the information associated with our extraServing object
		$pdoExtraServing = ExtraServing::getExtraServingByExtraServingId($this->getPDO(), $extraServing->getExtraServingId());

		//assert that there is 1 row in there
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("extraServing"));

		$this->assertEquals($pdoExtraServing->getExtraServingDescription(), $this->VALID_EXTRASERVINGDESCRIPTION1);
		$this->assertEquals($pdoExtraServing->getExtraServingEndTime(), $this->VALID_EXTRASERVINGENDTIME1);
		$this->assertEquals($pdoExtraServing->getExtraServingLocationAddress(), $this->VALID_EXTRASERVINGLOCATIONADDRESS1);
		$this->assertEquals($pdoExtraServing->getExtraServingLocationName(), $this->VALID_EXTRASERVINGLOCATIONNAME1);
		$this->assertEquals($pdoExtraServing->getExtraServingStartTime(), $this->VALID_EXTRASERVINGSTARTTIME1);

	}

	/**
	 * TEST INSERTING AN INVALID ExtraServing Object into SQL
	 * @expectedException \PDOException
	 */
	public function testInsertInvalidExtraServing() {

		//insert a ES with a non-null ID, it should fail
		//use INVALID_KEY in the abstract CrumbTrailTest

		$extraServing = new ExtraServing(CrumbTrailTest::INVALID_KEY, $this->company->getCompanyId(), $this->VALID_EXTRASERVINGDESCRIPTION1, $this->VALID_EXTRASERVINGENDTIME1, $this->VALID_EXTRASERVINGLOCATIONADDRESS1, $this->VALID_EXTRASERVINGLOCATIONNAME1, $this->VALID_EXTRASERVINGSTARTTIME1);

		$extraServing->insert($this->getPDO());

	}


	/**
	 * TEST UPDATING A VALID ExtraServing
	 */
	public function testUpdateValidExtraServing() {

		//get number of rows and save for later....wouldnt it be zero....?
		$numRows = $this->getConnection()->getRowCount("extraServing");

		$extraServing = new ExtraServing(null, $this->company->getCompanyId(), $this->VALID_EXTRASERVINGDESCRIPTION1, $this->VALID_EXTRASERVINGENDTIME1, $this->VALID_EXTRASERVINGLOCATIONADDRESS1, $this->VALID_EXTRASERVINGLOCATIONNAME1, $this->VALID_EXTRASERVINGSTARTTIME1);

		$extraServing->insert($this->getPDO());

		//now edit all the attributes for object

		$extraServing->setExtraServingDescription($this->VALID_EXTRASERVINGDESCRIPTION2);
		$extraServing->setExtraServingEndTime($this->VALID_EXTRASERVINGENDTIME2);
		$extraServing->setExtraServingLocationAddress($this->VALID_EXTRASERVINGLOCATIONADDRESS2);
		$extraServing->setExtraServingLocationName($this->VALID_EXTRASERVINGLOCATIONNAME2);
		$extraServing->setExtraServingStartTime($this->VALID_EXTRASERVINGSTARTTIME2);

		$extraServing->update($this->getPDO());

		$pdoExtraServing = ExtraServing::getExtraServingByExtraServingId($this->getPDO(), $extraServing->getExtraServingId());

		//assert that there is 1 row in there
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("extraServing"));

		$this->assertEquals($pdoExtraServing->getExtraServingDescription(), $this->VALID_EXTRASERVINGDESCRIPTION2);
		$this->assertEquals($pdoExtraServing->getExtraServingEndTime(), $this->VALID_EXTRASERVINGENDTIME2);
		$this->assertEquals($pdoExtraServing->getExtraServingLocationAddress(), $this->VALID_EXTRASERVINGLOCATIONADDRESS2);
		$this->assertEquals($pdoExtraServing->getExtraServingLocationName(), $this->VALID_EXTRASERVINGLOCATIONNAME2);
		$this->assertEquals($pdoExtraServing->getExtraServingStartTime(), $this->VALID_EXTRASERVINGSTARTTIME2);

	}

	/**
	 * TEST UPDATE INVALID extraServing object
	 * @expectedException \PDOException
	 */
	public function testUpdateInvalidExtraServing() {

		$extraServing = new ExtraServing(null, $this->company->getCompanyId(), $this->VALID_EXTRASERVINGDESCRIPTION1, $this->VALID_EXTRASERVINGENDTIME1, $this->VALID_EXTRASERVINGLOCATIONADDRESS1, $this->VALID_EXTRASERVINGLOCATIONNAME1, $this->VALID_EXTRASERVINGSTARTTIME1);

		//try t update without inserting
		$extraServing->update($this->getPDO());
	}


	/**
	 * TEST DELETE VALID extraServing object
	 */
	public function testDeleteValidExtraServing() {
		//get number of rows and save for later....wouldnt it be zero....?
		$numRows = $this->getConnection()->getRowCount("extraServing");

		$extraServing = new ExtraServing(null, $this->company->getCompanyId(), $this->VALID_EXTRASERVINGDESCRIPTION1, $this->VALID_EXTRASERVINGENDTIME1, $this->VALID_EXTRASERVINGLOCATIONADDRESS1, $this->VALID_EXTRASERVINGLOCATIONNAME1, $this->VALID_EXTRASERVINGSTARTTIME1);

		$extraServing->insert($this->getPDO());

		//check to make sure it was inserted A-OK
		//assert that there is 1 row in there
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("extraServing"));

		//now 410 it

		$extraServing->delete($this->getPDO());

		//now check to make sure there is no data in the row
		$pdoExtraServing = ExtraServing::getExtraServingByExtraServingId($this->getPDO(), $extraServing->getExtraServingId());
		$this->assertNull($pdoExtraServing);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("extraServing"));

	}

	/**
	 * TEST DELETE INVALID extraServing object
	 * @expectedException \PDOException
	 */
	public function testDeleteInvalidExtraServing() {

		//create new object
		$extraServing = new ExtraServing(null, $this->company->getCompanyId(), $this->VALID_EXTRASERVINGDESCRIPTION1, $this->VALID_EXTRASERVINGENDTIME1, $this->VALID_EXTRASERVINGLOCATIONADDRESS1, $this->VALID_EXTRASERVINGLOCATIONNAME1, $this->VALID_EXTRASERVINGSTARTTIME1);

		//delete without ever inserting
		$extraServing->delete($this->getPDO());
	}


	/**
	 *test getting extraServing by valid extraServingCompanyId
	 */
	public function testGetExtraServingByValidExtraServingCompanyId(){

		$numRows = $this->getConnection()->getRowCount("extraServing");

		$extraServing = new ExtraServing(null, $this->company->getCompanyId(), $this->VALID_EXTRASERVINGDESCRIPTION1, $this->VALID_EXTRASERVINGENDTIME1, $this->VALID_EXTRASERVINGLOCATIONADDRESS1, $this->VALID_EXTRASERVINGLOCATIONNAME1, $this->VALID_EXTRASERVINGSTARTTIME1);

		$extraServing->insert($this->getPDO());

		//$results will be an array with object info inside it
		//curious why we use $results here instead of just setting $pdoExtraServing to this?
		$results = ExtraServing::getExtraServingByExtraServingCompanyId($this->getPDO(), $extraServing->getExtraServingCompanyId());

		//make sure there is 1 row in there
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("extraServing"));

		//confirm there is just one object in the database
		$this->assertCount(1, $results);

		//ensure there are only instances of the extraServing class in the namespace
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\CrumbTrail\\ExtraServing", $results);

		//grab results from the array and validate them!
		$pdoExtraServing = $results[0];
		$this->assertEquals($pdoExtraServing->getExtraServingCompanyId(), $this->company->getCompanyId());
		$this->assertEquals($pdoExtraServing->getExtraServingDescription(), $this->VALID_EXTRASERVINGDESCRIPTION1);
		$this->assertEquals($pdoExtraServing->getExtraServingEndTime(), $this->VALID_EXTRASERVINGENDTIME1);
		$this->assertEquals($pdoExtraServing->getExtraServingLocationAddress(), $this->VALID_EXTRASERVINGLOCATIONADDRESS1);
		$this->assertEquals($pdoExtraServing->getExtraServingLocationName(), $this->VALID_EXTRASERVINGLOCATIONNAME1);
		$this->assertEquals($pdoExtraServing->getExtraServingStartTime(), $this->VALID_EXTRASERVINGSTARTTIME1);

	}

	/**
	 * test get by invalid company ID
	 * @expectedException \PDOException
	 */
	public function testGetExtraServingByInvalidExtraServingCompanyId(){

		$extraServing = ExtraServing::getExtraServingByExtraServingCompanyId($this->getPDO(), CrumbTrailTest::INVALID_KEY);

		$this->assertCount(0,$extraServing);

	}


	/**
	 * TEST getting extraServing by valid description
	 */
	public function testGetExtraServingByValidDescription() {

		$numRows = $this->getConnection()->getRowCount("extraServing");

		$extraServing = new ExtraServing(null, $this->company->getCompanyId(), $this->VALID_EXTRASERVINGDESCRIPTION1, $this->VALID_EXTRASERVINGENDTIME1, $this->VALID_EXTRASERVINGLOCATIONADDRESS1, $this->VALID_EXTRASERVINGLOCATIONNAME1, $this->VALID_EXTRASERVINGSTARTTIME1);

		$extraServing->insert($this->getPDO());

		//why do we set this to $results? why cant we reference everything from $extraServing, like $extraServing->getExtraServingDescription()????? !!!!Is the whole reason we set it equal to $results so that we can check on line 340 that there is 1 object in the database???

		$results = ExtraServing::getExtraServingByExtraServingDescription($this->getPDO(), $extraServing->getExtraServingDescription());

		//ensure there is now one row
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("extraServing"));

		//confirm there is just one object in SQL
		$this->assertCount(1, $results);

		//ensure there are only instances of the extraServing class in the namespace
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\CrumbTrail\\ExtraServing", $results);

		//grab results from the array and validate them!
		$pdoExtraServing = $results[0];
		$this->assertEquals($pdoExtraServing->getExtraServingCompanyId(), $this->company->getCompanyId());
		$this->assertEquals($pdoExtraServing->getExtraServingDescription(), $this->VALID_EXTRASERVINGDESCRIPTION1);
		$this->assertEquals($pdoExtraServing->getExtraServingEndTime(), $this->VALID_EXTRASERVINGENDTIME1);
		$this->assertEquals($pdoExtraServing->getExtraServingLocationAddress(), $this->VALID_EXTRASERVINGLOCATIONADDRESS1);
		$this->assertEquals($pdoExtraServing->getExtraServingLocationName(), $this->VALID_EXTRASERVINGLOCATIONNAME1);
		$this->assertEquals($pdoExtraServing->getExtraServingStartTime(), $this->VALID_EXTRASERVINGSTARTTIME1);

	}

	/**
	 * test getting extra serving by invalid description
	 * @expectedException \PDOException
	 */
	public function testGetExtraServingByInvalidDescription(){

		//get an extraServing by searching for a description that doesnt exist
		$extraServing = ExtraServing::getExtraServingByExtraServingDescription($this->getPDO(), "THIS DOESNT EXIST");

		$this->assertCount(0,$extraServing );

	}


	/**
	 * test getting an extra serving by both the extraServingId and the extraServingCompanyId
	 *
	 * CHECK ON THIS ONE
	 */
	public function testGetExtraServingByValidExtraServingIdAndExtraServingCompanyId(){

		$numRows = $this->getConnection()->getRowCount("extraServing");

		$extraServing = new ExtraServing(null, $this->company->getCompanyId(), $this->VALID_EXTRASERVINGDESCRIPTION1, $this->VALID_EXTRASERVINGENDTIME1, $this->VALID_EXTRASERVINGLOCATIONADDRESS1, $this->VALID_EXTRASERVINGLOCATIONNAME1, $this->VALID_EXTRASERVINGSTARTTIME1);

		$extraServing->insert($this->getPDO());

		$results = ExtraServing::getExtraServingByExtraServingIdAndExtraServingCompanyId($this->getPDO(), $extraServing->getExtraServingId(), $extraServing->getExtraServingCompanyId());

		//ensure there is now one row
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("extraServing"));

		//confirm there is just one object in SQL
		$this->assertCount(1, $results);

		//ensure there are only instances of the extraServing class in the namespace
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\CrumbTrail\\ExtraServing", $results);

		//grab results from the array and validate them!
		$pdoExtraServing = $results[0];
		$this->assertEquals($pdoExtraServing->getExtraServingCompanyId(), $this->company->getCompanyId());
		$this->assertEquals($pdoExtraServing->getExtraServingDescription(), $this->VALID_EXTRASERVINGDESCRIPTION1);
		$this->assertEquals($pdoExtraServing->getExtraServingEndTime(), $this->VALID_EXTRASERVINGENDTIME1);
		$this->assertEquals($pdoExtraServing->getExtraServingLocationAddress(), $this->VALID_EXTRASERVINGLOCATIONADDRESS1);
		$this->assertEquals($pdoExtraServing->getExtraServingLocationName(), $this->VALID_EXTRASERVINGLOCATIONNAME1);
		$this->assertEquals($pdoExtraServing->getExtraServingStartTime(), $this->VALID_EXTRASERVINGSTARTTIME1);

	}


	/**
	 * test getting extra serving by invalid extraServingId and extraServingCompanyId
	 * @expectedException \PDOException
	 */
	public function testGetExtraServingByInvalidExtraServingIdAndExtraServingCompanyId(){

		//get an extraServing by searching for a ID and foreign key that doesnt exist
		$extraServing = ExtraServing::getExtraServingByExtraServingIdAndExtraServingCompanyId($this->getPDO(), CrumbTrailTest::INVALID_KEY, CrumbTrailTest::INVALID_KEY);

		//Monica used $this->assertNull($event); here and just in this one similar instance? sup wit dat?
		$this->assertCount(0,$extraServing );

	}



	/**
	 * TEST getting extraServing by valid address
	 */
	public function testGetExtraServingByValidExtraServingLocationAddress() {

		$numRows = $this->getConnection()->getRowCount("extraServing");

		$extraServing = new ExtraServing(null, $this->company->getCompanyId(), $this->VALID_EXTRASERVINGDESCRIPTION1, $this->VALID_EXTRASERVINGENDTIME1, $this->VALID_EXTRASERVINGLOCATIONADDRESS1, $this->VALID_EXTRASERVINGLOCATIONNAME1, $this->VALID_EXTRASERVINGSTARTTIME1);

		$extraServing->insert($this->getPDO());

		//why do we set this to $results? why cant we reference everything from $extraServing, like $extraServing->getExtraServingDescription()????? !!!!Is the whole reason we set it equal to $results so that we can check on line 340 that there is 1 object in the database???

		$results = ExtraServing::getExtraServingByExtraServingLocationAddress($this->getPDO(), $extraServing->getExtraServingLocationAddress());

		//ensure there is now one row
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("extraServing"));

		//confirm there is just one object in SQL
		$this->assertCount(1, $results);

		//ensure there are only instances of the extraServing class in the namespace
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\CrumbTrail\\ExtraServing", $results);

		//grab results from the array and validate them!
		$pdoExtraServing = $results[0];
		$this->assertEquals($pdoExtraServing->getExtraServingCompanyId(), $this->company->getCompanyId());
		$this->assertEquals($pdoExtraServing->getExtraServingDescription(), $this->VALID_EXTRASERVINGDESCRIPTION1);
		$this->assertEquals($pdoExtraServing->getExtraServingEndTime(), $this->VALID_EXTRASERVINGENDTIME1);
		$this->assertEquals($pdoExtraServing->getExtraServingLocationAddress(), $this->VALID_EXTRASERVINGLOCATIONADDRESS1);
		$this->assertEquals($pdoExtraServing->getExtraServingLocationName(), $this->VALID_EXTRASERVINGLOCATIONNAME1);
		$this->assertEquals($pdoExtraServing->getExtraServingStartTime(), $this->VALID_EXTRASERVINGSTARTTIME1);

	}

	/**
	 * test getting extra serving by invalid location address
	 * @expectedException \PDOException
	 */
	public function testGetExtraServingByInvalidExtraServingLocationAddress(){

		//get an extraServing by searching for a description that doesnt exist
		$extraServing = ExtraServing::getExtraServingByExtraServingLocationAddress($this->getPDO(), "ADDRESS DONT EXIST");

		$this->assertCount(0,$extraServing );

	}



	/**
	 * TEST getting extraServing by valid Name
	 */
	public function testGetExtraServingByValidExtraServingLocationName() {

		$numRows = $this->getConnection()->getRowCount("extraServing");

		$extraServing = new ExtraServing(null, $this->company->getCompanyId(), $this->VALID_EXTRASERVINGDESCRIPTION1, $this->VALID_EXTRASERVINGENDTIME1, $this->VALID_EXTRASERVINGLOCATIONADDRESS1, $this->VALID_EXTRASERVINGLOCATIONNAME1, $this->VALID_EXTRASERVINGSTARTTIME1);

		$extraServing->insert($this->getPDO());

		//why do we set this to $results? why cant we reference everything from $extraServing, like $extraServing->getExtraServingDescription()????? !!!!Is the whole reason we set it equal to $results so that we can check on line 340 that there is 1 object in the database???

		$results = ExtraServing::getExtraServingByExtraServingLocationName($this->getPDO(), $extraServing->getExtraServingLocationName());

		//ensure there is now one row
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("extraServing"));

		//confirm there is just one object in SQL
		$this->assertCount(1, $results);

		//ensure there are only instances of the extraServing class in the namespace
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\CrumbTrail\\ExtraServing", $results);

		//grab results from the array and validate them!
		$pdoExtraServing = $results[0];
		$this->assertEquals($pdoExtraServing->getExtraServingCompanyId(), $this->company->getCompanyId());
		$this->assertEquals($pdoExtraServing->getExtraServingDescription(), $this->VALID_EXTRASERVINGDESCRIPTION1);
		$this->assertEquals($pdoExtraServing->getExtraServingEndTime(), $this->VALID_EXTRASERVINGENDTIME1);
		$this->assertEquals($pdoExtraServing->getExtraServingLocationAddress(), $this->VALID_EXTRASERVINGLOCATIONADDRESS1);
		$this->assertEquals($pdoExtraServing->getExtraServingLocationName(), $this->VALID_EXTRASERVINGLOCATIONNAME1);
		$this->assertEquals($pdoExtraServing->getExtraServingStartTime(), $this->VALID_EXTRASERVINGSTARTTIME1);

	}

	/**
	 * test getting extra serving by invalid location name
	 * @expectedException \PDOException
	 */
	public function testGetExtraServingByInvalidExtraServingLocationName(){

		//get an extraServing by searching for a description that doesnt exist
		$extraServing = ExtraServing::getExtraServingByExtraServingLocationName($this->getPDO(), "NAME DONT EXIST");

		$this->assertCount(0,$extraServing );

	}



	/**
	 * TEST getting extraServing by end time
	 */
	public function testGetExtraServingByValidExtraServingEndTime() {

		$numRows = $this->getConnection()->getRowCount("extraServing");

		$extraServing = new ExtraServing(null, $this->company->getCompanyId(), $this->VALID_EXTRASERVINGDESCRIPTION1, $this->VALID_EXTRASERVINGENDTIME1, $this->VALID_EXTRASERVINGLOCATIONADDRESS1, $this->VALID_EXTRASERVINGLOCATIONNAME1, $this->VALID_EXTRASERVINGSTARTTIME1);

		$extraServing->insert($this->getPDO());

		//why do we set this to $results? why cant we reference everything from $extraServing, like $extraServing->getExtraServingDescription()????? !!!!Is the whole reason we set it equal to $results so that we can check on line 340 that there is 1 object in the database???

		$results = ExtraServing::getExtraServingByExtraServingEndTime($this->getPDO(), $extraServing->getExtraServingEndTime());

		//ensure there is now one row
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("extraServing"));

		//confirm there is just one object in SQL
		$this->assertCount(1, $results);

		//ensure there are only instances of the extraServing class in the namespace
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\CrumbTrail\\ExtraServing", $results);

		//grab results from the array and validate them!
		$pdoExtraServing = $results[0];
		$this->assertEquals($pdoExtraServing->getExtraServingCompanyId(), $this->company->getCompanyId());
		$this->assertEquals($pdoExtraServing->getExtraServingDescription(), $this->VALID_EXTRASERVINGDESCRIPTION1);
		$this->assertEquals($pdoExtraServing->getExtraServingEndTime(), $this->VALID_EXTRASERVINGENDTIME1);
		$this->assertEquals($pdoExtraServing->getExtraServingLocationAddress(), $this->VALID_EXTRASERVINGLOCATIONADDRESS1);
		$this->assertEquals($pdoExtraServing->getExtraServingLocationName(), $this->VALID_EXTRASERVINGLOCATIONNAME1);
		$this->assertEquals($pdoExtraServing->getExtraServingStartTime(), $this->VALID_EXTRASERVINGSTARTTIME1);

	}









}