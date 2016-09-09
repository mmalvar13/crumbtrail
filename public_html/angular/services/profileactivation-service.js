/**
 * service for profile activation api
 * @author Monica Alvarez
 *
 *
 **/

app.constant("PROFILEACTIVATION_ENDPOINT", "php/apis/profileActivation/");
app.service("ProfileactivationService", function($http, PROFILEACTIVATION_ENDPOINT) {
	function getUrl() {
		return (PROFILEACTIVATION_ENDPOINT);
	}

	function getUrlForId(profileId) {
		return (getUrl() + profileId); //Is this supposed to be profile id?? what should it be.
	}

	this.fetchProfileByProfileByProfileActivationToken = function(profileActivationToken) {
		return ($http.get(getUrl() + "?profileActivationToken=" + profileActivationToken));
	};

	this.fetchEmployByEmployCompanyIdAndEmployProfileId = function(employCompanyId, employProfileId) {
		return ($http.get(getUrl() + "?employCompanyId=" + employCompanyId, "?employProfileId=" + employProfileId));
	};

	this.fetchCompanyByCompanyId = function(companyId) {
		return ($http.get(getUrl() + "?companyId=" + companyId));
	};


});