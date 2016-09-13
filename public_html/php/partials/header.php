<header ng-controller="navController">

	<!-- bootstrap breakpoint directive to control collapse behavior -->
	<bootstrap-breakpoint></bootstrap-breakpoint>


	<div class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" ng-click="navCollapsed = !navCollapsed">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
<!--				<a href="#" class="navbar-left"><img src="../../images/crumbtraillogo.png"></a>-->
				<a class=" navbar-brand hidden-xs" href="#"><img  class="logo-img" src="images/crumbtraillogo.png" class="img-responsive"></a>
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
			<div class="navbar-collapse collapse" uib-collapse="navCollapsed">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="index">Home</a></li> <!--I took out class active on this list-->
					<li><a href="truck-listing">See All Trucks</a></li>
					<li><a href="settings">Settings</a></li>
					<li><a href="sign-in">Sign In</a></li>
					<li><a href="truck-map">Truck Map</a></li>
<!--					<li><a href="profile">Profile</a></li>--> <!--add this to be viewed by truck owners only-->
					<li><a href="sign-up">Register Your Truck</a></li>
				</ul>
			</div>
			<!--/.navbar-collapse -->
		</div>
	</div>
</header>