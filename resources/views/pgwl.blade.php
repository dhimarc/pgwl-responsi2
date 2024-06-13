<!DOCTYPE html>
<html>
<head>
    <title>Peta Persebaran Warmindo (using Leaflet)</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
    <style>
        #map {
            height: 1000px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Navbar</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Features</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Pricing</a>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled" aria-disabled="true">Disabled</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    <div id="map"></div>

    <button id="zoom-out">Zoom out</button>
    <button id="zoom-in">Zoom in</button>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var map = L.map('map').setView([-7.770160247217438, 110.37787055399761], 13); // Koordinat dan level zoom awal

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);



        var circle = L.circle([-7.770160247217438, 110.37787055399761], {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5,
            radius: 6000
        }).addTo(map);

        var polygon = L.polygon([
                [-7.759951183982096, 110.39569310542711],
                [-7.772216851577317, 110.36548726905987],
                [-7.797617690382818, 110.38058711060637],
                [-7.756141206342159, 110.37741786673021],
                [-7.764368565140517, 110.38742600508955]
        ]).addTo(map);

        // Array Marker
        var locations = [
                ["Warmindo Berkah", -7.759951183982096, 110.39569310542711],
                ["Warmindo Tiga Sekawan", -7.772216851577317, 110.36548726905987],
                ["Warmindo Maharasa", -7.797617690382818, 110.38058711060637],
                ["Warmindo Malatax", -7.756141206342159, 110.37741786673021],
                ["Warmindo Motekar 19", -7.764368565140517, 110.38742600508955],
            ];
            for (var i = 0; i < locations.length; i++) {
                marker = new L.marker([locations[i][1], locations[i][2]])
                .bindPopup(locations[i][0])
                .addTo(map);
            }



        circle.bindPopup("Radius");
        polygon.bindPopup("Polygon");

        function onMapClick(e) {
            alert("Tempat yang anda pilih memiliki koordinat " + e.latlng);
        }

        map.on('click', onMapClick);

        document.getElementById('zoom-out').addEventListener('click', function () {
            map.zoomOut();
        });

        document.getElementById('zoom-in').addEventListener('click', function () {
            map.zoomIn();
        });

        function onMapClick(e) {
            alert("Tempat yang anda pilih memiliki koordinat " + e.latlng);
        }
    </script>
</body>
</html>
