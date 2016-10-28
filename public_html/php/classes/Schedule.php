<?php

namespace Edu\Cnm\CrumbTrail;

require_once("autoload.php");

//begin Docblock
/**
 * Schedule Identifier
 *
 * This will be used to identify the different food truck schedules that will be in our database. This will be a weekly schedule with the possibility multiple objects on any given day. This will run Monday through Sunday.
 *
 * @author Victoria Chacon <victoriousdesignco@gmail.com>
 **/

/* This is a test...jk it worked....hmmmm */

/* Begin class here */

class Schedule implements \JsonSerializable {

	use ValidateDate;
	/**
	 * id for this schedule; this is the primary key
	 * @var int $scheduleId ;
	 **/
	private $scheduleId;
	/**
	 * id for this schedule's connection to its company
	 * @var int $scheduleCompanyId ;
	 */
	private $scheduleCompanyId;
	/**
	 * id for this schedule's day of the week (Todo: Does this need to be private? So someone cant mess around with a trucks schedule right? (down))
	 * @var string $scheduleDayOfWeek ;
	 */
	private $scheduleDayOfWeek;
	/**
	 * id for this schedule's start time of operation
	 *
	 * @var \DateTime $scheduleStartTime ;
	 */
	private $scheduleStartTime;
	/**
	 * id for this schedule's end time of operation
	 *
	 * @var \DateTime $scheduleEndTime
	 */
	private $scheduleEndTime;
	/**
	 * id for this schedule's location name
	 * @var string $scheduleLocationName ;
	 */
	private $scheduleLocationName;
	/**
	 * id for this schedule's location address
	 * @var string $scheduleLocationAddress
	 */
	private $scheduleLocationAddress;

// constructor here //
	/**
	 * Schedule Constructor
	 * @param int|null $newScheduleId id of the schedule or null if a new schedule
	 * @param int|null $newScheduleCompanyId id of the schedule and it company connection
	 * @param string $newScheduleDayOfWeek string of the day of the week
	 * @param string $newScheduleLocationName string of the location name
	 * @param string $newScheduleLocationAddress string of the location address
	 * @param \DateTime|string|null $newScheduleStartTime data and time of the schedule (taken from the event class)
	 * @param \DateTime|string|null $newScheduleEndTime data and time of the schedule (taken from the event class)
	 *
	 * Todo: @param string $newScheduleTime string of times set for an event (if we deiced to make this a string)
	 * @throws \RangeException when the integer is negative or strings are too long
	 * @throws \TypeError if the the days of the week do not match our parameters
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \Exception when error need to be called in the code??
	 **/

	public function __construct(int $newScheduleId = null, int $newScheduleCompanyId, string $newScheduleDayOfWeek, string $newScheduleLocationName, string $newScheduleLocationAddress, $newScheduleStartTime = null, $newScheduleEndTime = null) {
		try {
			$this->setScheduleId($newScheduleId);
			$this->setScheduleCompanyId($newScheduleCompanyId);
			$this->setScheduleDayOfWeek($newScheduleDayOfWeek);
			$this->setScheduleLocationName($newScheduleLocationName);
			$this->setScheduleLocationAddress($newScheduleLocationAddress);
			$this->setScheduleStartTime($newScheduleStartTime);
			$this->setScheduleEndTime($newScheduleEndTime);
		} catch(\RangeException $range) {
			throw(new \RangeException($range->getMessage(), 0, $range));
		} catch(\InvalidArgumentException $invalidArgument) {
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\Exception $exception) {
			throw(new \Exception($exception->getMessage(), 0, $exception));
		}
	}
	/* Begin the setters and getters Here...accessors and mutators */

	/**
	 * accessor for the scheduleId
	 *
	 * @return int|null value of scheduleId
	 **/

	public function getScheduleId() {
		return ($this->scheduleId);
	}

	/**
	 * mutator method for scheduleId
	 * @param int|null value for scheduleId
	 * @throws \RangeException if the $newScheduleId is negative
	 * @throws \InvalidArgumentException if $newScheduleId is not of the type integer
	 **/
	public function setScheduleId(int $newScheduleId = null) {
		if($newScheduleId === null) {
			$this->scheduleId = null;
			return;
		}
		//verifying whether the id is positive
		if($newScheduleId <= 0) {
			throw(new \RangeException("This schedule id is not positive"));
		}
		//convert and store schedule
		$this->scheduleId = $newScheduleId;
	}

	/**
	 * accessor for the scheduleCompanyId
	 *
	 * @return int|null value for scheduleCompanyId
	 **/
	public function getScheduleCompanyId() {
		return ($this->scheduleCompanyId);
	}

	/**
	 * mutator method for scheduleCompanyId
	 * @param int|null value for scheduleCompanyId
	 * @throws \RangeException if $newScheduleCompanyId is negative
	 * @throws \InvalidArgumentException if $newScheduleCompanyId is not of the type integer
	 **/
	public function setScheduleCompanyId(int $newScheduleCompanyId = null) {
		if($newScheduleCompanyId === null) {
			$this->scheduleCompanyId = null;
			return;
		}
		if($newScheduleCompanyId <= 0) {
			throw(new \RangeException("This schedule company id is not positive"));
		}
		//convert and store this schedule
		$this->scheduleCompanyId = $newScheduleCompanyId;
	}

	/**
	 * accessor for the scheduleDayOfWeek
	 *
	 * @return string $scheduleDayOfWeek the string day of the week
	 **/
	public function getScheduleDayOfWeek() {
		return ($this->scheduleDayOfWeek);
	}

	/**
	 * mutator method for scheduleDayOfWeek
	 * @param string $newScheduleDayOfWeek the string day of the week
	 * @throws \RangeException when the integer is negative or strings are too long
	 * @throws  \TypeError if the day does not exist
	 **/
	public function setScheduleDayOfWeek(string $newScheduleDayOfWeek) {
		if($newScheduleDayOfWeek === null) {
			$this->scheduleDayOfWeek = null;
			return;
		}
		/* make sure the scheduled day is no more than nine characters */
		/* is this right? */
		if($newScheduleDayOfWeek !== "Monday" or "Tuesday" or "Wednesday" or "Thursday" or "Friday" or "Saturday" or "Sunday") {
			throw(new \TypeError("This day of the week does not exist"));
		}
		//convert and store this day of the week
		$this->scheduleDayOfWeek = $newScheduleDayOfWeek;
	}
	/**
	 *accessor for the schedule location name
	 *
	 * @return string $scheduleLocationName the string name of the location
	 **/
	/* example for @return (CNM)*/
	public function getScheduleLocationName() {
		return ($this->scheduleLocationName);
	}

	/**
	 * mutator method for scheduleLocationName
	 * @param string $newScheduleLocationName the string of the location name
	 * @throws \RangeException if the string is too long
	 **/
	public function setScheduleLocationName(string $newScheduleLocationName) {
		if($newScheduleLocationName === null) {
			$this->scheduleLocationName = null;
			return;
		}
		if($newScheduleLocationName > 255) {
			throw(new \RangeException("This Location Name is too long"));
		}
		$this->scheduleLocationName = $newScheduleLocationName;
	}
	/**
	 * accessor for schedule address
	 *
	 * @return string $scheduleLocationAddress the string of the address
	 */
	/* example for above 1232 cherry ln sw...etc*/
	public function getScheduleLocationAddress() {
		return ($this->scheduleLocationAddress);
	}

	/**
	 * mutator for schedule location address
	 *
	 * @return string $newScheduleLocationAddress the string of the location address
	 * @throws \RangeException if the string is too long
	 */
	public function setScheduleLocationAddress(string $newScheduleLocationAddress) {
		if($newScheduleLocationAddress === null) {
			$this->scheduleLocationAddress = null;
			return;
		}
		if($newScheduleLocationAddress > 255) {
			throw(new \RangeException("This Location Address is too long"));
		}
		$this->scheduleLocationAddress = $newScheduleLocationAddress;
	}

	/**
	 * accessor for schedule start time
	 * @return \DateTime value of schedule start
	 */
	public function getScheduleStartTime() {
		return ($this->scheduleStartTime);
	}

	/**
	 * mutator for schedule start time
	 * @param \DateTime|string|null $newScheduleStartTime scheduled start time as a DateTime
	 * @throws \InvalidArgumentException if there is no schedule start time input
	 */
	public function setScheduleStartTime($newScheduleStartTime) {
		if($newScheduleStartTime === null) {
			throw(new \InvalidArgumentException("Must enter a start time"));
		}

		try {
			$newScheduleStartTime = self::validateDateTime($newScheduleStartTime);
		} catch(\InvalidArgumentException $invalidArgument) {
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), $invalidArgument));
		}
		if($newScheduleStartTime = $ScheduleEndTime) /*not sure if this makes sense*/ {
			throw(new \InvalidArgumentException("The start time cannot be the same as the end time."));
			/* so schedule uses range exception to show that the end time cannot come before the start time. Should that also be the case here??? */
		}
		$this->scheduleStartTime = $newScheduleStartTime;
	}

	/**
	 * Accessor for the schedule end time
	 * @return \DateTime value of schedule end
	 */
	public function getScheduleEndTime() {
		return ($this->scheduleEndTime);
	}

	/**
	 * mutator for schedule End Time
	 * @param \DateTime|string|null $newScheduleEndTime scheduled start time as a DateTime
	 * @throws \InvalidArgumentException if there is no schedule start time input
	 */
	public function setScheduleEndTime($newScheduleEndTime) {
		if($newScheduleEndTime === null) {
			throw(new \InvalidArgumentException("Must enter in an end time"));
		}

		try {
			$newScheduleEndTime = self::validateDateTime($newScheduleEndTime);
		} catch(\InvalidArgumentException $invalidArgument) {
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), $invalidArgument));
		}
		if($newScheduleEndTime = $newScheduleStartTime) { /*not sure if this makes sense*/

			throw(new \InvalidArgumentException("The end time cannot be the same as the start time."));
		}
		$this->scheduleEndTime = $newScheduleEndTime;
	}
//------INSERT UPDATE AND DELETE METHODS HERE--------//
	/* not sure if typeError is what i need here*/
	/**
	 * Inserts this Schedule int mySQL
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException whe mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo) {
		//make sure that the schedule is null...not one that already exists
		if($this->scheduleId !== null) {
			throw(new \PDOException("not a new schedule"));
		}
		//query template
		$query = "INSERT INTO schedule(scheduleCompanyId, scheduleDayOfWeek, scheduleStartTime, scheduleEndTime, scheduleLocationName, scheduleLocationAddress)VALUES(:scheduleCompanyId, :scheduleDayOfWeek, :scheduleStartTime, :scheduleEndTime, :scheduleLocationName, :scheduleLocationAddress)";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holders in the template...Wat?
		$formattedScheduleStartTime = $this->scheduleStartTime->format("Y-m-d H:i:s");
		$formattedScheduleEndTime = $this->scheduleEndTime->format("Y-m-d H:i:s");

		$parameters = ["scheduleCompanyId" => $this->scheduleCompanyId, "scheduleDayOfWeek" => $this->scheduleDayOfWeek, "scheduleStartTime" => $formattedScheduleStartTime, "scheduleEndTime" => $formattedScheduleEndTime, "scheduleLocationName" => $this->scheduleLocationName, "scheduleLocationAddress" => $this->scheduleLocationAddress];
		$statement->execute($parameters);

		//update the null scheduleId with what SQL just gave us
		$this->scheduleId = intval($pdo->lastInsertId());
	}

	/**
	 * Deletes this Schedule int mySQL
	 * @param \PDO $pdo PDO connection objecty
	 * @throws \PDOException whe mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo) {
		if($this->scheduleId === null) {
			throw(new\PDOException("unable to delete a schedule that does noe exist"));
		}
		//query template
		$query = "DELETE FROM schedule WHERE scheduleId = :scheduleId";
		$statement = $pdo->prepare($query);

		$parameters = ["scheduleId" => $this->scheduleId];
		$statement->execute($parameters);
	}

	/**
	 * Updates this Schedule in mySQL
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException if mySQL related errors occur
	 * @throws \TypeError is $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo) {
		if($this->scheduleId === null) {
			throw(new \PDOException("unable to update a schedule that does not exist"));
		}
		//query template
		//why is schedule orange??
		$query = "UPDATE schedule SET scheduleCompanyId = : scheduleCompanyId, scheduleDayOfWeek = : scheduleDayOfWeek, scheduleStartTime = :scheduleStartTime, scheduleEndTime = : scheduleEndTime, scheduleLocationName = :scheduleLocationName, scheduleLocationAddress = : scheduleLocationAddress";
		$statement = $pdo->prepare($query);

		$formattedScheduleStartTime = $this->scheduleStartTime->format("Y-m-d H:i:s");
		$formattedScheduleEndTime = $this->scheduleEndTime->format("Y-m-d H:i:s");

		$parameters = ["scheduleCompanyId" => $this->scheduleCompanyId, "scheduleDayOfWeek" => $this->scheduleDayOfWeek, "scheduleStartTime" => $formattedScheduleStartTime, "scheduleEndTime" => $formattedScheduleEndTime, "scheduleLocationName" => $this->scheduleLocationName, "scheduleLocationAddress" => $this->scheduleLocationAddress, "scheduleId" => $this->scheduleId];
		$statement->execute($parameters);
	}
	/* GET FOO BY BARS*/
	/**
	 * gets the schedule by scheduleId
	 * @param \PDO $pdo PDO connection object
	 * @param int $scheduleId schedule id to search for
	 * @return schedule|null schedule found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 */

	public static function getScheduleByScheduleId(\PDO $pdo, int $scheduleId) {
		//make sure the schedule Id is positive
		if($scheduleId <= 0) {
			throw(new \PDOException("schedule Id is not positive"));
		}
		//query template
		//Why is this not formatted correctly???
		$query = "SELECT scheduleId, scheduleCompanyId, scheduleDayOfWeek, scheduleStartTime, scheduleEndTime, scheduleLocationName, scheduleLocationAddress FROM schedule WHERE scheduleId = :scheduleId";
		$statement = $pdo->prepare($query);

		$parameters = ["scheduleId" => $scheduleId];
		$statement->execute($parameters);

		//get the schedule from mySQL database
		try {
			$schedule = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();

			if($row != false) {
				$schedule = new Schedule($row["scheduleId"], $row["scheduleCompanyId"], $row["scheduleDayOfWeek"], $row["scheduleStartTime"], $row ["scheduleEndTime"], $row ["scheduleLoacationName"], $row["scheduleLocationAddress"]);

			}
		} catch(\Exception $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($schedule);
	}

	/**
	 * get schedule by scheduleCompanyId
	 * @param \PDO $pdo PDO connection object
	 * @param int $scheduleCompanyId schedule company id to search for
	 * @return \$scheduleCompanyId|null schedule found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 */
	public static function getScheduleByScheduleCompanyId(\PDO $pdo, int $scheduleCompanyId) {
		if($scheduleCompanyId <= 0) {
			throw(new \PDOException("The scheduleCompany Id cannont be 0 or negative"));
		}
		//not sure why this isnt working//
		$query = "SELECT scheduleId, scheduleCompanyId, scheduleDayOfWeek, scheduleStartTime, scheduleEndTime, scheduleLocationName, scheduleLocationAddress FROM schedule WHERE scheduleCompanyId = :scheduleCompanyId";

		$statement = $pdo->prepare($query);

		$parameters = ["scheduleCompanyId" => $scheduleCompanyId];

		$statement->execute($parameters);

		try {
			$schedule = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);

			$row = $statement->fetch();

			if($row != false) {
				$schedule = new Schedule($row["scheduleId"], $row["scheduleCompanyId"], $row["scheduleDayOfWeek"], $row["scheduleStartTime"], $row ["scheduleEndTime"], $row ["scheduleLocationName"], $row["scheduleLocationAddress"]);
			}
		} catch(\Exception $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		//not sure why this isnt working
		return ($schedule);
	}

	/**
	 * get schedule by scheduleId and scheduleCompanyId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $scheduleId scheduleId to search by
	 * @param \int $scheduleCompanyId schedule company id to search by
	 * @return schedule|null
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 */

	public static function getScheduleByScheduleIdandScheduleCompanyId(\PDO $pdo, int $scheduleId, int $scheduleCompanyId) {

		if($scheduleId <= 0 || $scheduleCompanyId <= 0) {
			throw(new \PDOException("scheduleId and scheduleCompanyId cannot be negative or 0"));
		}
		//query
		$query = "SELECT scheduleId, scheduleCompanyId, scheduleDayOfWeek, scheduleStartTime, scheduleEndTime, scheduleLocationName, scheduleLocationAddress FROM schedule WHERE scheduleCompanyId = :scheduleCompanyId AND scheduleCompanyId = :scheduleCompanyId";

		$statement = $pdo->prepare($query);

		$parameters = ["scheduleId" => $scheduleId, "scheduleCompanyId" => $scheduleCompanyId];

		$statement->execute($parameters);

		try {
			$schedule = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);

			$row = $statement->fetch();

			if($row != false) {
				$schedule = new Schedule($row["scheduleId"], $row["scheduleCompanyId"], $row["scheduleDayOfWeek"], $row["scheduleStartTime"], $row ["scheduleEndTime"], $row ["scheduleLoacationName"], $row["scheduleLocationAddress"]);
			}
		} catch(\Exception $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($schedule);
	}

	/**
	 * get schedule by the day of the week
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $scheduleDayOfWeek day of week to search for
	 * @return \SplFixedArray splFixedArray of days of the week found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not of the correct data type
	 */

	public static function getScheduleByScheduleDayOfWeek(\PDO $pdo, string $scheduleDayOfWeek) {

		if(empty($scheduleDayOfWeek)) {
			throw(new \PDOException("The day of the week is empty"));
		}
		//hopefully this is right, but im going to make sure that the schedule can only be found by having the exact day of the week...
		if(strlen($scheduleDayOfWeek) !== "Monday" or "Tuesday" or "Wednesday" or "Thursday" or "Friday" or "Saturday" or "Sunday") {
			throw(new \PDOException("This day of the week does not exist"));
		}
		$query = "SELECT scheduleId, scheduleCompanyId, scheduleDayOfWeek, scheduleStartTime, scheduleEndTime, scheduleLocationName, scheduleLocationAddress FROM schedule WHERE scheduleDayOfWeek = :scheduleDayOfWeek";

		$statement = $pdo->prepare($query);

		$parameters = ["scheduleDayOfWeek" => $scheduleDayOfWeek];
		$statement->execute($parameters);
		$scheduleDayOfWeek = new \SplFixedArray($statement->rowCount());

		while(($row = $statement->fetch()) != false) {

			try {
				$schedule = null;
				$statement->setFetchMode(\PDO::FETCH_ASSOC);

				$row = $statement->fetch();

				if($row != false) {
					$schedule = new Schedule($row["scheduleId"], $row["scheduleCompanyId"], $row["scheduleDayOfWeek"], $row["scheduleStartTime"], $row ["scheduleEndTime"], $row ["scheduleLoacationName"], $row["scheduleLocationAddress"]);
				}
			} catch(\Exception $exception) {
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
			return ($schedule);
		}
	}

	/**
	 *get schedule by schedule start time
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param \DateTime $scheduleStartTime start time to search by
	 * @return \SplFixedArray SplFixedArray of schedule start times
	 * @throws \PDOException when mySQL errors occur
	 * @throws \TypeError when variables are not the correct data type
	 */

	public static function getScheduleByScheduleStartTime(\PDO $pdo, \DateTime $scheduleStartTime) {

		if(empty($scheduleStartTime)) {
			throw(new \PDOException("Must enter a start time"));
			//as i have it above in the setter and getters should i have a section here that stops a user from putting in a start time and end time from being the same
		}
		$query = "SELECT scheduleId, scheduleCompanyId, scheduleDayOfWeek, scheduleStartTime, scheduleEndTime, scheduleLocationName, scheduleLocationAddress FROM schedule WHERE scheduleDayOfWeek = :scheduleDayOfWeek";

		$statement = $pdo->prepare($query);
		$parameters = ["scheduleStartTime" => $scheduleStartTime];

		$statement->execute($parameters);
		$scheduleStartTime = new \SplFixedArray($statement->rowCount());

		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) != false) {

			try {

				$schedule = new Schedule($row["scheduleId"], $row["scheduleCompanyId"], $row["scheduleDayOfWeek"], $row["scheduleStartTime"], $row ["scheduleEndTime"], $row ["scheduleLoacationName"], $row["scheduleLocationAddress"]);

				//Following Lorens format for extra serving by start time....
				$schedules[$schedules->key()] = $schedule;

				$schedules->next();
			}catch(\Exception $exception) {
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
			return ($schedules);
		}
	}




	/**
	 * formats the state variables for JSON serialization
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		$fields["scheduleStartTime"] = $this->scheduleStartTime->getTimestamp() * 1000;
		$fields["scheduleEndTime"] = $this->scheduleEndTime->getTimestamp() * 1000;
		return ($fields);
	}

}