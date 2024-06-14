@extends('layouts.template')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css">
    <style>
        html,
        body {
            height: 100%;
            width: 100%;
        }

        #map {
            height: calc(100vh - 56px);
            width: 100% margin: 0;
        }
    </style>
@endsection

@section('content')
    <div id="map" style="width: 100vw; height: 100vh; margin: 0"></div>

    <!-- Modal Create Point -->
    <div class="modal fade" id="PointModal" tabindex="-1" aria-labelledby="PointModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="PointModalLabel">Create Point</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('store-point') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Fill point name">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="geom" class="form-label">Geometry</label>
                            <textarea class="form-control" id="geom_point" name="geom" rows="1" readonly></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image_point" name="image"
                                onchange="document.getElementById('preview-image-point').src = window.URL.createObjectURL(this.files[0])">
                        </div>
                        <div class="mb-3">
                            <img src="" alt="" id="preview-image-point" class="img-thumbnail"
                                widht="400">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Create Polyline -->
    <div class="modal fade" id="PolylineModal" tabindex="-1" aria-labelledby="PolylineModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="PolylineModalLabel">Create Polyline</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('store-polyline') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Fill point name">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="geom" class="form-label">Geometry</label>
                            <textarea class="form-control" id="geom_polyline" name="geom" rows="1" readonly></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image_polyline" name="image"
                                onchange="document.getElementById('preview-image_polyline').src = window.URL.createObjectURL(this.files[0])">
                        </div>
                        <div class="mb-3">
                            <img src="" alt="" id="preview-image_polyline" class="img-thumbnail"
                                widht="400">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Create Polygon -->
    <div class="modal fade" id="PolygonModal" tabindex="-1" aria-labelledby="PolygonModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="PolygonModalLabel">Create Polygon</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('store-polygon') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Fill point name">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="geom" class="form-label">Geometry</label>
                            <textarea class="form-control" id="geom_polygon" name="geom" rows="1" readonly></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image_polygon" name="image"
                                onchange="document.getElementById('preview-image_polygon').src = window.URL.createObjectURL(this.files[0])">
                        </div>
                        <div class="mb-3">
                            <img src="" alt="" id="preview-image_polygon" class="img-thumbnail"
                                widht="400">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
    <script src="https://unpkg.com/terraformer@1.0.7/terraformer.js"></script>
    <script src="https://unpkg.com/terraformer-wkt-parser@1.1.2/terraformer-wkt-parser.js"></script>


    <script src="https://leaflet.github.io/Leaflet.heat/dist/leaflet-heat.js"></script>


    <script>
        // Map
        var map = L.map('map').setView([-7.7956, 110.3695], 10);

        //Basemap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);




        /* Digitize Function */
        var drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems);

        var drawControl = new L.Control.Draw({
            draw: {
                position: 'topleft',
                polyline: true,
                polygon: true,
                rectangle: true,
                circle: false,
                marker: true,
                circlemarker: false
            },
            edit: false
        });

        map.addControl(drawControl);

        map.on('draw:created', function(e) {
            var type = e.layerType,
                layer = e.layer;

            console.log(type);

            var drawnJSONObject = layer.toGeoJSON();
            var objectGeometry = Terraformer.WKT.convert(drawnJSONObject.geometry);

            console.log(drawnJSONObject);
            console.log(objectGeometry);

            if (type === 'polyline') {
                $("#geom_polyline").val(objectGeometry);
                $("#PolylineModal").modal('show');
            } else if (type === 'polygon' || type === 'rectangle') {
                $("#geom_polygon").val(objectGeometry);
                $("#PolygonModal").modal('show');
            } else if (type === 'marker') {
                $("#geom_point").val(objectGeometry);
                $("#PointModal").modal('show');
            } else {
                console.log('undefined');
            }

            drawnItems.addLayer(layer);
        });

        // Create a GeoJSON layer for polygon data
        // var Jogja = L.geoJson(null, {
        //     style: function(feature) {
        //         // Adjust this function to define styles based on your polygon properties
        //         var value = feature.properties.nama; // Change this to your actual property name
        //         return {
        //             fillColor: getColor(value),
        //             weight: 2,
        //             opacity: 0,
        //             color: "red",
        //             dashArray: "3",
        //             fillOpacity: 0,
        //         };
        //     },
        //     onEachFeature: function(feature, layer) {
        //         // Adjust the popup content based on your polygon properties
        //         var content =
        //             "KABUPATEN: " +
        //             feature.properties.KABUPATEN +
        //             "<br>";

        //         layer.bindPopup(content);
        //     },
        // });

        // // Function to generate a random color //
        // function getRandomColor() {
        //     const letters = '0123456789ABCDEF';
        //     let color = '#';
        //     for (let i = 0; i < 6; i++) {
        //         color += letters[Math.floor(Math.random() * 16)];
        //     }
        //     return color;
        // }

        // // Load GeoJSON //
        // fetch('storage/geojson/Jogja.geojson')
        //     .then(response => response.json())
        //     .then(data => {
        //         L.geoJSON(data, {
        //             style: function(feature) {
        //                 return {
        //                     opacity: 1,
        //                     color: "black",
        //                     weight: 0.5,
        //                     fillOpacity: 0.5,
        //                     fillColor: getRandomColor(),
        //                 };
        //             },
        //             onEachFeature: function(feature, layer) {
        //                 var content = "Kabupaten : " + feature.properties.KABKOT;
        //                 layer.on({
        //                     click: function(e) {
        //                         // Fungsi ketika objek diklik
        //                         layer.bindPopup(content).openPopup();
        //                     },
        //                     mouseover: function(e) {
        //                         // Tidak ada perubahan warna saat mouse over
        //                         layer.bindPopup("Kabupaten : " + feature.properties.KABKOT, {
        //                             sticky: false
        //                         }).openPopup();
        //                     },
        //                     mouseout: function(e) {
        //                         // Fungsi ketika mouse keluar dari objek
        //                         layer.resetStyle(e
        //                             .target); // Mengembalikan gaya garis ke gaya awal
        //                         map.closePopup(); // Menutup popup
        //                     },
        //                 });
        //             }

        //         }).addTo(map);
        //     })
        //     .catch(error => {
        //         console.error('Error loading the GeoJSON file:', error);
        //     });
        /* GeoJSON Point */
/* GeoJSON Point */
/* GeoJSON Point */
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
        // /* GeoJSON Point */
        // var stasiun = L.geoJson(null, {
        //     onEachFeature: function(feature, layer) {
        //         var popupContent = "Name: " + feature.properties.lokasi + "<br>" ;




        //         layer.on({
        //             click: function(e) {
        //                 layer.bindPopup(popupContent).openPopup();
        //             },
        //             mouseover: function(e) {
        //                 layer.bindTooltip(feature.properties.lokasi).openTooltip();
        //             },
        //         });
        //     },
        // });

        // $.getJSON("{{ route('api.stasiun') }}", function(data) {
        //     stasiun.addData(data);
        //     map.addLayer(stasiun);
        // });


        /* GeoJSON Polyline */
        var polyline = L.geoJson(null, {
            onEachFeature: function(feature, layer) {
                var popupContent = "Name: " + feature.properties.name + "<br>" +
                    "Description: " + feature.properties.description + "<br>" +
                    "Foto: <img src='{{ asset('storage/images/') }}/" + feature.properties.image +
                    "' class='img-thumbnail' alt='...'>" + "<br>" +

                    "<div class='d-flex flex-row mt-3'>" +

                    "<form action='{{ url('delete-polyline') }}/" + feature.properties.id +
                    "' method='POST'>" +
                    '{{ csrf_field() }}' +
                    '{{ method_field('DELETE') }}' +
                    "<button type='submit' class='btn btn-danger' onClick='return confirm(\"Apakah ingin menghapus fitur ini?\")'><i class='fa-solid fa-trash-can'></i></button>" +
                    "</form>" +
                    "<a href='{{ url('edit-polyline') }}/" + feature.properties.id +
                    "' class='btn btn-warning'><i class='fa-solid fa-pen-to-square'></i></a>"
                "</form>" +
                "</div>";
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
            onEachFeature: function(feature, layer) {
                var popupContent = "Name: " + feature.properties.name + "<br>" +
                    "Description: " + feature.properties.description + "<br>" +
                    "Foto: <img src='{{ asset('storage/images/') }}/" + feature.properties.image +
                    "' class='img-thumbnail' alt='...'>" + "<br>" +

                    "<div class='d-flex flex-row mt-3'>" +

                    "<form action='{{ url('delete-polygon') }}/" + feature.properties.id + "' method='POST'>" +
                    '{{ csrf_field() }}' +
                    '{{ method_field('DELETE') }}' +
                    "<button type='submit' class='btn btn-danger' onClick='return confirm(\"Apakah ingin menghapus fitur ini?\")'><i class='fa-solid fa-trash-can'></i></button>" +
                    "</form>" +
                    "<a href='{{ url('edit-polygon') }}/" + feature.properties.id +
                    "' class='btn btn-warning'><i class='fa-solid fa-pen-to-square'></i></a>"
                "</form>" +
                "</div>";

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
        /* GeoJSON polygon */
        var tes = [];
// Fungsi untuk menentukan gaya berdasarkan nilai classes
function getStyle(feature) {
    var value = feature.properties.classes;
    var color;

    // Menentukan warna berdasarkan rentang nilai classes (nilai terkecil 9, nilai terbesar 0)
    if (value >= 8 && value <= 9) {
        color = '#ff0000'; // Merah untuk nilai tinggi
    } else if (value >= 6 && value < 8) {
        color = '#ff9900'; // Oranye untuk nilai sedang tinggi
    } else if (value >= 4 && value < 6) {
        color = '#ffff00'; // Kuning untuk nilai sedang
    } else if (value >= 2 && value < 4) {
        color = '#99cc00'; // Kuning-hijau untuk nilai sedang rendah
    } else if (value >= 0 && value < 2) {
        color = '#00cc00'; // Hijau untuk nilai rendah
    } else {
        color = '#ffffff'; // Warna default untuk nilai di luar rentang
    }

    return {
        fillColor: color,
        weight: 2,
        opacity: 1,
        color: 'white',
        dashArray: '3',
        fillOpacity: 0.7
    };
}

// Membuat layer geoJson dengan gaya dan pop-up
var idw = L.geoJson(null, {
    style: getStyle, // Menetapkan fungsi gaya
    onEachFeature: function(feature, layer) {
        var popupContent = "Name: " + feature.properties.classes + "<br>";

        layer.on({
            click: function(e) {
                idw.bindPopup(popupContent).openPopup(e.latlng);
            },
            mouseover: function(e) {
                idw.bindTooltip("ID: " + feature.id).openTooltip(e.latlng);
            }
        });
    },
});

// Mendapatkan data JSON dan menambahkannya ke peta
$.getJSON("{{ route('api.idw') }}", function(data) {
    idw.addData(data);
    map.addLayer(idw);
    tes.push(data);
});
        // var spi = L.geoJson(null, {
        //     onEachFeature: function(feature, layer) {
        //         var popupContent = "Persipitasi: " + feature.properties.grid_code + "<br>"
        //         //    ;

        //         layer.on({
        //             click: function(e) {
        //                 spi.bindPopup(popupContent);
        //             },
        //             mouseover: function(e) {
        //                 spi.bindTooltip(feature.id);
        //             },
        //         });
        //     },
        // });
        // $.getJSON("{{ route('api.spi') }}", function(data) {
        //     spi.addData(data);
        //     map.addLayer(spi);
        //     tes.push(data);
        // });
// Fungsi untuk mengubah data GeoJSON menjadi array koordinat dengan nilai intensitas yang dinormalisasi
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
    return heatmapData;
}

// Mendapatkan data JSON dan mengubahnya menjadi format heatmap
$.getJSON("{{ route('api.spi') }}", function(data) {
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

            // "SPI": spi,
        };
        L.control.layers(null, overlayMaps, { collapsed: false }).addTo(map);

            tes.push(data); // Menyimpan data jika diperlukan
        });

        // layer control
        //     var overlayMaps = {
        //     // "Point": point,
        //     // "Polyline": polyline,
        //     "Polygon": Jogja
        // };

        console.log(tes);
        //Basemap
        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            maxZoom: 19,
            attribution: 'Map data 0 <a href="https: //www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        }).addTo(map);
        var basemap1 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '<a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> | <a href="DIVSIG UGM" target="_blank">DIVSIG UGM</a>' //menambahkan nama//
        });
        var basemap2 = L.tileLayer(
            'https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{ z }/{ y }/{ x }', {
                attribution: 'Tiles &copy; Esri | <a href="WebGIS Kota Batu" target="_blank">DIVSIG UGM</a>'
            });
        var basemap3 = L.tileLayer(
            'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{ z }/{ y }/{ x }', {
                attribution: 'Tiles &copy; Esri | <a href="WebGIS Kota Batu" target="_blank">DIVSIG UGM</a>'
            });
        var basemap4 = L.tileLayer('https://tiles.stadiamaps.com/tiles/alidade_smooth_dark/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; <a href="https://stadiamaps.com/">Stadia Maps</a>, &copy; <a href="https://openmaptiles.org/">OpenMapTiles</a> &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors'
        });


        basemap1.addTo(map);

        // layer control
        var baseMaps = {
            "OpenStreetMap": basemap1,
            "Esri World Street": basemap2,
            "Esri Imagery": basemap3,
            "Stadia Dark Mode": basemap4

        };
        var overlayMaps = {
            "Stasiun Hujan": point,
            "Polyline": polyline,
            "DAS Oyo": polygon,
            // "Jogja": Jogja,
            "Daerah Curah Hujan (Isohyete)": idw,
            // "SPI": spi
        };

        var layerControl = L.control.layers(baseMaps, overlayMaps, {
            collapsed: false
        }).addTo(map);

        // var layerControl = L.control.layers(null, overlayMaps).addTo(map);



        // Watermark 2
L.Control.Watermark2 = L.Control.extend({
    onAdd: function (map) {
        var container = L.DomUtil.create("div", "leaflet-control-watermark");
        var img = L.DomUtil.create("img", "watermark-image");
        img.src = '{{ asset('storage/marker/stat.png') }}';
        img.style.width = "500px";
        img.style.marginBottom = "5px";
        container.appendChild(img);
        return container;
    },
});

L.control.watermark2 = function (opts) {
    return new L.Control.Watermark2(opts);
};

L.control.watermark2({
    position: "bottomleft"
}).addTo(map);

        // Watermark 1
L.Control.Watermark1 = L.Control.extend({
    onAdd: function (map) {
        var container = L.DomUtil.create("div", "leaflet-control-watermark");
        var img = L.DomUtil.create("img", "watermark-image");
        img.src = '{{ asset('storage/marker/legend.png') }}';
        img.style.width = "200px";
        img.style.marginBottom = "5px";
        container.appendChild(img);
        return container;
    },
});

L.control.watermark1 = function (opts) {
    return new L.Control.Watermark1(opts);
};

L.control.watermark1({
    position: "bottomleft"
}).addTo(map);


    </script>
@endsection
