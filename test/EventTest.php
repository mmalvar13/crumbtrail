<?php
namespace Edu\Cnm\CrumbTrail\Test;

use Edu\Cnm\CrumbTrail\{Company, Point, Profile, Truck, Event}; //is this what i put here??

//grab the project test parameters
require_once("CrumbTrailTest.php");

//grab the class under scrutiny
require_once(dirname(__DIR__) . "/public_html/php/classes/autoload.php");

/**
 * Full PHPUnit test for the Event class
 *
 * all mySQL/PDO enabled methods are tested for both invalid and valid inputs in this test
 * @see Event
 * @author Monica Alvarez //do i put this??
 **/

class EventTest extends CrumbTrailTest{
	//adding this to test dummy profile
	protected $company = null;

	//adding this to test
	protected $profile = null;
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
	 * @var Point $VALID_EVENTLOCATION
	 **/
	protected $VALID_EVENTLOCATION = null; //i had this null first-IT WAS RIIIIGHTT!!lol

	/**
	 * create dependent objects before running each test
	 **/
	public final function setUp() {
		//this is mega wrong, i can feel it.
		//run the default setUp() method first
		parent::setUp();

		//create a insert for a dummy company so we have a foreign key to profile
	//create and insert a Profile to own the test Employ
		$password = "abc123";
		$salt = bin2hex(random_bytes(16));
		$hash = hash_pbkdf2("sha512", $password, $salt, 262144);


		$this->profile = new Profile(null, "Loren", "lorenisthebest@gmail.com", "5057303164", "0000000000000000000000000000000000000000000000000000000000004444", "00000000000000000000000000000022","a", $hash, $salt);
		$this->profile->insert($this->getPDO());

		$pdoProfile = Profile::getProfileByProfileId($this->getPDO(), $this->profile->getProfileId());


		//create and insert a Company to own the test Employ
		$this->company = new Company(null, $pdoProfile->getProfileId(), "Terry's Tacos", "terrytacos@tacos.com", "5052345678", "12345", "2345", "attn: MR taco", "345 Taco Street", "taco street 2", "Albuquerque", "NM", "87654", "We are a Taco truck description", "Tacos, Tortillas, Burritos","848484", 0);
		$this->company->insert($this->getPDO());

		$pdoCompany = Company::getCompanyByCompanyId($this->getPDO(), $this->company->getCompanyId());


		$this->truck = new Truck(null, $pdoCompany->getCompanyId()); //do i need to customize any of this?
		$this->truck->insert($this->getPDO());

		//calculate the date this event starts (just use the time the unit was setup
//		$date = new \DateTime('2000-01-01');
//		$date->add(new \DateInterval('P1H'));
		$this->VALID_EVENTSTART = new \DateTime();
		$this->VALID_EVENTEND = clone $this->VALID_EVENTSTART;
		$this->VALID_EVENTEND->add(new \DateInterval('PT1H'));
		$this->VALID_EVENTEND2= clone $this->VALID_EVENTSTART;
		$this->VALID_EVENTEND2->add(new \DateInterval('PT1H30M'));

		$this->VALID_EVENTLOCATION = new Point (31.8643553, -112.857099);
//datetimeadd
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
		$pdoEvent = Event::getEventByEventId($this->getPDO(), $event->getEventId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("event"));
		$this->assertEquals($pdoEvent->getEventTruckId(),$this->truck->getTruckId());
		$this->assertEquals($pdoEvent->getEventEnd(),$this->VALID_EVENTEND);
		$this->assertEquals($pdoEvent->getEventLocation(), $this->VALID_EVENTLOCATION);
		$this->assertEquals($pdoEvent->getEventStart(), $this->VALID_EVENTSTART);
	}

	/**
	 * test inserting an Event that already exists
	 * @expectedException \PDOException
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
		$pdoEvent = Event::getEventByEventId($this->getPDO(), $event->getEventId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("event"));
		$this->assertEquals($pdoEvent->getEventTruckId(), $this->truck->getTruckId());
		$this->assertEquals($pdoEvent->getEventEnd(), $this->VALID_EVENTEND2);
		$this->assertEquals($pdoEvent->getEventLocation(), $this->VALID_EVENTLOCATION);
		$this->assertEquals($pdoEvent->getEventStart(), $this->VALID_EVENTSTART);
	}

	/**
	 * test updating an Event that already exists
	 * @expectedException /PDOException //why do some of them have exceptions in the doc blocks and some dont??
	 * //so this is basically saying you're going to update something without changing anything?? like already having your end time at 3 and then "updating" it to end at 3?
	 */
	public function testUpdateInvalidEvent(){
		//create an Event, try to update it without actually updating it and watch it fail
		$event = new Event(null, $this->truck->getTruckId(), $this->VALID_EVENTEND, $this->VALID_EVENTLOCATION, $this->VALID_EVENTSTART);
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
		$pdoEvent = Event:: getEventByEventId($this->getPDO(), $event->getEventId());
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
		//this is where you would insert it but you DONT because you're a noob! <-- lol
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
		$pdoEvent = Event::getEventByEventId($this->getPDO(), $event->getEventId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("event"));
		$this->assertEquals($pdoEvent->getEventTruckId(),$this->truck->getTruckId());
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
//* test grabbing an Event by EventTruckId
//**/
	public function testGetValidEventByEventTruckId(){
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("event");

		//create a new Event and insert into mySQL
		$event = new Event(null, $this->truck->getTruckId(), $this->VALID_EVENTEND, $this->VALID_EVENTLOCATION, $this->VALID_EVENTSTART);
		$event->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$results = Event::getEventByEventTruckId($this->getPDO(),$event->getEventTruckId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("event"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\CrumbTrail\\Event", $results);

		//grab the result from the array and validate it
		$pdoEvent = $results[0];
		$this->assertEquals($pdoEvent->getEventTruckId(), $this->truck->getTruckId());
		$this->assertEquals($pdoEvent->getEventEnd(), $this->VALID_EVENTEND);
		$this->assertEquals($pdoEvent->getEventLocation(), $this->VALID_EVENTLOCATION);
		$this->assertEquals($pdoEvent->getEventStart(), $this->VALID_EVENTSTART);
	}

	/**
	 * test grabbing an Event by EventTruckId that does not exist
	 **/
	public function testGetInvalidEventByEventTruckId(){
		//grab an event by searching for content that does not exist
		$event = Event::getEventByEventTruckId($this->getPDO(), CrumbTrailTest::INVALID_KEY);
		$this->assertCount(0, $event);
	}


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
		$results = Event::getEventByEventLocation($this->getPDO(),$event->getEventLocation());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("event"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\CrumbTrail\\Event", $results);

		//grab the result from the array and validate it
		$pdoEvent = $results[0];
		$this->assertEquals($pdoEvent->getTruckId(), $this->truck->getTruckId());
		$this->assertEquals($pdoEvent->getEventEnd(), $this->VALID_EVENTEND);
		$this->assertEquals($pdoEvent->getEventLocation(), $this->VALID_EVENTLOCATION);
		$this->assertEquals($pdoEvent->getEventStart(), $this->VALID_EVENTSTART);
	}

	/**
	 * test grabbing an Event by Event Location that does not exist
	 **/
	public function testGetInvalidEventByEventLocation(){
		//grab an event by searching for event location that does not exist
		$event = Event:: getEventByEventLocation($this->getPDO(), $this->VALID_EVENTLOCATION);
		$this->assertCount(0, $event);
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
		$results = Event::getEventByEventIdAndEventTruckId($this->getPDO(), $event->getEventId(), $event->getEventTruckId()); //is this right? i put both event id and event truck id here.
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("event"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\CrumbTrail\\Event", $results);

		//grab the result from the array and validate it
		$pdoEvent = $results[0];
		$this->assertEquals($pdoEvent->getTruckId(), $this->truck->getTruckId());
		$this->assertEquals($pdoEvent->getEventEnd(), $this->VALID_EVENTEND);
		$this->assertEquals($pdoEvent->getEventLocation(), $this->VALID_EVENTLOCATION);
		$this->assertEquals($pdoEvent->getEventStart(), $this->VALID_EVENTSTART);
	}

	/**
	 * Test grabbing an Event by and Event Id and Event Truck Id that don't exist
	 * @expectedException \PDOException
	 **/
	public function testGetInvalidEventByEventIdAndEventTruckId(){
		//grab an event by searching for event id that does not exist
		$event = Event::getEventByEventIdAndEventTruckId($this->getPDO(), CrumbTrailTest::INVALID_KEY, CrumbTrailTest::INVALID_KEY);
		$this->assertCount(0, $event); //says parameter $eventTruckId is missing. do i separate these? or does this have to do with Truck class namespace problems?
	}

	/**
	 * test grabbing an Event by EventEnd and EventStart
	 **/
	public function testGetValidEventByEventEndAndEventStart(){
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("event");
		//create an new Event and insert it into mySQL
		$event = new Event(null, $this->truck->getTruckId(), $this->VALID_EVENTEND, $this->VALID_EVENTLOCATION, $this->VALID_EVENTSTART);
		$event->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$results = Event::getEventByEventEndAndEventStart($this->getPDO());//its NOW() in event class
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("event"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\CrumbTrail\\Event", $results);

		//grab the result from the array and validate it
		$pdoEvent = $results[0];
		$this->assertEquals($pdoEvent->getTruckId(), $this->truck->getTruckId());
		$this->assertEquals($pdoEvent->getEventEnd(), $this->VALID_EVENTEND);
		$this->assertEquals($pdoEvent->getEventLocation(), $this->VALID_EVENTLOCATION);
		$this->assertEquals($pdoEvent->getEventStart(), $this->VALID_EVENTSTART);
	}

	/**
	 * test grabbing an Event with an EventStart and EventEnd that do not exist
	 **/
	public function testGetInvalidEventByEventEndAndEventStart(){
		//grab an event by searching for eventStart and eventEnd that do not exist
		$event = Event::getEventByEventEndAndEventStart($this->getPDO()); //this should have no parameters. it is set to NOW() in the Event class
		$this->assertCount(0, $event);
	}

	/**
	 * test grabbing all Events
	 **/
	public function testGetAllValidEvents(){
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("event");

		//create a new Event and insert it into mySQL
		$event = new Event(null, $this->truck->getTruckId(), $this->VALID_EVENTEND, $this->VALID_EVENTLOCATION, $this->VALID_EVENTSTART);
		$event->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$results = Event::getAllEvents($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("event"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\CrumbTrail\\Event", $results);

		//grab the result from the array and validate it
		$pdoEvent = $results[0];
		$this->assertEquals($pdoEvent->getTruckId(), $this->truck->getTruckId());
		$this->assertEquals($pdoEvent->getEventEnd(), $this->VALID_EVENTEND);
		$this->assertEquals($pdoEvent->getEventLocation(), $this->VALID_EVENTLOCATION);
		$this->assertEquals($pdoEvent->getEventStart(), $this->VALID_EVENTSTART);
	}
}

