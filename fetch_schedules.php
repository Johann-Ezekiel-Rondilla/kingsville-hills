<?php
require 'db_connect.php';

$query = "SELECT title, description, schedule_date, schedule_time FROM schedules";
$result = mysqli_query($conn, $query);

$events = [];

while ($row = mysqli_fetch_assoc($result)) {

    $events[] = [
        'title' => $row['title'],
        'start' => $row['schedule_date'] . 'T' . $row['schedule_time'],
        'description' => $row['description']
    ];
}

echo json_encode($events);
?>