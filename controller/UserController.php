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
    if(isset($_POST["register_admin"])){
        echo "<p>Register admin button is clicked. </p>";
        $isAdmin = true;
        $user->register();
    }
    if(isset($_POST["register_user"])){
        echo "<p>Register user button is clicked. </p>";
        $isAdmin = false;
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

        $username = htmlspecialchars($_POST["username"]);
        $password = htmlspecialchars($_POST["password"]); 

        echo "username: " . "$username" . "<br>" . "password: " . "$password" . "<br><br>"; 

        echo "Resultado base de datos<br>";
        $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
        // Si encuentra el usuario que lo mande a la pagina de profile
        // sino al login con mensaje de error
        header("location: ../view/profile.php");
        $_SESSION['logged'] = true;
        // que vea si es admin o no
        // $_SESSION['admin'] = true;
        exit;
        } else {
        $_SESSION["error_message"] = "Could not find the account";
        header("location: ../view/signin.php");
        exit;
        }
        $this->conn->close();
    }


    public function logout() : void {
        session_unset();
        session_destroy();
        header("location: ../view/index.html");
        exit;
    }

    function set_conn($conn){
        $this->conn = $conn;
    }

    function get_conn(){
        return $this->conn;
    }
}