// configure our routes
app.config(function($routeProvider, $locationProvider) {
	$routeProvider

	// route for the home page
		.when('/', {
			controller: 'eaterMapController',
			templateUrl: 'angular/views/eater-map.php'
		})

		// route for the foodTruckSignIn page
		.when('/sign-in', {
			controller: 'truckSigninController',
			templateUrl: 'angular/views/truck-signin.php'
		})

		// route for the sign up page
		.when('/settings', {
			controller: 'settingsController',
			templateUrl: 'angular/views/settings.php'
		})

		// route for the truck list page
		.when('/truck-listing', {
			controller: 'truckListController',
			templateUrl: 'angular/views/truck-list.php'
		})

		// route for the truck map page
		.when('/truck-map', {
			controller: 'truckMapController',
			templateUrl: 'angular/views/truck-map.php'
		})

		// route for the truck map page
		.when('/profile', {
			controller: 'truckProfileController',
			templateUrl: 'angular/views/truck-profile.php'
		})

		// route for the truck map page
		.when('/registration', {
			controller: 'truckRegistrationController',
			templateUrl: 'angular/views/truck-registration.php'
		})


		// otherwise redirect to home
		.otherwise({
			redirectTo: '/'
		});

	//use the HTML5 History API
	$locationProvider.html5Mode(true);
});