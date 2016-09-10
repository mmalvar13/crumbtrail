<!DOCTYPE html>

<html ng-app="Crumbtrail">
	<head>
		<!--  TODO Is this different, for the Angular google maps? -->
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDwGxzLKd5waiJFHo5nsZqZl3xJN64JxIc&callback=initMap"></script>

		<!-- TODO Need the paths, below: -->
		<script src='/path/to/lodash[.min].js'></script>
		<script src='/path/to/angular[.min].js'></script>
		<script src='/path/to/angular-simple-logger/angular-simple-logger[.min].js'></script>
		<script src='/path/to/angular-google-maps[.min].js'></script>
	</head>

	<body>
		<div id="map_canvas" ng-controller="map-controller">

			<!-- TODO We want the center of the map to be the hungry eater's current location. -->
			<!-- Does 'map.center' get this from map-controller.js? -->
			<ui-gmap-google-map center='map.center' zoom='map.zoom'></ui-gmap-google-map>

			<!-- TODO I think "marker.id" = eventId, for each specific event. -->
			<!-- So I'll need an ng-repeat for the ui-gmap-marker thing? -->
			<ui-gmap-marker coords="marker.coords" idkey="marker.id"></ui-gmap-marker>

		</div>

	</body>
</html
