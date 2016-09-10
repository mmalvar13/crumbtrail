app.controller("SigninController", ["$scope", "SigninService", function($scope, SigninService){
	$scope.alerts = [];


	/*
	* creates a sign in?? sends it to sign in api
	*
	* @param validated true if Angular validated the form, false if not
	*
	* references this.signin function in signin-service
	* */
	$scope.signin = function(signInData, validated){ //references this.signin function in signin-service. signIn or signInData? does it matter?
		console.log("inside signincontroller signin");
		console.log(signInData); //what is this for?
		if(validated === true){
			SigninService.signin(signInData)//should this be signInData?
				.then(function(result){
					if(result.data.status === 200){
						$scope.alerts[0] = {type: "success", msg: result.data.message};
						console.log("good status");//user? below. is t
						$window.location.href = "user/"
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
	$scope.formData = {"inputEmail":null, "inputPassword":null};

	/*
	* method to reset form data when the submit and cancel buttons are pressed
	* */
	$scope.reset = function(){
		$scope.formData = {inputEmail: null, inputPassword: null};
		$scope.signinForm.$setUntouched();
		$scope.signingForm.$setPristine();
	};

	/*
	* method to process the action from the submit button
	* @param formData object containing submitted form data
	* @param validated true if passed validation, false if not
	* */

	$scope.submit = function(formData, validated){
		if(validated === true){
			$scope.alerts[0] = {
				type: "success",
				msg: "Well done"
			};
		}else{
			$scope.alerts[0] ={
				type:"danger",
				msg: "The form has invalid data. Please enter all required fields"
			};
		}
		$scope.reset();
	};
}]);