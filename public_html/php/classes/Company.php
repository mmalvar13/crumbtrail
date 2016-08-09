<?php

namespace Edu\Cnm\mmalvar13\crumbtrail;
require_once("autoload.php");                          // Fix the path ??????

/**
 * Hi!  Welcome to the company class.  Enjoy your stay!
 * 
 * class company for the company entity in the crumbtrail application.
 * State variables, constructor, mutators, accessors, PDOs, and getFooByBar methods.
 * @author  Kevin Lee Kirk
 */
class company {

	// STATE VARIABLES:

	/**
	 * The primary key = companyId.
	 * @var int $companyId
	 **/
	private $companyId;

	/**
	 * The name of the food truck company, companyName.
	 * @var string $companyName
	 **/
	private $companyName;

	/**
	 * The email address of the food truck company, companyEmail.
	 * @var string $companyEmail
	 **/
	private $companyEmail;

	/**
	 * The public health permit number for this company, companyPermit.
	 * @var string $companyPermit
	 **/
	private $companyPermit;

	/**
	 * The business license number of the company, companyLicense.
	 * @var int $companyLicense
	 **/
	private $companyLicense;

	/**
	 * The attn line of the USPS address of this company, companyAttn.
	 * @var string $companyAttn
	 **/
	private $companyAttn;

	/**
	 * The 1st street line of the USPS address of this company, companyStreet1.
	 * @var string $companyStreet1
	 **/
	private $companyStreet1;

	/**
	 * The 2nd street line of the USPS address of this company, companyStreet2.
	 * @var string $companyStreet2
	 **/
	private $companyStreet2;

	/**
	 * The city line of the USPS address of this company, companyCity.
	 * @var string $companyCity
	 **/
	private $companyCity;

	/**
	 * The state line of the USPS address of this company, companyState.
	 * @var string $companyState
	 **/
	private $companyState;

	/**
	 * The zip code line of the USPS address of this company, companyZip.
	 * @var int $companyZip
	 **/
	private $companyZip;

	/**
	 * The text description of this food truck company, companyDescription,
	 * written by the company owner.
	 * @var string $companyDescription
	 **/
	private $companyDescription;

	/**
	 * The menu of this truck company.
	 * @var string $companyMenuText
	 **/
	private $companyMenuText;

	/**
	 * The activation token of this company, companyActivationToken.
	 * @var int $companyActivationToken
	 **/
	private $companyActivationToken;

	/**
	 * If this company's registration has been approved by us,
	 * then companyApproved = TRUE, else FALSE.
	 * @var bool $companyApproved
	 **/
	private $companyApproved;

	/**
	 * The id of the creator of the account of this company.
	 * @var int $companyAccountCreatorId
	 **/
	private $companyAccountCreatorId;


	// ACCESSOR METHODS:

	/**  Accessor method (getter) for companyId.
	 * @return int $companyId  The value of companyId.
	 **/
	public function getcompanyId() {
		return ($this->companyId);
	}

	/**  Accessor method (getter) for companyName.
	 * @return string $companyName  The value of companyName.
	 **/
	public function getcompanyName() {
		return ($this->companyName);
	}

	/**  Accessor method (getter) for companyEmail.
	 * @return string $companyEmail  The value of companyEmail.
	 **/
	public function getcompanyEmail() {
		return ($this->companyEmail);
	}

	/**  Accessor method (getter) for companyPermit.
	 * @return string $companyPermit  The value of companyPermit.
	 **/
	public function getcompanyPermit() {
		return ($this->companyPermit);
	}

	/**  Accessor method (getter) for companyLicense.
	 * @return int $companyLicense  The value of companyLicense.
	 **/
	public function getcompanyLicense() {
		return ($this->companyLicense);
	}

	/**  Accessor method (getter) for companyAttn.
	 * @return string $companyAttn  The value of companyAttn.
	 **/
	public function getcompanyAttn() {
		return ($this->companyAttn);
	}

	/**  Accessor method (getter) for companyStreet1.
	 * @return string $companyStreet1  The value of companyStreet1.
	 **/
	public function getcompanyStreet1() {
		return ($this->companyStreet1);
	}

	/**  Accessor method (getter) for companyStreet2.
	 * @return string $companyStreet2  The value of companyStreet2.
	 **/
	public function getcompanyStreet2() {
		return ($this->companyStreet2);
	}

	/**  Accessor method (getter) for companyCity.
	 * @return string $companyCity  The value of companyCity.
	 **/
	public function getcompanyCity() {
		return ($this->companyCity);
	}

	/**  Accessor method (getter) for companyState.
	 * @return string $companyState  The value of companyState
	 **/
	public function getcompanyState() {
		return ($this->companyState);
	}

	/**  Accessor method (getter) for companyZip.
	 * @return int $companyZip  The value of companyZip.
	 **/
	public function getcompanyZip() {
		return ($this->companyZip);
	}

	/**  Accessor method (getter) for companyDescription.
	 * @return string $companyDescription  The value of companyDescription.
	 **/
	public function getcompanyDescription() {
		return ($this->companyDescription);
	}

	/**  Accessor method (getter) for companyMenuText.
	 * @return string $companyMenuText  The value of companyMenuText.
	 **/
	public function getcompanyMenuText() {
		return ($this->companyMenuText);
	}

	/**  Accessor method (getter) for companyActivationToken.
	 * @return int $companyActivationToken  The value of companyActivationToken.
	 **/
	public function getcompanyActivationToken() {
		return ($this->companyActivationToken);
	}

	/**  Accessor method (getter) for companyApproved.
	 * @return bool $companyApproval  The value of companyApproved.
	 **/
	public function getcompanyApproved() {
		return ($this->companyApproved);
	}

	/**  Accessor method (getter) for companyAccountCreatorId.
	 * @return int $companyAccountCreatorId  The value of companyAccountCreatorId.
	 **/
	public function getcompanyAccountCreatorId() {
		return ($this->companyAccountCreatorId);
	}


	// MUTATOR METHODS:

	/**  Mutator method (setter) for companyId.
	 * @param int|null $newcompanyId The new value of companyId.
	 * @throws \RangeException  if #newcompanyId is not a positive.
	 * @throws \TypeError if $newcompanyId is not an integer.
	 **/
	public function setcompanyId($newcompanyId = null) {
		// Base case, for a new company.
		if($newcompanyId === null) {
			$this->companyId = null;
			return;
		}
		// Is $newcompanyId positive?  If not, then throw an exception.
		if($newcompanyId <= 0) {
			throw(new \RangeException("The company ID is not positive."));
		}
		// Assign $newcompanyId to companyId, then store in SQL.
		$this->companyId = $newcompanyId;
	}

	/**
	 * Mutator method for companyName.
	 * @param string , $newcompanyName  The new value of companyName.
	 * @throw \RangeException if $newcompanyName is empty or too long
	 * @throw \InvalidArgumentException if $newcompanyName is not a string
	 * @throw \TypeError if $newcompanyName is not a string
	 */
	public function setcompanyName(string $newcompanyName) {
		// Strip out the white space on either end of the string.
		$newcompanyName = trim($newcompanyName);
		// Sanitize $newcompanyName.
		$newcompanyName = filter_var($newcompanyName, FILTER_SANITIZE_STRING);
		// If $newcompanyName is empty or too long, then throw an exception.
		if(strlen($newcompanyName) === 0) {
			throw(new \RangeException("company name is too short."));
		}
		if(strlen($newcompanyName > 128)) {
			throw(new \RangeException("company name is too long."));
		}
		// Assign $newcompanyName to companyName, then store in SQL.
		$this->companyName = $newcompanyName;
	}

	/**
	 * Mutator method for companyEmail.
	 * @param string , $newcompanyEmail  The new value of companyEmail.
	 * @throw \RangeException if $newcompanyEmail is empty or too long
	 * @throw \InvalidArgumentException if $newcompanyEmail is not a string
	 * @throw \TypeError if $newcompanyEmail is not a string
	 */
	public function setcompanyEmail(string $newcompanyEmail) {
		// Strip out the white space on either end of the string.
		$newcompanyEmail = trim($newcompanyEmail);
		// Sanitize $newcompanyEmail.
		$newcompanyEmail = filter_var($newcompanyEmail, FILTER_SANITIZE_STRING);
		// If $newcompanyEmail is empty or too long, then throw an exception.
		if(strlen($newcompanyEmail) === 0) {
			throw(new \RangeException("company Email is too short."));
		}
		if(strlen($newcompanyEmail > 128)) {
			throw(new \RangeException("company Email is too long."));
		}
		// Assign $newcompanyEmail to companyEmail, then store in SQL.
		$this->companyEmail = $newcompanyEmail;
	}

	/**
	 * Mutator method for companyPermit.
	 * @param string , $newcompanyPermit  The new value of companyPermit.
	 * @throw \RangeException if $newcompanyPermit is empty or too long
	 * @throw \InvalidArgumentException if $newcompanyPermit is not a string
	 * @throw \TypeError if $newcompanyPermit is not a string
	 */
	public function setcompanyPermit(string $newcompanyPermit) {
		// Strip out the white space on either end of the string.
		$newcompanyPermit = trim($newcompanyPermit);
		// Sanitize $newcompanyPermit.
		$newcompanyPermit = filter_var($newcompanyPermit, FILTER_SANITIZE_STRING);
		// If $newcompanyPermit is empty or too long, then throw an exception.
		if(strlen($newcompanyPermit) === 0) {
			throw(new \RangeException("company Permit is too short."));
		}
		if(strlen($newcompanyPermit > 128)) {
			throw(new \RangeException("company Permit is too long."));
		}
		// Assign $newcompanyPermit to companyPermit, then store in SQL.
		$this->companyPermit = $newcompanyPermit;
	}

	/**
	 * Mutator method for companyLicense.
	 * @param string , $newcompanyLicense  The new value of companyLicense.
	 * @throw \RangeException if $newcompanyLicense is empty or too long
	 * @throw \InvalidArgumentException if $newcompanyLicense is not a string
	 * @throw \TypeError if $newcompanyLicense is not a string
	 */
	public function setcompanyLicense(string $newcompanyLicense) {
		// Strip out the white space on either end of the string.
		$newcompanyLicense = trim($newcompanyLicense);
		// Sanitize $newcompanyLicense.
		$newcompanyLicense = filter_var($newcompanyLicense, FILTER_SANITIZE_STRING);
		// If $newcompanyLicense is empty or too long, then throw an exception.
		if(strlen($newcompanyLicense) === 0) {
			throw(new \RangeException("company License is too short."));
		}
		if(strlen($newcompanyLicense > 128)) {
			throw(new \RangeException("company License is too long."));
		}
		// Assign $newcompanyLicense to companyLicense, then store in SQL.
		$this->companyLicense = $newcompanyLicense;
	}

	/**
	 * Mutator method for companyAttn.
	 * @param string , $newcompanyAttn  The new value of companyAttn.
	 * @throw \RangeException if $newcompanyAttn is empty or too long
	 * @throw \InvalidArgumentException if $newcompanyAttn is not a string
	 * @throw \TypeError if $newcompanyAttn is not a string
	 */
	public function setcompanyAttn(string $newcompanyAttn) {
		// Strip out the white space on either end of the string.
		$newcompanyAttn = trim($newcompanyAttn);
		// Sanitize $newcompanyAttn.
		$newcompanyAttn = filter_var($newcompanyAttn, FILTER_SANITIZE_STRING);
		// If $newcompanyAttn is empty or too long, then throw an exception.
		if(strlen($newcompanyAttn) === 0) {
			throw(new \RangeException("company Attn is too short."));
		}
		if(strlen($newcompanyAttn > 128)) {
			throw(new \RangeException("company Attn is too long."));
		}
		// Assign $newcompanyAttn to companyAttn, then store in SQL.
		$this->companyAttn = $newcompanyAttn;
	}

	/**
	 * Mutator method for companyStreet1.
	 * @param string , $newcompanyStreet1  The new value of companyStreet1.
	 * @throw \RangeException if $newcompanyStreet1 is empty or too long
	 * @throw \InvalidArgumentException if $newcompanyStreet1 is not a string
	 * @throw \TypeError if $newcompanyStreet1 is not a string
	 */
	public function setcompanyStreet1(string $newcompanyStreet1) {
		// Strip out the white space on either end of the string.
		$newcompanyStreet1 = trim($newcompanyStreet1);
		// Sanitize $newcompanyStreet1.
		$newcompanyStreet1 = filter_var($newcompanyStreet1, FILTER_SANITIZE_STRING);
		// If $newcompanyStreet1 is empty or too long, then throw an exception.
		if(strlen($newcompanyStreet1) === 0) {
			throw(new \RangeException("company Street1 is too short."));
		}
		if(strlen($newcompanyStreet1 > 128)) {
			throw(new \RangeException("company Street1 is too long."));
		}
		// Assign $newcompanyStreet1 to companyStreet1, then store in SQL.
		$this->companyStreet1 = $newcompanyStreet1;
	}

	/**
	 * Mutator method for companyStreet2.
	 * @param string , $newcompanyStreet2  The new value of companyStreet2.
	 * @throw \RangeException if $newcompanyStreet2 is empty or too long
	 * @throw \InvalidArgumentException if $newcompanyStreet2 is not a string
	 * @throw \TypeError if $newcompanyStreet2 is not a string
	 */
	public function setcompanyStreet2(string $newcompanyStreet2) {
		// Strip out the white space on either end of the string.
		$newcompanyStreet2 = trim($newcompanyStreet2);
		// Sanitize $newcompanyStreet2.
		$newcompanyStreet2 = filter_var($newcompanyStreet2, FILTER_SANITIZE_STRING);
		// If $newcompanyPermit is empty or too long, then throw an exception.
		if(strlen($newcompanyStreet2) === 0) {
			throw(new \RangeException("company Street2 is too short."));
		}
		if(strlen($newcompanyStreet2 > 128)) {
			throw(new \RangeException("company Street2 is too long."));
		}
		// Assign $newcompanyStreet2 to companyStreet2, then store in SQL.
		$this->companyStreet2 = $newcompanyStreet2;
	}

	/**
	 * Mutator method for companyCity.
	 * @param string , $newcompanyCity  The new value of companyCity.
	 * @throw \RangeException if $newcompanyCity is empty or too long
	 * @throw \InvalidArgumentException if $newcompanyCity is not a string
	 * @throw \TypeError if $newcompanyCity is not a string
	 */
	public function setcompanyCity(string $newcompanyCity) {
		// Strip out the white space on either end of the string.
		$newcompanyCity = trim($newcompanyCity);
		// Sanitize $newcompanyCity.
		$newcompanyCity = filter_var($newcompanyCity, FILTER_SANITIZE_STRING);
		// If $newcompanyPermit is empty or too long, then throw an exception.
		if(strlen($newcompanyCity) === 0) {
			throw(new \RangeException("company City is too short."));
		}
		if(strlen($newcompanyCity > 128)) {
			throw(new \RangeException("company City is too long."));
		}
		// Assign $newcompanyCity to companyCity, then store in SQL.
		$this->companyCity = $newcompanyCity;
	}

	/**
	 * Mutator method for companyState.
	 * @param string , $newcompanyState  The new value of companyState.
	 * @throw \RangeException if $newcompanyState is empty or too long
	 * @throw \InvalidArgumentException if $newcompanyState is not a string
	 * @throw \TypeError if $newcompanyState is not a string
	 */
	public function setcompanyState(string $newcompanyState) {
		// Strip out the white space on either end of the string.
		$newcompanyState = trim($newcompanyState);
		// Sanitize $newcompanyState.
		$newcompanyState = filter_var($newcompanyState, FILTER_SANITIZE_STRING);
		// If $newcompanyPermit is empty or too long, then throw an exception.
		if(strlen($newcompanyState) === 0) {
			throw(new \RangeException("company State is too short."));
		}
		if(strlen($newcompanyState > 128)) {
			throw(new \RangeException("company State is too long."));
		}
		// Assign $newcompanyState to companyState, then store in SQL.
		$this->companyState = $newcompanyState;
	}

	/**  Mutator method (setter) for companyZip.
	 * @param int|null $newcompanyZip The new value of companyZip.
	 * @throws \RangeException  if #newcompanyZip is not a positive.
	 * @throws \TypeError if $newcompanyZip is not an integer.
	 **/
	public function setcompanyZip($newcompanyZip = null) {
		// Base case, for a new company.
		if($newcompanyZip === null) {
			$this->companyZip = null;
			return;
		}
		// Is $newcompanyZip positive?  If not, then throw an exception.
		if($newcompanyZip <= 0) {
			throw(new \RangeException("The company Zip is not positive."));
		}
		// Assign $newcompanyZip to companyZip, then store in SQL.
		$this->companyZip = $newcompanyZip;
	}

	/**
	 * Mutator method for companyDescription.
	 * @param string , $newcompanyDescription  The new value of companyDescription.
	 * @throw \RangeException if $newcompanyDescription is empty or too long
	 * @throw \InvalidArgumentException if $newcompanyDescription is not a string
	 * @throw \TypeError if $newcompanyDescription is not a string
	 */
	public function setcompanyDescription(string $newcompanyDescription) {
		// Strip out the white space on either end of the string.
		$newcompanyDescription = trim($newcompanyDescription);
		// Sanitize $newcompanyDescription.
		$newcompanyDescription = filter_var($newcompanyDescription, FILTER_SANITIZE_STRING);
		// If $newcompanyPermit is empty or too long, then throw an exception.
		if(strlen($newcompanyDescription) === 0) {
			throw(new \RangeException("company Description is too short."));
		}
		if(strlen($newcompanyDescription > 128)) {
			throw(new \RangeException("company Description is too long."));
		}
		// Assign $newcompanyDescription to companyDescription, then store in SQL.
		$this->companyDescription = $newcompanyDescription;
	}

	/**
	 * Mutator method for companyMenuText.
	 * @param string , $newcompanyMenuText  The new value of companyMenuText.
	 * @throw \RangeException if $newcompanyMenuText is empty or too long
	 * @throw \InvalidArgumentException if $newcompanyMenuText is not a string
	 * @throw \TypeError if $newcompanyMenuText is not a string
	 */
	public function setcompanyMenuText(string $newcompanyMenuText) {
		// Strip out the white space on either end of the string.
		$newcompanyMenuText = trim($newcompanyMenuText);
		// Sanitize $newcompanyMenuText.
		$newcompanyMenuText = filter_var($newcompanyMenuText, FILTER_SANITIZE_STRING);
		// If $newcompanyPermit is empty or too long, then throw an exception.
		if(strlen($newcompanyMenuText) === 0) {
			throw(new \RangeException("company MenuText is too short."));
		}
		if(strlen($newcompanyMenuText > 128)) {
			throw(new \RangeException("company MenuText is too long."));
		}
		// Assign $newcompanyMenuText to companyMenuText, then store in SQL.
		$this->companyMenuText = $newcompanyMenuText;
	}

	/**  Mutator method (setter) for companyActivationToken.
	 * @param int|null $newcompanyActivationToken The new value of companyActivationToken.
	 * @throws \RangeException  if #newcompanyActivationToken is not a positive.
	 * @throws \TypeError if $newcompanyActivationToken is not an integer.
	 **/
	public function setcompanyActivationToken($newcompanyActivationToken = null) {
		// Base case, for a new company.
		if($newcompanyActivationToken === null) {
			$this->companyActivationToken = null;
			return;
		}
		// Is $newcompanyActivationToken positive?  If not, then throw an exception.
		if($newcompanyActivationToken <= 0) {
			throw(new \RangeException("The company ActivationToken is not positive."));
		}
		// Assign $newcompanyActivationToken to companyActivationToken, then store in SQL.
		$this->companyActivationToken = $newcompanyActivationToken;
	}

	/**  Mutator method (setter) for companyApproved.
	 * @param int|null $newcompanyApproved The new value of companyApproved.
	 * @throws \RangeException  if #newcompanyApproved is not 0 or 1.
	 **/
	public function setcompanyApproved($newcompanyApproved = null) {
		// Base case, for a new company.
		if($newcompanyApproved === null) {
			$this->companyApproved = null;
			return;
		}
		// Is $newcompanyApproved 0 or 1?  If not, then throw an exception.
		if(($newcompanyApproved != 0) or ($newcompanyApproved != 1)) {
			throw(new \RangeException("The company Approved is not Boolean."));
		}
		// Assign $newcompanyApproved to companyApproved, then store in SQL.
		$this->companyApproved = $newcompanyApproved;
	}

	/**  Mutator method (setter) for companyAccountCreatorId.
	 * @param int|null $newcompanyAccountCreatorId The new value of companyAccountCreatorId.
	 * @throws \RangeException  if #newcompanyAccountCreatorId is not a positive.
	 * @throws \TypeError if $newcompanyAccountCreatorId is not an integer.
	 **/
	public function setcompanyAccountCreatorId($newcompanyAccountCreatorId = null) {
		// Base case, for a new company.
		if($newcompanyAccountCreatorId === null) {
			$this->companyAccountCreatorId = null;
			return;
		}
		// Is $newcompanyAccountCreatorId positive?  If not, then throw an exception.
		if($newcompanyAccountCreatorId <= 0) {
			throw(new \RangeException("The company AccountCreatorId is not positive."));
		}
		// Assign $newcompanyAccountCreatorId to companyAccountCreatorId, then store in SQL.
		$this->companyAccountCreatorId = $newcompanyAccountCreatorId;
	}


	// CONSTRUCTOR:

	/**
	 * Constructor for the class company. A magic method that creates a new company object.
	 * @param int|null $newcompanyId id of this company or null if a new company
	 * @param string $newcompanyName string of the company name
	 * @param string $newcompanyEmail string of the company email
	 * @param string $newcompanyPermit string of the company permit    // Argument type ??????
	 * @param int $newcompanyLicense int of the company name
	 * @param string $newcompanyAttn string of the company attn
	 * @param string $newcompanyStreet1 string of the company street1
	 * @param string $newcompanyStreet2 string of the company street2
	 * @param string $newcompanyCity string of the company city
	 * @param string $newcompanyState string of the company state
	 * @param int $newcompanyZip int of the company zip
	 * @param string $newcompanyDescription string of the company description
	 * @param string $newcompanyMenuText string of the company menu text
	 * @param int $newcompanyActivationToken int of the company activation token
	 * @param bool $newcompanyApproved bool of the whether the company has been approved by us
	 * @param int $newcompanyAccountCreatorId int of the ProfileId of the creator of this company's account
	 * @throws \InvalidArgumentException if data types are not valid.
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers).
	 * @throws \TypeError if data types violate type hints.
	 * @throws \Exception if some other exception occurs.
	 */
	public function __construct(int $newcompanyId = null,
										 string $newcompanyName,
										 string $newcompanyEmail,
										 string $newcompanyPermit,
										 int $newcompanyLicense,
										 string $newcompanyAttn,
										 string $newcompanyStreet1,
										 string $newcompanyStreet2,
										 string $newcompanyCity,
										 string $newcompanyState,
										 int $newcompanyZip,
										 string $newcompanyDescription,
										 string $newcompanyMenuText,
										 int $newcompanyActivationToken,
										 bool $newcompanyApproved,
										 int $newcompanyAccountCreatorId) {
		try {
			$this->setcompanyId($newcompanyId);
			$this->setcompanyName($newcompanyName);
			$this->setcompanyEmail($newcompanyEmail);
			$this->setcompanyPermit($newcompanyPermit);
			$this->setcompanyLicense($newcompanyLicense);
			$this->setcompanyAttn($newcompanyAttn);
			$this->setcompanyStreet1($newcompanyStreet1);
			$this->setcompanyStreet2($newcompanyStreet2);
			$this->setcompanyCity($newcompanyCity);
			$this->setcompanyState($newcompanyState);
			$this->setcompanyZip($newcompanyZip);
			$this->setcompanyDescription($newcompanyId);
			$this->setcompanyMenuText($newcompanyMenuText);
			$this->setcompanyActivationToken($newcompanyActivationToken);
			$this->setcompanyApproved($newcompanyApproved);
			$this->setcompanyAccountCreatorId($newcompanyAccountCreatorId);
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



	// PDO STUFF:

	/**
	 * INSERT this company object into mySQL.
	 * @param \PDO $pdo is the PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo) {
		// Make sure the companyId is null.
		if($this->companyId !== null) {
			throw(new \PDOException("This is not a new companyId"));
		}

		// Create a query template.
		$query = "INSERT INTO company(companyName, companyEmail, companyPermit, companyLicense, companyAttn, companyStreet1, companyStreet2, companyCity, companyState, companyZip, companyDescription, companyMenuText, companyActivationToken, companyApproved, companyAccountCreatorId) VALUES(:companyName, :companyEmail, :companyPermit, :companyLicense, :companyAttn, :companyStreet1, :companyStreet2, :companyCity, :companyState, :companyZip, :companyDescription, :companyMenuText, :companyActivationToken, :companyApproved, :companyAccountCreatorId)";

		// Prepare is used as an extra means of security.
		$statement = $pdo->prepare($query);

		// Bind the variables to the place holder slots in the template, then put into an array.
		$companyparameters = ["companyName" => $this->companyName, "companyEmail" => $this->companyEmail, "companyPermit" => $this->companyPermit, "companyLicense" => $this->companyLicense, "companyAttn" => $this->companyAttn, "companyStreet1" => $this->companyStreet1, "companyStreet2" => $this->companyStreet2, "companyCity" => $this->companyCity, "companyState" => $this->companyState, "companyZip" => $this->companyZip, "companyDescription" => $this->companyDescription, "companyMenuText" => $this->companyMenuText, "companyActivationToken" => $this->companyActivationToken, "companyApproved" => $this->companyApproved, "companyAccountCreatorId" => $this->companyAccountCreatorId];

		//execute the command held in $statement
		$statement->execute($companyparameters);

		// Update the null companyId. Ask mySQL for the primary key value it assigned to this entry.
		$this->companyId = intval($pdo->lastInsertId());
	}


	/**
	 * DELETE this company from the mySQL database.
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo) {
		// Check to make sure the companyId isn't null.
		if($this->companyId === null) {
			throw(new \PDOException("The company you selected does not exist"));
		}

		// Create the query template.
		$query = "DELETE FROM company WHERE companyId = :companyId";
		$statement = $pdo->prepare($query);

		// Bind parameters and execute the function
		$parameters = ["companyId" => $this->companyId];
		$statement->execute($parameters);
	}


	/**
	 * UPDATE this company in mySQL.
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 */
	public function update(\PDO $pdo) {
		// Ensure that this company is not null (hasn't been entered into SQL).
		if($this->companyId === null) {
			throw(new \PDOException("Can't update a company that doesn't exist"));
		}

		// Create a query template.
		$query = "UPDATE company SET companyName = :companyName, companyEmail = :companyEmail, companyPermit =:companyPermit, companyLicense = :companyLicense, companyAttn = :companyAttn, companyStreet1 = :companyStreet1, companyStreet2 = :companyStreet2, companyCity = :companyCity, companyState = :companyState, companyZip = :companyZip, companyDescription = :companyDescription, companyMenuText = :companyMenuText, companyActivationToken = :companyActivationToken, companyApproved = :companyApproved, companyAccountCreatorId = :companyAccountCreatorId WHERE companyId = :companyId";

		// Prepare this query.
		$statement = $pdo->prepare($query);

		// Bind the variables to the template.
		$companyparameters = ["companyName" => $this->companyName, "companyEmail" => $this->companyEmail, "companyPermit" => $this->companyPermit, "companyLicense" => $this->companyLicense, "companyAttn" => $this->companyAttn, "companyStreet1" => $this->companyStreet1, "companyStreet2" => $this->companyStreet2, "companyCity" => $this->companyCity, "companyState" => $this->companyState, "companyZip" => $this->companyZip, "companyDescription" => $this->companyDescription, "companyMenuText" => $this->companyMenuText, "companyActivationToken" => $this->companyActivationToken, "companyApproved" => $this->companyApproved, "companyAccountCreatorId" => $this->companyAccountCreatorId];

		// Execute the mySQL statement.
		$statement->execute($companyparameters);
	}



	// SEARCHES (All of the getFooByBars):

	/**
	 * Get company by the companyId.
	 * @param \PDO $pdo PDO connection object
	 * @param int $companyId The company id we want to find.
	 * @return company|null  Returns the company found, or null if not found.
	 * @throws \PDOException  When mySQL related errors occur.
	 * @throws \TypeError  When variables are not the correct data type.
	 */
	public static function getcompanyBycompanyId(\PDO $pdo, int $companyId) {
		// Sanitize the ID before searching for it.
		if($companyId <= 0) {
			throw(new \PDOException("The company ID is negative or zero"));
		}

		// Create the query template.               Check this ? ??????????
		$query = "SELECT companyId, companyName, companyEmail, companyPermit, companyLicense, companyAttn, companyStreet1, companyStreet2, companyCity, companyState, companyZip, companyDescription, companyMenuText, companyActivationToken, companyApproved, companyAccountCreatorId FROM company WHERE companyId = :companyId";

		// Prepare the template.
		$statement = $pdo->prepare($query);

		// Bind the companyId to the placeholder in the template.
		$parameters = ["companyId" => $companyId];

		// Execute the SQL statement
		$statement->execute($parameters);

		// Now that we have selected the correct company, we need to get it from mySQL.
		try {
			$company = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();

			if($row !== false) {
				$company = new company($row["companyId"], $row["companyName"], $row["companyEmail"], $row["companyPermit"], $row["companyLicense"], $row["companyAttn"], $row["companyStreet1"], $row["companyStreet2"], $row["companyCity"], $row["companyState"], $row["companyZip"], $row["companyDescription"], $row["companyMenuText"], $row["companyActivationToken"], $row["companyApproved"], $row["companyAccountCreatorId"]);
			}

			// Catch exception.
		} catch(\Exception $exception) {
			// If the row could not be converted, then re-throw it.
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($company);
	}


	/**
	 * Get company by the companyAccountCreatorId.
	 * @param \PDO $pdo PDO connection object
	 * @param int $companyAccountCreatorId The company account creator we want to find.
	 * @return company|null  Returns the company found, or null if not found.
	 * @throws \PDOException  When mySQL related errors occur.
	 * @throws \TypeError  When variables are not the correct data type.
	 */
	public static function getcompanyBycompanyAccountCreatorId(\PDO $pdo, int $companyAccountCreatorId) {
		// Sanitize the ID before searching for it.
		if($companyAccountCreatorId <= 0) {
			throw(new \PDOException("The companyAccountCreator is negative or zero"));
		}

		// Create the query template.          Need to check all my query blocks!   ??????????
		$query = "SELECT companyId, companyName, companyEmail, companyPermit, companyLicense, companyAttn, companyStreet1, companyStreet2, companyCity, companyState, companyZip, companyDescription, companyMenuText, companyActivationToken, companyApproved, companyAccountCreatorId FROM company WHERE companyAccountCreatorId = :companyAccountCreatorId";

		// Prepare the template.
		$statement = $pdo->prepare($query);

		// Bind the companyAccountCreatorId to the placeholder in the template.
		$parameters = ["companyAccountCreatorId" => $companyAccountCreatorId];

		// Execute the SQL statement
		$statement->execute($parameters);

		// Now that we have selected the correct company, we need to get it from mySQL.
		try {
			$company = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();

			if($row !== false) {
				$company = new company($row["companyId"], $row["companyName"], $row["companyEmail"], $row["companyPermit"], $row["companyLicense"], $row["companyAttn"], $row["companyStreet1"], $row["companyStreet2"], $row["companyCity"], $row["companyState"], $row["companyZip"], $row["companyDescription"], $row["companyMenuText"], $row["companyActivationToken"], $row["companyApproved"], $row["companyAccountCreatorId"]);
			}

			// Catch exception.
		} catch(\Exception $exception) {
			// If the row could not be converted, then re-throw it.
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($company);
	}


	/**
	 * Get company by companyMenuText, e.g. search for tacos.  Tacos!
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $companyMenuText The company Menu Text we want to find.
	 * @return company|null  Returns the company found, or null if not found.
	 * @throws \PDOException  When mySQL related errors occur.
	 * @throws \TypeError  When variables are not the correct data type.
	 */
	public static function getcompanyBycompanyMenuText(\PDO $pdo, int $companyMenuText) {
		// Sanitize the search string before searching for it.
		$companyMenuText = trim($companyMenuText);
		$companyMenuText = filter_var($companyMenuText, FILTER_SANITIZE_STRING);
		if(empty($companyMenuText) === true) {
			throw(new \PDOException("The company Menu Text content is invalid"));
		}

		// Create the query template.
		$query = "SELECT companyId, companyName, companyEmail, companyPermit, companyLicense, companyAttn, companyStreet1, companyStreet2, companyCity, companyState, companyZip, companyDescription, companyMenuText, companyActivationToken, companyApproved, companyAccountCreatorId FROM company WHERE companyMenuText LIKE :companyMenuText";

		// Prepare the template.
		$statement = $pdo->prepare($query);

		// The %companyMenuText% is similar to (LIKE) the search string that was entered.
		$companyMenuText = "%$companyMenuText%";

		// Bind the companyMenuText to the placeholder in the template.
		$parameters = ["companyMenuText" => $companyMenuText];

		// Execute the SQL statement
		$statement->execute($parameters);

		// Build an array of companies that match the search string = the $companies array.
		$companies = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);

		// Now that we have selected the correct company, we need to get it from mySQL.
		while(($row = $statement->fetch()) !== false) {
			try {
				// Run the constructor method.
				$company = new Company($row["companyId"], $row["companyName"], $row["companyEmail"], $row["companyPermit"], $row["companyLicense"], $row["companyAttn"], $row["companyStreet1"], $row["companyStreet2"], $row["companyCity"], $row["companyState"], $row["companyZip"], $row["companyDescription"], $row["companyMenuText"], $row["companyActivationToken"], $row["companyApproved"], $row["companyAccountCreatorId"]);
				$companies[$companies->key()] = $company;
				$companies->next();
				
				} catch(\Exception $exception) {
				// If the row could not be converted, then re-throw it.
				throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($companies);
	}

}