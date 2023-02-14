let map;
//default - colombo
let latit = 6.927079;
let longi = 79.861244;
let city;
let infowindow;
let geocoder;
let arrNearItems=[];
let mapZoom = 15;
//let markers = [];

/*
const successCallback = (position) => {
  //This code use to initiate latitude and longitude of users currunt location when page loding
  //console.log(position);
  latit = position.coords.latitude;
  longi = position.coords.longitude;
  //setCurrentLatLon(latit,longi)
  //console.log(latit);
};

const errorCallback = (error) => {
  //In case of successCallback faild this gives message on js console and global vars latit & longi alrady have coodiantes of default location colombo
  console.log('Gelocation finding failed!');
};
*/
function setCurrentLatLon(pos){
  latit=pos.coords.latitude;
  //longi=lng;
  console.log(pos.coords.latitude);
}

function initAutocomplete() {
//Get current Location
  if (navigator.geolocation) {
    //let loc;
    navigator.geolocation.getCurrentPosition(setCurrentLatLon);
    
  } else {
    alert("Geolocation is not supported by the browser.");
  }
  //const id = navigator.geolocation.getCurrentPosition(successCallback, errorCallback);





  console.log(latit);
  //Craete new map instance
  map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: latit, lng: longi },
    zoom: mapZoom,
    mapTypeId: "roadmap",
  });

  //Info window for pop up box of marker
  infowindow = new google.maps.InfoWindow();

  //Geocoder for get the latitude longitude from given place
  geocoder = new google.maps.Geocoder();


  // Create the search box and link it to the UI element.
  const input = document.getElementById("pac-input");
  const searchBox = new google.maps.places.SearchBox(input);

  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
  // Bias the SearchBox results towards current map's viewport.
  map.addListener("bounds_changed", () => {
    searchBox.setBounds(map.getBounds());

  });


  // Listen for the event fired when the user selects a prediction and retrieve
  // more details for that place.
  searchBox.addListener("places_changed", () => {
    const places = searchBox.getPlaces();

    if (places.length == 0) {
      return;
    }

    /*// Clear out the old markers.
    markers.forEach((marker) => {
      marker.setMap(null);
    });
    markers = [];*/

    // For each place, get the icon, name and location.
    const bounds = new google.maps.LatLngBounds();

    places.forEach((place) => {
      if (!place.geometry || !place.geometry.location) {
        console.log("Returned place contains no geometry");
        return;
      }

      //Get selected place and its latitude & longitude
      let selectedPlace = place.geometry.location;
      latit = selectedPlace.lat();
      longi = selectedPlace.lng();

      //Call geocode for work on target area
      geocodeLatLng(geocoder, latit, longi);

      if (place.geometry.viewport) {
        // Only geocodes have viewport.
        bounds.union(place.geometry.viewport);
      } else {
        bounds.extend(place.geometry.location);
      }
    });
    map.fitBounds(bounds);
  });
}


function geocodeLatLng(geocoder, latitude, longitude) {

  //Cearte latlng constant to use as geocoder input
  const latlng = {
    lat: latitude,
    lng: longitude,
  };
  //console.log(latlng);

  //Get address of the place hence relevent city
  geocoder
    .geocode({ location: latlng })
    .then((response) => {
      if (response.results[0]) {
        //get address fro resulsts
        var arrAddress = response.results[0].address_components;

        //Get city name from address -- myGetCity() set the city to global var city
        arrAddress.forEach(myGetCity);
        //console.log(city);

        //Get the lsit of items that sell in that city
        getItemData(city).then( response => handleAjaxResposneOfItems(response));

      } else {
        window.alert("location not found!");
      }
    })
    .catch((e) => window.alert("Geocoder failed due to: " + e));
}

function getItemData(city){
  //This function give sell iem list for a given city name

  //This is ajax php file url
  let u="ajax/sellItems.ajax.php?city=" + city;

  return $.ajax({
    url: u
  });

}

function handleAjaxResposneOfItems(res){
  //This function handles the ajax php response and work on each item using markSellItem() fucntion dreven by forEach loop
  let items;
  items = JSON.parse(res);
  //console.log(items);
  if(items){
    items.forEach(markSellItem);//mark items on map
  }
}

function markSellItem(item, index){
  //This fuction marks items on the map parameter 'item' is an arry whic has id,title,lat,lng,price of one item
  //console.log(item[1]);
  map.setZoom(mapZoom);

  //This is the coordinate of marker position
  const latlng = {
    lat: parseFloat(item[2]),
    lng: parseFloat(item[3]),
  };


  //This is the content of info box of the marker
  let content="<a href='itemDetails.php?id="+item[0]+"'><b>"+item[1]+"</b> for LKR."+item[4]+"</a>";

  //This creates info box
  const infowindow = new google.maps.InfoWindow({
    content: content,
    ariaLabel: item[1],
  });

  //This code place the marker on map
  const marker = new google.maps.Marker({
    position: latlng,
    map: map,
  });

  //This Code makes pop-up open the info box when user click on the marker
  marker.addListener("click", () => {
    infowindow.open({
      anchor: marker,
      map,
    });
  });

  //this line make the info visible (open) when loading
  infowindow.open(map, marker);

  //console.log(item[1]);
}


function myGetCity(item, index) {
  //This code gives city for given address
  //console.log(item);
  if(item.types[0]=="locality"){
    //console.log("town:"+item.long_name);
    city=item.long_name;
  }
}



window.initAutocomplete = initAutocomplete;