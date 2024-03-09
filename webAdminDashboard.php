<?php

session_start();

include("config.php");

if (!isset($_SESSION['userEmail']) || $_SESSION['userType'] != "WebAdmin") {
    header("Location: login.php");
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniNest NSBM</title>
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css\all.min.css">
</head>

<body>



    <nav>
        <div class="nav__logo">UniNest NSBM</div>
        <ul class="nav__links">
            <li class="link"><a href="index.php">Home</a></li>
            <li class="link"><a href="#footer_section">Contact</a></li>
            <li class="link"><a href="logout.php">Logout</a></li>
        </ul>
    </nav>





    <section class="section__container webadmin_dashboard_section__container" id="popular_section">
        <div class="webadmin_dashboard_buttons_container">
            <a href="createAccount.php"><button class="big-button">Create New Account</button></a>
            <a href="createAccount.php"><button class="big-button">Post New Article</button></a>
        </div>

    </section>



    <section class="section__container webadmin_dashboard_section__container" id="popular_section">
        <h2 class="section__header">All Accommodations</h2>
        <div class="webadmin_dashboard_accommodation_container">
            <div class="card">
                <div class="card__content">
                    <h2 class="card__title">Green Hostel</h2>
                    <p class="card__description">Very clean and neat high quality rooms available near NSBM Green University</p>

                    <div class="card__details">
                        <p><strong>Mr.Bandara</strong></p>
                        <p class="address">13th NSBM road, Homagama</p>
                        <p class="beds"><strong>20</strong> Beds Available</p>
                    </div>

                    <div class="card_footer">
                        <span class="available_status">Available</span>
                        <span class="rent">Rs.18000</span>
                    </div>
                </div>

                <div class="card__image">
                    <img src="assets\header_pic.jpeg" alt="">
                </div>
            </div>
            <div class="card">
                <div class="card__content">
                    <h2 class="card__title">Green Hostel</h2>
                    <p class="card__description">Very clean and neat high quality rooms available near NSBM Green University</p>

                    <div class="card__details">
                        <p><strong>Mr.Bandara</strong></p>
                        <p class="address">13th NSBM road, Homagama</p>
                        <p class="beds"><strong>20</strong> Beds Available</p>
                    </div>

                    <div class="card_footer">
                        <span class="not_available_status">Not Available</span>
                        <span class="rent">Rs.18000</span>
                    </div>
                </div>

                <div class="card__image">
                    <img src="assets\header_pic.jpeg" alt="">
                </div>
            </div>
            <div class="card">
                <div class="card__content">
                    <h2 class="card__title">Green Hostel</h2>
                    <p class="card__description">Very clean and neat high quality rooms available near NSBM Green University</p>

                    <div class="card__details">
                        <p><strong>Mr.Bandara</strong></p>
                        <p class="address">13th NSBM road, Homagama</p>
                        <p class="beds"><strong>20</strong> Beds Available</p>
                    </div>

                    <div class="card_footer">
                        <span class="not_available_status">Not Available</span>
                        <span class="rent">Rs.18000</span>
                    </div>
                </div>

                <div class="card__image">
                    <img src="assets\header_pic.jpeg" alt="">
                </div>
            </div>
            <div class="card">
                <div class="card__content">
                    <h2 class="card__title">Green Hostel</h2>
                    <p class="card__description">Very clean and neat high quality rooms available near NSBM Green University</p>

                    <div class="card__details">
                        <p><strong>Mr.Bandara</strong></p>
                        <p class="address">13th NSBM road, Homagama</p>
                        <p class="beds"><strong>20</strong> Beds Available</p>
                    </div>

                    <div class="card_footer">
                        <span class="available_status">Available</span>
                        <span class="rent">Rs.18000</span>
                    </div>
                </div>

                <div class="card__image">
                    <img src="assets\header_pic.jpeg" alt="">
                </div>
            </div>
        </div>
    </section>














    <footer class="footer" id="footer_section">
        <div class="section__container footer__container">
            <div class="footer__col">
                <h3>UniNest NSBM</h3>
                <p>
                    UniNest NSBM is Your one-stop platform for hassle-free student accommodation near NSBM Green University Town.
                    With diverse housing options, finding your perfect place to stay has never been easier.

                </p>
                <p>
                    Say goodbye to accommodation worries and hello to a stress-free booking experience with UniNest NSBM.
                </p>
            </div>
            <div class="footer__col">
                <h4>Company</h4>
                <p>About Us</p>
                <p>Our Team</p>
                <p>Contact Us</p>
            </div>
            <div class="footer__col">
                <h4>Legal</h4>
                <p>FAQs</p>
                <p>Terms & Conditions</p>
                <p>Privacy Policy</p>
            </div>
            <div class="footer__col">
                <h4>Resources</h4>
                <ul class="social-icons">
                    <li><a href="#" class="fab fa-facebook-f"></a></li>
                    <li><a href="#" class="fab fa-twitter"></a></li>
                    <li><a href="#" class="fab fa-instagram"></a></li>
                    <li><a href="#" class="fab fa-linkedin-in"></a></li>
                </ul>
            </div>
        </div>

        <div class="footer__bar">
            Copyright © nsbm. All rights reserved.
        </div>

    </footer>

</body>

</html>