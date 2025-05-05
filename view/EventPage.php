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

        <div style="display: flex; color: #2c2c2c; background-color: #f8f8f8;">
            <div id="mapDiv" style="height: 825px; width: 30%; background-color: #eaeaea; border-right: 2px solid #ccc;"></div>

            <div id="mainDivEventDetailed" style="padding: 40px; width: 70%;">
                <u><h1 style="font-size: 2.5em; color: #1a1a1a; margin-bottom: 20px;">Midnight Mosaic: A Surreal Night in Barcelona</h1>
                </u>
                <div id="eventDescription" style="line-height: 1.6; font-size: 1.1em;">
                    <p><strong>Date:</strong> Saturday Night<br><br>
                    <strong>Location:</strong> Gothic Quarter, Barcelona</p><br>

                    <p>Prepare to be transported into a parallel reality as the ancient, labyrinthine streets of Barcelona’s Gothic Quarter are transformed into a surreal playground of light, sound, and discovery.</p>

                    <p><em>“Midnight Mosaic”</em> isn’t just an event—it’s an invitation to awaken your senses. As night falls, glowing lanterns flicker to life, casting dancing shadows on centuries-old stone. The rhythm of live jazz floats through the air, bouncing off narrow passageways and wrapping around you like a whisper.</p>

                    <p>Each corner holds a secret: a flamenco dancer performing on a balcony above, a violinist serenading a hidden garden, a painter reimagining the city with strokes of neon color. Interactive, touch-sensitive murals pulse with life as your fingers graze them, inspired by the organic chaos of Gaudí and the dream logic of Dalí.</p>

                    <p>Embedded in the walls are cryptic QR codes—artful clues that challenge you to solve a midnight mystery. Those who follow the trail will ascend into the sky, discovering a hidden rooftop bar that serves handcrafted absinthe cocktails beneath a canopy of stars, offering panoramic views of Barcelona's twinkling skyline.</p>

                    <p>Whether you're a curious wanderer, an art lover, or a seeker of the strange and beautiful, <em>Midnight Mosaic</em> is your portal into a world that feels both timeless and wildly new.</p><br><br>

                    <p style="margin-top: 30px; font-weight: bold; font-size: 1.2em; color: #004466;">Entry is free. All you need is curiosity—and perhaps a sense of wonder.</p>
                    
                    <div style="display: flex;">
                        <button style="width:300px; height: 45px; background-color: #DFB885; cursor: pointer;"> Assist</button>
                        
                        <button style="all: unset; cursor: pointer;">
                            <img src="./img/EventPage/SaveIcon.png" style="height: 45px; width: auto;">
                        </button>
                    </div>
                    

                </div>
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
            marker.bindPopup(`<b>Midnight Mosaic: A Surreal Night in Barcelona</b>`);
        });
    </script>

</body>
</html>
