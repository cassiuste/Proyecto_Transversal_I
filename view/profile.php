<?php
session_start();

//verificar login
if (isset($_SESSION["logged"]) && $SESSION["logged"] == true) {
	$username = htmlspecialchars(string: $_SESSION["user"]);
	$email = htmlspecialchars(string: $_SESSION["email"] ?? "No email available");
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="../view/css/profile_style.css">
</head>
<body>
    <header>
        <div class="image">
            <img  src="../view/img/logo.png"/>
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Buscar evento">
            <input type="text" placeholder="Ciudad - Código postal">
            <button></button>
        </div>
        <div class="user-actions">
            <button class="create-event-btn">CREAR EVENTO</button>
            <div class="user-avatar">A</div>
        </div>
    </header>

    <div class="container">
        <aside class="sidebar">
            <div class="profile-info">
                <div class="profile-image"></div>
                <div class="profile-name">Nombre</div>
            </div>
            <nav class="user-nav">
                <ul>
                    <li><a href="#">EVENTS</a></li>
                    <li><a href="#">Attending</a></li>
                    <li><a href="#">Saved</a></li>
                    <li><a href="#">Hosting</a></li>
                    <li><a href="#">FRIENDS</a></li>
                    <li><a href="#">EDIT PROFILE</a></li>
                    <li><a href="#">LOG OUT</a></li>
                    <li><a href="#">My calendary</a></li>
                </ul>
            </nav>
        </aside>

        <main class="content">
            <h2>YOUR EVENTS</h2>
            <div class="event-grid">
                <div class="event">

                    <div class="event-image">
                        <img  src="../view/img/profile/cataVinos_profile.jpg" alt="Event1 profile"/>
                    </div>
                    
                    <h3>EVENT 1</h3>
                    <p>Picture 1: It shows a wine tasting in the "Jardinet d'Aribau"</p>
                    <a href="https://feverup.com/m/125199?_gl=1*10a9o3y*_up*MQ..*_ga*NzU2OTUwMzAuMTc0MjQ3MTQ4Ng..*_ga_L4M4ND4NG4*MTc0MjQ3MTQ4NS4xLjAuMTc0MjQ3MTQ4NS4wLjAuMTYyODQ2MDk3"></a>   
                
                </div>
                
                <div class="event">
                    
                    <div class="event-image">
                        <img  src="../view/img/profile/e2_velero_profile.jpg" alt="Event2 profile"/>
                    </div>
                    
                    <h3>EVENT 2</h3>
                    <p>Picture 2: It shows an sailboat experience Barcelona: 90 minuts plus Vermouth</p>
                    <a href="https://feverup.com/m/141663?_gl=1*irlico*_up*MQ..*_ga*NzU2OTUwMzAuMTc0MjQ3MTQ4Ng..*_ga_L4M4ND4NG4*MTc0MjQ3MTQ4NS4xLjAuMTc0MjQ3MTQ4NS4wLjAuMTYyODQ2MDk3"></a>

                </div>                    

                <div class="event">

                    <div class="event-image">
                        <img  src="../view/img/profile/event3_profile.jpg" alt="Event3 profile"/>
                    </div>
                    
                    <h3>EVENT 3</h3>
                    <p>Picture 3: It shows Barcelona night Bike Tour with tapas and cava</p>
                    <a href="https://feverup.com/m/312210?_gl=1*1hkz0u0*_up*MQ..*_ga*NzgwMDg3ODk5LjE3NDM1ODg4MjA.*_ga_L4M4ND4NG4*MTc0MzU4ODgxOC4xLjAuMTc0MzU4ODgxOC4wLjAuMTkxNDk4MTUwNw.."></a>
                
                </div>
                    
                <div class="event">
                    
                    <div class="event-image">
                        <img  src="../view/img/profile/event3_profile.jpg" alt="Event4 profile"/>
                    </div>
                    
                    <h3>EVENT 4</h3>
                    <p>Picture 4: It shows Barcelona night Bike Tour with tapas and cava</p>
                    <a href="https://feverup.com/m/312210?_gl=1*1hkz0u0*_up*MQ..*_ga*NzgwMDg3ODk5LjE3NDM1ODg4MjA.*_ga_L4M4ND4NG4*MTc0MzU4ODgxOC4xLjAuMTc0MzU4ODgxOC4wLjAuMTkxNDk4MTUwNw.."></a>
                
                </div>
            
            </div>
        </main>
    </div>
</body>
</html>