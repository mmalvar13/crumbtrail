<!----MAIN BODY --->

<div class="row">
	<div class="container-fluid truck-body">
<!--		<div class="container">-->
		<h1 id="all-trucks">All Food Trucks</h1>
			<hr class="truck-list-hr">
		<div class="col-md-6" ng-repeat="company in companyData">
			<div class="truck-list-box truck-image">
				<div class="truck-list-serving-icon"></div>
				<h3 class="truck-h3"><a href="profile/{{company.companyId}}">{{company.companyName}}</a></h3>
				<hr class="truck-list-hr">
				<p class="truck-list-text">{{company.companyDescription}}</p>
				<ul class="truck-list-ul">
					<li>{{company.companyMenuText}}</li>
				</ul>
			</div>
		</div>
<!--		</div>-->
	</div>
</div>

<!--<div class="row">-->
<!--	<div class="container" ng-repeat="company in companyData">-->
<!--		<div class="truck-list-box truck-image">-->
<!--			<div class="truck-list-serving-icon"></div>-->
<!--			<h3 class="truck-h3" ><a href="profile/{{company.companyId}}">{{company.companyName}}</a></h3>-->
<!--			<hr class="truck-list-hr">-->
<!--			<p class="truck-list-text" >{{company.companyDescription}}</p>-->
<!--			<ul class="truck-list-ul">-->
<!--				<li>{{company.companyMenuText}}</li>-->
<!--			</ul>-->
<!--		</div>-->
<!--	</div>-->
<!--</div>-->


<!--<div class="row">-->
<!--	<div class="container">-->
<!--		<div class="truck-list-box truck-image">-->
<!--			<div class="truck-list-serving-icon"></div>-->
<!--			<h3 class="truck-h3">Company Name</h3>-->
<!--			<hr class="truck-list-hr">-->
<!--			<p class="truck-list-text">We make the best damn tacos in the whole damn world!</p>-->
<!--			<ul class="truck-list-ul">-->
<!--				<li>Tacos</li>-->
<!--				<li>Burritos</li>-->
<!--				<li>Nachos</li>-->
<!--				<li>People-meat</li>-->
<!--			</ul>-->
<!--		</div>-->
<!--	</div>-->
<!--</div>-->
<!---->
<!--<div class="row">-->
<!--	<div class="container">-->
<!--		<div class="truck-list-box truck-image">-->
<!--			<div class="truck-list-serving-icon"></div>-->
<!--			<h3 class="truck-h3">Company Name</h3>-->
<!--			<hr class="truck-list-hr">-->
<!--			<ul class="truck-list-ul">-->
<!--				<li>asdfasdfasdf</li>-->
<!--				<li>asdfasdfasdf</li>-->
<!--				<li>asdfasdfasdf</li>-->
<!--				<li>asdfasdfasdf</li>-->
<!--			</ul>-->
<!--		</div>-->
<!--	</div>-->
<!--</div>-->
<!---->
<!--<div class="row">-->
<!--	<div class="container">-->
<!--		<div class="truck-list-box truck-image">-->
<!--			<div class="truck-list-serving-icon"></div>-->
<!--			<h3 class="truck-h3">Company Name</h3>-->
<!--			<hr class="truck-list-hr">-->
<!--			<ul class="truck-list-ul">-->
<!--				<li>asdfasdfasdf</li>-->
<!--				<li>asdfasdfasdf</li>-->
<!--				<li>asdfasdfasdf</li>-->
<!--				<li>asdfasdfasdf</li>-->
<!--			</ul>-->
<!--		</div>-->
<!--	</div>-->
<!--</div>-->
<!--</div>-->
