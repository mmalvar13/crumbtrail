<?php

class Company {
	/**
	 * The primary key = companyId.
	 * @var int $companyId
	 **/
	private $companyId;

	/**
	 * The name of the food truck company, companyName.
	 * @var string $companyName					??? Do I need to declare a variable type here ???
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



// The code below is a placeholder, from the tweet example:

	/**  Accessor method (getter) for companyId.
	 * @return int $companyId  The value of companyId.
	 **/
	public function getCompanyId() {
		return($this->companyId);
	}


	/**  Mutator method (setter) for companyId.
	 * @param int $newCompanyId  The new value of companyId.
	 * @throws UnexpectedValueException  if #newCompanyId is not an integer.
	 **/
	public function setCompanyId($newCompanyId) {
		//  ***   Do the filter_var stuff, to make sure the tweetId is valid and safe.  ***

		$this->companyId = intval($newCompanyId);
	}

	//  Now, write accessor and mutator methods for each of the rest of
	//  the attributes of class Company.


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