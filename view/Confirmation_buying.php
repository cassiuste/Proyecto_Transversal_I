<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Evento</title>
    <link rel="stylesheet" href="../view/css/Confirmation_buying_style.css">
</head>
<body>
    <header>
        <div class="head">
            <a href="home.php"><img src="./img/home/logo2.png" alt="logo of eventlink" id="eventlink_logo"></a>
            <div class="left">
                <a href="Event_page_from_search.php"><div class="hbuttom">Search event</div></a>
                <a href="Event_page_from_search.php"><div class="hbuttom">City / Zip code</div></a>
                <a href="Event_page_from_search.php"><div class="search_img">
                <img src="./img/home/icons8-magnifying-glass-50.png" alt="search bar"></div></a>
                        
            </div>
                <div class="right">
                    <?php
                        if(!empty($_SESSION["logged"])){
                            echo "<a href='createevent.php'><div class='hbuttom'>CREATE EVENT</div></a>";
                                
                            if ($_SESSION['rol'] == "admin") {
                                echo "<a href='profileadmin.php'><div class='profilebtm'>A</div></a>";
                            } else {
                                echo "<a href='profileuser.php'><div class='profilebtm'>A</div></a>";
                            }
                                
                        }

                    ?>
                </div>
        </div>
    </header>

    <main>
        <div class="event-image">
            Imagen del evento
        </div>

        <div class="event-details">
            <p>¡Vas!</p>
            <button class="share-btn">Compartir ↗️</button>
            <p>"FECHA Y HORA"</p>
            <p>"UBICACIÓN"</p>
            <p>"PRECIO"</p>
        </div>

        <div class="navigation">
            <a href="#" class="back-btn">← Volver al evento</a>
            <a href="#" class="events-btn">Ver tus eventos →</a>
        </div>
    </main>
</body>
</html>