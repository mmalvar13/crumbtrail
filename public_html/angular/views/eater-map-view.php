<!--<ui-gmap-google-map center='map.center' zoom='map.zoom'>-->
<!--	<ui-gmap-marker coords="map.center"idkey="eaterMarkerId.id"></ui-gmap-marker>-->
<!--</ui-gmap-google-map>-->


<ui-gmap-google-map ng-hide="editing" center='map.center' zoom='map.zoom'>
	<ui-gmap-marker coords="map.center"idkey="eaterMarkerId.id"></ui-gmap-marker>
	<ui-gmap-marker ng-repeat="event in activeEvents" coords="{'latitude': event.eventLocation.lat, 'longitude': event.eventLocation.long}" idkey="event.eventId">
	</ui-gmap-marker>
</ui-gmap-google-map>

