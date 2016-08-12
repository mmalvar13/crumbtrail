<?php


namespace Edu\Cnm\CrumbTrail\Test;  /*LOOK INTO THIS FOR ACCURACY */


use Edu\Cnm\CrumbTrail\{Profile};

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
	 * Default input data set for name
	 * @var string $VALID_PROFILENAME1 //why is this in all caps, what's up with this syntax?
	 */
	protected $VALID_PROFILENAME1 = "Name";

	/**
	 * default input data for updated name
	 * @var string $VALID_PROFILENAME2
	 */
	protected $VALID_PROFILENAME2 = "NameUpdated";


	/**
	 * Default input data set for email
	 * @var string $VALID_PROFILEEMAIL1
	 */
	protected $VALID_PROFILEEMAIL1 = "email.cnm.edu";

	/**
	 * Default input data set for updated email
	 * @var string $VALID_PROFILEEMAIL2
	 */
	protected $VALID_PROFILEEMAIL2 = "emailupdated.cnm.edu";


	/**
	 * Default input data set profile phone 10 chars
	 * @var string $VALID_PROFILEPHONE1
	 */
	protected $VALID_PROFILEPHONE1 = "1111111111";

	/**
	 * Default input data set UPDATED profile phone 10 chars
	 * @var string $VALID_PROFILEPHONE2
	 */
	protected $VALID_PROFILEPHONE2 = "2222222222";


	/**
	 * Default input data set profile access token 64 chars
	 * @var string $VALID_PROFILEACCESSTOKEN1
	 */
	protected $VALID_PROFILEACCESSTOKEN1 = "0000000000000000000000000000000000000000000000000000000000004444";

	/**
	 * Default input data set UPDATED profile access token 64 chars
	 * @var string $VALID_PROFILEACCESSTOKEN2
	 */
	protected $VALID_PROFILEACCESSTOKEN2 = "9999999999999999999999999999999999999999999999999999999999994444";


	/**
	 * Default input data set profile activation token 32 chars
	 * @var string $VALID_PROFILEACTIVATIONTOKEN1
	 */
	protected $VALID_PROFILEACTIVATIONTOKEN1 = "00000000000000000000000000000022";

	/**
	 * Default input data set UPDATED profile activation token 32 chars
	 * @var string $VALID_PROFILEACTIVATIONTOKEN2
	 */
	protected $VALID_PROFILEACTIVATIONTOKEN2 = "99999999999999999999999999999922";


	/**
	 * Default input data set profile type
	 * @var string $VALID_PROFILETYPE1
	 */
	protected $VALID_PROFILETYPE1 = "a";

	/**
	 * Default input data set UPDATED profile type
	 * @var string $VALID_PROFILETYPE2
	 */
	protected $VALID_PROFILETYPE2 = "o";


	/**
	 * Default input data set profile hash 128 chars
	 * @var string $VALID_PROFILEHASH1
	 */
	protected $VALID_PROFILEHASH1 = null;

	/**
	 * Default input data set UPDATED profile hash 128 chars
	 * @var string $VALID_PROFILEHASH2
	 */
	protected $VALID_PROFILEHASH2 = null;


	/**
	 * Default input data set profile salt 64 chars
	 * @var string $VALID_PROFILESALT1
	 */
	protected $VALID_PROFILESALT1 = null;

	/**
	 * Default input data set UPDATED profile salt 64 chars
	 * @var string $VALID_PROFILESALT2
	 */
	protected $VALID_PROFILESALT2 = null;


	//AM I CORRECT IN ASSUMING i DONT NEED ANYTHING FOR THE PRIMARY KEY, AND i DONT HAVE ANY FOREIGN KEYS, SO NOTHING FOR THAT


	/**
	 * create dependent objects before running each test
	 */
	public final function setUp() {
		//run the default abstract setUp() method from parent first
		parent::setUp();

		//because I have no other classes that Profile is dependent on (no foreign keys in Profile), I dont have to create a mock profile to insert into
		//SQL to base everything off of

		//all I need to do is initialize the hash and salt needed for the profile

		$password = "abc123";

		$salt = bin2hex(random_bytes(16));
		$hash = hash_pbkdf2("sha512", $password, $salt, 262144);

		$this->VALID_PROFILESALT1 = $salt;
		$this->VALID_PROFILESALT2 = $salt;

		$this->VALID_PROFILEHASH1 = $hash;
		$this->VALID_PROFILEHASH2 = $hash;

	}


	/**
	 * test inserting a valid profile and verify that what's in mySQL matches what was input
	 */
	public function testInsertValidProfile() {
		// count the number of rows initially in the database (0)
		$numRows = $this->getConnection()->getRowCount("profile");  // so..get connection to SQL, and get the count of rows for a particular profile??

		//create a new profile and insert it into SQL
		$profile = new Profile(null, $this->VALID_PROFILENAME1, $this->VALID_PROFILEEMAIL1, $this->VALID_PROFILEPHONE1, $this->VALID_PROFILEACCESSTOKEN1, $this->VALID_PROFILEACTIVATIONTOKEN1, $this->VALID_PROFILETYPE1, $this->VALID_PROFILEHASH1, $this->VALID_PROFILESALT1);

		//insert the mock profile in SQL
		$profile->insert($this->getPDO());


		//NOW, grab the data from SQL and ensure the fields match our expectations

		//$pdoProfile is a new declaration...then we call our PDO get method: getProfileByProfileId which requires 2 parameters:
		//the first is a PDO object, the other is our profileId, which we use the accessor method we wrote (getProfileId) to get!
		// $pdoProfile now contains all the information for our dummy profile
		$pdoProfile = Profile::getProfileByProfileId($this->getPDO(), $profile->getProfileId());

		//make assertions here....be assertive

		//starting from the inside (right) and working out (left):
		//We are making sure that the two arguments inside the assertEquals() are in fact equal
		//on the left we $numRows which is assigned to the initial row count of the object profile (it's initially 0 because
		//nothing is in there yet
		//on right right we have the updated row count of the object profile after having inserted a dummy profile
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("profile"));

		//the following will all best testing to match that the data in the database matches the data we thought we put in the database
		$this->assertEquals($pdoProfile->getProfileName(), $this->VALID_PROFILENAME1);
		$this->assertEquals($pdoProfile->getProfileEmail(), $this->VALID_PROFILEEMAIL1);
		$this->assertEquals($pdoProfile->getProfilePhone(), $this->VALID_PROFILEPHONE1);
		$this->assertEquals($pdoProfile->getProfileAccessToken(), $this->VALID_PROFILEACCESSTOKEN1);
		$this->assertEquals($pdoProfile->getProfileActivationToken(), $this->VALID_PROFILEACTIVATIONTOKEN1);
		$this->assertEquals($pdoProfile->getProfileType(), $this->VALID_PROFILETYPE1);
		$this->assertEquals($pdoProfile->getProfileHash(), $this->VALID_PROFILEHASH1);
		$this->assertEquals($pdoProfile->getProfileSalt(), $this->VALID_PROFILESALT1);
	}


	/**
	 * test inserting a profile that already exists
	 * @expectedException \PDOException
	 **/
	public function testInsertInvalidProfile(){
		//create a profile with a non-null profileId and watch it fail. Uze the INVALID_KEY we defined inside the abstract class CrumbTrailTest
		//here we are calling an object ($profile) based on the Profile class and feeding it initial values. BUT whereas normally we would define the primary key as NULL
		//this time we are giving it a value (INVALID_KEY)
		$profile = new Profile(CrumbTrailTest::INVALID_KEY, $this->VALID_PROFILENAME1, $this->VALID_PROFILEEMAIL1, $this->VALID_PROFILEPHONE1, $this->VALID_PROFILEACCESSTOKEN1, $this->VALID_PROFILEACTIVATIONTOKEN1, $this->VALID_PROFILETYPE1, $this->VALID_PROFILEHASH1, $this->VALID_PROFILESALT1);

		//now insert it into SQL and hope it throws an error!
		//this uses the insert PDO method we wrote back in our class, and all the capabilities it has
		$profile->insert($this->getPDO());
	}



	/**
	 * test inserting a profile, editing it, and then updating it
	 */
	public function testUpdateValidProfile(){
		//count the initial number of rows and assign it to the variable $numRows
		$numRows = $this->getConnection()->getRowCount("profile");

		//create a new profile and insert it into SQL
		$profile = new Profile(null, $this->VALID_PROFILENAME1, $this->VALID_PROFILEEMAIL1, $this->VALID_PROFILEPHONE1, $this->VALID_PROFILEACCESSTOKEN1, $this->VALID_PROFILEACTIVATIONTOKEN1, $this->VALID_PROFILETYPE1, $this->VALID_PROFILEHASH1, $this->VALID_PROFILESALT1);

		//insert the mock profile in SQL
		$profile->insert($this->getPDO());

		//edit the profile and update it in SQL
		$profile->setProfileName($this->VALID_PROFILENAME2);
		$profile->setProfileEmail($this->VALID_PROFILEEMAIL2);
		$profile->setProfilePhone($this->VALID_PROFILEPHONE2);
		$profile->setProfileAccessToken($this->VALID_PROFILEACCESSTOKEN2);
		$profile->setProfileActivationToken($this->VALID_PROFILEACTIVATIONTOKEN2);
		$profile->setProfileType($this->VALID_PROFILETYPE2);
		$profile->setProfileHash($this->VALID_PROFILEHASH2);
		$profile->setProfileSalt($this->VALID_PROFILESALT2);

		//now call the update PDO method we wrote in the class
		$profile->update($this->getPDO());

		//now grab the data back out of SQL to make sure it matches what we put in

		//$pdoProfile is a new declaration...then we call our PDO get method: getProfileByProfileId which requires 2 parameters:
		//the first is a PDO object, the other is our profileId, which we use the accessor method we wrote (getProfileId) to get!
		// $pdoProfile now contains all the information for our dummy profile
		$pdoProfile = Profile::getProfileByProfileId($this->getPDO(), $profile->getProfileId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("profile"));

		//the following will all best testing to match that the data in the database matches the data we thought we put in the database
		$this->assertEquals($pdoProfile->getProfileName(), $this->VALID_PROFILENAME2);
		$this->assertEquals($pdoProfile->getProfileEmail(), $this->VALID_PROFILEEMAIL2);
		$this->assertEquals($pdoProfile->getProfilePhone(), $this->VALID_PROFILEPHONE2);
		$this->assertEquals($pdoProfile->getProfileAccessToken(), $this->VALID_PROFILEACCESSTOKEN2);
		$this->assertEquals($pdoProfile->getProfileActivationToken(), $this->VALID_PROFILEACTIVATIONTOKEN2);
		$this->assertEquals($pdoProfile->getProfileType(), $this->VALID_PROFILETYPE2);
		$this->assertEquals($pdoProfile->getProfileHash(), $this->VALID_PROFILEHASH2);
		$this->assertEquals($pdoProfile->getProfileSalt(), $this->VALID_PROFILESALT2);
	}



	/**
	 * test updating a profile that does not exist
	 */
	public function testUpdateInvalidProfile(){
		$profile = new Profile(null, $this->VALID_PROFILENAME1, $this->VALID_PROFILEEMAIL1, $this->VALID_PROFILEPHONE1, $this->VALID_PROFILEACCESSTOKEN1, $this->VALID_PROFILEACTIVATIONTOKEN1, $this->VALID_PROFILETYPE1, $this->VALID_PROFILEHASH1, $this->VALID_PROFILESALT1);

		//now that the dummy profile has been created, we WONT insert it, but instead try and update it in SQL
		$profile->update($this->getPDO());
	}



	/**
	 * test creating a profile and then 410'ing it
	 */
	public function testDeleteValidProfile(){
		//count the rows, assign that number to a variable, and save it for later
		$numRows = $this->getConnection()->getRowCount("profile");

		//create a dummy profile
		$profile = new Profile(null, $this->VALID_PROFILENAME1, $this->VALID_PROFILEEMAIL1, $this->VALID_PROFILEPHONE1, $this->VALID_PROFILEACCESSTOKEN1, $this->VALID_PROFILEACTIVATIONTOKEN1, $this->VALID_PROFILETYPE1, $this->VALID_PROFILEHASH1, $this->VALID_PROFILESALT1);

		//insert it into SQL
		$profile->insert($this->getPDO());

		//check to be sure that the profile was properly inserted
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("profile"));

		//delete the profile
		$profile->delete($this->getPDO());

		// $pdoProfile now contains all the information for our dummy profile
		$pdoProfile = Profile::getProfileByProfileId($this->getPDO(), $profile->getProfileId());
		//assert that its null
		$this->assertNull($pdoProfile);

		//assert that the rows are empty
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("profile"));

	}



	/**
	 * test deleting a profile that does NOT exist
	 */
	public function testDeleteInvalidProfile(){
		//create a profile and never actually insert it. Then try to delete it when it hasn't been inserted
		//why do we even need to create it then?

		//create a dummy profile
		$profile = new Profile(null, $this->VALID_PROFILENAME1, $this->VALID_PROFILEEMAIL1, $this->VALID_PROFILEPHONE1, $this->VALID_PROFILEACCESSTOKEN1, $this->VALID_PROFILEACTIVATIONTOKEN1, $this->VALID_PROFILETYPE1, $this->VALID_PROFILEHASH1, $this->VALID_PROFILESALT1);

		//now delete without inserting
		$profile->delete($this->getPDO());
	}


	/**
	 * test getting a profile by the profile name
	 */
	public function testGetProfileByProfileName(){
		//get number of initial rows (will be zero) and save it for later
		$numRows = $this->getConnection()->getRowCount("profile");

		//create a dummy profile
		$profile = new Profile(null, $this->VALID_PROFILENAME1, $this->VALID_PROFILEEMAIL1, $this->VALID_PROFILEPHONE1, $this->VALID_PROFILEACCESSTOKEN1, $this->VALID_PROFILEACTIVATIONTOKEN1, $this->VALID_PROFILETYPE1, $this->VALID_PROFILEHASH1, $this->VALID_PROFILESALT1);

		//insert the mock profile in SQL
		$profile->insert($this->getPDO());

		$results = Profile::getProfileByProfileName($this->getPDO(), $profile->getProfileName());

		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("profile"));

		//confirm we have just 1 profile in the database
		$this->assertCount(1, $results);

		//ensure there are only instances of the profile class in the namespace
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\CrumbTrail\\Profile", $results);

		//grab results from the array and validate them
		$pdoProfile = $results[0];
		//check if the stuff in the database matches the stuff we put in
		$this->assertEquals($pdoProfile->getProfileName(), $this->VALID_PROFILENAME1);
		$this->assertEquals($pdoProfile->getProfileEmail(), $this->VALID_PROFILEEMAIL1);
		$this->assertEquals($pdoProfile->getProfilePhone(), $this->VALID_PROFILEPHONE1);
		$this->assertEquals($pdoProfile->getProfileAccessToken(), $this->VALID_PROFILEACCESSTOKEN1);
		$this->assertEquals($pdoProfile->getProfileActivationToken(), $this->VALID_PROFILEACTIVATIONTOKEN1);
		$this->assertEquals($pdoProfile->getProfileType(), $this->VALID_PROFILETYPE1);
		$this->assertEquals($pdoProfile->getProfileHash(), $this->VALID_PROFILEHASH1);
		$this->assertEquals($pdoProfile->getProfileSalt(), $this->VALID_PROFILESALT1);
	}


	/**
	 * test getting profile by a name that does not exist
	 */
	public function testGetInvalidProfileByProfileName(){
		//grab a profile by searching for a name that doesn't exit
		$profile = Profile::getProfileByProfileName($this->getPDO(), "A girl has no name....");
		$this->assertCount(0,$profile);
	}




	/**
	 * test getting a profile by the profile email
	 */
	public function testGetProfileByProfileEmail(){
		//get number of initial rows (will be zero) and save it for later
		$numRows = $this->getConnection()->getRowCount("profile");

		//create a dummy profile
		$profile = new Profile(null, $this->VALID_PROFILENAME1, $this->VALID_PROFILEEMAIL1, $this->VALID_PROFILEPHONE1, $this->VALID_PROFILEACCESSTOKEN1, $this->VALID_PROFILEACTIVATIONTOKEN1, $this->VALID_PROFILETYPE1, $this->VALID_PROFILEHASH1, $this->VALID_PROFILESALT1);

		//insert the mock profile in SQL
		$profile->insert($this->getPDO());

		$results = Profile::getProfileByProfileEmail($this->getPDO(), $profile->getProfileEmail());

		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("profile"));

		//confirm we have just 1 profile in the database
		$this->assertCount(1, $results);

		//ensure there are only instances of the profile class in the namespace
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\CrumbTrail\\Profile", $results);

		//grab results from the array and validate them
		$pdoProfile = $results[0];
		//check if the stuff in the database matches the stuff we put in
		$this->assertEquals($pdoProfile->getProfileName(), $this->VALID_PROFILENAME1);
		$this->assertEquals($pdoProfile->getProfileEmail(), $this->VALID_PROFILEEMAIL1);
		$this->assertEquals($pdoProfile->getProfilePhone(), $this->VALID_PROFILEPHONE1);
		$this->assertEquals($pdoProfile->getProfileAccessToken(), $this->VALID_PROFILEACCESSTOKEN1);
		$this->assertEquals($pdoProfile->getProfileActivationToken(), $this->VALID_PROFILEACTIVATIONTOKEN1);
		$this->assertEquals($pdoProfile->getProfileType(), $this->VALID_PROFILETYPE1);
		$this->assertEquals($pdoProfile->getProfileHash(), $this->VALID_PROFILEHASH1);
		$this->assertEquals($pdoProfile->getProfileSalt(), $this->VALID_PROFILESALT1);
	}


	/**
	 * test getting profile by a email that does not exist
	 */
	public function testGetInvalidProfileByProfileEmail(){
		//grab a profile by searching for a name that doesn't exit
		$profile = Profile::getProfileByProfileEmail($this->getPDO(), "A man needs an email....");
		$this->assertCount(0,$profile);
	}



	/**
	 * test getting a profile by the profile phone
	 */
	public function testGetProfileByProfilePhone(){
		//get number of initial rows (will be zero) and save it for later
		$numRows = $this->getConnection()->getRowCount("profile");

		//create a dummy profile
		$profile = new Profile(null, $this->VALID_PROFILENAME1, $this->VALID_PROFILEEMAIL1, $this->VALID_PROFILEPHONE1, $this->VALID_PROFILEACCESSTOKEN1, $this->VALID_PROFILEACTIVATIONTOKEN1, $this->VALID_PROFILETYPE1, $this->VALID_PROFILEHASH1, $this->VALID_PROFILESALT1);

		//insert the mock profile in SQL
		$profile->insert($this->getPDO());

		$results = Profile::getProfileByProfilePhone($this->getPDO(), $profile->getProfilePhone());

		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("profile"));

		//confirm we have just 1 profile in the database
		$this->assertCount(1, $results);

		//ensure there are only instances of the profile class in the namespace
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\CrumbTrail\\Profile", $results);

		//grab results from the array and validate them
		$pdoProfile = $results[0];
		//check if the stuff in the database matches the stuff we put in
		$this->assertEquals($pdoProfile->getProfileName(), $this->VALID_PROFILENAME1);
		$this->assertEquals($pdoProfile->getProfileEmail(), $this->VALID_PROFILEEMAIL1);
		$this->assertEquals($pdoProfile->getProfilePhone(), $this->VALID_PROFILEPHONE1);
		$this->assertEquals($pdoProfile->getProfileAccessToken(), $this->VALID_PROFILEACCESSTOKEN1);
		$this->assertEquals($pdoProfile->getProfileActivationToken(), $this->VALID_PROFILEACTIVATIONTOKEN1);
		$this->assertEquals($pdoProfile->getProfileType(), $this->VALID_PROFILETYPE1);
		$this->assertEquals($pdoProfile->getProfileHash(), $this->VALID_PROFILEHASH1);
		$this->assertEquals($pdoProfile->getProfileSalt(), $this->VALID_PROFILESALT1);
	}


	/**
	 * test getting profile by a name that does not exist
	 */
	public function testGetInvalidProfileByProfilePhone(){
		//grab a profile by searching for a name that doesn't exit
		$profile = Profile::getProfileByProfilePhone($this->getPDO(), "A girl has no name....");
		$this->assertCount(0,$profile);
	}



	/**
	 * test getting all profiles
	 */
	public function testGetAllValidProfiles(){
		//count the initial number of rows (0) and save it for later
		$numRows = $this->getConnection()->getRowCount("profile");

		//create a dummy profile
		$profile = new Profile(null, $this->VALID_PROFILENAME1, $this->VALID_PROFILEEMAIL1, $this->VALID_PROFILEPHONE1, $this->VALID_PROFILEACCESSTOKEN1, $this->VALID_PROFILEACTIVATIONTOKEN1, $this->VALID_PROFILETYPE1, $this->VALID_PROFILEHASH1, $this->VALID_PROFILESALT1);

		//insert it into SQL
		$profile->insert($this->getPDO());

		//now get the data from SQL and make sure it matches our expectations
		$results = Profile::getAllProfiles($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("profile"));
		//confirm we have just 1 profile in the database
		$this->assertCount(1, $results);
		//ensure there are only instances of the profile class in the namespace
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\CrumbTrail\\Profile", $results);

		//grab results from the array and validate them
		$pdoProfile = $results[0];
		//check if the stuff in the database matches the stuff we put in
		$this->assertEquals($pdoProfile->getProfileName(), $this->VALID_PROFILENAME1);
		$this->assertEquals($pdoProfile->getProfileEmail(), $this->VALID_PROFILEEMAIL1);
		$this->assertEquals($pdoProfile->getProfilePhone(), $this->VALID_PROFILEPHONE1);
		$this->assertEquals($pdoProfile->getProfileAccessToken(), $this->VALID_PROFILEACCESSTOKEN1);
		$this->assertEquals($pdoProfile->getProfileActivationToken(), $this->VALID_PROFILEACTIVATIONTOKEN1);
		$this->assertEquals($pdoProfile->getProfileType(), $this->VALID_PROFILETYPE1);
		$this->assertEquals($pdoProfile->getProfileHash(), $this->VALID_PROFILEHASH1);
		$this->assertEquals($pdoProfile->getProfileSalt(), $this->VALID_PROFILESALT1);

	}


}




