// configure our routes
app.config(function($routeProvider, $locationProvider) {
	$routeProvider

	// route for the home page
		.when('/', {
			controller: 'MapController',
			templateUrl: 'angular/views/eater-map.php'
		})

		// route for the foodTruckSignIn page
		.when('/sign-in', {
			controller: 'SigninController',
			templateUrl: 'angular/views/signin.php'
		})

		// route for the sign up page
		.when('/settings', {
			controller: 'SettingsController',
			templateUrl: 'angular/views/settings.php'
		})

		// route for the truck list page
		.when('/truck-listing', {
			controller: 'TruckListController',
			templateUrl: 'angular/views/truck-list.php'
		})

		// route for the truck map page
		.when('/truck-map', {
			controller: 'MapController',
			templateUrl: 'angular/views/truck-map.php'
		})

		// route for the truck map page
		.when('/profile', {
			controller: 'ProfileController',
			templateUrl: 'angular/views/profile-view.php'
		})

		// route for the truck map page
		.when('/sign-up', {
			controller: 'SignupController',
			templateUrl: 'angular/views/signup.php'
		})


		// otherwise redirect to home
		.otherwise({
			redirectTo: '/'
		});

	//use the HTML5 History API
	$locationProvider.html5Mode(true);
});