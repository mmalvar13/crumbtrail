/*
 * service for image api
 * */

app.constant("IMAGE_ENDPOINT", "php/apis/image/");
app.service("ImageService", function($http, IMAGE_ENDPOINT) {

	function getUrl() {
		return (IMAGE_ENDPOINT);
	}

	function getUrlForId(imageId) {
		return (getUrl() + imageId);
	}

	this.all = function() {
		return ($http.get(getUrl()));
	};

	this.fetch = function(imageId) {
		return ($http.get(getUrlForId(imageId)));
	};

	this.fetchImageByImageCompanyId = function(imageCompanyId) {
		return ($http.get(getUrl() + "?imageCompanyId=" + imageCompanyId));
	};

	this.fetchImageByImageFileName = function(imageFileName) {
		return ($http.get(getUrl() + "?imageFileName=" + imageFileName));
	};

	this.createImage = function(image) {
		return ($http.post(getUrl(), image));
	};

	this.deleteImage = function(imageId) {
		return ($http.delete(getUrlForId(imageId)));
	};


});
