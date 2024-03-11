<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniNest NSBM</title>
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css\all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css" crossorigin="">
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/slider-styles.css?v=<?php echo time(); ?>">
</head>

<body>



    <nav>
        <div class="nav__logo">UniNest NSBM</div>
        <ul class="nav__links">
            <li class="link"><a href="#home_section">Home</a></li>
            <li class="link"><a href="#popular_section">Accomodations</a></li>
            <li class="link"><a href="#blog_section">Blog</a></li>
            <li class="link"><a href="#footer_section">Contact</a></li>
            <li class="link"><a href="login.php">Login</a></li>
        </ul>
    </nav>



    <header class="section__container header__container" id="home_section">
        <div class="header__image__container">
            <div class="header__content">
                <h1>Discover Accommodation Options</h1>
                <p>Specifically for NSBM Students!</p>
            </div>
            <div class="booking__container">
                <form>
                    <div class="form__group">
                        <div class="input__group">
                            <input type="text" />
                            <label>Location</label>
                        </div>
                        <p>Where are you looking to stay?</p>
                    </div>
                    <div class="form__group">
                        <div class="input__group">
                            <input type="text" />
                            <label>Minimum Rent</label>
                        </div>
                        <p>What is your minimum budget?</p>
                    </div>
                    <div class="form__group">
                        <div class="input__group">
                            <input type="text" />
                            <label>Maximum Rent</label>
                        </div>
                        <p>What is your maximum budget?</p>
                    </div>

                </form>
                <button class="btn"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </div>
    </header>





    <section class="section__container new_accommodations__container" id="new_accommodations_section">
        <h2 class="section__header">New Accommodations</h2>
        <div class="slider">
            <div class="slides">
                <?php

                include("config.php");

                $sql = "SELECT properties.*, images.imageData 
                FROM properties 
                INNER JOIN (
                    SELECT propertyId, MAX(imageId) AS maxImageId 
                    FROM images 
                    GROUP BY propertyId
                ) AS latest_images ON properties.propertyId = latest_images.propertyId
                INNER JOIN images ON latest_images.maxImageId = images.imageId
                ORDER BY properties.postedAt DESC";
                $result = $connection->query($sql);

                if ($result && $result->num_rows > 0) {

                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="new_accommodations__card">';
                        echo '<img src="data:image/jpeg;base64,' . base64_encode($row["imageData"]) . '" alt="Accommodation" />';
                        echo '<div class="new_accommodations__content">';
                        echo '<div class="new_accommodations__card__header">';
                        echo '<h4>' . $row["title"] . '</h4>';
                        echo '<span class="rent"><h4>' . $row["rent"] . '</h4></span>';
                        echo '</div>';
                        echo '<p>' . substr($row['description'], 0, 80) . '...</p>';
                        echo '<p class="posted_at"><span>Posted at: </span>' . date("Y-m-d", strtotime($row["postedAt"])) . '</p>';
                        echo '<a href="login.php"><button class="reserve__button">Reserve</button></a>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo "No new accommodations found.";
                }

                $connection->close();
                ?>
            </div>
        </div>
        <div class="pagination"></div>
    </section>





    <section class="section__container card__container swiper" id="blog_section">
        <h2 class="section__header">Explore Our Accommodation Guides</h2>
        <div class="card__content">
            <div class="swiper-wrapper">

                <?php

                include("config.php");


                $query = "SELECT title, content FROM articles";
                $result = mysqli_query($connection, $query);

                if ($result) {

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<article class="card__article swiper-slide">';
                        echo '<div class="card__data">';
                        echo '<h3 class="card__name">' . $row['title'] . '</h3>';
                        echo '<p class="card__description">' . substr($row['content'], 0, 200) . '</p>';
                        echo '<a href="articles.php" class="card__button">Read</a>';
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

        <!-- Navigation buttons -->
        <div class="swiper-button-next">
            <i class="ri-arrow-right-s-line"></i>
        </div>

        <div class="swiper-button-prev">
            <i class="ri-arrow-left-s-line"></i>
        </div>

        <!-- Pagination -->
        <div class="swiper-pagination"></div>
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














    <script src="assets/js/swiper-bundle.min.js"></script>
    <script src="<?php echo 'assets/js/main.js?v=' . filemtime('assets/js/main.js'); ?>"></script>





</body>

</html>