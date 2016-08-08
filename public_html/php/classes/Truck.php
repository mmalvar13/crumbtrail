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
}