// Company Profile Controller -> company profile view.
// Uses:
//    Company service
//    Event service
//    Image service
//    Profile service

app.controller('ProfileController', ["$scope", "CompanyService", "EventService", "ImageService", "ProfileService",
	function($scope, CompanyService, EventService, ImageService, ProfileService) {

	$scope.alerts = [];

	/*------------------------- CompanyService methods --------------------------------------------------------*/
	$scope.getCompanyByCompanyId = function(companyId) {
		CompanyService.fetchCompanyById(companyId)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.mapData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};

	$scope.getCompanyByCompanyName = function(companyName) {
		CompanyService.fetchCompanyByCompanyName(companyName)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.mapData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};

	$scope.getCompanyByCompanyMenuText = function(companyMenuText) {
		CompanyService.fetchCompanyByCompanyMenuText(companyMenuText)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.mapData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};

	$scope.getCompanyByCompanyDescription = function(companyDescription) {
		CompanyService.fetchCompanyByCompanyDescription(companyDescription)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.mapData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};

	/*---------------- EventService methods ------------------------*/
	$scope.getEventByEventId = function(eventId) {
		EventService.fetchEventByEventId(eventId)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.mapData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};

	$scope.getEventByEventEndAndEventStart = function(eventEnd, eventStart) {
		EventService.fetchEventByEventEndAndEventStart(eventEnd, eventStart)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.mapData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};

	$scope.getEventByEventTruckId = function(eventTruckId) {
		EventService.fetchEventByEventTruckId(eventTruckId)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.mapData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};

	$scope.getEventByEventIdAndEventTruckId = function(eventId, eventTruckId) {
		EventService.fetchEventByEventIdAndEventTruckId(eventTruckId)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.mapData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};

	/*------------------------------------ ImageService Methods --------------------------------------*/




	/*------------------------------------ ProfileService Methods --------------------------------------*/
	$scope.getProfileByProfileId = function(profileId) {
		EventService.fetchProfileByProfileId(profileId)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.mapData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};





	/*------------------------------------ CRUD .... !!!  --------------------------------------*/












}]);