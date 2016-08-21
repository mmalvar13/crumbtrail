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


use Edu\Cnm\CrumbTrail\{
	Profile, Company
};


require_once "autoloader.php";
require_once "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

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

	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/tweet.ini");

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

)

		//get a specific company or all companies and update reply
		if((empty($id)) === false) {
			$company = Company::getCompanyByCompanyId($pdo, $id);
			if($company !== null) {
				$reply->data = $company;
			}
		} elseif((empty($id)) === false) {
			$company = Company::getCompanyByCompanyAccountCreatorId($pdo, $id);
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
			$companies = Company::getAllCompanys($pdo);
			if($companies !== null) {
				$reply->data = $companies;
			}
		}


		//HOW DO I PUT A CATCH HERE TO MAKE SURE ONLY A ADMIN OR OWNER IS MAKING A PUT OR POST????
		//maybe I do still need a post in case they fill out a form later on? That would only work if we didnt make all
		//fields required on signup.
	} elseif(($method === "PUT" || "POST")) {
		verifyXsrf();
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);

		//ensure that the profile trying to make changes to company is either admin or owner
		$profile = Profile::getProfileByProfileId($pdo, $id);
		if($requestObject->profileType !== 'a' || 'o') {
			throw(new \InvalidArgumentException("profile type must be admin('a') or owner('o') in order to make changes to a profile"));
		}


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
		if(empty($requestObject->companyStreet2) === true) {
			throw(new \InvalidArgumentException("No street2 for company", 405));
		}

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
		if($method === "PUT" && $requestObject->companyType === 'a') {
			//retrieve the company to update

			$company = Company::getCompanyByCompanyId($pdo, $id);
			if($company === null) {
				throw(new RuntimeException("This company does not exist", 404));
			}
			//put the new company name into the company and update
			$company->setCompanyName($requestObject->companyName);
			$company->setCompanyEmail($requestObject->companyEmail);
			$company->setCompanyPhone($requestObject->companyPhone);
			$company->setCompanyName($requestObject->companyName);
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
			$company->setCompanyName($requestObject->companyName);

			$company->update($pdo);

			//update reply
			$reply->message = "Company updated A-OK";

		} elseif($method === "PUT" && $requestObject->companyType === 'o') {
			//retrieve the company to update

			$company = Company::getCompanyByCompanyId($pdo, $id);
			if($company === null) {
				throw(new RuntimeException("This company does not exist", 404));
			}
			//put the new company name into the company and update
			$company->setCompanyName($requestObject->companyName);
			$company->setCompanyEmail($requestObject->companyEmail);
			$company->setCompanyPhone($requestObject->companyPhone);
			$company->setCompanyName($requestObject->companyName);
			//what else needs to be omitted from owner change
//			$company->setCompanyPermit($requestObject->companyPermit);
//			$company->setCompanyLicense($requestObject->companyLicense);
			$company->setCompanyAttn($requestObject->companyAttn);
			$company->setCompanyStreet1($requestObject->companyStreet1);
			$company->setCompanyStreet2($requestObject->companyStreet2);
			$company->setCompanyCity($requestObject->companyCity);
			$company->setCompanyState($requestObject->companyState);
			$company->setCompanyZip($requestObject->companyZip);
			$company->setCompanyDescription($requestObject->companyDescription);
			$company->setCompanyMenuText($requestObject->companyMenuText);
			$company->setCompanyName($requestObject->companyName);

			$company->update($pdo);

			//update reply
			$reply->message = "Company updated A-OK";
		}

	} elseif($method === "DELETE") {
		verifyXsrf();

		//retrieve the company to be deleted
		$company = Company::getCompanyByCompanyId($pdo, $id);

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


	//update the reply with exception information
} catch(Exception $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
} catch(TypeError $typeError) {
	$reply->status = $typeError->getCode();
	$reply->message = $typeError->getMessage();
}

header("Content-type: application/json");
if($reply->data === null) {
	unset($reply->data);
}

// encode and return reply to front end caller
echo json_encode($reply);