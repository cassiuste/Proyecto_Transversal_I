<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventlink</title>
    <link rel="stylesheet" href="css/createevent.css">
    <link rel="stylesheet" href="css/header.css">
</head>
<body>

<header>
        <div class="head">
            <a href="home.php"><img src="./img/home/logo2.png" alt="logo of eventlink" id="eventlink_logo"></a>
            <div class="left">
                <a href=""><div class="hbuttom">Search event</div></a>
                <a href=""><div class="hbuttom">City / Zip code</div></a>
                <a href=""><div class="search_img">
                    <img src="./img/home/icons8-magnifying-glass-50.png" alt="search bar">
                </div></a>
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
                    else{
                        echo "<a href='signin.php'><div class='hbuttom'>SIGN IN</div></a>
                            <a href='registeruser.php'><div class='hbuttom'>SIGN UP</div></a>";
                    }
                    ?>
            </div>
        </div>
    </header>

    <main>
        <div class="page">
            <div class="content">
                <h2>CREATE EVENT</h2>
                <form action="" method="post">
                    <label for="name">Name of the event</label>
                    <br>
                    <input type="text" name="name" id="name" required>
                    <br>
                    <label for="description">Description</label>
                    <br>
                    <input type="text" name="description" id="description">
                    <br>
                    <div class="datetime-row">
                        <div class="datetime-group">
                            <label for="date">Date</label>
                            <input type="date" name="date" id="date" required>
                        </div>
                        <div class="datetime-group">
                            <label for="start-time">Start Time</label>
                            <input type="time" required>
                        </div>
                        <div class="datetime-group">
                            <label for="end-time">End Time</label>
                            <input type="time" required>
                        </div>
                    </div>
                    <label for="location">Location</label>
                    <br>
                    <input type="text" name="location" id="location" required>
                    <br>
                    <label for="price">Price</label>
                    <br>
                    <input type="number" name="price" id="price" min="0" required>
                    <br>
                    <label for="capacity">Capacity</label>
                    <br>
                    <input type="number" name="capacity" id="capacity" min="0">
                    <br>
                    <input type="submit" class="createbtm" value="CREATE">
                </form>
            </div>
        </div>
    </main>

</body>
</html>