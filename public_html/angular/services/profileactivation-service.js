/**
 * service for profile activation api
 * @author Monica Alvarez
 *
 *
 **/

app.constant("PROFILEACTIVATION_ENDPOINT", "php/apis/profileActivation/");
app.service("ProfileactivationService", function($http, PROFILEACTIVATION_ENDPOINT){
	function getUrl(){
		return(PROFILEACTIVATION_ENDPOINT);
	}
	this.fetch = function(misquoteId){
		return($http.get(getUrlForId(misquoteId)));
	}
})