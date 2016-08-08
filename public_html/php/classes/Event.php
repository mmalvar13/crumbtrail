<?php
namespace Edu\Cnm\Crumbtrail; //this is probably not right.

require_once("autoload.php"); //idk

/**
 * What do I explain here? Welcome to the Event class!
 *
 **/
class Event{ //implement JsonSerializable??

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
	 *@param int|null $newEventId id of this Event or null if new Event
	 *@param int $newEventTruckId id of the Truck that is attending this Event
	 *@param \DateTime|string|null $newEventEnd date and time Event is over //do i add "or null if set to current date and time"?
	 *@geography point $newEventLocation gps coordinates of Event //how do i write this? I added @geography again
	 *@param \DateTime|string|null $newEventStart data and time Event starts or null if set to current date and time //i added null here since the date/time would not have been set yet. is this right?
	 *@throws \InvalidArgumentException if data types are not valid
	 *@throws \RangeException if data values are out of bounds (e.g. Strings too long, negative integers)
	 **/

	/**
	 * accessor method for eventId
	 *
	 * @return int|null value of eventId
	 **/
	public function getEventId(){
		return($this->eventId);
	}

	/**
	 * mutator method for eventId
	 * @param int|null $newEventId new value of eventId
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if $newEventId is not a positive
	 * @throws \TypeError if $newEventId is not an integer
	 **/
	public function setEventId(int $newEventId = null){
		//base case: if the eventId is null, this is a new event without a mySQL assigned id yet.
		if ($newEventId === null){
			$this ->eventId = null;
			return;
		}
		//verify that the eventId is positive
		if($newEventId <= 0){
			throw(new \RangeException("event id is not positive"));
		}

		//convert and store the event id
		$this->eventId= $newEventId;
	}

	/**
	 * accessor method for event truck id
	 * @return int value of event truck id
	 **/
	public function getEventTruckId(){
		return($this->eventTruckId);
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
	 *@return \DateTime value of event end
	 **/
	public function getEventEnd(){
		return($this->eventEnd);
	}



	/**
	 * accessor method for event location
	 * @return point value of event location //HOW DO I WRITE OUT THESE POINT DATA TYPES??
	 **/
	public function getEventLocation(){
		return($this->eventLocation);
	}

	/**
	 * accessor method for event Start
	 * @return \DateTime value of event start
	 **/
	public function getEventStart(){
		return($this->eventStart);
	}

	/**
	 * mutator method for event Start
	 * @param \DateTime|string|null $newEventStart eventStart as a DateTime object or string (or null to load the current time)
	 * @throws \InvalidArgumentException if $newEventStart is not a valid object or string
	 * @throws \RangeException if $newEventStart is a date that does not exist
	 **/
	public function setEventStart($newEventStart = null){
		//if the date is null, use the current date and time
		if($newEventStart === null){
			$this->eventStart = new \DateTime();
			return;
		}
		//store the event start
		try{
			$newEventStart = self::validateDateTime($newEventStart); //WHAT?!?!!!!!111
		} catch(\InvalidArgumentException $invalidArgument){
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
 		} catch(\RangeException $range) {
			throw(new \RangeException($range->getMessage(), 0, $range));
		}
		$this->eventStart = $newEventStart;
	}

}