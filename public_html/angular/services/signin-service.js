//Service for sign-in API.
//author @monica alvarez <mmalvar13@gmail.com>



app.constant("SIGNIN_ENDPOINT", "php/apis/signIn/");
app.service("SignInService", function($http, SIGNIN_ENDPOINT){
	function getUrl(){
		return(SIGNIN_ENDPOINT);
	}
	this.signin = function(signin){ //why is this this.sign in and signup is this.create??
		console.log("inside signin service"); //what is this? i am putting this because i saw an example in brew crew.
		return($http.post(getUrl(), signin));
	};
});