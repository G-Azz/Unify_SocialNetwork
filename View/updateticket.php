<?php
include '../Controller/TicketC.php'; // Assuming you have a Ticket Controller
include '../Model/Ticket.php'; // Assuming you have a Ticket Model
$error = "";

$ticketedit = new TicketED(); // Instantiate the Ticket Controller

if (isset($_POST["descriptions"]) && isset($_POST["ticket_id"])) {
    if (!empty($_POST['descriptions']) && !empty($_POST["ticket_id"])) {
        $ticket_id = $_POST['ticket_id']; // Retrieve ticket_id from the form
        $descriptions = $_POST['descriptions'];

        // Retrieve existing ticket details based on the ID
        $existing_ticket = $ticketedit->showTicket($ticket_id);

        // Create a Ticket instance with updated descriptions and existing details
        $ticket = new Ticket(
            $existing_ticket['user_sender_id'], // Assuming this value exists in the fetched ticket details
            $existing_ticket['admin_id'], // Assuming this value exists in the fetched ticket details
            $descriptions,
            $existing_ticket['media'], // Assuming this value exists in the fetched ticket details
            $existing_ticket['created_datetime'], // Assuming this value exists in the fetched ticket details
            $existing_ticket['ticket_typeid'], // Assuming this value exists in the fetched ticket details
            $existing_ticket['opened'] // Assuming this value exists in the fetched ticket details
        );

        try {
            // Call the updateTicket method in your Ticket Controller
            $ticketedit->updateTicket($ticket, $ticket_id);
            header('Location:listtickets.php'); // Redirect to the ticket list page after update
            exit();
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    } else {
        $error = "Missing information";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="faqstyle.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Reclamation</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f8f8f8;
            animation: colorTransition 10s ease infinite alternate;
        }

        @keyframes colorTransition {
            0% {
                background-color: #f8f8f8;
            }
            100% {
                background-color: #ff8484;
            }
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .back-to-list,
        .back-to-help {
            display: inline-block;
            text-decoration: none;
            color: #9b1c31;
            margin-bottom: 15px;
            transition: color 0.3s ease;
            padding: 8px 16px;
            border-radius: 4px;
            border: 1px solid #9b1c31;
            background-color: transparent;
        }

        .back-to-list:hover,
        .back-to-help:hover {
            color: #fff;
            background-color: #9b1c31;
        }

        hr {
            border: none;
            border-top: 1px solid #ddd;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-weight: bold;
            text-transform: uppercase;
        }

        input[type="text"] {
            width: calc(100% - 10px);
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ddd;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus {
            outline: none;
            border-color: #9b1c31;
        }

        input[type="submit"],
        input[type="reset"] {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background-color: #9b1c31;
            color: #fff;
            font-size: 16px;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: #b63443;
            transform: translateY(-2px);
        }

        #error {
            color: red;
            margin-bottom: 10px;
        }

        /* Enhancements for the labels */
        .form-group label {
            position: relative;
            display: inline-block;
            font-size: 18px;
            color: #9b1c31;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .form-group label::after {
            content: '';
            display: block;
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #9b1c31;
            transform-origin: bottom center;
            transform: scaleX(0);
            transition: transform 0.3s ease-in-out;
        }

        .form-group input[type="text"]:focus + span::after,
        .form-group input[type="text"]:not(:focus):valid + span::after {
            transform: scaleX(1);
        }

        .form-group input[type="text"]:focus + span,
        .form-group input[type="text"]:not(:focus):valid + span {
            color: #9b1c31;
            transform: translateY(-20px) scale(0.8);
        }
    </style>
</head>

<body>
    <a class="back-to-list" href="listtickets.php">Back To List</a>
    <a class="back-to-help" href="index.html">Back To Help Center</a>

    <hr>

    <div class="container">
        <div id="error">
            <?php echo $error; ?>
        </div>

        <?php
        if (isset($_POST['ticket_id'])) {
            // Retrieve ticket data based on the ID
            $ticket = $ticketedit->showTicket($_POST['ticket_id']);
        ?>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="ticket_id">Ticket ID:<span></span></label>
                    <input type="text" id="ticket_id" name="ticket_id" value="<?php echo $_POST['ticket_id'] ?>" readonly />
                    <span id="errorTicketId"></span>
                </div>

                <div class="form-group">
                    <label for="descriptions">Description:<span></span></label>
                    <input type="text" id="descriptions" name="descriptions" value="<?php echo $ticket['descriptions'] ?>" />
                    <span id="errorDescriptions"></span>
                </div>

                <div class="form-group">
                    <input type="submit" value="Save">
                    <input type="reset" value="Reset">
                </div>
            </form>
        <?php
        }
        ?>
    </div>
</body>

</html>
