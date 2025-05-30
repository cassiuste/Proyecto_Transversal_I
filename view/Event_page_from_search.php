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
    <header>
        <div class="head">
            <a href="home.php"><img src="./img/home/logo2.png" alt="logo of eventlink" id="eventlink_logo"></a>
            <div class="left">
                <a href=""><div class="hbuttom">Search event</div></a>
                <a href=""><div class="hbuttom">City / Zip code</div></a>
                <a href=""><div class="search_img">
                    <img src="./img/home/icons8-magnifying-glass-50.png" alt="search bar">
                </div></a>
            </div>
            <div class="right">
                <?php
                    if(!empty($_SESSION["logged"])){
                        echo "<a href='createevent.php'><div class='hbuttom'>CREATE EVENT</div></a>";
    
                       if ($_SESSION['rol'] == "admin") {
                        echo "<a href='profileadmin.php'><div class='profilebtm'>";
                        
                        if (isset($_SESSION['profile_image']) && !empty($_SESSION['profile_image'])) {
                            echo "<img src='" . htmlspecialchars($_SESSION['profile_image']) . "' style='max-width: 35px; border-radius: 100%;' alt='Profile foto'>";
                        } else {
                            echo "A";
                        }
                        echo "</div></a>";
                    }        
                        else {
                                echo "<a href='profileuser.php'><div class='profilebtm'>A</div></a>";
                            }
                        }
                        else{
                            echo "<a href='signin.php'><div class='hbuttom'>SIGN IN</div></a>
                                <a href='registeruser.php'><div class='hbuttom'>SIGN UP</div></a>";
                        }
                    ?>
            </div>
        </div>
    </header>
    
    <div id="divMain">
        <div id="filterDiv">
            <h2 style="margin-left: 10px;">Filters</h2>
            <div style="margin: 10px;" id="filtro1">
                <h3>Category</h3>
                <a>Health</a><br>
                <a>Music</a><br>
                <a>Business</a><br>
                <a>Community</a><br>
                <a>View more</a><br>
            </div><br>
            <div style="margin: 10px;" id="filtro2">
                <h3>Format</h3>
                <a>Conference</a><br>
                <a>Class</a><br>
                <a>Party</a><br>
                <a>Festival</a><br>
            </div><br>
            <div style="margin: 10px;" id="filtro3">
                <h3>Price</h3>
                <a>Pay</a><br>
                <a>Free</a><br>
            </div><br>
            <div style="margin: 10px;" id="filtro4">
                <h3>Date</h3>
                <a>Today</a><br>
                <a>Tomorrow</a><br>
                <a>This week</a><br>
                <a>Open Calendar</a><br>
                <div id="calendario"></div>
            </div><br>
        </div>
        <div id="eventsDiv">
    <div id="event1" style="display: flex; align-items: flex-start; ">
        <img id="imageEvent1" src="./img/Event_page_from_search/imageEvent1.jpg" alt="Image of the Event 1">
        <div style="display: flex; flex-direction: column; margin-left: 5px;">
            <h1>Event 1</h1>
            <!-- PGS: <h3><a href="event_detail.php?id=1">Event 1</a></h3> -->
            <h3><a href="EventPage.php">See more detail</a></h3>
            <p>Location 1 | Price 1</p>
        </div>
    </div>
    
    <div id="event2" style="display: flex; align-items: flex-start;">
        <img id="imageEvent2" src="./img/Event_page_from_search/imageEvent2.jpg" alt="Image of the Event 2">
        <div style="display: flex; flex-direction: column; margin-left: 5px;">
            <h1>Event 2</h1>
            <!-- PGS: <h3><a href="event_detail.php?id=2">Event 2</a></h3> -->
            <h3><a href="EventPage.php">See more detail</a></h3>
            <p>Location 2 | Price 2</p>
        </div>
    </div>

    <div id="event3" style="display: flex; align-items: flex-start;">
        <img id="imageEvent3" src="./img/Event_page_from_search/imageEvent3.jpg" alt="Image of the Event 3">
        <div style="display: flex; flex-direction: column; margin-left: 5px;">
            <h1>Event 3</h1>
            <!-- PGS: <h3><a href="event_detail.php?id=3">Event 3</a></h3> -->
            <h3><a href="EventPage.php">See more detail</a></h3>
            <p>Location 3 | Price 3</p>
        </div>
    </div>

    <div id="event4" style="display: flex; align-items: flex-start;">
        <img id="imageEvent4" src="./img/Event_page_from_search/imageEvent4.jpg" alt="Image of the Event 4">
        <div style="display: flex; flex-direction: column; margin-left: 5px;">
            <h1>Event 4</h1>
             <!-- PGS: <h3><a href="event_detail.php?id=4">Event 4</a></h3> -->
            <h3><a href="EventPage.php">See more detail</a></h3>
            <p>Location 4 | Price 4</p>
        </div>
    </div>
</div>


        <div id="mapDiv" style="height: 97%; width: 35%;">
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

        L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        }).addTo(map);

        var eventCoords = [
        [41.4000, 2.1720],
        [41.3900, 2.1540],
        [41.3800, 2.1800],
        [41.4000, 2.2000]
        ];

        for (var i = 0; i < eventCoords.length; i++) {
        var eventMarker = L.marker(eventCoords[i]).addTo(map);
        eventMarker.bindPopup("<b>Event " + (i + 1) + "</b>");
        }
        
        
    </script>

</body>
</html>
