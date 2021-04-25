<?php
    session_start();
    $user_id = $_SESSION['user_id'];
    
    if(isset($_POST['submit'])){
        include('database_connection.php');

        // get the form data /escaping special characters
        $cur_password = $conn -> real_escape_string($_POST['current_password']);
        $new_password = $conn -> real_escape_string($_POST['new_password']);

        $sql = "Select password from users where id='$user_id'";
        $result= $conn->query($sql);
        $user_password = $result->fetch_assoc()['password'];
        if($cur_password == $user_password){
            $sql = "UPDATE users SET password='$new_password' WHERE id=$user_id";
            if ($conn->query($sql) === TRUE) {
                // echo "Password reset successfully";
                $_SESSION['flash_message']='Password reset successfully';

              } else {
                // echo "Error reseting password: " . $conn->error;
                $_SESSION['flash_message']="Error reseting password: " . $conn->error;
              }
        }else{
            $_SESSION['flash_message']='Incorrect password';
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
    <title>Reset password</title>
</head>
<body>
    <nav>
        <li><a href="index.php">Home</a></li>
        <li><a href="register.php">Register</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="logout.php">Logout</a></li>
    </nav>
    <br><br>
    <?php 
        echo $_SESSION['user_name']; 
    ?>
    <br>
    <?php 
        if (isset($_SESSION['flash_message'])) {
            echo $_SESSION['flash_message'];
            unset($_SESSION['flash_message']);
        }
    ?>
     
    <h3>Reset Password</h3>
    <form action="" method="POST">
        <input type="password" name="current_password" id="" placeholder="Enter your Current Password">
        <input type="password" name="new_password" id="" placeholder="Enter new password">
        <button type="submit" name="submit">Submit</button>
    </form>
</body>
</html>