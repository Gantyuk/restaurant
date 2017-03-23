@extends('layouts.site')

@section('content')
    <style>
        #map-canvas {
            height: 80%;
            width: 120%
        }
    </style>

    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCqe3b2zbkqIgwb8CtpJfAWW1KCeiUQhGM&libraries=places"
            type="text/javascript"></script>

    <div class="conteiner">


        <div class="form-group">
            <label for="">Map</label>
            <div class="ln_solid"></div>
            <div id="map-canvas"></div>
        </div>


    </div>
    <script>
        var map = new google.maps.Map(document.getElementById('map-canvas'), {
            center: {
                lat: 27.72,
                lng: 85.36
            },
            zoom: 15
        });
        var marker = new google.maps.Marker({
            position: {
                lat: 27.72,
                lng: 85.36

            },
            map: map,
            draggable: true

        });
        var markers = [];
        // [START region_getplaces]
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        if (navigator.geolocation) {
            var location_timeout = setTimeout("geolocFail()", 10000);

            navigator.geolocation.getCurrentPosition(function (position) {

                clearTimeout(location_timeout);
alert('in this');
                var lat = position.coords.latitude;
                var lng = position.coords.longitude;
                map.setCenter(new google.maps.LatLng(lat, lng));
                map.setZoom = 20;
                var i = new google.maps.LatLng(lat, lng);
                var markers = new google.maps.Marker({
                    position: i,
                    map: map
                });
                map.setZoom(18);
                marker.push(markers);
                geocodeLatLng(lat, lng);
            }, function (error) {
                clearTimeout(location_timeout);
            });
        } else {
            geolocFail();
        }


    </script>

@endsection
