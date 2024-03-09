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
            <li class="link"><a href="webadminDashboard.php">Dashboard</a></li>
            <li class="link"><a href="index.php">Home</a></li>
            <li class="link"><a href="#footer_section">Contact</a></li>
            <li class="link"><a href="logout.php">Logout</a></li>
        </ul>
    </nav>













    <div class="login-container">
        <div class="box form-box register-box">

            <?php

            include("config.php");

            if (isset($_POST['submit'])) {

                $title = $_POST['title'];
                $content = $_POST['content'];



                $verifyQuery = mysqli_query($connection, "SELECT * FROM articles WHERE title='$title'");

                if (mysqli_num_rows($verifyQuery) != 0) {
                    echo " <div class='errorMessageBox'>
                           <p>Already there is an article with this title!</p>
                       </div><br>
                ";
                    echo " <a href='javascript:self.history.back()'>
                           <button class='btn back-btn'>Go Back </button>
                       </a>  
                ";
                } else {
                    $stmt = mysqli_prepare($connection, "INSERT INTO articles (title, content) VALUES (?, ?)");
                    mysqli_stmt_bind_param($stmt, "ss", $title, $content);
                    $result = mysqli_stmt_execute($stmt);

                    if ($result) {
                        echo " <div class='successMessageBox'>
                              <p>Article successfully posted!
                          </div><br>
                ";
                        echo " <a href='webadminDashboard.php'>
                              <button class='btn send-btn'>Go Back</button>
                           </a>  
                ";
                    } else {

                        echo " <div class='errorMessageBox'>
                                  <p>Failed to post article!</p>
                              </div><br>
                ";
                        echo " <a href='javascript:self.history.back()'>
                           <button class='btn back-btn'>Go Back </button>
                       </a>  
                ";
                    }
                }
            } else {


            ?>


                <header>Post Article</header>

                <form action="" method="post" id="article_form">

                    <div class="field input">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" required>
                    </div>

                    <div class="field textarea">
                        <label for="content">Content</label>
                        <textarea name="content" id="content" required></textarea>
                    </div>


                    <div class="field">
                        <button type="submit" class="btn" name="submit" value="SIGNUP">POST</button>
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
        document.getElementById("article_form").onsubmit = function() {
            return validateForm();
        };
        var validateForm = () => {


            let valid = true;
            const nameInput = document.getElementById("title");
            if (nameInput.value.trim() === "") {
                valid = false;
                alert("Title is required");
            }
            const contentInput = document.getElementById("content");
            if (nameInput.value.trim() === "") {
                valid = false;
                alert("Content is required");
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