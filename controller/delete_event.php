<?php
// Check if event_id is set and not empty
if (isset($_POST['event_id']) && !empty($_POST['event_id'])) {
    $event_id = $_POST['event_id'];

    // Connect to the database and perform deletion
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "event_management";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Use prepared statement to prevent SQL injection
    $sql = "DELETE FROM event WHERE event_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $event_id);

    if ($stmt->execute()) {
        // Deletion successful
        echo "success";
    } else {
        // Error in deletion
        echo "error";
    }

    $stmt->close();
    $conn->close();
} else {
    // Event ID not set or empty
    echo "error";
}
?>
