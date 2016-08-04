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
	 * Constructor for this Profile
	 * @param int|null $newProfileId id of this Profile
	 * @param string $newProfileName name of this Profile
	 * @param string $newProfileEmail email of this Profile
	 * @param string $newProfilePhone phone of this Profile
	 * @param int\null $newProfileActivationToken activation token of this Profile
	 * @param string $newProfileType type of this Profile (O owner, E employee)
	 * @param string $newProfileSalt salt for the password of this Profile
	 * @param string $newProfileHash hash for the password of this Profile

	 *
	 * @throws \InvalidArgumentException if the data types are not valide
	 * @throws \RangeException if the data values are too large
	 * @throws \TypeError if the data types violate type hints
	 * @throws \Exception if some other exception occurs
	 **/

	public function __construct(int $newAuthorId = null, string $newAuthorName) {
		try {
			$this->setAuthorId($newAuthorId);
			$this->setAuthorName($newAuthorName);

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


	/** Mutator method for author Id
	 *
	 * @param int|null $newAuthorId This is the new value of Author Id
	 * @throws \RangeException if $newAuthorId is not positive
	 * @throws \TypeError if $newAuthorId is not an integer
	 **/

	public function setAuthorId(int $newAuthorId = null) {
		// Base case: if the author Id is null, then this is a new author,
		// with no mySQL-assigned id yet.  This is weird because authorId
		// is the primary key.
		if($newAuthorId === null) {
			$this->tweetId = null;
			return;
		}

		// verify that the author id is positive
		if($newAuthorId <= 0) {
			throw(new \RangeException("The author id is not positive"));
		}

		// Convert (??) and store the author id
		$this->authorId = $newAuthorId;
	}


	/**
	 * Accessor method for author name
	 *
	 * @return string value of author name
	 **/
	public function getAuthorName() {
		return ($this->authorName);
	}

	/**
	 * Mutator method for author name
	 *
	 * @param string $newAuthorName new value of author name
	 * @throws \InvalidArgumentException if $newAuthorName is not a string or is insecure
	 * @throws \RangeException if $newAuthorName is too long, > 128 characters
	 * @throws \TypeError if $newAuthorName is not a string
	 **/
	public function setAuthorName(string $newAuthorName) {
		// Verify that the author name is secure
		$newAuthorName = trim($newAuthorName);
		$newAuthorName = filter_var($newAuthorName);
		if(empty($newAuthorName) === true) {
			throw(new \InvalidArgumentException("Author name is empty or insecure"));
		}

		// Verify that the author name will fit into the database
		if(strlen($newAuthorName) > 128) {
			throw(new \RangeException("author name is too long"));
		}

		// Store the author name
		$this->authorName = $newAuthorName;
	}
}

?>



}