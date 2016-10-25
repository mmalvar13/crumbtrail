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
	 * @var int $scheduleId;
	 **/
	private $scheduleId;
	/**
	 * id for this schedule's connection to its company
	 * @var int $scheduleCompanyId;
	 */
	private $scheduleCompanyId;
	/**
	 * id for this schedule's day of the week (Todo: Does this need to be private? So someone cant mess around with a trucks schedule right? (down))
	 * @var string $scheduleDaysOfWeek;
	 */
	private $scheduleDaysOfWeek;
	/**
	 * id for this schedule's location. (Todo: is this a point or a string...need to clarify on Tuesday (down is the string version, point at the moment is in gray)
	 * @var string $scheduleLocation;
	 */
	private $scheduleLocation;
	/*
	(JUST IN CASE WE DECIDE POINT)
	 * id for this schedule's location (if it is a point)
	 * @var point $scheduleLocation;
	 * (NEEDS FORMATTING)
	 * /*
	 * Private $scheduleLocation;
	 */
	/**
	 * id for this schedule's time of operation (Todo: does this need to be a date/time? or are we just having the food truck owner put this in as a string (currently set as a date time, the string version is in grey at the bottom)
	 * @var \DateTime $scheduleTime;
	 */
	private $scheduleTime;
	/*
	 * (JUST IN CASE WE DECIDE STRING)
	 * id for this schedule's time of operation (if it is a string)
	 * @var string $scheduleTime;
	 * (NEEDS FORMATTING)
	 * /*
	 * private $scheduleTime;
	 */
	/**
	 * id for this schedule's location name
	 * @var string $scheduleLocationName;
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
	 * @param string $newScheduleDaysOfWeek string of the day of the week
	 * @param string $newScheduleLocation string of the location
	 * @param string $newScheduleLocationName string of the location name
	 * @param string $newScheduleLocationAddress string of the location address
	Todo: ANYTHING HERE IN YELLOW IS THE ALTERNATIVE CODE BASED ON OUR DECISIONS @param point $newScheduleLocation gps location of this schedule object if we decide to make this a point object
	 * @param \DateTime|string|null $newScheduleTime data and time of the schedule (taken from the event class)
	Todo: @param string $newScheduleTime string of times set for an event (if we deiced to make this a string)
	 * @throws \RangeException when the integer is negative or strings are too long
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \Exception when error need to be called in the code??
	 **/

public function __construct(int $newScheduleId = null, int $newScheduleCompanyId, string $newScheduleDaysOfWeek, string $newScheduleLocation, string $newScheduleLocationName, string $newScheduleLocationAddress, $newScheduleTime = null) {
	try {
		$this->setScheduleId($newScheduleId);
		$this->setScheduleCompanyId($newScheduleCompanyId);
		$this->setScheduleDaysOfWeek($newScheduleDaysOfWeek);
		$this->setScheduleLocation($newScheduleLocation);
		$this->setScheduleLocationName($newScheduleLocationName);
		$this->setScheduleLocationAddress($newScheduleLocationAddress);
		$this->setScheduleTime($newScheduleTime);
	} catch(\RangeException $range) {
		throw(new \RangeException($range->getMessage(), 0, $range));
	} catch(\InvalidArgumentException $invalidArgument) {
		throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
	} catch(\Exception $exception) {
		throw(new \Exception($exception->getMessage(), 0, $exception));
	}
}
/* Begin the setters and getters Here...accessors and mutators */



}