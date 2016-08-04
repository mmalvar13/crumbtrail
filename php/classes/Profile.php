<?php
/**
 * Created by PhpStorm.
 * User: kkirk4
 * Date: 8/4/16
 * Time: 2:55 PM
 */
class Profile {
	// The class Profile has 8 attributes: profileId, profileName, profileEmail, profilePhone,
	// profileActivationToken, profileType, profileSalt, and profileHash.
	// A profile is a person who is either a food truck owner or a food truck employee.

	private $profileId;
	/** This is the id number for a profile.  This is the primary key.
	 * @var int $profileId
	 **/
	private $profileName;
	/** This is the name of a profile.
	 * @var string $ProfileName
	 **/
	private $profileEmail;
	/** This is the email of a profile.
	 * @var string $profileEmail
	 **/
	private $profilePhone;
	/** This is the phone number of a profile.
	 * @var string $profilePhone
	 **/
	private $profileActivationToken;
	/** This is the Activation Token for a profile.
	 * @var int $profileActivationToken
	 **/
	private $profileType;
	/** This is the type of profile: O for owner, E for employee.
	 * @var string $profileName
	 **/
	private $profileSalt;
	/** This is the salt for the password of a profile.
	 * @var string $profileSalt
	 **/
	private $profileHash;
	/** This is the hash for the password of a profile.
	 * @var string $profileHash
	 **/


	/**
	 * Constructor for this Profile      *** CHECK THE DATA TYPES ***
	 * @param int|null $newProfileId id of this Profile
	 * @param string $newProfileName name of this Profile
	 * @param string $newProfileEmail email of this Profile
	 * @param string $newProfilePhone phone of this Profile
	 * @param int|null $newProfileActivationToken activation token of this Profile
	 * @param string $newProfileType type of this Profile (O owner, E employee)
	 * @param int|null $newProfileSalt salt for the password of this Profile
	 * @param int|null $newProfileHash hash for the password of this Profile

	 *          *** DO THESE AFTER CHECKING DATA TYPES ***
	 * @throws \InvalidArgumentException if the data types are not valide
	 * @throws \RangeException if the data values are too large
	 * @throws \TypeError if the data types violate type hints
	 * @throws \Exception if some other exception occurs
	 **/

	public function __construct(int $newProfileId = null, string $newProfileName), string $newProfileEmail,
 string $newProfilePhone, int $newProfileActivationToken = null, string $newProfileType,
 int $newProfileSalt = null, int $newProfileHash = null {
		try {
			$this->setProfileId($newProfileId);
			$this->setProfileName($newProfileName);
			$this->setProfileEmail($newProfileEmail);
			$this->setProfilePhone($newProfilePhone);
			$this->setProfileActivationToken($newProfileActivationToken);
			$this->setProfileType($newProfileType);
			$this->setProfileSalt($newProfileSalt);
			$this->setProfileHash($newProfileHash);

	//   *** NEED WAY MORE CATCH AND THROW LINES ***
		} catch(\InvalidArgumentException $invalidArgument) {
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));

		} catch(\RangeException $range) {
			throw(new \RangeException($range->getMessage(), 0, $range));

		} catch(\TypeError $typeError) {
			throw(new \TypeError($typeError->getMessage(), 0, $typeError));

		} catch(\Exception $exception) {
			throw(new \Exception($exception->getMessage(), 0, $exception));
		}
	}


	/** Accessor method for profile Id
	 *
	 * @return int|null value of profile Id
	 **/
	public function getProfileId() {
		return ($this->profileId);
	}


	/** Mutator method for profile Id
	 *
	 * @param int|null $newProfileId This is the new value of Profile Id
	 * @throws \RangeException if $newProfileId is not positive
	 * @throws \TypeError if $newProfileId is not an integer
	 **/

	public function setProfileId(int $newProfileId = null) {
		// Base case: if the profile Id is null, then this is a new profile,
		// with no mySQL-assigned id yet.  This is weird because profileId
		// is the primary key.
		if($newProfileId === null) {
			$this->ProfileId = null;
			return;
		}

		// verify that the profile id is positive
		if($newProfileId <= 0) {
			throw(new \RangeException("The profile id is not positive"));
		}

		// Convert (??) and store the author id
		$this->profileId = $newProfileId;
	}


	/**
	 * Accessor method for profile name
	 *
	 * @return string value of profile name
	 **/
	public function getProfileName() {
		return ($this->ProfileName);
	}

	/**
	 * Mutator method for profile name
	 *
	 * @param string $newProfileName new value of profile name
	 * @throws \InvalidArgumentException if $newProfileName is not a string or is insecure
	 * @throws \RangeException if $newProfileName is too long, > 128 characters
	 * @throws \TypeError if $newProfileName is not a string
	 **/
	public function setProfileName(string $newProfileName) {
		// Verify that the profile name is secure
		$newProfileName = trim($newProfileName);
		$newProfileName = filter_var($newProfileName);
		if(empty($newProfileName) === true) {
			throw(new \InvalidArgumentException("Profile name is empty or insecure."));
		}

		// Verify that the profile name will fit into the database
		if(strlen($newProfileName) > 128) {
			throw(new \RangeException("Profile name is too long."));
		}

		// Store the profile name
		$this->profileName = $newProfileName;
	}
}


?>
