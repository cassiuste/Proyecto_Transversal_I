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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="../view/css/profile_style.css">
    <link rel="stylesheet" href="./css/header.css">
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
                            if ($_SESSION['rol'] == "admin") {
                                echo "<a href='createevent.php'><div class='hbuttom'>CREATE EVENT</div></a>";
                                echo "<a href='profileadmin.php'><div class='profilebtm'>A</div></a>";
                            } else {
                                echo "<a href='profileuser.php'><div class='profilebtm'>A</div></a>";
                            }                                
                        }

                    ?>
                </div>
        </div>
    </header>

    <div class="container">
        <aside class="sidebar">
            <div class="profile-info">
                <div class="profile-image">
                </div>
                <div class="profile-name">Nombre</div>
            </div>
            <nav class="user-nav">
                <ul>
                    <li>
                       <a href="profileuser.php" class="parent-link">MY EVENTS</a>
                        <ul class="sub-menu">
                            <li><a href="profileuserSaved.php">Saved</a></li>
                            <li><a href="profileuserHosting.php">Hosting</a></li>
                        </ul>
                    </li>
                    <li><form action="../controller/UserController.php" method="post">
                        <input type="submit" value="LOG OUT" name="logout" 
                            style="background-color: transparent; 
                                    border: 2px solid #DFB885; 
                                    color: #DFB885; 
                                    border-radius: 25px; 
                                    padding: 10px 20px; 
                                    cursor: pointer;">
                    </form></li><br>
                    <li><form action="../controller/UserController.php" method="post">
                    <input type="submit" value="DELETE ACCOUNT" name="delete_account"
                            style="background-color: transparent; 
                                    border: 2px solid #DFB885; 
                                    color: #DFB885; 
                                    border-radius: 25px; 
                                    padding: 10px 20px; 
                                    cursor: pointer;">
                    </form></li>
                </ul>
            </nav>
        </aside>

        <main class="content">
            <h2>YOUR EVENTS</h2>
            <div class="event-grid">

                <?php
                //Controlador de eventos
                //name_event, date_event, price_event, ticketAvailable, image_event, description_event, location_event, state
                require_once '../controller/EventController.php';
                $eventController = new EventController();
                $events = $eventController->read();
                if (!empty($events)) {
                    foreach ($events as $event) {
                        echo "<div class='event'>";
                        echo "  <div class='event-image'>";
                        echo "    <img src='" . $event["image_event"] . "' alt='Event profile'/>";
                        //echo "    <img src='../view/img/profile/cataVinos_profile.jpg' alt='Event profile'/>"; //Pendiente de hacer
                        echo "  </div>";
                        echo "    <h3>" . $event["name_event"] . "</h3>";
                        echo "    <h4>" . $event["date_event"] . "</h2>";
                        echo "    <h4> Price: "  . $event["price_event"] . " €</h2>";
                        echo "  <h3><a href='eventDetailProfile.php?id=1'>See more detail</a></h3>";
                        echo "  <a href='https://feverup.com/m/125199?_gl=1*10a9o3y*_up*MQ..*_ga*NzU2OTUwMzAuMTc0MjQ3MTQ4Ng..*_ga_L4M4ND4NG4*MTc0MjQ3MTQ4NS4xLjAuMTc0MjQ3MTQ4NS4wLjAuMTYyODQ2MDk3'></a>"; //Pendiente de hacer
                        echo "</div>";
                    }
                }
                ?>

                <!--<div class="event">
                    <div class="event-image">
                        <img  src="../view/img/profile/cataVinos_profile.jpg" alt="Event1 profile"/>
                    </div>
                       
                    <h3>EVENT 1</h3>
                    <p>Picture 1: It shows a wine tasting in the "Jardinet d'Aribau"</p>
                    <h3><a href="eventDetailProfile.php?id=1">See more detail</a></h3>
                    <a href="https://feverup.com/m/125199?_gl=1*10a9o3y*_up*MQ..*_ga*NzU2OTUwMzAuMTc0MjQ3MTQ4Ng..*_ga_L4M4ND4NG4*MTc0MjQ3MTQ4NS4xLjAuMTc0MjQ3MTQ4NS4wLjAuMTYyODQ2MDk3"></a>                  


                </div>                
                <div class="event">                    
                    <div class="event-image">
                        <img  src="../view/img/profile/e2_velero_profile.jpg" alt="Event2 profile"/>
                    </div>
                    
                    <h3>EVENT 2</h3>
                    <p>Picture 2: It shows an sailboat experience Barcelona: 90 minuts plus Vermouth</p>
                    <h3><a href="eventDetailProfile.php?id=2">See more detail</a></h3>
                    <a href="https://feverup.com/m/141663?_gl=1*irlico*_up*MQ..*_ga*NzU2OTUwMzAuMTc0MjQ3MTQ4Ng..*_ga_L4M4ND4NG4*MTc0MjQ3MTQ4NS4xLjAuMTc0MjQ3MTQ4NS4wLjAuMTYyODQ2MDk3"></a>
                </div>                    
                <div class="event">
                    <div class="event-image">
                        <img  src="../view/img/profile/event3_profile.jpg" alt="Event3 profile"/>
                    </div>
                    
                    <h3>EVENT 3</h3>
                    <p>Picture 3: It shows Barcelona night Bike Tour with tapas and cava</p>
                    <h3><a href="eventDetailProfile.php?id=3">See more detail</a></h3>
                    <a href="https://feverup.com/m/312210?_gl=1*1hkz0u0*_up*MQ..*_ga*NzgwMDg3ODk5LjE3NDM1ODg4MjA.*_ga_L4M4ND4NG4*MTc0MzU4ODgxOC4xLjAuMTc0MzU4ODgxOC4wLjAuMTkxNDk4MTUwNw.."></a>                
                </div>                    
                <div class="event">                    
                    <div class="event-image">
                        <img  src="../view/img/profile/event3_profile.jpg" alt="Event4 profile"/>
                    </div>
                    
                    <h3>EVENT 4</h3>
                    <p>Picture 4: It shows Barcelona night Bike Tour with tapas and cava</p>
                    <h3><a href="eventDetailProfile.php?id=4">See more detail</a></h3>
                    <a href="https://feverup.com/m/312210?_gl=1*1hkz0u0*_up*MQ..*_ga*NzgwMDg3ODk5LjE3NDM1ODg4MjA.*_ga_L4M4ND4NG4*MTc0MzU4ODgxOC4xLjAuMTc0MzU4ODgxOC4wLjAuMTkxNDk4MTUwNw.."></a>                
                </div>
                --> 

            </div>
        </main>
    </div>
    <script src="index.js"></script>
</body>
</html>