app.constant("EVENT_ENDPOINT", "php/apis/event/");
app.service("eventService", function(http, EVENT_ENDPOINT) {
	function getUrl() {
		return("Event");
	}
	function getUrl() {
		return(EVENT_ENDPOINT);
	}
	function getUrlForId(eventId) {
		return(getUrl() + eventId);
	}
	this.all = function() {
		return($http.(getUrl()));
	};
	this.getEventById = function(eventId) {
		return($http.get(getUrlForId(eventId)));
	};
	this.getEventByTruckId = function(eventTruckId) {
		return($http.get(getUrl() + "?eventTruckId=" + eventTruckId));
	};
	this.getEventByStart = function(eventStart) {
		return($http.get(getUrl() + "?eventStart=" + eventStart));
	};
	this.getEventByEnd = function(eventEnd) {
		return($http.get(getUrl() + "?eventEnd=" + eventEnd));
	};
	this.eventUpdate = function(eventId, event) {
		return($http.put(getUrlForId(eventId, event)));
	};
	this.eventCreate = function(eventId, event) {
		return($http.post(getUrl(), event));
	};
	});