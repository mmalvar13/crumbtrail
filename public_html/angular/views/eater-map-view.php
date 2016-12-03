<!--<ui-gmap-google-map center='map.center' zoom='map.zoom'>-->
<!--	<ui-gmap-marker coords="map.center"idkey="eaterMarkerId.id"></ui-gmap-marker>-->
<!--</ui-gmap-google-map>-->


<!--<ui-gmap-google-map ng-hide="editing" center='map.center' zoom='map.zoom'>-->
<!--	<ui-gmap-marker coords="map.center"idkey="eaterMarkerId.id"></ui-gmap-marker>-->
<!--	<ui-gmap-marker ng-repeat="event in activeEvents" coords="{'latitude': event.eventLocation.lat, 'longitude': event.eventLocation.long}" idkey="event.eventId">-->
<!--	</ui-gmap-marker>-->
<!--</ui-gmap-google-map>-->

<!--initialize map on page-->

<div id='map' style='width: 400px; height: 300px;'></div>
<!--<leaflet></leaflet>-->
<script>
	mapboxgl.accessToken = 'pk.eyJ1IjoibW1hbHZhcjEzIiwiYSI6ImNpdmcyMHZmZDAwenQydG82NzBxYzBodzgifQ.KGW_RTkVCfjPpzsHppDkQA';
	var map = new mapboxgl.Map({
		container: 'map',
		style: 'mapbox://styles/mapbox/streets-v9'
	});
</script>

