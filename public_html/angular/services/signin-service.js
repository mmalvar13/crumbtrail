//Service for sign-in API.
//author @monica alvarez <mmalvar13@gmail.com>



app.constant("SIGNIN_ENDPOINT", "php/apis/signIn/");
app.service("SignInService", function($http, SIGNIN_ENDPOINT))