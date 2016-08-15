<?php
namespace Edu\Cnm\CrumbTrail\Test;

use Edu\Cnm\CrumbTrail\{Point};

/**
 * PHPUnit test for the Point class
 *
 * Dylan: Since this class is isolated from mySQL, there's no need for the parent class nor autoloader.
 *
 @see Point
 @author Kevin Lee Kirk
 */

class PointTest extends PHPUnit_Framework_TestCase {

	// Set the protected parameter values: create a valid point.
	/**
	 * Latitude for this point.
	 * @var float $pointLatitude
	 */
	protected $VALID_POINTLATITUDE = 37.123456;
	/**
	 * Longitude for this point.
	 * @var float $pointLongitude
	 */
	protected $VALID_POINTLONGITUDE = -77.123456;


	/**
	 * Create a point and assert the accessor methods return the correct values.
	 * Use the four argument version of assertEquals() to make sure float values are about equal.
	 * This is because 2.17117 should be the same as 2.171169999999999999999983.
	 *
	 * PHP documentation: So never trust floating number results to the last digit,
	 * and do not compare floating point numbers directly for equality.
	 */
	public function testValidPoint() {

		$point = new Point($this->VALID_POINTLATITUDE, $this->VALID_POINTLONGITUDE);

		$expectedLatitude = $VALID_POINTLATITUDE;
		assertEquals(float $expectedLatitude, float $this->VALID_POINTLATITUDE[string $message = 'Expected latitude not equal to actual latitude, within 0.000001', float $delta = 0.000001]);

		$expectedLongitude = $VALID_POINTLONGITUDE;
		assertEquals(float $expectedLongitude, float $this->VALID_POINTLONGITUDE[string $message = 'Expected longitude not equal to actual longitude, within 0.000001', float $delta = 0.000001]);
	}


	/**
	 * Create a point that is out of range, and expect an exception to be thrown.
	 * We expect a \RangeException, since the data values are out of bounds,
	 * (e.g., latitude > 90 or < -90, or longitude > 180 or < -180).
	 *
	 */
	public function testInvalidPoint() {

		$invalidLatitude = 181;
		$invalidLongitude = 91;
		$point = new Point($this->$invalidLatitude, $this->$invalidLongitude);
	}
}