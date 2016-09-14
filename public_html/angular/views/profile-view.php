<!-- Main body-->
<div class="container">
	<!--			title row-->
	<div class="row">
		<h1 class="company-name">{{ companyData.companyName }}</h1>
		<hr class="company-hr">
	</div>

	<div class="row">
		<div class="col-xs-1">
			<div class="serving-icon"></div>
		</div>
		<div class="col-xs-4 "><h5 class="serving-now">Serving Now!</h5></div>
		<button type="button" class="btn btn-warning pull-right locate-btn">Locate</button>
	</div>

	<!-------------company image and info section-------------------->

	<div class="row company-info-div">
		<div class="col-md-6">
			<figure class="figure">
				<img src="images/popFizzTruck.png" class="figure-img img-fluid img-rounded img-responsive profile-image"/>
				<figcaption class="figure-caption figcapt-text pull-right">"PopFizz on your face!"</figcaption>
			</figure>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="company-description-box">
					<h2 class="text-center company-description-header-font">Who We Are</h2>
					<hr class="company-hr">
					<p class="companyDescription">{{companyData.companyDescription}}</p>
				</div>

				<div class="company-description-box">
					<h2 class="text-center company-description-header-font">What We Serve</h2>
					<hr class="company-hr">

					<table class="table text-center">
						<thead>
							<tr>
								<th></th>
								<th class="text-center">Paletas $3</th>
								<th class="text-center">Ice Cream Tacos $3</th>
								<th class="text-center">Aguas Frescas $2</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th scope="row"></th>
								<td>Coconut</td>
								<td>Mint Chocolate</td>
								<td>Melon</td>
							</tr>
							<tr>
								<th scope="row"></th>
								<td>Lime</td>
								<td>Churro Chunk</td>
								<td>Sandia</td>
							</tr>
							<tr>
								<th scope="row"></th>
								<td>Coffee</td>
								<td>Java Chip</td>
								<td>Jamaica</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<!---MENU SECTION----->
		<div class="company-description-box">
			<div class="row">

				<h2 class="text-center company-description-header-font">When We Serve</h2>
				<hr class="company-hr">
			</div>

			<table class="table table-hover">
				<thead>
					<tr>
						<th class="text-center">Monday</th>
						<th class="text-center">Tuesday</th>
						<th class="text-center">Wednesday</th>
						<th class="text-center">Thursday</th>
						<th class="text-center">Friday</th>
						<th class="text-center">Saturday</th>
						<th class="text-center">Sunday</th>
					</tr>
				</thead>
				<tbody>
					<tr class="text-center">
<!--						<th scope="row"></th>-->
						<td>Hyder Park, 6-9pm</td>
						<td>Central Park, noon-3pm</td>
						<td>>Hyder Park, noon-3pm.</td>
						<td>Balloon Fiesta Park, noon-9pm</td>
						<td>Downtown 6-11pm</td>
						<td>Uptown 12-5pm</td>
						<td>Random Location!</td>

					</tr>
<!--					<tr>-->
<!--						<th scope="row"></th>-->
<!--						<td>Jacob</td>-->
<!---->
<!--					</tr>-->
<!--					<tr>-->
<!--						<th scope="row"></th>-->
<!---->
<!--						<td>@twitter</td>-->
<!--					</tr>-->
<!--					<tr>-->
<!--						<th scope="row"></th>-->
<!--						<td>Mark</td>-->
<!---->
<!--					</tr>-->
<!--					<tr>-->
<!--						<th scope="row"></th>-->
<!--						<td>Mark</td>-->
<!---->
<!--					</tr>-->
<!--					<tr>-->
<!--						<th scope="row"></th>-->
<!--						<td>Mark</td>-->
<!---->
<!--					</tr>-->
<!--					<tr>-->
<!--						<th scope="row"></th>-->
<!--						<td>Mark</td>-->
<!---->
<!--					</tr>-->
				</tbody>
			</table>

				<!--					<p id="companyMenuText">{{companyData.companyMenuText}}</p>-->
				<!--				</div>-->
				<!--			</div>-->
				<!--		</div>-->
				<!---->
				<!--		<!--------------company description-------------->
				<!--		<div class="description-box">-->
				<!--			<div class="row text-center">-->
				<!--				{{companyData.companyDescription}}-->
				<!--				<hr>-->
				<!---->
				<!--				<!---------days of the week "loose" schedule------------>
				<!--				<h3 class="week-schedule-h3 display-4">Monday</h3>-->
				<!--				<div><p class="week-description">Hyder Park, 6-9 pm.</p></div>-->
				<!--				<h3 class="week-schedule-h3">Tuesday</h3>-->
				<!--				<p class="week-description">Central Park, noon-3 pm.</p>-->
				<!--				<h3 class="week-schedule-h3">Wednesday</h3>-->
				<!--				<p class="week-description">Central Park, noon-3 pm.</p>-->
				<!--				<h3 class="week-schedule-h3">Thursday</h3>-->
				<!--				<p class="week-description">Hyder Park, noon-3 pm.</p>-->
				<!--				<h3 class="week-schedule-h3">Friday</h3>-->
				<!--				<p class="week-description">Balloon Fiesta Park, noon-9 pm.</p>-->
				<!--				<h3 class="week-schedule-h3">Saturday</h3>-->
				<!--				<p class="week-description">Balloon Fiesta Park, noon-9 pm</p>-->
				<!--				<h3 class="week-schedule-h3">Sunday</h3>-->
				<!--				<p class="week-description">(closed)</p>-->
				<!--			</div>-->
				<!--		</div>-->
				<!---->
				<!--		<!-------menu box    ------->
				<!--		<div class="" menu-box">-->
				<!--			<div class="row text-center">-->
				<!--				<h3>Menu</h3>-->
				<!--				<hr class="menu-hr">-->
				<!--				{{companyData.companyMenuText}}-->
				<!---->
				<!--			</div>-->
				<!--		</div>-->
				<!----fluid container------>
			</div>
