<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-COMPATIBLE" content="IE=Edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-------------Bootstrap links all here---------->
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
				integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
				crossorigin="anonymous"/>

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
				integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp"
				crossorigin="anonymous"/>

		<!---------------jQuery------------------------>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
				  integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
				  crossorigin="anonymous"></script>

		<!---------------Font Awesome Links------------------->
		<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">


		<!---------------Custom CSS here----------------------->
		<link href="css/style.css" rel="stylesheet" type="text/css"/>


		<!-------------------GOOGLE FONTS------------------>
		<link href="https://fonts.googleapis.com/css?family=Fascinate+Inline|Nixie+One|Roboto" rel="stylesheet">

		<title>
			CrumbTrail   <!----add cool icon for tabs here ------->
		</title>
	</head>

	<!-----------------------Beginning of user content--------------------------------->
	<body class="">
		<div class="sfooter-content">
			<header>
				<div class="navbar navbar-default navbar-fixed-top">
					<div class="container">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand hidden-xs" href="#">CrumbTrail</a>
							<a class="navbar-brand visible-xs" href="#">CT</a>
							<form class="navbar-form pull-left" role="search">
								<div class="input-group">
									<input type="text" class="form-control" placeholder="Search">
									<div class="input-group-btn">
										<button type="submit" class="btn btn-default"><span
												class="glyphicon glyphicon-search"></span></button>
									</div>
								</div>
							</form>
						</div>
						<div class="navbar-collapse collapse">
							<ul class="nav navbar-nav navbar-right">
								<li class="active"><a href="#">Home</a></li>
								<li><a href="#about">See All Trucks</a></li>
								<li><a href="#contact">Settings</a></li>
								<li><a href="#contact">Signout</a></li>
							</ul>
						</div>
						<!--/.navbar-collapse -->
					</div>
				</div>
			</header>

			<!--------------------------------MAIN BODY----------------------------------->

			<main class="container registration-main">
				<h1>Company Registration</h1>
				<hr>
				<h2>Personal Info</h2>
				<hr class="registration-hr">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<form>
							<div class="form-group text-center">
								<label for="first name">First name</label>
								<input type="text" class="form-control registration-input" id="exampleInputEmail1"
										 aria-describedby="emailHelp" placeholder="First Name">
								<!--								<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
							</div>

							<div class="form-group text-center">
								<label for="last name">Last Name</label>
								<input type="text" class="form-control registration-input" id="exampleInputEmail1"
										 aria-describedby="emailHelp" placeholder="Last Name">
							</div>

							<div class="form-group text-center">
								<label for="email">Email</label>
								<input type="email" class="form-control registration-input" id="exampleInputEmail1"
										 aria-describedby="emailHelp" placeholder="Example@email.com">
							</div>

							<div class="form-group text-center">
								<label for="phone">Phone</label>
								<input type="tel" class="form-control registration-input" id="exampleInputEmail1"
										 aria-describedby="emailHelp" placeholder="505-555-5555">
							</div>

							<div class="form-group">
								<label for="password">Password</label>
								<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
								<small id="emailHelp" class="form-text text-muted">make it a good one....</small>
							</div>

							<div class="form-group">
								<label for="password">Confirm Password</label>
								<input type="password" class="form-control" id="exampleInputPassword1"
										 placeholder="Confirm Password">
								<small id="emailHelp" class="form-text text-muted">make sure it was a good one...</small>
							</div>
						</form>
					</div>
				</div>
				<!-----------company signup info------------>
				<h2>Company Info</h2>
				<hr class="registration-hr">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<form>
							<div class="form-group text-center">
								<label for="exampleInputEmail1">Company Name</label>
								<input type="text" class="form-control registration-input" id="exampleInputEmail1"
										 aria-describedby="emailHelp" placeholder="Name of your food truck">
							</div>

							<div class="form-group text-center">
								<label for="companyEmail">Company Email</label>
								<input type="email" class="form-control registration-input" id="exampleInputEmail1"
										 aria-describedby="emailHelp" placeholder="Foodtruck@email.com">
							</div>

							<div class="form-group text-center">
								<label for="companyPhone">Company Phone</label>
								<input type="tel" class="form-control registration-input" id="exampleInputEmail1"
										 aria-describedby="emailHelp" placeholder="505-555-5555">
							</div>

							<h3>Company Address</h3>
							<div class="form-group text-center">
								<label for="street">Street 1</label>
								<input type="text" class="form-control registration-input" id="exampleInputEmail1"
										 aria-describedby="emailHelp" placeholder="1234 yourstreet Ave NE">
							</div>

							<div class="form-group text-center">
								<label for="street">Street 2</label>
								<input type="text" class="form-control registration-input" id="exampleInputEmail1"
										 aria-describedby="emailHelp" placeholder="Street address continued...">
							</div>

							<div class="form-group text-center">
								<label for="city">City</label>
								<input type="text" class="form-control registration-input" id="exampleInputEmail1"
										 aria-describedby="emailHelp" placeholder="Albuquerque">
							</div>

							<div class="form-group text-center">
								<label for="state">State</label>
								<input type="text" class="form-control registration-input" id="exampleInputEmail1"
										 aria-describedby="emailHelp" placeholder="NM">
							</div>

							<div class="form-group text-center">
								<label for="zip">Zip</label>
								<input type="text" class="form-control registration-input" id="exampleInputEmail1"
										 aria-describedby="emailHelp" placeholder="12345">
							</div>

							<div class="form-group text-center">
								<label for="businessLicense">Business License #</label>
								<input type="text" class="form-control registration-input" id="exampleInputEmail1"
										 aria-describedby="emailHelp" placeholder="123456789">
								<small id="businessLicense" class="form-text text-muted">Please enter your city issued, 9-digit
									business license number
								</small>
							</div>

							<div class="form-group text-center">
								<label for="healthPermit">Health Permit #</label>
								<input type="text" class="form-control registration-input" id="exampleInputEmail1"
										 aria-describedby="emailHelp" placeholder="123456789">
								<small id="healthPermit" class="form-text text-muted">Please enter your city issued health
									permit number
								</small>
							</div>
						</form>
						<button type="button" class="btn btn-secondary btn-lg registration-submit-button">Submit</button>
					</div>
				</div>
			</main>


			<footer class="bfoot">
			</footer>
		</div>
	</body>