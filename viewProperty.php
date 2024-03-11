<?php

session_start();

include("config.php");

if (!isset($_SESSION['userEmail']) || $_SESSION['userType'] != "Warden") {
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

    <?php

    include("config.php");


    $selectQuery = "SELECT imageData FROM images WHERE propertyId={$_GET['property_id']}";
    $big_result = $connection->query($selectQuery);
    $small_result = $connection->query($selectQuery);

    $selectUserIdQuery = "SELECT userId FROM properties WHERE propertyId={$_GET['property_id']}";
    $result = $connection->query($selectUserIdQuery);
    if ($result) {

        $row = $result->fetch_assoc();
        if ($row) {

            $landlordId = $row['userId'];
        }
    }
    $selectUserDeatils = "SELECT name,email,mobile,gender FROM users WHERE userId=$landlordId";
    $sql = "SELECT name,email,mobile,gender FROM users WHERE userId=$landlordId";

    // Execute query
    $userResult = $connection->query($sql);

    if ($userResult) {
        // Check if any rows were returned
        if ($userResult->num_rows > 0) {
            // Fetch associative array
            $row = $userResult->fetch_assoc();

            // Store data in separate variables
            $name = $row["name"];
            $email = $row["email"];
            $mobile = $row["mobile"];
            $gender = $row["gender"];

            // Now $name, $email, $mobile, and $gender variables hold the retrieved data
            // You can use them as needed
        } else {
            echo "No records found";
        }
    } else {
        echo "Error: " . $conn->error;
    }

    // Close connection
    $connection->close();

    ?>


    <section class="section__container viewProperty_section__container" id="my_accommodations_section">

        <div class="main-box">



            <div class="property-card">
                <h2><?php echo $_GET['title']; ?></h2>
                <p><?php echo $_GET['description']; ?></p>
                <p><strong>Spaces Available: </strong><?php echo $_GET['bedCounts']; ?></p>
                <p><strong>Posted At: </strong><?php echo $_GET['postedAt']; ?></p>
                <p><strong>Rent: </strong><?php echo $_GET['rent']; ?></p>
                <a href="<?php echo $_GET['locationLink']; ?>" target="_blank">Location</a>
                <div class="user-details">
                    <p><?php echo $name ?></p>
                    <p><?php echo $email ?></p>
                    <p><?php echo $mobile ?></p>
                </div>


            </div>


            <div class="image-viewer">
                <?php
                if ($big_result->num_rows > 0) {
                    $row = $big_result->fetch_assoc();
                    $bigImage = $row['imageData'];
                    $bigImageData = base64_encode($bigImage);

                    echo '<img src="data:image/jpeg;base64,' . $bigImageData . '" alt="Thumbnail 1"  id="big-image" >';
                }

                ?>

                <div id="small-image-container">
                    <?php
                    if ($small_result->num_rows > 0) {
                        $count = 1;
                        while ($row = $small_result->fetch_assoc()) {

                            $image = $row['imageData'];
                            $imageData = base64_encode($image);
                            $src = "data:image/jpeg;base64," . $imageData;
                            $borderStyle = '';
                            if ($count == 1) {
                                $borderStyle = 'border: 3px solid #4285f4;';
                            }
                            $imageId = "image" . $count;

                            echo "<img src='$src' alt='Thumbnail' class='small-images' id='$imageId'onclick='showImage(\"$src\",\"$imageId\")' style='$borderStyle'>";

                            $count++;
                        }
                    }
                    ?>
                </div>

            </div>



        </div>

        <div class="box form-box map-box">
            <div id="map"></div>
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
        function showImage(image, imageId) {
            document.getElementById('big-image').src = image;
            var allImages = document.getElementsByClassName('small-images');
            for (image of allImages) {
                image.style.border = 'none';
            }
            document.getElementById(imageId).style.border = '4px solid #4285f4';


        }

        let latitude = "<?php echo isset($_GET['latitude']) ? htmlspecialchars($_GET['latitude']) : ''; ?>";
        let longitude = "<?php echo isset($_GET['longitude']) ? htmlspecialchars($_GET['longitude']) : ''; ?>";
        let map = L.map('map').setView([latitude, longitude], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        let marker = L.marker([latitude, longitude]).addTo(map);;

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
                        map.setView(newLatLng, 13);
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