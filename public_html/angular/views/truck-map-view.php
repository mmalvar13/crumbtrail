







			<!--------------------------------MAIN BODY------------------------------------>
			<div class="container">

				<!---------------START SERVING------------------------------------->
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<button type="button" class="btn btn-lg btn-block truck-map-start-serving-btn"
								  data-toggle="modal" data-target="#startServing" ng-click="showStartServing()">START SERVING
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
										  aria-label="Close" ng-click="close()" data-dismiss="modal" aria-hidden="true">
									<span aria-hidden="true">&times;</span></button>

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
									<input class="form-control" type="time" value="13:45:00" id="time-input"  ng-model="endTime">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-xs-4 text-center">
									<h4>Select a truck:</h4>
								</div>
								<div class="col-xs-6">
									<select class="form-control" ng-model="selectedTruck">
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
								<div class="col-xs-7 text-center truck-map-location"></div> <!-- need to add this in from maps? -->
							</div>
							<div class="row text-center">

								<button type="button" class="btn btn-warning btn-lg truck-map-submit-btn" ng-click="close()" data-dismiss="modal">Submit</button>
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
