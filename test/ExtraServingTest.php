<?php

namespace Edu\Cnm\CrumbTrail\Test;  /*LOOK INTO THIS FOR ACCURACY */


use Edu\Cnm\CrumbTrail\{
	Profile, Company, ExtraServing
};

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

	protected $profile = null;
	protected $company = null;

	/**
	 * Default input data set for extra serving description
	 * @var string $VALID_EXTRASERVINGDESCRIPTION1 //why is this in all caps, what's up with this syntax?
	 */
	protected $VALID_EXTRASERVINGDESCRIPTION1 = "Valid description 1";

	/**
	 * Default input data set for extra serving description
	 * @var string $VALID_EXTRASERVINGDESCRIPTION2
	 */
	protected $VALID_EXTRASERVINGDESCRIPTION2 = "UPDATED Valid description 2";


	/**
	 * timestamp for extraServingEndTime
	 * @var \DateTime $VALID_EXTRASERVINGENDTIME1
	 **/
	protected $VALID_EXTRASERVINGENDTIME1 = null;

	/**
	 * timestamp for extraServingEndTime
	 * @var \DateTime $VALID_EXTRASERVINGENDTIME2
	 **/
	protected $VALID_EXTRASERVINGENDTIME2 = null;


	/**
	 * Default input data set for extra serving location address
	 * @var string $VALID_EXTRASERVINGLOCATIONADDRESS1
	 */
	protected $VALID_EXTRASERVINGLOCATIONADDRESS1 = "1111 serving street dr NE albuquerque NM. 87111";

	/**
	 * Default input data set for extra serving location address
	 * @var string $VALID_EXTRASERVINGLOCATIONADDRESS2
	 */
	protected $VALID_EXTRASERVINGLOCATIONADDRESS2 = "2222 eating drive dr NE albuquerque NM. 87222";


	/**
	 * Default input data set for extra serving location name (name of the event the company is attending)
	 * @var string $VALID_EXTRASERVINGLOCATIONNAME1
	 */
	protected $VALID_EXTRASERVINGLOCATIONNAME1 = " 29th Eating Food Festival";

	/**
	 * Default input data set for extra serving location name (name of the event the company is attending)
	 * @var string $VALID_EXTRASERVINGLOCATIONNAME2
	 */
	protected $VALID_EXTRASERVINGLOCATIONNAME2 = " 30th Eating Food Festival part deu 'double trouble'";


	/**
	 * timestamp for extraServingStartTime
	 * @var \DateTime $VALID_EXTRASERVINGSTARTTIME1
	 **/
	protected $VALID_EXTRASERVINGSTARTTIME1 = null;

	/**
	 * timestamp for extraServingEndTime
	 * @var \DateTime $VALID_EXTRASERVINGSTARTTIME2
	 **/
	protected $VALID_EXTRASERVINGSTARTTIME2 = null;


//	----------------------CREATE DEPENDENT OBJECTS BEFORE TESTING--------------------------------------

public final function setUp(){

	parent::setUp();

	//create a insert for a dummy company so we have a foreign key to profile
	//create and insert a Profile to own the test Employ
	$password = "abc123";
	$salt = bin2hex(random_bytes(16));
	$hash = hash_pbkdf2("sha512", $password, $salt, 262144);


	$this->profile = new Profile(null, "Loren", "lorenisthebest@gmail.com", "5057303164", "0000000000000000000000000000000000000000000000000000000000004444", "00000000000000000000000000000022","a", $hash, $salt);
	$this->profile->insert($this->getPDO());

	$pdoProfile = Profile::getProfileByProfileId($this->getPDO(), $this->profile->getProfileId());


	//create and insert a Company to own the test Employ
	$this->company = new Company(null, $pdoProfile->getProfileId(), "Terry's Tacos", "terrytacos@tacos.com", "5052345678", "12345", "2345", "attn: MR taco", "345 Taco Street", "taco street 2", "Albuquerque", "NM", "87654", "We are a Taco truck description", "Tacos, Tortillas, Burritos","848484", 0);
	$this->company->insert($this->getPDO());

	$pdoCompany = Company::getCompanyByCompanyId($this->getPDO(), $this->company->getCompanyId());




}








}