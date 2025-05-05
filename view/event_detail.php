<?php
session_start();

//verificar login
if (isset($_SESSION["logged"])) {
	$username = htmlspecialchars(string: $_SESSION["username"]);
	$email = htmlspecialchars(string: $_SESSION["email"] ?? "No email available");
} else {
    header("location: signin.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Evento - EventLink</title>
    <link rel="stylesheet" href="css/event_detail.css">
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

    <div class="container">
        <aside class="filters">
            <h2>Filters</h2>
            <div class="filter-group">
                <h3>Category</h3>
                <label><input type="checkbox"> Health</label><br>
                <label><input type="checkbox"> Music</label><br>
                <label><input type="checkbox"> Business</label><br>
                <label><input type="checkbox"> Community</label><br>
                <a href="#">View more</a>
            </div>
            <div class="filter-group">
                <h3>Format</h3>
                <label><input type="checkbox"> Conference</label><br>
                <label><input type="checkbox"> Class</label><br>
                <label><input type="checkbox"> Party</label><br>
                <label><input type="checkbox"> Festival</label>
            </div>
            <div class="filter-group">
                <h3>Price</h3>
                <label><input type="checkbox"> Pay</label><br>
                <label><input type="checkbox"> Free</label>
            </div>
            <div class="filter-group">
                <h3>Date</h3>
                <label><input type="checkbox"> Today</label><br>
                <label><input type="checkbox"> Tomorrow</label><br>
                <label><input type="checkbox"> This week</label><br>
                <a href="#">Pick a date</a>
                <div id="calendario"></div> </div>
            <button class="view-more-filters">View More Filters</button>
        </aside>

        <main class="event-details">
            <div class="event-header">
                <div class="image-container">
                    <img src="./img/event_detail/event_image.jpg" alt="Image of the event">
                </div>
                <div class="static-map-container">
                <!-- Falta agregar la foto del mapa del evento -->
                    <img src="./img/event_detail/static_map_placeholder.jpg" alt="Static Map of the location">
                </div>
            </div>

            <div class="event-info">
                <h1>Título del Evento</h1>
                <p class="about">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                <p class="date">Date of the event: [Fecha]</p>
                <div class="location-info">
                    <h3>Location</h3>
                    <p class="entrance-fee">Entrance fee: [Precio]</p>
                    <button class="attend-button">Attend</button>
                </div>
                <div class="share-options">
                    <button class="share-button">Share <img src="./img/icons/share.png" alt="Share icon"></button>
                </div>
            </div>

            <section class="other-events">
                <h2>Other events you may like</h2>
                <div class="other-events-grid">
                    <div class="other-event-card">
                        <img src="./img/event_detail/related_event1.jpg" alt="Related Event 1">
                        <h3>Related Event 1</h3>
                        <p>Short description</p>
                    </div>
                    <div class="other-event-card">
                        <img src="./img/event_detail/related_event2.jpg" alt="Related Event 2">
                        <h3>Related Event 2</h3>
                        <p>Short description</p>
                    </div>
                    <div class="other-event-card">
                        <img src="./img/event_detail/related_event3.jpg" alt="Related Event 3">
                        <h3>Related Event 3</h3>
                        <p>Short description</p>
                    </div>
                </div>
            </section>
        </main>
    </div>

</body>
</html>