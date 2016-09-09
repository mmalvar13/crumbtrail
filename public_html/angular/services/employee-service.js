/*
* service for employee api
* */



app.constant("EMPLOYEE_ENDPOINT", "php/apis/employee");
app.service("EmployeeService", function($http, EMPLOYEE_ENDPOINT){

	function getUrl(){
		return(EMPLOYEE_ENDPOINT);
	}

	function getUrlForId(employeeId){
		return(getUrl() + employeeId) //this is wrong, d o we need this?
	}

	this.fetch = function(employCompanyId, employProfileId){
		return($http.get(getUrlForId(employCompanyId, employProfileId)));
	};

	this.fetchEmployByEmployCompanyId = function(employCompanyId){
		return($http.get(getUrl() + "?employCompanyId=" + employCompanyId));
	};

	this.fetchEmployByEmployProfileId = function(employProfileId){
		return($http.get(getUrl() + "?employProfileId=" + employProfileId));
	};

	//do we put just employee? why? whyyy?
	this.createEmployee = function(employee){
		return($http.post(getUrl(), employee));
	};

	this.deleteEmployee = function(employCompanyId, employProfileId){
		return($http.delete(getUrlForId(employCompanyId, employProfileId)));
	};



});