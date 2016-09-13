<!--------------------------------MAIN BODY----------------------------------->
<div class="container-fluid login-background">

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
					  ng-class="{'has-error':signinForm.profileEmail.$touched && signinForm.profileEmail.$invalid}">
					<label for="profileEmail" class="sr-only">Email address</label>
					<div class="input-group truck-login-input">

						<input type="email" id="profileEmail" name="profileEmail" class="form-control"
								 ng-model="signinData.profileEmail"
								 placeholder="Email address" ng-required="true" autofocus=""/>

					</div>

					<!--				<div class="alert alert-danger" role="alert" ng-messages="signinForm.profileEmail.$error"-->
					<!--					  ng-if="signinForm.profileEmail.$touched" ng-hide="signinForm.profileEmail.$valid">-->
					<!--					<p ng-message="required">Please enter your email</p>-->
					<!--				</div>-->
				</div>

				<!--			<div class="alert alert-danger" role="alert" ng-messages="signinForm."-->
				<!--Second form group. password-->
				<div class="form-group"
					  ng-class="{'has-error':signinForm.profilePassword.$touched && signinForm.profilePassword.$invalid}">
					<label for="profilePassword" class="sr-only">Password</label>
					<div class="input-group truck-login-input">
						<input type="password" id="profilePassword" name="profilePassword" class="form-control"
								 ng-model="signinData.profilePassword" placeholder="Password" ng-required="true"/>
					</div>

					<!--				<div class="alert alert-danger" role="alert" ng-messages="signinForm.profilePassword.$error"-->
					<!--					  ng-if="signinForm.profilePassword.$touched" ng-hide="signinForm.profilePassword.$valid">-->
					<!--					<p ng-message="required">Please enter your password</p>-->
					<!--				</div>-->
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
				<button class="btn btn-lg btn-info login-submit btn-block" type="submit">Sign in</button>
				<!--			<button class="btn btn-lg btn-warning" type="reset" ng-click="reset();">Reset</button>-->
				<!--can reset button needs CSSing-->

			</form>
		</div>


		<!----------NEED TO REGISTER SECTION-------->
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<button type="button" class="btn btn-lg btn-block truck-login-register-btn"><a
						href="sign-up">Need
						to register your company?
					</a></button>
			</div>
		</div>

</div>
<!--</div>--> <!------sfooter------>



