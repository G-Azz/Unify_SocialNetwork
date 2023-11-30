<!DOCTYPE html>
<html>
<head>
    <title>Event Template</title>
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
        }
    </style>
</head>
<body>


    <div class="container">
        <h1>Create Event</h1>
        <form action="../model/process_event.php" method="post" enctype="multipart/form-data">
            <label for="event_name">Event Name:</label>
            <input type="text" id="event_name" name="event_name" required>

            <label for="event_date">Date:</label>
            <input type="date" id="event_date" name="event_date" required>

            <label for="event_time">Time:</label>
            <input type="time" id="event_time" name="event_time" required>

            <label for="event_location">Location:</label>
            <select id="event_location" name="event_location">
                <option value="Ariana">Ariana</option>
                <option value="Tunis">Tunis</option>
                <option value="Mahdia">Mahdia</option>
            </select>


            <label for="event_poster">Event Poster:</label>
            <input type="file" id="event_poster" name="event_poster" accept="image/*" required>
            <label for="event_description">Description:</label>
            <textarea id="event_description" name="event_description" rows="4" required></textarea>

            <input type="submit" value="Create Event">
        </form>
    </div>

</body>
</html>
