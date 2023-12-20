let accessToken = "pk.eyJ1IjoibWF4bWlsbGlvbi1wZWdhc3VzIiwiYSI6ImNscWRvM3hlcTBoenQycXRrdWt6eXllaXgifQ.nQ84ZACkBSCYyhrMfGUyoQ";
mapboxgl.accessToken = 'YOUR_MAPBOX_ACCESS_TOKEN';
let map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/streets-v11'
});