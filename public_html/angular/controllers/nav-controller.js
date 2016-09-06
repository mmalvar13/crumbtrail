/*
 * Navbar Controller
 *
 * Angular controller that enables collapse on the
 * UI Bootstrap Navbar on the xs breakpoint.
 *
 * @author: Dylan McDonald dmcdonald21@cnm.edu
 * */

app.controller("navController", ["$http", "$scope", function($http, $scope) {
	$scope.breakpoint = null;
	$scope.navCollapsed = null;

	// collapse the navbar if the screen is changed to a extra small screen
	$scope.$watch("breakpoint", function() {
		$scope.navCollapsed = ($scope.breakpoint === "xs");
	});
}]);