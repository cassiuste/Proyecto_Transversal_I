<?php
session_start();

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $user = new UserController();
    
    if(isset($_POST["login"])){
        echo "<p>Loggin button is clicked. </p>";
        $user->login();
    }
    if(isset($_POST["logout"])){
        echo "<p>Logout button is clicked. </p>";
        $user->logout();
    }
    if(isset($_POST["register"])){
        echo "<p>Register button is clicked. </p>";
        $user->register();
    }
}

class UserController{

    private $conn;

    public function __construct() {

        // Base de datos a cambiar cuando tengamos la definitiva
        $servername = "localhost";
        $database = "eventlink_prueba";
        $username = "root";
        $password = "";

        // Create connection
        $this->conn = new mysqli($servername, $username, $password, $database);

        // Check connection
        if ($this->conn->connect_error) {
        die("Connection failed: " . $this->conn->connect_error);
        }
        echo "Connected successfully";
        }

    public function register() : void {
        
    }


    public function login() : void {

        $email = htmlspecialchars($_POST["email"]);
        $password = htmlspecialchars($_POST["password"]); 

        echo "email: " . "$email" . "<br>" . "password: " . "$password" . "<br><br>"; 

        echo "Resultado base de datos<br>";
        $sql = "SELECT * FROM user WHERE email='$email' AND password='$password'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
        // Si encuentra el usuario que lo mande a la pagina de profile
        // sino al login con mensaje de error
        while($row = $result->fetch_assoc()) {
            echo "email: " . $row["email"]. "<br>" . "password: " . $row["password"];
        }
        } else {
        $_SESSION["error_message"] = "Cuenta no encontrada";
        header("location: ../view/login.php");
        }
        $this->conn->close();
    }


    public function logout() : void {
        
    }

    function set_conn($conn){
        $this->conn = $conn;
    }

    function get_conn(){
        return $this->conn;
    }
}