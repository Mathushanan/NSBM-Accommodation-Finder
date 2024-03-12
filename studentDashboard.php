<?php

session_start();

include("config.php");

if (!isset($_SESSION['userEmail']) || $_SESSION['userType'] != "Student") {
    header("Location: login.php");
    exit();
}


function fetchAllAccommodations($connection)
{
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


            $longitude = $row['longitude'];
            $latitude = $row['latitude'];



            echo '<div class="card" data-latitude="' . $latitude . '" data-longitude="' . $longitude . '">';

            echo '<div class="card__content">';



            echo '<h2 class="card__title">' . $row["title"] . '</h2>';
            echo '<p class="card__description">' . substr($row['description'], 0, 60) . '...</p>';

            echo '<div class="card__details">';
            echo '<p class="beds"><strong>' . $row["bedCounts"] . '</strong> Beds Available</p>';
            echo '<p class="beds"><strong>Posted at</strong> ' . date("Y-m-d", strtotime($row["postedAt"])) . '</p>';
            echo '</div>';

            echo '<div class="card_footer">';
            if ($row["bedCounts"] > 0) {
                echo '<span class="available_status">Available</span>';
            } else {
                echo '<span class="not_available_status">Not Available</span>';
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
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniNest NSBM</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
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





    <section class="section__container landlord_dashboard_section__container" id="all_accommodations_section">
        <div class="webadmin_dashboard_buttons_container">
            <a href="studentReservations.php"><button class="big-button" id="pendingBtn">My Reservations</button></a>

        </div>
    </section>

    <section class="section__container webadmin_dashboard_section__container" id="studentDashboard_section">
        <h2 class="section__header">Browse Accommodations</h2>

        <div class="webadmin_dashboard_accommodation_container">
            <div class="property-cards-container">

                <?php



                fetchAllAccommodations($connection);

                ?>
            </div>
            <div class="box form-box map-container" id="map-container">

                <div id="map"></div>
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




    <div id="propertyModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <img id="modalImage" src="" alt="Property Image">
        <h2 id="modalTitle"></h2>
        <p id="modalDescription"></p>
        <div id="modalDetails"></div>
        <button id="reserveBtn">Reserve</button>
    </div>
</div>




    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        let map = L.map('map').setView([6.8208936, 80.03972288538341], 15);


        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        let marker = L.marker([6.8208936, 80.03972288538341]).addTo(map);

        function updateMarkerPosition(latitude, longitude) {
            marker.setLatLng([latitude, longitude]);
        }

        document.querySelectorAll('.card').forEach(card => {
            card.addEventListener('click', function() {

                const latitude = parseFloat(this.dataset.latitude);
                const longitude = parseFloat(this.dataset.longitude);

                updateMarkerPosition(latitude, longitude);
  
                map.setView([latitude, longitude], 15);
            });
        });



        window.addEventListener('load', function() {
            var mapContainer = document.getElementById('map-container');
            var propertyCardsContainer = document.querySelector('.property-cards-container');
            var windowHeight = window.innerHeight;
            var propertyCardsContainerHeight = propertyCardsContainer.offsetHeight;
            var mapHeight = windowHeight > propertyCardsContainerHeight ? windowHeight : propertyCardsContainerHeight;

            mapContainer.style.height = mapHeight + 'px';
        });


        window.addEventListener('resize', function() {
            var mapContainer = document.getElementById('map-container');
            var propertyCardsContainer = document.querySelector('.property-cards-container');
            var windowHeight = window.innerHeight;
            var propertyCardsContainerHeight = propertyCardsContainer.offsetHeight;
            var mapHeight = windowHeight > propertyCardsContainerHeight ? windowHeight : propertyCardsContainerHeight;

            mapContainer.style.height = mapHeight + 'px';
        });







        var modal = document.getElementById("propertyModal");


        var closeBtn = document.getElementsByClassName("close")[0];

        closeBtn.onclick = function() {
            modal.style.display = "none";
        }


        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }


        function openModal(title, description, details, imageSrc) {
            document.getElementById("modalTitle").innerText = title;
            document.getElementById("modalDescription").innerText = description;
            document.getElementById("modalDetails").innerHTML = details;
            document.getElementById("modalImage").src = imageSrc;
            modal.style.display = "block";
        }


        document.getElementById("reserveBtn").addEventListener("click", function() {

            window.location.href = "reservation.php?title=" + encodeURIComponent(document.getElementById("modalTitle").innerText) +
                "&description=" + encodeURIComponent(document.getElementById("modalDescription").innerText) +
                "&details=" + encodeURIComponent(document.getElementById("modalDetails").innerHTML);
        });


        document.querySelectorAll('.card').forEach(card => {
            card.addEventListener('click', function() {

                const title = this.querySelector('.card__title').innerText;
                const description = this.querySelector('.card__description').innerText;
                const details = this.querySelector('.card__details').innerHTML;
                const imageSrc = this.querySelector('.card__image img').src;

                openModal(title, description, details, imageSrc);
            });
        });
    </script>

</body>

</html>