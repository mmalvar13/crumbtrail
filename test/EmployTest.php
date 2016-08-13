<?php
namespace Edu\Cnm\CrumbTrail\Test;

use Edu\Cnm\CrumbTrail\{Profile, Company, Employ};

//grab the project test parameters
require_once("CrumbTrailTest.php");

//grab the class under scrutiny
require_once(dirname(__DIR__) . "public_html/php/classes/autoload.php");

/**
 * Full PHPUnit test for the Employ class
 *
 * This is a complete PHPUnit test of the Employ class. It is complete because All mySQL/PDO methods are tested for both invalid and valid inputs
 **/
class EmployTest extends CrumbTrailTest {
	/**
	 * company that is employing this worker; this is a foreign key relation
	 * @var Company company
	 **/
	protected $company = null;

	/**
	 * profile of employee; this is a foreign key relation
	 * @var Profile profile
	 **/
	protected $profile = null;

	/**
	 *create dependent objects before running each test
	 **/
	public final function setUp() {
		//run the default setUp() method first
		parent::setUp();
		//create and insert a Company and Profile to own the test Employ
		$this->company = new Company(null, "Terry's Tacos", "terrytacos@tacos.com", "12345" , "2345", "Terry Jane", "345 Taco Street", "Albuquerque", "NM", "87654", "We are a Taco truck description", "Tacos, Tortillas, Burritos", "5052345678", "1");
		$this->company->insert($this->getPDO());
		$this->profile = new Profile(null, "Loren", "lorenisthebest@gmail.com", "1505", "0000000000000000000000000000000000000000000000000000000000004444", "00000000000000000000000000000022","a", $salt, $hash );
		$this->profile->insert($this->getPDO());

		$password = "abc123";
		$salt = bin2hex(random_bytes(16));
		$hash = hash_pbkdf2("sha512", $password, $salt, 262144);

		//I didn't put a date here. is that ok?n  calculate the date(just use the time the unit test was setup
	}

	/**
	 * test inserting a valid Employ and verify that the actual mySQL data matches
	 * THIS IS WRONG probs
	 **/
	public function testInsertValidEmploy() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("employ");

		//create a new Employ and insert it into mySQL
		$employ = new Employ(null, $this->company->getCompanyId(), $this->profile->getProfileId());
		$employ->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$pdoEmploy = Employ::getEmployByEmployCompanyIdAndEmployProfileId($this->getPDO(), $employ->getEmployCompanyId(), $employ->getEmployProfileId());

		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("employ"));
		$this->assertEquals($pdoEmploy->getEmployCompanyId(), $this->company->getCompanyId());
		$this->assertEquals($pdoEmploy->getEmployProfileId(), $this->profile->getProfileId()); //are these $pdoEmploy->getEmployProfileId or just getProfileId????
	}

	/**
	 * test inserting an Employ that already exists
	 * @expectedException PDOException
	 **/
	public function testInsertInvalidEmploy() {
		//create an Employ with a non null composite key (employProfileId and employCompanyId) and watch it fail
		$employ = new Employ(CrumbTrailTest::INVALID_KEY, $this->company->getCompanyId(), $this->profile->getProfileId());
		$employ->insert($this->getPDO());
	}

	/**
	 * test inserting an Employ, editing it, and then updating it
	 *
	 * //BUT YOU WOULDN'T BECAUSE IT IS JUST A COMPOSITE KEY
	 * //SHOULD I NOT WRITE THIS TEST I GUESS?? idk maybe i will
	 **/

//	/**
//	 *test updating an Employ that already exists
//	 * @expectedException \PDOException
//	 * we wouldn't really do this right? but i will write it anyway. idk, maybe if we are adding multiple companies to a profile we would update it.
//	 **/
//	public function testUpdateInvalidEmploy() {
//		//create an Employ, try to update it without actually updating it and watch it fail
//		$employ = new Employ(null, $this->company->getCompanyId(), $this->profile->getProfileId());
//		$employ->update($this->getPDO());
//	}

	/**
	 * test creating an Employ and then deleting it
	 **/
	public function testDeleteValidEmploy() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("employ");
		//create a new Employ and insert into mySQL
		$employ = new Employ(null, $this->company->getCompanyId(), $this->profile->getProfileId());
		$employ->insert($this->getPDO());

		//delete the Employ from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("employ"));
		$employ->delete($this->getPDO());

		//grab the data from mySQL and enforce the Employ does not exist
		$pdoEmploy = Employ::getEmployByEmployCompanyIdAndEmployProfileId($this->getPDO(), $employ->getEmployCompanyId(), $employ->getEmployProfileId());
//		$pdoEmploy = Employ:: getEmploybyEmployProfileId($this->getPDO(), $employ->getEmployProfileId());
		$this->assertNull($pdoEmploy);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("employ"));
	}

	/**
	 * test deleting an Employ that does not exist
	 * @expectedException \PDOException
	 **/
	public function testDeleteInvalidEmploy() {
		//create an Employ and try to delete it without actually inserting it
		$employ = new Employ(null, $this->company->getCompanyId(), $this->profile->getProfileId());
		$employ->delete($this->getPDO());
	}

	/**
	 * test inserting an Employ and regrabbing it from mySQL
	 * wow idk, is this what i name the test? with both primary keys???
	 **/
	public function testGetValidEmployByEmployCompanyIdAndEmployProfileId() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("employ");

		//create a new Employ and insert into mySQL
		$employ = new Employ(null, $this->company->getCompanyId(), $this->profile->getProfileId());
		$employ->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$pdoEmploy = Employ:: getEmployByEmployCompanyIdAndEmployProfileId($this->getPDO(), $employ->getEmployCompanyId(), $employ->getEmployProfileId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("employ"));
		$this->assertEquals($pdoEmploy->getEmployCompanyId(), $this->company->getCompanyId());
		$this->assertEquals($pdoEmploy->getEmployProfileId(), $this->profile->getProfileId()); //idk getProfileId or getEmployProfileId??
	}

	/**
	 * test grabbing an Employ that does not exist
	 **/
	public function testGetInvalidEmployByEmployCompanyIdAndEmployProfileId() {
		//grab a profile id and company id that exceeds the maximum allowable profile and company id
		$employ = Employ::getEmployByEmployCompanyIdAndEmployProfileId($this->getPDO(), CrumbTrailTest::INVALID_KEY);
		$this->assertNull($employ);
	}

	/**
	 * test grabbing an Employ by the employCompanyId
	 **/
	public function testGetValidEmployByEmployCompanyId() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("employ");

		//create a new Employ and insert it into mySQL
		$employ = new Employ(null, $this->company->getCompanyId(), $this->profile->getProfileId());
		$employ->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$results = Employ::getEmployByEmployCompanyId($this->getPDO(), $employ->getEmployCompanyId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("employ"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Crumbtrail\\Employ", $results);

		//grab the result from the array and validate it
		$pdoEmploy = $results[0];
		$this->assertEquals($pdoEmploy->getCompanyId(), $this->company->getCompanyId());
		$this->assertEquals($pdoEmploy->getProfileId(), $this->profile->getProfileId());
	}

	/**
	 * test grabbing an Employ by companyId that does not exist
	 **/
	public function testGetInvalidEmployByEmployCompanyId() {
		//grab an Employ by searching for companyId that does not exist
		$employ = Employ::getEmployByEmployCompanyId($this->getPDO(), "get outta pueblo");
		$this->assertCount(0, $employ);
	}

	/**
	 * test grabbing an Employ by employProfileId
	 **/
	public function testGetValidEmployByEmployProfileId() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("employ");

		//create a new Employ and insert it into mySQL
		$employ = new Employ(null, $this->company->getCompanyId(), $this->profile->getProfileId());
		$employ->insert($this->getPDO());

		//grab the data from myQL and enforce the fields match our expectations
		$results = Employ::getEmployByEmployProfileId($this->getPDO(), $employ->getEmployProfileId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("employ"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\CrumbTrail\\Employ", $results);

		//grab the result from the array and validate it
		$pdoEmploy = $results[0];
		$this->assertEquals($pdoEmploy->getEmployCompanyId(), $this->company->getCompanyId());
		$this->assertEquals($pdoEmploy->getEmployProfileId(), $this->profile->getProfileId());
	}

	/**
	 * test grabbing an Employ by employProfileId that does not exist
	 **/
	public function testGetInvalidEmployByEmployProfileId(){
		//grab an employ by searching for ocntent that does not exist
		$employ = Employ::getEmployByEmployProfileId($this->getPDO(), "nobody's home");
		$this->assertCount(0, $employ);
	}

	/**
	 * dont need to test for grabbing all employs because we already grab employByEmployProfileIdAndEMplotest grabbing all employs
	 * but idk...maybe we dont...im gonna make one anyway!!
	 *
	 * TEST GRABBING ALL EMPLOYS
	 **/
	public function testGetAllValidEmploys(){
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("employ");

		//create a new Employ and insert into mySQL
		$employ = new Employ(null, $this->company->getCompanyId(), $this->profile->getProfileId());
		$employ->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$results = Employ::getAllEmploys($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("employ"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\CrumbTrail\\Test", $results);

		//grab the result from the array and validate it
		$pdoEmploy = $results[0];
		$this->assertEquals($pdoEmploy->getCompanyId(), $this->company->getCompanyId());
		$this->assertEquals($pdoEmploy->getProfileId(), $this->profile->getProfileId());
	}


}