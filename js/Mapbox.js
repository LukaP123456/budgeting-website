
mapboxgl.accessToken = 'pk.eyJ1IjoibHVrYXAxMjM0IiwiYSI6ImNsMGUyZm9zMzBlbjcza216dHVpaHp1MGsifQ.YiIO8BXNFO_5ulU7cekvnQ';
let map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/streets-v11',
    center: [-71.060982,42.35725],
    zoom:18,
});

$(document).ready(function() {

    if(window.location.href.indexOf('#enroll') != -1) {
        $('#enroll').modal('show');
    }

});