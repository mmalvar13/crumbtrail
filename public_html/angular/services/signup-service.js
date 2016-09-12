/*service for sign up api
*@author Monica Alvarez
*
*/

app.constant("SIGNUP_ENDPOINT", "php/apis/signUp/");
app.service("SignupService", function($http, SIGNUP_ENDPOINT){
	function getUrl(){
		return(SIGNUP_ENDPOINT);
	}
	this.signup = function(signup){
		console.log("inside signup service");
		return($http.post(getUrl(),signup));
	};
});