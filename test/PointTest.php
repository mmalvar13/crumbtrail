<?php
namespace Edu\Cnm\CrumbTrail\Test;

use Edu\Cnm\CrumbTrail\{Point};

// Require the project test parameters.
require_once("CrumbTrailTest.php");

// Require the class being tested.
require_once(dirname(__DIR__) . "/public_html/php/classes/autoload.php");


/**
 * PHPUnit test for the Point class
 *
 @see Point
 @author Kevin Lee Kirk
 *
 */

class PointTest extends CrumbTrailTest {

	// Set the protected parameter values.

	/**
	 * latitude for this point
	 * @var float $pointLatitude
	 */
	protected $VALID_POINTLATITUDE = 37.123456;

	/**
	 * updated latitude for this point
	 * @var float $pointLatitude
	 */
	protected $VALID_POINTLATITUDE2 = 37.234567;


	/**
	 * longitude for this point
	 * @var float $pointLongitude
	 */
	protected $VALID_POINTLONGITUDE = -77.123456;

	/**
	 * updated longitude for this point
	 * @var float $pointLongitude
	 */
	protected $VALID_POINTLONGITUDE2 = -77.234567;



// snippet from Dylan:
// <?php

// since this class is isolated from mySQL, there's no need for the parent class nor autoloader

// class PointTest extends PHPUnit_Framework_TestCase {
//	public function testValidPoint() {
//		// create a point and assert the accessor methods return the correct values
//		// use the four argument version of assertEquals() to make sure float values
	// this is because 2.17117 should be the same as 2.171169999999999999999983
//	}

//	public function testInvalidPoint() {
//		// try to create a point out of range and expect an exception
//	}



}





}












