//Made this to try Mapbox 11.12 MA

// angular.module('Crumbtrail').directive('mapbox', [
// 	function () {
// 		return {
// 			restrict: 'EA',
// 			replace: true,
// 			scope: {
// 				callback: "="
// 			},
// 			template: '<div></div>',
// 			viewUrl: 'eater-map-view.php',
// 			controller: MapController,
// 			link: function (scope, element, attrs) {
// 				L.mapbox.accessToken = 'pk.eyJ1IjoibW1hbHZhcjEzIiwiYSI6ImNpdmcyMHZmZDAwenQydG82NzBxYzBodzgifQ.KGW_RTkVCfjPpzsHppDkQA';
// 				var map = L.mapbox.map(element[0], 'mapbox://styles/mmalvar13/civg2cwf5000s2imm6b23s37m');
// 				scope.callback(map);
// 			}
// 		};
// 	}
// ]);