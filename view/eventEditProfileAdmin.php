<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Solo puede editar eventos el usuario con rol admin
    if (empty($_SESSION["logged"]) || $_SESSION['rol'] != "admin") {
        $_SESSION['error_message'] = "Acceso no autorizado";
        header("Location: signin.php");
        exit;
    }

    // Controlador de eventos
    require_once '../controller/EventController.php';
    
    $eventData = null; // Inicializa la variable donde almacenamos los datos del evento

    // Usamos GET para obtener el ID del evento que queremos editar
    if (isset($_GET['idEvent'])) {
        $idEvent = $_GET['idEvent'];
        $eventController = new EventController();
        // Para obtener un solo evento se ha creado la función getEventById en el controlador de eventos
        $eventData = $eventController->getEventById($idEvent); 

        if (!$eventData) {
            $_SESSION['error_message'] = "Evento no encontrado.";
            header("Location: profileadmin.php"); // Redirige a la lista de eventos
            exit;
        }
    } else {
        $_SESSION['error_message'] = "ID de evento no especificado para editar.";
        header("Location: profileadmin.php"); // Redirige si no hay ID
        exit;
    }


    // se deja en blanco la fecha y hora
    $eventDateFormatted = date('Y-m-d', strtotime($eventData['date_event']));
    $eventTimeFormatted = date('H:i', strtotime($eventData['date_event']));
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Evento - EventLink</title>
    <link rel="stylesheet" href="../view/css/header.css">
    <link rel="stylesheet" href="../view/css/event_edit_form.css">
</head>
<body>
    <header>
        <div class="head">
            <a href="home.php"><img src="./img/home/logo2.png" alt="logo de eventlink" id="eventlink_logo"></a>
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
                                echo "<img src='" . htmlspecialchars($_SESSION['profile_image']) . "' style='max-width: 35px; border-radius: 100%;' alt='Foto de perfil'>";
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

        <main class="event-details">
            <h1>Editar Evento</h1>
            <form action="../controller/EventController.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="idEvent" value="<?php echo htmlspecialchars($eventData['idEvent']); ?>">
                <input type="hidden" name="current_event_image" value="<?php echo htmlspecialchars($eventData['image_event']); ?>">
                <input type="hidden" name="current_location_image" value="<?php echo htmlspecialchars($eventData['location_event']); ?>">
                
                <div class="event-header">
                    <div class="image-container">
                        <label>Imagen del Evento Actual:</label>
                        <img src="<?php echo htmlspecialchars($eventData['image_event']); ?>" alt="Imagen del evento" id="event_image_preview">
                        <label for="event_image_input">Cambiar imagen del evento:</label>
                        <input type="file" name="event_image" id="event_image_input" accept="image/*">
                    </div>
                    <div class="static-map-container">
                        <label>Imagen/URL de Ubicación Actual:</label>
                        <img src="<?php echo htmlspecialchars($eventData['location_event']); ?>" alt="Mapa del evento" id="location_image_preview">
                        <label for="location_image_input">Subir nueva imagen de ubicación:</label>
                        <input type="file" name="location_image" id="location_image_input" accept="image/*">
                    </div>

                <label for="name">Nombre del Evento:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($eventData['name_event']); ?>" required>

                <label for="description">Descripción:</label>
                <textarea id="description" name="description" rows="6" required><?php echo htmlspecialchars($eventData['description_event']); ?></textarea>

                <label for="date">Fecha del Evento:</label>
                <input type="date" id="date" name="date" value="<?php echo htmlspecialchars($eventDateFormatted); ?>" required>

                <label for="start-time">Hora del Evento:</label>
                <input type="time" id="start-time" name="start-time" value="<?php echo htmlspecialchars($eventTimeFormatted); ?>" required>

                <label for="price">Precio:</label>
                <input type="number" id="price" name="price" step="0.01" value="<?php echo htmlspecialchars($eventData['price_event']); ?>" required>

                <label for="capacity">Capacidad de Entradas:</label>
                <input type="number" id="capacity" name="capacity" value="<?php echo htmlspecialchars($eventData['ticketAvailable']); ?>" required>

                <label for="state">Estado:</label>
                <select id="state" name="state" required>
                    <option value="Active" <?php echo ($eventData['state'] == 'Active') ? 'selected' : ''; ?>>Activo</option>
                    <option value="Cancelled" <?php echo ($eventData['state'] == 'Cancelled') ? 'selected' : ''; ?>>Cancelado</option>
                    <option value="Postponed" <?php echo ($eventData['state'] == 'Postponed') ? 'selected' : ''; ?>>Pospuesto</option>
                    <option value="Completed" <?php echo ($eventData['state'] == 'Completed') ? 'selected' : ''; ?>>Completado</option>
                </select>
                
                <button type="submit" name="update_event">Actualizar Evento</button>
                <button type="button" class="cancel-button" onclick="window.location.href='profileadmin.php'">Volver a la Lista</button>
            </form>
        </main>
    </div>
</body>
</html>