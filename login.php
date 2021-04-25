<?php
    session_start();

    if(isset($_POST['submit'])){
        // database connection
        include('database_connection.php');
        
        // get the form data /escaping special characters
        $email = $conn -> real_escape_string($_POST['email']);
        $password = $conn -> real_escape_string($_POST['password']);

        $sql = "select * from users where email='$email' and password='$password'";
        $user= $conn->query($sql);

        if ($user->num_rows >0){
            $user = $user->fetch_assoc();
            $_SESSION['user_id']= $user['id'];
            $_SESSION['user_name']= $user['name'];
            $_SESSION['user_email']= $user['email'];
            $_SESSION['flash_message'] = "Login successfull";
            header('Location: dashboard.php');
            exit();
        } else {
            $_SESSION['flash_message']='Incorrect email or password';
        }
        $conn->close();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
    <br>
    <?php 
        if (isset($_SESSION['flash_message'])) {
            echo $_SESSION['flash_message'];
            unset($_SESSION['flash_message']);
        }
    ?>
    <h3>Login</h3>
    <?php
        if(!isset($_SESSION['user_id'])) {
            // session isn't started
    ?>
            <form action="" method="POST">
                <input type="email" name="email" placeholder="Email Address">
                <input type="password" name="password" id="" placeholder="Password">
                <button type="submit" name="submit">Submit</button>
            </form>
    <?php  
        }else{
            echo ('Welcome '.$_SESSION['user_name']);
    ?>
            <p>You are logged in.. </p>
            
    <?php
        }
    ?>
    
</body>
</html>