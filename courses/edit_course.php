<?php
    session_start();
    include('../database_connection.php');

    $course_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];
    
    $sql = "Select * from courses where id='$course_id'";
    $course = ($conn->query($sql))->fetch_assoc();

    if (isset($_POST['submit'])){
        // get the form data /escaping special characters
        $title = $conn -> real_escape_string($_POST['title']);
        $content = $conn -> real_escape_string($_POST['content']);
        $date = $conn -> real_escape_string($_POST['date']);

        
        $user_id = $_SESSION['user_id'];
        

        $sql = "Update courses set title='$title', content='$content', date_created='$date' where id='$course_id' AND user='$user_id'";

        if ($conn->query($sql) === TRUE) {
            $course_id = $conn->insert_id;
            $_SESSION['flash_message']='Course Updated successfully';

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
    <title>Edit course</title>
</head>
<body>
    <nav>
        <li><a href="../index.php">Home</a></li>
        <li><a href="../register.php">Register</a></li>
        <li><a href="../login.php">Login</a></li>
        <li><a href="../dashboard.php">Dashboard</a></li>
        <li><a href="../logout.php">Logout</a></li>
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
    <br>
    <h3>Edit course</h3>
    <form action="" method="POST">
        <input type="text" name="title" placeholder="Course Title" value ="<?php echo $course['title'] ?>">
        <textarea name="content" id="" cols="30" rows="10" placeholder="Course Content"><?php echo $course['content'] ?></textarea>
        <input type="date" name="date" id="" value="<?php echo $course['date_created'] ?>">
        <button type="submit" name="submit">Submit</button>
    </form>
    <br><br>
    <nav>
        <li><a href="my_courses.php">My Courses</a></li>
    </nav>
</body>
</html>