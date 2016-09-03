<?php

require_once(dirname(__DIR__) . "/classes/autoload.php");

use Edu\Cnm\CrumbTrail\{
	Profile, Employ
};

function profileType($pdo, $employCompanyId) {

	$employees = Employ::getEmployByEmployCompanyId($pdo, $employCompanyId);

	foreach($employees as $individual) {
		$profile = Profile::getProfileByProfileId($pdo, $individual->getEmployProfileId());

		if($profile->getProfileType() === "o") {

			$type = "o";
		} elseif($profile->getProfileType() === "a") {
			$type = "a";
		} else {
			throw(new \InvalidArgumentException("Not allowed to make changes"));
		}

	}

	return $type;
}