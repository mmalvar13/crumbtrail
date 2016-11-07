<?php
namespace Edu\Cnm\CrumbTrail\Test;

use Edu\Cnm\CrumbTrail\{
	Company, Schedule
};

//grab the project test parameters
require_once("CrumbTrailTest.php");

//grab the class under scrutiny
require_once(dirname(__DIR__) . "/public_html/php/classes/autoload.php");

/**
 * unit test for the schedule class
 *
 * All mySQL/PDO enabled methods test for valid and invalid inputs
 *
 * @see Schedule
 * @author Victoria Chacon <victoriousdesignco@gmail.com>
 **/

class ScheduleTest extends CrumbTrailTest {
	//setting up made up variables to test
	//--------------STATE VARIABLES: PROTECTED SECTION----------------------------//
	/**
	 * company that this schedule is attributed to. This is a foreign key relationship.
	 * @var Company company
	 **/
	protected $company = null;
	//we dont need the primary or foreign key here right???
	/**
	 * Generic data for the Schedule day of the week
	 * @var string $VALID_SCHEDULEDAYOFWEEK1
	 **/
	protected $VALID_SCHEDULEDAYOFWEEK1 = "Monday";
	/**
	 * Generic data for the Schedule day of the week
	 * @var string $VALID_SCHEDULEDAYOFWEEK2
	 **/
	protected $VALID_SCHEDULEDAYOFWEEK2 = "Wednesday";
	/**
	 * Timestamp data for the Schedule End Time
	 * @var \DateTime $VALID_SCHEDULEENDTIME1
	 **/
	protected $VALID_SCHEDULEENDTIME1 = null;
	/**
	 * Timestamp data for the Schedule End Time
	 * @var \DateTime $VALID_SCHEDULEENDTIME2
	 **/
	protected $VALID_SCHEDULEENDTIME2 = null;
	/**
	 * Generic data for the Schedule location address
	 * @var string $VALID_SCHEDULELOCATIONADDRESS1
	 */
	protected $VALID_SCHEDULELOCATIONADDRESS1 = "1312 Awesome Food rd SW albuquerque NM. 87121";
	/**
	 * Generic data for the Schedule location address
	 * @var string $VALID_SCHEDULELOCATIONADDRESS2
	 */
	protected $VALID_SCHEDULELOCATIONADDRESS2 = "9201 Spicy Food ln SW albuquerque NM. 87114";
	/**
	 * Generic data for the Schedule Location Name
	 * @var string $VALID_SCHEDULELOCATIONNAME1
	 */
	protected $VALID_SCHEDULELOCATIONNAME1 = "The Rail Yards";
	/**
	 * Generic data for the Schedule Location Name
	 * @var string $VALID_SCHEDULELOCATIONNAME2
	 */
	protected $VALID_SCHEDULELOCATIONNAME2 = "418 Teapot Event ";
	/**
	 * Timestamp data for the Schedule Start Time
	 *@var /DateTime $VALID_SCHEDULESTARTTIME1
	 */
	protected $VALID_SCHEDULESTARTTIME1 = null;
	/**
	 * Timestamp data for the Schedule Start Time
	 *@var /DateTime $VALID_SCHEDULESTARTTIME2
	 */
	protected $VALID_SCHEDULESTARTTIME2 = null;

//---------CREATING ALREADY MADE STUFF THAT WILL BE INSERTED, UPDATED, DELETED-----//
//------------------------BASED ON THE INFORMATION ABOVE---------------------------//




}