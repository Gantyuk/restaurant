<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCqe3b2zbkqIgwb8CtpJfAWW1KCeiUQhGM&libraries=places"
        type="text/javascript"></script>

<div class="col-md-6 col-sm-2 col-xs-2 col-md-offset-0" id="map_canvas" style="height: 250px; width: 500px"></div>

@if(!isset($lat_long))
    <?php
    $lat_long = '48.2937316, 25.9359396';
    ?>
    @endif

<script>

            var myLatlng = new google.maps.LatLng({{$lat_long}}),
                mapOptions = {
                    zoom: 15,
                    center: myLatlng
                },
                map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions),
                marker = new google.maps.Marker({
                    position: myLatlng,
                    map: map,
                    title: ''
                });


</script>