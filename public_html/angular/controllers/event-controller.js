app.controller('EventController', ["$scope", "$location", "EventService", function($scope, $location, EventService) {
	// what do i do here????? BrewCew has a beer Profile....we have a truck map or eater map//
	$scope.alerts = [];
	$scope.eventData = [];

	$scope.search = function(searchTerm) {
		$scope.eventData = [];
		$scope.getEventByTruckId(searchTerm);
		$scope.getEventByStart(searchTerm);
		$scope.getEventByEnd(searchTerm);
		console.log($scope.eventData);
	};

	$scope.getEventById = function(eventId) {
		EventService.getEventById(eventId)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.eventData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}

			})

	};
	$scope.getEventByTruckId = function(eventTruckId) {
		EventService.getEventByTruckId(eventTruckId)
		// Is the . then where the promise lives.....promise is accepted, or rejected
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.eventData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})

	};
	$scope.getEventByStart= function(eventStart) {
		EventService.getEventByStart(eventStart)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.eventData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})

	};
	$scope.getEventByEnd= function(eventEnd) {
		EventService.getEventByEnd(eventEnd)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.eventData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			});
		/**
		 * when this is related to truck Map view??
		 * when event is selected...it goes to the event on the truck map??
		 */

		$scope.getTruckMap = function(eventId) {
			$location.path("truckMap/" + eventId);
		};

	};




}
])