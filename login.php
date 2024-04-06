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
    <div class="nav__logo"><span id="uni">Uni</span><span id="nest">Nest</span></span></div>
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
                    
                    $_SESSION['userId']=$row['userId'];
                    $_SESSION['userEmail'] = $row['email'];
                    $_SESSION['userName'] = $row['name'];
                    $_SESSION['userMobile'] = $row['mobile'];
                    $_SESSION['userGender'] = $row['gender'];
                    $_SESSION['userType'] = $row['userType'];

                    if (isset($_SESSION['userEmail'])) {

                        if ($_SESSION['userType'] == "Student") {

                            header("Location: studentDashboard.php");
                            
                        } else if ($_SESSION['userType'] == "Warden") {

                            header("Location: wardenDashboard.php");
                            
                        } else if ($_SESSION['userType'] == "Landlord") {

                            header("Location: landlordDashboard.php");

                        } else {

                            header("Location: webadminDashboard.php");

                        }
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



                <header><span>Login</span>  <i class="fas fa-sign-in-alt"></i></header>

                
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
                        Don't have an Account? <a href="register.php">Register</a>
                    </div>
                </form>
        </div>

    </div>












    <?php include ("footer.php")?>

<?php } ?>
</body>

</html>