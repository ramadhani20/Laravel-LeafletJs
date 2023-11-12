<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Map with Polygons</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map {
            width: 100%;
            height: 90vh;
        }
    </style>
</head>
<body>
    <div id="map"></div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        var peta1 = L.tileLayer('http://www.google.cn/maps/vt?lyrs=s@189&gl=cn&x={x}&y={y}&z={z}', {
            attribution: 'google'
        });

        var peta2 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        });

        var map = L.map('map', {
            layers: [peta2],  // Default layer
        }).setView([-7.257221472743715, 112.75834095184003], 14);

        var baseLayers = {
            "Satelite": peta1,
            "Streets": peta2
        };

        L.control.layers(baseLayers).addTo(map);

        @foreach($data as $polygon)
            var geoJSON = {!! $polygon->zone_coordinates !!};
            var name = {!! json_encode($polygon->name) !!};
            var deliveryFee = {!! json_encode($polygon->delivery_fee) !!};

            // Use the selected tile layer for each polygon
            var tileLayer = {!! json_encode($polygon->tile_layer) !!};
            var layer;
            if (tileLayer === 'peta1') {
                layer = L.geoJSON(geoJSON, { attribution: 'google' });
            } else {
                layer = L.geoJSON(geoJSON, { attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors' });
            }

            // Add the layer to the map
            layer.addTo(map);

            // Create a popup content string
            var popupContent = "<b>Name:</b> " + name + "<br><b>Delivery Fee:</b> " + deliveryFee;

            // Bind the popup to the layer
            layer.bindPopup(popupContent);
        @endforeach
    </script>
</body>
</html>
