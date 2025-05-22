<?php
session_start();

//verificar login
if (isset($_SESSION["logged"])) {
    if ($_SESSION['rol'] == "admin") {
        $username = htmlspecialchars(string: $_SESSION["username"]);
        $email = htmlspecialchars(string: $_SESSION["email"] ?? "No email available");
    } else {
        header("location: access_denied.php");
        exit;
    }
} else {
    header("location: signin.php");
    exit;
}

//Añadimos código para el botón editar cada evento:
require_once '../controller/EventController.php'; // Para llamar al controlador de eventos
$eventController = new EventController();
$events = $eventController->read(); // Usaremos del EventController el método read() que devuelve todos los eventos

// Mensajes de sesión
$success_message = '';
$error_message = '';
if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}
if (isset($_SESSION['error_message'])) {
    $error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}

?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de admin</title>
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
                        if (!empty($_SESSION["logged"])) {
                        if ($_SESSION['rol'] == "admin") {
                            echo "<a href='createevent.php'><div class='hbuttom'>CREATE EVENT</div></a>";
                            echo "<a href='profileadmin.php'><div class='profilebtm'>";
                            if (isset($_SESSION['profile_image']) && !empty($_SESSION['profile_image'])) {
                                echo "<img src='" . htmlspecialchars($_SESSION['profile_image']) . "' style='width: 50px; border-radius: 100%;' alt='Profile foto'>";
                            } else {
                                echo "A";
                            }
                            echo "</div></a>";
                        } else {
                            echo "<a href='profileuser.php'><div class='profilebtm'>A</div></a>";
                        }
                    } else {
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
            <div class="profile-image">
                <img src="<?php echo htmlspecialchars($_SESSION['profile_image']); ?>" alt="Image of Admin" style="width: 70px; height: 70px; border-radius: 100%;">
            </div>
                <div class="profile-name">Nombre</div>
            </div>
            <nav class="user-nav">
                <ul>
                    <li><a href="editProfile.php">EDIT PROFILE</a></li>
                    <li><form action="../controller/UserController.php" method="post">
                        <input type="submit" value="LOG OUT" name="logout">
                    </form></li><br>
                    <li><form action="../controller/UserController.php" method="post">
                        <input type="submit" value="DELETE ACCOUNT" name="delete_account">
                    </form></li>
                </ul>
            </nav>
        </aside>

        <main class="content">
            <h2>YOUR EVENTS</h2>
            <div class="event-grid">
                <?php
                //Controlador de eventos
                require_once '../controller/EventController.php';
                $eventController = new EventController();
                $events = $eventController->read();
                if (!empty($events)) {
                    foreach ($events as $event) {
                        echo "<div class='event'>";
                        echo "  <div class='event-image'>";
                        echo "    <img src='" . $event["image_event"] . "' alt='Event profile'/>";
                        echo "  </div>";
                        echo "  <div>";
                        echo "    <h3>" . $event["name_event"] . "</h3>";
                        echo "    <h4>" . $event["date_event"] . "</h2>";
                        echo "    <h4> Price: "  . $event["price_event"] . " €</h2>";
                        echo "  </div>";
                        //echo "  <h3><a href='eventDetailProfile.php?id=1'>See more detail</a></h3>";
                        echo " <h3><a href='eventDetailProfileAdmin.php?id=" . htmlspecialchars($event['idEvent']) . "'>See more detail</a></h3>";

                        // Botones de acción para EDITAR y ELIMINAR añadidos:
                        echo "  <div class='actions-buttons'>";                        
                        echo "    <a href='../view/eventEditProfileAdmin.php?idEvent=" . htmlspecialchars($event['idEvent']) . "' class='edit-button'>Edit</a>";

                        // Botón de ELIMINAR: Un formulario para enviar una solicitud POST al controlador para eliminar
                        echo "    <form action='../controller/EventController.php' method='post' style='display:inline;'>";
                        echo "      <input type='hidden' name='idEvent' value='" . htmlspecialchars($event['idEvent']) . "'>";
                        echo "      <input type='submit' name='delete_event' value='delete' class='delete-button' onclick='return confirm(\"¿Estás seguro de que quieres eliminar este evento?\");'>";
                        echo "    </form>";
                        echo "  </div>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No hay eventos creados.</p>";
                }
                ?>
            </div>
        </main>
    </div>
</body>
</html>