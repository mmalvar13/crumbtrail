<?php

require_once(dirname(__DIR__) . "/classes/autoload.php");

use Edu\Cnm\CrumbTrail\{
	Profile, Company, Employ
};

function typeCheck($pdo, $employCompanyId) {

	if((empty($_SESSION["profile"]) === false)) {
		throw(new \InvalidArgumentException("Session is not active"));
	}

	$type = "";

	$employees = Employ::getEmployByEmployCompanyId($pdo, $employCompanyId);

	foreach($employees as $individual) {
		$profile = Profile::getProfileByProfileId($pdo, $individual->getEmployProfileId());

		if($profile->getProfileType() === "o") {

			$type = $profile->getProfileType();
			break;

		} elseif($profile->getProfileType() === "a") {

			$type = $profile->getProfileType();
			break;

		} else {
			throw(new \InvalidArgumentException("Not allowed to make changes"));
		}

	}

	return $type;
}