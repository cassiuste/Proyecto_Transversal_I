<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventLink</title>
    <link rel="stylesheet" href="css/Event_page_from_search.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
</head>
<body>

    <!-- Header -->
    <header>
        <div class="head">
            <a href="home.php">
                <img src="./img/home/logo2.png" alt="logo of eventlink" id="eventlink_logo">
            </a>

            <div class="left">
                <a href=""><div class="hbuttom">Search event</div></a>
                <a href=""><div class="hbuttom">City / Zip code</div></a>
                <a href="">
                    <div class="search_img">
                        <img src="./img/home/icons8-magnifying-glass-50.png" alt="search bar">
                    </div>
                </a>
            </div>

            <div class="right">
                <?php
                if (!empty($_SESSION["logged"])) {
                    echo "<a href='createevent.php'><div class='hbuttom'>CREATE EVENT</div></a>";

                    if ($_SESSION['rol'] == "admin") {
                        echo "<a href='profileadmin.php'><div class='profilebtm'>A</div></a>";
                    } else {
                        echo "<a href='profileuser.php'><div class='profilebtm'>A</div></a>";
                    }
                } else {
                    echo "
                        <a href='signin.php'><div class='hbuttom'>SIGN IN</div></a>
                        <a href='registeruser.php'><div class='hbuttom'>SIGN UP</div></a>
                    ";
                }
                ?>
            </div>
        </div>
    </header>

    <div style="display: flex;">
        <div id="mapDiv" style="height: 825px; width: 30%;"></div>

        <div id="mainDivEventDetailed">
            <h1>Event Name</h1>
        
        </div>


    </div>
 
    
    <footer id="footer">
        © 2025 EventLink - All rights reserved.
    </footer>

 
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        var barcelonaCoords = [41.3851, 2.1734];

        var map = L.map('mapDiv', {
            center: barcelonaCoords,
            zoom: 13,
            minZoom: 11,
            maxZoom: 18,
            maxBounds: [
                [41.2800, 2.0700],
                [41.4800, 2.2300]
            ],
            maxBoundsViscosity: 1.0,
            attributionControl: false
        });

        L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {}).addTo(map);

        var eventCoords = [
            [41.4000, 2.1720],
        ];

        eventCoords.forEach((coord, i) => {
            var marker = L.marker(coord).addTo(map);
            marker.bindPopup(`<b>Event ${i + 1}</b>`);
        });
    </script>

</body>
</html>
