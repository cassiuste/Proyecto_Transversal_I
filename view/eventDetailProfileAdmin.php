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
            <div class="event-header">
                <div class="image-container">
                    <img src="../view/img/profile/cataVinos_profile.jpg" alt="Image of the event">
                    <p><a href="https://feverup.com/m/125199?_gl=1*10a9o3y*_up*MQ..*_ga*NzU2OTUwMzAuMTc0MjQ3MTQ4Ng..*_ga_L4M4ND4NG4*MTc0MjQ3MTQ4NS4xLjAuMTc0MjQ3MTQ4NS4wLjAuMTYyODQ2MDk3" target="_blank">Más información</a></p>
                </div>
                <div class="static-map-container">
                    <img src="./img/profile/Event1_map.png" alt="Static map Event1">
                    <p><a href="https://www.google.com/search?q=Carrer+d%27Aribau%2C+133%2C+Barcelona%2C+Barcelona%2C+08036&oq=Carrer+d%27Aribau%2C+133%2C+Barcelona%2C+Barcelona%2C+08036&gs_lcrp=EgZjaHJvbWUyBggAEEUYOdIBBzIyMmowajSoAgCwAgE&sourceid=chrome&ie=UTF-8" target="_blank">Ver en Google Maps</a></p>
                </div>
            </div>

            <div class="event-info">
                <h1>Cata de vinos en Jardinet d'Aribau, Barcelona</h1>
                <p class="about">
                En el centro de Barcelona se encuentra este restaurante que parece sacado de un cuento.
                Ven a su encantador jardín a disfrutar de una sugerente cata de vinos y, si lo deseas, de una tabla de quesos. 
                ¿Levantamos las copas por una experiencia más que deliciosa? ¡Disfruta de tu plan de cata de vinos en Jardinet d'Aribau, Barcelona!
                </p>
                <p class="date">Date of the event: 30/11/2025</p>
            </div>
            <button type="button">Cancelar</button>
            <section class="other-events">
                <h2>Other events you may like</h2>
                <div class="other-events-grid">
                    <div class="other-event-card">
                        <img src="./img/profile/e2_velero_profile.jpg" alt="Detail Event 2">
                        <h3>Event 2</h3>
                        <p>Short description</p>
                    </div>
                    <div class="other-event-card">
                        <img src="./img/profile/event3_profile.jpg" alt="Detail Event 3">
                        <h3>Event 3</h3>
                        <p>Short description</p>
                    </div>
                    <div class="other-event-card">
                        <img src="./img/profile/event3_profile.jpg" alt="Detail Event 4">
                        <h3>Event 4</h3>
                        <p>Short description</p>
                    </div>
                </div>
            </section>
        </main>
    </div>

</body>
</html>