// File Name: getUserCity.js
// Description: Uses Geolocation to determine User City
// Used by:
// Dependencies:
// ------------------------------------------------------

import axios from 'axios';

function reverseGeocode(lat, lng) {
  const API_KEY = 'AIzaSyAHgbS3bYYrlyyckvC1tjVn3GB7_0gVnoA'
  return axios.get(`https://maps.googleapis.com/maps/api/geocode/json?latlng=${lat},${lng}&key=${API_KEY}`)
    .then(res => {
      if (res.status !== 200) throw (res)
      let city;
      for (let ac = 0; ac < res.data.results[0].address_components.length; ac++) {
        let component = res.data.results[0].address_components[ac];

        switch(component.types[0]) {
          case 'locality':
            city = component.long_name;
            break;
        }
      }

      return city;
    })
    .catch(err => {
      // eslint-disable-next-line no-console
      console.error('There was an Error Acquiring the Address:', err);
    })
}

function getPreciseLocation() {
  return new Promise((resolve, reject) => {
    navigator.geolocation.getCurrentPosition(pos => {
      resolve([pos.coords.latitude, pos.coords.longitude]);
    })
  })
}

export default async () => {
  try {
    if (typeof window === 'object' && 'geolocation' in navigator) {
      // get coords (getPreciseLocation => [lat, lng])
      let coords = await getPreciseLocation()
      // whichCity? (reverseGeocode => <string> city)
      return await reverseGeocode(coords[0], coords[1]);
    } else {
      // eslint-disable-next-line no-console
      console.error(`Error: Geolocation Not Supported: ${err}`);
    }
  } catch (err) {
    // eslint-disable-next-line no-console
    console.error(`Error: Unable to Fetch GeoLocation data: ${err}`);
  }
}

