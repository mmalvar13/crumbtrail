<!DOCTYPE html>
<html>
	<head>
		<title>Geolocation</title>
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

				var truckLatLng = {lat: 35.0800, lng: -106.6000};
				var marker = new google.maps.Marker({
					position: truckLatLng,
					map: map,
					title: 'Taco Truck'
				});

				var infoWindow = new google.maps.InfoWindow({map: map});

				if (navigator.geolocation) {
					navigator.geolocation.getCurrentPosition(function(position) {
						var pos = {
							lat: position.coords.latitude,
							lng: position.coords.longitude
						};
						infoWindow.setPosition(pos);
						infoWindow.setContent('You are here');
						map.setCenter(pos);
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