
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
            <li class="link"><a href="login.php">Login</a></li>
        </ul>
    </nav>










        <section class="section__container card__container" id="articles_section">
            <h2 class="section__header">All Articles</h2>

            <div class="articles_card__content">
                <div class="swiper-wrapper">

                    <?php
                    include("config.php");

                    $query = "SELECT title, content FROM articles";
                    $result = mysqli_query($connection, $query);

                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<article class="card__article">';
                            echo '<div class="card__data">';
                            echo '<h3 class="card__name">' . $row['title'] . '</h3>';
                            echo '<p class="card__description">' . substr($row['content'], 0, 400) . '</p>';
                            echo '<a href="#" class="card__button">Read</a>';
                            echo '</div>';
                            echo '</article>';
                        }
                        mysqli_free_result($result);
                    } else {
                        echo "Error: " . $query . "<br>" . mysqli_error($connection);
                    }
                    mysqli_close($connection);
                    ?>

                </div>
            </div>
        </section>


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