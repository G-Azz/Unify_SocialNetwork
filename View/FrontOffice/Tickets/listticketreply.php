<?php
include "../../../controller/ticketC.php"; 
session_start();
$user_sender_id=$_SESSION['user_data'] ['Id_User'];
$ticketedit = new TicketED();
$tab = $ticketedit->listTickets($start, $perPage); 

?>
<head>
    <link rel="stylesheet" href="ticketliststyle.css">
    <link rel="stylesheet" href="faqstyle.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>List of Tickets</title>
    
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

    <?php foreach ($tab as $tickets) { ?>
        <tr>
            <td><?= $tickets['ticket_id']; ?></td>
            <td><?= $tickets['user_sender_id']; ?></td>
            <td><?= $tickets['descriptions']; ?></td>
            <td><?= $tickets['created_datetime']; ?></td>
            <td><?= $tickets['ticket_typeid']; ?></td>
            <td>
            <a href="deleteticket.php?id=<?= $tickets['ticket_id']; ?>">Delete</a> 
            </td>
            <td>
            <form method="POST" action="reply.php">
                    
                    <a type="submit" href="reply.php?id=<?php echo($tickets['ticket_id']) ; ?>">Reply </a>
                </form>
            
            </td>
            <td>
                <?= $tickets_reply['ticket_typeid']; ?>
            </td>
        </tr>
    <?php } ?>
</table>

</body>