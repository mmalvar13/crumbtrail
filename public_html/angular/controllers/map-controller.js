app.controller('MapController', ["$scope", "CompanyService", "EventService", "ProfileService", "TruckService", "GeoLocationService",
	// "uiGmapGoogleMapApi",
	function($scope, CompanyService, EventService, ProfileService, TruckService, GeoLocationService) {
		//what do we add here on top?
		$scope.serving = null;
		$scope.editing = false;
		$scope.trucks = [];
		$scope.selectedTruckId = null;
		$scope.activeEvents = [];
		$scope.events = [];
		$scope.currentEvent = {};
		$scope.markers = {};



		// $scope.map = {
		// 	center: {
		// 		latitude: 0,
		// 		longitude: 0
		// 	},
		// 	zoom: 14
		// };

		// $scope.marker = {
		// 	id: 0, // This should be set to the event id
		// 	coords: {
		// 		latitude: 0,
		// 		longitude: 0
		// 	}
		// };

		$scope.geoLocation = null;
		$scope.alerts = [];
		$scope.eaterMarkerId = {
			id: 0 // this is a required filed for the eater marker
		};

		$scope.center = {
			lat: 51.505,
			lng: -0.09,
			zoom: 8
		};

		// //*************added this for mapbox testing 11.12 MA************************//
		// angular.module('Crumbtrail').controller('rootController', [
		// 	'$scope',
		// 	function ($scope) {
		// 		$scope.callback = function (map) {
		// 			map.setView([51.433333, 5.483333], 12);
		// 		};
		// 	}
		// ]);

		$scope.MarkersSimpleController = function(){
			var mainMarker = {
				lat: 51,
				lng: 0,
				focus: true,
				draggable: true
			};


		}
		// // ************************end mapbox testing*************************************************//

		$scope.getGeoLocation = function() {
			GeoLocationService.getCurrentPosition()
				.then(function(result) {
					$scope.geoLocation = result;
					// var latLong = {"lat": result.coords.latitude, "lng": result.coords.longitude};
					$scope.center = {"lat": result.coords.latitude, "lng": result.coords.longitude, "zoom":14};
					// $scope.marker.coords = latLong;
					if(angular.equals({}, $scope.currentEvent)) {
						// $scope.updateMap($scope.selectedTruckId);
						//Senator Arlo ordered this mockup
						$scope.loadMarkers();
					}
				});
		};

		$scope.setLocationToCurrent = function(selectedTruckId) {
			$scope.currentEvent.eventLocation = {
				"lat": $scope.center.lat,
				"lng": $scope.center.lng
			};
			$scope.currentEvent.eventStart = new Date();
			$scope.currentEvent.eventEnd = new Date();
			$scope.currentEvent.eventTruckId = selectedTruckId;
			$scope.currentEvent.eventId = 0;
		};

		//will be called when we hit submit on the form
		$scope.editEvent = function() {
			$scope.editing = false;
			$scope.currentEvent.eventEnd = $scope.currentEvent.eventEnd.getTime();
			console.log($scope.currentEvent);
			if($scope.currentEvent.eventId === 0) {
				EventService.createEvent($scope.currentEvent);
			} else {
				EventService.updateEvent($scope.currentEvent.eventId, $scope.currentEvent);
			}
		};

		$scope.updateMap = function(selectedTruckId) {
			$scope.getActiveEvents();
			if(selectedTruckId !== null) {
				var found = false;
				for(var activeEvent in $scope.activeEvents) {
					if($scope.activeEvents[activeEvent].eventTruckId === Number(selectedTruckId)) {
						var event = $scope.activeEvents[activeEvent];
						event.eventEnd = new Date(event.eventEnd);
						$scope.currentEvent = event;
						found = true;
					}
				}
				if(!found) {
					$scope.setLocationToCurrent(selectedTruckId);
				}
			} else {
				$scope.setLocationToCurrent(selectedTruckId);
			}
		};

		/*-------------------------CompanyService methods--------------------------------*/
		$scope.getCompanyByCompanyId = function(companyId) {
			CompanyService.fetchCompanyById(companyId)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.mapData = result.data.data;
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				})
		};

		$scope.getCompanyByCompanyName = function(companyName) {
			CompanyService.fetchCompanyByCompanyName(companyName)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.mapData = result.data.data;
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};

					}
				})
		};

		$scope.getCompanyByCompanyMenuText = function(companyMenuText) {
			CompanyService.fetchCompanyByCompanyMenuText(companyMenuText)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.mapData = result.data.data;
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};

					}
				})
		};

		$scope.getCompanyByCompanyDescription = function(companyDescription) {
			CompanyService.fetchCompanyByCompanyDescription(companyDescription)
				.then(function(result) {
					if(result.data.status === 200) {
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
					if(result.data.status === 200) {
						$scope.events = result.data.data;
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};

					}
				})
		};


		$scope.getEventByEventEndAndEventStart = function(eventEnd, eventStart) {
			EventService.fetchEventByEventEndAndEventStart(eventEnd, eventStart)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.events = result.data.data;
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};

					}
				})
		};

		$scope.getEventByEventTruckId = function(eventTruckId) {
			EventService.fetchEventByEventTruckId(eventTruckId)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.events = result.data.data;
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};

					}
				})
		};


		$scope.getEventByEventIdAndEventTruckId = function(eventId, eventTruckId) {
			EventService.fetchEventByEventIdAndEventTruckId(eventId, eventTruckId)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.events = result.data.data;
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};

					}
				})
		};

		$scope.getActiveEvents = function() {
			EventService.all()
				.then(function(result) {
					if(result.status === 200) {
						var event = result.data.data;
						event.eventEnd = new Date(event.eventEnd);
						$scope.activeEvents = event;
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};

					}
			});
		};


		/*-----------------------------TruckService Methods-----------------------------------------*/
		$scope.getTruckByTruckId = function(truckId) {
			TruckService.fetchTruckByTruckId(truckId)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.trucks = result.data.data;
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};

					}
				})
		};

		$scope.getTruckByTruckCompanyId = function(truckCompanyId) {
			TruckService.fetchTruckByTruckCompanyId(truckCompanyId)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.trucks = result.data.data;
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};

					}
				})
		};

		$scope.getTrucksByProfileId = function() {
			TruckService.fetchTruckByProfileId()
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.trucks = result.data.data;
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};

					}
				});
		};


		/*------------------------------------ProfileService Methods--------------------------------------*/

		$scope.getProfileByProfileId = function(profileId) {
			ProfileService.fetchProfileByProfileId(profileId)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.mapData = result.data.data;
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};

					}
				})
		};


		/*---------------------A new method we are adding at Senator Arlos behest!! 12/2--------------------*/
		//might have to take in an argument here
		$scope.loadMarkers = function(){
			$scope.markers = {"unm":{"lat":35.0875849, "lng":-106.637924}, "sally":{"lat":35.1076816,"lng":-106.6446577}};
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

		if($scope.geoLocation === null) {
			$scope.getGeoLocation();
		}

		if($scope.trucks.length === 0) {
			$scope.getTrucksByProfileId();
		}

		if($scope.activeEvents.length === 0) {
			$scope.getActiveEvents();
		}

	}]);

