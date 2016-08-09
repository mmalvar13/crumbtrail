<?php

namespace Edu\Cnm\mmalvar13\crumbtrail;
require_once("autoload.php");

/**
 * Hi!  Welcome to the Company class.  Enjoy your stay!
 * 
 * class Company for the Company entity in the crumbtrail application.
 * State variables, constructor, mutators, accessors, and PDO methods.
 * @author  Kevin Lee Kirk
 */
class Company {

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
	public function getCompanyId() {
		return ($this->companyId);
	}

	/**  Accessor method (getter) for companyName.
	 * @return string $companyName  The value of companyName.
	 **/
	public function getCompanyName() {
		return ($this->companyName);
	}

	/**  Accessor method (getter) for companyEmail.
	 * @return string $companyEmail  The value of companyEmail.
	 **/
	public function getCompanyEmail() {
		return ($this->companyEmail);
	}

	/**  Accessor method (getter) for companyPermit.
	 * @return string $companyPermit  The value of companyPermit.
	 **/
	public function getCompanyPermit() {
		return ($this->companyPermit);
	}

	/**  Accessor method (getter) for companyLicense.
	 * @return int $companyLicense  The value of companyLicense.
	 **/
	public function getCompanyLicense() {
		return ($this->companyLicense);
	}

	/**  Accessor method (getter) for companyAttn.
	 * @return string $companyAttn  The value of companyAttn.
	 **/
	public function getCompanyAttn() {
		return ($this->companyAttn);
	}

	/**  Accessor method (getter) for companyStreet1.
	 * @return string $companyStreet1  The value of companyStreet1.
	 **/
	public function getCompanyStreet1() {
		return ($this->companyStreet1);
	}

	/**  Accessor method (getter) for companyStreet2.
	 * @return string $companyStreet2  The value of companyStreet2.
	 **/
	public function getCompanyStreet2() {
		return ($this->companyStreet2);
	}

	/**  Accessor method (getter) for companyCity.
	 * @return string $companyCity  The value of companyCity.
	 **/
	public function getCompanyCity() {
		return ($this->companyCity);
	}

	/**  Accessor method (getter) for companyState.
	 * @return string $companyState  The value of companyState
	 **/
	public function getCompanyState() {
		return ($this->companyState);
	}

	/**  Accessor method (getter) for companyZip.
	 * @return int $companyZip  The value of companyZip.
	 **/
	public function getCompanyZip() {
		return ($this->companyZip);
	}

	/**  Accessor method (getter) for companyDescription.
	 * @return string $companyDescription  The value of companyDescription.
	 **/
	public function getCompanyDescription() {
		return ($this->companyDescription);
	}

	/**  Accessor method (getter) for companyMenuText.
	 * @return string $companyMenuText  The value of companyMenuText.
	 **/
	public function getCompanyMenuText() {
		return ($this->companyMenuText);
	}

	/**  Accessor method (getter) for companyActivationToken.
	 * @return int $companyActivationToken  The value of companyActivationToken.
	 **/
	public function getCompanyActivationToken() {
		return ($this->companyActivationToken);
	}

	/**  Accessor method (getter) for companyApproved.
	 * @return bool $companyApproval  The value of companyApproved.
	 **/
	public function getCompanyApproved() {
		return ($this->companyApproved);
	}

	/**  Accessor method (getter) for companyAccountCreatorId.
	 * @return int $companyAccountCreatorId  The value of companyAccountCreatorId.
	 **/
	public function getCompanyAccountCreatorId() {
		return ($this->companyAccountCreatorId);
	}

	

	// MUTATOR METHODS:

	/**  Mutator method (setter) for companyId.
	 * @param int|null $newCompanyId The new value of companyId.
	 * @throws \RangeException  if $newCompanyId is not a positive.
	 * @throws \TypeError if $newCompanyId is not an integer.
	 **/
	public function setCompanyId(int $newCompanyId = null) {
		// Base case, for a new company.
		if($newCompanyId === null) {
			$this->companyId = null;
			return;
		}
		// Is $newCompanyId positive?  If not, then throw an exception.
		if($newCompanyId <= 0) {
			throw(new \RangeException("The company ID is not positive."));
		}
		// Assign $newCompanyId to companyId, then store in SQL.
		$this->companyId = $newCompanyId;
	}

	/**
	 * Mutator method for companyName.
	 * @param string , $newCompanyName  The new value of companyName.
	 * @throw \RangeException if $newCompanyName is empty or too long
	 * @throw \InvalidArgumentException if $newCompanyName is not a string
	 * @throw \TypeError if $newCompanyName is not a string
	 */
	public function setCompanyName(string $newCompanyName) {
		// Strip out the white space on either end of the string.
		$newCompanyName = trim($newCompanyName);
		// Sanitize $newCompanyName.
		$newCompanyName = filter_var($newCompanyName, FILTER_SANITIZE_STRING);
		// If $newCompanyName is empty or too long, then throw an exception.
		if(strlen($newCompanyName) === 0) {
			throw(new \RangeException("Company name is too short."));
		}
		if(strlen($newCompanyName > 128)) {
			throw(new \RangeException("Company name is too long."));
		}
		// Assign $newCompanyName to companyName, then store in SQL.
		$this->companyName = $newCompanyName;
	}

	/**
	 * Mutator method for companyEmail.
	 * @param string , $newcompanyEmail  The new value of companyEmail.
	 * @throw \RangeException if $newCompanyEmail is empty or too long
	 * @throw \InvalidArgumentException if $newCompanyEmail is not a string
	 * @throw \TypeError if $newCompanyEmail is not a string
	 */
	public function setCompanyEmail(string $newCompanyEmail) {
		// Strip out the white space on either end of the string.
		$newCompanyEmail = trim($newCompanyEmail);
		// Sanitize $newCompanyEmail.
		$newCompanyEmail = filter_var($newCompanyEmail, FILTER_SANITIZE_STRING);
		// If $newCompanyEmail is empty or too long, then throw an exception.
		if(strlen($newCompanyEmail) === 0) {
			throw(new \RangeException("Company Email is too short."));
		}
		if(strlen($newCompanyEmail > 128)) {
			throw(new \RangeException("Company Email is too long."));
		}
		// Assign $newCompanyEmail to companyEmail, then store in SQL.
		$this->companyEmail = $newCompanyEmail;
	}

	/**
	 * Mutator method for companyPermit.
	 * @param string , $newCompanyPermit  The new value of companyPermit.
	 * @throw \RangeException if $newCompanyPermit is empty or too long
	 * @throw \InvalidArgumentException if $newCompanyPermit is not a string
	 * @throw \TypeError if $newCompanyPermit is not a string
	 */
	public function setCompanyPermit(string $newCompanyPermit) {
		// Strip out the white space on either end of the string.
		$newCompanyPermit = trim($newCompanyPermit);
		// Sanitize $newCompanyPermit.
		$newCompanyPermit = filter_var($newCompanyPermit, FILTER_SANITIZE_STRING);
		// If $newCompanyPermit is empty or too long, then throw an exception.
		if(strlen($newCompanyPermit) === 0) {
			throw(new \RangeException("Company Permit is too short."));
		}
		if(strlen($newCompanyPermit > 128)) {
			throw(new \RangeException("Company Permit is too long."));
		}
		// Assign $newCompanyPermit to companyPermit, then store in SQL.
		$this->companyPermit = $newCompanyPermit;
	}

	/**
	 * Mutator method for companyLicense.
	 * @param string , $newCompanyLicense  The new value of companyLicense.
	 * @throw \RangeException if $newCompanyLicense is empty or too long
	 * @throw \InvalidArgumentException if $newCompanyLicense is not a string
	 * @throw \TypeError if $newCompanyLicense is not a string
	 */
	public function setCompanyLicense(string $newCompanyLicense) {
		// Strip out the white space on either end of the string.
		$newCompanyLicense = trim($newCompanyLicense);
		// Sanitize $newCompanyLicense.
		$newCompanyLicense = filter_var($newCompanyLicense, FILTER_SANITIZE_STRING);
		// If $newCompanyLicense is empty or too long, then throw an exception.
		if(strlen($newCompanyLicense) === 0) {
			throw(new \RangeException("Company License is too short."));
		}
		if(strlen($newCompanyLicense > 128)) {
			throw(new \RangeException("Company License is too long."));
		}
		// Assign $newCompanyLicense to companyLicense, then store in SQL.
		$this->companyLicense = $newCompanyLicense;
	}

	/**
	 * Mutator method for companyAttn.
	 * @param string , $newCompanyAttn  The new value of companyAttn.
	 * @throw \RangeException if $newCompanyAttn is empty or too long
	 * @throw \InvalidArgumentException if $newCompanyAttn is not a string
	 * @throw \TypeError if $newCompanyAttn is not a string
	 */
	public function setCompanyAttn(string $newCompanyAttn) {
		// Strip out the white space on either end of the string.
		$newCompanyAttn = trim($newCompanyAttn);
		// Sanitize $newCompanyAttn.
		$newCompanyAttn = filter_var($newCompanyAttn, FILTER_SANITIZE_STRING);
		// If $newCompanyAttn is empty or too long, then throw an exception.
		if(strlen($newCompanyAttn) === 0) {
			throw(new \RangeException("company Attn is too short."));
		}
		if(strlen($newCompanyAttn > 128)) {
			throw(new \RangeException("company Attn is too long."));
		}
		// Assign $newCompanyAttn to companyAttn, then store in SQL.
		$this->companyAttn = $newCompanyAttn;
	}

	/**
	 * Mutator method for companyStreet1.
	 * @param string , $newCompanyStreet1  The new value of companyStreet1.
	 * @throw \RangeException if $newCompanyStreet1 is empty or too long
	 * @throw \InvalidArgumentException if $newCompanyStreet1 is not a string
	 * @throw \TypeError if $newCompanyStreet1 is not a string
	 */
	public function setCompanyStreet1(string $newCompanyStreet1) {
		// Strip out the white space on either end of the string.
		$newCompanyStreet1 = trim($newCompanyStreet1);
		// Sanitize $newCompanyStreet1.
		$newCompanyStreet1 = filter_var($newCompanyStreet1, FILTER_SANITIZE_STRING);
		// If $newCompanyStreet1 is empty or too long, then throw an exception.
		if(strlen($newCompanyStreet1) === 0) {
			throw(new \RangeException("company Street1 is too short."));
		}
		if(strlen($newCompanyStreet1 > 128)) {
			throw(new \RangeException("company Street1 is too long."));
		}
		// Assign $newCompanyStreet1 to companyStreet1, then store in SQL.
		$this->companyStreet1 = $newCompanyStreet1;
	}

	/**
	 * Mutator method for companyStreet2.
	 * @param string , $newCompanyStreet2  The new value of companyStreet2.
	 * @throw \RangeException if $newCompanyStreet2 is empty or too long
	 * @throw \InvalidArgumentException if $newCompanyStreet2 is not a string
	 * @throw \TypeError if $newCompanyStreet2 is not a string
	 */
	public function setCompanyStreet2(string $newCompanyStreet2) {
		// Strip out the white space on either end of the string.
		$newCompanyStreet2 = trim($newCompanyStreet2);
		// Sanitize $newCompanyStreet2.
		$newCompanyStreet2 = filter_var($newCompanyStreet2, FILTER_SANITIZE_STRING);
		// If $newcompanyPermit is empty or too long, then throw an exception.
		if(strlen($newCompanyStreet2) === 0) {
			throw(new \RangeException("company Street2 is too short."));
		}
		if(strlen($newCompanyStreet2 > 128)) {
			throw(new \RangeException("company Street2 is too long."));
		}
		// Assign $newCompanyStreet2 to companyStreet2, then store in SQL.
		$this->companyStreet2 = $newCompanyStreet2;
	}

	/**
	 * Mutator method for companyCity.
	 * @param string , $newCompanyCity  The new value of companyCity.
	 * @throw \RangeException if $newCompanyCity is empty or too long
	 * @throw \InvalidArgumentException if $newCompanyCity is not a string
	 * @throw \TypeError if $newCompanyCity is not a string
	 */
	public function setCompanyCity(string $newCompanyCity) {
		// Strip out the white space on either end of the string.
		$newCompanyCity = trim($newCompanyCity);
		// Sanitize $newCompanyCity.
		$newCompanyCity = filter_var($newCompanyCity, FILTER_SANITIZE_STRING);
		// If $newCompanyPermit is empty or too long, then throw an exception.
		if(strlen($newCompanyCity) === 0) {
			throw(new \RangeException("company City is too short."));
		}
		if(strlen($newCompanyCity > 128)) {
			throw(new \RangeException("company City is too long."));
		}
		// Assign $newCompanyCity to companyCity, then store in SQL.
		$this->companyCity = $newCompanyCity;
	}

	/**
	 * Mutator method for companyState.
	 * @param string , $newCompanyState  The new value of companyState.
	 * @throw \RangeException if $newCompanyState is empty or too long
	 * @throw \InvalidArgumentException if $newCompanyState is not a string
	 * @throw \TypeError if $newCompanyState is not a string
	 */
	public function setCompanyState(string $newCompanyState) {
		// Strip out the white space on either end of the string.
		$newCompanyState = trim($newCompanyState);
		// Sanitize $newCompanyState.
		$newCompanyState = filter_var($newCompanyState, FILTER_SANITIZE_STRING);
		// If $newCompanyPermit is empty or too long, then throw an exception.
		if(strlen($newCompanyState) === 0) {
			throw(new \RangeException("company State is too short."));
		}
		if(strlen($newCompanyState > 128)) {
			throw(new \RangeException("company State is too long."));
		}
		// Assign $newCompanyState to companyState, then store in SQL.
		$this->companyState = $newCompanyState;
	}

	/**  Mutator method (setter) for companyZip.
	 * @param int|null $newCompanyZip The new value of companyZip.
	 * @throws \RangeException  if #newcompanyZip is not a positive.
	 * @throws \TypeError if $newCompanyZip is not an integer.
	 **/
	public function setCompanyZip($newCompanyZip = null) {
		// Base case, for a new company.
		if($newCompanyZip === null) {
			$this->companyZip = null;
			return;
		}
		// Is $newCompanyZip positive?  If not, then throw an exception.
		if($newCompanyZip <= 0) {
			throw(new \RangeException("The company Zip is not positive."));
		}
		// Assign $newCompanyZip to companyZip, then store in SQL.
		$this->companyZip = $newCompanyZip;
	}

	/**
	 * Mutator method for companyDescription.
	 * @param string , $newCompanyDescription  The new value of companyDescription.
	 * @throw \RangeException if $newCompanyDescription is empty or too long
	 * @throw \InvalidArgumentException if $newCompanyDescription is not a string
	 * @throw \TypeError if $newCompanyDescription is not a string
	 */
	public function setCompanyDescription(string $newCompanyDescription) {
		// Strip out the white space on either end of the string.
		$newCompanyDescription = trim($newCompanyDescription);
		// Sanitize $newCompanyDescription.
		$newCompanyDescription = filter_var($newCompanyDescription, FILTER_SANITIZE_STRING);
		// If $newCompanyDescription is empty or too long, then throw an exception.
		if(strlen($newCompanyDescription) === 0) {
			throw(new \RangeException("company Description is too short."));
		}
		if(strlen($newCompanyDescription > 128)) {
			throw(new \RangeException("company Description is too long."));
		}
		// Assign $newCompanyDescription to companyDescription, then store in SQL.
		$this->companyDescription = $newCompanyDescription;
	}

	/**
	 * Mutator method for companyMenuText.
	 * @param string , $newCompanyMenuText  The new value of companyMenuText.
	 * @throw \RangeException if $newCompanyMenuText is empty or too long
	 * @throw \InvalidArgumentException if $newCompanyMenuText is not a string
	 * @throw \TypeError if $newCompanyMenuText is not a string
	 */
	public function setCompanyMenuText(string $newCompanyMenuText) {
		// Strip out the white space on either end of the string.
		$newCompanyMenuText = trim($newCompanyMenuText);
		// Sanitize $newCompanyMenuText.
		$newCompanyMenuText = filter_var($newCompanyMenuText, FILTER_SANITIZE_STRING);
		// If $newCompanyMenuText is empty or too long, then throw an exception.
		if(strlen($newCompanyMenuText) === 0) {
			throw(new \RangeException("company MenuText is too short."));
		}
		if(strlen($newCompanyMenuText > 128)) {
			throw(new \RangeException("company MenuText is too long."));
		}
		// Assign $newCompanyMenuText to companyMenuText, then store in SQL.
		$this->companyMenuText = $newCompanyMenuText;
	}

	/**  Mutator method (setter) for companyActivationToken.
	 * @param int|null $newCompanyActivationToken The new value of companyActivationToken.
	 * @throws \RangeException  if #newcompanyActivationToken is not a positive.
	 * @throws \TypeError if $newCompanyActivationToken is not an integer.
	 **/
	public function setCompanyActivationToken($newCompanyActivationToken = null) {
		// Base case, for a new company.
		if($newCompanyActivationToken === null) {
			$this->companyActivationToken = null;
			return;
		}
		// Is $newCompanyActivationToken positive?  If not, then throw an exception.
		if($newCompanyActivationToken <= 0) {
			throw(new \RangeException("The company ActivationToken is not positive."));
		}
		// Assign $newCompanyActivationToken to companyActivationToken, then store in SQL.
		$this->companyActivationToken = $newCompanyActivationToken;
	}

	/**  Mutator method (setter) for companyApproved.
	 * @param int|null $newCompanyApproved The new value of companyApproved.
	 * @throws \RangeException  if #newcompanyApproved is not 0 or 1.
	 **/
	public function setCompanyApproved($newCompanyApproved = null) {
		// Base case, for a new company.
		if($newCompanyApproved === null) {
			$this->companyApproved = null;
			return;
		}
		// Is $newCompanyApproved 0 or 1?  If not, then throw an exception.
		if(($newCompanyApproved != 0) or ($newCompanyApproved != 1)) {
			throw(new \RangeException("The company Approved is not Boolean."));
		}
		// Assign $newCompanyApproved to companyApproved, then store in SQL.
		$this->companyApproved = $newCompanyApproved;
	}

	/**  Mutator method (setter) for companyAccountCreatorId.
	 * @param int|null $newCompanyAccountCreatorId The new value of companyAccountCreatorId.
	 * @throws \RangeException  if #newcompanyAccountCreatorId is not a positive.
	 * @throws \TypeError if $newCompanyAccountCreatorId is not an integer.
	 **/
	public function setCompanyAccountCreatorId($newCompanyAccountCreatorId = null) {
		// Base case, for a new company.
		if($newCompanyAccountCreatorId === null) {
			$this->companyAccountCreatorId = null;
			return;
		}
		// Is $newCompanyAccountCreatorId positive?  If not, then throw an exception.
		if($newCompanyAccountCreatorId <= 0) {
			throw(new \RangeException("The company AccountCreatorId is not positive."));
		}
		// Assign $newCompanyAccountCreatorId to companyAccountCreatorId, then store in SQL.
		$this->companyAccountCreatorId = $newCompanyAccountCreatorId;
	}


	// CONSTRUCTOR:

	/**
	 * Constructor for the class company. A magic method that creates a new company object.
	 *
	 * @param int|null $newCompanyId id of this company or null if a new company
	 * @param string $newCompanyName string of the company name
	 * @param string $newCompanyEmail string of the company email
	 * @param string $newCompanyPermit string of the company permit    // Argument type ??????
	 * @param int $newCompanyLicense int of the company name
	 * @param string $newCompanyAttn string of the company attn
	 * @param string $newCompanyStreet1 string of the company street1
	 * @param string $newCompanyStreet2 string of the company street2
	 * @param string $newCompanyCity string of the company city
	 * @param string $newCompanyState string of the company state
	 * @param int $newCompanyZip int of the company zip
	 * @param string $newCompanyDescription string of the company description
	 * @param string $newCompanyMenuText string of the company menu text
	 * @param int $newCompanyActivationToken int of the company activation token
	 * @param bool $newCompanyApproved bool of the whether the company has been approved by us
	 * @param int $newCompanyAccountCreatorId int of the ProfileId of the creator of this company's account
	 * @throws \InvalidArgumentException if data types are not valid.
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers).
	 * @throws \TypeError if data types violate type hints.
	 * @throws \Exception if some other exception occurs.
	 */
	public function __construct(int $newCompanyId = null,
										 string $newCompanyName,
										 string $newCompanyEmail,
										 string $newCompanyPermit,
										 int $newCompanyLicense,
										 string $newCompanyAttn,
										 string $newCompanyStreet1,
										 string $newCompanyStreet2,
										 string $newCompanyCity,
										 string $newCompanyState,
										 int $newCompanyZip,
										 string $newCompanyDescription,
										 string $newCompanyMenuText,
										 int $newCompanyActivationToken,
										 bool $newCompanyApproved,
										 int $newCompanyAccountCreatorId) {
		try {
			$this->setCompanyId($newCompanyId);
			$this->setCompanyName($newCompanyName);
			$this->setCompanyEmail($newCompanyEmail);
			$this->setCompanyPermit($newCompanyPermit);
			$this->setCompanyLicense($newCompanyLicense);
			$this->setCompanyAttn($newCompanyAttn);
			$this->setCompanyStreet1($newCompanyStreet1);
			$this->setCompanyStreet2($newCompanyStreet2);
			$this->setCompanyCity($newCompanyCity);
			$this->setCompanyState($newCompanyState);
			$this->setCompanyZip($newCompanyZip);
			$this->setCompanyDescription($newCompanyId);
			$this->setCompanyMenuText($newCompanyMenuText);
			$this->setCompanyActivationToken($newCompanyActivationToken);
			$this->setCompanyApproved($newCompanyApproved);
			$this->setCompanyAccountCreatorId($newCompanyAccountCreatorId);
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
	 *
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
	 *
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
	 *
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
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $companyId The company id we want to find.
	 * @return company|null  Returns the company found, or null if not found.
	 * @throws \PDOException  When mySQL related errors occur.
	 * @throws \TypeError  When variables are not the correct data type.
	 */
	public static function getCompanyByCompanyId(\PDO $pdo, int $companyId) {
		// Sanitize the ID before searching for it.
		if($companyId <= 0) {
			throw(new \PDOException("The company ID is negative or zero"));
		}

		// Create the query template.
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
				$company = new Company($row["companyId"], $row["companyName"], $row["companyEmail"], $row["companyPermit"], $row["companyLicense"], $row["companyAttn"], $row["companyStreet1"], $row["companyStreet2"], $row["companyCity"], $row["companyState"], $row["companyZip"], $row["companyDescription"], $row["companyMenuText"], $row["companyActivationToken"], $row["companyApproved"], $row["companyAccountCreatorId"]);
			}

			// Catch exception.
		} catch(\Exception $exception) {
			// If the row could not be converted, then re-throw it.
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($company);
	}


	/**
	 * Get company by the companyAccountCreatorId.
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $companyAccountCreatorId  The company account creator we want to find.
	 * @return company|null  Returns the company found, or null if not found.
	 * @throws \PDOException  When mySQL related errors occur.
	 * @throws \TypeError  When variables are not the correct data type.
	 */
	public static function getCompanyByCompanyAccountCreatorId(\PDO $pdo, int $companyAccountCreatorId) {
		// Sanitize the ID before searching for it.
		if($companyAccountCreatorId <= 0) {
			throw(new \PDOException("The companyAccountCreator is negative or zero"));
		}

		// Create the query template.
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
				$company = new Company($row["companyId"], $row["companyName"], $row["companyEmail"], $row["companyPermit"], $row["companyLicense"], $row["companyAttn"], $row["companyStreet1"], $row["companyStreet2"], $row["companyCity"], $row["companyState"], $row["companyZip"], $row["companyDescription"], $row["companyMenuText"], $row["companyActivationToken"], $row["companyApproved"], $row["companyAccountCreatorId"]);
			}

			// Catch exception.
		} catch(\Exception $exception) {
			// If the row could not be converted, then re-throw it.
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($company);
	}


	/**
	 * Get company by companyMenuText, e.g. search for tacos.  Tacos!
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $companyMenuText The companyMenuText we want to find.
	 * @return company|null  Returns the company found, or null if not found.
	 * @throws \PDOException  When mySQL related errors occur.
	 * @throws \TypeError  When variables are not the correct data type.
	 */
	public static function getCompanyByCompanyMenuText(\PDO $pdo, string $companyMenuText) {
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
			return($companies);
		}
	}
}