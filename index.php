<?php

session_start();
include("config.php");

?>



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

    <?php
    if (!isset($_SESSION['userEmail'])) {
        echo '
    <nav>
    <div class="nav__logo"><span id="uni">Uni</span><span id="nest">Nest</span></span></div>
        <ul class="nav__links">
            <li class="link"><a href="#home_section">Home</a></li>
            <li class="link"><a href="#new_accommodations_section">Accomodations</a></li>
            <li class="link"><a href="#blog_section">Blog</a></li>
            <li class="link"><a href="#footer_section">Contact</a></li>
            <li class="link"><a href="login.php">Login</a></li>
        </ul>
    </nav>';
    } else {
        if ($_SESSION['userType'] == "WebAdmin") {
            echo '
        <nav>
        <div class="nav__logo"><span id="uni">Uni</span><span id="nest">Nest</span></span></div>
            <ul class="nav__links">
                <li class="link"><a href="#home_section">Home</a></li>
                <li class="link"><a href="webadminDashboard.php">Dashboard</a></li>
                <li class="link"><a href="#new_accommodations_section">Accomodations</a></li>
                <li class="link"><a href="#blog_section">Blog</a></li>
                <li class="link"><a href="#footer_section">Contact</a></li>
                <li class="link"><a href="logout.php">Logout</a></li>
            </ul>
        </nav>';
        }
        if ($_SESSION['userType'] == "Student") {
            echo '
        <nav>
        <div class="nav__logo"><span id="uni">Uni</span><span id="nest">Nest</span></span></div>
            <ul class="nav__links">
                <li class="link"><a href="#home_section">Home</a></li>
                <li class="link"><a href="studentDashboard.php">Dashboard</a></li>
                <li class="link"><a href="#new_accommodations_section">Accomodations</a></li>
                <li class="link"><a href="#blog_section">Blog</a></li>
                <li class="link"><a href="#footer_section">Contact</a></li>
                <li class="link"><a href="logout.php">Logout</a></li>
            </ul>
        </nav>';
        }
        if ($_SESSION['userType'] == "Warden") {

            echo '
        <nav>
        <div class="nav__logo"><span id="uni">Uni</span><span id="nest">Nest</span></span></div>
            <ul class="nav__links">
                <li class="link"><a href="#home_section">Home</a></li>
                <li class="link"><a href="wardenDashboard.php">Dashboard</a></li>
                <li class="link"><a href="#new_accommodations_section">Accomodations</a></li>
                <li class="link"><a href="#blog_section">Blog</a></li>
                <li class="link"><a href="#footer_section">Contact</a></li>
                <li class="link"><a href="logout.php">Logout</a></li>
            </ul>
        </nav>';
        }
        if ($_SESSION['userType'] == "Landlord") {
            echo '
        <nav>
        <div class="nav__logo"><span id="uni">Uni</span><span id="nest">Nest</span></span></div>
            <ul class="nav__links">
                <li class="link"><a href="#home_section">Home</a></li>
                <li class="link"><a href="landlordDashboard.php">Dashboard</a></li>
                <li class="link"><a href="#new_accommodations_section">Accomodations</a></li>
                <li class="link"><a href="#blog_section">Blog</a></li>
                <li class="link"><a href="#footer_section">Contact</a></li>
                <li class="link"><a href="logout.php">Logout</a></li>
            </ul>
        </nav>';
        }
    }




    ?>



    <header class="section__container header__container">
        <div class="header__content">
            <span class="bg__blur"></span>
            <span class="bg__blur header__blur"></span>
            <h4>BEST ACCOMMODATION FOR NSBM STUDENTS</h4>
            <h1><span>FIND</span> YOUR IDEAL PLACE</h1>
            <p>
            Discover the perfect accommodation options tailored for NSBM University students. 
            Find a comfortable and convenient place to call home near your campus. 
            Start your search now!
            </p>
            <a href="register.php"><button class="btn">Sign Up</button></a>
        </div>
        <div class="header__image">
            <img src="assets/header.png" alt="header" />
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
                WHERE status='Accepted'
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


        <div class="swiper-button-next">
            <i class="ri-arrow-right-s-line"></i>
        </div>

        <div class="swiper-button-prev">
            <i class="ri-arrow-left-s-line"></i>
        </div>

        <div class="swiper-pagination"></div>
        </div>

    </section>













    <?php include ("footer.php")?>













    <script src="assets/js/swiper-bundle.min.js"></script>
    <script src="<?php echo 'assets/js/main.js?v=' . filemtime('assets/js/main.js'); ?>"></script>





</body>

</html>