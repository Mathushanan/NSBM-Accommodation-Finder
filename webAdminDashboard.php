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
            <a href="postArticle.php"><button class="big-button">Post New Article</button></a>
        </div>

    </section>



    <section class="section__container webadmin_dashboard_section__container" id="popular_section">
        <h2 class="section__header">All Accommodations</h2>
        <div class="webadmin_dashboard_accommodation_container">
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
                    echo '<div class="card">';

                    echo '<div class="card__content">';

                    echo '<div class="card__buttons">';
                    echo '<button class="delete-button">Delete</button>';
                    echo '<button class="update-button">Update</button>';
                    echo '</div>';

                    echo '<h2 class="card__title">' . $row["title"] . '</h2>';
                    echo '<p class="card__description">' . substr($row['description'], 0, 60) . '...</p>';

                    echo '<div class="card__details">';
                    echo '<p class="beds"><strong>' . $row["bedCounts"] . '</strong> Beds Available</p>';
                    echo '<p class="beds"><strong>Posted at</strong> ' . date("Y/m/d", strtotime($row["postedAt"])) . '</p>';
                    echo '</div>';

                    echo '<div class="card_footer">';
                    if ($row["bedCounts"] > 0) {
                        echo '<span class="available_status">Available</span>';
                    } else {
                        echo '<span class="not_available_status">Not Available</span>';
                    }
                    if ($row["status"] == "Pending") {
                        echo '<span class="pending_status">Pending</span>';
                    }
                    if ($row["status"] == "Accepted") {
                        echo '<span class="accepted_status">Accepted</span>';
                    }
                    if ($row["status"] == "Rejected") {
                        echo '<span class="rejected_status">Rejected</span>';
                    }

                    echo '<span class="rent">' . $row["rent"] . '</span>';
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="card__image">';
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($row["imageData"]) . '" alt="' . $row["title"] . '">';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "No accommodations found.";
            }

            $connection->close();
            ?>
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