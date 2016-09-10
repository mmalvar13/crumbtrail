<!--<!DOCTYPE html>-->
<!--<html lang="en">-->
<!--	<head>-->
<!--		<meta charset="UTF-8">-->
<!--		<meta http-equiv="X-UA-COMPATIBLE" content="IE=Edge">-->
<!--		<meta name="viewport" content="width=device-width, initial-scale=1">-->
<!---->
<!--		<!-------------Bootstrap links all here---------->-->
<!--		<!-- Latest compiled and minified CSS -->-->
<!--		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"-->
<!--				integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"-->
<!--				crossorigin="anonymous"/>-->
<!---->
<!--		<!-- Optional theme -->-->
<!--		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"-->
<!--				integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp"-->
<!--				crossorigin="anonymous"/>-->
<!---->
<!--		<!---------------jQuery------------------------>-->
<!--		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>-->
<!---->
<!--		<!-- Latest compiled and minified JavaScript -->-->
<!--		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"-->
<!--				  integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"-->
<!--				  crossorigin="anonymous"></script>-->
<!---->
<!--		<!---------------Font Awesome Links------------------->-->
<!--		<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">-->
<!---->
<!---->
<!--		<!---------------Custom CSS here----------------------->-->
<!--		<link href="../../css/style.css" rel="stylesheet" type="text/css"/>-->
<!---->
<!---->
<!--		<!-------------------GOOGLE FONTS------------------>-->
<!--		<link href="https://fonts.googleapis.com/css?family=Fascinate+Inline|Nixie+One|Roboto" rel="stylesheet">-->
<!---->
<!--		<title>-->
<!--			CrumbTrail   <!----add cool icon for tabs here ------->-->
<!--		</title>-->
<!--	</head>-->
<!---->
<!--	<!--	---------------------Beginning of user content--------------------------------->-->
<!--	<body class="sfooter">-->
<!--		<div class="sfooter-content">-->
<!--			<header>-->
<!--				<div class="navbar navbar-default navbar-fixed-top">-->
<!--					<div class="container">-->
<!--						<div class="navbar-header">-->
<!--							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">-->
<!--								<span class="icon-bar"></span>-->
<!--								<span class="icon-bar"></span>-->
<!--								<span class="icon-bar"></span>-->
<!--							</button>-->
<!--							<a class="navbar-brand hidden-xs" href="#">CrumbTrail</a>-->
<!--							<a class="navbar-brand visible-xs" href="#">CT</a>-->
<!---->
<!--							<!-------search form--------->-->
<!--							<form class="navbar-form pull-left" role="search">-->
<!--								<div class="input-group">-->
<!--									<input type="text" class="form-control" placeholder="Search">-->
<!--									<div class="input-group-btn">-->
<!--										<button type="submit" class="btn btn-default"><span-->
<!--												class="glyphicon glyphicon-search"></span></button>-->
<!--									</div>-->
<!--								</div>-->
<!--							</form>-->
<!---->
<!--							<!--------search form-------->-->
<!---->
<!--						</div>-->
<!--						<div class="navbar-collapse collapse">-->
<!--							<ul class="nav navbar-nav navbar-right">-->
<!--								<li class="active"><a href="#">Home</a></li>-->
<!--								<li><a href="#about">See All Trucks</a></li>-->
<!--								<li><a href="#contact">Settings</a></li>-->
<!--								<li><a href="#contact">Signout</a></li>-->
<!--							</ul>-->
<!--						</div>-->
<!--						<!--/.navbar-collapse -->-->
<!--					</div>-->
<!--				</div>-->
<!--			</header>-->
			<!---------------COMMENT OUT-------------->


			<!--------------------------------MAIN BODY----------------------------------->
			<div class="container">

				<!---------------START SERVING------------------------------------->
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<button type="button" class="btn btn-lg btn-block truck-map-start-serving-btn"
								  data-toggle="modal" data-target="#startServing">START SERVING
						</button>
					</div>
				</div>

				<!--------Modal------->
				<div class="modal fade bd-example-modal-lg" id="startServing" tabindex="-1" role="dialog"
					  aria-labelledby="myLargeModalLabel"
					  aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="row">
								<button type="button" class="close truck-map-close-modal" data-dismiss="modal"
										  aria-label="Close">
									<span aria-hidden="true">&times;</span></button>
								<!--							</button>-->
							</div>
							<div class="row">
								<h2 class="text-center">Start Serving</h2>
							</div>
							<hr class="truck-map-hr">
							<div class="form-group row">
								<div class="col-xs-4 text-center">
									<h4>End Time:</h4>
								</div>
								<div class="col-xs-7 truck-map-time-field">
									<input class="form-control" type="time" value="13:45:00" id="time-input">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-xs-4 text-center">
									<h4>Select a truck:</h4>
								</div>
								<div class="col-xs-6">
									<select class="form-control">
										<option value="one">Truck 1</option>
										<option value="two">Truck 2</option>
										<option value="three">Truck 3</option>
										<option value="four">Truck 4</option>
										<option value="five">Truck 5</option>
									</select>
								</div>
							</div>
							<div class="row">
								<h2 class="text-center">Your Location</h2>
								<hr class="truck-map-hr">
							</div>
							<div class="row">
								<div class="col-xs-4 text-center">
									<h4>You are currently located at:</h4>
								</div>
								<div class="col-xs-7 text-center truck-map-location"></div>
							</div>
							<div class="row text-center">

								<button type="button" class="btn btn-warning btn-lg truck-map-submit-btn">Submit</button>
							</div>
						</div>
					</div>
				</div>


				<!---------------STOP SERVING------------------------------------->
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<button type="button" class="btn btn-lg btn-block truck-map-stop-serving-btn"
								  data-toggle="modal" data-target="#stopServing">STOP SERVING
						</button>
					</div>
				</div>

				<!--------Modal------->
				<div class="modal fade bd-example-modal-lg" id="stopServing" tabindex="-1" role="dialog"
					  aria-labelledby="myLargeModalLabel"
					  aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="row">
								<button type="button" class="close truck-map-close-modal" data-dismiss="modal"
										  aria-label="Close">
									<span aria-hidden="true">&times;</span></button>

							</div>
							<div class="row">
								<h2 class="text-center">Current Stop Time</h2>
							</div>
							<hr class="truck-map-hr">
							<div class="row">
								<div class="col-xs-6 col-xs-offset-3  truck-map-end-time"></div>
							</div>

							<!---update current end time ----->
							<div class="row">
								<h3 class="text-center">Set New End-Time?</h3>
							</div>
							<hr class="truck-map-hr">
							<div class="form-group row">
								<div class="col-xs-4 text-center">
									<h4>New End Time:</h4>
								</div>
								<div class="col-xs-7 truck-map-time-field">
									<input class="form-control" type="time" value="13:45:00" id="time-input">
								</div>
							</div>
							<div class="row text-center">
								<button type="button" class="btn btn-warning truck-map-update-btn">Update Time</button>
							</div>

							<!-----STOP SERVING------>
							<div class="row">
								<h3 class="text-center">Or...</h3>
							</div>
							<div class="row text-center">
								<button type="button" class="btn btn-danger btn-lg truck-map-stop-btn">STOP SERVING</button>
							</div>

						</div>
					</div>
				</div>

			</div>
		</div>
			<!---------------COMMENT OUT-------------->
<!--			<footer class="bfoot">-->
<!--			</footer>-->
<!---->
<!---->
<!--	</body>-->
<!--</html>-->