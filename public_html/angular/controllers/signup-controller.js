app.controller('SignupController', ["$scope", "SignupService", function($scope, SignupService){
	$scope.alerts = [];
	$scope.activationData = {}; //is this an arbitrary name?

	/*
	* Method that uses the sign up service to activate an account? idk!
	*
	* @param signUpData will contain activation token and password
	* @param validated true if form is valid, false if not
	* */

	$scope.sendActivationToken = function(signUpData, validated){
		if(validated === true){
			SignupService.create(signUpData)
				.then(function(result){
					if(result.data.status === 200){
						$scope.alerts[0] = {type: "success", msg: result.data.message};
						console.log("good status");
						$location.url("signup/");
					}else{
						console.log(result.data.message);
						$scope.alerts[0] = {type:"danger", msg: result.data.message};
					}
				});
		}
	};
}]);