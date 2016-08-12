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
	 * @var $truckId;
	 **/
	private $truckId;
	/**
	 * id for the truck and company, this is a foreign key.
	 * @var $truckCompanyId;
	 */
	private $truckCompanyId;

//constructor will go here//
	/**
	 * Truck constructor.
	 * @param int|null $newTruckId
	 * @param int $newTruckCompanyId
	 * @throws \RangeException
	 */

public function __construct(int $newTruckId =null, int $newTruckCompanyId) {
	try {
	$this->setTruckId($newTruckId);
	$this->setTruckCompanyId($newTruckCompanyId);
	} catch (\RangeException $range) {
		throw(new \RangeException ($range->getMessage(), 0, $range));
	}
}
	/**
	 * accessor for the truck id
	 *
	 * @return int|null value of truck id
	 *
	 */
	public function getTruckId() {
		return ($this->truckId);
	}
	/**
	 * mutator method for truck id
	 *
	 * @param int|null $newTruckId new value of truck id
	 * @throws \RangeException if $newTruckId is negative
	 */
	public function setTruckId(int $newTruckId =null) {
		if($newTruckId <= 0); {
			throw (new \RangeException ("Truck Id is not positive"));
		}
		//convert and store
		$this->truckId = $newTruckId;
	}
	/**
	 * accessor for the truck company Id
	 *
	 *@return Int|null value of truck company Id
	 */
	public function getTruckCompanyId() {
		return ($this->truckCompanyId);
	}
	/**
	 * mutator method for truck company id
	 *
	 * @param int|null $newTruckCompanyId new value of truck company Id
	 * @throws \RangeException if $newTruckCompanyId is negative
	 */
	public function setTruckCompanyId(int $newTruckCompanyId =null) {
		if($newTruckCompanyId <=0); {
			throw (new \RangeException ("Truck Company Id is not positive"));
		}
		//convert and store
		$this->truckCompanyId = $newTruckCompanyId;
	}
	//PDO section starts here
	//insert method here
	/**
	 * inserts this truck into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws |\PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
		public function insert(\PDO $pdo) {
			if($this->truckId !== null) {
				throw(new \PDOException("Not a new Truck"));
			}
			//query template
			$query = "INSERT INTO truck(truckCompanyId) VALUES(:truckCompanyId)";
			$statement = $pdo->prepare($query);

			$parameters = ["truckCompanyId" => $this->truckCompanyId];
			$statement->execute($parameters);

			//update the null truckId with what SQL just gave us
			$this->truckId = intval($pdo->lastInsertId());
		}
		//delete method here
	/**
	 * deletes the truck from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws |\PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
		public function delete(\PDO $pdo) {
			//don't delete a truck that hasn't been inserted
			if($this->truckId == null) {
				throw(new \PDOException("unable to delete a truck that does not exist"));
			}
			//query template
			$query = "DELETE FROM truck WHERE truckId = :truckId";
			$statement = $pdo->prepare($query);

			//bind the member variable to the place holder in the template
			$parameters = ["truckId" => $this->truckId];
			$statement->execute($parameters);
		}
		//update method here
	/**
	 * updates the image in mySQL
	 * @param \PDO $pdo PDO connection object
	 * @throws |PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 */
		public function update(\PDO $pdo) {
			//don't update an image that has already been inserted
			if($this->truckId == null) {
				throw(new \PDOException("unable to update an image that does not exist "));
			}
			$query = "UPDATE truck SET truckCompanyId = :truckCompanyId WHERE truckId = :truckId";
			$statement = $pdo->prepare($query);

			$parameters = ["truckCompanyId" => $this->truckCompanyId];
			$statement->execute($parameters);
		}
	//getFooByBar
	/**
	 * gets truck by truck id
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $truckId truck id to search for
	 * @return Truck|null Image found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getTruckByTruckId(\PDO $pdo, int $truckId) {
		//sanitize the truckId before searching
		if($truckId <=0) {
			throw(new \PDOException("truck Id is not positive"));
		}
		//query template
		$query = "SELECT truckId, truckCompanyId FROM truck WHERE truckId =:truckId";
		$statement = $pdo->prepare($query);
		//bind the truck id to the place holder im the template
		$parameters = ["truckId" => $truckId];
		$statement->execute($parameters);

		//grab image from mySQL
		try {
			$truck =null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !==false) {
				$truck = new Truck($row["truckId"], $row["truckCompanyId"]);
			}
		} catch(\Exception $exception) {
			//if throw couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($truck);
	}
	/**
	 * gets truck by company
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int, $truckCompanyId truck to search for
	 * @return \SplFixedArray SplFixedArray of images found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are nor the correct data type
	 */
		public static function getTruckByTruckCompanyId(\PDO $pdo, int $truckCompanyId) {
			//sanitize the description before searching?
			if($truckCompanyId <=0) {
				throw(new \PDOException("Truck Company Id is not positive"));
			}
		//query template
		$query = "SELECT truckId, truckCompanyId FROM truck WHERE truckCompanyId= :truckCompanyId";
		$statement = $pdo->prepare($query);
		//bind the truck company Id to the placeholder template
		$parameters = ["truckCompanyId" => $truckCompanyId];
		$statement->execute($parameters);
		//build an array of trucks
		$trucks = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !==false) {
			try {
				$truck = new Truck($row["truckId"], $row["truckCompanyId"]);
				$trucks[$trucks->key()] = $truck;
			} catch(\Exception $exception) {
				//if row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($trucks);
		}
}