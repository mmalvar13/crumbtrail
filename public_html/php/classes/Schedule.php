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
		if($newScheduleStartTime = $newScheduleEndTime) /*not sure if this makes sense*/ {
			throw(new \InvalidArgumentException("The start time cannot be the same as the end time."));
			/* so event uses range exception to show that the end time cannot come before the start time. Should that also be the case here??? */
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
//------INSERT UPDATE AND DELETE METHODS HERE--------//
		/**
		 *
		 */

	}
}