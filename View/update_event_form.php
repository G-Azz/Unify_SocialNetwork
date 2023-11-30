<!DOCTYPE html>
<html>
<head>
    <title>Update Event</title>
    <style>
    body {
        background-image: url('testbackground_image.png');
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-color: #9b1c31;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        font-family: Arial, sans-serif;
    }

    .container {
        max-width: 600px;
        padding: 20px;
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        text-align: center;
        font-size: 20px;
    }

    h1 {
        text-align: center;
        font-size: 28px;
        color: #9b1c31;
    }

    label, input, select, textarea {
        display: block;
        margin-bottom: 10px;
        font-size: 18px;
        text-align: left;
    }

    input[type="file"] {
        margin-top: 5px;
    }

    textarea {
        width: 100%;
    }

    input[type="submit"] {
        background-color: #9b1c31;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        font-size: 20px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    input[type="submit"]:hover {
        background-color: #721524;
    }    </style>
</head>
<body>
    <div class="container">
        <h1>Update Event</h1>
        <form action="../controller/process_update.php" method="post" enctype="multipart/form-data">
          <?php
$event_id_to_update = isset($_GET['event_id']) ? $_GET['event_id'] : null;

if ($event_id_to_update === null) {
    die("Event ID is not specified in the URL.");
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "event_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT * FROM event WHERE event_id = ?");
$stmt->bind_param("i", $event_id_to_update);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    die("Error fetching event details: " . $stmt->error);
}

if ($result->num_rows > 0) {
    $event_details = $result->fetch_assoc();
    $event_name = $event_details['event_name'];
    $event_date = $event_details['event_date'];
    $event_time = $event_details['event_time'];
    $event_location = $event_details['event_location'];
    $event_description = $event_details['event_description'];

} else {
    die("No event found with ID: " . $event_id_to_update);
}

$conn->close();
?>

            <input type="hidden" name="event_id" value="<?= $event_id_to_update ?>">

            <label for="event_name">Event Name:</label>
            <input type="text" id="event_name" name="event_name" value="<?= htmlspecialchars($event_name) ?>" required>

            <label for="event_date">Date:</label>
            <input type="date" id="event_date" name="event_date" value="<?= $event_date ?>" required>

            <label for="event_time">Time:</label>
            <input type="time" id="event_time" name="event_time" value="<?= $event_time ?>" required>

            <label for="event_location">Location:</label>
            <select id="event_location" name="event_location">
                <option value="Ariana" <?= ($event_location === 'Ariana') ? 'selected' : '' ?>>Ariana</option>
                <option value="Tunis" <?= ($event_location === 'Tunis') ? 'selected' : '' ?>>Tunis</option>
                <option value="Mahdia" <?= ($event_location === 'Mahdia') ? 'selected' : '' ?>>Mahdia</option>
            </select>

            <label for="event_poster">Event Poster:</label>
            <input type="file" id="event_poster" name="event_poster" accept="image/*">

            <label for="event_description">Description:</label>
            <textarea id="event_description" name="event_description" rows="4" required><?= htmlspecialchars($event_description) ?></textarea>

            <input type="submit" value="Update Event">
        </form>
    </div>
</body>
</html>
