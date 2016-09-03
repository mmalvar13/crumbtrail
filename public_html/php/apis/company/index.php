<?php

require_once(dirname(__DIR__, 2) . "/classes/autoload.php");//need to add these
require_once(dirname(__DIR__, 2) . "/lib/xsrf.php");
require_once(dirname(__DIR__, 2) . "/lib/authorization.php");
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
require_once(dirname(__DIR__, 4) . "/vendor/autoload.php");


use Edu\Cnm\CrumbTrail\{
	Profile, Company, Employ
};


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

	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/crumbtrail.ini");

	//determine which HTTP method was used (Explain this)
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];


	//I think this takes the URL we are given, and strips the id out of the URL so we know which primary key we have


	$companyId = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);  //should this be "id" or "companyId" TODO
	$companyAccountCreatorId = filter_input(INPUT_GET, "companyAccountCreatorId", FILTER_VALIDATE_INT);
	$companyName = filter_input(INPUT_GET, "companyName", FILTER_SANITIZE_STRING);
	$companyMenuText = filter_input(INPUT_GET, "companyMenuText", FILTER_SANITIZE_STRING);
	$companyDescription = filter_input(INPUT_GET, "companyDescription", FILTER_SANITIZE_STRING);

	//HOW DO I MAKE A LINK THROUGH EMPLOY TO ENSURE THAT ThE PROFILE MAKING CHANGES TO A COMPANY OWN THAT COMPANY PROFILE TODO


	//make sure the id is valid for methods that require it
//	if(($method === "DELETE" || $method === "PUT") && (((empty($companyId)) === true) || $companyId < 0)) {
//		throw(new InvalidArgumentException("id cannot be empty or negative", 405));
//	}

	//handle GET request. if a companyId is present that company is returned, otherwise all companies are returned
	if($method === "GET") {
		//set XRF cookie
		setXsrfCookie();


		//get a specific company or all companies and update reply
		if((empty($companyId)) === false) {
			$company = Company::getCompanyByCompanyId($pdo, $companyId);
			if($company !== null) {
				$reply->data = $company;
			}
		} elseif((empty($companyAccountCreatorId)) === false) {
			$company = Company::getCompanyByCompanyAccountCreatorId($pdo, $companyAccountCreatorId);
			if($company !== null) {
				$reply->data = $company;
			}
		} elseif((empty($companyName)) === false) {
			$company = Company::getCompanyByCompanyName($pdo, $companyName);
			if($company !== null) {
				$reply->data = $company;
			}
		} elseif((empty($companyMenuText)) === false) {
			$company = Company::getCompanyByCompanyMenuText($pdo, $companyMenuText);
			if($company !== null) {
				$reply->data = $company;
			}
		} elseif((empty($companyDescription)) === false) {
			$company = Company::getCompanyByCompanyDescription($pdo, $companyDescription);
			if($company !== null) {
				$reply->data = $company;
			}
		} else {
			$companies = Company::getAllCompanys($pdo);
			if($companies !== null) {
				$reply->data = $companies;
			}
		}


//		ensure the person making changes is admin or owner and owns that account
	} elseif(isEmployeeAuthorized($pdo, $companyId) === true) {

		if(($method === "PUT")) { //TODO do we need a POST at all
			verifyXsrf();


			$requestContent = file_get_contents("php://input");
			$requestObject = json_decode($requestContent);


			//make sure the company name is available (required field)
			if(empty($requestObject->companyName) === true) {
				throw(new \InvalidArgumentException("No name for company", 405));
			}

			//make sure the company email is available (required field)
			if(empty($requestObject->companyEmail) === true) {
				throw(new \InvalidArgumentException("No email for company", 405));
			}

			//make sure the company phone is available (required field)
			if(empty($requestObject->companyPhone) === true) {
				throw(new \InvalidArgumentException("No phone for company", 405));
			}

			//make sure the company permit is available (required field)
			if(empty($requestObject->companyPermit) === true) {
				throw(new \InvalidArgumentException("No permit for company", 405));
			}

			//make sure the company license is available (required field)
			if(empty($requestObject->companyLicense) === true) {
				throw(new \InvalidArgumentException("No license for company", 405));
			}

			//make sure the company Attn is available (required field)
			if(empty($requestObject->companyAttn) === true) {
				throw(new \InvalidArgumentException("No Attn for company", 405));
			}

			//make sure the company street1 is available (required field)
			if(empty($requestObject->companyStreet1) === true) {
				throw(new \InvalidArgumentException("No street1 for company", 405));
			}

			//make sure the company street2 is available (required field)
//			if(empty($requestObject->companyStreet2) === true) {
//				throw(new \InvalidArgumentException("No street2 for company", 405));
//			} TODO can we remove this exception throw?

			//make sure the company city is available (required field)
			if(empty($requestObject->companyCity) === true) {
				throw(new \InvalidArgumentException("No city for company", 405));
			}

			//make sure the company state is available (required field)
			if(empty($requestObject->companyState) === true) {
				throw(new \InvalidArgumentException("No state for company", 405));
			}

			//make sure the company zip is available (required field)
			if(empty($requestObject->companyZip) === true) {
				throw(new \InvalidArgumentException("No zip for company", 405));
			}

			//make sure the company description is available (required field)
			if(empty($requestObject->companyDescription) === true) {
				throw(new \InvalidArgumentException("No description for company", 405));
			}

			//make sure the company menu text is available (required field)
			if(empty($requestObject->companyMenuText) === true) {
				throw(new \InvalidArgumentException("No menu for company", 405));
			}

			//make sure the company account creator ID is available (required field)
			if(empty($requestObject->companyAccountCreatorId) === true) {
				throw(new \InvalidArgumentException("No company account creator ID for company", 405));
			}

			//perform the actual PUT or POST

			//I will need 2 sections of PUT, one for ADMINS & Owners, and 1 for JUST ADMINS to change things like permits/license etc
//			if($method === "PUT" && ($_SESSION["profile"]->getProfileType()) === "a") {
				//retrieve the company to update

				$company = Company::getCompanyByCompanyId($pdo, $companyId);
				if($company === null) {
					throw(new RuntimeException("This company does not exist", 404));
				}
				//put the new company name into the company and update
				$company->setCompanyName($requestObject->companyName);
				$company->setCompanyEmail($requestObject->companyEmail);
				$company->setCompanyPhone($requestObject->companyPhone);
				$company->setCompanyPermit($requestObject->companyPermit);
				$company->setCompanyLicense($requestObject->companyLicense);
				$company->setCompanyAttn($requestObject->companyAttn);
				$company->setCompanyStreet1($requestObject->companyStreet1);
				$company->setCompanyStreet2($requestObject->companyStreet2);
				$company->setCompanyCity($requestObject->companyCity);
				$company->setCompanyState($requestObject->companyState);
				$company->setCompanyZip($requestObject->companyZip);
				$company->setCompanyDescription($requestObject->companyDescription);
				$company->setCompanyMenuText($requestObject->companyMenuText);


				$company->update($pdo);

				//update reply
				$reply->message = "Company updated A-OK";

//			} elseif($method === "PUT" && ($_SESSION["profile"]->getProfileType()) === "o") {
//				//retrieve the company to update
//
//				$company = Company::getCompanyByCompanyId($pdo, $companyId);
//				if($company === null) {
//					throw(new RuntimeException("This company does not exist"));
//				}
//				//put the new company name into the company and update
//				$company->setCompanyName($requestObject->companyName);
//				$company->setCompanyEmail($requestObject->companyEmail);
//				$company->setCompanyPhone($requestObject->companyPhone);
//				$company->setCompanyAttn($requestObject->companyAttn);
//				$company->setCompanyStreet1($requestObject->companyStreet1);
//				$company->setCompanyStreet2($requestObject->companyStreet2);
//				$company->setCompanyCity($requestObject->companyCity);
//				$company->setCompanyState($requestObject->companyState);
//				$company->setCompanyZip($requestObject->companyZip);
//				$company->setCompanyDescription($requestObject->companyDescription);
//				$company->setCompanyMenuText($requestObject->companyMenuText);
//
//
//				$company->update($pdo);
//
//				//update reply
//				$reply->message = "Company updated A-OK";
//			}
//		}***********put back in when you add wrapper
//	} elseif((empty($_SESSION["profile"]) === false) && (($_SESSION["profile"]->getProfileId()) === $companyId) && (($_SESSION["profile"]->getProfileType()) === "a") || (($_SESSION["profile"]->getProfileType())) === "o") {

			} elseif($method === "DELETE") {
				verifyXsrf();

				$requestContent = file_get_contents("php://input");
				$requestObject = json_decode($requestContent);

				//retrieve the company to be deleted
				$company = Company::getCompanyByCompanyId($pdo, $companyId);

				//check if empty
				if($company === null) {
					throw(new RuntimeException("The company does not exist", 404));
				}

				//delete the company
				$company->delete($pdo);

				//update the reply
				$reply->message = "Company deleted A-OK";
			} else {
				throw (new InvalidArgumentException("Invalid HTTP method request"));
			}

		} else {
			throw(new \InvalidArgumentException("Employee is not authorized to make changes"));
		}
	 //**take this out at some point
	//update the reply with exception information
} catch(Exception $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
} catch(TypeError $typeError) {
	$reply->status = $typeError->getCode();
	$reply->message = $typeError->getMessage();
}

header("Content-type: application/json"); //TODO what does this do again?
if($reply->data === null) {
	unset($reply->data);
}

// encode and return reply to front end caller
echo json_encode($reply);