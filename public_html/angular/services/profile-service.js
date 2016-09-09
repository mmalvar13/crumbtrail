/*
* service for profile api
* */

app.constant("PROFILE_ENDPOINT", "php/apis/profile/");
app.service("ProfileService", function($http, PROFILE_ENDPOINT){

	function getUrl(){
		return(PROFILE_ENDPOINT);
	}

	function getUrlId(profileId){
		return(getUrl() + profileId);
	}

	//why is this just function() with no parameters? what function is it?
	this.all = function(){
		return($http.get(getUrl()));
	};

	this.fetch = function(profileId){
		return(http.get(getUrlForId(profileId)));
	};

	this.updateProfile = function(profileId, profile){
		return($http.put(getUrlForId(profileId, profile)));
	};


});