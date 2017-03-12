<style>
    #map-canvas{
        height: 250px;
        width: 500px
    }
</style>

<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCqe3b2zbkqIgwb8CtpJfAWW1KCeiUQhGM&libraries=places" type="text/javascript"></script>

<div class="conteiner">
    <div class="col-sm-4">
        <h3>Location</h3>

            <div class="form-group">
                <label for="">Map</label>
                <input type="text" id="searchmap" class="form-control col-md-4 col-xs-12" name="location">
                <div class="ln_solid"></div>
                <div id="map-canvas"></div>
            </div>



    </div>

</div>
    <script>
        var map = new google.maps.Map(document.getElementById('map-canvas'),{
            center:{
                lat:27.72,
                lng:85.36
            },
            zoom:15
        });
        var marker = new google.maps.Marker({
            position:{
                lat:27.72,
                lng:85.36

            },
            map:map,
            draggable:true

        });
        var searchBox = new google.maps.places.SearchBox(document.getElementById('searchmap'));
        var markers = [];
        // [START region_getplaces]
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
            var places = searchBox.getPlaces();

            if (places.length == 0) {
                return;
            }

            // Clear out the old markers.
            markers.forEach(function(marker) {
                marker.setMap(null);
            });
            markers = [];

            // For each place, get the icon, name and location.
            var bounds = new google.maps.LatLngBounds();
            places.forEach(function(place) {
                var icon = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25)
                };

                // Create a marker for each place.
                markers.push(new google.maps.Marker({
                    map: map,
                    icon: icon,
                    title: place.name,
                    position: place.geometry.location
                }));

                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
            });
            map.fitBounds(bounds);
        });

    </script>

