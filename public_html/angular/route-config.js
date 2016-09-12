// configure our routes
app.config(function($routeProvider, $locationProvider) {
	$routeProvider



	//route for the company profile
		.when("/company/:id", {
			controller: "MisquoteController",
			templateUrl: "angular/views/list-view.php"
		})




	// route for the home page
		.when('/', {
			controller: 'MapController',
			templateUrl: 'angular/views/eater-map-view.php'
		})

		// route for the foodTruckSignIn page
		.when('/sign-in', {
			controller: 'SigninController',
			templateUrl: 'angular/views/signin-view.php'
		})

		// route for the sign up page
		.when('/settings', {
			controller: 'SettingsController',
			templateUrl: 'angular/views/settings-view.php'
		})

		// route for the truck list page
		.when('/truck-listing', {
			controller: 'ListController',
			templateUrl: 'angular/views/list-view.php'
		})

		// route for the truck map page
		.when('/truck-map', {
			controller: 'MapController',
			templateUrl: 'angular/views/truck-map-view.php'
		})

		// route for the truck map page
		.when('/profile/:companyId', {
			controller: 'ProfileController',
			templateUrl: 'angular/views/profile-view.php'
		})

		// route for the truck map page
		.when('/sign-up', {
			controller: 'SignupController',
			templateUrl: 'angular/views/signup-view.php'
		})


		// otherwise redirect to home
		.otherwise({
			redirectTo: '/'
		});

	//use the HTML5 History API
	$locationProvider.html5Mode(true);
});