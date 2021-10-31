
function init() {
  // console.log()
  drawMap();
}

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

navigator.geolocation.getCurrentPosition(function (position) {

  init();
});