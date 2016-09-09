app.controller('MapController', ["$scope", "CompanyService", "EventService", "ProfileService", "TruckService", function($scope, CompanyService, EventService, ProfileService) {
	//what do we add here on top?
	$scope.alerts = [];
	$scope.mapData = [];


	/*-------------------------CompanyService methods--------------------------------------------------------*/
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



	/*-----------------------------TruckService Methods-----------------------------------------*/
	$scope.getTruckByTruckId = function(truckId) {
		EventService.fetchTruckByTruckId(truckId)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.mapData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};

				}
			})
	};

	$scope.getTruckByTruckCompanyId = function(truckCompanyId) {
		EventService.fetchTruckByTruckCompanyId(truckCompanyId)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.mapData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};

				}
			})
	};


	/*------------------------------------ProfileService Methods--------------------------------------*/

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


//how do we do puts/posts/deletes for multiple services
	$scope.mapCreate = function(map, validated) {
		if(validated === true) {
			EventService.create(event)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.alerts[0] = {type: "success", msg: result.data.message};
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});
			TruckService.create(truck)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.alerts[0] = {type: "success", msg: result.data.message};
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});
		}
	};



	$scope.mapUpdate = function(map, validated) {
		if(validated === true) {
			EventService.update(event)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.alerts[0] = {type: "success", msg: result.data.message};
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});

			ProfileService.update(profile)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.alerts[0] = {type: "success", msg: result.data.message};
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});

			TruckService.update(truck)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.alerts[0] = {type: "success", msg: result.data.message};
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});

			CompanyService.update(company)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.alerts[0] = {type: "success", msg: result.data.message};
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});
		}
	};



	$scope.delete = function(beer, validated) {
		if(validated === true) {
			BeerService.destroy(beer)
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