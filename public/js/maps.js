let accessToken = "pk.eyJ1IjoibWF4bWlsbGlvbi1wZWdhc3VzIiwiYSI6ImNscWRvM3hlcTBoenQycXRrdWt6eXllaXgifQ.nQ84ZACkBSCYyhrMfGUyoQ";
import mapboxgl from 'mapbox-gl/dist/mapbox-gl-csp';
import MapboxWorker from 'worker-loader!mapbox-gl/dist/mapbox-gl-csp-worker'; // Load worker code separately with worker-loader

mapboxgl.workerClass = MapboxWorker; // Wire up loaded worker to be used instead of the default
const map = new mapboxgl.Map({
    container: 'map', // container ID
    style: 'mapbox://styles/mapbox/streets-v12', // style URL
    center: [-74.5, 40], // starting position [lng, lat]
    zoom: 9 // starting zoom
});