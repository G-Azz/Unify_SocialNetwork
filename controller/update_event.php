<?php
// Check if event_id is set and not empty
if (isset($_POST['event_id']) && !empty($_POST['event_id'])) {
    $event_id = $_POST['event_id'];

    // Connect to the database and perform update
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "event_management";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Use prepared statement to prevent SQL injection
    $sql = "UPDATE event SET event_name = ?, event_date = ?, event_time = ?, event_location = ?, event_description = ? WHERE event_id = ?";
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("sssssi", $_POST['event_name'], $_POST['event_date'], $_POST['event_time'], $_POST['event_location'], $_POST['event_description'], $event_id);

    // Output the SQL query and parameters for debugging
    echo "SQL Query: $sql\n";
    echo "Parameters: {$_POST['event_name']}, {$_POST['event_date']}, {$_POST['event_time']}, {$_POST['event_location']}, {$_POST['event_description']}, $event_id\n";

    if ($stmt->execute()) {
        // Update successful
        echo "success";
    } else {
        // Error in update
        echo "error";
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    // Event ID not set or empty
    echo "error";
}
?>
