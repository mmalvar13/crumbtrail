<?php

namespace Edu\Cnm\CrumbTrail;

require_once("autoload.php");

/**
 * Class ExtraServing
 *
 * this class is used to keep track of the most special and unique of food truck
 * serving events. These 'Extra Servings' will be uncommon events the food-truck company plans to attend
 * sometime in the future
 *
 * Author @L   baca.loren@gmail.com
 */
class ExtraServing implements \JsonSerializable {

	use ValidateDate;

	/**
	 * primary key for ExtraServing Class
	 * @var int $extraServingId
	 */
	private $extraServingId;

	/**
	 * foreign key to Company Class
	 * @var int $extraServingCompanyId
	 */
	private $extraServingCompanyId;

	/**
	 * description of the extra serving event
	 * @var string $extraServingDescription
	 */
	private $extraServingDescription;

	/**
	 * location address of where the food truck will be serving
	 * @var string $extraServingLocationAddress
	 */
	private $extraServingLocationAddress;

	/**
	 * location Name of where the food truck will be serving
	 * @var string $extraServingLocationName
	 */
	private $extraServingLocationName

	/**
	 * start time of the extra serving event
	 * @var \DateTime $extraServingStartTime
	 */
	private $extraServingStartTime;

	/**
	 * end time of the extra serving event
	 * @var \DateTime $extraServingEndTime
	 */
	private $extraServingEndTime;


	/**
	 * constructor for extraServing
	 */


//	--------------------------------------SETTERS AND GETTERS SECTION---------------------------------

	/**
	 * getter for extraServingId
	 * @return int|null for $extraServingId
	 */

	public function getExtraServingId() {
		return ($this->extraServingId);

	}

	/**
	 * setter for extraServingId
	 * @param int|null $newExtraServingId
	 * @throws \InvalidArgumentException if $newExtraServingId not valid
	 * @throws \RangeException if $newExtraServingId negative or zero
	 * @throws \TypeError if $newExtraServingId not an int
	 */

	public function setExtraServingId(int $newExtraServingId = null) {

		if($newExtraServingId === null) {
			$this->extraServingId = null;
			return;
		}

		if($newExtraServingId <= 0) {
			throw(new \RangeException("The Extra Serving ID cannot be negative or zero"));
		}

		$this->extraServingId = $newExtraServingId;
	}


	/**
	 * getter for extraServingCompanyId
	 * @return int|null for $extraServingCompanyId
	 */
	public function getExtraServingCompanyId() {
		return ($this->extraServingCompanyId);
	}

	/**
	 * setter for extraServingCompanyId
	 * @param int|null for $newExtraServingCompanyId
	 * @throws \InvalidArgumentException if $newExtraServingCompanyId not valid
	 * @throws \RangeException if $newExtraServingCompanyId is less than or equal to zero
	 * @throws \TypeError if $newExtraServingCompanyId not an int
	 */
	public function setExtraServingCompanyId(int $newExtraServingCompanyId) {
		if($newExtraServingCompanyId <= 0) {
			throw(new \RangeException("company ID cannot be negative or zero!"));
		}
		$this->extraServingCompanyId = $newExtraServingCompanyId;

	}


	/**
	 * getter for extraServingDescription
	 * @return string for $extraServingDescription
	 */
	public function getExtraServingDescription() {
		return ($this->extraServingCompanyId);
	}

	/**
	 * setter for extraServingDescription
	 * @param string $newExtraServingDescription
	 * @throws \InvalidArgumentException if $newExtraServingDescription not a string or insecure
	 * @throws \RangeException if $newExtraServingDescription longer than 4096 char
	 * @throws \TypeError if $newExtraServingDescription not a string
	 */
	public function setExtraServingDescription(string $newExtraServingDescription) {

		$newExtraServingDescription = trim($newExtraServingDescription);
		$newExtraServingDescription = filter_var($newExtraServingDescription, FILTER_SANITIZE_STRING);

		if(strlen($newExtraServingDescription) === 0) {
			throw(new \InvalidArgumentException("Please enter a description!"));
		}

		if(strlen($newExtraServingDescription) > 4096) {
			throw(new \InvalidArgumentException("The description is too long!"));
		}

		$this->extraServingDescription = $newExtraServingDescription;
	}


	/**
	 * getter for extraServingLocationAddress
	 * @return string for $extraServingLocationAddress
	 */
	public function getExtraServingLocationAddress() {
		return ($this->extraServingLocationAddress);
	}

	/**
	 * setter for extraServingLocationAddress
	 * @param string $newExtraServingLocationAddress
	 * @throws \InvalidArgumentException if $newExtraServingLocationAddress not a string or insecure
	 * @throws \RangeException if $newExtraServingLocationAddress longer than 512 char
	 * @throws \TypeError if $newExtraServingLocationAddress not a string
	 */
	public function setExtraServingLocationAddress(string $newExtraServingLocationAddress) {

		$newExtraServingLocationAddress = trim($newExtraServingLocationAddress);
		$newExtraServingLocationAddress = filter_var($newExtraServingLocationAddress, FILTER_SANITIZE_STRING);

		if(strlen($newExtraServingLocationAddress) === 0) {
			throw(new \InvalidArgumentException("Please enter a location address!"));
		}

		if(strlen($newExtraServingLocationAddress) > 512) {
			throw(new \InvalidArgumentException("The location address is too long!"));
		}

		$this->extraServingLocationAddress = $newExtraServingLocationAddress;
	}






	/**
	 * getter for extraServingLocationName
	 * @return string for $extraServingLocationName
	 */
	public function getExtraServingLocationName() {
		return ($this->extraServingLocationName);
	}

	/**
	 * setter for extraServingLocationName
	 * @param string $newExtraServingLocationName
	 * @throws \InvalidArgumentException if $newExtraServingLocationName not a string or insecure
	 * @throws \RangeException if $newExtraServingLocationName longer than 512 char
	 * @throws \TypeError if $newExtraServingLocationName not a string
	 */
	public function setExtraServingLocationName(string $newExtraServingLocationName) {

		$newExtraServingLocationName = trim($newExtraServingLocationName);
		$newExtraServingLocationName = filter_var($newExtraServingLocationName, FILTER_SANITIZE_STRING);

		if(strlen($newExtraServingLocationName) === 0) {
			throw(new \InvalidArgumentException("Please enter a location name!"));
		}

		if(strlen($newExtraServingLocationName) > 512) {
			throw(new \InvalidArgumentException("The location name is too long!"));
		}

		$this->extraServingLocationName = $newExtraServingLocationName;
	}


	/**
	 * getter for extraServingStartTime
	 * @return \DateTime for $extraServingStartTime
	 */
	public function getExtraServingStartTime() {
		return ($this->extraServingStartTime);
	}

	/**
	 * setter for extraServingStartTime
	 * @param \DateTime|string for $newExtraServingStartTime
	 * @throws \InvalidArgumentException if $newExtraServingStartTime is null or not a valid date-time
	 * @throws \RangeException if $newExtraServingStartTime is less than current date-time
	 */
	public function setExtraServingStartTime(\DateTime $newExtraServingStartTime) {

		if($newExtraServingStartTime === null) {
			throw(new \InvalidArgumentException("The start time cannot be null!"));
		}

		$currentTime = new \DateTime();

		if($newExtraServingStartTime < $currentTime) {
			throw(new \RangeException("The start time cannot be in the past!"));
		}

		try {
			$newExtraServingStartTime = self::validateDate($newExtraServingStartTime);
		} catch(\InvalidArgumentException $invalidArgument) {
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			throw(new \RangeException($range->getMessage(), 0, $range));
		}

		$this->extraServingStartTime = $newExtraServingStartTime;
	}


	/**
	 * getter for extraServingEndTime
	 * @return \DateTime for $extraServingEndTime
	 */
	public function getExtraServingEndTime() {
		return ($this->extraServingEndTime);
	}

	/**
	 * setter for extraServingEndTime
	 * @param \DateTime|string for $newExtraServingEndTime
	 * @throws \InvalidArgumentException if $newExtraServingEndTime is null or not a valid date-time
	 * @throws \RangeException if $newExtraServingEndTime is less than current date-time
	 */
	public function setExtraServingEndTime(\DateTime $newExtraServingEndTime) {

		if($newExtraServingEndTime === null) {
			throw(new \InvalidArgumentException("The End time cannot be null!"));
		}


		if($newExtraServingEndTime <= $this->extraServingStartTime) {
			throw(new \RangeException("The End time cannot be before the start time!"));
		}

		try {
			$newExtraServingEndTime = self::validateDate($newExtraServingEndTime);
		} catch(\InvalidArgumentException $invalidArgument) {
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			throw(new \RangeException($range->getMessage(), 0, $range));
		}

		$this->extraServingEndTime = $newExtraServingEndTime;
	}


//	------------------------------------------------------SQL Methods-----------------------------------------------------

	/**
	 * insert method for the ExtraServing Class
	 * @param \PDO $pdo connection object
	 * @throws \PDOException when PDO related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 */

	public function insert(\PDO $pdo) {
		if($this->extraServingId != null) {
			throw(new \PDOException("This is not a new Extra Serving Object!"));
		}

		$query = "INSERT INTO extraServing(extraServingCompanyId, extraServingDescription, extraServingEndTime, extraServingLocation, extraServingStartTime) VALUES(:extraServingId, :extraServingCompanyId, :extraServingDescription, :extraServingEndTime, :extraServingLocation, :extraServingStartTime)";

		$statement = $pdo->prepare($query);

		//Format the time/dates so all is uniform and ready to go into SQL...isnt this already done in the ValidateDate trait?
		//if not...couldn't I just do this up in the setter for start and end time?

		$formattedExtraServingEndTime = $this->extraServingEndTime->format("Y-m-d H:i:s");
		$formattedExtraServingStartTime = $this->extraServingStartTime->format("Y-m-d H:i:s");

		$parameters = ["extraServingCompanyId" => $this->extraServingCompanyId, "extraServingDescription" => $this->extraServingDescription, "extraServingEndTime" => $this->$formattedExtraServingEndTime, "extraServingLocation" => $this->extraServingLocation, "extraServingStartTime" => $this->$formattedExtraServingStartTime];

		$statement->execute($parameters);


		//ask SQL for the primary key it just assigned to this insertion
		$this->extraServingId = intval($pdo->lastInsertId());

	}



	/**
	 * update method for the ExtraServing Class
	 * @param \PDO $pdo connection object
	 * @throws \PDOException when PDO related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 */

	public function update(\PDO $pdo) {
		if($this->extraServingId === null) {
			throw(new \PDOException("Cannot update an extra serving object that doesn't exist!"));
		}

		$query = "UPDATE extraServing SET extraServingCompanyId = :extraServingCompanyId, extraServingDescription = :extraServingDescription, extraServingEndTime = :extraServingEndTime, extraServingLocation = :extraServingLocation, extraServingStartTime = :extraServingStartTime WHERE extraServingId = : extraServingId";

		$statement = $pdo->prepare($query);

		//Format the time/dates so all is uniform and ready to go into SQL

		$formattedExtraServingEndTime = $this->extraServingEndTime->format("Y-m-d H:i:s");
		$formattedExtraServingStartTime = $this->extraServingStartTime->format("Y-m-d H:i:s");

		$parameters = ["extraServingCompanyId" => $this->extraServingCompanyId, "extraServingDescription" => $this->extraServingDescription, "extraServingEndTime" => $this->$formattedExtraServingEndTime, "extraServingLocation" => $this->extraServingLocation, "extraServingStartTime" => $this->$formattedExtraServingStartTime, "extraServingId" => $this->extraServingId];

		$statement->execute($parameters);
		}



	/**
	 * delete method for the ExtraServing Class
	 * @param \PDO $pdo connection object
	 * @throws \PDOException when PDO related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 */

	public function delete(\PDO $pdo){
		if($this->extraServingId === null) {
			throw(new \PDOException("Cannot delete an extra serving object that doesn't exist!"));
		}

		$query = "DELETE FROM extraServing WHERE extraServingId = extraServingId";

		$statement = $pdo->prepare($query);

		$parameters = ["extraServingId" => $this->extraServingId];

		$statement->execute($parameters);
	}


}