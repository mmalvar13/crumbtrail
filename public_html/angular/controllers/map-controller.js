app.controller('MapController', ["$scope", "CompanyService", "EventService", "ProfileService", "TruckService", "uiGmapGoogleMapApi",
	function($scope, CompanyService, EventService, ProfileService, uiGmapGoogleMapApi) {
	//what do we add here on top?
	$scope.alerts = [];

/*
	Order of events, for the eater map:
		1. Find the user's current location.
		2. Display the map, with the center = the user's current location.
		3. Show the locations of active food trucks as markers.
*/
	$scope.markers = [];		// These mark the locations of the active trucks.
									// But markers is also shown below.

	// need a $scope here ?????
	navigator.geolocation.getCurrentPosition(function(position) {
		$scope.map = {
			center: {
				latitude: position.coords.latitude,
				longitude: position.coords.longitude
			},
			zoom: 8,
			markers: [],	// Each marker is the location of an active food truck.

			window: {
				marker: {},
				show: true
			}
		}
	});

	// Google Geolocation API, obtains user's location with a single call to:
	//     getCurrentPosition()

		// The geolocation API offers a simple ‘one-shot’ method to obtain the user’s location getCurrentPosition(). A call to this method will asynchronously report on the user’s current location.

/*
		 window.onload = function() {
			var startPos;
		 	var geoSuccess = function(position) {
		 		startPos = position;
		 		document.getElementById('startLat').innerHTML = startPos.coords.latitude;
		 		document.getElementById('startLon').innerHTML = startPos.coords.longitude;
		 	};
		 	navigator.geolocation.getCurrentPosition(geoSuccess);
		 };
*/


/*
		navigator.geolocation.getCurrentPosition(function(position) {
			do_something(position.coords.latitude, position.coords.longitude);
		});
		The above example will cause the do_something() function to execute when the location is obtained.
*/

	// See eater-map-view.php; it needs something like this?
	// map.center = navigator.geolocation.getCurrentPosition();




		// uiGmapGoogleMapApi is a promise.
		// The "then" callback function provides the google.maps object.
		// uiGmapGoogleMapApi.then(function(maps) { ...





	/*-------------------------CompanyService methods--------------------------------*/
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
		TruckService.fetchTruckByTruckId(truckId)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.mapData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};

				}
			})
	};

	$scope.getTruckByTruckCompanyId = function(truckCompanyId) {
		TruckService.fetchTruckByTruckCompanyId(truckCompanyId)
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
		ProfileService.fetchProfileByProfileId(profileId)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.mapData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};

				}
			})
	};


//how do we do puts/posts/deletes for multiple services. what variable do we use for function(map, validated). is map ok??
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
			EventService.update(map)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.alerts[0] = {type: "success", msg: result.data.message};
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});

			ProfileService.update(map)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.alerts[0] = {type: "success", msg: result.data.message};
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});

			TruckService.update(map)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.alerts[0] = {type: "success", msg: result.data.message};
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});

			CompanyService.update(map)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.alerts[0] = {type: "success", msg: result.data.message};
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});
		}
	};


//first parameter map??
	$scope.delete = function(map, validated) {
		if(validated === true) {
			TruckService.delete(map)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.alerts[0] = {type: "success", msg: result.data.message};
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});

			CompanyService.delete(map)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.alerts[0] = {type: "success", msg: result.data.message};
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});



		}
	};


}]);

