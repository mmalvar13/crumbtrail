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
}