<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Maps Demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
  <body>
    <div class="container">
        <div class="row">
        <div class="col-md-6">
            <div id="map" style="width: 600px; height: 400px;"></div>
        </div>
        <div class="col-md-6">
            <h3 class="text-center">Input Data Delivery Zone</h3>
            <form action="{{route('zona.store')}}" method="post">
                @csrf
                <div class="form-group mb-2">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Name" required>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Delivery Fee</label>
                    <input type="text" class="form-control" name="delivery_fee" required>
                  </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Zone Coordinates</label>
                    <textarea class="form-control" rows="4" name="zone_coordinates" required readonly>
                    </textarea>
                  </div>
                <button type="submit">Save</button>
            </form>
        </div>
    </div>
    </div>

    {{-- leaflet --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    {{-- leaflet Draw --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>

    {{-- Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>



    {{-- script Maps --}}
    <script>
        var peta1 = L.tileLayer('http://www.google.cn/maps/vt?lyrs=s@189&gl=cn&x={x}&y={y}&z={z}', {
                attribution: 'google'
            });

        var peta2 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            });

        const map = L.map('map', {
            center: [-7.257221472743715, 112.75834095184003],
            zoom:12,
            layers: [peta2]
        });

        const baseLayers = {
            "Satelite": peta1,
            "Streets" : peta2
        };

        L.control.layers(baseLayers).addTo(map);


    // FeatureGroup is to store editable layers
     var drawnItems = new L.FeatureGroup();
     map.addLayer(drawnItems);

     var drawControl = new L.Control.Draw({
        draw: {
             polygon: true,
             marker: false,
             circle: false,
             rectangle: false,
             circlemarker: false,
             polyline: false,
         },
         edit: {
             featureGroup: drawnItems
         }
     });
     map.addControl(drawControl);

    //  create Coordinate Polygone
     map.on('draw:created', function (event) {
    var layer = event.layer;
    var feature = layer.feature = layer.feature || {};
    feature.type = feature.type || "Feature";
    var props = feature.properties = feature.properties || {};
    drawnItems.addLayer(layer);
    $("[name=zone_coordinates]").val(JSON.stringify(drawnItems.toGeoJSON()));
    });

    // edit draw
    map.on('draw:edited', function (e) {
        $("[name=zone_coordinates]").val(JSON.stringify(drawnItems.toGeoJSON()));
     });

    // edit draw
    map.on('draw:deleted', function (e) {
        $("[name=zone_coordinates]").val(JSON.stringify(drawnItems.toGeoJSON()));
     });


    </script>
</body>
</html>
