//VARIABLES
var zoom = 12;
var map;
var directionsService = new google.maps.DirectionsService();
var directionsDisplay;


//GOOGLE MAPS
function initialize() {  
  var mapOptions = {
    zoom: zoom,
    center: new google.maps.LatLng(latCampus,lngCampus),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }

  var map = new google.maps.Map(document.getElementById("mapTest"),mapOptions);

  	directionsDisplay = new google.maps.DirectionsRenderer();
   	directionsDisplay.setMap(map);
  	jQuery.fn.exists = function(){return this.length>0;}
	
	if ($('#campus').exists()) {
		calcRouteTransit();
		var control = document.getElementById('control');
		control.style.display = 'block';
		map.controls[google.maps.ControlPosition.TOP_CENTER].push(control);
	}
	else{
		calcRouteCarpool();
		}
	// Try HTML5 geolocation
	  if(navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function(position) {
		  var pos = new google.maps.LatLng(position.coords.latitude,
										   position.coords.longitude);
		  map.setCenter(posTransit);
		}, function() {
		  handleNoGeolocation(true);
		});
	  } else {
		// Browser doesn't support Geolocation
		handleNoGeolocation(false);
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
	
  var end = document.getElementById('campus').value;
  var request = {
      origin:posTransit,
      destination:end,
      travelMode: google.maps.DirectionsTravelMode.TRANSIT
  };
  directionsService.route(request, function(response, status) {
    if (status == google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(response);
	  console.log(response);
    }
  });
}
function handleNoGeolocation(errorFlag) {
  if (errorFlag) {
    var content = 'Error: The Geolocation service failed.';
  } else {
    var content = 'Error: Your browser doesn\'t support geolocation.';
  }

  var options = {
    map: map,
    position: new google.maps.LatLng(51.063407, 3.729858),
    content: content
  };

  var infowindow = new google.maps.InfoWindow(options);
  map.setCenter(options.position);
}
