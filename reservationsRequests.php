<?php

session_start();

include("config.php");

if (!isset($_SESSION['userEmail']) || $_SESSION['userType'] != "Landlord") {
    header("Location: login.php");
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && isset($_POST['reservationId'])) {
    $action = $_POST['action'];
    $reservationId = $_POST['reservationId'];

    if ($action === 'accept') {

        $sql = "UPDATE reservations SET status = 'Accepted' WHERE reservationId = $reservationId";
        if ($connection->query($sql) === TRUE) {

            echo "Reservation accepted successfully";
        } else {

            echo "Error accepting reservation";
        }
    } elseif ($action === 'reject') {

        $sql = "UPDATE reservations SET status = 'Rejected' WHERE reservationId = $reservationId";
        if ($connection->query($sql) === TRUE) {

            echo "Reservation rejected successfully";
        } else {

            echo "Error rejecting reservation";
        }
    } else {

        echo "Invalid action";
    }
    exit();
}




$headerText = "Pending Properties";

function fetchAccommodationsByStatus($connection, $status)
{
    $userId = $_SESSION['userId'];
    $sql = "SELECT reservations.*, properties.title, properties.description, properties.bedCounts, properties.postedAt, properties.rent, properties.longitude, properties.latitude, properties.locationLink, properties.status AS propertyStatus, images.imageData, users.userId AS studentId 
            FROM reservations
            INNER JOIN properties ON reservations.propertyId = properties.propertyId
            INNER JOIN users ON reservations.userId = users.userId
            LEFT JOIN (
                SELECT propertyId, MIN(imageId) AS minImageId
                FROM images
                GROUP BY propertyId
            ) AS min_images ON properties.propertyId = min_images.propertyId
            LEFT JOIN images ON min_images.minImageId = images.imageId
            WHERE properties.userId = $userId AND reservations.status = '$status'";

    $result = $connection->query($sql);

    if ($result && $result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {

            $studentId = $row['studentId'];

            $fetchStudentSql = "SELECT * FROM users WHERE userId = $studentId";

            $studentResult = $connection->query($fetchStudentSql);

            if ($studentResult) {
                while ($student_row = $studentResult->fetch_assoc()) {
                    $name = $student_row['name'];
                    $email = $student_row['email'];
                    $mobile = $student_row['mobile'];
                    $gender = $student_row['gender'];
                }
            } else {
                echo "Error: " . $connection->error;
            }




            echo '<div class="card" id="card_' . $row['reservationId'] . '">';

            echo '<div class="card__content">';
            if ($row["status"] == "Pending") {
                echo '<form id="reservationForm_' . $row['reservationId'] . '" method="post">';
                echo '<div class="card__buttons">';
                echo '<input type="hidden" name="reservationId" value="' . $row["reservationId"] . '">';
                echo '<button type="button" class="delete-button" onclick="rejectReservation(' . $row['reservationId'] . ')">Reject</button>';
                echo '<button type="button" class="accept-button" onclick="acceptReservation(' . $row['reservationId'] . ')">Accept</button>';
                echo '</div>';
                echo '</form>';
            }
            echo '<h2 class="card__title">' . $row["title"] . '</h2>';
            echo '<p class="card__description">' . substr($row['description'], 0, 60) . '...</p>';
            
            echo '<div class="card__details">';
            echo '<p class="beds"><strong>Beds Available</strong>' . $row["bedCounts"] . '</p>';
            echo '<p class="beds"><strong>Posted at</strong> ' . date("Y-m-d", strtotime($row["postedAt"])) . '</p>';
            echo '</div>';
            
            echo '<div class="user-details">';
            echo  '<p>Reserved By</p>';
            echo  '<p>' . $name . '</p>';
            echo  '<p>' . $email . '</p>';
            echo  '<p>' . $mobile . '</p>';
            echo  '<p>' . $gender . '</p>';
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
        echo "Error: " . $connection->error;
        echo "No accommodations found.";
    }
}
if (isset($_GET['status'])) {
    $status = $_GET['status'];
    if ($status === 'Pending' || $status === 'Accepted' || $status === 'Rejected') {
        $headerText = ucfirst($status) . " Properties";
    }
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

    <script>
        function acceptReservation(reservationId) {
            performAction(reservationId, 'accept');
        }

        function rejectReservation(reservationId) {
            performAction(reservationId, 'reject');
        }

        function performAction(reservationId, action) {
            var formData = new FormData();
            formData.append('action', action);
            formData.append('reservationId', reservationId);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'reservationsRequests.php', true);
            xhr.onload = function() {
                if (xhr.status === 200) {

                    console.log(xhr.responseText);

                    var card = document.getElementById('card_' + reservationId);
                    if (card) {
                        card.style.display = 'none';
                    }

                } else {

                    console.error('Error performing action: ' + xhr.statusText);
                }
            };
            xhr.onerror = function() {

                console.error('Network error occurred');
            };
            xhr.send(formData);
        }
    </script>
</head>

<body>



    <nav>
        <div class="nav__logo">UniNest NSBM</div>
        <ul class="nav__links">
            <li class="link"><a href="index.php">Home</a></li>
            <li class="link"><a href="landlordDashboard.php">Dashboard</a></li>
            <li class="link"><a href="#footer_section">Contact</a></li>
            <li class="link"><a href="logout.php">Logout</a></li>
        </ul>
    </nav>






    <section class="section__container landlord_dashboard_section__container" id="all_accommodations_section">
        <div class="webadmin_dashboard_buttons_container">
            <a href="?status=Pending"><button class="big-button" id="pendingBtn">Pending</button></a>
            <a href="?status=Accepted"><button class="big-button" id="acceptedBtn">Accepted</button></a>
            <a href="?status=Rejected"><button class="big-button" id="rejectedBtn">Rejected</button></a>
        </div>
    </section>





    <section class="section__container webadmin_dashboard_section__container" id="wardenDashboard_section">
        <h2 class="section__header"><?php echo $headerText; ?></h2>
        <div class="webadmin_dashboard_accommodation_container reservationsRequestsContainer">


            <?php
            if (isset($_GET['status'])) {
                $status = $_GET['status'];
                if ($status === 'Pending' || $status === 'Accepted' || $status === 'Rejected') {
                    $headerText = ucfirst($status) . " Properties";

                    fetchAccommodationsByStatus($connection, $status);
                    exit();
                }
            } else {

                fetchAccommodationsByStatus($connection, 'Pending');
                exit();
            }


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