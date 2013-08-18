
//VARIABLES
var zoom = 12;
var directionsDisplay;
var directionsService = new google.maps.DirectionsService();
var map;
 var mapOptions = {
    zoom: zoom,
    center: new google.maps.LatLng(51.063407, 3.729858),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
//GOOGLE MAPS
function initialize() {  
 

  var map = new google.maps.Map(document.getElementById("mapTest"),mapOptions);

  	directionsDisplay = new google.maps.DirectionsRenderer();
   	directionsDisplay.setMap(map);
    directionsDisplay.setPanel(document.getElementById("directionsPanel"));
	if ($("#campus").length > 0){
	  
	}
	else{
			calcRouteCarpool();
		}
	}
function calcRouteCarpool() {
  var request = {
      origin:new google.maps.LatLng(latDepart,lngDepart),
      destination:new google.maps.LatLng(latCampus,lngCampus),
      travelMode: google.maps.DirectionsTravelMode.DRIVING
  };
  directionsService.route(request, function(response, status) {
    if (status == google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(response);
	  console.log(response);
    }
  });
}
function calcRouteTransit() {
	
	if (navigator.geolocation) {
	navigator.geolocation.getCurrentPosition(success, error);
	} else {
	error('not supported');
	}
	function success(position) {
		 
        map = new google.maps.Map(document.getElementById('mapTest'), mapOptions);
        directionsDisplay.setMap(map);

        var start = position.coords.latitude + ',' + position.coords.longitude;;
        var end =  document.getElementById('campus').value;
        var mode = google.maps.DirectionsTravelMode.TRANSIT;

        var request = {
            origin:start,
            destination:end,
            travelMode: mode
        };
        
        directionsService.route(request, function(response, status) {
          if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
          }
        });

      }

	  function error(msg) {
		var s = document.querySelector('#status');
		s.innerHTML = typeof msg == 'string' ? msg : "failed";
		s.className = 'fail';
	
		console.log(arguments);
	   }

}
google.maps.event.addDomListener(window, 'load', initialize);

$(document).ready(function() {  
    $('#campus').change();
});      
 