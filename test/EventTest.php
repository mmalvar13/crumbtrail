<?php
namespace Edu\Cnm\CrumbTrail\Test;

use Edu\Cnm\Crumbtrail\Event;
use Edu\Cnm\mmalvar13\CrumbTrail\{Truck, //Event}; //is this what i put here??

//grab the project test parameters
require_once("CrumbTrailTest.php");

//grab the class under scrutiny
require_once(dirname(__DIR__) . "/php/classes/autoload.php");

/**
 * Full PHPUnit test for the Event class
 *
 * all mySQL/PDO enabled methods are tested for both invalid and valid inputs in this test
 * @see Event
 * @author Monica Alvarez //do i put this??
 **/

class EventTest extends CrumbTrailTest{
	/**
	 * Truck that is attending this Event; this is a foreign key relation
	 * @var Truck truck //this is referring to the truck class
	 **/

	protected $truck = null;

	/**
	 *timestamp of the end of this Event; this one does not start all null...right? or does it stsart at null for the sake of the test??
	 * @var \DateTime $VALID_EVENTEND
	 **/
	protected $VALID_EVENTEND = null;

	/**
	 * timestamp of the start of this Event; this starts as null and is assigned later
	 * @var \DateTime $VALID_EVENTSTART
	 **/
	protected $VALID_EVENTSTART = null;

	/**
	 * point location of the location of this Event
	 * @var float $VALID_EVENTLOCATION
	 **/
	protected $VALID_EVENTLOCATION = null;

	/**
	 * create dependent objects before running each test
	 **/
	public final function setUp() {
		//this is mega wrong, i can feel it.
		//run the default setUp() method first
		parent::setUp();
		//create and insert a (truck or company?) to own the test event. I'm going to try truck.
		$this->truck = new Truck(null, "@phpunit", "test@phpunit.de", "+12125551212"); //do i need to customize any of this?
		$this->truck->insert($this->getPDO());

		//calculate the date this event starts (just use the time the unit was setup
		$this->VALID_EVENTSTART = new \DateTime();
		//calculate the date this event ends?? do i?? i have no idea. what is this for??
	}

	/**
	 * test inserting a valid Event and verify that the actual mySQL data matches
	 **/
	public function testInsertValidEvent(){
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("event");

		//create a new Event and insert into mySQL
		$event = new Event(null, $this->truck->getTruckId(), $this->VALID_EVENTEND, $this->VALID_EVENTLOCATION,$this->VALID_EVENTSTART);
		$event->insert($this->getPDO());
	}

	/**
	 * test inserting an Event that already exists
	 * @expectedException PDOException
	 **/
	public function testInsertInvalidEvent(){
		//create an Event with a non null event id and watch it fail
		$event = new Event(CrumbTrailTest::INVALID_KEY, $this->truck->getTruckId(), $this->VALID_EVENTEND, $this->VALID_EVENTLOCATION, $this->VALID_EVENTSTART);
		$event->insert($this->getPDO());
	}

	/**
	 * test inserting an Event, editing it, and then updating it
	 **/
	public function testUpdateValidEvent(){
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("event");

		//create a new Event and insert it into mySQL
		$event = new Event(null, $this->truck->getTruckId(), $this->VALID_EVENTEND, $this->VALID_EVENTLOCATION, $this->VALID_EVENTSTART);
		$event->insert($this->getPDO());

		//edit the Event and update it in mySQL
		$event->setEve
	}

}
}

