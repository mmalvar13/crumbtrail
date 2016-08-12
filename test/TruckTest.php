<?php
namespace Edu\Cnm\Mmalvar13\CrumbTrail\Test;

use Edu\Cnm\CrumbTrail\{
	Test\CrumbTrailTest, Truck, Company
};

//grab the project test parameters
require_once("CrumbTrailTest.php");

//grab the class under scrutiny
require_once(dirname(__DIR__) . "/public_html/php/classes/autoload.php");

/**
 * Unite test for the truck class
 *
 * All mySQL/PDO enabled methods tested for valid and invalid inputs
 *
 * @see Truck
 * @author Victoria Chacon <victoriousdesignco@gmail.com>
 **/
class TruckTest extends CrumbTrailTest {
	//setting up made up variables to test
	/**
	 *Company that the Truck belongs to; this is a foreign key relationship
	 * @var Company company
	 **/
	protected $company = null;
	/**
	 * create dependent objects before running each test
	 */
	//run the default setUp() method first (creating a face company to house the test truck)
	public final function setUp() {
		//run the default setUp() method first
		parent::setUp();

		//create and insert a company to own the test truck
		$this->company= new Company(null, "Terry's Tacos", "terrytacos@tacos.com", "12345", "2345", "Terry Jane", "345 Taco Street", "Albuquerque", "NM", "87654", "We are a Taco truck description", "Tacos, Tortillas, Burritos", "5052345678","1");
		$this->company->insert($this->getPDO());
	}
	/**
	 * insert valid truck to verify that the actual mySQL data matches
	 **/
	public function testInsertValidTruck() {
		$numRows = $this->getConnection()->getRowCount("image");

		//create new Truck and insert it into mySQL
		$truck = new Truck(null, $this->company->getCompanyId);
		$truck->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields to match our expectations
		$pdoTruck = Truck::getTruckbyTruckId($this->getPDO(), $truck->getTruckId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("truck"));
		$this->assertEquals($pdoTruck->getTruckId(), $this->company->getCompanyId());
	}
	/**
	 *test inserting a truck that already exists
	 *
	 * @expectedException \PDOException
	 **/

	public function testInsertInvalidTruck() {
		//create a truck with a non null truck id. It will fail.
		$truck = new Truck(CrumbTrailTest::INVALID_KEY, $this->company->getCompanyId());
		$truck->insert($this->getPDO());
	}
	/**
	 * test inserting an Truck, editing it, and then updating it
	 **/
	public function testUpdateValidTruck() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("truck");

		//create a new Truck and insert into mySQL
		$truck = new Truck(null, $this->company->getCompanyId());
		$truck->insert($this->getPDO());

		//edit the Truck and update it in mySQL


	}
	}