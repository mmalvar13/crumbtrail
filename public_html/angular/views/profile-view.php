

		<!-- Main body-->
		<div class="container-fluid">
			<!--			title row-->
			<div class="row">
				<h1 class="company-name">{{ companyData.companyName }}</h1>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-xs-1">
						<div class="serving-icon"></div>
					</div>
					<div class="col-xs-4 "><h5>Serving Now!</h5></div>
					<button type="button" class="btn btn-warning pull-right locate-btn">Locate</button>
				</div>
			</div>
			<!-------------company image-------------------->
			<div class="container">
				<div class="row">
					<img src="https://arlingtonva.s3.amazonaws.com/wp-content/uploads/sites/25/2013/12/foodtruck.jpeg"
						  class="img-responsive img-thumbnail profile-image">
				</div>
			</div>

			<!--------------company description-------------->
			<div class="container description-box">
				<div class="row text-center">
					{{companyData.companyDescription}}
					<hr>

					<!---------days of the week "loose" schedule------------>
					<h3 class="week-schedule-h3 display-4">Monday</h3>
					<div><p class="week-description">Extraordinary claims require extraordinary evidence! Finite but
							unbounded. Birth, explorations take root and flourish Vangelis at the edge of forever made in the
							interiors of collapsing stars a mote of dust suspended in a sunbeam with pretty stories for which
							there's little good evidence. Circumnavigated Hypatia finite but unbounded circumnavigated. Bits of
							moving fluff, ship of the imagination rich in heavy atoms take root and flourish, Hypatia tingling
							of the spine. A very small stage in a vast cosmic arena.</p></div>
					<h3 class="week-schedule-h3">Tuesday</h3>
					<p class="week-description">Extraordinary claims require extraordinary evidence! Finite but unbounded.
						Birth, explorations take root and flourish Vangelis at the edge of forever made in the interiors of
						collapsing stars a mote of dust suspended in a sunbeam with pretty stories for which there's little
						good evidence. Circumnavigated Hypatia finite but unbounded circumnavigated. Bits of moving fluff,
						ship of the imagination rich in heavy atoms take root and flourish, Hypatia tingling of the spine. A
						very small stage in a vast cosmic arena.</p>
					<h3 class="week-schedule-h3">Wednesday</h3>
					<p class="week-description">Extraordinary claims require extraordinary evidence! Finite but unbounded.
						Birth, explorations take root and flourish Vangelis at the edge of forever made in the interiors of
						collapsing stars a mote of dust suspended in a sunbeam with pretty stories for which there's little
						good evidence. Circumnavigated Hypatia finite but unbounded circumnavigated. Bits of moving fluff,
						ship of the imagination rich in heavy atoms take root and flourish, Hypatia tingling of the spine. A
						very small stage in a vast cosmic arena.</p>
					<h3 class="week-schedule-h3">Thursday</h3>
					<p class="week-description">Extraordinary claims require extraordinary evidence! Finite but unbounded.
						Birth, explorations take root and flourish Vangelis at the edge of forever made in the interiors of
						collapsing stars a mote of dust suspended in a sunbeam with pretty stories for which there's little
						good evidence. Circumnavigated Hypatia finite but unbounded circumnavigated. Bits of moving fluff,
						ship of the imagination rich in heavy atoms take root and flourish, Hypatia tingling of the spine. A
						very small stage in a vast cosmic arena.</p>
					<h3 class="week-schedule-h3">Friday</h3>
					<p class="week-description">Extraordinary claims require extraordinary evidence! Finite but unbounded.
						Birth, explorations take root and flourish Vangelis at the edge of forever made in the interiors of
						collapsing stars a mote of dust suspended in a sunbeam with pretty stories for which there's little
						good evidence. Circumnavigated Hypatia finite but unbounded circumnavigated. Bits of moving fluff,
						ship of the imagination rich in heavy atoms take root and flourish, Hypatia tingling of the spine. A
						very small stage in a vast cosmic arena.</p>
					<h3 class="week-schedule-h3">Saturday</h3>
					<p class="week-description">Extraordinary claims require extraordinary evidence! Finite but unbounded.
						Birth, explorations take root and flourish Vangelis at the edge of forever made in the interiors of
						collapsing stars a mote of dust suspended in a sunbeam with pretty stories for which there's little
						good evidence. Circumnavigated Hypatia finite but unbounded circumnavigated. Bits of moving fluff,
						ship of the imagination rich in heavy atoms take root and flourish, Hypatia tingling of the spine. A
						very small stage in a vast cosmic arena.</p>
					<h3 class="week-schedule-h3">Sunday</h3>
					<p class="week-description">Extraordinary claims require extraordinary evidence! Finite but unbounded.
						Birth, explorations take root and flourish Vangelis at the edge of forever made in the interiors of
						collapsing stars a mote of dust suspended in a sunbeam with pretty stories for which there's little
						good evidence. Circumnavigated Hypatia finite but unbounded circumnavigated. Bits of moving fluff,
						ship of the imagination rich in heavy atoms take root and flourish, Hypatia tingling of the spine. A
						very small stage in a vast cosmic arena.</p>
				</div>
			</div>

			<!-------menu box ------->
			<div class="container menu-box">
				<div class="row text-center">
					<h3>Menu</h3>
					<hr class="menu-hr">
					{{companyData.companyMenuText}}

				</div>
			</div>
		</div> <!----fluid container------>

