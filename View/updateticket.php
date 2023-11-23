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

<html lang="en">

<head>
<link rel="stylesheet" href="faqstyle.css">


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Update Reclamation </title>
</head>

<body>
    <a class="back-to-list" href="listtickets.php">Back To List</a>
    <a class="back-to-help" href="index.html">Back To Help Center</a>

    <hr>

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
                <label for="ticket_id">Ticket ID:</label>
                <input type="text" id="ticket_id" name="ticket_id" value="<?php echo $_POST['ticket_id'] ?>" readonly />
                <span id="errorTicketId" style="color: red"></span>
            </div>

            <div class="form-group">
                <label for="descriptions">Descriptions:</label>
                <input type="text" id="descriptions" name="descriptions" value="<?php echo $ticket['descriptions'] ?>" />
                <span id="errorDescriptions" style="color: red"></span>
            </div>

            <div class="form-group">
                <input type="submit" value="Save">
                <input type="reset" value="Reset">
            </div>
        </form>
    <?php
    }
    ?>
</body>

</html>