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
        // $servername = "localhost";
        // $username = "root";
        // $password = "";

        // // Create connection
        // $this->conn = new mysqli($servername, $username, $password);

        // // Check connection
        // if ($this->conn->connect_error) {
        // die("Connection failed: " . $this->conn->connect_error);
        // }
        // echo "Connected successfully";
        }

    public function register() : void {
        
    }
    public function login() : void {
        
    }
    public function logout() : void {
        
    }

    function set_conn($conn){
        $this->conn = $conn;
    }

    function get_conn(){
        return $this->$conn;
    }
}