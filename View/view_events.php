<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "event_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM event";
$result = $conn->query($sql);

$events = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Events</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #9b1c31;
        color: #fff;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        margin: 0;
        padding: 20px;
    }

    div {
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin: 10px;
        padding: 20px;
        width: 300px;
    }

    img {
        max-width: 100%;
        height: auto;
    }

    p {
        margin: 0;
        padding: 5px;
        color: #9b1c31;
    }

    a {
        color: #721524;
        text-decoration: none;
        font-weight: bold;
    }
</style>

</head>
<body>
    <?php foreach ($events as $event): ?>
        <div>
            <p>Event Name: <?php echo $event['event_name']; ?></p>
            <p>Date: <?php echo $event['event_date']; ?></p>
            <p>Time: <?php echo $event['event_time']; ?></p>
            <p>Location: <?php echo $event['event_location']; ?></p>
            <p>Event Poster: <img src='../view/uploads/<?php echo $event['event_poster']; ?>' alt='Event Poster'></p>
            <p>Description: <?php echo $event['event_description']; ?></p>
            <p><a href='../view/update_event_form.php?event_id=<?php echo $event['event_id']; ?>'>Update</a></p>
        </div>
    <?php endforeach; ?>
</body>
</html>
