@extends('layouts.template')

@section('styles')
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        #map {
            height: 100vw;
            width: 100vh;
            margin: 0;
        }
    </style>
@endsection

@section('content')
    <div id="map" style="width: 100vw; height: 100vh; margin: 0"></div>

@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
    <script src="https://unpkg.com/terraformer@1.0.7/terraformer.js"></script>
    <script src="https://unpkg.com/terraformer-wkt-parser@1.1.2/terraformer-wkt-parser.js"></script>
    <script>
        // Map
        var map = L.map('map').setView([-7.7956, 110.3695], 10);



        var Jogja = L.geoJson(null, {
            style: function(feature) {
                // Adjust this function to define styles based on your polygon properties
                var value = feature.properties.nama; // Change this to your actual property name
                return {
                    fillColor: getColor(value),
                    weight: 2,
                    opacity: 0,
                    color: "red",
                    dashArray: "3",
                    fillOpacity: 0,
                };
            },
            onEachFeature: function(feature, layer) {
                // Adjust the popup content based on your polygon properties
                var content =
                    "KABUPATEN: " +
                    feature.properties.KABUPATEN +
                    "<br>";

                layer.bindPopup(content);
            },
        });

        // Function to generate a random color //
        function getRandomColor() {
            const letters = '0123456789ABCDEF';
            let color = '#';
            for (let i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        // Load GeoJSON //
        fetch('storage/geojson/Jogja.geojson')
            .then(response => response.json())
            .then(data => {
                L.geoJSON(data, {
                    style: function(feature) {
                        return {
                            opacity: 1,
                            color: "black",
                            weight: 0.5,
                            fillOpacity: 0.5,
                            fillColor: getRandomColor(),
                        };
                    },
                    onEachFeature: function(feature, layer) {
                        var content = "Kabupaten : " + feature.properties.KABKOT;
                        layer.on({
                            click: function(e) {
                                // Fungsi ketika objek diklik
                                layer.bindPopup(content).openPopup();
                            },
                            mouseover: function(e) {
                                // Tidak ada perubahan warna saat mouse over
                                layer.bindPopup("Kabupaten : " + feature.properties.KABKOT, {
                                    sticky: false
                                }).openPopup();
                            },
                            mouseout: function(e) {
                                // Fungsi ketika mouse keluar dari objek
                                layer.resetStyle(e
                                    .target); // Mengembalikan gaya garis ke gaya awal
                                map.closePopup(); // Menutup popup
                            },
                        });
                    }

                }).addTo(map);
            })
            .catch(error => {
                console.error('Error loading the GeoJSON file:', error);
            });

        function transformToHeatmapData(data) {
            var heatmapData = [];
            var minGridCode = 0.768786; // Nilai grid_code terendah
            var maxGridCode = 2.05032;  // Nilai grid_code tertinggi

            data.features.forEach(function(feature) {
                var coordinates = feature.geometry.coordinates;
                var rawIntensity = feature.properties.grid_code;
                // Normalisasi intensitas ke rentang [0, 1]
                var normalizedIntensity = (rawIntensity - minGridCode) / (maxGridCode - minGridCode);
                heatmapData.push([coordinates[1], coordinates[0], normalizedIntensity]); // Leaflet menggunakan [lat, lng]
            });
            console.log("Heatmap Data:", heatmapData); // Tambahkan log untuk debugging
            return heatmapData;
        }

        // Mendapatkan data JSON dan mengubahnya menjadi format heatmap
        $.getJSON("{{ route('api.spis') }}", function(data) {
            console.log("Received Data:", data); // Tambahkan log untuk debugging
            var heatmapData = transformToHeatmapData(data);

            // Membuat layer heatmap dan menambahkannya ke peta
            var heat = L.heatLayer(heatmapData, {
                radius: 60, // Radius titik-titik panas
                blur: 50,   // Blur untuk efek heatmap
                maxZoom: 17, // Zoom maksimal untuk efek heatmap
                max: 1.0, // Menentukan nilai maksimal untuk intensitas setelah normalisasi
                gradient: {  // Warna ramp untuk heatmap
                    0.0: 'green',   // Hijau untuk nilai rendah
                    0.5: 'yellow',  // Kuning untuk nilai sedang
                    1.0: 'red'      // Merah untuk nilai tinggi
                }
            }).addTo(map);

            var overlayMaps = {
                "SPI": heat,
            };
            L.control.layers(null, overlayMaps, { collapsed: false }).addTo(map);
        });
        //Basemap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);


        var point = L.geoJson(null, {
    onEachFeature: function(feature, layer) {
        var popupContent = "Name: " + feature.properties.name + "<br>" +
            "Description: " + feature.properties.description + "<br>" +
            "Foto: <img src='{{ asset('storage/images/') }}/" + feature.properties.image +
            "' class='img-thumbnail' alt='...'>" + "<br>" +

            "<div class='d-flex flex-row mt-3'>" +
            "<form action='{{ url('delete-point') }}/" + feature.properties.id + "' method='POST'>" +
            '{{ csrf_field() }}' +
            '{{ method_field('DELETE') }}' +
            "<button type='submit' class='btn btn-danger' onClick='return confirm(\"Apakah ingin menghapus fitur ini?\")'><i class='fa-solid fa-trash-can'></i></button>" +
            "</form>" +
            "<a href='{{ url('edit-point') }}/" + feature.properties.id +
            "' class='btn btn-warning'><i class='fa-solid fa-pen-to-square'></i></a>" +
            "</div>";

        layer.on({
            click: function(e) {
                layer.bindPopup(popupContent).openPopup();
            },
            mouseover: function(e) {
                layer.bindTooltip(feature.properties.kab_kota).openTooltip();
            },
        });
    },
    pointToLayer: function(feature, latlng) {
        // Define custom icon
        var customIcon = L.icon({
            iconUrl: '{{ asset('storage/marker/marker.png') }}', // Use the image from feature properties
            iconSize: [32, 32], // size of the icon
            iconAnchor: [16, 32], // point of the icon which will correspond to marker's location
            popupAnchor: [0, -32] // point from which the popup should open relative to the iconAnchor
        });
        // Return a marker with the custom icon
        return L.marker(latlng, { icon: customIcon });
    }
});



        $.getJSON("{{ route('api.points') }}", function(data) {
            point.addData(data);
            map.addLayer(point);
        });

        /* GeoJSON Polyline */
        var polyline = L.geoJson(null, {
    onEachFeature: function (feature, layer) {
        var popupContent = "Name: " + feature.properties.name + "<br>" +
            "Description: " + feature.properties.description + "<br>" +
            "Foto: <img src='{{ asset('storage/images/') }}/" + feature.properties.image +
            "' class='img-thumbnail' alt='...'>" + "<br>";


                layer.on({
                    click: function(e) {
                        polyline.bindPopup(popupContent);
                    },
                    mouseover: function(e) {
                        polyline.bindTooltip(feature.properties.name);
                    },
                });
            },
        });
        $.getJSON("{{ route('api.polylines') }}", function(data) {
            polyline.addData(data);
            map.addLayer(polyline);
        });

        /* GeoJSON polygon */
        var polygon = L.geoJson(null, {
    onEachFeature: function (feature, layer) {
        var popupContent = "Name: " + feature.properties.name + "<br>" +
            "Description: " + feature.properties.description + "<br>" +
            "Foto: <img src='{{ asset('storage/images/') }}/" + feature.properties.image +
            "' class='img-thumbnail' alt='...'>" + "<br>";



                layer.on({
                    click: function(e) {
                        polygon.bindPopup(popupContent);
                    },
                    mouseover: function(e) {
                        polygon.bindTooltip(feature.properties.name);
                    },
                });
            },
        });
        $.getJSON("{{ route('api.polygons') }}", function(data) {
            polygon.addData(data);
            map.addLayer(polygon);
        });
    // layer control
// Menambahkan layer control
var overlayMaps = {
    "Stasiun Hujan": point,
    "Polyline": polyline,
    "DAS Oyo": polygon
};

// Membuat kontrol layer dan menambahkannya ke peta
var layerControl = L.control.layers(null, overlayMaps).addTo(map);

</script>
@endsection

