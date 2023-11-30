<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
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

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>
</head>
<body>
    <h1>Welcome to the Event Management System</h1>
    <h2>Choose Your Role:</h2>
    <form action="../controller/redirect.php" method="post">
        <button type="submit" name="role" value="client">Client</button>
        <button type="submit" name="role" value="admin">Admin</button>
    </form>
</body>
</html>
