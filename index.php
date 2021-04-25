<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <nav>
        <li><a href="index.php">Home</a></li>
        <li><a href="register.php">Register</a></li>
        <li><a href="login.php">Login</a></li>
        <?php
            if(isset($_SESSION['user_id'])) {
                // session is started
        ?>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="reset_password.php">Reset Password</a></li>
            <li><a href="logout.php">Logout</a></li>
        <?php
            }
        ?>
    </nav>
    <h3>Home</h3>
    <br>
    <?php 
        if (isset($_SESSION['flash_message'])) {
            echo $_SESSION['flash_message'];
            unset($_SESSION['flash_message']);
        }
    ?>
    
</body>
</html>