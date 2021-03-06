app.constant("EVENT_ENDPOINT", "php/apis/event/");
app.service("EventService", function($http, EVENT_ENDPOINT) {

	function getUrl() {
		return (EVENT_ENDPOINT);
	}

	function getUrlForId(eventId) {
		return (getUrl() + eventId);
	}

	this.all = function() {
		return ($http.get(getUrl()));
	};

	this.fetch = function(eventId) {
		return ($http.get(getUrlForId(eventId)));
	};

	this.fetchEventByTruckId = function(eventTruckId) {
		return ($http.get(getUrl() + "?eventTruckId=" + eventTruckId));
	};

	this.fetchEventByEventIdAndEventTruckId = function(eventId, eventTruckId){
		return($http.get(getUrl() + "?eventId=" + eventId, "?eventTruckId=" + eventTruckId));
	};

	this.fetchEventByEventStart = function(eventStart) {
		return ($http.get(getUrl() + "?eventStart=" + eventStart));
	};

	this.fetchEventByEventEnd = function(eventEnd) {
		return ($http.get(getUrl() + "?eventEnd=" + eventEnd));
	};


	this.updateEvent = function(eventId, event) {
		console.log(event);
		return ($http.put(getUrlForId(eventId, event)));
	};

	this.createEvent = function(event) {
		console.log(event);
		return ($http.post(getUrl(), event));
	};

});