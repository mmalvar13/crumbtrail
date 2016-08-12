<?php
namespace Edu\Cnm\Mmalvar13\CrumbTrail\Test;

use Edu\Cnm\CrumbTrail\{
	Company, Profile, Employ, Test\CrumbTrailTest
};

//grab the project test parameters
require_once("CrumbTrailTest.php");

//grab the class under scrutiny
require_once(dirname(__DIR__) . "public_html/php/classes/autoload.php");

/**
 * Full PHPUnit test for the Employ class
 *
 * This is a complete PHPUnit test of the Employ class. It is complete because All mySQL/PDO methods are tested for both invalid and valid inputs
 **/
class Employ extends CrumbTrailTest{
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
	public final function setUp(){
		//run the default setUp() method first
		parent::setUp();
		//create and insert a Company and Profile to own the test Employ
		$this->company = new Company(null, "@phpunit", "test@phpunit.de", "+12125551212");
		$this->company->insert($this->getPDO());
		$this->profile = new Profile(null, "@phpunit", "test@phpunit.de", "+12125551212");
		$this->profile->insert($this->getPDO()); //should i add it twice like this? or within the same statement

		//calculate the date(just use the time the unit test was setup)
		$this->VALID_EMPLOYDATE = new \DateTime(); //i just made this up. i dont know what to do with thiss oone.
	}

	/**
	 * tst inserting a valid Employ and verify that the actual mySQL data matches
	 * THIS IS WRONG HELP MEEEEEE!
	 **/
	public function testInsertValidEmploy(){
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("employ");

		//create a new Employ and insert it into mySQL
		$employ = new Employ(null, $this->company->getCompanyId(), $this->profile->getProfileId());
		$employ->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$pdoEmploy = Employ::getEmploybyEmployCompanyId()->$this->company->getCompanyId(); //how do i write this for a composite key?
		$pdoEmploy = Employ::getEmploybyEmployProfileId()->$this->profile->getProfileId();

		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("employ"));
		$this->assertEquals($pdoEmploy->getCompanyId(), $this->company->getCompanyId());
		$this->assertEquals($pdoEmploy->getProfileId(), $this->profile->getProfileId());
	}

	/**
	 * test inserting an Employ that already exists
	 * @expectedException PDOException
	 **/
	public function testInsertInvalidEmploy(){
		//create an Employ with a non null composite key (employProfileId and employCompanyId) and watch it fail
		$employ = new Employ(CrumbTrailTest::INVALID_KEY, $this->company->getCompanyId(), $this->profile->getProfileId());
		$employ->insert($this->getPDO());
	}

}