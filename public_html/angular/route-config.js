// configure our routes
app.config(function($routeProvider, $locationProvider) {
	$routeProvider

	// route for the home page
		.when('/', {
			controller  : 'eaterMapController',
			templateUrl : 'angular/views/eater-map.php'
		})

		// route for the foodTruckSignIn page
		.when('/signin', {
			controller  : 'foodTruckSignin',
			templateUrl : 'angular/views/food-truck-signin.php'
		})

		// route for the sign up page
		.when('/settings', {
			controller  : 'settingsController',
			templateUrl : 'angular/views/settings.php'
		})

		// route for the truck list page
		.when('/trucklisting', {
			controller  : 'truckListController',
			templateUrl : 'angular/views/truck-list.php'
		})


		// otherwise redirect to home
		.otherwise({
			redirectTo: '/'
		});

	//use the HTML5 History API
	$locationProvider.html5Mode(true);
});