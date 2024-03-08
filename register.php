
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
            <li class="link"><a href="login.php">Register</a></li>
        </ul>
    </nav>
    <div class="login-container">
        <div class="box form-box register-box">

            
                <header>Register</header>
                <form action="" method="post" id="form">
                    <div class="field input">
                        <select id="type" name="type">
                            <option value="Parmacy User">Landlord</option>
                            <option value="Normal User">Warden</option>
                            <option value="Normal User">Student</option>
                        </select>
                    </div>
                    <div class="field input">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" required>
                    </div>
                    <div class="field input">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" required>
                    </div>
                    <div class="field input">
                        <label for="mobile">Mobile</label>
                        <input type="text" name="mobile" id="mobile" required>
                    </div>
                   
        
                    <div class="field input">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" required>
                    </div>
                    <div class="field input">
                        <label for="cpassword">Confirm Password</label>
                        <input type="password" name="cpassword" id="cpassword" required>
                    </div>
                    <div class="field">
                        <button type="submit" class="btn" name="submit" value="SIGNUP" >SIGNUP</button>
                    </div>
                    <div class="link">
                        Already have an Account? <a href="login.php">LOGIN</a>
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
        document.getElementById("form").onsubmit = function() {
            return validateForm();
        };
        var validateForm = () => {

  
            let valid = true;
            const nameInput = document.getElementById("name");
            if (nameInput.value.trim() === "") {
                valid = false;
                alert("Name is required");
            }

            const emailInput = document.getElementById("email");
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(emailInput.value)) {
                valid = false;
                alert("Invalid email address");
            }

            const mobileInput = document.getElementById("mobile");
            const mobileRegex = /^[0-9]{10}$/;
            if (!mobileRegex.test(mobileInput.value)) {
                valid = false;
                alert("Invalid mobile number");
            }

            const addressInput = document.getElementById("address");
            if (addressInput.value.trim() === "") {
                valid = false;
                alert("Address is required");
            }

            const dobInput = document.getElementById("dob");
            if (dobInput.value === "") {
                valid = false;
                alert("Date of Birth is required");
            }

            const passwordInput = document.getElementById("password");
            const cpasswordInput = document.getElementById("cpassword");
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


</body>

</html>