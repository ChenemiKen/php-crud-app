<?php
    session_start();
    include('database_connection.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <nav>
        <li><a href=" ">Home</a></li>
        <li><a href="reset_password.php">Reset password</a></li>
        <li><a href="logout.php">Logout</a></li>
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
    <?php
        if(!isset($_SESSION['user_id'])) {
            // session isn't started
            echo "You are logged out, You need to login!";
        }else{
    ?>
            <h4>Welcome <?php echo $_SESSION['user_name'];?> </h4>
            <p>email: <?php echo $_SESSION['user_email'];?></p>
            <br><br>
            <nav>
                <li><a href="courses/my_courses.php">My Courses</a></li>
                <li><a href="courses/add_course.php">Add Course</a></li>
            </nav>
            
    <?php
        }
    ?>
    
</body>
</html>