<?php
namespace Edu\Cnm\CrumbTrail\Test;

use Edu\Cnm\CrumbTrail\{Point};

// TODO Is the line below needed?
// require_once ("PHPUnit_Framework_TestCase.php");

/**
 * PHPUnit test for the Point class
 *
 * Since this class is isolated from mySQL, there's no need for the parent class nor autoloader.
 *
 @see Point
 @author Kevin Lee Kirk and Loren Baca
 */

class PointTest extends \PHPUnit_Framework_TestCase {

	// Set the protected parameter values: create a valid point AND an invalid point?!.

	/**
	 * Latitude for a valid point.
	 * @var float $pointLatitude
	 */
	protected $VALID_POINTLATITUDE = 37.123456;

	/**
	 * Latitude for this invalid point.
	 * @var float $invalidPointLatitude
	 */
	protected $INVALID_POINTLATITUDE = 91.000000;

	/**
	 * Longitude for a valid point.
	 * @var float $pointLongitude
	 */
	protected $VALID_POINTLONGITUDE = -77.123456;

	/**
	 * Longitude for this invalid point.
	 * @var float $invalidPointLongitude
	 */
	protected $INVALID_POINTLONGITUDE = -181.000000;


	/**
	 * Create a point and assert the accessor methods return the correct values.
	 * Use the four argument version of assertEquals() to make sure float values are about equal.
	 * This is because 2.17117 should be the same as 2.171169999999999999999983.
	 *
	 * Never trust floating number results to the last digit,
	 * and do not compare floating point numbers  directly for equality.
	 */
	public function testValidPoint() {

		$point = new Point($this->VALID_POINTLATITUDE, $this->VALID_POINTLONGITUDE);

		$this->assertEquals($point->getPointLatitude(), $this->VALID_POINTLATITUDE, 'Expected latitude not equal to actual latitude, within 0.000001', 0.000001);

		$this->assertEquals($point->getPointLongitude(), $this->VALID_POINTLONGITUDE, 'Expected longitude not equal to actual longitude, within 0.000001', 0.000001);
	}


	/**
	 * Create a point that is out of range, and expect an exception to be thrown.
	 * We expect an exception because the data values are out of bounds,
	 * (e.g., latitude > 90 or < -90, or  longitude > 180 or < -180).
	 *
	 */
	public function testInvalidPoint() {

		$point = new Point($this->$INVALID_POINTLATITUDE, $this->$INVALID_POINTLONGITUDE);
	}
}