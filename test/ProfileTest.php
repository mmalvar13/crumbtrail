<?php


namespace Edu\Cnm\Mmalvar13\CrumbTrail\Test;  /*LOOK INTO THIS FOR ACCURACY */

use Edu\Cnm\CrumbTrail\Test\CrumbTrailTest;
use Edu\Cnm\Mmalvar13\CrumbTrail\Test\{Profile};

//grab the parameters for the test, go the the abstract test file
require_once("CrumbTrailTest.php");

//grab the class being tested
//so we are jumping a couple (4?) directories to the autoloader which will then load our class.
//wtf is that period for? to concatenate on the file path?
require_once(dirname(__DIR__) . "/public_html/php/classes/autoload.php"); //wtf us going on here?

/**
 * Full PHPUnit test for the Profile class
 *
 * This is a complete PHPUnit test of the Profile class. It is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see Profile\
 * @author Lo-B <baca.loren@gmail.com>
 **/

class ProfileTest extends CrumbTrailTest {

	/*----------------------------Declare Protected State Variables ----------------*/

	/**
	 * Default input data set for a string 1
	 * @var string $VALID_STRING1     //why is this in all caps, what's up with this syntax?
	 */
	protected $VALID_STRING1 = "A man needs a name...";

/**
 * default input data for a string 2
 * @var string  $VALID_STRING2
 */
protected $VALID_STRING2 = "A girl has no name";



}
