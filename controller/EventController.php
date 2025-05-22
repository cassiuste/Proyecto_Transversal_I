<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $event = new EventController();
    
    if(isset($_POST["create"])){
        echo "<p>Create button is clicked. </p>";
        $event->create();
    }
    if(isset($_POST["read"])){
        echo "<p>Read button is clicked. </p>";
        $event->read();
    }
    if(isset($_POST["update"])){
        echo "<p>Update button is clicked. </p>";
        $event->update();
    }
    if(isset($_POST["delete"])){
        echo "<p>Delete button is clicked. </p>";
        $event->delete();
    }
}

class EventController{

    private $conn;

    public function __construct() {

        // Base de datos a cambiar cuando tengamos la definitiva
        $servername = "localhost";
        $database = "eventlink";
        $username = "root";
        $password = "";

        // Create connection
        try{
            $this->conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
          }

    }
        
    public function create() : void {
            
            $eventName = htmlspecialchars($_POST["name"]);
            $description = htmlspecialchars($_POST["description"]);
            $date = htmlspecialchars($_POST["date"]);
            $startTime = htmlspecialchars($_POST["start-time"]);
            $datetime = $date . ' ' . $startTime . ':00';
            $location = htmlspecialchars($_POST["location"]);
            $price = htmlspecialchars($_POST["price"]);
            $capacity = htmlspecialchars($_POST["capacity"]);


            // solo se puede seleccionar una fecha igual o mayor a la de hoy
            $today = new DateTime(); 
            $today->setTime(0, 0, 0);
            $eventDate = DateTime::createFromFormat('Y-m-d', $date);
            if ($eventDate < $today) {
                $_SESSION['error_message'] = "The selected date cannot be in the past.";
                header("Location: ../view/createevent.php");
                exit;
            }


            $destination = null;
            if (isset($_FILES['event_image']) && $_FILES['event_image']['error'] === UPLOAD_ERR_OK) {
                $file_name = $_FILES['event_image']['name'];
                $file_tmp = $_FILES['event_image']['tmp_name'];
                $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
                $allowed_ext = array('jpg', 'jpeg', 'png', 'gif');   
                $subfolder = '../view/img/event/';
                $new_file_name = uniqid() . '.' . $file_ext;
                $destination = $subfolder . $new_file_name;
                
                if (in_array($file_ext, $allowed_ext)) {
                    move_uploaded_file($file_tmp, $destination);
                    $_SESSION['success_message'] = 'Image uploaded correctly.';
                    } else {
                    $_SESSION['error_message'] = 'Invalid format.';
                    header("location: ../view/createevent.php");
                    exit;
                    }
            } else if (isset($_FILES['event_image']) && $_FILES['event_image']['error'] !== UPLOAD_ERR_NO_FILE) {
                $_SESSION['error_message'] = 'Error uploading the image.';
            }
    

            try{
                if($_SESSION['rol'] == "admin"){
                    $stmt = $this->conn->prepare("INSERT INTO event (name_event, date_event, price_event, ticketAvailable, image_event, description_event, location_event)
        VALUES (:eventName, :date, :price, :capacity, :image, :description, :location)");
                            $stmt->bindParam(":eventName", $eventName);
                            $stmt->bindParam(":date", $datetime);
                            $stmt->bindParam(":price", $price);
                            $stmt->bindParam(":capacity", $capacity);
                            $stmt->bindParam(":image", $destination);
                            $stmt->bindParam(":description", $description);
                            $stmt->bindParam(":location", $location);
                            if ($stmt->execute()){
                                $_SESSION['success_message'] = "The event was succesfully created.";
                                header("location: ../view/createevent.php");
                                exit;
                            } 
                            else {
                                $_SESSION['logged'] = false;
                                $_SESSION["error_message"] = "Could not create the event.";
                                $this->conn = null;
                                header("location: ../view/createevent.php");
                                exit;            
                            }
                }
            }
            catch(PDOException $e){
                $_SESSION['logged'] = false;                
                $_SESSION["error_message"] = "Error ocurred created the event.";
                $this->conn = null;
                header("location: ../view/createevent.php");
                exit; 
            }
    }

    public function read() : array {
            $sql = "SELECT idEvent, name_event, date_event, price_event, ticketAvailable, image_event, description_event, location_event, state_event FROM event";

            try {
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();
                $rowCount = $stmt->rowCount(); // Devuelve el total de número de filas devueltas
        
                if ($rowCount > 0) {
                    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    return $events;
                } else {
                    return []; // No se encontraron eventos
                }
            } catch(PDOException $e) {
                echo "Error al leer los eventos: " . $e->getMessage();
                return [];
            }
    }
        
    //Creamos una función para obtener un evento de toda la lista, llamada desde la función update:
    public function getEventById($idEvent) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM event WHERE idEvent = :idEvent");
            $stmt->bindParam(":idEvent", $idEvent, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC); // Devuelve un array asociativo con los datos del evento con esa ID
        } catch (PDOException $e) {
            error_log("Error al obtener evento por ID: " . $e->getMessage());
            return false;
        }
    }        
    public function update() : void {
        //Solo el administrador puede modificar eventos y lanzamos de nuevo la verificación:
        if (empty($_SESSION["logged"]) || $_SESSION['rol'] != "admin") {
            $_SESSION['error_message'] = "Acceso no autorizado";
            header("Location: ../view/signin.php");
            exit;
        }

        // Como vamos a insertar datos, obtenemos datos con un formulario tipo POST
        $idEvent = htmlspecialchars($_POST["idEvent"]);
        $eventName = htmlspecialchars($_POST["name"]);
        $description = htmlspecialchars($_POST["description"]);
        $date = htmlspecialchars($_POST["date"]);
        $startTime = htmlspecialchars($_POST["start-time"]);
        $price = htmlspecialchars($_POST["price"]);
        $capacity = htmlspecialchars($_POST["capacity"]);
        $state_event = htmlspecialchars($_POST["state_event"]);
        $datetime = $date . ' ' . $startTime . ':00';

        // Validación de fecha
        $today = new DateTime();
        $today->setTime(0, 0, 0);
        $eventDate = DateTime::createFromFormat('Y-m-d', $date);

        if ($eventDate < $today) {
            $_SESSION['error_message'] = "La fecha seleccionada no puede ser anterior a la actual.";
            header("Location: ../view/eventEditProfileAdmin.php?idEvent=" . $idEvent);
            exit;
        }

        // Nos guardamos la ruta de la imagen que ya está en la BBDD (event_image)
        $eventImageDestination = htmlspecialchars($_POST["current_event_image"]);        
        //Para poder subir nueva imagen del evento a actualizar
        if (isset($_FILES['event_image']) && $_FILES['event_image']['error'] === UPLOAD_ERR_OK) {
            $file_name = $_FILES['event_image']['name'];
            $file_tmp = $_FILES['event_image']['tmp_name'];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $allowed_ext = array('jpg', 'jpeg', 'png', 'gif');
            $subfolder = '../view/img/event/';
            $new_file_name = uniqid() . '.' . $file_ext;
            $new_event_image_destination = $subfolder . $new_file_name;
            //Validación de imagen y se actualiza la ruta para la BBDD
            if (in_array(strtolower($file_ext), $allowed_ext)) {
                move_uploaded_file($file_tmp, $new_event_image_destination);
                $eventImageDestination = $new_event_image_destination;
                $_SESSION['success_message'] = 'Imagen del evento actualizada correctamente.';
            } else {
                $_SESSION['error_message'] = 'Formato de imagen de evento inválido. Solo se permiten JPG, JPEG, PNG, GIF.';
                header("location: ../view/eventEditProfileAdmin.php?idEvent=" . $idEvent);
                exit;
            }
        } else if (isset($_FILES['event_image']) && $_FILES['event_image']['error'] !== UPLOAD_ERR_NO_FILE) {
            $_SESSION['error_message'] = 'Error al subir la imagen del evento: ' . $_FILES['event_image']['error'];
            header("location: ../view/eventEditProfileAdmin.php?idEvent=" . $idEvent);
            exit;
        }

        // Nos guardamos la ruta de la imagen del mapa de ubicación que ya está en la BBDD (location_image)
        $locationImageDestination = htmlspecialchars($_POST["current_location_image"]);
        // Para poder subir nueva imagen del mapa de ubicación del evento a actualizar
        if (isset($_FILES['location_image']) && $_FILES['location_image']['error'] === UPLOAD_ERR_OK) {
            $file_name = $_FILES['location_image']['name'];
            $file_tmp = $_FILES['location_image']['tmp_name'];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $allowed_ext = array('jpg', 'jpeg', 'png', 'gif');
            $subfolder = '../view/img/event/';
            $new_file_name = uniqid() . '.' . $file_ext;
            $new_location_image_destination = $subfolder . $new_file_name;
            //Validación de imagen y se actualiza la ruta para la BBDD
            if (in_array(strtolower($file_ext), $allowed_ext)) {
                move_uploaded_file($file_tmp, $new_location_image_destination);
                $locationImageDestination = $new_location_image_destination; // Actualiza la ruta para la BBDD
                $_SESSION['success_message'] = (isset($_SESSION['success_message']) ? $_SESSION['success_message'] . ' y ' : '') . 'Imagen de ubicación actualizada correctamente.';
            } else {
                $_SESSION['error_message'] = 'Formato de imagen de ubicación inválido. Solo se permiten JPG, JPEG, PNG, GIF.';
                header("location: ../view/eventEditProfileAdmin.php?idEvent=" . $idEvent);
                exit;
            }
        } else if (isset($_FILES['location_image']) && $_FILES['location_image']['error'] !== UPLOAD_ERR_NO_FILE) {
            $_SESSION['error_message'] = 'Error al subir la imagen de ubicación: ' . $_FILES['location_image']['error'];
            header("location: ../view/eventEditProfileAdmin.php?idEvent=" . $idEvent);
            exit;
        }

        // Lanzamos la query UPDATE a la BBDD
        try {
            $stmt = $this->conn->prepare("UPDATE event SET
                name_event = :eventName,
                date_event = :date,
                price_event = :price,
                ticketAvailable = :capacity,
                image_event = :image,
                description_event = :description,
                location_event = :location,
                state_event = :state_event
                WHERE idEvent = :idEvent");

            $stmt->bindParam(":eventName", $eventName);
            $stmt->bindParam(":date", $datetime);
            $stmt->bindParam(":price", $price);
            $stmt->bindParam(":capacity", $capacity);
            $stmt->bindParam(":image", $eventImageDestination); // Usa la nueva o la antigua ruta de la imagen del evento
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":location", $locationImageDestination); // Usa la nueva o la antigua ruta de la imagen de ubicación
            $stmt->bindParam(":state_event", $state_event);
            $stmt->bindParam(":idEvent", $idEvent, PDO::PARAM_INT);

            if ($stmt->execute()) {
                $_SESSION['success_message'] = "El evento fue actualizado exitosamente.";
                header("location: ../view/eventEditProfileAdmin.php?idEvent=" . $idEvent);
                exit;
            } else {
                $_SESSION["error_message"] = "No se pudo actualizar el evento.";
                header("location: ../view/eventEditProfileAdmin.php?idEvent=" . $idEvent);
                exit;
            }
        } catch (PDOException $e) {
            error_log("Error de base de datos al actualizar evento: " . $e->getMessage());
            $_SESSION["error_message"] = "Ocurrió un error al actualizar el evento.";
            header("location: ../view/eventEditProfileAdmin.php?idEvent=" . $idEvent);
            exit;
        }
    }


    public function delete() : void {
            $idEvent = htmlspecialchars($_POST['idEvent']);
    
        try {
            $checkSql = "SELECT * FROM event WHERE idEvent = :idEvent";
            $checkStmt = $this->conn->prepare($checkSql);
            $checkStmt->bindParam(':idEvent', $idEvent);
            $checkStmt->execute();
    
            if ($checkStmt->rowCount() > 0) {
                $deleteSql = "DELETE FROM event WHERE idEvent = :idEvent";
                $deleteStmt = $this->conn->prepare($deleteSql);
                $deleteStmt->bindParam(':idEvent', $idEvent);
                if ($deleteStmt->execute()) {
                    header("location: ../view/profileadmin.php");
                    exit;
                } else {
                    echo "Error while trying to delete the event.";
                }
            } else {
                echo "Event not found.";
            }
        } catch(PDOException $e) {
            echo "Exception: " . $e->getMessage();
        }
    }
        
}