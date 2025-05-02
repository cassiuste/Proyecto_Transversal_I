<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra de Tickets</title>
    <link rel="stylesheet" href="../view/css/Buying_screen_style.css">
</head>
<body>
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

            <a href="profileuser.php" class="back-btn">← Volver a mis eventos</a>
        </div>

        <div class="event-details">
            <div class="event-image">
                <img  src="../view/img/profile/cataVinos_profile.jpg" alt="Event1 profile"/>
            </div>
            <div class="price-container">
                <span class="price-label">Precio total: </span>
                <span class="price-value">19.99€</span>
            </div>
            <a href="Confirmation_buying.php"> <button class="checkout-btn"> CHECKOUT</button></a>
        </div>
    </main>
</body>
</html>