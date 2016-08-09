<?php
namespace Edu\Cnm\CrumbTrail; //idk

require_once("autoload.php");

/**
 * Welcome to the Employ class! Enjoy your stay!
 **/
class Employ{ //implement JsonSerializable??
	/**
	 * id of the profile that is employed by the company, this is a foreign key. Composite key with $employCompanyId.
	 * @var int|null $employProfileId //null??
	 **/
	private $employProfileId;
	/**
	 * id of the Company that employed the profile, this is a foreign key. Composite key with $employProfileId.
	 * @var int|null $employCompanyId //null??
	 **/
	private $employCompanyId;


	/*-------------------------------Constructor--------------------------------*/

	/**
	 * Employ class constructor.
	 * @param int $newEmployProfileId id of employProfile
	 * @param int $newEmployCompanyId id of employCompany
	 * @throws \RangeException if id is not positive
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if any other exception occurs
	 **/
	public function __construct(int $newEmployProfileId, int $newEmployCompanyId){
		try{
			$this->setEmployProfileId($newEmployProfileId);
			$this->setEmployCompanyId($newEmployCompanyId);
		}catch (\InvalidArgumentException $invalidArgument){
			//rethrow the exception to the caller
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		}catch(\RangeException $range){
			//rethrow the exception to the caller
			throw(new \RangeException($range->getMessage(), 0, $range));
		}catch(\TypeError $typeError){
			//rethrow exception to the caller
			throw(new \TypeError($typeError->getMessage(),0,$typeError));
		}catch(\Exception $exception){
			//rethrow the exception to the caller
			throw(new \Exception($exception->getMessage(),0,$exception));
	}
}

/*-------------------------Accessor and Mutator Methods----------------------------*/

/**
 * accessor method for employProfileId
 * @return int $employProfileId
 **/
	public function getEmployProfileId(int $NewEmployProfileId){
		return($this->employProfileId);
	}

	/**
	 * mutator method for employProfileId
	 * @param int $newEmployProfileId new value of employProfileId
	 * @throws \RangeException if $newEmployProfileId is not positive
	 * @throws \TypeError if $newEmployProfileId is not an integer
	 * @throws \Exception if any other exception occurs
	 **/
	public function setEmployProfileId(int $newEmployProfileId){
		//verify that the profile id is positive
		if($newEmployProfileId <= 0){
			throw(new \RangeException("employ profile id is not positive"));
		}
		//convert and store the employProfileId
		$this->employProfileId = $newEmployProfileId;
	}


	/**
	 * accessor method for employCompanyId
	 * @return int $employCompanyId
	 **/
	public function getEmployCompanyId(int $newEmployCompanyId){
		return($this->employCompanyId);
	}

	/**
	 * mutator method for employCompanyId
	 * @param int $newEmployCompanyId is the new value of employCompanyId
	 * @throws \RangeException if $newEmployCompanyId is not positive
	 * @throws \TypeError if $newEmployCompanyId is not an integer
	 * @throws \Exception if any other exception occurs
	 **/
	public function setEmployCompanyId(int $newEmployCompanyId){
		if($newEmployCompanyId <= 0){
			throw(new \RangeException("employ company id is not positive"));
		}
		//convert and store the employCompanyId
		$this->employCompanyId = $newEmployCompanyId;
	}

	/*-------------------------------PDO Connection Objects Here------------------------------*/
	/*----------------only need insert, delete, and select for this weak entity---------------*/
	/**
	 * inserts this employ into mySQL. is there a better way i can write this? that is not english.
	 *
	 *@param \PDO $pdo PDO Connection object
	 *@throws \PDOException when mySQL related errors occur
	 *@throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo){
		//enforce that this employProfileId is not null (i.e. don't insert an employProfileId that hasn't been assigned. Right?? its a foreign key.
		if($this->employProfileId === null || $this->employCompanyId === null) {
			throw(new \PDOException("cannot insert a foreign key that does not exist")); //usually for insert we don't want to enter something that already exists. is this normal for weak entities?
		}

		//create query template
		$query = "INSERT INTO employ(employProfileId, employCompanyId) VALUES(:employProfileId, :employCompanyId)";
		$statement = $pdo->prepare($query);

		//bind the member variables to the placeholders in the template
		$parameters = ["employProfileId"=>$this->employProfileId, "employCompanyId"=>$this->employCompanyId];
		$statement->execute($parameters);

		//in the twitter example i t says to update the null tweetId with what mySQL just gave us using $this->tweetId =intval($pdo->lastInsertId()). I don't have to add another line here right? because we are not creating a new whatever the equivelent of tweet is. idk. IDK OK?!!?!?
	}

	/**
	 * delete this employ into mySQL.
	 *@param \PDO $pdo PDO connection object
	 *@throws |\PDOException when mySQL related errors occur
	 *@throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo){
		//enforce that the employProfileId and employCompanyId are not null (i.e. don't delete a composite key that does not exist)
		if($this->employCompanyId === null || $this->employProfileId === null){
			throw(new \PDOException("cannot delete a composite key that does not exist"));
		}
		//create query template
		$query = "DELETE FROM employ WHERE employCompanyId = :employCompanyId AND employProfileId = :employProfileId"; //is this correct? would we ever need to use this IRL??? composite keys should never die! right?

		$statement = $pdo->prepare($query);

		//bind the member variables to the place holder in the template
		$parameters = ["employCompanyId" => $this->employCompanyId, "employProfileId" => $this->employProfileId];
		$statement->execute($parameters);
	}

}