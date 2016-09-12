<!--------------------------------MAIN BODY----------------------------------->

<div class="container registration-main">
	<h1>Company Registration</h1>
	<hr>
	<h2>Personal Info</h2>
	<hr class="registration-hr">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<form name="signupForm" id="signupForm" ng-controller="SignupController"
					ng-submit="submit(signupData, signupForm.$valid);" novalidate>

				<!----form groups start here----->
				<!-----profile first name ----->
				<div class="form-group text-center"
					  ng-class="{'has-error': signupForm.profileName.$touched && signupForm.profileName">
					<label for="profileName">Your Name</label>
					<input type="text" id="profileName" name="profileName" ng-model="signupData.profileName" ng-required="true"
							 class="form-control registration-input"
							 placeholder="First and Last Name">
					<!-----form alerts----->
					<div class="alert alert-danger" role="alert" ng-messages="signupForm.profileName.$error" ng-if="signupForm.profileName.$touched" ng-hide="signupForm.profileName.$valid">
						<p ng-message="required">Please Enter Your Name</p>
						</div>
				</div>

				<!----form groups start here----->
				<!-----profile Email ----->
				<div class="form-group text-center"
					  ng-class="{'has-error': signupForm.profileEmail.$touched && signupForm.profileEmail">
					<label for="profileEmail">Email</label>
					<input type="email" id="profileEmail" name="profileEmail" ng-model="signupData.profileEmail" ng-required="true"
							 class="form-control registration-input"
							 placeholder="Email">
					<!-----form alerts----->
					<div class="alert alert-danger" role="alert" ng-messages="signupForm.profileEmail.$error" ng-if="signupForm.profileEmail.$touched" ng-hide="signupForm.profileEmail.$valid">
						<p ng-message="required">Please Enter Your Email</p>
					</div>
				</div>


				<!----form groups start here----->
				<!-----profile phone ----->
				<div class="form-group text-center"
					  ng-class="{'has-error': signupForm.profilePhone.$touched && signupForm.profilePhone">
					<label for="profilePhone">Phone Number</label>
					<input type="tel" id="profilePhone" name="profilePhone" ng-model="signupData.profilePhone" ng-required="true"
							 class="form-control registration-input"
							 placeholder="Phone Number">
					<!-----form alerts----->
					<div class="alert alert-danger" role="alert" ng-messages="signupForm.profilePhone.$error" ng-if="signupForm.profilePhone.$touched" ng-hide="signupForm.profilePhone.$valid">
						<p ng-message="required">Please Enter Your Phone Number</p>
					</div>
				</div>



				<!----form groups start here----->
				<!-----profile password ----->
				<div class="form-group"  ng-class="{'has-error': signupForm.profilePassword.$touched && signupForm.profilePassword">
					<label for="profilePassword">Password</label>
					<input type="password" id="profilePassword" name="profilePassword" ng-model="signupData.profilePassword" ng-minlength="6" ng-required="true"
							 class="form-control registration-input"
							 placeholder="Password">
					<!-----form alerts----->
					<div class="alert alert-danger" role="alert" ng-messages="signupForm.profilePassword.$error" ng-if="signupForm.profilePassword.$touched" ng-hide="signupForm.profilePassword.$valid">
						<p ng-message="minlength">Password must be at least 6 characters long!</p>
						<p ng-message="required">Please Enter Your Password</p>
					</div>
				</div>


				<!----form groups start here----->
				<!-----profile repeat repeatPassword ----->
				<div class="form-group"  ng-class="{'has-error': signupForm.confirmPassword.$touched && signupForm.confirmPassword">
					<label for="confirmPassword"> Repeat Password</label>
					<input type="password" id="confirmPassword" name="confirmPassword" ng-model="signupData.confirmPassword" ng-minlength="6" ng-required="true"
							 class="form-control registration-input"
							 placeholder=" Confirm Password">
					<!-----form alerts----->
					<div class="alert alert-danger" role="alert" ng-messages="signupForm.confirmPassword.$error" ng-if="signupForm.confirmPassword.$touched" ng-hide="signupForm.confirmPassword.$valid">
						<p ng-message="minlength">Password must be at least 6 characters long!</p>
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
			<form name="signupForm" id="signupForm" ng-controller="SignupController"
					ng-submit="submit(signupData, signupForm.$valid);" novalidate>


				<!----form groups start here----->
				<!-----company name ----->
				<div class="form-group text-center"
					  ng-class="{'has-error': signupForm.companyName.$touched && signupForm.companyName">
					<label for="companyName">Company name</label>
					<input type="text" id="companyName" name="companyName" ng-model="signupData.companyName" ng-required="true"
							 class="form-control registration-input"
							 placeholder="Company Name">
					<!-----form alerts----->
					<div class="alert alert-danger" role="alert" ng-messages="signupForm.companyName.$error" ng-if="signupForm.companyName.$touched" ng-hide="signupForm.companyName.$valid">
						<p ng-message="required">Please Enter Your Company Name</p>
					</div>
				</div>


				<!----form groups start here----->
				<!-----company email ----->
				<div class="form-group text-center"
					  ng-class="{'has-error': signupForm.companyEmail.$touched && signupForm.companyEmail">
					<label for="companyEmail">Company email</label>
					<input type="text" id="companyEmail" name="companyEmail" ng-model="signupData.companyEmail" ng-required="true"
							 class="form-control registration-input"
							 placeholder="Company Email">
					<!-----form alerts----->
					<div class="alert alert-danger" role="alert" ng-messages="signupForm.companyEmail.$error" ng-if="signupForm.companyEmail.$touched" ng-hide="signupForm.companyEmail.$valid">
						<p ng-message="required">Please Enter Your Company Email</p>
					</div>
				</div>

				<!----form groups start here----->
				<!-----company phone ----->
<!--				NEED TO ADD minlength on the phones!-->
				<div class="form-group text-center"
					  ng-class="{'has-error': signupForm.companyPhone.$touched && signupForm.companyPhone">
					<label for="companyPhone">Company Phone</label>
					<input type="tel" id="companyPhone" name="companyPhone" ng-model="signupData.companyPhone" ng-required="true"
							 class="form-control registration-input"
							 placeholder="Company Phone">
					<!-----form alerts----->
					<div class="alert alert-danger" role="alert" ng-messages="signupForm.companyPhone.$error" ng-if="signupForm.companyPhone.$touched" ng-hide="signupForm.companyPhone.$valid">
						<p ng-message="required">Please Enter Your Company Phone</p>
					</div>
				</div>


				<!----form groups start here----->
				<!-----company street ----->
				<div class="form-group text-center"
					  ng-class="{'has-error': signupForm.companyStreet.$touched && signupForm.companyStreet">
					<label for="companyStreet">Company Street</label>
					<input type="text" id="companyStreet" name="companyStreet" ng-model="signupData.companyStreet" ng-required="true"
							 class="form-control registration-input"
							 placeholder="Company Street">
					<!-----form alerts----->
					<div class="alert alert-danger" role="alert" ng-messages="signupForm.companyStreet.$error" ng-if="signupForm.companyStreet.$touched" ng-hide="signupForm.companyStreet.$valid">
						<p ng-message="required">Please Enter Your Company Street</p>
					</div>
				</div>


				<!----form groups start here----->
				<!-----company Street2 ----->
				<div class="form-group text-center"
					  ng-class="{'has-error': signupForm.companyStreet2.$touched && signupForm.companyStreet2">
					<label for="companyStreet2">Company Street 2</label>
					<input type="text" id="companyStreet2" name="companyStreet2" ng-model="signupData.companyStreet2"
							 class="form-control registration-input"
							 placeholder="Company Street 2">
					<!-----form alerts----->
<!--					<div class="alert alert-danger" role="alert" ng-messages="signupForm.companyStreet2.$error" ng-if="signupForm.companyStreet2.$touched" ng-hide="signupForm.companyStreet2.$valid">-->
<!--						<p ng-message="required">Please Enter Your Company Street 2</p>-->
<!--					</div>-->
				</div>


				<!----form groups start here----->
				<!-----company city ----->
				<div class="form-group text-center"
					  ng-class="{'has-error': signupForm.companyCity.$touched && signupForm.companyCity">
					<label for="companyCity">Company City</label>
					<input type="text" id="companyCity" name="companyCity" ng-model="signupData.companyCity" ng-required="true"
							 class="form-control registration-input"
							 placeholder="Company City">
					<!-----form alerts----->
					<div class="alert alert-danger" role="alert" ng-messages="signupForm.companyCity.$error" ng-if="signupForm.companyCity.$touched" ng-hide="signupForm.companyCity.$valid">
						<p ng-message="required">Please Enter Your Company City</p>
					</div>
				</div>


				<!----form groups start here----->
				<!-----company State ----->
				<div class="form-group text-center"
					  ng-class="{'has-error': signupForm.companyState.$touched && signupForm.companyState">
					<label for="companyState">Company State</label>
					<input type="text" id="companyState" name="companyState" ng-model="signupData.companyState" ng-required="true"
							 class="form-control registration-input"
							 placeholder="Company State">
					<!-----form alerts----->
					<div class="alert alert-danger" role="alert" ng-messages="signupForm.companyState.$error" ng-if="signupForm.companyState.$touched" ng-hide="signupForm.companyState.$valid">
						<p ng-message="required">Please Enter Your Company State</p>
					</div>
				</div>



				<!----form groups start here----->
				<!-----company Zip ----->
				<div class="form-group text-center"
					  ng-class="{'has-error': signupForm.companyZip.$touched && signupForm.companyZip">
					<label for="companyZip">Company Zip</label>
					<input type="text" id="companyZip" name="companyZip" ng-model="signupData.companyZip" ng-required="true"
							 class="form-control registration-input"
							 placeholder="Company Zip">
					<!-----form alerts----->
					<div class="alert alert-danger" role="alert" ng-messages="signupForm.companyZip.$error" ng-if="signupForm.companyZip.$touched" ng-hide="signupForm.companyZip.$valid">
						<p ng-message="required">Please Enter Your Company Zip</p>
					</div>
				</div>

				<!----form groups start here----->
				<!-----company License ----->
				<div class="form-group text-center"
					  ng-class="{'has-error': signupForm.companyLicense.$touched && signupForm.companyLicense">
					<label for="companyLicense">Company License</label>
					<input type="text" id="companyLicense" name="companyLicense" ng-model="signupData.companyLicense" ng-minlength="9" ng-maxlength="9" ng-required="true"
							 class="form-control registration-input"
							 placeholder="Company License">
					<!-----form alerts----->
					<div class="alert alert-danger" role="alert" ng-messages="signupForm.companyLicense.$error" ng-if="signupForm.companyLicense.$touched" ng-hide="signupForm.companyLicense.$valid">
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
					  ng-class="{'has-error': signupForm.companyPermit.$touched && signupForm.companyPermit">
					<label for="companyPermit">Company Health Permit</label>
					<input type="text" id="companyPermit" name="companyPermit" ng-model="signupData.companyPermit" ng-minlength="9" ng-maxlength="9" ng-required="true"
							 class="form-control registration-input"
							 placeholder="Company Health Permit">
					<!-----form alerts----->
					<div class="alert alert-danger" role="alert" ng-messages="signupForm.companyPermit.$error" ng-if="signupForm.companyPermit.$touched" ng-hide="signupForm.companyPermit.$valid">
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
