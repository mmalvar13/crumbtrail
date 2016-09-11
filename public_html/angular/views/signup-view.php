<!--------------------------------MAIN BODY----------------------------------->

<div class="container registration-main">
	<h1>Company Registration</h1>
	<hr>
	<h2>Personal Info</h2>
	<hr class="registration-hr">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<form name="profileSignupForm" id="profileSignupForm" ng-controller="SignupController"
					ng-submit="submit(formData, profileSignupForm.$valid);" novalidate>

				<!----form groups start here----->
				<!-----profile first name ----->
				<div class="form-group text-center"
					  ng-class="{'has-error': profileSignupForm.firstName.$touched && profileSignupForm.firstName">
					<label for="firstName">First name</label>
					<input type="text" id="firstName" name="firstName" ng-model="formData.firstName" ng-required="true"
							 class="form-control registration-input"
							 placeholder="First Name">
					<!-----form alerts----->
					<div class="alert alert-danger" role="alert" ng-messages="profileSignupForm.firstName.$error" ng-if="profileSignupForm.firstName.$touched" ng-hide="profileSignupForm.firstName.$valid">
						<p ng-message="required">Please Enter Your first Name</p>
						</div>
				</div>

				<!----form groups start here----->
				<!-----profile LAST name ----->
				<div class="form-group text-center"
					  ng-class="{'has-error': profileSignupForm.lastName.$touched && profileSignupForm.lastName">
					<label for="lastName">Last name</label>
					<input type="text" id="lastName" name="lastName" ng-model="formData.lastName" ng-required="true"
							 class="form-control registration-input"
							 placeholder="Last Name">
					<!-----form alerts----->
					<div class="alert alert-danger" role="alert" ng-messages="profileSignupForm.lastName.$error" ng-if="profileSignupForm.lastName.$touched" ng-hide="profileSignupForm.lastName.$valid">
						<p ng-message="required">Please Enter Your last Name</p>
					</div>
				</div>


				<!----form groups start here----->
				<!-----profile Email ----->
				<div class="form-group text-center"
					  ng-class="{'has-error': profileSignupForm.Email.$touched && profileSignupForm.Email">
					<label for="Email">Email</label>
					<input type="email" id="Email" name="Email" ng-model="formData.Email" ng-required="true"
							 class="form-control registration-input"
							 placeholder="Email">
					<!-----form alerts----->
					<div class="alert alert-danger" role="alert" ng-messages="profileSignupForm.Email.$error" ng-if="profileSignupForm.Email.$touched" ng-hide="profileSignupForm.Email.$valid">
						<p ng-message="required">Please Enter Your Email</p>
					</div>
				</div>


				<!----form groups start here----->
				<!-----profile phone ----->
				<div class="form-group text-center"
					  ng-class="{'has-error': profileSignupForm.phone.$touched && profileSignupForm.phone">
					<label for="phone">phone</label>
					<input type="tel" id="phone" name="phone" ng-model="formData.phone" ng-required="true"
							 class="form-control registration-input"
							 placeholder="phone">
					<!-----form alerts----->
					<div class="alert alert-danger" role="alert" ng-messages="profileSignupForm.phone.$error" ng-if="profileSignupForm.phone.$touched" ng-hide="profileSignupForm.phone.$valid">
						<p ng-message="required">Please Enter Your phone</p>
					</div>
				</div>



				<!----form groups start here----->
				<!-----profile password ----->
				<div class="form-group"  ng-class="{'has-error': profileSignupForm.password.$touched && profileSignupForm.password">
					<label for="password">Password</label>
					<input type="password" id="password" name="password" ng-model="formData.password" ng-minlength="8" ng-required="true"
							 class="form-control registration-input"
							 placeholder="password">
					<!-----form alerts----->
					<div class="alert alert-danger" role="alert" ng-messages="profileSignupForm.password.$error" ng-if="profileSignupForm.password.$touched" ng-hide="profileSignupForm.password.$valid">
						<p ng-message="minlength">Password must be at least 8 characters long!</p>
						<p ng-message="required">Please Enter Your password</p>
					</div>
				</div>


				<!----form groups start here----->
				<!-----profile repeat repeatPassword ----->
				<div class="form-group"  ng-class="{'has-error': profileSignupForm.repeatPassword.$touched && profileSignupForm.repeatPassword">
					<label for="repeatPassword"> Repeat Password</label>
					<input type="password" id="repeatPassword" name="repeatPassword" ng-model="formData.repeatPassword" ng-minlength="8" ng-required="true"
							 class="form-control registration-input"
							 placeholder=" Repeat Password">
					<!-----form alerts----->
					<div class="alert alert-danger" role="alert" ng-messages="profileSignupForm.repeatPassword.$error" ng-if="profileSignupForm.repeatPassword.$touched" ng-hide="profileSignupForm.repeatPassword.$valid">
						<p ng-message="minlength">Password must be at least 8 characters long!</p>
						<p ng-message="required">Please repeat your password</p>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-----------company signup info------------>
	<h2>Company Info</h2>
	<hr class="registration-hr">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<!---------beginning of angular form------>
			<form name="companySignupForm" id="companySignupForm" ng-controller="SignupController"
					ng-submit="submit(formData, companySignupForm.$valid);" novalidate>


				<!----form groups start here----->
				<!-----company name ----->
				<div class="form-group text-center"
					  ng-class="{'has-error': companySignupForm.companyName.$touched && companySignupForm.companyName">
					<label for="companyName">Company name</label>
					<input type="text" id="companyName" name="companyName" ng-model="formData.companyName" ng-required="true"
							 class="form-control registration-input"
							 placeholder="Company Name">
					<!-----form alerts----->
					<div class="alert alert-danger" role="alert" ng-messages="companySignupForm.companyName.$error" ng-if="companySignupForm.companyName.$touched" ng-hide="companySignupForm.companyName.$valid">
						<p ng-message="required">Please Enter Your Company Name</p>
					</div>
				</div>


				<!----form groups start here----->
				<!-----company email ----->
				<div class="form-group text-center"
					  ng-class="{'has-error': companySignupForm.companyEmail.$touched && companySignupForm.companyEmail">
					<label for="companyEmail">Company email</label>
					<input type="text" id="companyEmail" name="companyEmail" ng-model="formData.companyEmail" ng-required="true"
							 class="form-control registration-input"
							 placeholder="Company Email">
					<!-----form alerts----->
					<div class="alert alert-danger" role="alert" ng-messages="companySignupForm.companyEmail.$error" ng-if="companySignupForm.companyEmail.$touched" ng-hide="companySignupForm.companyEmail.$valid">
						<p ng-message="required">Please Enter Your Company Email</p>
					</div>
				</div>

				<!----form groups start here----->
				<!-----company phone ----->
<!--				NEED TO ADD minlength on the phones!-->
				<div class="form-group text-center"
					  ng-class="{'has-error': companySignupForm.companyPhone.$touched && companySignupForm.companyPhone">
					<label for="companyPhone">Company Phone</label>
					<input type="tel" id="companyPhone" name="companyPhone" ng-model="formData.companyPhone" ng-required="true"
							 class="form-control registration-input"
							 placeholder="Company Phone">
					<!-----form alerts----->
					<div class="alert alert-danger" role="alert" ng-messages="companySignupForm.companyPhone.$error" ng-if="companySignupForm.companyPhone.$touched" ng-hide="companySignupForm.companyPhone.$valid">
						<p ng-message="required">Please Enter Your Company Phone</p>
					</div>
				</div>


				<!----form groups start here----->
				<!-----company street ----->
				<div class="form-group text-center"
					  ng-class="{'has-error': companySignupForm.companyStreet.$touched && companySignupForm.companyStreet">
					<label for="companyStreet">Company Street</label>
					<input type="text" id="companyStreet" name="companyStreet" ng-model="formData.companyStreet" ng-required="true"
							 class="form-control registration-input"
							 placeholder="Company Street">
					<!-----form alerts----->
					<div class="alert alert-danger" role="alert" ng-messages="companySignupForm.companyStreet.$error" ng-if="companySignupForm.companyStreet.$touched" ng-hide="companySignupForm.companyStreet.$valid">
						<p ng-message="required">Please Enter Your Company Street</p>
					</div>
				</div>


				<!----form groups start here----->
				<!-----company Street2 ----->
				<div class="form-group text-center"
					  ng-class="{'has-error': companySignupForm.companyStreet2.$touched && companySignupForm.companyStreet2">
					<label for="companyStreet2">Company Street 2</label>
					<input type="text" id="companyStreet2" name="companyStreet2" ng-model="formData.companyStreet2"
							 class="form-control registration-input"
							 placeholder="Company Street 2">
					<!-----form alerts----->
<!--					<div class="alert alert-danger" role="alert" ng-messages="companySignupForm.companyStreet2.$error" ng-if="companySignupForm.companyStreet2.$touched" ng-hide="companySignupForm.companyStreet2.$valid">-->
<!--						<p ng-message="required">Please Enter Your Company Street 2</p>-->
<!--					</div>-->
				</div>


				<!----form groups start here----->
				<!-----company city ----->
				<div class="form-group text-center"
					  ng-class="{'has-error': companySignupForm.companyCity.$touched && companySignupForm.companyCity">
					<label for="companyCity">Company City</label>
					<input type="text" id="companyCity" name="companyCity" ng-model="formData.companyCity" ng-required="true"
							 class="form-control registration-input"
							 placeholder="Company City">
					<!-----form alerts----->
					<div class="alert alert-danger" role="alert" ng-messages="companySignupForm.companyCity.$error" ng-if="companySignupForm.companyCity.$touched" ng-hide="companySignupForm.companyCity.$valid">
						<p ng-message="required">Please Enter Your Company City</p>
					</div>
				</div>


				<!----form groups start here----->
				<!-----company State ----->
				<div class="form-group text-center"
					  ng-class="{'has-error': companySignupForm.companyState.$touched && companySignupForm.companyState">
					<label for="companyState">Company State</label>
					<input type="text" id="companyState" name="companyState" ng-model="formData.companyState" ng-required="true"
							 class="form-control registration-input"
							 placeholder="Company State">
					<!-----form alerts----->
					<div class="alert alert-danger" role="alert" ng-messages="companySignupForm.companyState.$error" ng-if="companySignupForm.companyState.$touched" ng-hide="companySignupForm.companyState.$valid">
						<p ng-message="required">Please Enter Your Company State</p>
					</div>
				</div>



				<!----form groups start here----->
				<!-----company Zip ----->
				<div class="form-group text-center"
					  ng-class="{'has-error': companySignupForm.companyZip.$touched && companySignupForm.companyZip">
					<label for="companyZip">Company Zip</label>
					<input type="text" id="companyZip" name="companyZip" ng-model="formData.companyZip" ng-required="true"
							 class="form-control registration-input"
							 placeholder="Company Zip">
					<!-----form alerts----->
					<div class="alert alert-danger" role="alert" ng-messages="companySignupForm.companyZip.$error" ng-if="companySignupForm.companyZip.$touched" ng-hide="companySignupForm.companyZip.$valid">
						<p ng-message="required">Please Enter Your Company Zip</p>
					</div>
				</div>

				<!----form groups start here----->
				<!-----company License ----->
				<div class="form-group text-center"
					  ng-class="{'has-error': companySignupForm.companyLicense.$touched && companySignupForm.companyLicense">
					<label for="companyLicense">Company License</label>
					<input type="text" id="companyLicense" name="companyLicense" ng-model="formData.companyLicense" ng-minlength="9" ng-maxlength="9" ng-required="true"
							 class="form-control registration-input"
							 placeholder="Company License">
					<!-----form alerts----->
					<div class="alert alert-danger" role="alert" ng-messages="companySignupForm.companyLicense.$error" ng-if="companySignupForm.companyLicense.$touched" ng-hide="companySignupForm.companyLicense.$valid">
						<p ng-message="required">Please enter your city issued, 9-digit
							business license number</p>
						<p ng-minlength="required">Please enter your city issued, 9-digit
							business license number</p>
						<p ng-maxlength="required">Please enter your city issued, 9-digit
							business license number</p>
					</div>
				</div>

				<!----form groups start here----->
				<!-----company Health Permit ----->
				<div class="form-group text-center"
					  ng-class="{'has-error': companySignupForm.companyHealthPermit.$touched && companySignupForm.companyHealthPermit">
					<label for="companyHealthPermit">Company Health Permit</label>
					<input type="text" id="companyHealthPermit" name="companyHealthPermit" ng-model="formData.companyHealthPermit" ng-minlength="9" ng-maxlength="9" ng-required="true"
							 class="form-control registration-input"
							 placeholder="Company Health Permit">
					<!-----form alerts----->
					<div class="alert alert-danger" role="alert" ng-messages="companySignupForm.companyHealthPermit.$error" ng-if="companySignupForm.companyHealthPermit.$touched" ng-hide="companySignupForm.companyHealthPermit.$valid">
						<p ng-message="required">Please enter your city issued, 9-digit
							business Health Permit number</p>
					</div>
				</div>

			</form>
			<button type="button" class="btn btn-secondary btn-lg registration-submit-button">Submit</button>
		</div>
	</div>
</div>
</div> <!-------------sfooter---->
