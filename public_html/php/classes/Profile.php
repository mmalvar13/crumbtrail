<?php

namespace Edu\Cnm\CrumbTrail;  /*LOOK INTO THIS FOR ACCURACY */
//require_once("autoload.php");

/**
 * class Profile for entity profile in crumbtrail application
 * this class contains all state variables, constructor, mutators, accessors, PDOs, and getFooByBar methods
 * @author Loren Baca
 */

class Profile implements \JsonSerializable{

//use ValidateDate;

/**
 * Primary key for Profile class is profileId
 * @var $profileId
 */
private $profileId;


/**
 * name of person who has profile
 * @var $profileName
 */
private $profileName;


	/**
	 * email linked to profile entity
	 * @var $profileEmail
	 */
	private $profileEmail;


	/**
	 * phone number linked to profile entity
	 * @var $profilePhone
	 */
	private $profilePhone;     /*WILL ANY OF THESE EVER NEED TO BE PUBLIC OR PROTECTED?? */


	/**
	 * access token state variable used to ??????????????????????????
	 * @var $profileAccessToken
	 */
	private $profileAccessToken;


	/**
	 * access token state variable used to activate a user submitted profile?????????????
	 * @var $profileActivationToken
	 */
	private $profileActivationToken;


	/**
	 * state variable used to identify the type of profile a user has
	 * @var $profileType
	 */
	private $profileType;


	/**
	 * salt for profile entity
	 * @var $profileSalt
	 */
	private $profileSalt;


	/**
	 * Hash for profile entity
	 * @var $profileHash
	 */
	private $profileHash;


	/**
	 * Profile constructor.
	 * @param int|null $newProfileId, null if it's a new profile
	 * @param string $newProfileName, humans name who created this profile
	 * @param string $newProfileEmail, humans email who created this profile
	 * @param string $newProfilePhone, humans phone who created this profile
	 * @param string $newProfileAccessToken, access token to later link social media to our app
	 * @param string $newProfileActivationToken, access token to activated a user profile application
	 * @param string $newProfileType, type of profile: 'a'(admin), 'o'(owner), or 'e'(employee)
	 * @param string $newProfileSalt
	 * @param string $newProfileHash
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 */
	public function __construct(int $newProfileId = null, string $newProfileName, string $newProfileEmail, string $newProfilePhone, string $newProfileAccessToken, string $newProfileActivationToken, string $newProfileType, string $newProfileHash, string $newProfileSalt) {

		//try statements
		try{
			//WHY ARE ALL OF THESE RED? SAYING THEY AREN'T DEFINED? WILL THEY BE FIXED ONCE WE MAKE THE PDO?
			$this->setProfileId($newProfileId);
			$this->setProfileName($newProfileName);
			$this->setProfileEmail($newProfileEmail);
			$this->setProfilePhone($newProfilePhone);
			$this->setProfileAccessToken($newProfileAccessToken);
			$this->setProfileActivationToken($newProfileActivationToken);
			$this->setProfileType($newProfileType);
			$this->setProfileHash($newProfileHash);
			$this->setProfileSalt($newProfileSalt);

		} catch(\InvalidArgumentException $invalidArgument) {
			// rethrow the exception to the caller
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			// rethrow the exception to the caller
			throw(new \RangeException($range->getMessage(), 0, $range));
		} catch(\TypeError $typeError) {
			// rethrow the exception to the caller
			throw(new \TypeError($typeError->getMessage(), 0, $typeError));
		} catch(\Exception $exception) {
			// rethrow the exception to the caller
			throw(new \Exception($exception->getMessage(), 0, $exception));
		}

	}

/*--------------------ACCESSOR SECTION HERE---------------------------*/

/**
 * gets profile by the profile ID
 * @param \PDO $pdo PDO connection object
 * @param int $profileId used as the profileId to search for
 * @return Profile|null Profile found or null if not found  ***Why is profile capitalized?? referencing the class??****
 * @throws \PDOException when mySQL related errors occur
 * @throws \TypeError when variables are not the correct data type
 */
public static function getProfileByProfileId(\PDO $pdo, int $profileId){
	//sanitize the ID before searching for it
	if($profileId <= 0){
		throw(new \PDOException("The profile ID is negative or zero"));
	}
	//create query template
	$query = "SELECT profileId, profileName, profileEmail, profilePhone, profileAccessToken, profileActivationToken, profileType, profileHash, profileSalt FROM profile WHERE profileId = :profileId";

	//prepare template
	$statement = $pdo->prepare($query);

	//bind the profileId to the placeholder in the template ***WHY JUST TO PROFILE ID?***
	$parameters = ["profileId"=>$profileId];
	//execute the SQL statement
	$statement->execute($parameters);

	//now that we have selected the correct profile, we need to grab it from mySQL
	try{
		$profile = null;   //new variable $profile is what we will assign all the information in this profile to, and return to whatever called this method
		$statement->setFetchMode(\PDO::FETCH_ASSOC); //what is going on here? establishing the fetch mode for this method?
		//$row is an empty array I think
		$row = $statement->fetch(); //create new variable and assign it to $statement which is pointing to the value of fetch???

		//what does it mean for the row to be false?? That the row is empty? Couldnt be retrieved???
		if($row !== false){
			//set $profile to a new object based on the Profile class with these values assigned into it (I think)
			$profile = new Profile($row["profileId"], $row["profileName"], $row["profileEmail"], $row["profilePhone"], $row["profileAccessToken"], $row["profileActivationToken"], $row["profileType"], $row["profileHash"], $row["profileSalt"]);
		}
		//catch statement
	} catch(\Exception $exception){
		// if the row couldnt be converted, re-throw it
		throw(new \PDOException($exception->getMessage(), 0, $exception));
	}
	return($profile);
}

/**
* gets profile by the profile name
* @param \PDO $pdo PDO connection object
* @param string $profileName used as the profile name to search for
* @return Profile|null Profile found or null if not found
* @throws \PDOException when mySQL related errors occur
* @throws \TypeError when variables are not the correct data type
*/
	public static function getProfileByProfileName(\PDO $pdo, string $profileName){
		//sanitize the ID before searching for it
		if(strlen($profileName) === 0){
			throw(new \PDOException("The profile name is empty"));
		}
		//create query template
		$query = "SELECT profileId, profileName, profileEmail, profilePhone, profileAccessToken, profileActivationToken, profileType, profileHash, profileSalt FROM profile WHERE profileName = :profileName";

		//prepare template
		$statement = $pdo->prepare($query);

		//bind the profileId to the placeholder in the template ***WHY JUST TO PROFILE Name?***
		$parameters = ["profileName"=>$profileName];
		//execute the SQL statement
		$statement->execute($parameters);

		//now that we have selected the correct profile, we need to grab it from mySQL
		try{
			$profile = null;   //new varible $profile is what we will assign all the information in this profile to, and return to whatever called this method
			$statement->setFetchMode(\PDO::FETCH_ASSOC); //what is going on here? establishing the fetch mode for this method?
			//$row is an empty array I think
			$row = $statement->fetch(); //create new variable and assign it to $statement which is pointing to the value of fetch???

			//what does it mean for the row to be false?? That the row is empty? Couldn't be retrieved???
			if($row !== false){
				//set $profile to a new object based on the Profile class with these values assigned into it (I think)
				$profile = new Profile($row["profileId"], $row["profileName"], $row["profileEmail"], $row["profilePhone"], $row["profileAccessToken"], $row["profileActivationToken"], $row["profileType"], $row["profileHash"], $row["profileSalt"]);
			}
			//catch statement
		} catch(\Exception $exception){
			// if the row couldnt be converted, re-throw it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($profile);
	}

	/**
	 * gets profile by the profile email
	 * @param \PDO $pdo PDO connection object
	 * @param string $profileEmail used as the profile email to search for
	 * @return Profile|null Profile found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 */
	public static function getProfileByProfileEmail(\PDO $pdo, string $profileEmail){
		//sanitize the ID before searching for it
		if(strlen($profileEmail) === 0){
			throw(new \PDOException("The profile email is empty"));
		}
		//create query template
		$query = "SELECT profileId, profileName, profileEmail, profilePhone, profileAccessToken, profileActivationToken, profileType, profileHash, profileSalt FROM profile WHERE profileEmail = :profileEmail";

		//prepare template
		$statement = $pdo->prepare($query);

		//bind the profileId to the placeholder in the template ***WHY JUST TO PROFILE Name?***
		$parameters = ["profileEmail"=>$profileEmail];
		//execute the SQL statement
		$statement->execute($parameters);

		//now that we have selected the correct profile, we need to grab it from mySQL
		try{
			$profile = null;   //new varible $profile is what we will assign all the information in this profile to, and return to whatever called this method
			$statement->setFetchMode(\PDO::FETCH_ASSOC); //what is going on here? establishing the fetch mode for this method?
			//$row is an empty array I think
			$row = $statement->fetch(); //create new variable and assign it to $statement which is pointing to the value of fetch???

			//what does it mean for the row to be false?? That the row is empty? Couldnt be retrieved???
			if($row !== false){
				//set $profile to a new object based on the Profile class with these values assigned into it (I think)
				$profile = new Profile($row["profileId"], $row["profileName"], $row["profileEmail"], $row["profilePhone"], $row["profileAccessToken"], $row["profileActivationToken"], $row["profileType"], $row["profileHash"], $row["profileSalt"]);
			}
			//catch statement
		} catch(\Exception $exception){
			// if the row couldnt be converted, re-throw it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($profile);
	}

	/**
	 * gets profile by the profile phone
	 * @param \PDO $pdo PDO connection object
	 * @param string $profilePhone used as the profile phone to search for
	 * @return Profile|null Profile found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 */
	public static function getProfileByProfilePhone(\PDO $pdo, string $profilePhone){
		//sanitize the ID before searching for it
		//do we want to enforce a 10 digit phone number
		if(strlen($profilePhone) < 7){
			throw(new \PDOException("The profile phone number is too short"));
		}

		//create query template
		$query = "SELECT profileId, profileName, profileEmail, profilePhone, profileAccessToken, profileActivationToken, profileType, profileHash, profileSalt FROM profile WHERE profilePhone = :profilePhone";

		//prepare template
		$statement = $pdo->prepare($query);

		//bind the profilePhone to the placeholder in the template ***WHY JUST TO PROFILE phone?***
		$parameters = ["profilePhone"=>$profilePhone];
		//execute the SQL statement
		$statement->execute($parameters);

		//now that we have selected the correct profile, we need to grab it from mySQL
		try{
			$profile = null;   //new varible $profile is what we will assign all the information in this profile to, and return to whatever called this method
			$statement->setFetchMode(\PDO::FETCH_ASSOC); //what is going on here? establishing the fetch mode for this method?
			//$row is an empty array I think
			$row = $statement->fetch(); //create new variable and assign it to $statement which is pointing to the value of fetch???

			//what does it mean for the row to be false?? That the row is empty? Couldnt be retrieved???
			if($row !== false){
				//set $profile to a new object based on the Profile class with these values assigned into it (I think)
				$profile = new Profile($row["profileId"], $row["profileName"], $row["profileEmail"], $row["profilePhone"], $row["profileAccessToken"], $row["profileActivationToken"], $row["profileType"], $row["profileHash"], $row["profileSalt"]);
			}
			//catch statement
		} catch(\Exception $exception){
			// if the row couldnt be converted, re-throw it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($profile);
	}

/**
 * accessor method for profileId
 * @return int|null value for profileId
 */
public function getProfileId(){
	return($this-> profileId);
}

/**
 * mutator method for profileId
 * @param int|null  use $newProfileId to assign a new value to profileId
 * @throws \RangeException if $newProfileId is not positive
 * @throws \TypeError if $newProfileId is not an integer
 **/
	public function setProfileId(int $newProfileId = null){
		//create a base case where this is a new profile and profileId is null with no SQL assigned ID yet!
		// is this because set ProofileId takes in one argument, which then gets assigned to $newProfileId???
		//ASK ON THIS!!!!!
		if($newProfileId === null){
			$this->profileId = null;
			return;
		}

		//check to see if $newProfileId is positive
		if($newProfileId <= 0){
			throw(new \RangeException("The profile ID is not positive!"));
		}

		//convert and store the new profileId
		$this->profileId = $newProfileId;
	}

	/**
	 * accessor method for profileName
	 * @return string value for profileName
	 */
	public function getProfilename(){
		return($this-> profileName);
	}

	/**
	 * mutator method for profileName
	 * @param string, $newProfileName used to update profileName
	 * @throw \RangeException if $newProfileName is empty or too long
	 * @throw \InvalidArgumentException if $newProfileName is not a string
	 * @throw \TypeError if $newProfileName is not a string
	 */
	public function setProfileName(string $newProfileName){
		//first we need to strip out all the white space on either end of $newProfileName
		$newProfileName = trim($newProfileName);
		//Then we must sanitize $newProfileName
		$newProfileName = filter_var($newProfileName, FILTER_SANITIZE_STRING);
		//now check if $newProfileName is either empty or too long
		if(strlen($newProfileName) === 0){
			throw(new \RangeException("Profile name is too short"));
			}

		if(strlen($newProfileName > 128)){
			throw(new \RangeException("Profile name is too long"));
		}
		//now assign $newProfileName to profileName and store in SQL
		$this->profileName = $newProfileName;
	}

	/**
	 * accessor method for profileEmail
	 * @return string value for profileEmail
	 */
	public function getProfileEmail(){
		return($this-> profileEmail);
	}



	/*--------------------------MUTATOR SECTION HERE------------------------------------------------*/

	/**
	 * mutator method for profileEmail
	 * @param string, $newProfileEmail used to assign new value of profileEmail
	 * @throws \InvalidArgumentException if $newProfileEmail is not a string or is insecure
	 * @throws \RangeException if $newProfileEmail is longer than 128 char
	 * @throws \TypeError if $newProfileEmail is not a string
	 */
	public function setProfileEmail(string $newProfileEmail){
		// first take out any white space on $newProfileEmail
		$newProfileEmail = trim($newProfileEmail);
		//next ensure that $newProfileEmail is sanitized
		$newProfileEmail = filter_var($newProfileEmail, FILTER_SANITIZE_EMAIL);

		//ensure that $newProfileEmail isnt empty
		if(strlen($newProfileEmail)=== 0){
			throw(new \RangeException("The email entered is empty"));
		}

		//ensure $newProfileEmail isn't too long
		if(strlen($newProfileEmail) > 128){
			throw(new \RangeException("email entered is too long"));
		}

		//assign new email to profileEmail and enter it in mySQL
		$this->profileEmail = $newProfileEmail;
	}

	/**
	 * accessor method for profilePhone
	 * @return string value for profilePhone  **WOULD THIS BE A STRING SINCE PHONE NUMBERS CAN BE VARIABLE LENGTHS?
	 */
	public function getProfilePhone(){
		return($this-> profilePhone);
	}

	/**
	 * mutator method for profilePhone
	 * @param string, $newProfilePhone used to assign new value of profilePhone
	 * @throws \InvalidArgumentException if $newProfilePhone is not a string or is insecure
	 * @throws \RangeException if $newProfilePhone is longer than 32 char
	 * @throws \TypeError if $newProfilePhone is not a string
	 */
	public function setProfilePhone(string $newProfilePhone){
		// first take out any white space on $newProfilePhone
		$newProfilePhone = trim($newProfilePhone);
		//next ensure that $newProfilePhone is sanitized
		$newProfilePhone = filter_var($newProfilePhone, FILTER_SANITIZE_STRING);

		//ensure that $newProfilePhone isnt empty
		if(strlen($newProfilePhone)< 10){
			throw(new \RangeException("The phone number entered is too short. Please enter a phone number including 3 digit area-code"));
		}

		if(strlen($newProfilePhone) < 10){   //what do we need to do to ensure a valid phone number
			throw(new \RangeException("Please enter a complete phone number starting with area-code"));
		}

		//ensure $newProfilePhone isn't too long
		if(strlen($newProfilePhone) > 32){
			throw(new \RangeException("Phone number entered is too long"));
		}

		//assign new email to $newProfilePhone and enter it in mySQL
		$this->profilePhone = $newProfilePhone;
	}

	/**
	 * accessor method for profileAccessToken
	 * @return string value for profileAccessToken  **AGAIN, WOULD THIS BE A STRING OR INT VALUE??
	 */
	public function getProfileAccessToken(){
		return($this-> profileAccessToken);
	}

	/**
	 * *********LOOK INTO THIS ONE HOW IS THIS TOKEN GENERATED??***********
	 * mutator method for profileAccessToken
	 * @param string, $newProfileAccessToken used to assign new value of profileAccessToken
	 * @throws \InvalidArgumentException if $newProfileAccessToken is not a string or is insecure
	 * @throws \RangeException if $newProfileAccessToken is longer than 64 char
	 * @throws \TypeError if $newProfileAccessToken is not a string
	 */
	public function setProfileAccessToken(string $newProfileAccessToken){
		// first take out any white space on $newProfileAccessToken
		$newProfileAccessToken = trim($newProfileAccessToken);
		//next ensure that $newProfileAccessToken is sanitized
		$newProfileAccessToken = filter_var($newProfileAccessToken, FILTER_SANITIZE_STRING);

		//ensure that $newProfileAccessToken isnt empty ***CHECK ON THIS ONE!!!!!!!!!!!!!!!, How should it be????
		if(strlen($newProfileAccessToken)=== 0){
			throw(new \RangeException("The access token is too short"));
		}

		//ensure $newProfileAccessToken isn't too long
		if(strlen($newProfileAccessToken) > 64){
			throw(new \RangeException("Access token is too long"));
		}

		//assign new token to $profileAccessToken and enter it in mySQL
		$this->profileAccessToken = $newProfileAccessToken;
	}

	/**
	 * accessor method for profileActivationToken
	 * @return string value for profileActivationToken
	 */
	public function getProfileActivationToken(){
		return($this-> profileActivationToken);
	}

	/**
	 * *********LOOK INTO THIS ONE AS WELL HOW ARE THESE TOKENS GENERATED?***********
	 * mutator method for profileActivationToken
	 * @param string, $newProfileActivationToken used to assign new value of profileActivationToken
	 * @throws \InvalidArgumentException if $newProfileActivationToken is not a string or is insecure
	 * @throws \RangeException if $newProfileActivationToken is longer than 32 char
	 * @throws \TypeError if $newProfileActivationToken is not a string
	 */
	public function setProfileActivationToken(string $newProfileActivationToken){
		// first take out any white space on $newProfileActivationToken
		$newProfileActivationToken = trim($newProfileActivationToken);
		//next ensure that $newProfileAccessToken is sanitized
		$newProfileActivationToken = filter_var($newProfileActivationToken, FILTER_SANITIZE_STRING);

		//ensure that $newProfileActivationToken isnt empty ***CHECK ON THIS ONE!!!!!!!!!!!!!!!, How should it be????
		if(strlen($newProfileActivationToken)=== 0){
			throw(new \RangeException("The activation token is too short"));
		}

		//ensure $newProfileActivationToken isn't too long
		if(strlen($newProfileActivationToken) > 32){
			throw(new \RangeException("Activation token is too long"));
		}

		//assign new activation token to $profileActivationToken and enter it in mySQL
		$this->profileActivationTokenToken = $newProfileActivationToken;
	}

	/**
	 * accessor method for profileType
	 * @return string value for profileType
	 */
	public function getProfileType(){
		return($this-> profileType);
	}

	/**
	 * CHECK ON THIS ONE
	 * mutator method for profileType
	 * @param string $newProfileType will be used to change the value of profileType
	 * @throws \InvalidArgumentException if the input value for $newProfileType is anything besides:
	 * 	a(admin), o(owner), e(employee), or is insecure or not a string
	 * @throws \RangeException if the input for $newProfileType is longer than 1
	 * @throws \TypeError if $newProfileType is not a string
	 */
	public function setProfileType(string $newProfileType){
		//strip out any white space
		$newProfileType = trim($newProfileType);
		//sterilize string
		$newProfileType = filter_var($newProfileType, FILTER_SANITIZE_STRING);

		//ensure input for $newProfileType is not empty
		if(strlen($newProfileType)===0){
			throw(new \RangeException("Please designate a profile type by entering a single letter: 'a'(admin), 'o'(owner), or 'e'(employee)"));
		}

		//ensure input for $newProfileType is valid
		if(strlen($newProfileType)>1){
			throw(new \InvalidArgumentException("Invalid profile type. Please designate a profile type by entering a single letter: 'a'(admin), 'o'(owner), or 'e'(employee)"));
		}

		//make sure $newProfileType matches one of the required types (a,o,e)
		if($newProfileType !== ('a'||'o'||'e')){
			throw(new \InvalidArgumentException("Invalid profile type. Please designate a profile type by entering a single letter: 'a'(admin), 'o'(owner), or 'e'(employee)"));
		}

		//set profileType to $newProfileType and give it an assignment in SQL
		$this->profileType = $newProfileType;
	}


/*-------------------------------PDO SECTION HERE--------------------------------------*/

	/**
	 * accessor method for profileSalt
	 * @return string value for profileSalt
	 */
	public function getProfileSalt(){
		return($this-> profileSalt);
	}

	/**
	 * CHECK ON THIS ONE!!!!!
	 * mutator method for profileSalt
	 * @param string, $newProfileSalt used to update profileSalt
	 * @throw \RangeException if $newProfileSalt is empty or too long
	 * @throw \InvalidArgumentException if $newProfileSalt is not a string
	 * @throw \TypeError if $newProfileSalt is not a string
	 */
	public function setProfileSalt(string $newProfileSalt){
		//first we need to strip out all the white space on either end of $newProfileSalt
		$newProfileSalt = trim($newProfileSalt);
		//Then we must sanitize $newProfileSalt
		$newProfileSalt = filter_var($newProfileSalt, FILTER_SANITIZE_STRING); //SHOULD I USE ENCODE FOR THIS?????
		//now check if $newProfileSalt is either empty or too long
		if(strlen($newProfileSalt) === 0){
			throw(new \RangeException("Profile salt is too short"));
		}

		//gotta check if the salt is c_type x-digit
		if(!ctype_xdigit($newProfileSalt)){
			throw(new \InvalidArgumentException("The salt supplied does not contain c_type xdigit"));
		}

		//**doesnt salt and hash need to be EXACTLY the designated length?? CHECK ON THIS!!**
		if(strlen($newProfileSalt) !== 64){
			throw(new \RangeException("Profile salt should be exactly 64 characters long"));
		}
		//now assign $newProfileSalt to profileSalt and store in SQL
		$this->profileSalt = $newProfileSalt;
	}

	/**
	 * accessor method for profileHash
	 * @return string value for profileHash
	 */
	public function getProfileHash(){
		return($this-> profileHash);
	}

	/**
	 * CHECK ON THIS ONE TOO!!!!!
	 * mutator method for profileHash
	 * @param string, $newProfileHash used to update profileHash
	 * @throw \RangeException if $newProfileHash is empty or too long
	 * @throw \InvalidArgumentException if $newProfileHash is not a string
	 * @throw \TypeError if $newProfileHash is not a string
	 */
	public function setProfileHash(string $newProfileHash){
		//first we need to strip out all the white space on either end of $newProfileHash
		$newProfileHash = trim($newProfileHash);
		//Then we must sanitize $newProfileHash
		$newProfileHash = filter_var($newProfileHash, FILTER_SANITIZE_STRING); //SHOULD I USE ENCODE FOR THIS?????
		//now check if $newProfileHash is either empty or too long
		if(strlen($newProfileHash) === 0){
			throw(new \RangeException("Profile hash is too short"));
		}

		//gotta check if the salt is c_type x-digit
		if(!ctype_xdigit($newProfileHash)){
			throw(new \InvalidArgumentException("The hash supplied does not contain c_type xdigit"));
		}

		//**doesnt salt and hash need to be EXACTLY the designated length?? CHECK ON THIS!!**
		if(strlen($newProfileHash) !== 128){
			throw(new \RangeException("Profile hash should be exactly 128 characters long"));
		}
		//now assign $newProfileSalt to profileSalt and store in SQL
		$this->profileHash = $newProfileHash;
	}

/**
 * inserts this profile into mySQL
 *
 * @param \PDO $pdo is the PDO connection object
 * @throws \PDOException when mySQL related errors occur
 * @throws \TypeError if $pdo is not a PDO connection object
 * SINCE THIS IS FOR A NEW PROFILE INSERT, DO NOT INCLUDE profileId in the template or array
 **/

	public function insert(\PDO $pdo){
		//ensure that the profileId is null, dont want to insert a profileId that already exists. This prevents modifying a primary key
		if($this->profileId !== null){
			throw(new \PDOException("This is not a new profileId"));
		}

		//create query template do NOT include profileId in this list because it's a new profile you're inserting (I THINK)
		$query = "INSERT INTO profile(profileName, profileEmail, profilePhone, profileAccessToken, profileActivationToken, profileType, profileSalt, profileHash) VALUES(:profileName, :profileEmail, :profilePhone, :profileAccessToken, :profileActivationToken, :profileType, :profileSalt, :profileHash)";

		//prepare is used as an extra means of security
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holder slots in the template. putting these into an array
		$parameters = ["profileName"=>$this->profileName, "profileEmail"=>$this->profileEmail, "profilePhone"=>$this->profilePhone, "profileAccessToken"=>$this->profileAccessToken, "profileActivationToken"=>$this->profileActivationToken, "profileType"=>$this->profileType, "profileSalt"=>$this->profileSalt, "profileHash"=>$this->profileHash];

		//execute the command held in $statement
		$statement->execute($parameters);

		//update the null profileId. Ask mySQL for the primary key value it assigned to this entry
		$this->profileId = intval($pdo->lastInsertId());
	}

	/**
	 * deletes this profile from the mySQL database
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo){
		//first check to make sure the profileId isn't null, cant delete something that hasn't been entered into SQL yet
		if($this->profileId === null){
			throw(new \PDOException("The profile you selected does not exist"));
		}

		//create the query template
		$query = "DELETE FROM profile WHERE profileId = :profileId";
		$statement = $pdo->prepare($query);

		//bind parameters and execute the function
		$parameters = ["profileId"=>$this->profileId];
		$statement->execute($parameters);
	}

	/**
	 * PDO statement to update this profile in mySQL
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 */

	public function update(\PDO $pdo){
			//ensure that this profile is not null (hasn't been entered into SQL). Can't update something that doesn't exist
		if($this->profileId === null){
			throw(new \PDOException("Can't update a profile that doesn't exist"));
		}

		//create a query template ***ASK ABOUT THIS, WHAT PARTS OF PROFILE IS THIS ACTUALLY LETTING US UPDATE
		$query = "UPDATE profile SET profileName = :profileName, profilePhone = :profilePhone, profileAccessToken = :profileAccessToken, profileActivationToken = :profileActivationToken, profileType = :profileType, profileHash = :profileHash, profileSalt = :profileSalt WHERE profileId = :profileId";
		// prepare statement
		$statement = $pdo->prepare($query);

		//bind the variables to the template and execute the SQL command (is that correct?) Why is the primary key last in the array????
		//should $parameters always have every every entry that's in the selected table??
		$parameters = ["profileName"=>$this->profileName, "profileEmail"=>$this->profileEmail, "profilePhone"=>$this->profilePhone, "profileAccessToken"=>$this->profileAccessToken, "profileActivationToken"=>$this->profileActivationToken, "profileType"=>$this->profileType, "profileSalt"=>$this->profileSalt, "profileHash"=>$this->profileHash, "profileId"=>$this->profileId];
		//execute
		$statement->execute($parameters);
}

	/**
	 * gets all Profiles  **WHY IS Profile CAPITALIZED**
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of Profiles found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public function getAllProfiles(\PDO $pdo){
		//create query template
		$query = "SELECT profileId, profileName, profileEmail, profilePhone, profileAccessToken, profileActivationToken, profileType, profileHash, profileSalt FROM profile";

		//assume this $pdo object is created somewhere else, we just take it and use it here
		//prepare does a bunch of security prep on the $query template, getting it ready for SQL
		$statement = $pdo->prepare($query); //statement is assigned to the $pdo prepared object!! not the initial $pdo object
		$statement->execute();

		//build an array to put all the profiles into. What does the *new* keyword do??
		$profiles = new \SplFixedArray($statement->rowCount());  //make an array fixed to the length of the row count found in statement, which has the complete list of profiles
		$statement->setFetchMode(\PDO::FETCH_ASSOC); //still not exactly sure what this does

		//find out what this while-loop is actually doing
		while(($row = $statement->fetch()) !==false){
			try{

				//this is getting the value from each of these keys in the array called $row
				$profile = new Profile($row["profileId"], $row["profileName"], $row["profileEmail"], $row["profilePhone"], $row["profileAccessToken"], $row["profileActivationToken"], $row["profileType"], $row["profileHash"], $row["profileSalt"]);

				//now we are taking each profile and putting it into the array called $profiles which will collect all the profiles we have!
				$profiles[$profiles->key()]=$profile; //inserts the first entry from the $profile array
				$profiles->next();  //next increments the key in the fixed array $profiles
				//profile array to enter!!
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($profiles);
	}


	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		return($fields);
	}
}