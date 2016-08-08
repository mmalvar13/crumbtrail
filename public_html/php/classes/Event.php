<?php
namespace Edu\Cnm\Crumbtrail; //this is probably not right.

require_once("autoload.php"); //idk

/**
 * What do I explain here? Welcome to the Event class!
 *
 **/
class Event { //implement JsonSerializable??
	use ValidateDate; //do i?
	/**
	 * id for this event; this is the primary key
	 * @var int $eventId
	 **/
	private $eventId;
	/**
	 * id of the Truck that attended this event; this is a foreign key
	 * @var int $eventId
	 **/
	private $eventTruckId;
	/**
	 * end time for this event
	 * @var \DateTime $eventEnd
	 */
	private $eventEnd;
	/**
	 * gps point location for this event
	 * @geography point $eventLocation //is this right??
	 */
	private $eventLocation;
	/**
	 * start time for this event
	 * @var \DateTime $eventStart
	 **/
	private $eventStart;


	/**
	 *constructor for this Event
	 *
	 * @param int|null $newEventId id of this Event or null if new Event
	 * @param int $newEventTruckId id of the Truck that is attending this Event
	 * @param \DateTime|string $newEventEnd date and time Event is over //do i add "or null if set to current date and time"?
	 * @geography point $newEventLocation gps coordinates of Event //how do i write this? I added @geography again
	 * @param \DateTime|string|null $newEventStart data and time Event starts or null if set to current date and time //i added null here since the date/time would not have been set yet. is this right?
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g. Strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 **/
	public function __construct(int $newEventId = null, int $newEventTruckId, \DateTime $newEventEnd, point $newEventLocation, \DateTime $newEventStart = null) {
		try {
			$this->setEventId($newEventId);
			$this->setEventTruckId($newEventTruckId);
			$this->setEventEnd($newEventEnd);
			$this->setEventLocation($newEventLocation);
			$this->setEventStart($newEventStart);
		} catch(\InvalidArgumentException $invalidArgument) {
			//rethrow the exception to the caller
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			//rethrow the exception to the caller
			throw(new \RangeException($range->getMessage(), 0, $range));
		} catch(\TypeError $typeError) {
			//rethrow the exception to the caller
			throw(new \TypeError($typeError->getMessage(), 0, $typeError));
		} catch(\Exception $exception) {
			//rethrow the exception to the caller
			throw(new \Exception($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for eventId
	 *
	 * @return int|null value of eventId
	 **/
	public function getEventId() {
		return ($this->eventId);
	}

	/**
	 * mutator method for eventId
	 * @param int|null $newEventId new value of eventId
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if $newEventId is not a positive
	 * @throws \TypeError if $newEventId is not an integer
	 **/
	public function setEventId(int $newEventId = null) {
		//base case: if the eventId is null, this is a new event without a mySQL assigned id yet.
		if($newEventId === null) {
			$this->eventId = null;
			return;
		}
		//verify that the eventId is positive
		if($newEventId <= 0) {
			throw(new \RangeException("event id is not positive"));
		}

		//convert and store the event id
		$this->eventId = $newEventId;
	}


	/**
	 * accessor method for event truck id
	 * @return int value of event truck id
	 **/
	public function getEventTruckId() {
		return ($this->eventTruckId);
	}

	/**
	 * mutator method for eventTruckId
	 * @param int $newEventTruckId new value of eventTruckId
	 * @throws \RangeException if $newEventTruckId is not positive
	 * @throws \TypeError  if $newEventTruckId is not an integer
	 **/
	public function setEventTruckId(int $newEventTruckId) {
		//verify that the $newEventTruckId is positive
		if($newEventTruckId <= 0) {
			throw(new \RangeException("the event truck id is not positive"));
		}
		//convert and store event truck id
		$this->eventTruckId = $newEventTruckId;
	}


	/**
	 *accessor method for event end
	 * @return \DateTime value of event end
	 **/
	public function getEventEnd() {
		return ($this->eventEnd);
	}

	/**
	 * mutator method for event end
	 * @param \DateTime|string $newEventEnd date and time set for event to end
	 * @throws \InvalidArgumentException if $newEventEnd is null
	 * @throws \RangeException if $newEventEnd is greater than the eventStart datetime
	 **/
	public function setEventEnd() {
		if($newEventEnd = null) {
			throw(new \InvalidArgumentException("Must enter the time length of the event"));
		}
		if($newEventEnd < $this->eventStart){
			throw(new \RangeException("Start time cannot be greater than end time")); //is this correct??
		}
		try {
			$newEventEnd = self::ValidateDateTime($newEventEnd);
		} catch(\InvalidArgumentException $invalidArgument) {
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			throw(new \RangeException($range->getMessage(), 0, $range));
		}
		$this->eventEnd = $newEventEnd;
	}


	/**
	 * accessor method for event location
	 * @return point value of event location //HOW DO I WRITE OUT THESE POINT DATA TYPES??
	 **/
	public function getEventLocation(){
		return($this->eventLocation);
	}

	/**
	 * mutator method for event location
	 * @param \point $newEventLocation new gps point location of event //WHAT IS THIS?
	 * @throws \ //I HAVE NO IDEA
	 **/



	/**
	 * accessor method for event Start
	 * @return \DateTime value of event start
	 **/
	public function getEventStart(){
		return($this->eventStart);
	}

	/**
	 * mutator method for event Start
	 * @param \DateTime|string|null $newEventStart eventStart as a DateTime object or string. A null value loads the current time.
	 * @throws \Exception if $newEventStart is not null
	 **/
	public function setEventStart($newEventStart = null) {
		//if the date is null, use the current date and time
		if($newEventStart === null) {
			$this->eventStart = new \DateTime(); //store the eventStart date and time
			return;
		} else {
			// Throw exception
			throw(new \Exception("the start time is not null"));
		}
	}


}