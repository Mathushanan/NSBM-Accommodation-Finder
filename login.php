<?php

session_start();

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
            <li class="link"><a href="register.php">Register</a></li>
        </ul>
    </nav>





    <div class="login-container">
        <div class="box form-box">
            <?php

            include("config.php");
            if (isset($_POST['submit'])) {

                $userEmail = mysqli_real_escape_string($connection, $_POST['user_email']);
                $userPassword = mysqli_real_escape_string($connection, $_POST['user_password']);

                $result = mysqli_query($connection, "SELECT * FROM users WHERE email='$userEmail' AND password='$userPassword'") or die("Error while selecting records from database");
                $row = mysqli_fetch_assoc($result);

                if (is_array($row) && !empty($row)) {

                    $_SESSION['userEmail'] = $row['email'];
                    $_SESSION['userName'] = $row['name'];
                    $_SESSION['userMobile'] = $row['mobile'];
                    $_SESSION['userGender'] = $row['gender'];
                    $_SESSION['userType'] = $row['userType'];

                    if (isset($_SESSION['userEmail'])) {
                    
                        header("Location: index.php");
                    }

                } else {

                    echo " <div class='errorMessageBox'>
                                  <p>Wrong Email or Password!</p>
                              </div><br>
                ";
                    echo " <a href='login.php'>
                           <button class='btn back-btn'>Go Back </button>
                       </a>  
                ";
                }
                
            } else {

            ?>



                <header>Login</header>
                <form action="" method="post">
                    <div class="field input">
                        <label for="user_email">Email</label>
                        <input type="text" name="user_email" id="user_email" required>
                    </div>
                    <div class="field input">
                        <label for="user_password">Password</label>
                        <input type="password" name="user_password" id="user_password" required>
                    </div>
                    <div class="field">
                        <input type="submit" class="btn" name="submit" value="LOGIN">
                    </div>
                    <div class="link">
                        Don't have Account? <a href="register.php">Register</a>
                    </div>
                </form>
        </div>

    </div>












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

<?php } ?>
</body>

</html>