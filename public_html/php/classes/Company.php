<?php

namespace Edu\Cnm\CrumbTrail;

require_once("autoload.php");

/**
 * Hi!  Welcome to the Company class.   Enjoy your stay!
 * 
 * class Company for the Company entity in the crumbtrail application.
 * State variables, constructor, mutators, accessors,  and PDO methods.
 * @author  Kevin Lee Kirk
 */
class Company implements \JsonSerializable {

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
	 * The phone number of the food truck company, companyPhone.
	 * @var string $companyPhone
	 **/
	private $companyPhone;

	/**
	 * The public health permit number for this company, companyPermit.
	 * @var string $companyPermit
	 **/
	private $companyPermit;

	/**
	 * The business license number of the company, companyLicense.
	 * @var string $companyLicense
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
	 * @var string $companyActivationToken
	 **/
	private $companyActivationToken;

	/**
	 * If this company's registration has been approved by us,
	 * then companyApproved = true, else false,
	 * default = null
	 * @var bool $companyApproved
	 **/
	private $companyApproved;

	/**
	 * The id of the creator of the account of this company.
	 * @var int $companyAccountCreatorId
	 **/
	private $companyAccountCreatorId;


	/**
	 * Constructor for the class company. A magic method that creates a new company object.
	 *
	 * @param int|null $newCompanyId id of this company or null if a new company
	 * @param string $newCompanyName string of the company name
	 * @param string $newCompanyEmail string of the company email
	 * @param string $newCompanyPhone string of the company phone number.
	 * @param string $newCompanyPermit string of the company permit
	 * @param string $newCompanyLicense string of the company license
	 * @param string $newCompanyAttn string of the company attn
	 * @param string $newCompanyStreet1 string of the company street1
	 * @param string $newCompanyStreet2 string of the company street2
	 * @param string $newCompanyCity string of the company city
	 * @param string $newCompanyState string of the company state
	 * @param int $newCompanyZip int of the company zip
	 * @param string $newCompanyDescription string of the company description
	 * @param string $newCompanyMenuText string of the company menu text
	 * @param string $newCompanyActivationToken string of the company activation token
	 * @param int $newCompanyApproved int of the whether the company has been approved by us; 0 = no, 1 = yes.
	 * @param int $newCompanyAccountCreatorId int of the ProfileId of the creator of this company's account
	 * @throws \InvalidArgumentException if data types are not valid.
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers).
	 * @throws \TypeError if data types violate type hints.
	 * @throws \Exception if some other exception occurs.
	 */
	public function __construct(int $newCompanyId = null,
										int $newCompanyAccountCreatorId,
										 string $newCompanyName,
										 string $newCompanyEmail,
										 string $newCompanyPhone,
										 string $newCompanyPermit,
										 string $newCompanyLicense,
										 string $newCompanyAttn,
										 string $newCompanyStreet1,
										 string $newCompanyStreet2,
										 string $newCompanyCity,
										 string $newCompanyState,
										 string $newCompanyZip,
										 string $newCompanyDescription,
										 string $newCompanyMenuText,
										 string $newCompanyActivationToken,
										 bool $newCompanyApproved = null
	// TODO Is the above the correct way to initialize the Approval to 0.   change to boolean null=placeholder true false, sql now tinyint
		// setter allow nulls, to allow for the base case
		//
										 ) {
		try {
			$this->setCompanyId($newCompanyId);
			$this->setCompanyAccountCreatorId($newCompanyAccountCreatorId);
			$this->setCompanyName($newCompanyName);
			$this->setCompanyEmail($newCompanyEmail);
			$this->setCompanyPhone($newCompanyPhone);
			$this->setCompanyPermit($newCompanyPermit);
			$this->setCompanyLicense($newCompanyLicense);
			$this->setCompanyAttn($newCompanyAttn);
			$this->setCompanyStreet1($newCompanyStreet1);
			$this->setCompanyStreet2($newCompanyStreet2);
			$this->setCompanyCity($newCompanyCity);
			$this->setCompanyState($newCompanyState);
			$this->setCompanyZip($newCompanyZip);
			$this->setCompanyDescription($newCompanyDescription);
			$this->setCompanyMenuText($newCompanyMenuText);
			$this->setCompanyActivationToken($newCompanyActivationToken);
			$this->setCompanyApproved($newCompanyApproved);

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
		$query = "SELECT companyId, companyAccountCreatorId, companyId, companyName, companyEmail, companyPhone, companyPermit, companyLicense, companyAttn, companyStreet1, companyStreet2, companyCity, companyState, companyZip, companyDescription, companyMenuText, companyActivationToken, companyApproved FROM company WHERE companyId = :companyId";

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
				$company = new Company($row["companyId"], $row["companyAccountCreatorId"], $row["companyName"], $row["companyEmail"], $row["companyPhone"], $row["companyPermit"], $row["companyLicense"], $row["companyAttn"], $row["companyStreet1"], $row["companyStreet2"], $row["companyCity"], $row["companyState"], $row["companyZip"], $row["companyDescription"], $row["companyMenuText"], $row["companyActivationToken"], $row["companyApproved"]);
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
		$query = "SELECT companyId, companyAccountCreatorId, companyName, companyEmail, companyPhone, companyPermit, companyLicense, companyAttn, companyStreet1, companyStreet2, companyCity, companyState, companyZip, companyDescription, companyMenuText, companyActivationToken, companyApproved FROM company WHERE companyAccountCreatorId = :companyAccountCreatorId";

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
				$company = new Company($row["companyId"], $row["companyAccountCreatorId"], $row["companyName"], $row["companyEmail"], $row["companyPhone"], $row["companyPermit"], $row["companyLicense"], $row["companyAttn"], $row["companyStreet1"], $row["companyStreet2"], $row["companyCity"], $row["companyState"], $row["companyZip"], $row["companyDescription"], $row["companyMenuText"], $row["companyActivationToken"], $row["companyApproved"]);
			}

			// Catch exception.
		} catch(\Exception $exception) {
			// If the row could not be converted, then re-throw it.
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($company);
	}

	/**
	 * gets company by the company name
	 * @param \PDO $pdo PDO connection object
	 * @param string $companyName used as the company name to search for
	 * @return \SplFixedArray SplFixedArray of companies found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 * @author LB
	 */
	public static function getCompanyByCompanyName(\PDO $pdo, string $companyName){
		//sanitize the ID before searching for it
		$companyName = trim($companyName);
		$companyName = filter_var($companyName, FILTER_SANITIZE_STRING);

		if(empty($companyName) === true){
			throw(new \PDOException("The company name is empty"));
		}

		if(strlen($companyName)>128){
			throw(new \PDOException("The company name entered is too long"));
		}

		//create query template
		$query = "SELECT companyId, companyAccountCreatorId, companyName, companyEmail, companyPhone, companyPermit, companyPhone, companyLicense, companyAttn, companyStreet1, companyStreet2, companyCity, companyState, companyZip, companyDescription, companyMenuText, companyActivationToken, companyApproved FROM company WHERE companyName LIKE :companyName";

		//prepare template
		$statement = $pdo->prepare($query);

		//bind the profileId to the placeholder in the template
		$companyName = "%$companyName%";
		$parameters = ["companyName"=>$companyName];
		//execute the SQL statement
		$statement->execute($parameters);

		//build an array of profiles
		$companies = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);

		while(($row = $statement->fetch()) !== false){
			try{
				$company = new Company($row["companyId"], $row["companyAccountCreatorId"], $row["companyName"], $row["companyEmail"], $row["companyPhone"], $row["companyPermit"], $row["companyLicense"], $row["companyAttn"], $row["companyStreet1"], $row["companyStreet2"], $row["companyCity"], $row["companyState"], $row["companyZip"], $row["companyDescription"], $row["companyMenuText"], $row["companyActivationToken"], $row["companyApproved"]);

				// TODO Check this block !!!
				//What exactly is happening here ****
				$companies[$companies->key()] = $company;
				$companies->next();
			}catch(\Exception $exception){
				//if the row couldn't be converted, rethrow it (the error?)
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($companies);
	}

	/**
	 * Get company by companyMenuText, e.g. search for tacos.
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $companyMenuText The companyMenuText we want to find.
	 * @return \SplFixedArray  Returns the company found, or null if not found.
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
		$query = "SELECT companyId, companyAccountCreatorId, companyName, companyEmail, companyPhone, companyPermit, companyPhone, companyLicense, companyAttn, companyStreet1, companyStreet2, companyCity, companyState, companyZip, companyDescription, companyMenuText, companyActivationToken, companyApproved FROM company WHERE companyMenuText LIKE :companyMenuText";

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
				$company = new Company($row["companyId"], $row["companyAccountCreatorId"], $row["companyName"], $row["companyEmail"], $row["companyPhone"], $row["companyPermit"], $row["companyLicense"], $row["companyAttn"], $row["companyStreet1"], $row["companyStreet2"], $row["companyCity"], $row["companyState"], $row["companyZip"], $row["companyDescription"], $row["companyMenuText"], $row["companyActivationToken"], $row["companyApproved"]);
				$companies[$companies->key()] = $company;
				$companies->next();
			} catch(\Exception $exception) {
				// If the row could not be converted, then re-throw it.
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($companies);
	}

	/**
	 * Get all Companys (sp).  All of 'em.
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of Companys (sp) found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getAllCompanys(\PDO $pdo) {
		// create query template
		$query = "SELECT companyId, companyAccountCreatorId, companyName, companyEmail, companyPhone, companyPermit, companyLicense, companyAttn, companyStreet1, companyStreet2, companyCity, companyState, companyZip, companyDescription, companyMenuText, companyActivationToken, companyApproved FROM company";

		$statement = $pdo->prepare($query);
		$statement->execute();

		// Build an array of tweets.
		$companys = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$company = new Company($row["companyId"], $row["companyAccountCreatorId"], $row["companyName"], $row["companyEmail"], $row["companyPhone"], $row["companyPermit"], $row["companyLicense"], $row["companyAttn"], $row["companyStreet1"], $row["companyStreet2"], $row["companyCity"], $row["companyState"], $row["companyZip"], $row["companyDescription"], $row["companyMenuText"], $row["companyActivationToken"], $row["companyApproved"]);
				$companys[$companys->key()] = $company;
				$companys->next();
			} catch(\Exception $exception) {
				// If the row couldn't be converted, rethrow it.
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($companys);
	}

	/**  Accessor method (getter) for companyId.
	 * @return int $companyId  The value of companyId.
	 **/
	public function getCompanyId() {
		return ($this->companyId);
	}

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

	/**  Accessor method (getter) for companyName.
	 * @return string $companyName  The value of companyName.
	 **/
	public function getCompanyName() {
		return ($this->companyName);
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

	/**  Accessor method (getter) for companyEmail.
	 * @return string $companyEmail  The value of companyEmail.
	 **/
	public function getCompanyEmail() {
		return ($this->companyEmail);
	}

	/**
	 * Mutator method for companyEmail.
	 * @param string, $newCompanyEmail  The new value of companyEmail.
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

	/**  Accessor method (getter) for companyPhone.
	 * @return string $companyPhone  The value of companyPhone.
	 **/
	public function getCompanyPhone() {
		return ($this->companyPhone);
	}

	/**
	 * Mutator method for companyPhone.
	 * @param string, $newCompanyPhone  The new value of companyPhone.
	 * @throw \RangeException if $newCompanyPhone is empty or too long
	 * @throw \InvalidArgumentException if $newCompanyPhone is not a string
	 * @throw \TypeError if $newCompanyPhone is not a string
	 */
	public function setCompanyPhone(string $newCompanyPhone) {
		// Strip out the white space on either end of the string.
		$newCompanyPhone = trim($newCompanyPhone);
		// Sanitize $newCompanyPhone.
		$newCompanyPhone = filter_var($newCompanyPhone, FILTER_SANITIZE_STRING);
		// If $newCompanyPhone is empty or too long, then throw an exception.
		if(strlen($newCompanyPhone) === 0) {
			throw(new \RangeException("Company Phone is too short."));
		}
		if(strlen($newCompanyPhone) > 32) {
			throw(new \RangeException("Company Phone is too long."));
		}
		// Assign $newCompanyPhone to companyPhone, then store in SQL.
		$this->companyPhone = $newCompanyPhone;
	}

	/**  Accessor method (getter) for companyPermit.
	 * @return string $companyPermit  The value of companyPermit.
	 **/
	public function getCompanyPermit() {
		return ($this->companyPermit);
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
		//should be 32 not 128
		if(strlen($newCompanyPermit) > 32) {
			throw(new \RangeException("Company Permit is too long."));
		}
		// Assign $newCompanyPermit to companyPermit, then store in SQL.
		$this->companyPermit = $newCompanyPermit;
	}

	/**  Accessor method (getter) for companyLicense.
	 * @return string $companyLicense  The value of companyLicense.
	 **/
	public function getCompanyLicense() {
		return ($this->companyLicense);
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

		if(strlen($newCompanyLicense) > 32) {
			throw(new \RangeException("Company License is too long."));
		}
		// Assign $newCompanyLicense to companyLicense, then store in SQL.
		$this->companyLicense = $newCompanyLicense;
	}

	/**  Accessor method (getter) for companyAttn.
	 * @return string $companyAttn  The value of companyAttn.
	 **/
	public function getCompanyAttn() {
		return ($this->companyAttn);
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
		if(strlen($newCompanyAttn) > 128) {
			throw(new \RangeException("company Attn is too long."));
		}
		// Assign $newCompanyAttn to companyAttn, then store in SQL.
		$this->companyAttn = $newCompanyAttn;
	}

	/**  Accessor method (getter) for companyStreet1.
	 * @return string $companyStreet1  The value of companyStreet1.
	 **/
	public function getCompanyStreet1() {
		return ($this->companyStreet1);
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
		if(strlen($newCompanyStreet1) > 128) {
			throw(new \RangeException("company Street1 is too long."));
		}
		// Assign $newCompanyStreet1 to companyStreet1, then store in SQL.
		$this->companyStreet1 = $newCompanyStreet1;
	}

	/**  Accessor method (getter) for companyStreet2.
	 * @return string $companyStreet2  The value of companyStreet2.
	 **/
	public function getCompanyStreet2() {
		return ($this->companyStreet2);
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
		// If $newCompanyStreet2 is empty or too long, then throw an exception.
		if(strlen($newCompanyStreet2) === 0) {
			throw(new \RangeException("company Street2 is too short."));
		}
		if(strlen($newCompanyStreet2) > 128) {
			throw(new \RangeException("company Street2 is too long."));
		}
		// Assign $newCompanyStreet2 to companyStreet2, then store in SQL.
		$this->companyStreet2 = $newCompanyStreet2;
	}

	/**  Accessor method (getter) for companyCity.
	 * @return string $companyCity  The value of companyCity.
	 **/
	public function getCompanyCity() {
		return ($this->companyCity);
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
		// If $newCompanyCity is empty or too long, then throw an exception.
		if(strlen($newCompanyCity) === 0) {
			throw(new \RangeException("company City is too short."));
		}
		if(strlen($newCompanyCity) > 128) {
			throw(new \RangeException("company City is too long."));
		}
		// Assign $newCompanyCity to companyCity, then store in SQL.
		$this->companyCity = $newCompanyCity;
	}

	/**  Accessor method (getter) for companyState.
	 * @return string $companyState  The value of companyState
	 **/
	public function getCompanyState() {
		return ($this->companyState);
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
		// If $newCompanyState is empty or too long, then throw an exception.
		if(strlen($newCompanyState) === 0) {
			throw(new \RangeException("company State is too short."));
		}
		if(strlen($newCompanyState) > 128) {
			throw(new \RangeException("company State is too long."));
		}
		// Assign $newCompanyState to companyState, then store in SQL.
		$this->companyState = $newCompanyState;
	}

	/**  Accessor method (getter) for companyZip.
	 * @return int $companyZip  The value of companyZip.
	 **/
	public function getCompanyZip() {
		return ($this->companyZip);
	}

	/**
	 * Mutator method for companyZip.
	 * @param string , $newCompanyZip  The new value of companyZip.
	 * @throw \RangeException if $newCompanyZip is empty or too long
	 * @throw \InvalidArgumentException if $newCompanyZip is not a string
	 * @throw \TypeError if $newCompanyZip is not a string
	 * @author LB
	 */
	public function setCompanyZip(string $newCompanyZip) {
		// Strip out the white space on either end of the string.
		$newCompanyZip = trim($newCompanyZip);
		// Sanitize $newCompanyState.
		$newCompanyZip = filter_var($newCompanyZip, FILTER_SANITIZE_STRING);
		// If $newCompanyState is empty or too long, then throw an exception.



		if(strlen($newCompanyZip) < 5) {
			throw(new \RangeException("company zip is too short."));
		}
		if(strlen($newCompanyZip) > 10) {
			throw(new \RangeException("company zip is too long."));
		}
		// Assign $newCompanyState to companyState, then store in SQL.
		$this->companyZip = $newCompanyZip;
	}

	/**  Accessor method (getter) for companyDescription.
	 * @return string $companyDescription  The value of companyDescription.
	 **/
	public function getCompanyDescription() {
		return ($this->companyDescription);
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
		if(strlen($newCompanyDescription) > 128) {
			throw(new \RangeException("company Description is too long."));
		}
		// Assign $newCompanyDescription to companyDescription, then store in SQL.
		$this->companyDescription = $newCompanyDescription;
	}

	/**  Accessor method (getter) for companyMenuText.
	 * @return string $companyMenuText  The value of companyMenuText.
	 **/
	public function getCompanyMenuText() {
		return ($this->companyMenuText);
	}


// TODO Here is the weird foreign key, for the account creator:

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
		if(strlen($newCompanyMenuText) > 128) {
			throw(new \RangeException("company MenuText is too long."));
		}
		// Assign $newCompanyMenuText to companyMenuText, then store in SQL.
		$this->companyMenuText = $newCompanyMenuText;
	}

	/**  Accessor method (getter) for companyActivationToken.
	 * @return string $companyActivationToken  The value of companyActivationToken.
	 **/
	public function getCompanyActivationToken() {
		return ($this->companyActivationToken);
	}

	/**  Mutator method (setter) for companyActivationToken.
	 * @param string $newCompanyActivationToken The new value of companyActivationToken.
	 * @throws \RangeException  if #newcompanyActivationToken is not a positive.
	 * @throws \TypeError if $newCompanyActivationToken is not an integer.
	 **/
	public function setCompanyActivationToken($newCompanyActivationToken) {
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

	/**  Accessor method (getter) for companyApproved.
	 * @return bool $companyApproved  The value of companyApproved.
	 **/
	public function getCompanyApproved() {
		return ($this->companyApproved);
	}

	/**  Mutator method (setter) for companyApproved.
	 * @param bool $newCompanyApproved The new value of companyApproved.
	 **/
	public function setCompanyApproved( bool $newCompanyApproved = null) {
		if ($newCompanyApproved === null) {
			$this->companyApproved = null;
			return;
		}

		// Assign $newCompanyApproved to companyApproved, then store in SQL.
		$this->companyApproved = $newCompanyApproved;
	}

	/**  Accessor method (getter) for companyAccountCreatorId.
	 * @return int $companyAccountCreatorId  The value of companyAccountCreatorId.
	 **/
	public function getCompanyAccountCreatorId() {
		return ($this->companyAccountCreatorId);
	}

	/**  Mutator method (setter) for companyAccountCreatorId.
	 * @param int|null $newCompanyAccountCreatorId The new value of companyAccountCreatorId.
	 * @throws \RangeException  if #newcompanyAccountCreatorId is not a positive.
	 * @throws \TypeError if $newCompanyAccountCreatorId is not an integer.
	 **/

	public function setCompanyAccountCreatorId(int $newCompanyAccountCreatorId) {
		//this is a reference to profileId, verify that it is positive
		if($newCompanyAccountCreatorId <= 0) {
			throw(new \RangeException("companyAccountCreatorId is not positive"));
		}

		//covert and store the companyAccountCreatorId
		$this->companyAccountCreatorId = $newCompanyAccountCreatorId;
	}

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
		$query = "INSERT INTO company(companyAccountCreatorId, companyName, companyEmail, companyPhone, companyPermit, companyLicense, companyAttn, companyStreet1, companyStreet2, companyCity, companyState, companyZip, companyDescription, companyMenuText, companyActivationToken, companyApproved) VALUES(:companyAccountCreatorId, :companyName, :companyEmail, :companyPhone, :companyPermit, :companyLicense, :companyAttn, :companyStreet1, :companyStreet2, :companyCity, :companyState, :companyZip, :companyDescription, :companyMenuText, :companyActivationToken, :companyApproved)";

		// Prepare is used as an extra means of security.
		$statement = $pdo->prepare($query);

		// change the format of the boolean companyApproved
		if($this->companyApproved === false) {
			$formatCompanyApproved = 0;
		} else {
			$formatCompanyApproved = $this->companyApproved;
		}

		// Bind the variables to the place holder slots in the template, then put into an array.
		$parameters = ["companyAccountCreatorId" => $this->companyAccountCreatorId, "companyName" => $this->companyName, "companyEmail" => $this->companyEmail, "companyPhone" => $this->companyPhone, "companyPermit" => $this->companyPermit, "companyLicense" => $this->companyLicense, "companyAttn" => $this->companyAttn, "companyStreet1" => $this->companyStreet1, "companyStreet2" => $this->companyStreet2, "companyCity" => $this->companyCity, "companyState" => $this->companyState, "companyZip" => $this->companyZip, "companyDescription" => $this->companyDescription, "companyMenuText" => $this->companyMenuText, "companyActivationToken" => $this->companyActivationToken, "companyApproved" => $formatCompanyApproved];

		//execute the command held in $statement
		$statement->execute($parameters);

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
		$query = "UPDATE company SET companyAccountCreatorId = :companyAccountCreatorId, companyName = :companyName, companyEmail = :companyEmail, companyPhone = :companyPhone, companyPermit = :companyPermit, companyLicense = :companyLicense, companyAttn = :companyAttn, companyStreet1 = :companyStreet1, companyStreet2 = :companyStreet2, companyCity = :companyCity, companyState = :companyState, companyZip = :companyZip, companyDescription = :companyDescription, companyMenuText = :companyMenuText, companyActivationToken = :companyActivationToken, companyApproved = :companyApproved WHERE companyId = :companyId";

		// Prepare this query.
		$statement = $pdo->prepare($query);

		// change the format of the boolean companyApproved
		if($this->companyApproved === false) {
			$formatCompanyApproved = 0;
		} else {
			$formatCompanyApproved = $this->companyApproved;
		}

		// Bind the variables to the template.

		//taking "companyAccountCreatorId" => $this->companyAccountCreatorId out of array for update
		$parameters = ["companyAccountCreatorId" => $this->companyAccountCreatorId, "companyName" => $this->companyName, "companyEmail" => $this->companyEmail, "companyPhone" => $this->companyPhone, "companyPermit" => $this->companyPermit, "companyLicense" => $this->companyLicense, "companyAttn" => $this->companyAttn, "companyStreet1" => $this->companyStreet1, "companyStreet2" => $this->companyStreet2, "companyCity" => $this->companyCity, "companyState" => $this->companyState, "companyZip" => $this->companyZip, "companyDescription" => $this->companyDescription, "companyMenuText" => $this->companyMenuText, "companyActivationToken" => $this->companyActivationToken, "companyApproved" => $formatCompanyApproved, "companyId" => $this->companyId];

		// Execute the mySQL statement.
		$statement->execute($parameters);
	}

	/**
	 * Formats the state variables for JSON serialization.
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		return($fields);
	}
}