/*
* service for company api
* */

app.constant("COMPANY_ENDPOINT", "php/apis/company/");
app.service("CompanyService", function($http, COMPANY_ENDPOINT){

	function getUrl(){
		return(COMPANY_ENDPOINT);
	}

	function getUrlForId(companyId){
		return(getUrl() + companyId);
	}

	this.all = function(){
		return($http.get(getUrl()));
	};

	this.fetch = function(companyId){
		return($http.get(getUrlForId(companyId)));
	};

	this.fetchCompanyByCompanyAccountCreatorId = function(companyAccountCreatorId){
		return($http.get(getUrl() + "?companyAccountCreatorId=" + companyAccountCreatorId));
	};

	this.fetchCompanyByCompanyName = function(companyName){
		return($http.get(getUrl() + "?companyName=" + companyName));
	};

	this.fetchCompanyMenuText = function(companyMenuText){
		return($http.get(getUrl() + "?companyMenuText=" + companyMenuText));
	};

	this.fetchCompanyDescription = function(companyDescription){
		return($http.get(getUrl() + "?companyDescription=" + companyDescription));
	};

	this.updateCompany = function(companyId, company){
		return($http.put(getUrlforId(companyId, company)));
	};


	this.deleteCompany = function(companyId){
		return($http.delete(getUrlForId(companyId)));
	};


});
