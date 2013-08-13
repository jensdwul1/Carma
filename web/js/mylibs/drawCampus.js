//VARIABLES
var zoom = 14;

//METHODS
function initApp(){
    initialize();
}

//GOOGLE MAPS
function initialize() {

  var mapOptions = {
    zoom: zoom,
    center: new google.maps.LatLng(latCampus,lngCampus),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }

  var map = new google.maps.Map(document.getElementById("mapTest"),
        mapOptions);

 var marker = new google.maps.Marker({
        position: new google.maps.LatLng(latCampus,lngCampus),
        map: map
      });

}

/* SELF EXECUTING METHOD */
$(function(){
    initApp();
}(window));