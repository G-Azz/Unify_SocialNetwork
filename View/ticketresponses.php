<?php
include "../controller/ticketreplyC.php"; 


if (isset($_GET['id'])) {
    $ticket_id = $_GET['id']; // Get the ticket ID from the URL parameter
    $ticketreplyedit = new TicketReplyED();
    $responses = $ticketreplyedit->getRepliesForTicket($ticket_id);

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="ticketliststyle.css">
    <meta charset="UTF-8">
    <title>Ticket Responses</title>
    <!-- Your CSS and other meta tags -->
</head>
<body>
    <h1>Responses for Ticket ID: <?php echo $ticket_id; ?></h1>

    <?php if (!empty($responses)) { ?>
        <ul>
            <?php foreach ($responses as $response) { ?>
                <li>
                    <?php echo $response['description_reply']; ?>
                    <!-- Delete button for each response -->
                    <a href="deleteticketreply.php?id=<?= $response['ticket_reply_id']; ?>">Delete</a>
                </li>
            <?php } ?>
        </ul>
    <?php } else { ?>
        <p>No responses found for this ticket.</p>
    <?php } ?>

    <!-- Other HTML content and structure as needed -->
</body>
</html>