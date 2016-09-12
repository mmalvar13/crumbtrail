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
