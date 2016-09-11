// Company Profile Controller -> company profile view.
// Uses:
//    Company service
//    Event service
//    Image service
//    Profile service

app.controller('ProfileController', ["$routeParams","$scope", "CompanyService", "EventService", "ImageService", "ProfileService",
	function($routeParams, $scope, CompanyService, EventService, ImageService, ProfileService) {

		$scope.companyData = null;
		$scope.alerts = [];

		/*i just made this 9/11 MA*/
		$scope.loadCompanyProfile = function(){
			CompanyService.fetchCompanyByCompanyId($routeParams.companyId)
				.then(function(result){
					if(result.data.status === 200){
						$scope.companyData = result.data.data;
						console.log($scope.companyData);
					}else{
						$scope.alerts[0] = {type:"danger", msg: result.data.message};
					}
				})
		};

		/*end of what i mad*/

		/* ---------------------- Read stuff: getFooByBars -------------------------------------------------------- */
		/* ------------------------- CompanyService methods ------------------------------------------------------ */
		$scope.fetchCompanyByCompanyId = function(companyId) {
			CompanyService.fetchCompanyByCompanyId(companyId)
				.then(function(result) {
					if(result.status.data === 200) {
						$scope.companyData = result.data.data;
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				})
		};

		$scope.fetchCompanyByCompanyName = function(companyName) {
			CompanyService.fetchCompanyByCompanyName(companyName)
				.then(function(result) {
					if(result.status.data === 200) {
						$scope.companyData = result.data.data;
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				})
		};

		$scope.fetchCompanyByCompanyMenuText = function(companyMenuText) {
			CompanyService.fetchCompanyByCompanyMenuText(companyMenuText)
				.then(function(result) {
					if(result.status.data === 200) {
						$scope.companyData = result.data.data;
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				})
		};

		$scope.fetchCompanyByCompanyDescription = function(companyDescription) {
			CompanyService.fetchCompanyByCompanyDescription(companyDescription)
				.then(function(result) {
					if(result.status.data === 200) {
						$scope.companyData = result.data.data;
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				})
		};

		/*-------------------- EventService methods ----------------------------*/
		$scope.fetchEventByEventId = function(eventId) {
			EventService.fetchEventByEventId(eventId)
				.then(function(result) {
					if(result.status.data === 200) {
						$scope.companyData = result.data.data;
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				})
		};

		$scope.fetchEventByEventEndAndEventStart = function(eventEnd, eventStart) {
			EventService.fetchEventByEventEndAndEventStart(eventEnd, eventStart)
				.then(function(result) {
					if(result.status.data === 200) {
						$scope.companyData = result.data.data;
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				})
		};

		$scope.fetchEventByEventTruckId = function(eventTruckId) {
			EventService.fetchEventByEventTruckId(eventTruckId)
				.then(function(result) {
					if(result.status.data === 200) {
						$scope.companyData = result.data.data;
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				})
		};

		$scope.fetchEventByEventIdAndEventTruckId = function(eventId, eventTruckId) {
			EventService.fetchEventByEventIdAndEventTruckId(eventTruckId)
				.then(function(result) {
					if(result.status.data === 200) {
						$scope.companyData = result.data.data;
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				})
		};

		/*--------------------------- ImageService Methods --------------------------------------*/
		$scope.fetchImageByImageId = function(imageId) {
			ImageService.fetchImageByImageId(imageId)
				.then(function(result) {
					if(result.status.data === 200) {
						$scope.companyData = result.data.data;
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				})
		};

		$scope.fetchImageByImageCompanyId = function(imageCompanyId) {
			ImageService.fetchImageByImageCompanyId(imageCompanyId)
				.then(function(result) {
					if(result.status.data === 200) {
						$scope.companyData = result.data.data;
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				})
		};

		$scope.fetchImageByImageFileName = function(imageFileName) {
			ImageService.fetchImageByImageFileName(imageFileName)
				.then(function(result) {
					if(result.status.data === 200) {
						$scope.companyData = result.data.data;
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				})
		};

		/*-------------------------- ProfileService Methods --------------------------------------*/
		$scope.fetchProfileByProfileId = function(profileId) {
			EventService.fetchProfileByProfileId(profileId)
				.then(function(result) {
					if(result.status.data === 200) {
						$scope.companyData = result.data.data;
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

		if($scope.companyData === null){
			$scope.loadCompanyProfile();
		}


	}]);