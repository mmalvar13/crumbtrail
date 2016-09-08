<?php

require_once(dirname(__DIR__) . "/classes/autoload.php");

use Edu\Cnm\CrumbTrail\{Profile, Employ};

function isEmployeeAuthorized($pdo, $employCompanyId) {

	if(session_status() !== PHP_SESSION_ACTIVE) {
		session_start();
	}

	if((empty($_SESSION["profile"]) === true)){
		throw(new \InvalidArgumentException("Session is not active"));
	}

	$authorized = false;
	$employees = Employ::getEmployByEmployCompanyId($pdo, $employCompanyId);

	foreach($employees as $individual) {
		$profile = Profile::getProfileByProfileId($pdo, $individual->getEmployProfileId());
		if(($_SESSION["profile"]->getProfileId() === $profile->getProfileId()) && ($profile->getProfileType() === 'o' || $profile->getProfileType() === 'a')) {

			$authorized = true;
			break;
		}
	}
	return $authorized;
}
