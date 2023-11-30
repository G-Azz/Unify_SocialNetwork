<?php
include '../Controller/ticketreplyC.php'; // Assuming you have a TicketReply Controller
include '../Model/ticketreply.php'; // Assuming you have a TicketReply Model
$error = "";
 // Instantiate the TicketReply class
$description = $ticketReply->getDescriptionReply(); // Access getDescriptionReply() method

if (isset($_POST["reply_content"]) && isset($_POST["ticket_reply_id"])) {
    if (!empty($_POST['reply_content']) && !empty($_POST["ticket_reply_id"])) {
        $ticket_reply_id = $_POST['ticket_reply_id']; // Retrieve ticket_reply_id from the form
        $reply_content = $_POST['reply_content'];

        // Retrieve existing reply details based on the ID
        $existing_reply = $ticketReplyED->getDescriptionReply($ticket_reply_id);

        // Create a TicketReply instance with updated content and existing details
        $ticket_reply = new TicketReply(
            $existing_reply['ticket_id'], // Assuming this value exists in the fetched reply details
            $existing_reply['user_sender_id'], // Assuming this value exists in the fetched reply details
            $existing_reply['media'], // Assuming this value exists in the fetched reply details
            $existing_reply['created_datetime'], // Assuming this value exists in the fetched reply details
            $reply_content
        );

        try {
            // Call the updateTicketReply method in your TicketReply Controller
            $ticketReplyED->updateTicketReply($ticket_reply, $ticket_reply_id);
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
    <title>Update Ticket Reply</title>
</head>

<body>
    <a class="back-to-list" href="listticketreply.php">Back To List</a>
    <a class="back-to-help" href="index.html">Back To Help Center</a>

    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php
    if (isset($_POST['ticket_reply_id'])) {
        // Retrieve reply data based on the ID
        $ticket_reply = $ticketReplyED->getDescriptionReply($_POST['ticket_reply_id']);
    ?>
        <form action="" method="POST">
            <div class="form-group">
                <label for="ticket_reply_id">Ticket Reply ID:</label>
                <input type="text" id="ticket_reply_id" name="ticket_reply_id" value="<?php echo $_POST['ticket_reply_id'] ?>" readonly />
                <span id="errorTicketReplyId" style="color: red"></span>
            </div>

            <div class="form-group">
                <label for="reply_content">Reply Content:</label>
                <input type="text" id="reply_content" name="reply_content" value="<?php echo $ticket_reply['description_reply'] ?>" />
                <span id="errorReplyContent" style="color: red"></span>
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
