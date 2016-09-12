<!DOCTYPE html>
<html lang="en" ng-app="Crumbtrail">
	<head>
		<!-- The 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta charset="utf-8"/>
		<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>

		<!-- set base for relative links - to enable pretty URLs -->
		<base href="<?php echo dirname($_SERVER["PHP_SELF"]) . "/";?>">

		<!-------------Bootstrap links all here---------->
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
				integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
				crossorigin="anonymous"/>

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
				integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp"
				crossorigin="anonymous"/>

		<!-------------------GOOGLE FONTS------------------>
		<link href="https://fonts.googleapis.com/css?family=Fascinate+Inline|Nixie+One|Roboto" rel="stylesheet">

		<!---------------Custom CSS here---------------------why was this commented out? 9/9 MA-->
		<link href="css/style.css" rel="stylesheet" type="text/css"/>


		<!--Google Maps API-->
		<script src='//maps.googleapis.com/maps/api/js?sensor=false'></script>


		<!-- Angular -->
		<script type="text/javascript" src="angular/vendor/vendor.js"></script>

		<!--Load OUR Angular files-->
		<script src="angular/crumbtrail.js"></script>
		<script src="angular/route-config.js"></script>
		<!--Directives come before controllers-->
		<script src="angular/directives/mainDirective.js"></script>
		<script src="angular/directives/bootstrap-breakpoint.js"></script>
		

		<!--Load services-->

		<script src="angular/services/company-service.js"></script>
		<script src="angular/services/companyactivation-service.js"></script>
		<script src="angular/services/companyapproved-service.js"></script>
		<script src="angular/services/employee-service.js"></script>
		<script src="angular/services/event-service.js"></script>
		<script src="angular/services/geolocation-service.js"></script>
		<script src="angular/services/image-service.js"></script>
		<script src="angular/services/profile-service.js"></script>
		<script src="angular/services/profileactivation-service.js"></script>
		<script src="angular/services/signin-service.js"></script>
		<script src="angular/services/signout-service.js"></script>
		<script src="angular/services/signup-service.js"></script>
		<script src="angular/services/truck-service.js"></script>




		<!--Load controllers-->
		<script src="angular/controllers/map-controller.js"></script>
		<script src="angular/controllers/mainController.js"></script>
		<script src="angular/controllers/nav-controller.js"></script>

		<script src="angular/controllers/settings-controller.js"></script>
		<script src="angular/controllers/list-controller.js"></script>
		<script src="angular/controllers/profile-controller.js"></script>
		<script src="angular/controllers/signup-controller.js"></script>
		<script src="angular/controllers/signin-controller.js"></script>
		<script src="angular/controllers/signout-controller.js"></script>






		<title>
			CrumbTrail   <!----add cool icon for tabs here ------->
		</title>
	</head>