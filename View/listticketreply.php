<?php
include "../controller/ticketreplyC.php"; 
$user_sender_id=3;
$ticketId = 1;
$ticketreplyedit = new TicketReplyED();
$tab = $ticketreplyedit->listTicketReplies($ticketId); 

?>
<head>
    <link rel="stylesheet" href="ticketliststyle.css">
    <link rel="stylesheet" href="faqstyle.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>List of ALL THE Tickets</title>
    
</head>
<body>
<a class="back-to-help" href="index.html">Back To Help Center </a>

<h1>List of tickets</h1>   

<table class="ticket-table" border="1" align="center" width="70%">
    <tr>
        <th>Ticket ID</th>
        <th>User ID</th>
        <th>Description</th>
        <th>Date</th>
        <th>Type</th>
        <th>Delete</th>
        <th>Reply</th>
    </tr>

    <?php foreach ($tab as $ticket_reply) { ?>
        <tr>
            <td><?= $ticket_reply['ticket_id']; ?></td>
            <td><?= $ticket_reply['user_sender_id']; ?></td>
            <td><?= $ticket_reply['description_reply']; ?></td>
            <td><?= $ticket_reply['created_datetime']; ?></td>
            <td><?= $ticket_reply['ticket_reply_id']; ?></td>
            <td>
            <a href="reply.php?id=<?= $ticket_reply['description_reply']; ?>">Reply</a> 
            </td>
            <td>
            <a href="deleteticket.php?id=<?= $ticket_reply['ticket_id']; ?>">Delete</a> 
            </td>
            <td>
            <form method="POST" action="updateticket.php">
                    <input type="submit" name="update" value="Update">
                    <input type="hidden" value=<?PHP echo $ticket_reply['ticket_id']; ?> name="ticket_id">
                </form>
            
            </td>
            
        </tr>
    <?php } ?>
</table>

</body>