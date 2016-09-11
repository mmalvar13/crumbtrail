app.controller("SigninController", ["$scope","$window", "SigninService", function($scope, $window, SigninService){
	$scope.alerts = [];

	/*
	* creates a sign in?? sends it to sign in api
	*
	* @param validated true if Angular validated the form, false if not
	*
	* references this.signin function in signin-service
	* */
	$scope.signin = function(signinData, validated){ //references this.signin function in signin-service. signIn or signInData? does it matter?
		console.log("inside signincontroller signin");
		console.log(signinData); //what is this for?
		if(validated === true){
			SigninService.signin(signinData)//should this be signInData?
				.then(function(result){
					if(result.data.status === 200){
						$scope.alerts[0] = {type: "success", msg: result.data.message};
						console.log("good status");//user? below. is t. take these out of final product.
						$window.location.href = "";
					}else{
						console.log("bad status");
						console.log(result.data);
						$scope.alerts[0] = {type:"danger", msg:result.data.message};
					}
				});
		}
	};


	/*
	* state variable to keep track of the data entered into the form fields
	*
	* @type{Object}
	* */
	$scope.signinData = {"profileEmail":null, "profilePassword":null};

	/*
	* method to reset form data when the submit and cancel buttons are pressed
	* */
	$scope.reset = function(){
		$scope.signinData = {profileEmail: null, profilePassword: null};
		$scope.signinForm.$setUntouched();
		$scope.signinForm.$setPristine();
	};

	/*
	* method to process the action from the submit button
	* @param signinData object containing submitted form data
	* @param validated true if passed validation, false if not
	* */

}]);