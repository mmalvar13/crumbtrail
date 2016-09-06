<header ng-controller="navController">

	<!-- bootstrap breakpoint directive to control collapse behavior -->
	<bootstrap-breakpoint></bootstrap-breakpoint>


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
					<li class="active"><a href="index">Home</a></li>
					<li><a href="truck-listing">See All Trucks</a></li>
					<li><a href="settings">Settings</a></li>
					<li><a href="sign-in">Sign In</a></li>
					<li><a href="truck-map">Truck Map</a></li>
					<li><a href="profile">Profile</a></li>
					<li><a href="registration">Register Your Truck</a></li>
				</ul>
			</div>
			<!--/.navbar-collapse -->
		</div>
	</div>
</header>