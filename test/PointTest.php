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
 * @see Point
 * @author Kevin Lee Kirk
 *
 **/
class PointTest extends CrumbTrailTest {

	// Set the protected parameter values.
	/**
	 * latitude for this point
	 * @var float $pointLatitude
	 **/
	protected $VALID_POINTLATITUDE = 37.628134;
	/**
	 * updated latitude for this point
	 * @var float $pointLatitude
	 **/
	protected $VALID_POINTLATITUDE2 = 45.000001;

	/**
	 * longitude for this  point
	 * @var float $pointLongitude
	 **/
	protected $VALID_POINTLONGITUDE = -77.458334;
	/**
	 * updated longitude for this  point
	 * @var float $pointLongitude
	 **/
	protected $VALID_POINTLONGITUDE2 = -70.000001;


	// How do we test the Point class?

	// We can't use the methods involving the mySQL database, since the point data are not entered
	// into the database.
	// Test for distance between 2 points, both defined by latitude and longitude?    ?????

