var profileDirective = angular.module("profileDirective", []);

app.directive('details', function(){
	return{
		restrict: "EA",
		scope: {title: '@'},
		replace: true,
		viewURL: 'profile-view.php',
		controller: ProfileController,
		link: function($scope, element, attrs){}
	}

});