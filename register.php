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













    <div class="login-container">
        <div class="box form-box register-box">

            <?php

            include("config.php");

            if (isset($_POST['submit'])) {

                $userType = $_POST['user_type'];
                $userName = $_POST['user_name'];
                $userEmail = $_POST['user_email'];
                $userMobile = $_POST['user_mobile'];
                $userPassword = $_POST['user_password'];
                $userGender = $_POST['user_gender'];


                $verifyQuery = mysqli_query($connection, "SELECT * FROM users WHERE email='$userEmail'");

                if (mysqli_num_rows($verifyQuery) != 0) {
                    echo " <div class='errorMessageBox'>
                           <p> This email address is already registered!</p>
                       </div><br>
                ";
                    echo " <a href='javascript:self.history.back()'>
                           <button class='btn back-btn'>Go Back </button>
                       </a>  
                ";
                } else {
                    $result = mysqli_query($connection, "INSERT INTO users (name,email,mobile,gender,password,userType) VALUES ('$userName','$userEmail','$userMobile','$userGender','$userPassword','$userType')");

                    if ($result) {
                        echo " <div class='successMessageBox'>
                              <p>You are successfully registered as a $userType!
                          </div><br>
                ";
                        echo " <a href='login.php'>
                              <button class='btn'>Login Now</button>
                           </a>  
                ";
                    } else {

                        echo " <div class='errorMessageBox'>
                                  <p>Failed to register!</p>
                              </div><br>
                ";
                        echo " <a href='javascript:self.history.back()'>
                           <button class='btn'>Go Back </button>
                       </a>  
                ";
                    }
                }
            } else {


            ?>


                <header>Register</header>

                <form action="" method="post" id="register_form">

                    <div class="field input">
                        <select id="user_type" name="user_type">
                            <option value="Landlord">Landlord</option>
                            <option value="Warden">Warden</option>
                            <option value="Student">Student</option>
                        </select>
                    </div>

                    <div class="field input">
                        <label for="user_name">Name</label>
                        <input type="text" name="user_name" id="user_name" required>
                    </div>

                    <div class="field input">
                        <label for="user_email">Email</label>
                        <input type="text" name="user_email" id="user_email" required>
                    </div>

                    <div class="field input">
                        <label for="user_mobile">Mobile</label>
                        <input type="text" name="user_mobile" id="user_mobile" required>
                    </div>

                    <div class="field input">
                        <label for="user_password">Password</label>
                        <input type="password" name="user_password" id="user_password" required>
                    </div>

                    <div class="field input">
                        <label for="user_cpassword">Confirm Password</label>
                        <input type="password" name="user_cpassword" id="user_cpassword" required>
                    </div>

                    <div class="field input">
                        <select id="user_gender" name="user_gender">
                            <option value="Female">Female</option>
                            <option value="Male">Male</option>
                        </select>
                    </div>

                    <div class="field">
                        <button type="submit" class="btn" name="submit" value="SIGNUP">SIGNUP</button>
                    </div>

                    <div class="link">
                        Already have an Account? <a href="login.php">Login</a>
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


    <script>
        document.getElementById("register_form").onsubmit = function() {
            return validateForm();
        };
        var validateForm = () => {


            let valid = true;
            const nameInput = document.getElementById("user_name");
            if (nameInput.value.trim() === "") {
                valid = false;
                alert("Name is required");
            }

            const emailInput = document.getElementById("user_email");
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(emailInput.value)) {
                valid = false;
                alert("Invalid email address");
            }

            const mobileInput = document.getElementById("user_mobile");
            const mobileRegex = /^[0-9]{10}$/;
            if (!mobileRegex.test(mobileInput.value)) {
                valid = false;
                alert("Invalid mobile number");
            }

            const passwordInput = document.getElementById("user_password");
            const cpasswordInput = document.getElementById("user_cpassword");
            if (passwordInput.value.length < 6) {
                valid = false;
                alert("Password must be at least 6 characters");
            } else if (passwordInput.value !== cpasswordInput.value) {
                valid = false;
                alert("Passwords do not match");
            }

            if (valid) {
                return true;
            } else {
                return false;
            }
        }
    </script>

<?php } ?>
</body>

</html>