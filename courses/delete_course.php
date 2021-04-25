<?php
    session_start();
    include('../database_connection.php');

    $course_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    $sql = "Delete from courses where id='$course_id'";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['flash_message']='Course deleted successfully';

    } else {
        $_SESSION['flash_message']= "Error: " . $sql . "<br>" . $conn->error;
    }
    header('Location: my_courses.php');
    $conn->close();
    exit();
?>