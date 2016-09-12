/**
 * Angular Service to get user's location from HTML5's geolocation; directly plagiarized :D
 * @see http://stackoverflow.com/questions/23185619/how-can-i-use-html5-geolocation-in-angularjs
 **/
app.service('GeoLocationService', ['$q', '$window', function($q, $window) {
	function getCurrentPosition() {
		var deferred = $q.defer();

		if(!$window.navigator.geolocation) {
			deferred.reject('Geolocation not supported.');
		} else {
			$window.navigator.geolocation.getCurrentPosition(
				function(position) {
					deferred.resolve(position);
				},
				function(err) {
					deferred.reject(err);
				});
		}

		return deferred.promise;
	}

	return {
		getCurrentPosition: getCurrentPosition
	};
}]);