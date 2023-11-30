<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Details</title>
    <style>
        body {
            background-color: #9b1c31;
            color: #9b1c31; 
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .event-container {
            max-width: 600px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: left;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .event-container p {
            margin: 0;
            margin-bottom: 10px;
        }

        .event-container img {
            max-width: 100%;
            height: auto;
        }

        .rating-form {
            margin-top: 20px;
        }

        .rating-form input,
        .rating-form textarea,
        .rating-form select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        .rating-form input[type="submit"] {
            background-color: #9b1c31;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .rating-form input[type="submit"]:hover {
            background-color: #721524;
        }
    </style>
</head>
<body>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "event_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM event"; // Use the correct table name
$result = $conn->query($sql);

$events = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
}

$conn->close();

foreach ($events as $event) {
    echo "<div class='event-container'>";
    echo "<p>Event Name: {$event['event_name']}</p>";
    echo "<p>Date: {$event['event_date']}</p>";
    echo "<p>Time: {$event['event_time']}</p>";
    echo "<p>Location: {$event['event_location']}</p>";
    echo "<p>Event Poster: {$event['event_poster']}</p>";
    echo "<p>Description: {$event['event_description']}</p>";

    foreach ($events as $event) {
        echo "<p>- Rating: {$event['event_rating']}</p>";
        echo "<p>Description: {$event['event_description']}</p>";
        echo "<p>Location: {$event['event_location']}</p>";

        echo "<form class='rating-form' action='../model/process_rating_comment.php' method='post'>";
        echo "<input type='hidden' name='event_id' value='{$event['event_id']}'>";
        echo "Rating: <input type='number' name='rating' min='1' max='5' required>";
        echo "Comment: <textarea name='comment'></textarea>";
        echo "<input type='submit' value='Submit Rating and Comment'>";
        echo "</form>";
        echo "<hr>";
    }

    $userRole = "client";

    if ($userRole === "admin") {

        echo "<a href='view/update_event_form.php?event_id={$event['event_id']}'>Update</a>";
    }

    echo "</div>";
}
?>

</body>
</html>
