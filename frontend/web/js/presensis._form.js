var httpRequest;

let camera_button = document.querySelector("#start-camera");
let video = document.querySelector("#video");
let click_button = document.querySelector("#click-photo");
let canvas = document.querySelector("#canvas");
let latInput = document.querySelector('#presensi-latitude');
let lonInput = document.querySelector('#presensi-longitude');
let addrInput = document.querySelector('#presensi-address');
var lat, lon;

navigator.geolocation.getCurrentPosition(function (position) {
  lat = position.coords.latitude;
  lon = position.coords.longitude;
  console.log(lon, lat);

  latInput.value = lat;
  lonInput.value = lon;

  let revMapReq = 'https://nominatim.openstreetmap.org/reverse?lat=' + lat + '&lon=' + lon + '&format=json';

  httpRequest = new XMLHttpRequest();

  if (!httpRequest) {
    alert('Giving up :( Cannot create an XMLHTTP instance');
    return false;
  }
  httpRequest.onreadystatechange = alertContents;
  httpRequest.open('GET', revMapReq);
  httpRequest.send();
});

function inputAddress(responseText) {
  let jResponse = JSON.parse(responseText);
  console.log(jResponse.display_name);
  addrInput.value = jResponse.display_name;
}

function alertContents() {
  // console.log()
  if (httpRequest.readyState === XMLHttpRequest.DONE) {
    if (httpRequest.status === 200) {
      inputAddress(httpRequest.responseText);
      drawMap();
    } else {
      alert('There was a problem with the request.');
    }
  }
}

camera_button.addEventListener('click', async function () {
  var constraints = {
    audio: false,
    video: {
      width: { min: 1024, ideal: 1280, max: 1920 },
      height: { min: 576, ideal: 720, max: 1080 },
    }
  };
  let stream = await navigator.mediaDevices.getUserMedia(constraints);
  video.srcObject = stream;

  // video.classList.remove('d-none');
  // video.classList.add('d-block');
  // canvas.classList.remove('d-block');
  // canvas.classList.add('d-none');

});

click_button.addEventListener('click', function () {
  canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
  let image_data_url = canvas.toDataURL('image/jpeg');

  video.pause();
  console.log(video.videoWidth, video.videoHeight);
  // video.classList.add('d-none');
  // video.classList.remove('d-block');
  // canvas.classList.remove('d-none');
  // canvas.classList.add('d-block');

  // data url of the image
  // console.log(image_data_url);
  $('#presensi-photo_data').val(image_data_url);

});

var attribution = new ol.control.Attribution({
  collapsible: false
});

function drawMap() {
  // lon = -6.16758;
  // lat = 106.79579;
  console.log(lon, lat);

  var map = new ol.Map({
    controls: ol.control.defaults({ attribution: false }).extend([attribution]),
    layers: [
      new ol.layer.Tile({
        source: new ol.source.OSM()
      })
    ],
    target: 'map',
    view: new ol.View({
      center: ol.proj.fromLonLat([lon, lat]),
      // center: ol.proj.fromLonLat([4.35247, 50.84673]),
      maxZoom: 18,
      zoom: 18
    })
  });

  var layer = new ol.layer.Vector({
    source: new ol.source.Vector({
      features: [
        new ol.Feature({
          geometry: new ol.geom.Point(ol.proj.fromLonLat([lon, lat]))
        })
      ]
    })
  });
  map.addLayer(layer);
}
