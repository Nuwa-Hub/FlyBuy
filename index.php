<php php echo 'Hello Hello i\' m under the water... gulu gulu gulu gulu'; <div class="mapouter">
    <!-- <div class="gmap_canvas"><iframe width="600" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=2880%20Broadway,%20New%20York&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://getasearch.com"></a><br>
        <style>
            .mapouter {
                position: relative;
                text-align: right;
                height: 500px;
                width: 600px;
            }
        </style><a href="https://www.embedgooglemap.net">using google maps on website</a>
        <style>
            .gmap_canvas {
                overflow: hidden;
                background: none !important;
                height: 500px;
                width: 600px;
            }
        </style>
    </div>
    </div> -->


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>La Tarte Aux Crésors "Beta"</title>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
    "use strict";

    var ignKey = "ljozkgwvms60dtumhx67z6u3"

    function makeIGNMapType(layer, name, maxZoom) {
        return new google.maps.ImageMapType({
            getTileUrl: function(coord, zoom) {
                return "http://gpp3-wxs.ign.fr/" + ignKey + "/geoportail/wmts?LAYER=" +
                    layer +
                    "&EXCEPTIONS=text/xml&FORMAT=image/jpeg&SERVICE=WMTS&VERSION=1.0.0" +
                    "&REQUEST=GetTile&STYLE=normal&TILEMATRIXSET=PM&TILEMATRIX=" +
                    zoom + "&TILEROW=" + coord.y + "&TILECOL=" + coord.x;
            },
            tileSize: new google.maps.Size(256,256),
            name: name,
            maxZoom: maxZoom
        });
    }

    function initialize() {
        var map_canvas = document.getElementById("map_canvas");

        var map = new google.maps.Map(map_canvas, {
            mapTypeId: 'IGN',
            scaleControl: true,
            streetViewControl: true,
            panControl: true,
            mapTypeControl:true,
            overviewMapControl: true,
            overviewMapControlOptions: {
opened: true,
position: google.maps.ControlPosition.BOTTOM_CENTER 
},


            mapTypeControlOptions: {
            mapTypeIds: [
                    'IGN', 'IGNScanExpress',
                    google.maps.MapTypeId.SATELLITE, google.maps.MapTypeId.TERRAIN, google.maps.MapTypeId.HYBRID, google.maps.MapTypeId.ROADMAP],
                style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR
            },
            center: new google.maps.LatLng(47, 3),
            zoom: 6,
            draggableCursor: "crosshair"
        });

        map.mapTypes.set('IGN', makeIGNMapType("GEOGRAPHICALGRIDSYSTEMS.MAPS", "IGN", 18));
        map.mapTypes.set('IGNScanExpress', makeIGNMapType("GEOGRAPHICALGRIDSYSTEMS.MAPS.SCAN-EXPRESS.CLASSIQUE", "IGN Scan Express", 16));


  // Create the search box and link it to the UI element.
  var input = /** @type {HTMLInputElement} */(
      document.getElementById('pac-input'));
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

  var searchBox = new google.maps.places.SearchBox(
    /** @type {HTMLInputElement} */(input));

  // Listen for the event fired when the user selects an item from the
  // pick list. Retrieve the matching places for that item.
  google.maps.event.addListener(searchBox, 'places_changed', function() {
    var places = searchBox.getPlaces();

    for (var i = 0, marker; marker = markers[i]; i++) {
      marker.setMap(null);
    }

    // For each place, get the icon, place name, and location.
    markers = [];
    var bounds = new google.maps.LatLngBounds();
    for (var i = 0, place; place = places[i]; i++) {
      var image = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25)
      };

      // Create a marker for each place.
      var marker = new google.maps.Marker({
        map: map,
        icon: image,
        title: place.name,
        position: place.geometry.location
      });

      markers.push(marker);

      bounds.extend(place.geometry.location);
    }

    map.fitBounds(bounds);
  });

  // Bias the SearchBox results towards places that are within the bounds of the
  // current map's viewport.
  google.maps.event.addListener(map, 'bounds_changed', function() {
    var bounds = map.getBounds();
    searchBox.setBounds(bounds);
  });
}

    google.maps.event.addDomListener(window, 'load', initialize);
</script>

<style>
html, body, #map_canvas {
    width: 100%;
    height: 100%;
    margin: 0;
    padding: 0;
    position: absolute;
    left: 0;
    top: 0;
    z-index: 0;
}
</style>
</head>

<body>
  <div id="map_canvas"></div>
</body>
</html>




    ?>