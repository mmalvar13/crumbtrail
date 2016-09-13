app.controller('SignupController', ["$scope","$window", "SignupService", function($scope, $window, SignupService){
	$scope.alerts = [];

	/*
	* Method that uses the sign up service to activate an account? idk!
	*
	* @param signUpData will contain activation token and password
	* @param validated true if form is valid, false if not
	* */

	$scope.signup = function(signupData, validated){
		if(validated === true){
			SignupService.signup(signupData)
				.then(function(result){
					if(result.data.status === 200){
						$scope.alerts[0] = {type: "success", msg: result.data.message};
						console.log("good status");
						$window.location.href="truck-map";
					}else{
						console.log(result.data.message);
						$scope.alerts[0] = {type:"danger", msg: result.data.message};
					}
				});
		}
	};

	/*
	 * state variable to keep track of the data entered into the form fields
	 *
	 * @type{Object}
	 * */
	$scope.signupData = {"profileName" :null,"profileEmail":null, "profilePhone":null, "profilePassword":null, "confirmProfilePassword":null, "companyName":null, "companyEmail": null, "companyPhone": null, "companyStreet": null, "companyStreet2":null,"companyCity":null, "companyState":null,"companyZip":null, "companyLicense":null, "companyPermit":null};

	/*
	 * method to reset form data when the submit and cancel buttons are pressed
	 * */
	$scope.reset = function(){
		$scope.signupData = {profileName:null, profileEmail: null,  profilePhone:null, profilePassword: null, confirmProfilePassword:null, companyName:null, companyEmail:null, companyPhone:null, companyStreet:null, companyStreet2:null, companyCity:null, companyState:null, companyZip:null, companyLicense:null, companyPermit:null};
		$scope.signupForm.$setUntouched();
		$scope.signupForm.$setPristine();
	};




}]);