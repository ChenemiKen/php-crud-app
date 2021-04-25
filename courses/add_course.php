<?php
    session_start();
    if(isset($_POST['submit'])){
        include('../database_connection.php');

        // get the form data /escaping special characters
        $title = $conn -> real_escape_string($_POST['title']);
        $content = $conn -> real_escape_string($_POST['content']);
        
        $user_id = $_SESSION['user_id'];
        $date = date('Y-m-d');

        $sql = "INSERT INTO courses (user, title, content, date_created) VALUES('$user_id','$title','$content','$date')";

        if ($conn->query($sql) === TRUE) {
            $course_id = $conn->insert_id;
            $_SESSION['flash_message']='Course created successfully';

        } else {
            $_SESSION['flash_message']= "Error: " . $sql . "<br>" . $conn->error;
        }
        header('Location: my_courses.php');
        $conn->close();
        exit();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course</title>
</head>
<body>
    <nav>
        <li><a href="/">Home</a></li>
        <li><a href="register.php">Register</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="reset_password.php">Reset password</a></li>
        <li><a href="logout.php">Logout</a></li>
    </nav><br>
    <h3>Add New Course</h3>
    <form action="" method="POST">
        <input type="text" name="title" placeholder="Course Title">
        <textarea name="content" id="" cols="30" rows="10" placeholder="Course Content"></textarea>
        <button type="submit" name="submit">Submit</button>
    </form>
    <br><br>
    <nav>
        <li><a href="my_courses.php">My Courses</a></li>
    </nav>
    
</body>
</html>