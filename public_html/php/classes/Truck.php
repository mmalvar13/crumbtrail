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

}