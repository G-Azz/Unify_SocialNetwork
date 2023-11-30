<?php
include "../Controller/ticketreplyC.php";
include "../controller/ticketC.php"; 
$user_sender_id=3;
$ticketedit = new TicketED();
$tab = $ticketedit->listTicketsByUser($user_sender_id); 
$ticketreplyedit = new TicketReplyED();


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
        <th>Update</th>
        <th>Response</th>
        <th>Status</th>
    </tr>

    <?php foreach ($tab as $tickets) { 
    $responses = $ticketreplyedit->getRepliesForTicket($tickets['ticket_id']);
    $statusClass = (!empty($responses)) ? 'solved' : 'not-solved';
?>

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
            <form method="POST" action="updateticket.php">
                <input class="update" type="submit" name="update" value="Update">
                <input type="hidden" value="<?= $tickets['ticket_id']; ?>" name="ticket_id">
            </form>
        </td>
        <td>
            <a href="ticketresponses.php?id=<?= $tickets['ticket_id']; ?>">See response</a>
        </td>
        <td class="status">
            <span class="<?= $statusClass; ?>"><?= (!empty($responses)) ? 'Solved' : 'Not Solved'; ?></span>
        </td>
    </tr>
<?php } ?>
</table>

</body>