app.controller('EventController', ["$scope", "$location", "EventService", function($scope, $location, EventService) {
	$scope.eventId = null;
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
				})

	};




}
])