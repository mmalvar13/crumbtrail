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

	}
}