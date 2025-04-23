<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventLink</title>
    <link rel="stylesheet" href="css/Event_page_from_search.css">
    <link rel="stylesheet" href="css/header.css">
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
                        echo "<a href='createevent.php'><div class='buttom'>CREATE EVENT</div></a>";
                        echo "<a href='profile.php'><div class='profilebtm'>A</div></a>";
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
            <h2 style="margin-left: 3px;">Filters</h2>
            <div style="margin: 3px;" id="filtro1">
                <h3>Category</h3>
                <a>Health</a><br>
                <a>Music</a><br>
                <a>Business</a><br>
                <a>Community</a><br>
                <a>View more</a><br>
            </div><br>
            <div style="margin: 3px;" id="filtro2">
                <h3>Format</h3>
                <a>Conference</a><br>
                <a>Class</a><br>
                <a>Party</a><br>
                <a>Festival</a><br>
            </div><br>
            <div style="margin: 3px;" id="filtro3">
                <h3>Price</h3>
                <a>Pay</a><br>
                <a>Free</a><br>
            </div><br>
            <div style="margin: 3px;" id="filtro4">
                <h3>Date</h3>
                <a>Today</a><br>
                <a>Tomorrow</a><br>
                <a>This week</a><br>
                <a>Open Calendar</a><br>
                <div id="calendario"></div>
            </div><br>
        </div>
        <div id="eventsDiv">
            <div id="event1">
                <img id="imageEvent1" src="./img/Event_page_from_search/imageEvent1.jpg" alt="Image of the Event 1">
            </div>
            
            <div id="event2">
                <img id="imageEvent2" src="./img/Event_page_from_search/imageEvent2.jpg" alt="Image of the Event 2">
            </div>

            <div id="event3">
                <img id="imageEvent3" src="./img/Event_page_from_search/imageEvent3.jpg" alt="Image of the Event 3">
            </div>

            <div id="event4">
                <img id="imageEvent4" src="./img/Event_page_from_search/imageEvent4.jpg" alt="Image of the Event 4">
            </div>
        </div>
        <div id="mapDiv">
            <img id="map" src="./img/Event_page_from_search/map.jpg" alt="Image of the map">
        </div>
    </div>

    <footer id="footer">
        © 2025 EventLink - All rights reserved.
    </footer>

</body>
</html>
