<?php

namespace Edu\Cnm\mmalvar13\crumbtrail;  /*LOOK INTO THIS FOR ACCURACY */
require_once("autoload.php");

/**
 * class Profile for entity profile in crumbtrail application
 * this class contains all state variables, constructor, mutators, accessors, PDOs, and getFooByBar methods
 * @author Loren Baca
 */

class Profile {

use ValidateDate;

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
	 * Constructor for Profile Class will go here!!!!
	 */
	public function __construct() {

		/*FILL THIS IN, WE GON" NEED IT */
	}

/*--------------------ACCESSOR SECTION HERE---------------------------*/

/**
 * accessor method for profileId
 * @return int|null value for profileId
 */
public function getProfileId(){
	return($this-> profileId);
}


	/**
	 * accessor method for profileName
	 * @return string value for profileName
	 */
	public function getProfilename(){
		return($this-> profileName);
	}


	/**
	 * accessor method for profileEmail
	 * @return string value for profileEmail
	 */
	public function getProfileEmail(){
		return($this-> profileEmail);
	}


	/**
	 * accessor method for profilePhone
	 * @return string value for profilePhone  **WOULD THIS BE A STRING SINCE PHONE NUMBERS CAN BE VARIABLE LENGTHS?
	 */
	public function getProfilePhone(){
		return($this-> profilePhone);
	}


	/**
	 * accessor method for profileAccessToken
	 * @return string value for profileAccessToken  **AGAIN, WOULD THIS BE A STRING OR INT VALUE??
	 */
	public function getProfileAccessToken(){
		return($this-> profileAccessToken);
	}


	/**
	 * accessor method for profileActivationToken
	 * @return string value for profileActivationToken
	 */
	public function getProfileActivationToken(){
		return($this-> profileActivationToken);
	}


	/**
	 * accessor method for profileType
	 * @return string value for profileType
	 */
	public function getProfileType(){
		return($this-> profileType);
	}


	/**
	 * accessor method for profileSalt
	 * @return string value for profileSalt
	 */
	public function getProfileSalt(){
		return($this-> profileSalt);
	}


	/**
	 * accessor method for profileHash
	 * @return string value for profileHash
	 */
	public function getProfileHash(){
		return($this-> profileHash);
	}



	/*--------------------------MUTATOR SECTION HERE------------------------------------------------*/

/**
 * mutator method for profileId
 * @param int|null  use $newProfileId to assign a new value to profileId
 * @throws \RangeException if $newProfileId is not positive
 * @throws \TypeError if $newProfileId is not an integer
 */
	public function setProfileId(int $newProfileId = null){
		//create a base case where this is a new profile and profileId is null with no SQL assigned ID yet!
		// is this because setProofileId takes in one argument, which then gets assigned to $newProfileId???
		//ASK ON THIS!!!!!
		if($newProfileId===null){
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
			throw(new \RangeException("The email entered is too short"));
		}

		//ensure $newProfileEmail isn't too long
		if(strlen($newProfileEmail) > 128){
			throw(new \RangeException("email entered is too long"));
		}

		//assign new email to profileEmail and enter it in mySQL
		$this->profileEmail = $newProfileEmail;
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
		if(strlen($newProfilePhone)=== 0){
			throw(new \RangeException("The phone number entered is too short"));
		}

		//ensure $newProfilePhone isn't too long
		if(strlen($newProfilePhone) > 32){
			throw(new \RangeException("Phone number entered is too long"));
		}

		//assign new email to $newProfilePhone and enter it in mySQL
		$this->profilePhone = $newProfilePhone;
	}


	/**
	 * *********LOOK INTO THIS ONE***********
	 * mutator method for profileAccessToken
	 * @param string, $newProfileAccessToken used to assign new value of profileAccessToken
	 * @throws \InvalidArgumentException if $newProfileAccessToken is not a string or is insecure
	 * @throws \RangeException if $newProfileAccessToken is longer than 32 char
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
		if(strlen($newProfileAccessToken) > 32){
			throw(new \RangeException("Access token is too long"));
		}

		//assign new token to $newProfileAccessToken and enter it in mySQL
		$this->profileAccessToken = $newProfileAccessToken;
	}










}