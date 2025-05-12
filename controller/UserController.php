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
        $_SESSION["isAdmin"] = true;
        $user->register("admin");
    }
    if(isset($_POST["register_user"])){
        echo "<p>Register user button is clicked. </p>";
        $_SESSION["isAdmin"] = false;
        $user->register("user");
    }
    if(isset($_POST["delete_account"])){
        echo "<p>Delete user button is clicked. </p>";
        $user->delete();
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
        try{
            $this->conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
          } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
          }

        }

        public function register($rol) : void {
        
            $username = $_POST["username"];
            $email = $_POST["email"];
            $user_password = $_POST["password"];
    
            //validacion del email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
                $_SESSION["error_message"] = $emailErr;
                if(!empty($_SESSION["isAdmin"])){
                    header("location: ../view/registeradmin.php");
                    exit;
                }
                else{
                    header("location: ../view/registeruser.php");
                    exit;
                }
              }
    
              // Validación de la contraseña
                if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d).{8,}$/', $user_password)) {
                    $passErr = "Password must contain at least 8 characters, including one letter and one number.";
                    $_SESSION["error_message"] = $passErr;
                    if(!empty($_SESSION["isAdmin"])){
                        header("location: ../view/registeradmin.php");
                        exit;
                    } else {
                        header("location: ../view/registeruser.php");
                        exit;
                    }
                }
    
                //PGS 27/04: Subir imagen si es rol admin y si selecciona un archivo
                $destination = null;
                if ($rol == "admin" && isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
                       $file_name = $_FILES['profile_image']['name'];
                       $file_tmp = $_FILES['profile_image']['tmp_name'];
                       $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
                       $allowed_ext = array('jpg', 'jpeg', 'png', 'gif');   
                       $subfolder = '../view/img/profile/admin/';
                       $new_file_name = uniqid() . '.' . $file_ext;
                       $destination = $subfolder . $new_file_name;
                       
                       if (in_array($file_ext, $allowed_ext)) {
                        move_uploaded_file($file_tmp, $destination);
                        $_SESSION['success_message'] = 'Image uploaded correctly.';
                        } else {
                        $_SESSION['error_message'] = 'Invalid format.';
                        header("location: ../view/registeradmin.php");
                        exit;
                        }
                        
                } else if (isset($_POST['register_admin']) && isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] !== UPLOAD_ERR_NO_FILE) {
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


    public function login() : void {

        $username = htmlspecialchars($_POST["username"]);
        $user_password = htmlspecialchars($_POST["password"]); 

        try{
        $stmt = $this->conn->prepare("SELECT * FROM user WHERE username=:username AND user_password=:user_password");
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":user_password", $user_password);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Si encuentra el usuario que lo mande a la pagina de profile
            // sino al login con mensaje de error

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['logged'] = true;
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['email'];
            // puede ser admin o user
            $_SESSION['rol'] = $row['rol'];
            if($_SESSION['rol'] == "admin"){
                $_SESSION['profile_image'] = $row['profile_image'];
                header("location: ../view/profileadmin.php");
                exit;
            }
            else{
                header("location: ../view/profileuser.php");
                exit;
            }
              }
        else {
        $_SESSION['logged'] = false;
        $_SESSION["error_message"] = "Could not find the account";
        $this->conn = null;
        header("location: ../view/signin.php");
        exit;
        }
        }
        catch(PDOException $e){
            $_SESSION['logged'] = false;
            $_SESSION["error_message"] = "Could not find the account";
            header("location: ../view/signin.php");
            exit;
        }
    }
    
    public function logout() : void {
        session_unset();
        session_destroy();
        header("location: ../view/signin.php");
        exit;
    }

    public function deletePassword() : void{

    }
    
    
    public function delete() : void {

        if (isset($_POST['delete_account'])) { 
            if (!isset($_SESSION['username'])) {
                exit;
            }
    
            $username = $_SESSION['username'];
    
            try {
                $checkSql = "SELECT * FROM user WHERE username = :username";
                $checkStmt = $this->conn->prepare($checkSql);
                $checkStmt->bindParam(':username', $username);
                $checkStmt->execute();
    
                if ($checkStmt->rowCount() > 0) {
                    $deleteSql = "DELETE FROM user WHERE username = :username";
                    $deleteStmt = $this->conn->prepare($deleteSql);
                    $deleteStmt->bindParam(':username', $username);
                    if ($deleteStmt->execute()) {
                        logout();
                    } else {
                        echo "Error while trying to delete the account.";
                    }
                } else {
                    echo "User not found.";
                }
            } catch(PDOException $e) {
                echo "Exception: " . $e->getMessage();
            }
        }

    }
    



    function set_conn($conn){
        $this->conn = $conn;
    }

    function get_conn(){
        return $this->conn;
    }

}