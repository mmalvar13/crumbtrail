<?php


//We need to:
//GET all companies
//GET a specific company by primary key (companyId)
//GET a specific company by  foreign key (accountCreatorId)
//GET a specific company by company name (companyName)
//GET a specific company by company menu text (companyMenuText)
//GET a specific company by company description (companyDescription)

//POST a new company

//PUT update a company by primary key

//DELETE a company by the primary key

require_once "autoloader.php";
require_once "/lib/xsrf.php";
require_once("/etc/apache2/crumbtrail-mysql/encrypted-config.php");

/**
 * api for the Company class
 *
 * @author Loren Baca baca.loren@gmail.com
 */

//verify the session, start one if not active
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

//prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;

//begin try section

try {
	//grab the mySQL connection
	$pdo = connectToEncryptedMySQL("/etc/apache2/crumbtrail-mysql/company.ini");

	//determine which HTTP method was used (Explain this)
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	//sanitize input(Explain this) Where is the input coming from??
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

	//make sure the id is valid for methods that require it
	if(($method === "DELETE" || $method === "PUT") && (empty($id) === true || $id < 0)) {
		throw(new InvalidArgumentException("id cannot be empty or negative", 405));
	}

	//handle GET request. if a companyId is present that company is returned, otherwise all companies are returned
	if($method === "GET") {
		//set XRF cookie
		setXsrfCookie();

		//get a specific company or all companies and update reply
		if((empty($id)) === false) {
			$company = Company::getCompanyByCompanyId($pdo, $id);
			if($company !== null) {
				$reply->data = $company;
			}
		} elseif((empty($id)) === false) {
			$company = Company::getCompanyByAccountCreatorId($pdo, $id);
			if($company !== null) {
				$reply->data = $company;
			}
		} elseif((empty($id)) === false) {
			$company = Company::getCompanyByCompanyName($pdo, $id);
			if($company !== null) {
				$reply->data = $company;
			}
		} elseif((empty($id)) === false) {
			$company = Company::getCompanyByCompanyMenuText($pdo, $id);
			if($company !== null) {
				$reply->data = $company;
			}
		} elseif((empty($id)) === false) {
			$company = Company::getCompanyByCompanyDescription($pdo, $id);
			if($company !== null) {
				$reply->data = $company;
			}
		} else {
			$companies = Company::getAllCompanies($pdo);
			if($companies !== null) {
				$reply->data = $companies;
			}
		}

	}elseif(($method === "PUT") || ($method === "POST")){
	}
}