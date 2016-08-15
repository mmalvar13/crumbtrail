<?php
namespace Edu\Cnm\CrumbTrail;

require_once("autoload.php");

/**
 * Welcome to the Event class! You are about to have a most splendid time.
 *
 **/
class Event implements \JsonSerializable { //implement JsonSerializable??
	use ValidateDate;
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
	 * @var float $eventLocation
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
	 * @param \DateTime|string $newEventEnd date and time Event is over
	 * @param float $newEventLocation gps coordinates of Event
	 * @param \DateTime|string|null $newEventStart data and time Event starts or null if set to current date and time //i added null here since the date/time would not have been set yet. is this right?
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g. Strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 **/
	public function __construct(int $newEventId = null, int $newEventTruckId, \DateTime $newEventEnd, float $newEventLocation, \DateTime $newEventStart) {
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
	public function setEventEnd(\DateTime $newEventEnd) {
		if($newEventEnd === null) {
			throw(new \InvalidArgumentException("Must enter the time length of the event"));
		}
		if($newEventEnd <= $this->eventStart) {
			throw(new \RangeException("Start time cannot be greater than end time"));
		}
		try {
			$newEventEnd = self::validateDateTime($newEventEnd);
		} catch(\InvalidArgumentException $invalidArgument) {
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			throw(new \RangeException($range->getMessage(), 0, $range));
		}
		$this->eventEnd = $newEventEnd;
	}


	/**
	 * accessor method for event location
	 * @return float value of event location
	 **/
	public function getEventLocation() {
		return ($this->eventLocation);
	}

	/**
	 * mutator method for event location
	 * @param float $newEventLocation new gps point location of event
	 * @throws \\should i throw any exceptions here?
	 **/

	public function setEventLocation(float $newEventLocation){
		$this->eventLocation = $newEventLocation; //should i throw any exceptions for this?
	}


	/**
	 * accessor method for event Start
	 * @return \DateTime value of event start
	 **/
	public function getEventStart() {
		return ($this->eventStart);
	}

	/**
	 * mutator method for event Start
	 * @param \DateTime|string|null $newEventStart eventStart as a DateTime object or string. A null value loads the current time.
	 * @throws \InvalidArgumentException
	 * @throws \Exception if $newEventStart is not null
	 **/
	public function setEventStart(\DateTime $newEventStart) {
		//if the date is null, use the current date and time
		if($newEventStart === null) {
			$this->eventStart = new \DateTime(); //store the eventStart date and time
			return;
//		} else {
//			// Throw exception
//			throw(new \Exception("the start time is not null"));
		}
		//store the eventStart date
		try {
			$newEventStart = self::validateDateTime($newEventStart);
		} catch(\InvalidArgumentException $invalidArgument) {
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			throw(new \RangeException($range->getMessage(), 0, $range));
		}
		$this->eventStart = $newEventStart;
	}

	/**
	 * Inserts this Event into mySQL
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo) {
		//enforce the eventId is null(i.e. don't insert an event that already exists)
		if($this->eventId !== null) {
			throw(new \PDOException("not a new event"));
		}
		//create query template
		$query = "INSERT INTO event(eventTruckId, eventEnd, eventLocation, eventStart)VALUES(:eventTruckId, :eventEnd, :eventLocation, :eventStart)";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holders in the template
		$formattedEventStart = $this->eventStart->format("Y-m-d H:i:s");
		$formattedEventEnd = $this->eventEnd->format("Y-m-d H:i:s");

		$parameters = ["eventTruckId" => $this->eventTruckId, "eventEnd" => $formattedEventEnd, "eventLocation" => $this->eventLocation, "eventStart" => $formattedEventStart];
		$statement->execute($parameters);

		//update the null eventId with what mySQL just gave us
		$this->eventId = intval($pdo->lastInsertId());
	}

	/**
	 * deletes this Event from mySQL
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo) {
		//enforce the eventId is not null(i.e. don't delete a tweet that hasn't been inserted)
		if($this->eventId === null) {
			throw(new \PDOException("unable to delete an event that does not exist"));
		}
		//create a query template
		$query = "DELETE FROM event WHERE eventId = :eventId";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holder in the template
		$parameters = ["eventId" => $this->eventId];
		$statement->execute($parameters);
	}

	/**
	 * Updates this Event in mySQL
	 * @param \PDO $pdo PDO connection object
	 * @throws |\PDOException if mySQL related errors occur
	 * @throws \TypeError is $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo) {
		//enforce the eventId is not null(i.e. don't update an event that hasn't been inserted)
		if($this->eventId === null) {
			throw(new \PDOException("unable to update an event that does not exist"));
		}
		//create a query template
		$query = "UPDATE event SET eventTruckId = :eventTruckId, eventEnd = :eventEnd, eventLocation = :eventLocation, eventStart = :eventStart WHERE eventId = :eventId";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holders in the template
//		$formattedDate = $this->eventId->format("Y-m-d H:i:s"); do I add this like this?

		$parameters = ["eventTruckId" => $this->eventTruckId, "eventEnd" => $this->eventEnd, "eventLocation" => $this->eventLocation, "eventStart" => $this->eventStart, "eventId" => $this->eventId]; //do i assign start/end to formatted date?? do i add eventId here?

		$statement->execute($parameters);
	}

	/**
	 * gets the Event by eventId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $eventId event id to search for
	 * @return event|null event found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 */

	public static function getEventByEventId(\PDO $pdo, int $eventId) {
		//sanitize the eventId before searching by checking that it is a positive number
		if($eventId <= 0) {
			throw(new \PDOException("eventId is not positive"));
		}

		//create query template
		$query = "SELECT eventId, eventTruckId, eventEnd, eventLocation, eventStart FROM event /*is this the class?*/ WHERE eventId = :eventId";
		$statement = $pdo->prepare($query);

		//bind the event id to the place holder in the template
		$parameters = ["eventId" => $eventId];
		$statement->execute($parameters);

		//grab the event from mySQL
		try {
			$event = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$event = new Event($row["eventId"], $row["eventTruckId"], $row["eventEnd"], $row["eventLocation"], $row["eventStart"]);
			}
		} catch(\Exception $exception) {
			//if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($event);
	}

	/**
	 * get the event by the eventTruckId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $eventTruckId event truck id to search by
	 * @return \SplFixedArray SplFixedArray of Events found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 * @throws \RangeException when out of range //do i need to add this here? the example didn't.
	 **/
	public static function getEventByEventTruckId(\PDO $pdo, int $eventTruckId) {
		//sanitize the truck id before searching by making sure it is positive
		if($eventTruckId <= 0) {
			throw(new \RangeException("event truck id must be positive"));
		}
		//create query template
		$query = "SELECT eventId, eventTruckId, eventEnd, eventLocation, eventStart FROM event WHERE eventTruckId = :eventTruckId";
		$statement = $pdo->prepare($query);

		//bind the event truck id to the  place holder in the template
		$parameters = ["eventTruckId" => $eventTruckId];
		$statement->execute($parameters);

		//build an array of events WHY DO I BUILD AN ARRAY HERE??? WE DIDN'T IN THE LAST ONE. NEVERMIND I THINK I KNOW.
		$events = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$event = new Event($row["eventId"], $row["eventTruckId"], $row["eventEnd"], $row["eventLocation"], $row["eventStart"]);
				$events[$events->key()] = $event;
				$events->next();
			} catch(\Exception $exception) {
				//if the row couldn't be converted rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($events);
	}

	/**
	 * get Event by EventLocation
	 * @param \PDO $pdo PDO connection object
	 * @param float $eventLocation event location coordinates to search by
	 * @return \SplFixedArray SplFixedArray of Events found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getEventByEventLocation(\PDO $pdo, float $eventLocation) {
		if($eventLocation < [-90, -180] || $eventLocation > [90, 180]) { //is this how i write the coordinates??
			throw(new \RangeException("this coordinate is not within the allowed range"));
		}
		//create query template
		$query = "SELECT eventId, eventTruckId, eventEnd, eventLocation, eventStart FROM event WHERE $eventLocation = :eventLocation";
		$statement = $pdo->prepare($query);

		//bind the eventLocation to the placeholder in the template
		$parameters = ["eventLocation" => $eventLocation];
		$statement->execute($parameters);

		//build an array of events
		$events = new \SplFixedArray(($statement->rowCount()));
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$event = new Event($row["eventId"], $row["eventTruckId"], $row["eventEnd"], $row["eventLocation"], $row["eventStart"]);
				$events[$events->key()] = $event;
				$events->next();
			} catch(\Exception $exception) {
				//if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($events);
	}

	/**
	 * gets the event by the eventId and the eventTruckId
	 * @param \PDO $pdo PDO connection object
	 * @param int $eventId event id to search for
	 * @param int $eventTruckId search for truck id that attended the event
	 * @return event|null event if found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when values are not the correct data type
	 **/
	public static function getEventByEventIdAndEventTruckId(\PDO $pdo, int $eventId, int $eventTruckId) {
		//sanitize the ids before searching by checking that they are positive
		if($eventId <= 0 || $eventTruckId <= 0) {
			throw(new \RangeException("eventId and eventTruckId must be positive"));
		}
		//create query template
		$query = "SELECT eventId, eventTruckId, eventEnd, eventLocation, eventStart FROM event WHERE eventId = :eventId AND eventTruckId = :eventTruckId";
		$statement = $pdo->prepare($query);

		//bind eventId and eventTruckId to the placeholder in the query
		$parameters = ["eventId" => $eventId, "eventTruckId" => $eventTruckId];
		$statement->execute($parameters);

		//grab the event from mySQL
		try {
			$event = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$event = new Event($row["eventId"], $row["eventTruckId"], $row["eventEnd"], $row["eventLocation"], $row["eventStart"]);
			}
		}catch
			(\Exception $exception){
				//if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
			return ($event);

		}

	/**
	 *get event by event end and event start: gets the ACTIVE EVENTS
	 *@param \PDO $pdo PDO connection object
	 *@param \DateTime $eventStart to search by
	 *@param \DateTime $eventEnd to search by
	 *@return \SplFixedArray SplFixedArray of activeEvents found
	 *@throws \PDOException when mySQL related errors occur
	 *@throws \InvalidArgumentException
	 *@throws \TypeError when values are not the correct data type
	 */
	public static function getEventByEventEndAndEventStart(\PDO $pdo, \DateTime $eventEnd, \DateTime $eventStart) {

		$query = "SELECT eventId, eventTruckId, eventEnd, eventLocation, eventStart FROM event WHERE eventStart <= NOW() AND eventEnd >= NOW()";

		$statement = $pdo->prepare($query);
		$statement->execute();

			//build an array of events
			$events = new \SplFixedArray(($statement->rowCount()));
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			while(($row = $statement->fetch()) !== false) {
				try {
					$event = new Event($row["eventId"], $row["eventTruckId"], $row["eventEnd"], $row["eventLocation"], $row["eventStart"]);
					$events[$events->key()] = $event;
					$events->next();
				} catch(\Exception $exception) {
					//if the row couldn't be converted, rethrow it
					throw(new \PDOException($exception->getMessage(), 0, $exception));
				}
			}
			return ($events);
		}

	/**
	 * gets all Events
	 * @param \PDO $pdo PDO Connection object
	 * @return \SplFixedArray SplFixedArray of Events found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when varaiables are not the correct data type
	 **/
	public static function getAllEvents(\PDO $pdo){
		//create query template
		$query = "SELECT eventId, eventTruckId, eventEnd, eventLocation, eventStart FROM event";
		$statement = $pdo->prepare($query);
		$statement->execute();

		//build an array of events
		$events = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false){
			try{
				$event = new Event($row["eventId"], $row["eventTruckId"], $row["eventEnd"], $row["eventLocation"], $row["eventStart"]);
				$events[$events->key()] = $event;
				$events->next();
			}catch(\Exception $exception){
				//if the row couldn't be converted rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($events);
	}


	/**
	 * formats the state variables for JSON serialization
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		$fields["eventEnd"] = $this->eventEnd->getTimestamp() * 1000;
		$fields["eventStart"] = $this->eventStart->getTimestamp() * 1000; //do i put two separate lines for this?
		return ($fields);
	}


}