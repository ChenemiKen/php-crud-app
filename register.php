<?php
    session_start();

    // get the form data
    if(isset($_POST['submit'])){
        include('database_connection.php');

        // get the form data /escaping special characters
        $name = $conn -> real_escape_string($_POST['name']);
        $email = $conn -> real_escape_string($_POST['email']);
        $password = $conn -> real_escape_string($_POST['password']);

        $sql = "INSERT INTO users (name, email, password) VALUES('$name','$email','$password')";

        if ($conn->query($sql) === TRUE) {
            $user_id = $conn->insert_id;
            echo "Registration successfull";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $_SESSION['user_id']= $user_id;
        $_SESSION['user_name']= $name;
        $_SESSION['user_email']= $email;
        header('Location: dashboard.php');
        $conn->close();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signu= up</title>
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
    <h3>Register</h3>

    <?php
        if(!isset($_SESSION['user_id'])) {
            // session isn't started
    ?>
        <form action="" method="POST">
            <input type="text" name="name" id="" placeholder="Name" >
            <input type="email" name="email" id="" placeholder="Email Address">
            <input type="password" name='password' placeholder="Password">
            <button type="submit" name='submit'>Submit</button>
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