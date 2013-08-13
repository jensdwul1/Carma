//VARIABLES
var zoom = 12;

//METHODS
function initApp(){
    initialize();
    calcRoute();
}

//GOOGLE MAPS
function initialize() {
  var directionsDisplay;
  var directionsService = new google.maps.DirectionsService();
  
  var mapOptions = {
    zoom: zoom,
    center: new google.maps.LatLng(latCampus,lngCampus),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }

  var map = new google.maps.Map(document.getElementById("mapTest"),
        mapOptions);

  directionsDisplay = new google.maps.DirectionsRenderer();
}
function calcRoute() {
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

google.maps.event.addDomListener(window, 'load', initialize);

/* SELF EXECUTING METHOD */
$(function(){
    initApp();
}(window));