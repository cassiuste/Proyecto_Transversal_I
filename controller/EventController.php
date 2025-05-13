<?php
session_start();

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $event = new EventController();
    
    if(isset($_POST["read"])){
        echo "<p>Read button is clicked. </p>";
        $user->read();
    }
    if(isset($_POST["create"])){
        echo "<p>Create button is clicked. </p>";
        $_SESSION["isAdmin"] = true;
        $user->create();
    }
    if(isset($_POST["update"])){
        echo "<p>Update button is clicked. </p>";
        $_SESSION["isAdmin"] = false;
        $user->update();
    }
    if(isset($_POST["delete"])){
        echo "<p>Delete button is clicked. </p>";
        $user->delete();
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
            echo "Connected successfully";
          } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
          }

        }
        
        public function create() : void {
            
            $eventName = htmlspecialchars($_POST["name"]);
            $description = htmlspecialchars($_POST["description"]);
            $date = htmlspecialchars($_POST["date"]);
            $startTime = htmlspecialchars($_POST["start-time"]);
            $location = htmlspecialchars($_POST["location"]);
            $price = htmlspecialchars($_POST["price"]);
            $capacity = htmlspecialchars($_POST["capacity"]);
            

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
    
    

            // insertar fila
            try{
                if($rol == "admin"){
                    $stmt = $this->conn->prepare("INSERT INTO user (username, email, user_password, rol, profile_image)
                        VALUES (:username, :email, :user_password, :rol, :profile_image)");
                            $stmt->bindValue(":profile_image", $destination);
                }
                else{
                    $stmt = $this->conn->prepare("INSERT INTO user (username, email, user_password, rol)
                        VALUES (:username, :email, :user_password, :rol)");
                }

                $stmt->bindParam(":username", $username);
                $stmt->bindParam(":email", $email);
                $stmt->bindParam(":user_password", $user_password);
                $stmt->bindParam(":rol", $rol);
                
            // Falta el control de errores en el sql para las filas
                if ($stmt->execute()){
                    $_SESSION['logged'] = true;
                    $_SESSION['username'] = $username;
                    $_SESSION['email'] = $email;
                    // puede ser admin o user
                    $_SESSION['rol'] = $rol;
                    if(($rol == "admin") && ($destination !== null)){
                        $_SESSION['profile_image'] = $destination;
                    }
                    header("location: ../view/home.php");
                    exit;
                } 
                else {
                    // falta validaciones si esta repetido
                    $_SESSION['logged'] = false;
                    $_SESSION["error_message"] = "Could not register the account";
                    $this->conn = null;
                    if(!empty($_SESSION["isAdmin"])){
                        header("location: ../view/registeradmin.php");
                        exit;
                    }
                    else{
                        header("location: ../view/registeruser.php");
                        exit;
                    }
                }
                
            }
            catch(PDOException $e){
                $_SESSION['logged'] = false;                
                $_SESSION["error_message"] = "A user with that username or email already exists.";
                $this->conn = null;
                if(!empty($_SESSION["isAdmin"])){
                    header("location: ../view/registeradmin.php");
                    exit;
                }
                else{
                    header("location: ../view/registeruser.php");
                    exit;
                }
            }

        }

        public function read() : array {
            $sql = "SELECT eventName, date, location, price FROM event";

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
        

        public function update() : void {
            
        }

        public function delete() : void {
            
        }
        
}