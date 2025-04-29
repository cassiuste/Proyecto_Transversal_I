<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra de Tickets</title>
    <link rel="stylesheet" href="../view/css/Buying_screen_style.css">
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
        <div class="ticket-selection">
            <h2>Compra</h2>
            <p>Selecciona los tickets</p>

            <div class="ticket-type">
                <span>FREE</span>
                <div class="quantity-control">
                    <button class="quantity-btn">-</button>
                    <input type="number" value="0" min="0" class="quantity-input" readonly>
                    <button class="quantity-btn">+</button>
                </div>
            </div>

            <div class="ticket-type">
                <span>ECONOMY</span>
                <div class="quantity-control">
                    <button class="quantity-btn">-</button>
                    <input type="number" value="0" min="0" class="quantity-input" readonly>
                    <button class="quantity-btn">+</button>
                </div>
            </div>

            <div class="ticket-type">
                <span>PREMIUM</span>
                <div class="quantity-control">
                    <button class="quantity-btn">-</button>
                    <input type="number" value="0" min="0" class="quantity-input" readonly>
                    <button class="quantity-btn">+</button>
                </div>
            </div>

            <a href="#" class="back-btn">← Volver al evento</a>
        </div>

        <div class="event-details">
            <div class="event-image">
                Imagen del evento
            </div>
            <button class="price-btn">"PRECIO"</button>
            <button class="checkout-btn"> CHECKOUT</button>
        </div>
    </main>
</body>
</html>