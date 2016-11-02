<?php

namespace Edu\Cnm\CrumbTrail\Test;  /*LOOK INTO THIS FOR ACCURACY */


use Edu\Cnm\CrumbTrail\{Company};

//grab the parameters for the test, go the the abstract test file
require_once("CrumbTrailTest.php");

//grab the class being tested
//so we are jumping a couple (4?) directories to the autoloader which will then load our class.
//wtf is that period for? to concatenate on the file path?
require_once(dirname(__DIR__) . "/public_html/php/classes/autoload.php"); //wtf us going on here?

/**
 * Full PHPUnit test for the Extra Serving class
 *
 * This is a complete PHPUnit test of the Extra Serving class. It is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see ExtraServing\
 * @author Lo-BAK <baca.loren@gmail.com>
 **/

class ExtraServingTest extends CrumbTrailTest {

	/*----------------------------Declare Protected State Variables ----------------*/

	/**
	 * Default input data set for extra serving description
	 * @var string $VALID_PROFILENAME1 //why is this in all caps, what's up with this syntax?
	 */
	protected $VALID_PROFILENAME1 = "Name";
}