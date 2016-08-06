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

		}

	}

}