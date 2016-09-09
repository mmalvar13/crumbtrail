app.controller('MapController', ["$scope", "CompanyService", "EventService", "ProfileService", "TruckService", function($scope, CompanyService, EventService, ProfileService) {
	//what do we add here on top?
	$scope.alerts = [];
	$scope.mapData = [];

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

	/*----------------eventService methods------------------------*/

	$scope.getEventByEventId = function(eventId){
		EventService.fetchEventByEventId(eventId)
	}



//how do we do puts/posts/deletes for multiple services
	$scope.mapCreate = function(map, validated) {
		if(validated === true) {
			CompanyService.create(company)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.alerts[0] = {type: "success", msg: result.data.message};
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				})

			EventService.create(event)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.alerts[0] = {type: "success", msg: result.data.message};
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				})


		}
	};


}]);