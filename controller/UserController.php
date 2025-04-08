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
        $user->register("admin");
    }
    if(isset($_POST["register_user"])){
        echo "<p>Register user button is clicked. </p>";
        $user->register("user");
    }
}

class UserController{

    private $conn;

    public function __construct() {

        // Base de datos a cambiar cuando tengamos la definitiva
        $servername = "localhost";
        $database = "eventlink";
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

    public function register($rol) : void {
        // validar el email
        
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        // insertar fila
        $sql = "INSERT INTO user (username, email, password, rol)
                VALUES ('$username', '$email', '$password', '$rol')";

        // Falta el control de errores en el sql para las filas
        if ($this->conn->query($sql) === TRUE) {
            $_SESSION['logged'] = true;
            $_SESSION['name'] = $row['name'];
            $_SESSION['email'] = $row['email'];
            // puede ser admin o user
            $_SESSION['rol'] = $row['rol'];

            header("location: ../view/index.html");
            exit;
        } 
        else {
            // falta validaciones si esta repetido
            $_SESSION['logged'] = false;
            $_SESSION["error_message"] = "Could not register the account";
            if($isAdmin){
                header("location: ../view/registeradmin.php");
                exit;
            }
            else{
                header("location: ../view/registeruser.php");
                exit;
            }
        }

        $conn->close();
        // despues validar si esta repetido
    }


    public function login() : void {

        $username = htmlspecialchars($_POST["username"]);
        $password = htmlspecialchars($_POST["password"]); 

        $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
        // Si encuentra el usuario que lo mande a la pagina de profile
        // sino al login con mensaje de error
        
        $_SESSION['logged'] = true;
        $_SESSION['name'] = $row['name'];
        $_SESSION['email'] = $row['email'];
        // puede ser admin o user
        $_SESSION['rol'] = $row['rol'];
        
        header("location: ../view/profile.php");
        exit;
        } else {
        $_SESSION['logged'] = false;
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