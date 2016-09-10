<!--------------------------------MAIN BODY----------------------------------->
<div class="container">
	<div class="row">
		<h1 class="text-center">Food Truck Login</h1>
		<hr class="truck-login-hr">
	</div>
	<!-----------LOGIN FORM------------------->
	<div class="col-md-4 col-md-offset-4">

		<!--Beginning of the form. names the form and adds in the forms controller (still have not made controller)-->
		<form name="signinForm" id="signinForm" ng-controller="SigninFormController"
				ng-submit="submit(formData, signinForm.$valid);" novalidate>


			<!--first form group. Email Address-->
			<div class="form-group"
				  ng-class="{'has-error':signinForm.inputEmail.$touched && signinForm.inputEmail.$invalid}">
				<label for="inputEmail" class="sr-only">Email address</label>
				<div class="input-group">
					<input type="email" id="inputEmail" name="inputEmail" class="form-control" ng-model="formData.inputEmail"
							 placeholder="Email address" ng-required="true" autofocus=""/>
				</div>

				<div class="alert alert-danger" role="alert" ng-messages="signinForm.inputEmail.$error"
					  ng-if="signinForm.inputEmail.$touched" ng-hide="signinForm.inputEmail.$valid">
					<p ng-message="required">Please enter your email</p>
				</div>

			</div>

			<!--			<div class="alert alert-danger" role="alert" ng-messages="signinForm."-->
			<!--Second form group. password-->
			<div class="form-group">
				<label for="inputPassword" class="sr-only">Password</label>
				<div class="input-group">
					<input type="password" id="inputPassword" class="form-control" placeholder="Password" required="">
				</div>
			</div>

			<!--checkbox-->
			<div class="checkbox">
				<label>
					<input type="checkbox" value="remember-me"> Remember me
				</label>
			</div>

			<!--button-->
			<button class="btn btn-lg btn-info btn-warning btn-block" type="submit">Sign in</button>
			<!--can add reset button here-->
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



