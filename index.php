
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniNest NSBM</title>
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
</head>

<body>
    <div class="nav">
        <div class="logo">
            <p>UniNest<span class="sub-logo">NSBM</span></p>
        </div>
        <div class="right-links">

        </div>
    </div>
    <div class="container">
        <div class="box form-box">
      
                <header>Login</header>
                <form action="" method="post">
                    <div class="field input">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" required>
                    </div>
                    <div class="field input">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" required>
                    </div>
                    <div class="field">
                        <input type="submit" class="btn" name="submit" value="LOGIN">
                    </div>
                    <div class="link">
                        Don't have Account? <a href="register.php">SIGNUP</a>
                    </div>
                </form>
        </div>
   
    </div>


</body>

</html>