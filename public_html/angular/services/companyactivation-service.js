/*
* service for company activation API
* */

app.constant("COMPANYACTIVATION_ENDPOINT", "php/apis/companyActivation/");
app.service("CompanyactivationService", function($http, COMPANYACTIVATION_ENDPOINT){

	function getUrl(){
		return(COMPANYACTIVATION_ENDPOINT);
	}

	function getUrlForId(companyId){
		return(getUrl() + companyId);
	} //what do we need here?


	this.fetch = function(companyId){
		return($http.get(getUrlForId(companyId)));
	}; //is this correct?

	this.fetchCompanyByCompanyActivationToken = function(companyActivationToken){
		return($http.get(getUrl() + "?companyActivationToken=" + companyActivationToken));
	};

	//what about company approved??



});