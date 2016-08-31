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
			<div class="container truck-login-body">
				<div class="row">
					<h1>Food Truck Login</h1>
					<hr class="truck-login-hr">
					<!-----------LOGIN FORM------------------->
					<div class="form-wrapper">
					<form class="truck-login-form">
						<label for="inputEmail" class="sr-only">Email address</label>
						<input type="email" id="inputEmail" class="form-control" placeholder="Email address" required="" autofocus="">
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
				</div>

				<!----------NEED TO REGISTER SECTION-------->
				<button type="button" class="btn btn-outline-warning btn-lg btn-block truck-login-register-btn">Need to register your company?</button>


			</div>

			<footer class="bfoot">

			</footer>
		</div>
	</body>



