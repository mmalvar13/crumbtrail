app.controller('MapController', ["$scope", "CompanyService", "EventService", "ProfileService", "TruckService", "GeoLocationService", "uiGmapGoogleMapApi",
	function($scope, CompanyService, EventService, ProfileService, TruckService, GeoLocationService, uiGmapGoogleMapApi) {
		//what do we add here on top?
		$scope.serving = null;
		$scope.editing = false;
		$scope.trucks = [];
		$scope.selectedTruckId = null;
		$scope.activeEvents = [];
		$scope.events = [];
		$scope.currentEvent = {};


		$scope.map = {
			center: {
				latitude: 0,
				longitude: 0
			},
			zoom: 14
		};

		$scope.marker = {
			id: 0, // This should be set to the event id
			coords: {
				latitude: 0,
				longitude: 0
			}
		};

		$scope.geoLocation = null;
		$scope.alerts = [];
		$scope.eaterMarkerId = {
			id: 0 // this is a required filed for the eater marker
		};

		$scope.getGeoLocation = function() {
			GeoLocationService.getCurrentPosition()
				.then(function(result) {
					$scope.geoLocation = result;
					var latLong = {"latitude": result.coords.latitude, "longitude": result.coords.longitude};
					$scope.map.center = latLong;
					$scope.marker.coords = latLong;
					if(angular.equals({}, $scope.currentEvent)) {
						$scope.updateMap($scope.selectedTruckId);
					}
				});
		};

		$scope.setLocationToCurrent = function(selectedTruckId) {
			$scope.currentEvent.eventLocation = {
				"lat": $scope.map.center.latitude,
				"long": $scope.map.center.longitude
			};
			$scope.currentEvent.eventStart = Date.now();
			$scope.currentEvent.eventTruckId = selectedTruckId;
			$scope.currentEvent.eventId = 0;
		};

		//will be called when we hit submit on the form
		$scope.editEvent = function() {
			$scope.editing = false;
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
						$scope.currentEvent = $scope.activeEvents[activeEvent];
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
						$scope.activeEvents = result.data.data;
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

