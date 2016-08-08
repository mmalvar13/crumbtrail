<?php
namespace Edu\Cnm\Crumbtrail; //idk

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

/**
 * constructor for this EMPLOY??
 **/
public function __construct(int $newEmployProfileId, int $newEmployCompanyId){
	try{
		$this->setEmployProfileId($newEmployProfileId);
		$this->setEmployCompanyId($newEmployCompanyId);
	}catch (\InvalidArgumentException $invalidArgument){
		//rethrow the exception to the caller
		throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
	} catch(\RangeException $range){
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

/**
 * accessor method for employProfileId
 * @return int $employProfileId
 **/
	public function getEmployProfileId(int $NewEmployProfileId){
		return($this->employProfileId);
	}



	/**
	 * accessor method for employCompanyId
	 * @return int $employCompanyId
	 **/
	public function getEmployCompanyId(int $newEmployCompanyId){
		return($this->employCompanyId);
	}


}