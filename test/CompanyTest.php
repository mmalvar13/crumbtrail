<?php
namespace Edu\Cnm\CrumbTrail\Test;
require_once("/etc/apache2/capstone-mysql/encrypted-config.php")			// TODO Need this?

use Edu\Cnm\Mmalvar13\CrumbTrail\{Company, Profile};

// grab the project test parameters
require_once("CrumbTrailTest.php");

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/public_html/php/classes/autoload.php");

/**
 * Full PHPUnit test for the Company class
 *
 * This is a complete PHPUnit test of the Company class.
 * It is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see Company
 * @author Kevin Lee Kirk
 *
 **/

class CompanyTest extends CrumbTrailTest {

	// Set the protected parameter values.
	/**
	 * name of the Company
	 * @var string $VALID_COMPANYNAME
	 **/
	protected $VALID_COMPANYNAME = "PHPUnit test passing";

	/**
	 * content of the updated Company
	 * @var string $VALID_COMPANYNAME2
	 **/
	protected $VALID_COMPANYNAME2 = "PHPUnit test still passing";

	// ************

	protected $VALID_COMPANYNAME = "Bob's tacos";
	protected $VALID_COMPANYNAME2 = "Bob's tacos new";

	protected $VALID_COMPANYEMAIL = "bob@bobs.com";
	protected $VALID_COMPANYEMAIL2 = "bobnew@bobs.com";

	protected $VALID_COMPANYPERMIT = "12345";
	protected $VALID_COMPANYPERMIT2 = "67890";

	protected $VALID_COMPANYLICENSE = "2468";
	protected $VALID_COMPANYLICENSE2 = "1012";

	protected $VALID_COMPANYATTN = "Bob Smith";
	protected $VALID_COMPANYATTN2 = "Bob New Smith";

	protected $VALID_COMPANYSTREET1 = "123 Old Street";
	protected $VALID_COMPANYSTREET12 = "123 New Street";

	protected $VALID_COMPANYSTREET2 = "Appt. 1A";
	protected $VALID_COMPANYSTREET22 = "Appt. 2B";

	protected $VALID_COMPANYCITY = "Springfield";
	protected $VALID_COMPANYCITY2 = "New Springfield";

	protected $VALID_COMPANYSTATE = "NM";
	protected $VALID_COMPANYSTATE2 = "CO";

	protected $VALID_COMPANYZIP = "97405";
	protected $VALID_COMPANYZIP2 = "87048";

	protected $VALID_COMPANYDESCRIPTION = "This is a description of a food truck company";
	protected $VALID_COMPANYDESCRIPTION2 = "This is a new description of a food truck company";

	protected $VALID_COMPANYMENUTEXT = "Tacos, burritos, beer";
	protected $VALID_COMPANYMENUTEXT2 = "Ham, cheese, wine";

	protected $VALID_COMPANYACTIVATIONTOKEN = "12345678";
	protected $VALID_COMPANYACTIVATIONTOKEN2 = "23456789";

	protected $VALID_COMPANYAPPROVED = "0";
	protected $VALID_COMPANYAPPROVED2 = "1";














	/**
	 * Create dependent objects before running each test.
	 **/
	public final function setUp() {
		// run the default setUp() method first
		parent::setUp();

		// create and insert a Profile to own the test Company.
		$this->profile = new Profile(null, "@phpunit", "test@phpunit.de", "+12125551212");
		$this->profile->insert($this->getPDO());
	}


	/**
	 * test inserting a valid Company and verify that the actual mySQL data matches.
	 **/
	public function testInsertValidCompany() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("company");

		// create a new Company and insert to into mySQL
		$company = new Company(null, $this->profile->getProfileId(), $this->VALID_COMPANYNAME);
		$company->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoCompany = Company::getCompanyByCompanyId($this->getPDO(), $company->getCompanyId());

		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("company"));
		$this->assertEquals($pdoTweet->getProfileId(), $this->profile->getProfileId());
		$this->assertEquals($pdoTweet->getTweetContent(), $this->VALID_COMPANYNAME);
	}

	/**
	 * test inserting a Tweet that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testInsertInvalidCompany() {
		// create a Company with a non null company id and watch it fail
		$tweet = new Company(DataDesignTest::INVALID_KEY, $this->profile->getProfileId(), $this->VALID_COMPANYNAME);
		$tweet->insert($this->getPDO());
	}

	/**
	 * test inserting a Company, editing it, and then updating it
	 **/
	public function testUpdateValidCompany() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("company");

		// create a new Company and insert to into mySQL
		$company = new Company(null, $this->profile->getProfileId(), $this->VALID_COMPANYNAME);
		$company->insert($this->getPDO());

		// edit the Company and update it in mySQL
		$company->setCompanyName($this->VALID_COMPANYNAME2);
		$company->update($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoTweet = Company::getCompanyByCompanyId($this->getPDO(), $company->getCompanyId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("$company"));
		$this->assertEquals($pdoCompany->getProfileId(), $this->profile->getProfileId());
		$this->assertEquals($pdoCompany->getCompanyName(), $this->VALID_COMPANYNAME2);
	}

	/**
	 * test updating a Company that does not exist
	 *
	 * @expectedException PDOException
	 **/
	public function testUpdateInvalidCompany() {
		// create a Company, try to update it without actually updating it and watch it fail
		$company = new Company(null, $this->profile->getProfileId(), $this->VALID_COMPANYNAME);
		$company->update($this->getPDO());
	}

	/**
	 * test creating a Company and then deleting it
	 **/
	public function testDeleteValidCompany() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("company");

		// create a new Company and insert to into mySQL
		$tweet = new Company(null, $this->profile->getProfileId(), $this->VALID_TWEETCONTENT, $this->VALID_TWEETDATE);
		$tweet->insert($this->getPDO());

		// delete the Company from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("company"));
		$tweet->delete($this->getPDO());

		// grab the data from mySQL and enforce the Company does not exist
		$pdoTweet = Company::getCompanyByCompanyId($this->getPDO(), $company->getCompanyId());
		$this->assertNull($pdoCompany);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("company"));
	}

	/**
	 * test deleting a Company that does not exist
	 *
	 * @expectedException PDOException
	 **/
	public function testDeleteInvalidCompany() {
		// create a Company and try to delete it without actually inserting it
		$tweet = new Company(null, $this->profile->getProfileId(), $this->VALID_TWEETCONTENT);
		$tweet->delete($this->getPDO());
	}

	/**
	 * test grabbing a Company by company name
	 **/
	public function testGetValidCompanyByCompanyName() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("company");

		// create a new Company and insert to into mySQL
		$tweet = new Company(null, $this->profile->getProfileId(), $this->VALID_TWEETCONTENT);
		$tweet->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = Company::getCompanyByCompanyName($this->getPDO(), $company->getCompanyName());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("company"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\MMalvar13\\CrumbTrail\\Company", $results);

		// grab the result from the array and validate it
		$pdoCompany = $results[0];
		$this->assertEquals($pdoCompany->getProfileId(), $this->profile->getProfileId());
		$this->assertEquals($pdoCompany->getCompanyName(), $this->VALID_COMPANYNAME);
	}

	/**
	 * test grabbing a Company by content that does not exist
	 **/
	public function testGetInvalidCompanyByCompanyName() {
		// grab a company by searching for a company name that does not exist
		$tweet = Company::getCompanyByCompanyName($this->getPDO(), "you will find nothing");
		$this->assertCount(0, $company);
	}

	/**
	 * test grabbing all Companies
	 **/
	public function testGetAllValidCompany() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("company");

		// create a new Company and insert to into mySQL
		$tweet = new Company(null, $this->profile->getProfileId(), $this->VALID_COMPANYNAME);
		$tweet->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = Company::getAllCompanys($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("company"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Mmalvar13\\CrumbTrail\\Company", $results);

		// grab the result from the array and validate it
		$pdoCompany= $results[0];
		$this->assertEquals($pdoTweet->getProfileId(), $this->profile->getProfileId());
		$this->assertEquals($pdoTweet->getCompanyName(), $this->VALID_COMPANYNAME);
	}
}