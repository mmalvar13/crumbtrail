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
	 * end time of the extra serving event
	 * @var \DateTime $extraServingEndTime
	 */
	private $extraServingEndTime;

	/**
	 * location address of where the food truck will be serving
	 * @var string $extraServingLocationAddress
	 */
	private $extraServingLocationAddress;

	/**
	 * location Name of where the food truck will be serving
	 * @var string $extraServingLocationName
	 */
	private $extraServingLocationName;

	/**
	 * start time of the extra serving event
	 * @var \DateTime $extraServingStartTime
	 */
	private $extraServingStartTime;




	/**
	 * ExtraServing constructor
	 *
	 * @param int|null $newExtraServingId, null if new ID
	 * @param  int $newExtraServingCompanyId
	 * @param string $newExtraServingDescription
	 * @param \DateTime $newExtraServingEndTime
	 * @param string $newExtraServingLocationAddress
	 * @param  string $newExtraServingLocationName
	 * @param \DateTime $newExtraServingStartTime
	 *
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 *
	 */
	public function __construct(int $newExtraServingId = null, int $newExtraServingCompanyId, string $newExtraServingDescription, \DateTime $newExtraServingEndTime, string $newExtraServingLocationAddress, string $newExtraServingLocationName, \DateTime $newExtraServingStartTime) {

		try{

			$this->setExtraServingId($newExtraServingId);
			$this->setExtraServingCompanyId($newExtraServingCompanyId);
			$this->setExtraServingDescription($newExtraServingDescription);
			$this->setExtraServingEndTime($newExtraServingEndTime);
			$this->setExtraServingLocationAddress($newExtraServingLocationAddress);
			$this->setExtraServingLocationName($newExtraServingLocationName);
			$this->setExtraServingStartTime($newExtraServingStartTime);
		}catch(\InvalidArgumentException $invalidArgument) {
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

		try {
			$newExtraServingStartTime = self::validateDate($newExtraServingStartTime);
		} catch(\InvalidArgumentException $invalidArgument) {
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			throw(new \RangeException($range->getMessage(), 0, $range));
		}

		if($newExtraServingStartTime < $currentTime) {
			throw(new \RangeException("The start time cannot be in the past!"));
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


		//I FEEL LIKE I SHOULD BE DOING THE FORMAT DONE IN insert and update HERE INSTEAD!


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

		$query = "INSERT INTO extraServing(extraServingCompanyId, extraServingDescription, extraServingEndTime, extraServingLocationAddress, extraServingLocationName, extraServingStartTime) VALUES(:extraServingCompanyId, :extraServingDescription, :extraServingEndTime, :extraServingLocationAddress, :extraServingLocationName, :extraServingStartTime)";

		$statement = $pdo->prepare($query);

		//Format the time/dates so all is uniform and ready to go into SQL...isnt this already done in the ValidateDate trait?
		//if not...couldn't I just do this up in the setter for start and end time?

		$formattedExtraServingEndTime = $this->extraServingEndTime->format("Y-m-d H:i:s");
		$formattedExtraServingStartTime = $this->extraServingStartTime->format("Y-m-d H:i:s");

		$parameters = ["extraServingCompanyId" => $this->extraServingCompanyId, "extraServingDescription" => $this->extraServingDescription, "extraServingEndTime" => $this->$formattedExtraServingEndTime, "extraServingLocationAddress" => $this->extraServingLocationAddress, "extraServingLocationName" => $this->extraServingLocationName, "extraServingStartTime" => $this->$formattedExtraServingStartTime];

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

		$query = "UPDATE extraServing SET extraServingCompanyId = :extraServingCompanyId, extraServingDescription = :extraServingDescription, extraServingEndTime = :extraServingEndTime, extraServingLocationAddress = :extraServingLocationAddress, extraServingLocationName = :extraServingLocationName, extraServingStartTime = :extraServingStartTime WHERE extraServingId = :extraServingId";

		$statement = $pdo->prepare($query);

		//Format the time/dates so all is uniform and ready to go into SQL

		$formattedExtraServingEndTime = $this->extraServingEndTime->format("Y-m-d H:i:s");
		$formattedExtraServingStartTime = $this->extraServingStartTime->format("Y-m-d H:i:s");

		$parameters = ["extraServingCompanyId" => $this->extraServingCompanyId, "extraServingDescription" => $this->extraServingDescription, "extraServingEndTime" => $this->$formattedExtraServingEndTime, "extraServingLocationAddress" => $this->extraServingLocationAddress, "extraServingLocationName" => $this->extraServingLocationName, "extraServingStartTime" => $this->$formattedExtraServingStartTime, "extraServingId" => $this->extraServingId];

		$statement->execute($parameters);
	}



	/**
	 * delete method for the ExtraServing Class
	 * @param \PDO $pdo connection object
	 * @throws \PDOException when PDO related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 */

	public function delete(\PDO $pdo) {
		if($this->extraServingId === null) {
			throw(new \PDOException("Cannot delete an extra serving object that doesn't exist!"));
		}

		$query = "DELETE FROM extraServing WHERE extraServingId = extraServingId";

		$statement = $pdo->prepare($query);

		$parameters = ["extraServingId" => $this->extraServingId];

		$statement->execute($parameters);
	}



//	-------------------------------------------------GET FOO BY BAR METHOD SECTION----------------------------------------

	/**
	 * get extra serving by extraServingId
	 *
	 * @param \PDO $pdo connection object
	 * @param int $extraServingId is the id to search for
	 * @return extraServing|null
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 */

	public static function getExtraServingByExtraServingId(\PDO $pdo, int $extraServingId) {

		//make sure id isnt wack
		if($extraServingId <= 0) {
			throw(new \PDOException("the primary key cannot be 0 or negative!"));
		}

		//make template
		$query = "SELECT extraServingId, extraServingCompanyId, extraServingDescription, extraServingEndTIme, ExtraServingLocationAddress, extraServingLocationName, extraServingStartTime FROM extraServing WHERE extraServingId = :extraServingId";

		$statement = $pdo->prepare($query);

		//bind the id to its placeholder inside the template
		//we dont use $this->$extraServingId, because we arent pulling the value of the state variable,
		//we want to use the value passed into the function
		$parameters = ["extraServingId" => $extraServingId];

		$statement->execute($parameters);

		try {
			//new variable $extraServing is what we will assign all the information in this object to, and return to whatever called this method
			$extraServing = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);

			$row = $statement->fetch();

			if($row != false) {
				//set $extraServing to a new object based on the ExtraServing class
				$extraServing = new ExtraServing($row["extraServingId"], $row["extraServingCompanyId"], $row["extraServingDescription"], $row["extraServingEndTime"], $row["extraServingLocationAddress"], $row["extraServingLocationName"], $row["extraServingStartTime"]);
			}
		} catch(\Exception $exception) {
			// if the row couldnt be converted, re-throw it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($extraServing);
	}



	/**
	 * get the extraServing by the extraServingCompanyId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $extraServingCompanyId event company id to search by
	 * @return \SplFixedArray SplFixedArray of extraServings found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/

	public static function getExtraServingByExtraServingCompanyId(\PDO $pdo, int $extraServingCompanyId) {

		if($extraServingCompanyId <= 0) {
			throw(new \PDOException("The foreign key to company cannot be 0 or negative!"));
		}

		//make template
		$query = "SELECT extraServingId, extraServingCompanyId, extraServingDescription, extraServingEndTime, ExtraServingLocationAddress, extraServingLocationName, extraServingStartTime FROM extraServing WHERE extraServingCompanyId = :extraServingCompanyId";

		$statement = $pdo->prepare($query);

		//bind the id to its placeholder inside the template
		//we dont use $this->$extraServingId, because we arent pulling the value of the state variable,
		//we want to use the value passed into the function
		$parameters = ["extraServingCompanyId" => $extraServingCompanyId];

		$statement->execute($parameters);

		//construct array for all the objects to go into
		// \SplFixedArray take in a parameter of how long it should be. $statement->rowCount() give the number of rows found in the database
		$extraServings = new \SplFixedArray($statement->rowCount());

		// PDO::FETCH_ASSOC tells PDO to return the result as an associative array. The array keys will match your column names.
		$statement->setFetchMode(\PDO::FETCH_ASSOC);

		//why there are still rows with juicy, juicy data in them, keep this party going
		while(($row = $statement->fetch()) != false) {

			try {

				$extraServing = new ExtraServing($row["extraServingId"], $row["extraServingCompanyId"], $row["extraServingDescription"], $row["extraServingEndTime"], $row["extraServingLocationAddress"], $row["extraServingLocationName"], $row["extraServingStartTime"]);

				$extraServings[$extraServings->key()] = $extraServing;

				// next() advances the internal array pointer one place forward before returning the element value. That means it returns the next array value and advances the internal array pointer by one.
				$extraServings->next();

			}catch(\Exception $exception) {
				// if the row couldnt be converted, re-throw it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}

		}
		return ($extraServings);
	}




	/**
	 * get the extraServing by the extraServingId and extraServingCompanyId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $extraServingId event id to search by
	 * @param int $extraServingCompanyId company id to search by
	 * @return extraServing|null
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/

	public static function getExtraServingByExtraServingIdAndExtraServingCompanyId(\PDO $pdo, int $extraServingId, int $extraServingCompanyId) {

		if($extraServingCompanyId <= 0 || $extraServingId <=0) {
			throw(new \PDOException("The primary and foreign key cannot be 0 or negative!"));
		}

		//make template
		$query = "SELECT extraServingId, extraServingCompanyId, extraServingDescription, extraServingEndTIme, ExtraServingLocationAddress, extraServingLocationName, extraServingStartTime FROM extraServing WHERE extraServingId = :extraServingId AND extraServingCompanyId = :extraServingCompanyId";

		$statement = $pdo->prepare($query);

		//bind the id to its placeholder inside the template
		//we dont use $this->$extraServingId, because we arent pulling the value of the state variable,
		//we want to use the value passed into the function
		$parameters = ["extraServingId" => $extraServingId, "extraServingCompanyId"=>$extraServingCompanyId];

		$statement->execute($parameters);

		try {
			//new variable $extraServing is what we will assign all the information in this object to, and return to whatever called this method
			$extraServing = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);

			$row = $statement->fetch();

			if($row != false) {
				//set $extraServing to a new object based on the ExtraServing class
				$extraServing = new ExtraServing($row["extraServingId"], $row["extraServingCompanyId"], $row["extraServingDescription"], $row["extraServingEndTime"], $row["extraServingLocationAddress"], $row["extraServingLocationName"], $row["extraServingStartTime"]);
			}
		} catch(\Exception $exception) {
			// if the row couldnt be converted, re-throw it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($extraServing);
	}


	/**
	 * gets extraServing by the description
	 * @param \PDO $pdo PDO connection object
	 * @param string $extraServingDescription used as the description to search for
	 * @return \SplFixedArray SplFixedArray of extraServings found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 */

	public static function getExtraServingByExtraServingDescription(\PDO $pdo, string $extraServingDescription){

		if(empty($extraServingDescription)){
			throw(new \PDOException("The description is empty!"));
		}

		if(strlen($extraServingDescription)> 4096){
			throw(new \PDOException("The description is too long!"));
		}

		//make template
		$query = "SELECT extraServingId, extraServingCompanyId, extraServingDescription, extraServingEndTIme, ExtraServingLocationAddress, extraServingLocationName, extraServingStartTime FROM extraServing WHERE extraServingDescription = :extraServingDescription";

		$statement = $pdo->prepare($query);

		$extraServingDescription = "%$extraServingDescription%";
		$parameters = ["extraServingDescription"=> $extraServingDescription];
		$statement->execute($parameters);

		$extraServings = new \SplFixedArray($statement->rowCount());

		// remember...PDO::FETCH_ASSOC tells PDO to return the result as an associative array. The array keys will match your column names.
		$statement->setFetchMode(\PDO::FETCH_ASSOC);

		while(($row = $statement->fetch()) != false) {

			try {

				$extraServing = new ExtraServing($row["extraServingId"], $row["extraServingCompanyId"], $row["extraServingDescription"], $row["extraServingEndTime"], $row["extraServingLocationAddress"], $row["extraServingLocationName"], $row["extraServingStartTime"]);

				$extraServings[$extraServings->key()] = $extraServing;

				// next() advances the internal array pointer one place forward before returning the element value. That means it returns the next array value and advances the internal array pointer by one.
				$extraServings->next();

			}catch(\Exception $exception) {
				// if the row couldnt be converted, re-throw it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}

		}
		return ($extraServings);
	}




	/**
	 * gets extraServing by the address
	 * @param \PDO $pdo PDO connection object
	 * @param string $extraServingAddress used as the address to search for
	 * @return \SplFixedArray SplFixedArray of extraServings found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 */

	public static function getExtraServingByExtraServingAddress(\PDO $pdo, string $extraServingAddress){

		//IM MAKING THIS RETURN AN ARRAY FOR ALL MATCHES THAT ARE CLOSE TO THE TERM SEARCHED FOR
		//JUST IN CASE YOU ONLY KNOW PART OF THE ADDRESS. mAY NEED TO CHANGE THIS TO A STRICT SEARCH IN THE FUTURE
		//THAT JUST RETURNS A SINGLE OBJECT

		if(empty($extraServingAddress)){
			throw(new \PDOException("The address is empty!"));
		}

		if(strlen($extraServingAddress)> 512){
			throw(new \PDOException("The address is too long!"));
		}

		//make template
		$query = "SELECT extraServingId, extraServingCompanyId, extraServingDescription, extraServingEndTIme, ExtraServingLocationAddress, extraServingLocationName, extraServingStartTime FROM extraServing WHERE ExtraServingLocationAddress = :ExtraServingLocationAddress";

		$statement = $pdo->prepare($query);

		$extraServingAddress = "%$extraServingAddress%";
		$parameters = ["extraServingAddress"=> $extraServingAddress];
		$statement->execute($parameters);

		$extraServings = new \SplFixedArray($statement->rowCount());

		// remember...PDO::FETCH_ASSOC tells PDO to return the result as an associative array. The array keys will match your column names.
		$statement->setFetchMode(\PDO::FETCH_ASSOC);

		while(($row = $statement->fetch()) != false) {

			try {

				$extraServing = new ExtraServing($row["extraServingId"], $row["extraServingCompanyId"], $row["extraServingDescription"], $row["extraServingEndTime"], $row["extraServingLocationAddress"], $row["extraServingLocationName"], $row["extraServingStartTime"]);

				$extraServings[$extraServings->key()] = $extraServing;

				// next() advances the internal array pointer one place forward before returning the element value. That means it returns the next array value and advances the internal array pointer by one.
				$extraServings->next();

			}catch(\Exception $exception) {
				// if the row couldnt be converted, re-throw it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}

		}
		return ($extraServings);
	}



	/**
	 * get the extraServing by extraServingEndTime
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param \DateTime $extraServingEndTime end time to search by
	 * @return \SplFixedArray SplFixedArray of extraServings found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/

	public static function getExtraServingByExtraServingEndTime(\PDO $pdo, \DateTime $extraServingEndTime){

		//what format should $extraServingEndTime be in when input to this method?
		//Do i need to format it once it has been input to the method?
		if(empty($extraServingEndTime)){
			throw(new \PDOException("Please enter an end time!"));
		}

		//make template
		$query = "SELECT extraServingId, extraServingCompanyId, extraServingDescription, extraServingEndTIme, ExtraServingLocationAddress, extraServingLocationName, extraServingStartTime FROM extraServing WHERE extraServingEndTIme = :extraServingEndTIme";

		$statement = $pdo->prepare($query);

		//bind the id to its placeholder inside the template
		//we dont use $this->$extraServingId, because we arent pulling the value of the state variable,
		//we want to use the value passed into the function
		$parameters = ["extraServingEndTime" => $extraServingEndTime];

		$statement->execute($parameters);

		//construct array for all the objects to go into
		// \SplFixedArray take in a parameter of how long it should be. $statement->rowCount() give the number of rows found in the database
		$extraServings = new \SplFixedArray($statement->rowCount());

		// PDO::FETCH_ASSOC tells PDO to return the result as an associative array. The array keys will match your column names.
		$statement->setFetchMode(\PDO::FETCH_ASSOC);

		//why there are still rows with juicy, juicy data in them, keep this party going
		while(($row = $statement->fetch()) != false) {

			try {

				$extraServing = new ExtraServing($row["extraServingId"], $row["extraServingCompanyId"], $row["extraServingDescription"], $row["extraServingEndTime"], $row["extraServingLocationAddress"], $row["extraServingLocationName"], $row["extraServingStartTime"]);

				$extraServings[$extraServings->key()] = $extraServing;

				// next() advances the internal array pointer one place forward before returning the element value. That means it returns the next array value and advances the internal array pointer by one.
				$extraServings->next();

			}catch(\Exception $exception) {
				// if the row couldnt be converted, re-throw it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}

		}
		return ($extraServings);
	}





	/**
	 * get the extraServing by extraServingStartTime
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param \DateTime $extraServingStartTime end time to search by
	 * @return \SplFixedArray SplFixedArray of extraServings found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/

	public static function getExtraServingByExtraServingStartTime(\PDO $pdo, \DateTime $extraServingStartTime){

		//what format should $extraServingEndTime be in when input to this method?
		//Do i need to format it once it has been input to the method?
		if(empty($extraServingStartTime)){
			throw(new \PDOException("Please enter a start time!"));
		}

		//make template
		$query = "SELECT extraServingId, extraServingCompanyId, extraServingDescription, extraServingEndTIme, ExtraServingLocationAddress, extraServingLocationName, extraServingStartTime FROM extraServing WHERE extraServingEndTime = :extraServingEndTime";

		$statement = $pdo->prepare($query);

		//bind the id to its placeholder inside the template
		//we dont use $this->$extraServingId, because we arent pulling the value of the state variable,
		//we want to use the value passed into the function
		$parameters = ["extraServingStartTime" => $extraServingStartTime];

		$statement->execute($parameters);

		//construct array for all the objects to go into
		// \SplFixedArray take in a parameter of how long it should be. $statement->rowCount() give the number of rows found in the database
		$extraServings = new \SplFixedArray($statement->rowCount());

		// PDO::FETCH_ASSOC tells PDO to return the result as an associative array. The array keys will match your column names.
		$statement->setFetchMode(\PDO::FETCH_ASSOC);

		//why there are still rows with juicy, juicy data in them, keep this party going
		while(($row = $statement->fetch()) != false) {

			try {

				$extraServing = new ExtraServing($row["extraServingId"], $row["extraServingCompanyId"], $row["extraServingDescription"], $row["extraServingEndTime"], $row["extraServingLocationAddress"], $row["extraServingLocationName"], $row["extraServingStartTime"]);

				$extraServings[$extraServings->key()] = $extraServing;

				// next() advances the internal array pointer one place forward before returning the element value. That means it returns the next array value and advances the internal array pointer by one.
				$extraServings->next();

			}catch(\Exception $exception) {
				// if the row couldnt be converted, re-throw it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}

		}
		return ($extraServings);
	}



	/**
	 * gets all extraServing objects
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of extraServings found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 */
	public static function getAllExtraServing(\PDO $pdo){

		//make template
		$query = "SELECT extraServingId, extraServingCompanyId, extraServingDescription, extraServingEndTIme, ExtraServingLocationAddress, extraServingLocationName, extraServingStartTime FROM extraServing";

		$statement = $pdo->prepare($query);
		$statement->execute();

		$extraServings = new \SplFixedArray($statement->rowCount());

		$statement->setFetchMode(\PDO::FETCH_ASSOC);

		while(($row = $statement->fetch())!= false){
			try{

				$extraServing = new ExtraServing($row["extraServingId"], $row["extraServingCompanyId"], $row["extraServingDescription"], $row["extraServingEndTime"], $row["extraServingLocationAddress"], $row["extraServingLocationName"], $row["extraServingStartTime"]);

				$extraServings[$extraServings->key()] = $extraServing;

				// next() advances the internal array pointer one place forward before returning the element value. That means it returns the next array value and advances the internal array pointer by one.
				$extraServings->next();

			}catch(\Exception $exception) {
				// if the row couldnt be converted, re-throw it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}

		}
		return ($extraServings);
			}

			/**
			 * Formats the state variables for JSON serialization
			 *
			 * @return array resulting state variables to serialize
			 **/
	public function jsonSerialize() {

		//pretty sure i need more in this....
		$fields = get_object_vars($this);
		return($fields);
	}


}