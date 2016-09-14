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
				<img src="images/popFizzTruck.png" class="img-responsive img-thumbnail profile-image"/>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="company-description-box">
					<h2 class="text-center">Who We Are</h2>
					<hr class="company-hr">
					<p class="companyDescription">{{companyData.companyDescription}}</p>
					</div>

					<div class="company-description-box">
					<h2 class="text-center">What We Serve</h2>
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
									<td>Lime</td>
									<td>Coffee</td>
								</tr>
								<tr>
									<th scope="row"></th>
									<td>Mint Chocolate</td>
									<td>Churro Chunk</td>
									<td>Java Chip</td>
								</tr>
								<tr>
									<th scope="row"></th>
									<td>Melon</td>
									<td>Sandia</td>
									<td>Jamaica</td>
								</tr>
							</tbody>
						</table>

					</div>




<!--					<p id="companyDescription">{{companyData.companyDescription}}</p>-->
<!--				</div>-->
<!--				<div class="row">-->
<!--					<h2>What We Serve</h2>-->
<!--					<div class="col-md-2">-->
<!--						<h3>Paletas</h3>-->
<!--						<p>Coconut</p>-->
<!--						<p>Lime</p>-->
<!--						<p>Coffee</p>-->
<!--					</div>-->
<!--					<div class="col-md-2">-->
<!--						<h3>Ice Cream Tacos</h3>-->
<!--						<p>Mint Chocolate</p>-->
<!--						<p>Churro Chunk</p>-->
<!--						<p>Java Chip</p>-->
<!--					</div>-->
<!--					<div class="col-md-2">-->
<!--						<h3>Aguas Frescas</h3>-->
<!--						<p>Melon</p>-->
<!--						<p>Sandia</p>-->
<!--						<p>Jamaica</p>-->
<!--					</div>-->
					<!--
										</div>
										<div class="col-md-2">
											<h3>Ice Cream Tacos</h3>
											<ul>
												<li>Mint Chocolate Chip</li>
												<li>Java Chunk</li>
												<li>Churro Chunk</li>
											</ul>
										</div>
										<div class="col-md-2">
											<h3>Aguas Frescas</h3>
											<ul>
												<li>Melon</li>
												<li>Limonada</li>
												<li>Jamaica</li>
											</ul>
										</div>
									</div>
									</div>
					<!--				<table>-->
					<!--					<tr>-->
					<!--						<th>Paletas</th>-->
					<!--						<th>Ice Cream Tacos</th>-->
					<!--						<th>Aguas Frescas</th>-->
					<!--					</tr>-->
					<!--					<tr>-->
					<!--						<td>Coconut</td>-->
					<!--						<td>Lime</td>-->
					<!--						<td>Coffee</td>-->
					<!--					</tr>-->
					<!--				</table>-->
					<!--				<ul>-->
					<!--					<li>Coconut</li>-->
					<!--					<li>Lime</li>-->
					<!--					<li>Coffee</li>-->
					<!--					<li>Matcha Mint</li>-->
					<!--					<li>Mango Chile Lime</li>-->
					<!--				</ul>-->
<!--					<p id="companyMenuText">{{companyData.companyMenuText}}</p>-->
				</div>
			</div>
		</div>

		<!--------------company description-------------->
		<div class="container description-box">
			<div class="row text-center">
				{{companyData.companyDescription}}
				<hr>

				<!---------days of the week "loose" schedule------------>
				<h3 class="week-schedule-h3 display-4">Monday</h3>
				<div><p class="week-description">Hyder Park, 6-9 pm.</p></div>
				<h3 class="week-schedule-h3">Tuesday</h3>
				<p class="week-description">Central Park, noon-3 pm.</p>
				<h3 class="week-schedule-h3">Wednesday</h3>
				<p class="week-description">Central Park, noon-3 pm.</p>
				<h3 class="week-schedule-h3">Thursday</h3>
				<p class="week-description">Hyder Park, noon-3 pm.</p>
				<h3 class="week-schedule-h3">Friday</h3>
				<p class="week-description">Balloon Fiesta Park, noon-9 pm.</p>
				<h3 class="week-schedule-h3">Saturday</h3>
				<p class="week-description">Balloon Fiesta Park, noon-9 pm</p>
				<h3 class="week-schedule-h3">Sunday</h3>
				<p class="week-description">(closed)</p>
			</div>
		</div>

		<!-------menu box    ------->
		<div class="container menu-box">
			<div class="row text-center">
				<h3>Menu</h3>
				<hr class="menu-hr">
				{{companyData.companyMenuText}}

			</div>
		</div>
	 <!----fluid container------>
</div>
