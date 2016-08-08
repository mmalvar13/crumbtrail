<?php
namespace Edu\Cnm\Crumbtrail; //idk

require_once("autoload.php");

/**
 * Welcome to the Employ class! Enjoy your stay!
 **/
class Employ{
	/**
	 * id of the profile that is employed by the company, this is a foreign key. Composite key with $employCompanyId.
	 * @var int $employProfileId
	 **/
	private $employProfileId;
	/**
	 * id of the Company that employed the profile, this is a foreign key. Composite key with $employProfileId.
	 * @var int $employCompanyId
	 **/
	private $employCompanyId;


}