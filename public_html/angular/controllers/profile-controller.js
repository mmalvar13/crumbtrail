// Company Profile Controller -> company profile view.
// Uses:
//    Company service
//    Event service
//    Image service
//    Profile service

app.controller('ProfileController', ["$scope", "CompanyService", "EventService", "ImageService", "ProfileService",
	function($scope, CompanyService, EventService, ImageService, ProfileService) {

		$scope.alerts = [];

		/* ---------------------- Read stuff: getFooByBars -------------------------------------------------------- */
		/* ------------------------- CompanyService methods ------------------------------------------------------ */
		$scope.getCompanyByCompanyId = function(companyId) {
			CompanyService.fetchCompanyById(companyId)
				.then(function(result) {
					if(result.status.data === 200) {
						$scope.profileData = result.data.data;
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				})
		};

		$scope.getCompanyByCompanyName = function(companyName) {
			CompanyService.fetchCompanyByCompanyName(companyName)
				.then(function(result) {
					if(result.status.data === 200) {
						$scope.profileData = result.data.data;
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				})
		};

		$scope.getCompanyByCompanyMenuText = function(companyMenuText) {
			CompanyService.fetchCompanyByCompanyMenuText(companyMenuText)
				.then(function(result) {
					if(result.status.data === 200) {
						$scope.profileData = result.data.data;
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				})
		};

		$scope.getCompanyByCompanyDescription = function(companyDescription) {
			CompanyService.fetchCompanyByCompanyDescription(companyDescription)
				.then(function(result) {
					if(result.status.data === 200) {
						$scope.profileData = result.data.data;
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				})
		};

		/*-------------------- EventService methods ----------------------------*/
		$scope.getEventByEventId = function(eventId) {
			EventService.fetchEventByEventId(eventId)
				.then(function(result) {
					if(result.status.data === 200) {
						$scope.profileData = result.data.data;
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				})
		};

		$scope.getEventByEventEndAndEventStart = function(eventEnd, eventStart) {
			EventService.fetchEventByEventEndAndEventStart(eventEnd, eventStart)
				.then(function(result) {
					if(result.status.data === 200) {
						$scope.profileData = result.data.data;
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				})
		};

		$scope.getEventByEventTruckId = function(eventTruckId) {
			EventService.fetchEventByEventTruckId(eventTruckId)
				.then(function(result) {
					if(result.status.data === 200) {
						$scope.profileData = result.data.data;
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				})
		};

		$scope.getEventByEventIdAndEventTruckId = function(eventId, eventTruckId) {
			EventService.fetchEventByEventIdAndEventTruckId(eventTruckId)
				.then(function(result) {
					if(result.status.data === 200) {
						$scope.profileData = result.data.data;
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				})
		};

		/*--------------------------- ImageService Methods --------------------------------------*/
		$scope.getImageByImageId = function(imageId) {
			ImageService.fetchImageByImageId(imageId)
				.then(function(result) {
					if(result.status.data === 200) {
						$scope.profileData = result.data.data;
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				})
		};

		$scope.getImageByImageCompanyId = function(imageCompanyId) {
			ImageService.fetchImageByImageCompanyId(imageCompanyId)
				.then(function(result) {
					if(result.status.data === 200) {
						$scope.profileData = result.data.data;
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				})
		};

		$scope.getImageByImageFileName = function(imageFileName) {
			ImageService.fetchImageByImageFileName(imageFileName)
				.then(function(result) {
					if(result.status.data === 200) {
						$scope.profileData = result.data.data;
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				})
		};

		/*-------------------------- ProfileService Methods --------------------------------------*/
		$scope.getProfileByProfileId = function(profileId) {
			EventService.fetchProfileByProfileId(profileId)
				.then(function(result) {
					if(result.status.data === 200) {
						$scope.profileData = result.data.data;
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				})
		};

		/* ---------------------- Create, Update, Delete stuff ------------------------------------- */
		/* --------------------------- Create ------------------------------------------------------ */
		$scope.profileCreate = function(profile, validated) {
			if(validated === true) {
				CompanyService.create(company)			// TODO  Or should this be (profile) ???
					.then(function(result) {
						if(result.data.status === 200) {
							$scope.alerts[0] = {type: "success", msg: result.data.message};
						} else {
							$scope.alerts[0] = {type: "danger", msg: result.data.message};
						}
					});
				EventService.create(event)
					.then(function(result) {
						if(result.data.status === 200) {
							$scope.alerts[0] = {type: "success", msg: result.data.message};
						} else {
							$scope.alerts[0] = {type: "danger", msg: result.data.message};
						}
					});
				ImageService.create(image)
					.then(function(result) {
						if(result.data.status === 200) {
							$scope.alerts[0] = {type: "success", msg: result.data.message};
						} else {
							$scope.alerts[0] = {type: "danger", msg: result.data.message};
						}
					});
				ProfileService.create(profile)
					.then(function(result) {
						if(result.data.status === 200) {
							$scope.alerts[0] = {type: "success", msg: result.data.message};
						} else {
							$scope.alerts[0] = {type: "danger", msg: result.data.message};
						}
					});
			}
		};

		/* --------------------------- Update ------------------------------------------------- */
		$scope.profileUpdate = function(profile, validated) {
			if(validated === true) {
				CompanyService.update(profile)			// TODO  Or should this be (company) ???
					.then(function(result) {
						if(result.data.status === 200) {
							$scope.alerts[0] = {type: "success", msg: result.data.message};
						} else {
							$scope.alerts[0] = {type: "danger", msg: result.data.message};
						}
					});
				EventService.update(profile)
					.then(function(result) {
						if(result.data.status === 200) {
							$scope.alerts[0] = {type: "success", msg: result.data.message};
						} else {
							$scope.alerts[0] = {type: "danger", msg: result.data.message};
						}
					});
				ImageService.update(profile)
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
			}
		};

		/* -------------------------- Delete -------------------------------------------- */
		$scope.delete = function(map, validated) {
			if(validated === true) {
				TruckService.delete(profile)
					.then(function(result) {
						if(result.data.status === 200) {
							$scope.alerts[0] = {type: "success", msg: result.data.message};
						} else {
							$scope.alerts[0] = {type: "danger", msg: result.data.message};
						}
					});
				CompanyService.delete(profile)
					.then(function(result) {
						if(result.data.status === 200) {
							$scope.alerts[0] = {type: "success", msg: result.data.message};
						} else {
							$scope.alerts[0] = {type: "danger", msg: result.data.message};
						}
					});
			}
		};

		$scope.



	}]);