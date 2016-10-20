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
	 * id for this schedule's day of the week (Todo: Does this need to be private? So someone cant mess around with a trucks schedule right?)
	 * @var string $scheduleDaysOfWeek;
	 */
	private $scheduleDaysOfWeek;
	/**
	 * id for this schedule's location. (Todo: is this a point or a string...need to clarify on Tuesday
	 * @var string $scheduleLocation;
	 */
	/*
	(JUST IN CASE WE DECIDE POINT)
	 * id for this schedule's location (if it is a point)
	 * @var point $scheduleLocation;
	 */
	/**
	 * id for this schedule's time of operation (Todo: does this need to be a date/time? or are we just having the food truck owner put this in as a string
	 * @var \DateTime $scheduleTime;
	 */
	/*
	 * (JUST IN CASE WE DECIDE STRING)
	 * id for this schedule's time of operation (if it is a string)
	 * @var string $scheduleTime;
	 */
	/**
	 * id for this schedule's connection to its company
	 * @var int $scheduleCompanyId;
	 */
}