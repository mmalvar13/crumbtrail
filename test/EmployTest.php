<?php
namespace Edu\Cnm\Mmalvar13\CrumbTrail\Test;

use Edu\Cnm\CrumbTrail\{
	Company, Profile, Employ, Test\CrumbTrailTest
};

//grab the project test parameters
require_once("CrumbTrailTest.php");

//grab the class under scrutiny
require_once(dirname(__DIR__) . "public_html/php/classes/autoload.php");

/**
 * Full PHPUnit test for the Employ class
 *
 * This is a complete PHPUnit test of the Employ class. It is complete because All mySQL/PDO methods are tested for both invalid and valid inputs
 **/
class Employ extends CrumbTrailTest{
	/**
	 * company that is employing this worker; this is a foreign key relation
	 * @var Company company
	 **/
	protected $company = null;

	/**
	 * profile of employee; this is a foreign key relation
	 * @var Profile profile
	 **/
	protected $profile = null;

	/**
	 *
	 **/
}