<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "event_management";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get data from the form
    $event_id = $_POST['event_id'];
    $comment = $_POST['comment'];
    $rating = $_POST['rating'];

    // Insert the comment and rating into the database
    $sql = "INSERT INTO comments (event_id, comment, rating) VALUES (NULL, '$comment', '$rating')";

    if ($conn->query($sql) === TRUE) {
        echo "Comment submitted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!-- Add a button to go back to event_management.html -->
<button onclick="goBack()">Go Back</button>

<script>
    function goBack() {
        window.location.href = '/event_/view/events_gallery.php';
    }
</script>
