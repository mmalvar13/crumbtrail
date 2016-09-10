<!--------------------------------MAIN BODY----------------------------------->
<div class="container">
	<div class="row">
		<h1 class="text-center">Food Truck Login</h1>
		<hr class="truck-login-hr">
	</div>
	<!-----------LOGIN FORM------------------->
	<div class="col-md-4 col-md-offset-4">
		<form name="signinForm" id="signinForm" class="form-horizontal well" ng-controller="SigninFormController"
				ng-submit="submit(formData, signinForm.$valid);" novalidate>
			<div class="form-group" ng-class="{'has-error':signinForm.inputEmail.$touched && signinForm.inputEmail.$invalid}">
				<label for="inputEmail" class="sr-only">Email address</label>
				<input type="email" id="inputEmail" name="inputEmail" class="form-control" ng-model="formData.inputEmail" placeholder="Email address" required="true" autofocus=""/>
			</div>
			<div class
			<label for="inputPassword" class="sr-only">Password</label>
			<input type="password" id="inputPassword" class="form-control" placeholder="Password" required="">
			<div class="checkbox">
				<label>
					<input type="checkbox" value="remember-me"> Remember me
				</label>
			</div>
			<button class="btn btn-lg btn-warning btn-block" type="submit">Sign in</button>
		</form>
	</div>


	<!----------NEED TO REGISTER SECTION-------->
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<button type="button" class="btn btn-outline-warning btn-lg btn-block truck-login-register-btn">Need
				to register your company?
			</button>
		</div>
	</div>
</div>
</div> <!------sfooter------>



