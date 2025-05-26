<?php
session_start();

//Controlador de eventos
require_once '../controller/EventController.php';
$event = null;
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $eventId = $_GET['id'];
    $eventController = new EventController();
    $event = $eventController->getEventById($eventId);
    if (!$event) {
        header('Location: profileuser.php?error=event_not_found');
        exit();
    }
} else {
    header('Location: profileuser.php?error=id_not_provided');
    exit();
}
?>

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
                       <a href="profileuser.php" class="parent-link">MY EVENTS</a>
                        <ul class="sub-menu">
                            <li><a href="profileuserSaved.php">Saved</a></li>
                            <li><a href="profileuserHosting.php">Hosting</a></li>
                        </ul>
                    </li>
                    <li><a href="profileuser.php">BACK</a></li>
                    <li><form action="../controller/UserController.php" method="post">
                        <input type="submit" value="LOG OUT" name="logout">
                    </form></li>
                </ul>
            </nav>
        </aside>
        <main class="event-details">
            <div class="event-header">
                <div class="image-container">
                    <img src="<?php echo htmlspecialchars($event["image_event"]); ?>" alt="Image of the event"/>
                </div>
                <div class="static-map-container">
                    <img src="<?php echo htmlspecialchars($event["location_event"]); ?>" alt="Map of the event location"/>
                </div>
            </div>
            <div class="event-info">
                <h1><?php echo htmlspecialchars($event["name_event"]); ?></h1>
                <p class="about"><?php echo nl2br(htmlspecialchars($event["description_event"])); ?></p>
                <p class="date">Date of the event: <?php echo htmlspecialchars($event["date_event"]); ?></p>
                <h4> Price: <?php echo htmlspecialchars($event["price_event"]); ?> €</h4>
                <h4> Tickets available: <?php echo htmlspecialchars($event["ticketAvailable"]); ?></h4>
                <h4> State: <?php echo htmlspecialchars($event["state_event"]); ?></h4>
            </div>
        </main>
    </div>

</body>
</html>