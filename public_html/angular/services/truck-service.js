\/*
* service for truck api
*
* @author Monica Alvarez
* */

/*define a constant that holds the base url of the Truck API
* This has the endpoint "php/apis/truck".
*
* This service will build a URL, access it, and grab whatever data it can.
*
* pass whatever ID or object needed in order to complete the operation.
*
* You will call this service's methods within the Truck Controller
* */
app.constant("TRUCK_ENDPOINT", "php/apis/truck/");

/*
* Initializes the Truck Service
*
* We inject the $http service. we use this to make REST calls
* We also inject our endpoint so that it is usable inside the service.
* */
app.service("TruckService", function($http, TRUCK_ENDPOINT){

	/*
	 * Returns the truck endpoint for use in other methods
	 * */

	function getUrl(){
		return(TRUCK_ENDPOINT);
	}

/*
* Builds a URL for getting a truck by ID (example: "php/apis/truck/3")
* */
	function getUrlForId(truckId){
		return(getUrl() + truckId);
	}

	/*
	* GETS all trucks
	* */
	this.all = function(){
		return($http.get(getUrl()));
	};


	/*
	* GETS a truck by ID
	* */
	this.fetch = function(truckId){
		return($http.get(getUrlForId(truckId)));
	};


	/*
	* GETS a truck by truckCompanyId
	* */
	this.fetchTruckByTruckCompanyId = function(truckCompanyId){
		return($http.get(getUrl() + "?truckCompanyId=" + truckCompanyId));
	};

	/*
	* POSTS a truck (creates one)
	* */
	this.createTruck = function(truck){
		return($http.post(getUrl(), truck));
	};


	/*
	* PUTS a truck
	* */
	this.updateTruck = function(truckId, truck){
		return($http.put(getUrlForId(truckId), truck));
	};


	/*
	* DELETES a truck
	* */
	this.deleteTruck = function(truckId){
		return($http.delete(getUrlForId(truckId)));
	};
});