<?php
include '../../../controller/ticketreplyC.php'; // Assuming you have a Ticket Reply Controller
include '../../../model/ticketreply.php'; // Assuming you have a Ticket Reply Model
$error = "";
session_start();
$user_id = $_SESSION['user_data'] ['Id_User'];
$ticketReplyEdit = new TicketReplyED(); // Instantiate the Ticket Reply Controller

if (isset($_POST["description_reply"]) && isset($_POST["ticket_reply_id"])) {
    if (!empty($_POST['description_reply']) && !empty($_POST["ticket_reply_id"])) {
        $ticket_reply_id = $_POST['ticket_reply_id']; // Retrieve ticket_reply_id from the form
        $description_reply = $_POST['description_reply'];

        // Retrieve existing ticket reply details based on the ID
        $existing_reply = $ticketReplyEdit->showTicketReply($ticket_reply_id);

        // Create a Ticket Reply instance with updated description and existing details
        $ticketReply = new TicketReply(
            $existing_reply['ticket_id'], // Assuming this value exists in the fetched ticket reply details
            $existing_reply['user_sender_id'], // Assuming this value exists in the fetched ticket reply details
            $existing_reply['media'], // Assuming this value exists in the fetched ticket reply details
            $existing_reply['created_datetime'], // Assuming this value exists in the fetched ticket reply details
            $description_reply
        );

        try {
            // Call the updateTicketReply method in your Ticket Reply Controller
            $ticketReplyEdit->updateTicketReply($ticketReply, $ticket_reply_id);
            header('Location:listticketreply.php'); // Redirect to the ticket reply list page after update
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
