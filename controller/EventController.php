<?php
session_start();

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $user = new UserController();
    
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

        }

        public function update() : void {
            
        }


        public function read() : void {

        }
        
        public function delete() : void {
            
        }
        
}