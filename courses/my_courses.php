<?php
    session_start();

    include('../database_connection.php');

    $user_id = $_SESSION['user_id'];
    
    // fetch user courses
    $sql = "Select * from courses where user='$user_id'";
    $courses = $conn->query($sql);

    $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My courses</title>
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
    <h3>My Courses</h3>
    <?php 
        if ($courses->num_rows>0) {
            while($row = $courses->fetch_assoc()) { 
                // var_dump($row);
    ?>
                    <li>
                        <a href="<?php echo 'edit_course.php?id='.$row['id']?>">
                        <?php echo $row["title"] ?> 
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <?php echo $row["date_created"] ?></a>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="<?php echo 'delete_course.php?id='.$row['id']?>"><button>Delete</button></a>
                    </li>

    <?php   }
    
        } else {
            // echo "Error: " . $sql . "<br>" . $conn->error;
            echo "You have no courses.";
        }
    ?>
    <br><br><br><br>
    <nav>
        <li><a href="add_course.php">Add Course</a></li>
    </nav>
</body>
</html>