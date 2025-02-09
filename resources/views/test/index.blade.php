<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bản đồ 5 nước Đông Nam Á</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        #map {
            height: 600px;
        }
    </style>
</head>
<body>

<h1>Bản đồ 5 nước Đông Nam Á</h1>
<div id="map"></div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    var map = L.map('map').setView([15.87, 105], 5);

    // Thêm tile layer từ OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    // Lấy dữ liệu từ API Laravel
    fetch('/api/countries')
        .then(response => response.json())
        .then(countries => {
            countries.forEach(country => {
                console.log("============== country: ", country.geojson);
                fetch(country)
                    .then(response => response.json())
                    .then(geoData => {
                        L.geoJSON(geoData, {
                            style: {
                                color: country.color,
                                weight: 2
                            }
                        })
                            .bindPopup(`<b>${country.name}</b>`)
                            .on('click', function() {
                                alert(`Bạn đã chọn: ${country.name}`);
                            })
                            .addTo(map);
                    });
            });
        });
</script>
</body>
</html>
