<?php require 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SIG Apotek di Desa Lebak, Pakis Aji - Jepara</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Leaflet CSS dari CDN -->
    <link
      rel="stylesheet"
      href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
      integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
      crossorigin=""
    />

    <style>
        body { margin:0; font-family: Arial, sans-serif; }
        header {
            background:#198754; color:#fff; padding:10px 20px;
            display:flex; justify-content:space-between; align-items:center;
        }
        header h1 { margin:0; font-size:18px; }
        header a { color:#fff; text-decoration:none; font-size:14px; }
        #map { width:100%; height: calc(100vh - 50px); }
        .leaflet-popup-content-wrapper { font-size:13px; }
    </style>
</head>
<body>
<header>
    <h1>SIG Apotek di Desa Lebak, Pakis Aji - Jepara</h1>
    <a href="admin/login.php">Login Admin</a>
</header>

<div id="map"></div>

<!-- Leaflet JS dari CDN -->
<script
  src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
  integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
  crossorigin=""
></script>

<script>
// Inisialisasi peta di sekitar Lebak Pakis Aji
var map = L.map('map').setView([-6.5740, 110.8000], 14);

// ====== Basemap ======
var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; OpenStreetMap contributors'
});

var esriStreets = L.tileLayer(
    'https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}',
    {
        maxZoom: 20,
        attribution: 'Tiles &copy; Esri &mdash; Source: Esri, HERE, Garmin, USGS, METI/NASA, NGA, GEBCO'
    }
);

var esriSatellite = L.tileLayer(
    'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}',
    {
        maxZoom: 20,
        attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
    }
);

// Layer awal
esriStreets.addTo(map);

// Kontrol pilihan layer
var baseMaps = {
    "OSM Standar": osm,
    "Jalan (Esri Streets)": esriStreets,
    "Satelit (Esri Imagery)": esriSatellite
};

L.control.layers(baseMaps, null, { position: 'topleft' }).addTo(map);

// ====== Marker dari database ======
fetch('get_apotek.php')
    .then(response => response.json())
    .then(data => {
        var group = L.featureGroup();

        data.forEach(function(item) {
            var lat = parseFloat(item.latitude);
            var lng = parseFloat(item.longitude);

            if (!isNaN(lat) && !isNaN(lng)) {
                var marker = L.marker([lat, lng]);
                var popup = `
                    <b>${item.nama_apotek}</b><br>
                    ${item.alamat}<br>
                    Desa: ${item.desa}, Kec. ${item.kecamatan}<br>
                    Telp: ${item.telepon ? item.telepon : '-'}<br>
                    Koordinat: ${lat}, ${lng}
                `;
                marker.bindPopup(popup);
                group.addLayer(marker);
            }
        });

        if (group.getLayers().length > 0) {
            group.addTo(map);
            map.fitBounds(group.getBounds().pad(0.2));
        }
    })
    .catch(err => console.error(err));
</script>
</body>
</html>
