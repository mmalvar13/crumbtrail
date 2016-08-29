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
	<body>
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
									<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
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

		<!----MAIN BODY --->
		<div class="container-fluid">
			<div class="container truck-list-box">
				<div class="row">
					<div class="col-xs-6"><img src="https://hd.unsplash.com/photo-1468956398224-6d6f66e22c35" class="img-responsive img-thumbnail"></div>
					<div class="col-xs-4 truck-div-padding">
						<h4 class="truck-list-company-name">Company Name</h4>
						<hr class="truck-list-hr">
						<ul class="truck-list-ul">
							<li>"A Taste of NM"</li>
							<li>tacos</li>
							<li>burritos</li>
							<li>nachos</li>
						</ul>

					</div>
				</div>

			</div>
		</div>



</body>