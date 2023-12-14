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
    // Initialize an array to store validation errors
    $errors = [];

    // Function to add an error to the errors array
    function addError($field, $message) {
        global $errors;
        $errors[$field] = $message;
    }

    // Validate and sanitize input fields
    $event_name = trim($_POST["event_name"]);
    $event_date = trim($_POST["event_date"]);
    $event_time = trim($_POST["event_time"]);
    $event_location = trim($_POST["event_location"]);
    $event_description = trim($_POST["event_description"]);

    // Check if required fields are empty
    if (empty($event_name)) {
        addError("event_name", "Please enter the event name");
    }

    if (empty($event_date)) {
        addError("event_date", "Please enter the event date");
    }

    if (empty($event_time)) {
        addError("event_time", "Please enter the event time");
    }

    if (empty($event_location)) {
        addError("event_location", "Please enter the event location");
    }

    // Check if there are any validation errors
    if (count($errors) > 0) {
        // Display error messages
        foreach ($errors as $field => $message) {
            echo "$message<br>";
        }
    }
}

$conn->close();
?>







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

<!-- Add a button to go back to event_management.html -->
<button onclick="goBack()">Go Back</button>

<script>
    function goBack() {
        window.location.href = '/event_/view/event_management.html';
    }
</script>
