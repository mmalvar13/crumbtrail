<?php
namespace Edu\Cnm\Mmalvar13\CrumbTrail\Test;

use Edu\Cnm\CrumbTrail\{
	Test\CrumbTrailTest, Truck, Company
};

//grab the project test parameters
require_once("CrumbTrailTest.php");

//grab the class under scrutiny
require_once(dirname(__DIR__) . "/public_html/php/classes/autoload.php");

/**
 * Unite test for the truck class
 *
 * All mySQL/PDO enabled methods tested for valid and invalid inputs
 *
 * @see Truck
 * @author Victoria Chacon <victoriousdesignco@gmail.com>
 **/
class TruckTest extends CrumbTrailTest {
	//setting up made up variables to test
	/**
	 * content of the truck company id?
	 * @var int $VALID_TRUCKCOMPANYID
	 **/
}