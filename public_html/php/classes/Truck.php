<?php

//namespace
//autoloader

//begin Docblock
/**
 * Truck Identifier
 * 
 * This will be used to identify the different trucks that will be in our database. In future goals we would like this to expand past New Mexico.
 * 
 * @author Victoria Chacon <victoriousdesignco@gmail.com>
 **/
//begin class here
class Truck {
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

//constructor goes here//
//public function __construct(int $newTruckId =null, int $newTruckCompanyId) {
	//try {
		//$this->setTruckId($newTruckId);
		//$this->setTruckCompanyId($newTruckCompanyId);
	//} catch //
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
	}
	/**
	 * accessor for the truck company Id
	 *
	 *@return Int|null value of truck company Id
	 */
	public function getTruckCompanyId() {
		return ($this->truckCompanyId);  
	}

}