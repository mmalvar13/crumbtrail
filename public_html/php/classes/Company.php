<?php

namespace Edu\Cnm\mmalvar13\crumbtrail;
require_once("autoload.php");

/**
 * class Company for the Company entity in crumbtrail application.
 * State variables, constructor, mutators, accessors, PDOs, and getFooByBar methods.
 * @author Kevin Lee Kirk
 */

class Company {
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
	 * If this company's registration has been approved by us, then
	 * companyApproved = TRUE, else FALSE.
	 * @var bool $companyApproved
	 **/
	private $companyApproved;

	/**
	 * The id of the creator of the account of this company.
	 * @var int $companyAccountCreatorId
	 **/
	private $companyAccountCreatorId;



	/**  Accessor method (getter) for companyId.
	 * @return int $companyId  The value of companyId.
	 **/
	public function getCompanyId() {
		return($this->companyId);
	}

	/**  Accessor method (getter) for companyName.
	 * @return string $companyName  The value of companyName.
	 **/
	public function getCompanyName() {
		return($this->companyName);
	}

	/**  Accessor method (getter) for companyEmail.
	 * @return string $companyEmail  The value of companyEmail.
	 **/
	public function getCompanyEmail() {
		return($this->companyEmail);
	}

	/**  Accessor method (getter) for companyPermit.
	 * @return string $companyPermit  The value of companyPermit.
	 **/
	public function getCompanyPermit() {
		return($this->companyPermit);
	}

	/**  Accessor method (getter) for companyLicense.
	 * @return int $companyLicense  The value of companyLicense.
	 **/
	public function getCompanyLicense() {
		return($this->companyLicense);
	}

	/**  Accessor method (getter) for companyAttn.
	 * @return string $companyAttn  The value of companyAttn.
	 **/
	public function getCompanyAttn() {
		return($this->companyAttn);
	}

	/**  Accessor method (getter) for companyStreet1.
	 * @return string $companyStreet1  The value of companyStreet1.
	 **/
	public function getCompanyStreet1() {
		return($this->companyStreet1);
	}

	/**  Accessor method (getter) for companyStreet2.
	 * @return string $companyStreet2  The value of companyStreet2.
	 **/
	public function getCompanyStreet2() {
		return($this->companyStreet2);
	}

	/**  Accessor method (getter) for companyCity.
	 * @return string $companyCity  The value of companyCity.
	 **/
	public function getCompanyCity() {
		return($this->companyCity);
	}

	/**  Accessor method (getter) for companyState.
	 * @return string $companyState  The value of companyState
	 **/
	public function getCompanyState() {
		return($this->companyState);
	}

	/**  Accessor method (getter) for companyZip.
	 * @return int $companyZip  The value of companyZip.
	 **/
	public function getCompanyZip() {
		return($this->companyZip);
	}

	/**  Accessor method (getter) for companyDescription.
	 * @return string $companyDescription  The value of companyDescription.
	 **/
	public function getCompanyDescription() {
		return($this->companyDescription);
	}

	/**  Accessor method (getter) for companyMenuText.
	 * @return string $companyMenuText  The value of companyMenuText.
	 **/
	public function getCompanyMenuText() {
		return($this->companyMenuText);
	}

	/**  Accessor method (getter) for companyActivationToken.
	 * @return int $companyActivationToken  The value of companyActivationToken.
	 **/
	public function getCompanyActivationToken() {
		return($this->companyActivationToken);
	}

	/**  Accessor method (getter) for companyApproval.
	 * @return bool $companyApproval  The value of companyApproval.
	 **/
	public function getCompanyApproval() {
		return($this->companyApproval);
	}

	/**  Accessor method (getter) for companyAccountCreator.
	 * @return int $companyAccountCreator  The value of companyAccountCreator.
	 **/
	public function getCompanyAccountCreator() {
		return($this->companyAccountCreator);
	}


	/**  Mutator method (setter) for companyId.
	 * @param int|null $newCompanyId  The new value of companyId.
	 * @throws \RangeException  if #newCompanyId is not a positive.
	 * @throws \TypeError if $newCompanyId is not an integer.
	 **/
	public function setCompanyId($newCompanyId = null) {
		// Base case, for a new company.
		if($newCompanyId===null) {
			$this->companyId = null;
			return;
		}

		// Is $newCompanyId positive?  If not, then throw an exception.
		if($newCompanyId <= 0) {
			throw(new \RangeException("The company ID is not positive."));
		}

		$this->companyId = ($newCompanyId);
	}

	/**
	 * Mutator method for companyName.
	 * @param string, $newCompanyName  The new value of companyName.
	 * @throw \RangeException if $newCompanyName is empty or too long
	 * @throw \InvalidArgumentException if $newCompanyName is not a string
	 * @throw \TypeError if $newCompanyName is not a string
	 */
	public function setCompanyName(string $newCompanyName){
		// Strip out the white space on either end of the string.
		$newCompanyName = trim($newCompanyName);
		// Sanitize $newCompanyName.
		$newCompanyName = filter_var($newCompanyName, FILTER_SANITIZE_STRING);
		// If $newCompanyName is empty or too long, then throw an exception.
		if(strlen($newCompanyName) === 0){
			throw(new \RangeException("Company name is too short."));
		}
		if(strlen($newCompanyName > 128)){
			throw(new \RangeException("Company name is too long."));
		}
		// Assign $newProfileName to profileName, then store in SQL.
		$this->companyName = $newCompanyName;
	}











	/**
	 * Constructor for this instantiation of the class Company.
	 * This creates a new company object.
	 * A constructor = a magic method = a contract.
	 * @param int $newCompanyId  The new companyId.
	 * @throws UnexpectedValueException  If parameter is invalid, throw an exception.
	 **/
	public function __construct($newCompanyId, ...) {
		try {
			$this->setCompanyId($newCompanyId);
		} catch(UnexpectedValueException $exception) {
			throw(new UnexpectedValueException("Unable to construct Company"), 0, $exception));
		// 					***  NEED more exception catch and throw statements  ***
		}
	}
}




}