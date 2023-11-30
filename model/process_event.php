<?php
// process_event.php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "event_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_name = $_POST["event_name"];
    $event_date = $_POST["event_date"];
    $event_time = $_POST["event_time"];
    $event_location = $_POST["event_location"];

    // Check if the file upload was successful
    if (isset($_FILES["event_poster"]) && $_FILES["event_poster"]["error"] == 0) {
        $event_poster = $_FILES["event_poster"]["name"];
        $event_poster_temp = $_FILES["event_poster"]["tmp_name"];
    } else {
        $event_poster = "";
        $event_poster_temp = "";
    }

    $event_description = $_POST["event_description"];

    $uploads_dir = "../view/uploads/";

    if (!empty($event_poster_temp)) {
        move_uploaded_file($event_poster_temp, $uploads_dir . $event_poster);
    }

    $sql = "INSERT INTO event (event_name, event_date, event_time, event_location, event_poster, event_description)
            VALUES ('$event_name', '$event_date', '$event_time', '$event_location', '$event_poster', '$event_description')";

    if ($conn->query($sql) === TRUE) {
        echo "Event added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
