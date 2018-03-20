/*This is the implementation of the google dynamic map api init defines the zoom level and coordinates of the map*/

var map;
function initMap() {
     map = new google.maps.Map(document.getElementById('map'), {
        center: directions,
        zoom: 10
    });
     var marker = new google.maps.Marker({
           position: directions,
           map: map
     });
    
}