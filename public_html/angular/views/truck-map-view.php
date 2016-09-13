<!--------------------------------MAIN BODY------------------------------------>
<div class="container">

	<!---------------START SERVING------------------------------------->
	<div class="row" ng-hide="editing">
		<div class="col-md-8 col-md-offset-2">
			<button type="button" class="btn btn-lg btn-block truck-map-start-serving-btn" ng-click="editing = true">EDIT
				EVENTS
			</button>
		</div>
	</div>

	<div class="row" ng-if="editing">
		<div class="col-md-8 col-md-offset-2">
			<h1>Start Serving</h1>
			<form ng-submit="editEvent();">
				<div class="form-group">
					<label for="endTime">End Time</label>
					<input type="time" class="form-control" id="endTime" name="endTime" value="13:45:00" ng-model="endTime">
				</div>
				<div class="checkbox">
					<label for="truck">Select which truck you're serving from</label>
					<select class="form-control" id="selectedTruckId" name="selectedTruckId" ng-model="selectedTruckId" ng-change="updateMap(selectedTruckId);">
						<option ng-repeat="truck in trucks" value="{{truck.truckId}}">Truck #: {{truck.truckId}}</option>

					</select>
				</div>
				<h4>Current Location:</h4>
				<ui-gmap-google-map center="{'latitude': currentEvent.eventLocation.lat, 'longitude': currentEvent.eventLocation.long}" zoom="map.zoom">
					<ui-gmap-marker coords="{'latitude': currentEvent.eventLocation.lat, 'longitude': currentEvent.eventLocation.long}" idkey="currentEvent.eventId">
						 <!--to show the current truck's event, or none if there is no event-->
					</ui-gmap-marker>
				</ui-gmap-google-map>
				<br>
				<button type="submit" class="btn btn-default">Submit</button>
			</form>
		</div>
	</div>

	<ui-gmap-google-map ng-hide="editing" center='map.center' zoom='map.zoom'>
		<ui-gmap-marker ng-repeat="event in activeEvents" coords="{'latitude': event.eventLocation.lat, 'longitude': event.eventLocation.long}" idkey="event.eventId">
		</ui-gmap-marker>
	</ui-gmap-google-map>

</div>
</div>
<!---------------COMMENT OUT-------------->
