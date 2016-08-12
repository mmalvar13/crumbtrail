<?php
namespace Edu\Cnm\Mmalvar13\CrumbTrail\Test;

use Edu\Cnm\CrumbTrail\{
	Test\CrumbTrailTest, Truck, Event
}; //is this what i put here??

//grab the project test parameters
require_once("CrumbTrailTest.php");

//grab the class under scrutiny
require_once(dirname(__DIR__) . "public_html/php/classes/autoload.php");

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
	 * DO WE NEED THIS???
	 * timestamp of updated end of this event;
	 *@var \DateTime $VALID_EVENTEND
	 */
	protected $VALID_EVENTEND2 = null;

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
		//date time class has an add method.
		//calculate the date this event ends?? do i?? i have no idea. what is this for??
	}

	/**
	 * test inserting a valid Event and verify that the actual mySQL data matches
	 **/
	public function testInsertValidEvent(){
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("event");

		//create a new Event and insert into mySQL
		$event = new Event(null, $this->truck->getTruckId(), $this->VALID_EVENTEND, $this->VALID_EVENTLOCATION,$this->VALID_EVENTSTART); //getTruckId or getEventTruckId??
		$event->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$pdoEvent = Event::getEventbyEventId($this->getPDO(), $event->getEventId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("event"));
		$this->assertEquals($pdoEvent->getTruckId(),$this->truck->getTruckId());
		$this->assertEquals($pdoEvent->getEventEnd(),$this->VALID_EVENTEND);
		$this->assertEquals($pdoEvent->getEventLocation(), $this->VALID_EVENTLOCATION);
		$this->assertEquals($pdoEvent->getEventStart(), $this->VALID_EVENTSTART);
	}

	/**
	 * test inserting an Event that already exists
	 * @expectedException PDOException
	 **/
	public function testInsertInvalidEvent(){
		//create an Event with a non null event id and watch it fail
		$event = new Event(CrumbTrailTest::INVALID_KEY, $this->truck->getTruckId(), $this->VALID_EVENTEND, $this->VALID_EVENTLOCATION, $this->VALID_EVENTSTART); //again, is truck the right thing to reference here? or should it say getEventTruckId
		$event->insert($this->getPDO());
	}

	/**
	 * test inserting an Event, editing it, and then updating it
	 *
	 * Here, what can we update? in the tweet example it gave tweet content as being updated. for our event is there anything we can actually update? i guess we can update the event end, by stopping it before. but updating the event location and the event start would just create new events. right?
	 **/
	public function testUpdateValidEvent(){
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("event");

		//create a new Event and insert it into mySQL
		$event = new Event(null, $this->truck->getTruckId(), $this->VALID_EVENTEND, $this->VALID_EVENTLOCATION, $this->VALID_EVENTSTART); //is null supposed to represent the primary key here?
		$event->insert($this->getPDO());

		//edit the Event and update it in mySQL
		$event->setEventEnd($this->VALID_EVENTEND2);
		$event->update($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$pdoEvent = Event::getEventbyEventId($this->getPDO(), $event->getEventId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("event"));
		$this->assertEquals($pdoEvent->getTruckId(), $this->truck->getTruckId());
		$this->assertEquals($pdoEvent->getEventEnd(), $this->VALID_EVENTEND2);
		$this->assertEquals($pdoEvent->getEventLocation(), $this->VALID_EVENTLOCATION);
		$this->assertEquals($pdoEvent->getEventStart(), $this->VALID_EVENTSTART);
	}

	/**
	 * test updating an Event that already exists
	 * @expectedException PDOException //why do some of them have exceptions in the doc blocks and some dont??
	 * //so this is basically saying you're going to update something without changing anything?? like already having your end time at 3 and then "updating" it to end at 3?
	 */
	public function testUpdateInvalidEvent(){
		//create an Event, try to update it without actually updating it and watch it fail
		$event = new Event(null, $this->truck->getTruckId(), $this->VALIDEVENTEND, $this->VALID_EVENTLOCATION, $this->VALID_EVENTSTART);
		$event->update($this->getPDO());
	}

	/**
	 * test creating an Event and then deleting it
	 *
	 **/
	public function testDeleteValidEvent(){
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("event");
		//create a new Event and insert it into mySQL
		$event = new Event(null, $this->truck->getTruckId(), $this->VALID_EVENTEND, $this->VALID_EVENTLOCATION, $this->VALID_EVENTSTART);
		$event->insert($this->getPDO());

		//deletes the Event from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("event"));
		$event->delete($this->getPDO());

		//grab the data from mySQL and enforce the Event does not exist
		$pdoEvent = Event:: getEventbyEventId($this->getPDO(), $event->getEventId());
		$this->assertNull($pdoEvent);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("event"));
	}

	/**
	 * test deleting an Event that does not exist
	 * @expectedException \PDOException
	 **/
	public function testDeleteInvalidEvent(){
		//create an Event and try to delete it without actually inserting it
		$event = new Event(null, $this->truck->getTruckId(), $this->VALID_EVENTEND, $this->VALID_EVENTLOCATION, $this->VALID_EVENTSTART);
		//this is where you would insert it but you DONT because you're a noob!
		$event->delete($this->getPDO());
	}

	/**
	 * Test inserting an Event and regrabbing it from mySQL
	 **/
	public function testGetValidEventByEventId(){
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("event");
		//create a new Event and insert it into mySQL
		$event = new Event(null, $this->truck->getTruckId(), $this->VALID_EVENTEND, $this->VALID_EVENTLOCATION, $this->VALID_EVENTSTART);
		$event->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$pdoEvent = Event::getEventbyEventId($this->getPDO(), $event->getEventId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("event"));
		$this->assertEquals($pdoEvent->getTruckId(),$this->truck->getTruckId());
		$this->assertEquals($pdoEvent->getEventEnd(),$this->VALID_EVENTEND);
		$this->assertEquals($pdoEvent->getEventLocation(), $this->VALID_EVENTLOCATION);
		$this->assertEquals($pdoEvent->getEventStart(), $this->VALID_EVENTSTART);
	}

	/**
	 * Test grabbing an Event that does not exist
	 **/
	public function testGetInvalidEventByEventId() {
		//grab a truck id that exceeds the maximum allowable truck id
		$event = Event::getEventByEventId($this->getPDO(), CrumbTrailTest::INVALID_KEY);
		$this->assertNull($event);
	}

//**
//* do i do a test for get event by event truck id? it is a foreign key.
//**/

	/**
	 * test grabbing an Event by Event Location
	 */
	public function testGetValidEventByEventLocation(){
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("event");

		//create a new Event and insert into mySQL
		$event = new Event(null, $this->truck->getTruckId(), $this->VALID_EVENTEND, $this->VALID_EVENTLOCATION, $this->VALID_EVENTSTART);
		$event->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$results = Event::getEventbyEventLocation($this->getPDO(),$event->getEventLocation());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("event"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Mmalvar13\\CrumbTrail\\Event", $results);

		//grab the result from the array and validate it
		$pdoEvent = $results[0];
		$this->assertEquals($pdoEvent->getTruckId(), $this->truck->getTruckId());
		$this->assertEquals($pdoEvent->getEventEnd, $this->VALID_EVENTEND);
		$this->assertEquals($pdoEvent->getEventLocation, $this->VALID_EVENTLOCATION);
		$this->assertEquals($pdoEvent->getEventStart, $this->VALID_EVENTSTART);
	}

	/**
	 * test grabbing an Event by Event Id and Event Truck Id
	 **/
	public function testGetValidEventByEventIdAndEventTruckId(){
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("event");

		//create a new Event and insert into mySQL
		$event = new Event(null, $this->truck->getTruckId(), $this->VALID_EVENTEND, $this->VALID_EVENTLOCATION, $this->VALID_EVENTSTART);
		$event->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$results = Event::getEventbyEventIdAndEventTruckId($this->getPDO(), $event->getEventId(), $event->getEventTruckId()); //is this right? i put both event id and event truck id here.
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("event"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Mmalvar13\\CrumbTrail\\Event", $results);

		//grab the result from the array and validate it
		$pdoEvent = $results[0];
		$this->assertEquals($pdoEvent->getTruckId(), $this->truck->getTruckId());
		$this->assertEquals($pdoEvent->getEventEnd(), $this->VALID_EVENTEND);
		$this->assertEquals($pdoEvent->getEventLocation(), $this->VALID_EVENTLOCATION);
		$this->assertEquals($pdoEvent->getEventStart(), $this->VALID_EVENTSTART);
	}



}

