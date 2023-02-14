//Create map
let map;
//Get current posistion
let lat;
let lon;
let markers = [];
let geocoder;

function initMap(latitude,longitude) {
  //alert(lat);
  map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: latitude, lng: longitude },
    zoom: 25,
  });

  // This event listener will call addMarker() when the map is clicked.
  map.addListener('click', function(event) {
    addMarker(event.latLng);
  });

  geocoder = new google.maps.Geocoder();
}

function geocodeLatLng(latitude, longitude) {
  const latlng = {
    lat: latitude,
    lng: longitude,
  };

  geocoder
    .geocode({ location: latlng })
    .then((response) => {
      if (response.results[0]) {
        var arrAddress = response.results[0].address_components;//get address fro resulsts
        arrAddress.forEach(myGetCity);//Get city name from address

      } else {
        window.alert("location not found!");
      }
    })
    .catch((e) => window.alert("Geocoder failed due to: " + e));
}

// Adds a marker to the map and push to the array.
function addMarker(location) {
  //Deletes all existing markers 
  setMapOnAll(null);
  markers = [];

  //Put new marker
  var marker = new google.maps.Marker({
    position: location,
    map: map
  });
  markers.push(marker);

  document.getElementById("txtLat").value = markers[0].getPosition().lat();
  document.getElementById("txtLng").value = markers[0].getPosition().lng();

  geocodeLatLng(markers[0].getPosition().lat(), markers[0].getPosition().lng());

  //console.log(markers[0].getPosition().lng());
}

// Sets the map on all markers in the array.
function setMapOnAll(map) {
  for (let i = 0; i < markers.length; i++) {
    markers[i].setMap(map);
  }
}

function myGetCity(item, index) {
  //console.log(item);
  if(item.types[0]=="locality"){
    console.log("town:"+item.long_name);
    document.getElementById("txtCity").value = item.long_name;
  }
}

const successCallback = (position) => {
  //console.log(position);
  lat = position.coords.latitude;
  lon = position.coords.longitude;
  window.initMap = initMap(lat,lon);
};

const errorCallback = (error) => {
  //message.classList.add('error');
  //message.textContent = `Failed to get your location!`;
  console.log('Gelocation finding failed!');
  lat = 6.927079;
  lon = 79.861244;
  window.initMap = initMap(lat,lon);
};

navigator.geolocation.getCurrentPosition(successCallback, errorCallback);





