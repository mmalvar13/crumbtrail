<!--------------------------------MAIN BODY----------------------------------->
<div class="container">
	<div class="row">
		<h1 class="text-center">Food Truck Login</h1>
		<hr class="truck-login-hr">
	</div>
	<!-----------LOGIN FORM------------------->
	<div class="col-md-4 col-md-offset-4">

		<!--Beginning of the form. names the form and adds in the forms controller (still have not made controller)-->
		<form name="signinForm" id="signinForm" ng-controller="SigninController"
				ng-submit="signin(signinData, signinForm.$valid);" novalidate>


			<!--first form group. Email Address-->
			<div class="form-group"
				  ng-class="{'has-error':signinForm.inputEmail.$touched && signinForm.inputEmail.$invalid}">
				<label for="inputEmail" class="sr-only">Email address</label>
				<div class="input-group">
					<input type="email" id="inputEmail" name="inputEmail" class="form-control" ng-model="signinData.inputEmail"
							 placeholder="Email address" ng-required="true" autofocus=""/>
				</div>

				<div class="alert alert-danger" role="alert" ng-messages="signinForm.inputEmail.$error"
					  ng-if="signinForm.inputEmail.$touched" ng-hide="signinForm.inputEmail.$valid">
					<p ng-message="required">Please enter your email</p>
				</div>
			</div>

			<!--			<div class="alert alert-danger" role="alert" ng-messages="signinForm."-->
			<!--Second form group. password-->
			<div class="form-group"
				  ng-class="{'has-error':signinForm.inputPassword.$touched && signinForm.inputPassword.$invalid}">
				<label for="inputPassword" class="sr-only">Password</label>
				<div class="input-group">
					<input type="password" id="inputPassword" name="inputPassword" class="form-control"
							 ng-model="signinData.inputPassword" placeholder="Password" ng-required="true"/>
				</div>

				<div class="alert alert-danger" role="alert" ng-messages="signinForm.inputPassword.$error"
					  ng-if="signinForm.inputPassword.$touched" ng-hide="signinForm.inputPassword.$valid">
					<p ng-message="required">Please enter your password</p>
				</div>
			</div>

			<!--remember me checkbox add later if needed-->
<!--			<div class="form-group">-->
<!--			<div class="checkbox">-->
<!--				<label class="checkbox">-->
<!--					<input type="checkbox" value="remember-me"> Remember me-->
<!--				</label>-->
<!--			</div>-->
<!--			</div>-->

			<!--button-->
			<button class="btn btn-lg btn-info btn-warning btn-block" type="submit">Sign in</button>
			<button class="btn btn-lg btn-warning" type="reset" ng-click="reset();">Reset</button>
			<!--can reset button needs CSSing-->

			<hr />
			<h5>Angular Form Data</h5>
			<p ng-show="signinForm.$valid"><em>Form data is valid!</em></p>
			<p ng-hide="signinForm.$valid"><em>Form data is invalid!</em></p>
			<pre>{{signinData}}</pre>
			<uib-alert ng-repeat="alert in alerts" type="" close="alerts.length = 0;"></uib-alert>

		</form>
	</div>


	<!----------NEED TO REGISTER SECTION-------->
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<button type="button" class="btn btn-outline-warning btn-lg btn-block truck-login-register-btn"><a href="sign-up">Need
				to register your company?
			</a></button>
		</div>
	</div>
</div>
</div> <!------sfooter------>



