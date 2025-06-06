<?php
session_start();
$showPopup = false;

if (isset($_SESSION['popup']) && $_SESSION['popup'] === true) {
    $showPopup = true;
    unset($_SESSION['popup']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/home.css">
    <link rel="stylesheet" href="./css/header.css">
    <title>Home</title>
</head>
<body>

    <header>
        <div class="head">
            <a href="home.php"><img src="./img/home/logo2.png" alt="logo of eventlink" id="eventlink_logo"></a>
            <div class="left">
                <a href="Event_page_from_search.php"><div class="hbuttom">Search event</div></a>
                <a href="Event_page_from_search.php"><div class="hbuttom">City / Zip code</div></a>
                <a href="Event_page_from_search.php"><div class="search_img">
                    <img src="./img/home/icons8-magnifying-glass-50.png" alt="search bar">
                </div></a>
            </div>
            <div class="right">
                <?php
                    if(!empty($_SESSION["logged"])){
                    if ($_SESSION['rol'] == "admin") {
                       echo "<a href='createevent.php'><div class='hbuttom'>CREATE EVENT</div></a>";
                        echo "<a href='profileadmin.php'><div class='profilebtm'>";
                    
                    if (isset($_SESSION['profile_image']) && !empty($_SESSION['profile_image'])) {
                        echo "<img src='" . htmlspecialchars($_SESSION['profile_image']) . "' style='max-width: 35px; border-radius: 100%;' alt='Profile foto'>";
                    } else {
                        echo "A";
                    }
                    echo "</div></a>";
                }        
                    else {
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
    <div class="main_imgcontainer">
            <div class="main_image">
                <img src="./img/home/barcelona_event.jpg" alt="event">
                <div class="oval_container">
                    <?php
                        if(empty($_SESSION["logged"])){
                            echo "<a href='signin.php'><div class='oval_join'><p>Join Eventlink now!</p></div></a>";
                        }
                        else{
                            if($_SESSION['rol'] == "admin"){
                            echo "<a href='profileadmin.php'><div class='oval_join'><p>See your Events!</p></div></a>";
                        }
                        else {
                            echo "<a href='profileuser.php'><div class='oval_join'><p>See your Events!</p></div></a>";
                            }
                        }
                        ?>
                </div>
            </div>
        </div>

        <!-- <form action="../controller/EventController.php" method="post">
            <input type="submit" name="read" value="Show all events">
        </form>

        <table>
            <thead>
                <tr>
                    <th>name</th>
                    <th>date</th>
                    <th>location</th>
                    <th>price</th>
                </tr>
            </thead>
            <tbody>
            <?php
                // if (!empty($_SESSION['events'])) {
                //     foreach ($_SESSION['events'] as $index => $event) {
                ?>
                    <tr>
                        <td><?php  // echo $event['name_event']; ?></td>
                        <td><?php  // echo $event['date_event']; ?></td>
                        <td><?php //echo $event['location_event']; ?></td>
                        <td><?php //echo $event['price_event']; ?></td>
                        <td>
                            <form action="../controller/EventController.php" method="post">
                                <input type="hidden" name="name_event" value="<?php //echo $event['name_event']; ?>">
                                <input type="hidden" name="date_event" value="<?php //echo $event['date_event']; ?>">
                                <input type="hidden" name="location_event" value="<?php //echo $event['location_event']; ?>">
                                <input type="hidden" name="price_event" value="<?php //echo $event['price_event']; ?>">
                                <input type="hidden" name="idEvent" value="<?php //echo $event['idEvent']; ?>">
                                <input type="submit" name="edit" value="Edit">
                                <input type="submit" name="delete" value="Delete">
                            </form>
                        </td>
                    </tr>
                <?php
                //     }
                // }
                ?>
            </tbody>
        </table> -->
<!--         
        <div class="popular_categories">
            <h2>Popular Categories</h2>
            <div class="categories">
                <a href="Event_page_from_search.php">
                    <div class="categorie">
                        <img src="./img/home/health.jpg" alt="image of an event">
                        <br>
                        <div class="oval"><p>HEALTH</p></div>
                    </div>
                </a>
                <a href="Event_page_from_search.php">
                <div class="categorie">
                    <img src="./img/home/music event.jpg" alt="image of an event">
                    <br>
                    <div class="oval"><p>MUSIC</p></div>
                </div>
                </a>
                <a href="Event_page_from_search.php">
                <div class="categorie">
                    <img src="./img/home/bussiness event.jpg" alt="image of an event">
                    <br>
                    <div class="oval"><p>BUSINESS</p></div>
                </div>
                </a>
                <a href="Event_page_from_search.php">
                <div class="categorie">
                    <img src="./img/home/community-event.jpg" alt="image of an event">
                    <br>
                    <div class="oval"><p>COMMUNITY</p></div>
                </div>
                </a>
            </div>
        </div>
        <div class="event_section">
            <h3>Top Rated Events in Barcelona</h3>
            <div class="events_container">
                <div class="events">
                    <a href="EventPage.php">
                        <div class="event">
                            <img src="./img/home/laser_tag.jpg" alt="event">
                            <div class="event_text">
                                <b>Laser Tag</b>
                                <p>Fast-paced laser tag action in Barcelona. Fun, strategy, and excitement for all skill levels!</p>
                            </div>
                        </div>
                    </a>
                    <a href="EventPage.php">
                        <div class="event">
                        <img src="./img/home/temptation_festival.jpg" alt="event">
                        <div class="event_text">
                                <b>Temptation Festival</b>
                                <p>A vibrant music and dance festival in Barcelona. Feel the rhythm, live the night!</p>
                            </div>
                        </div>
                    </a>
                    <a href="EventPage.php">
                        <div class="event">
                            <img src="./img/home/aniversario_barcelona.jpg" alt="event">
                            <div class="event_text">
                                <b>Gala de aniversario de FC Barcelona</b>
                                <p>A special celebration with music, history, and passion for Barça fans.</p>
                                </div>
                            </div>
                        </a>
                </div>
            </div>
        </div>
        <hr>
        <div class="event_section">
            <h3>Upcoming Events</h3>
            <div class="events_container">
                <div class="events">
                    <a href="EventPage.php">
                        <div class="event">
                        <img src="./img/home/circo_event.jpg" alt="event">
                        <div class="event_text">
                            <b>Festival Circorts</b>
                                <p>Contemporary circus, street art, and live shows for all ages.</p>
                            </div>
                        </div>
                    </a>
                    <a href="EventPage.php">
                        <div class="event">
                            <img src="./img/home/robbie_williams.jpg" alt="event">
                            <div class="event_text">
                                <b>Robbie Williams</b>
                                <p>The iconic British singer live in concert with his greatest hits.</p>
                            </div>
                        </div>
                    </a>
                    <a href="EventPage.php">
                        <div class="event">
                            <img src="./img/home/starwars_event.jpg" alt="event">
                            <div class="event_text">
                                <b>Cosplay event</b>
                                <p>An epic gathering for Star Wars fans and pop culture lovers.</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

    </main>
    <footer>
        <div class="footer_imgs">
            <a href="home.php"><img src="./img/sign/facebook_logo.png" alt="logo of facebook"></a>
            <a href="home.php"><img src="./img/home/instagram_logo.png" alt="logo of instagram"></a>
            <a href="home.php"><img src="./img/home/youtube_logo.png" alt="logo of youtube"></a>
            <a href="home.php"><img src="./img/home/twitter_logo.png" alt="logo of twitter_logo"></a>
        </div>
    </footer> -->
    <div id="popUpDiv" style="
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #DFB885;
        padding: 20px;
        border: 5px solid white;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    ">
        <h1>Account deleted successfully!</h1>
    </div>


    <?php if ($showPopup): ?>
        <script>
        window.addEventListener("DOMContentLoaded", function () {
            const popup = document.getElementById("popUpDiv");
            popup.style.display = "block";
            setTimeout(() => {
            popup.style.display = "none";
            }, 3000);
        });
        </script>
    <?php endif; ?>

</body>
</html>