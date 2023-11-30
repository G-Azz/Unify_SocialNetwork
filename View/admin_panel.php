<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        body {
            background-color: #9b1c31;
            color: #fff;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        h1, h2 {
            text-align: center;
        }

        a {
            text-decoration: none;
        }

        button {
            background-color: #721524;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 20px;
            cursor: pointer;
            margin: 10px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #9b1c31;
        }
    </style>
</head>
<body>
    <h1>Welcome to the Admin Panel</h1>
    <h2>Choose Your Action:</h2>
    <a href="../controller/add_event.php"><button>Add New Event</button></a>
    <a href="view_events.php"><button>View Events</button></a>
    <a href="delete_events.php"><button>Delete Events</button></a>
</body>
</html>
