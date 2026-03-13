<?php
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $date = mysqli_real_escape_string($conn, $_POST['schedule_date']);
    $time = mysqli_real_escape_string($conn, $_POST['schedule_time']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $query = "INSERT INTO schedules (title, description, schedule_date, schedule_time)
              VALUES ('$title', '$description', '$date', '$time')";

    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Database error: " . mysqli_error($conn);
    }
}
?>