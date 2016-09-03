<?php

require_once(dirname(__DIR__) . "/classes/autoload.php");

use Edu\Cnm\CrumbTrail\{Profile, Employ};

function isEmployeeAuthorized($pdo, $employCompanyId) {

	if((empty($_SESSION["profile"]) === false)){
		throw(new \InvalidArgumentException("Session is not active"));
	}

	$authorized = false;
	$employees = Employ::getEmployByEmployCompanyId($pdo, $employCompanyId);


	foreach($employees as $individual) {

		$profile = Profile::getProfileByProfileId($pdo, $individual->getEmployProfileId());
//		$employ = Employ::getEmployByEmployCompanyIdAndEmployProfileId($pdo, $employCompanyId, $profile->getProfileId());

		if(($individual->getEmployCompanyId() === $employCompanyId) && ( $profile->getProfileType() === 'o')) {
			$authorized = true;
			break;
		}
	}
	return ($authorized);
}
