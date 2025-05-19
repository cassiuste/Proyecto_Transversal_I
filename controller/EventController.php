<?php
//session_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $event = new EventController();
    
    if(isset($_POST["read"])){
        echo "<p>Read button is clicked. </p>";
        $event->read();
    }
    if(isset($_POST["create"])){
        echo "<p>Create button is clicked. </p>";
        $event->create();
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
            $sql = "SELECT name_event, date_event, location_event, price_event FROM event";

            try {
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();
                $rowCount = $stmt->rowCount(); // Devuelve el total de número de filas devueltas
        
                if ($rowCount > 0) {
                    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $_SESSION['events'] = $events;
                    return $events;
                } else {
                    return []; // No se encontraron eventos
                }
            } catch(PDOException $e) {
                echo "Error al leer los eventos: " . $e->getMessage();
                return [];
            }
        }
        

        public function update() : void {
            
        }

        public function delete() : void {
            $index = htmlspecialchars($_POST['idEvent']);
    
        try {
            $checkSql = "SELECT * FROM event WHERE idEvent = :index";
            $checkStmt = $this->conn->prepare($checkSql);
            $checkStmt->bindParam(':index', $index);
            $checkStmt->execute();
    
            if ($checkStmt->rowCount() > 0) {
                $deleteSql = "DELETE FROM event WHERE idEvent = :index";
                $deleteStmt = $this->conn->prepare($deleteSql);
                $deleteStmt->bindParam(':index', $index);
                if ($deleteStmt->execute()) {
                    header("location: ../view/home.php");
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