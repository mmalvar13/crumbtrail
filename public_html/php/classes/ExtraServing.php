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
	 * location of where the food truck will be serving
	 * @var string $extraServingLocation
	 */
	private $extraServingLocation;

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

	public function setExtraServingId(int $newExtraServingId = null){

		if($newExtraServingId === null){
			$this->extraServingId = null;
			return;
		}

		if($newExtraServingId <= 0){
			throw(new \RangeException("The Extra Serving ID cannot be negative or zero"));
		}

		$this->extraServingId = $newExtraServingId;
	}


	/**
	 * getter for extraServingCompanyId
	 * @return int|null for $extraServingCompanyId
	 */
	public function getExtraServingCompanyId(){
		return ($this->extraServingCompanyId);
	}

	/**
	 * settter for extraServingCompanyId
	 * @param int|null for $newExtraServingCompanyId
	 * @throws \InvalidArgumentException if $newExtraServingCompanyId not valid
	 * @throws \RangeException if $newExtraServingCompanyId is less than or equal to zero
	 * @throws \TypeError if $newExtraServingCompanyId not an int
	 */
	public function setExtraServingCompanyId(int $newExtraServingCompanyId){
		if($newExtraServingCompanyId <= 0){
			throw(new \RangeException("company ID cannot be negative or zero!"));
		}
		$this->extraServingCompanyId = $newExtraServingCompanyId;

	}


	/**
	 * getter for extraServingDescription
	 * @return string for $extraServingDescription
	 */
	public function getExtraServingDescription(){
		return ($this->extraServingCompanyId);
	}

	/**
	 * setter for extraServingDescription
	 * @param string $newExtraServingDescription
	 * @throws \InvalidArgumentException if $newExtraServingDescription not a string
	 * @throws \RangeException if
	 */

}