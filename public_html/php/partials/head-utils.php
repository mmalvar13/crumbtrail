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

		<!---------------Custom CSS here----------------------->
		<link href="css/style.css" rel="stylesheet" type="text/css"/>


		<!--Angular JS Libraries-->
		<?php $ANGULAR_VERSION = "1.5.8";?>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/angularjs/<?php echo $ANGULAR_VERSION;?>/angular.min.js"></script>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/angularjs/<?php echo $ANGULAR_VERSION;?>/angular-messages.min.js"></script>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/angularjs/<?php echo $ANGULAR_VERSION;?>/angular-route.js"></script>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/angularjs/<?php echo $ANGULAR_VERSION;?>/angular-animate.js"></script>
		<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/1.3.3/ui-bootstrap-tpls.min.js"></script>

		<!--Load OUR Angular files-->
		<script src="angular/crumbtrail.js"></script>
		<script src="angular/route-config.js"></script>
		<!--Directives come before controllers-->
		<script src="angular/directives/mainDirective.js"></script>
		<!--Load controllers-->
		<script src="angular/controllers/eater-map.js"></script>
		<script src="angular/controllers/mainController.js"></script>
		<script src="angular/controllers/settings.js"></script>
		<script src="angular/controllers/truck-list.js"></script>
		<script src="angular/controllers/truck-map.js"></script>
		<script src="angular/controllers/truck-profile.js"></script>
		<script src="angular/controllers/truck-registration.js"></script>
		<script src="angular/controllers/truck-signin.js"></script>





		<title>
			CrumbTrail   <!----add cool icon for tabs here ------->
		</title>
	</head>