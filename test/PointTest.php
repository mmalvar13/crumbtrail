<?php
namespace Edu\Cnm\Mmalvar13\CrumbTrail\Test;

use Edu\Cnm\CrumbTrail\{Point};

// Require the project test parameters.
require_once("CrumbTrailTest.php");

// Require the class being tested.
require_once(dirname(__DIR__) . "/public_html/php/classes/autoload.php");


/**
 * PHPUnit test for the Point class
 *
 * @see Point
 * @author Kevin Lee Kirk
 *
 **/

class PointTest extends CrumbTrailTest {

	// Set the protected parameter values.
	/**
	 * latitude for this point
	 * @var float $pointLatitude
	 **/
	protected $VALID_POINTLATITUDE;

	/**
	 * longitude for this  point
	 * @var float $pointLongitude
	 **/
	protected $VALID_POINTLONGITUDE;










	/**
	 * Test inserting a valid Point into the mySQL database,
	 * then check if the data in the database is equal to the
	 * data that you put into the database.
	 **/
	public function testInsertValidPoint() {
		// Count the number of rows and save it for later.
		$numRows = $this->getConnection()->getRowCount("point");


		// Create a new Point and insert to into mySQL.
		$point = new Point(null, $this->VALID_POINTLATITUDE, $this->VALID_POINTLONGITUDE);

		$point->insert($this->getPDO());


		// Grab the data from mySQL and enforce the fields match our expectations
		// 						TODO But the Point class does not even have a PointId. ?????????
		$pdoPoint = Point::getPointByPointId($this->getPDO(), $company->getCompanyId());

		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("company"));

		$this->assertEquals($pdoPoint->getPointId(), $this->point->getPointId());
		$this->assertEquals($pdoPoint->getPointLatitude(), $this->point->getPointLatitude());
		$this->assertEquals($pdoPoint->getPointLongitude(), $this->point->getPointLongitude());
	}





















	/**
	 * Test inserting a Point that already exists.
	 * Create a Point with a non-null company id and watch it fail.
	 * The INVALID_KEY is too large to be a valid mySQL id.
	 * @expectedException PDOException
	 **/
	public function testInsertInvalidCompany() {
		$company = new Company(CrumbTrailTest::INVALID_KEY, $this->VALID_COMPANYNAME, $this->VALID_COMPANYEMAIL, $this->VALID_COMPANYPERMIT, $this->VALID_COMPANYLICENSE, $this->VALID_COMPANYATTN, $this->VALID_COMPANYSTREET1, $this->VALID_COMPANYSTREET2, $this->VALID_COMPANYCITY, $this->VALID_COMPANYSTATE, $this->VALID_COMPANYZIP, $this->VALID_COMPANYDESCRIPTION, $this->VALID_COMPANYMENUTEXT, $this->VALID_COMPANYACTIVATIONTOKEN, $this->VALID_COMPANYAPPROVED, $this->profile->getProfileId());

		$company>insert($this->getPDO());
	}


	/**
	 * Test inserting a Company, editing it, and then updating it.
	 **/
	public function testUpdateValidCompany() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("company");

		// Create a new Company and insert to into mySQL.
		$company = new Company(null, $this->VALID_COMPANYNAME, $this->VALID_COMPANYEMAIL, $this->VALID_COMPANYPERMIT, $this->VALID_COMPANYLICENSE, $this->VALID_COMPANYATTN, $this->VALID_COMPANYSTREET1, $this->VALID_COMPANYSTREET2, $this->VALID_COMPANYCITY, $this->VALID_COMPANYSTATE, $this->VALID_COMPANYZIP, $this->VALID_COMPANYDESCRIPTION, $this->VALID_COMPANYMENUTEXT, $this->VALID_COMPANYACTIVATIONTOKEN, $this->VALID_COMPANYAPPROVED, $this->profile->getProfileId());

		$company->insert($this->getPDO());

		// Edit the Company and update it in mySQL.
		$company->setCompanyName($this->VALID_COMPANYNAME2);
		$company->setCompanyEmail($this->VALID_COMPANYEMAIL2);
		$company->setCompanyPermit($this->VALID_COMPANYPERMIT2);
		$company->setCompanyLicense($this->VALID_COMPANYLICENSE2);
		$company->setCompanyAttn($this->VALID_COMPANYATTN2);
		$company->setCompanyStreet1($this->VALID_COMPANYSTREET12);
		$company->setCompanyStreet2($this->VALID_COMPANYSTREET22);
		$company->setCompanyCity($this->VALID_COMPANYCITY2);
		$company->setCompanyState($this->VALID_COMPANYSTATE2);
		$company->setCompanyZip($this->VALID_COMPANYZIP2);
		$company->setCompanyDescription($this->VALID_COMPANYDESCRIPTION2);
		$company->setCompanyMenuText($this->VALID_COMPANYMENUTEXT2);
		$company->setCompanyActivationToken($this->VALID_COMPANYACTIVATIONTOKEN2);
		$company->setCompanyApproved($this->VALID_COMPANYAPPROVED2);

		$company->update($this->getPDO());

		// Grab the data from mySQL and check that the fields match our (updated) expectations.
		$pdoCompany = Company::getCompanyByCompanyId($this->getPDO(), $company->getCompanyId());

		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("$company"));

		$this->assertEquals($pdoCompany->getCompanyName(), $this->VALID_COMPANYNAME2);
		$this->assertEquals($pdoCompany->getCompanyEmail(), $this->VALID_COMPANYEMAIL2());
		$this->assertEquals($pdoCompany->getCompanyPermit(), $this->VALID_COMPANYPERMIT2());
		$this->assertEquals($pdoCompany->getCompanyLicense(), $this->VALID_COMPANYLICENSE2());
		$this->assertEquals($pdoCompany->getCompanyAttn(), $this->VALID_COMPANYATTN2());
		$this->assertEquals($pdoCompany->getCompanyStreet1(), $this->VALID_COMPANYSTREET12());
		$this->assertEquals($pdoCompany->getCompanyStreet2(), $this->VALID_COMPANYSTREET22());
		$this->assertEquals($pdoCompany->getCompanyCity(), $this->VALID_COMPANYCITY2());
		$this->assertEquals($pdoCompany->getCompanyState(), $this->VALID_COMPANYSTATE2());
		$this->assertEquals($pdoCompany->getCompanyZip(), $this->VALID_COMPANYZIP2());
		$this->assertEquals($pdoCompany->getCompanyDescription(), $this->VALID_COMPANYDESCRIPTION2());
		$this->assertEquals($pdoCompany->getCompanyMenuText(), $this->VALID_COMPANYMENUTEXT2());
		$this->assertEquals($pdoCompany->getCompanyActivationToken(), $this->VALID_COMPANYACTIVATIONTOKEN2());
		$this->assertEquals($pdoCompany->getCompanyApproved(), $this->VALID_COMPANYAPPROVED2());
	}

	/**
	 * Test updating a Company that does not exist.
	 *
	 * Create a Company, try to update it (without actually updating it), and watch it fail.
	 * @expectedException PDOException
	 **/
	public function testUpdateInvalidCompany() {
		$company = new Company(null, $this->VALID_COMPANYNAME, $this->VALID_COMPANYEMAIL, $this->VALID_COMPANYPERMIT, $this->VALID_COMPANYLICENSE, $this->VALID_COMPANYATTN, $this->VALID_COMPANYSTREET1, $this->VALID_COMPANYSTREET2, $this->VALID_COMPANYCITY, $this->VALID_COMPANYSTATE, $this->VALID_COMPANYZIP, $this->VALID_COMPANYDESCRIPTION, $this->VALID_COMPANYMENUTEXT, $this->VALID_COMPANYACTIVATIONTOKEN, $this->VALID_COMPANYAPPROVED, $this->profile->getProfileId());

		$company->update($this->getPDO());
	}

	/**
	 * Test creating a Company and then deleting it.
	 **/
	public function testDeleteValidCompany() {
		// Count the number of rows and save it for later.
		$numRows = $this->getConnection()->getRowCount("company");

		// Create a new Company and insert to into mySQL.
		$company = new Company(null, $this->VALID_COMPANYNAME, $this->VALID_COMPANYEMAIL, $this->VALID_COMPANYPERMIT, $this->VALID_COMPANYLICENSE, $this->VALID_COMPANYATTN, $this->VALID_COMPANYSTREET1, $this->VALID_COMPANYSTREET2, $this->VALID_COMPANYCITY, $this->VALID_COMPANYSTATE, $this->VALID_COMPANYZIP, $this->VALID_COMPANYDESCRIPTION, $this->VALID_COMPANYMENUTEXT, $this->VALID_COMPANYACTIVATIONTOKEN, $this->VALID_COMPANYAPPROVED, $this->profile->getProfileId());

		$company->insert($this->getPDO());

		// Delete the Company from mySQL.
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("company"));
		$company->delete($this->getPDO());

		// Get the data from mySQL and enforce the Company does not exist.
		$pdoCompany = Company::getCompanyByCompanyId($this->getPDO(), $company->getCompanyId());
		$this->assertNull($pdoCompany);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("company"));
	}


	/**
	 * Test deleting a Company that does not exist.
	 *
	 * @expectedException PDOException
	 **/
	public function testDeleteInvalidCompany() {
		// Create a Company, and try to delete it, without actually inserting it.
		$company = new Company(null, $this->VALID_COMPANYNAME, $this->VALID_COMPANYEMAIL, $this->VALID_COMPANYPERMIT, $this->VALID_COMPANYLICENSE, $this->VALID_COMPANYATTN, $this->VALID_COMPANYSTREET1, $this->VALID_COMPANYSTREET2, $this->VALID_COMPANYCITY, $this->VALID_COMPANYSTATE, $this->VALID_COMPANYZIP, $this->VALID_COMPANYDESCRIPTION, $this->VALID_COMPANYMENUTEXT, $this->VALID_COMPANYACTIVATIONTOKEN, $this->VALID_COMPANYAPPROVED, $this->profile->getProfileId());

		$company->delete($this->getPDO());
	}

}