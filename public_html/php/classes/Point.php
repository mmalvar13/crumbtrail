<?php
namespace Edu\Cnm\Crumbtrail; //probably wrong
require_once ("autoload.php"); //idk

/**
 * Class Point
 * @package Edu\Cnm\Crumbtrail
 * welcome to the point class! this is for things! emjoy your stay!
 **/
class Point implements \JsonSerializable{
	/**
	 * latitude for this point
	 * @var float $pointLatitude
	 **/
	private $pointLatitude;
	/**
	 * longitude for this  point
	 * @var float $pointLongitude
	 **/
	private $pointLongitude;
	}

/**
 * Constructor for this Point
 * @param int $newPointLatitude the latitude for this point
 * @param int $newPointLongitude the longitude
 * @throws \RangeException if coordinate values are out of range
 * @throws \TypeError if data types are incorrect
 * @throws \Exception if any other exception occurs
 **/
public function __construct(float $newPointLatitude, float $newPointLongitude) {
	try{
		$this->setPointLatitude($newPointLatitude);
		$this->setPointLongitude($newPointLongitude);
	}catch(\RangeException $range){
		//rethrow the exception to the caller
		throw(new \RangeException($range->getMessage(), 0, $range));
	}catch(\TypeError $typeError){
		//rethrow the exception to the caller
		throw(new \TypeError($typeError->getMessage(), 0, $typeError));
	}catch(\Exception $exception){
		//rethrow the exception to the caller
		throw(new \Exception($exception->getMessage(), 0, $exception));
	}
}





}