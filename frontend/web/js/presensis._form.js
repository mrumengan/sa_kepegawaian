var httpRequest;

let camera_button = document.querySelector("#start-camera");
let video = document.querySelector("#video");
let click_button = document.querySelector("#click-photo");
let canvas = document.querySelector("#canvas");
let latInput = document.querySelector('#presensi-latitude');
let lonInput = document.querySelector('#presensi-longitude');
let addrInput = document.querySelector('#presensi-address');

navigator.geolocation.getCurrentPosition(function (position) {
  let lat = position.coords.latitude;
  let lon = position.coords.longitude;

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
    } else {
      alert('There was a problem with the request.');
    }
  }
}

camera_button.addEventListener('click', async function () {
  let stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: false });
  video.srcObject = stream;

  video.classList.remove('d-none');
  video.classList.add('d-block');
  canvas.classList.remove('d-block');
  canvas.classList.add('d-none');

});

click_button.addEventListener('click', function () {
  canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
  let image_data_url = canvas.toDataURL('image/jpeg');

  video.classList.add('d-none');
  video.classList.remove('d-block');
  canvas.classList.remove('d-none');
  canvas.classList.add('d-block');

  // data url of the image
  console.log(image_data_url);
});