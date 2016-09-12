<!DOCTYPE html>
<html>
	<head>
		<title>Eater Map View</title>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
		<meta charset="utf-8">
		<style>
			html, body {
				height: 100%;
				margin: 0;
				padding: 0;
			}
			#map {
				height: 100%;
			}
		</style>
	</head>

	<body>
		<div id="map"></div>
		<script>
			function initMap() {
				var map = new google.maps.Map(document.getElementById('map'), {
					center: {lat: 35.0853, lng: -106.6056},
					zoom: 14
				});

				var truckPosition = {lat: 35.0800, lng: -106.6150};
				var marker = new google.maps.Marker({
					position: truckPosition,
					map: map
				});
				var infowindow = new google.maps.InfoWindow({
					content: "Taco Truck"
				});
				marker.addListener('click', function() {
					infowindow.open(map, marker);
				});

				var infoWindow = new google.maps.InfoWindow({map: map});

				if (navigator.geolocation) {
					navigator.geolocation.getCurrentPosition(function(position) {
						var userPosition = {
							lat: position.coords.latitude,
							lng: position.coords.longitude
						};
						infoWindow.setPosition(userPosition);
						infoWindow.setContent('You are here');
						map.setCenter(userPosition);
					}, function() {
						handleLocationError(true, infoWindow, map.getCenter());
					});
				} else {
					// Browser doesn't support Geolocation
					handleLocationError(false, infoWindow, map.getCenter());
				}
			}
			function handleLocationError(browserHasGeolocation, infoWindow, pos) {
				infoWindow.setPosition(pos);
				infoWindow.setContent(browserHasGeolocation ?
					'Error: The Geolocation service failed.' :
					'Error: Your browser does not support geolocation.');
			}

		</script>

		<script async defer
				src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDwGxzLKd5waiJFHo5nsZqZl3xJN64JxIc&callback=initMap">
		</script>

	</body>
</html>

<!DOCTYPE html>
<!--<html ng-app="Crumbtrail">-->
<!--	<head>-->
<!--		<!--  Is this different, for the Angular google maps? -->-->
<!--		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDwGxzLKd5waiJFHo5nsZqZl3xJN64JxIc&callback=initMap"></script>-->
<!---->
<!--		<!-- Need the paths, below: -->-->
<!--		<script src='/path/to/lodash[.min].js'></script>-->
<!--		<script src='/path/to/angular[.min].js'></script>-->
<!--		<script src='/path/to/angular-simple-logger/angular-simple-logger[.min].js'></script>-->
<!--		<script src='/path/to/angular-google-maps[.min].js'></script>-->
<!--	</head>-->
<!--	<body>-->
<!--		<div id="map_canvas" ng-controller="MapController">-->
<!---->
<!--			<!-- The center of the map = hungry eater's current location. -->-->
<!--			<!-- Does 'map.center' get this from map-controller.js? -->-->
<!--			<ui-gmap-google-map center='map.center' zoom='map.zoom'></ui-gmap-google-map>-->
<!---->
<!--			<!-- "marker.id" = eventId, for each specific event. -->-->
<!--			<!-- So I'll need an ng-repeat for the ui-gmap-marker thing? -->-->
<!--			<ui-gmap-marker coords="marker.coords" idkey="marker.id"></ui-gmap-marker>-->
<!--		</div>-->
<!--	</body>-->
<!--</html-->
