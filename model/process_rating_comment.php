<?php
// process_rating_comment.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "event_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_id = $_POST["event_id"];
    $rating = $_POST["rating"];
    $comment = $_POST["comment"];

    $sql = "UPDATE event SET
            event_rating = $rating,
            event_comment = '$comment'
            WHERE event_id = $event_id";

    if ($conn->query($sql) === TRUE) {
        echo "Rating and comment submitted successfully!";
    } else {
        echo "Error updating event: " . $conn->error;
    }
}

$conn->close();
?>
