<?php

namespace Edu\Cnm\CrumbTrail;

require_once("autoload.php");

//begin Docblock
/**
 * Truck Identifier
 * 
 * This will be used to identify the different trucks that will be in our database. In future goals we would like this to expand past New Mexico.
 * 
 * @author Victoria Chacon <victoriousdesignco@gmail.com>
 **/
//begin class here
class Truck implements \JsonSerializable {
	/**
	 * id for this truck; this is the primary key
	 * @var int $truckId;
	 **/
	private $truckId;
	/**
	 * id for the truck and company, this is a foreign key.
	 * @var int $truckCompanyId;
	 **/
	private $truckCompanyId;
	/**
	 * name of the truck
	 * @var string $truckName
	 **/
	private $truckName;

//constructor will go here//
	/**
	 * Truck constructor
	 * @param int|null $newTruckId id of the truck or null if new truck
	 * @param int $newTruckCompanyId
	 * @param string $newTruckName
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException when data values are out of bounds
	 * @throws \TypeError When the variable is not the correct data type
	 * @throws \exception when errors need to be called in the code
	 **/

public function __construct(int $newTruckId = null, int $newTruckCompanyId, string $newTruckName) {
	try {
		$this->setTruckId($newTruckId);
		$this->setTruckCompanyId($newTruckCompanyId);
		$this->setTruckName($newTruckName);
	}catch(\InvalidArgumentException $invalidArgument){
		//rethrow the exception to the caller
		throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
	} catch (\RangeException $range) {
		throw(new \RangeException ($range->getMessage(), 0, $range));
	}catch (\TypeError $typeError) {
		throw(new \TypeError($typeError->getMessage(), 0, $typeError ));
	} catch (\Exception $Exception) {
		throw (new \Exception($Exception->getMessage(), 0, $Exception));
	}
}

	/**
	 * accessor for the truck id
	 *
	 * @return int|null value of truck id
	 *
	 **/
	public function getTruckId() {
		return ($this->truckId);
	}
	/**
	 * mutator method for truckId
	 *
	 * @param int|null $newTruckId new value of truck id
	 * @throws \RangeException if $newTruckId is negative
	 * @throws \TypeError when variables are nor the correct data type
	 **/
	public function setTruckId(int $newTruckId = null) {

		if($newTruckId === null) {
			$this->truckId = null;
			return;
		}

		if($newTruckId <= 0) {
			throw (new \RangeException ("Truck Id is not positive"));
		}
		//convert and store
		$this->truckId = $newTruckId;
	}

	/**
	 * accessor for the truck company Id
	 *
	 *@return Int|null value of truck company Id
	 **/
	public function getTruckCompanyId() {
		return ($this->truckCompanyId);
	}

	/**
	 * mutator method for truck company id
	 *
	 * @param int|null $newTruckCompanyId new value of truck company Id
	 * @throws \RangeException if $newTruckCompanyId is negative
	 * @throws \TypeError ??
	 **/
	public function setTruckCompanyId(int $newTruckCompanyId) {
		if($newTruckCompanyId <=0) {
			throw (new \RangeException ("Truck Company Id is not positive"));
		}
		//convert and store
		$this->truckCompanyId = $newTruckCompanyId;
	}

	/**
	 * accessor method for truck name
	 *
	 * @return string value for truckName
	 **/
	public function getTruckName(){
		return($this->truckName);
	}

	/**
	 * mutator method for truckName
	 * @param string $newTruckName new value of truckName
	 * @throws \RangeException if $newTruckName is empty or too long
	 * @throws \InvalidArgumentException if $newTruckName is not a string
	 * @throws \TypeError if $newTruckName is wrong data type
	 **/
	public function setTruckName(string $newTruckName){
		//strip out white space on either end of $newTruckName
		$newTruckName = trim($newTruckName);
		//sanitize
		$newTruckName = filter_var($newTruckName, FILTER_SANITIZE_STRING);
		//check to see if $newTruckName is empty or too long
		if(strlen($newTruckName) === 0){
			throw(new \RangeException("Truck Name is too short"));
		}
		if(strlen($newTruckName) > 128){
			throw(new \RangeException("truck name is too long"));
		}
		//assign $newTruckName to truckName and store in SQL
		$this->truckName = $newTruckName;
	}

	//-------------INSERT, UPDATE, DELETE METHODS---------
	/**
	 * insert this truck into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo) {
		if($this->truckId !== null) {
			throw(new \PDOException("Not a new Truck"));
		}
		//query template
		$query = "INSERT INTO truck(truckCompanyId, truckName) VALUES(:truckCompanyId, :truckName)";
		$statement = $pdo->prepare($query);

		$parameters = ["truckCompanyId" => $this->truckCompanyId, "truckName" => $this->truckName];
		$statement->execute($parameters);

		//update the null truckId with what SQL just gave us
		$this->truckId = intval($pdo->lastInsertId());
	}

	/**
	 * updates the truck in mySQL
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo) {
		//don't update an image that has already been inserted
		if($this->truckId === null) {
			throw(new \PDOException("unable to update a truck that does not exist "));
		}
		$query = "UPDATE truck SET truckCompanyId = :truckCompanyId, truckName = :truckName WHERE truckId = :truckId";
		$statement = $pdo->prepare($query);

		$parameters = ["truckCompanyId" => $this->truckCompanyId, "truckName" => $this->truckName, "truckId" => $this->truckId];
		$statement->execute($parameters);
	}

	/**
	 * deletes the truck from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo) {
		//don't delete a truck that hasn't been inserted
		if($this->truckId === null) {
			throw(new \PDOException("unable to delete a truck that does not exist"));
		}
		//query template
		$query = "DELETE FROM truck WHERE truckId = :truckId";
		$statement = $pdo->prepare($query);

		//bind the member variable to the place holder in the template
		$parameters = ["truckId" => $this->truckId];
		$statement->execute($parameters);
	}
	//getFooByBar
	/**
	 * gets truck by truck id
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $truckId truck id to search for
	 * @return truck|null Truck found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getTruckByTruckId(\PDO $pdo, int $truckId) {
		//sanitize the truckId before searching
		if($truckId <=0) {
			throw(new \PDOException("truck Id is not positive"));
		}
		//query template, need to fix this!!
		$query = "SELECT truckId, truckCompanyId, truckName FROM truck WHERE truckId =:truckId";

		//prepare template
		$statement = $pdo->prepare($query);

		//bind the truck id to the place holder im the template
		$parameters = ["truckId" => $truckId];

		//Execute statement
		$statement->execute($parameters);

		//grab truck from mySQL
		try {
			$truck = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();

			if($row !==false) {
				$truck = new Truck($row["truckId"], $row["truckCompanyId"], $row["truckName"]);
			}

		}catch(\Exception $exception) {
			//if throw couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($truck);
	}
	//PDO section starts here
	//insert method here

	/**
	 * gets truck by truckCompany Id
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int, $truckCompanyId truck to search for
	 * @return \SplFixedArray SplFixedArray of trucks found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are nor the correct data type
	 **/
	public static function getTruckByTruckCompanyId(\PDO $pdo, int $truckCompanyId) {
		//sanitize the description before searching?
		if($truckCompanyId <=0) {
			throw(new \PDOException("Truck Company Id is not positive"));
		}
		//query template
		$query = "SELECT truckId, truckCompanyId, truckName FROM truck WHERE truckCompanyId= :truckCompanyId";
		$statement = $pdo->prepare($query);
		//bind the truck company Id to the placeholder template
		$parameters = ["truckCompanyId" => $truckCompanyId];
		$statement->execute($parameters);
		//build an array of trucks
		$trucks = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !==false) {
			try {
				$truck = new Truck($row["truckId"], $row["truckCompanyId"], $row["truckName"]);
				$trucks[$trucks->key()] = $truck;
				$trucks->next();
			} catch(\Exception $exception) {
				//if row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($trucks);
	}

	//todo what is this for? why do we get it by profile id?
	public static function getTruckByProfileId(\PDO $pdo, int $profileId) {
		//sanitize the description before searching?
		if($profileId <= 0) {
			throw(new \PDOException("Profile Id is not positive"));
		}
		//query template
		$query = "SELECT truckId, truckCompanyId, truckName FROM truck INNER JOIN (SELECT employProfileId, employCompanyId FROM employ WHERE employProfileId = :profileId) employ ON truck.truckCompanyId = employ.employCompanyId";
		$statement = $pdo->prepare($query);
		//bind the truck company Id to the placeholder template
		$parameters = ["profileId" => $profileId];
		$statement->execute($parameters);
		//build an array of trucks
		$trucks = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !==false) {
			try {
				$truck = new Truck($row["truckId"], $row["truckCompanyId"], $row["truckName"]);
				$trucks[$trucks->key()] = $truck;
				$trucks->next();
			} catch(\Exception $exception) {
				//if row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($trucks);
	}

	/** gets all trucks
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of Trucks found or null if not found
	 * @throws \PDOException when mySQL related error occur
	 * @throws \TypeError when variables are nor the correct data type
	 **/
	public static function getAllTrucks(\PDO $pdo) {
		//query template
		$query = "SELECT truckId, truckCompanyId, truckName FROM truck";
		$statement = $pdo->prepare($query);
		$statement->execute();
		//build an array of trucks
		$trucks = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$truck = new Truck($row["truckId"], $row["truckCompanyId"], $row["truckName"]);
				$trucks[$trucks->key()] = $truck;
				$trucks->next();
			} catch(\Exception $exception) {
				//if row can't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($trucks);
	}
	/**
	 *formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		return($fields);
	}
}
//The end of Truck Class
