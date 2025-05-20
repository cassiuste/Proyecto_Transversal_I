<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Evento - EventLink</title>
    <link rel="stylesheet" href="css/event_detail_profile.css">
    <link rel="stylesheet" href="css/header.css">
</head>
<body>
<header>
        <div class="head">
            <a href="home.php"><img src="./img/home/logo2.png" alt="logo of eventlink" id="eventlink_logo"></a>
            <div class="left">
                <a href="Event_page_from_search.php"><div class="hbuttom">Search event</div></a>
                <a href="Event_page_from_search.php"><div class="hbuttom">City / Zip code</div></a>
                <a href="Event_page_from_search.php"><div class="search_img">
                <img src="./img/home/icons8-magnifying-glass-50.png" alt="search bar"></div></a>
                        
            </div>
                <div class="right">
                    <?php
                        if(!empty($_SESSION["logged"])){
                            //Solo podrá crear eventos el administrador
                           if ($_SESSION['rol'] == "admin") {
                            echo "<a href='createevent.php'><div class='hbuttom'>CREATE EVENT</div></a>";
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
        <aside class="sidebar">
            <div class="profile-info">
                <div class="profile-image"></div>
                <div class="profile-name">Nombre</div>
            </div>
            <nav class="user-nav">
                <ul>
                    <li>
                       <a href="Event_page_from_search.phpp" class="parent-link">EVENTS</a>
                        <ul class="sub-menu">
                            <li><a href="createevent.php">Edit Events</a></li>
                            <li><a href="event_detail.php">Cancel Events</a></li>
                            <li><a href="Event_page_from_search.php">Published Events</a></li>
                        </ul>
                    </li>
                    <li><a href="editProfile.php">EDIT PROFILE</a></li>
                    <li><form action="../controller/UserController.php" method="post">
                        <input type="submit" value="LOG OUT" name="logout">
                    </form></li>
                </ul>
            </nav>
        </aside>

        

        <main class="event-details">
                <?php
                //Controlador de eventos
                //name_event, date_event, price_event, ticketAvailable, image_event, description_event, location_event, state
                require_once '../controller/EventController.php';
                $eventController = new EventController();
                $events = $eventController->read();
                if (!empty($events)) {
                    foreach ($events as $event) {
                        echo "<div class='event-header'>";
                        echo "  <div class='image-container'>";
                        echo "    <img src='" . $event["image_event"] . "' alt='Image of the event'/>";
                        echo "    <p><a href='https://feverup.com/m/125199?_gl=1*10a9o3y*_up*MQ..*_ga*NzU2OTUwMzAuMTc0MjQ3MTQ4Ng..*_ga_L4M4ND4NG4*MTc0MjQ3MTQ4NS4xLjAuMTc0MjQ3MTQ4NS4wLjAuMTYyODQ2MDk3' target='_blank'>Más información</a></p>";
                        echo "  </div>";
                        echo "  <div class='static-map-container'>";
                        echo "    <img src='" . $event["location_event"] . "'alt='Image of the event'/>";
                        echo "    <p><a href='https://www.google.com/search?q=Carrer+d%27Aribau%2C+133%2C+Barcelona%2C+Barcelona%2C+08036&oq=Carrer+d%27Aribau%2C+133%2C+Barcelona%2C+Barcelona%2C+08036&gs_lcrp=EgZjaHJvbWUyBggAEEUYOdIBBzIyMmowajSoAgCwAgE&sourceid=chrome&ie=UTF-8' target='_blank'>Ver en Google Maps</a></p>";
                        echo "  </div>";
                        echo "</div>";
                        echo "<div class='event-info'>";
                        echo "  <h1>" . $event["name_event"] . "</h1>";
                        echo "  <p class='about'>" . $event["description_event"] . "</p>";
                        echo "  <p class='date'>Date of the event: " . $event["date_event"] . "</p>";
                        echo "  <h4> Price: "  . $event["price_event"] . " €</h4>";
                        echo "  <h4> State: "  . $event["state"] . "</h4>";
                        echo "  <a href='https://feverup.com/m/125199?_gl=1*10a9o3y*_up*MQ..*_ga*NzU2OTUwMzAuMTc0MjQ3MTQ4Ng..*_ga_L4M4ND4NG4*MTc0MjQ3MTQ4NS4xLjAuMTc0MjQ3MTQ4NS4wLjAuMTYyODQ2MDk3'></a>"; //Pendiente de hacer
                        echo "</div>";
                    }
                }
                ?>
        </main>
    </div>

</body>
</html>