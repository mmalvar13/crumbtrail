app.controller('ListController', ["$location","$scope", "CompanyService", "EventService", "ImageService", function($location, $scope, CompanyService, EventService, ImageService) {
	$scope.alerts = [];
	$scope.companyData = [];
	$scope.eventData = [];
	$scope.imageData = [];
	$scope.companys = [];
	console.log("at the beginning");




	/*todo i just made this tonight 9/11 MA*/
	$scope.loadCompanys = function(){
		CompanyService.fetchAllCompanys()
			.then(function(result){
				if(result.data.status === 200){
					$scope.companyData = result.data.data;
					console.log($scope.companyData);
				}else{
					$scope.alerts[0] = {type:"danger", msg: result.data.message};
				}
			})
	};

	//reroute the page to the specified company
	$scope.loadCompany = function(companyId){
		$location.path("profile/" + companyId);
	};

	/*end of what i made tonight 9/11*/


	/*-------------------------------CompanyService---------------------------------*/

	// Scope function to get all companies
	$scope.getAllCompanys = function() {
		console.log("in fetch all companies");
		CompanyService.fetchAllCompanys()
			.then(function(result) {


				if(result.status.data === 200) {
					$scope.companyData = result.data.data;

				} else {
					console.log("dafasdfasdf");
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};


	$scope.getCompanyByCompanyId = function(companyId) {
		CompanyService.fetchCompanyById(companyId)
			.then(function(result) {

				if(result.status.data === 200) {
					$scope.companyData = result.data.data;

				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
	};

	$scope.getCompanyByCompanyName = function(companyName) {
		CompanyService.fetchCompanyByCompanyName(companyName)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.companyData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};

				}
			})
	};

	$scope.getCompanyByCompanyMenuText = function(companyMenuText) {
		CompanyService.fetchCompanyByCompanyMenuText(companyMenuText)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.companyData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};

				}
			})
	};

	$scope.getCompanyByCompanyDescription = function(companyDescription) {
		CompanyService.fetchCompanyByCompanyDescription(companyDescription)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.companyData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};

				}
			})
	};

	/*---------------------------------EventsService------------------------------*/
	$scope.getEventByEventId = function(eventId) {
		EventService.fetchEventByEventId(eventId)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.eventData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};

				}
			})
	};


	$scope.getEventByEventEndAndEventStart = function(eventEnd, eventStart) {
		EventService.fetchEventByEventEndAndEventStart(eventEnd, eventStart)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.eventData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};

				}
			})
	};

	$scope.getEventByEventTruckId = function(eventTruckId) {
		EventService.fetchEventByEventTruckId(eventTruckId)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.eventData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};

				}
			})
	};


	$scope.getEventByEventIdAndEventTruckId = function(eventId, eventTruckId) {
		EventService.fetchEventByEventIdAndEventTruckId(eventTruckId)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.eventData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};

				}
			})
	};

	/*--------------------------ImageService---------------------------------------*/
	//why doesnt it like it by just the ID, we have it this way in the API
	$scope.getImageByImageId = function(imageId) {
		ImageService.fetchImageByImageId(imageId)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.imageData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};

				}
			})


	};
	$scope.getImageByImageCompanyId = function(imageCompanyId) {
		ImageService.fetchImageByImageCompanyId(imageCompanyId)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.imageData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};

				}
			})


	};
	$scope.getImageByImageFileName = function(imageFileName) {
		ImageService.fetchImageByImageFileName(imageFileName)
			.then(function(result) {
				if(result.status.data === 200) {
					$scope.imageData = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};

				}
			})


	};

//create, update, and destroy!!!!!!!
	/*------------------------------------CREATE---------------------------------*/
	$scope.listCreate = function(list, validated) {
		if(validated === true) {
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
		}

	};
	/*--------------------------------UPDATE-----------------------*/
	$scope.listUpdate = function(list, validated) {
		if(validated === true) {
			EventService.update(list)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.alerts[0] = {type: "success", msg: result.data.message};
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});
			CompanyService.update(list)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.alerts[0] = {type: "success", msg: result.data.message};
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});
		}
	};
/*-------------------------------------DELETE------------------------------------------*/
	$scope.delete = function(list, validated) {
		if(validated === true) {
			ImageService.delete(list)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.alerts[0] = {type: "success", msg: result.data.message};
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});
			CompanyService.delete(list)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.alerts[0] = {type: "success", msg: result.data.message};
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});

		}
	};



/*todo i added this based off of what we had in profile-controller*/

	if($scope.companyData === null){
		$scope.loadCompanys();
	}

}]);