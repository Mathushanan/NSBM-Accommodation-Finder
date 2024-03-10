<?php

session_start();

include("config.php");

if (!isset($_SESSION['userEmail']) || $_SESSION['userType'] != "Landlord") {
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
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
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


    <section class="section__container post_property_section__container" id="popular_section">
        <h2 class="section__header">Post New Accommodation</h2>



        <div class="form_map_container">
            <div class="box form-box left-box">
                <form id="propertyForm">

                    <div class="field input">
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title">
                    </div>

                    <div class="field textarea">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" required></textarea>
                    </div>

                    <div class="field input">
                        <label for="locationLink">Location Link</label>
                        <input type="text" id="locationLink" name="locationLink" disabled>
                    </div>

                    <div class="field input">
                        <label for="latitude">Latitude</label>
                        <input type="text" id="latitude" name="latitude" disabled>
                    </div>

                    <div class="field input">
                        <label for="longitude">Longitude</label>
                        <input type="text" id="longitude" name="longitude" disabled>
                    </div>

                    <div class="field input">
                        <label for="rent">Rent</label>
                        <input type="text" id="rent" name="rent">
                    </div>

                    <div class="field input">
                        <label for="bedCounts">Bed Counts</label>
                        <input type="number" id="bedCounts" name="bedCounts">
                    </div>


                    <div class="field">
                        <button type="submit" class="btn" name="submit" value="POST">POST</button>
                    </div>

                </form>
            </div>


            <div class="box form-box right-box">

                <div id="searchBox">
                    <input type="text" id="searchInput" placeholder="Enter a location">
                    <button onclick="searchLocation()">Search</button>
                </div>

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









    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        let map = L.map('map').setView([51.505, -0.09], 13); // Default view

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        let marker;

        function searchLocation() {
            const searchInput = document.getElementById('searchInput').value;

            fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${searchInput}`)
                .then(response => response.json())
                .then(data => {
                    if (data && data.length > 0) {
                        const {
                            lat,
                            lon
                        } = data[0];
                        const newLatLng = new L.LatLng(lat, lon);
                        map.setView(newLatLng, 13); // Zoom level may vary
                        if (marker) {
                            map.removeLayer(marker);
                        }
                        marker = L.marker(newLatLng).addTo(map);
                        document.getElementById('locationLink').value = `https://www.openstreetmap.org/?mlat=${lat}&mlon=${lon}`;
                        document.getElementById('latitude').value = lat;
                        document.getElementById('longitude').value = lon;
                    } else {
                        console.log('Location not found');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>

</body>

</html>