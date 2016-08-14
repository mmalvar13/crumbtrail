<?php
namespace Edu\Cnm\CrumbTrail\Test;

use Edu\Cnm\CrumbTrail\{
	Company, Truck
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
	 *Company that the Truck is transferred to; this is a foreign key relationship
	 * @var Company company2
	 **/
	protected $company2 = null;



	/**
	 * create dependent objects before running each test
	 */
	//run the default setUp() method first (creating a face company to house the test truck)
	public final function setUp() {
		//run the default setUp() method first
		parent::setUp();

		//create and insert a company to own the test truck
		$this->company = new Company(null, "Terry's Tacos", "terrytacos@tacos.com", "5052345678", "12345", "2345", "attn: MR Taco", "345 Taco Street", "Taco Street 2", "Albuquerque", "NM", 87654, "We are a Taco truck description", "Tacos, Tortillas, Burritos", 84848409878765432123456789099999, 1, 578123);
		$this->company->insert($this->getPDO());

		//create and insert a second company to buy the test truck (a truck moving to another company)
		$this->company2 = new Company(null, "Truckina's Crepes", "truckina@trucks.com", "5052345666","45678", "4567", "attn: MRS Crepe", "Truckina McTruckerson", "456 Crepe Street", "CrepeStreet2","Albuquerque", "NM", 45678, "We sell crepes", "crepes, ice cream, cakes", 34343409876543212345678998787654, 1, 578234);
		$this->company2->insert($this->getPDO());
	}



	/**
	 * insert valid truck to verify that the actual mySQL data matches
	 **/
	public function testInsertValidTruck() {
		$numRows = $this->getConnection()->getRowCount("truck");

		//create new Truck and insert it into mySQL
		$truck = new Truck(null, $this->company->getCompanyId());
		$truck->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields to match our expectations
		$pdoTruck = Truck::getTruckByTruckId($this->getPDO(), $truck->getTruckId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("truck"));
		$this->assertEquals($pdoTruck->getCompanyId(), $this->company->getCompanyId());
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
		$truck = new Truck(null, $this->company2->getCompanyId());
		$truck->insert($this->getPDO());

		//edit the Truck and update it in mySQL
		//MAYBE???
		$truck->setTruckCompanyId($this->company2);
		$truck->update($this->getPDO());
		//grab the data from mySQL and enforce the fields match our expectations
		//NOT SURE?
		$pdoTruck = Truck::getTruckByTruckId($this->getPDO);
		$truck->getTruckId();
			$this->assertEquals($numRows + 1, $this->getConnection() ->getRowCount("truck"));
			$this->assertEquals($pdoTruck->getCompanyId(), $this->company2->getCompanyId());
	}
	/**
	 * test updating an truck that does not exist
	 *
	 * @expectedException \PDOException
	 **/
	public function testUpdateInValidTruck() {
		//create a Truck, try to update it without actually updating it, watch it fail.
		$truck = new Truck(null, $this->company->getCompanyId());
		$truck->update($this->getPDO());
	}
	/**
	 * test creating a truck and deleting it
	 **/
	public function testDeleteValidTruck() {
		//count the number of rows and save it for later
		$numRows =$this->getConnection()->getRowCount("truck");

		//create new Truck and insert it into mySQL
		$truck = new Truck(null, $this->company->getCompanyId());
		$truck->insert($this->getPDO());

		//delete the truck from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("truck"));
		$this->delete($this->getPDO());

		//grab the data from mySQL and enforce that the Truck does not exist/
		$pdoTruck = Truck::getTruckByTruckId($this->getPDO(),$truck->getTruckId());
		$this->assertNull($pdoTruck);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("truck"));
	}
	/**
	 * test deleting and Truck that does not exist
	 *
	 * @expectedException \PDOException
	 **/
	public function testDeleteInvalidTruck() {
		//create a Truck and try to delete withoug actually inserting it
		$truck = new Truck(null, $this->company->getCompanyId());
		$truck->delete($this->getPDO());
	}
	/**
	 * test grabbing a Truck by truck content?
	 */
	public function testGetValidTruckByTruckContent() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("truck");

		//create a new Truck and insert it into mySQL
		$truck = new Truck(null, $this->company->getCompanyId());
		$truck->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$results = Truck::getTruckByTruckId($this->getPDO(), $truck->getTruckId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("truck"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\CrumbTrail\\Truck", $results);

		//grab the result from the array and validate it
		$pdoTruck = $results[0];
		$this->assertEquals($pdoTruck->getCompanyId(), $this->company->getCompanyId());
	}
	/**
	 * test grabbing a Truck by content that does not exist
	 **/
	public function testGetInvalidTruckByTruckContent() {
		//grab an image by searching for contnet that does not exist?
		$truck = Truck::getTruckByTruckId($this->getPDO(), "No truck information found");
		$this->assertCount(0, $truck);
	}
	/**
	 * test grabbing all trucks
	 **/
	public function testGetAllValidTrucks() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("truck");

		//create a new Image and insert it into mySQL
		$truck = new Truck(null, $this->company->getCompanyId());
		$truck->insert($this->getPDO());
		//grab the data from mySQL and eforce the fields match our expectations
		$results = Truck::getAllTrucks($this->getPDO());
		$this->assertEquals($numRows +1, $this->getConnection()->getRowCount("truck"));
		$this->assertCount(1, $results);
		$this->assertContainOnlyInstancesOf("Edu\\Cnm\\CrumbTrail\\Truck", $results);

		//grab the result from the array and validate it
		$pdoTruck = $results[0];
		$this->assertEquals($pdoTruck->getCompanyId(), $this->company->getCompanyId());
		}
	}
	//This is the end of the Truck unit test, trial one//