<?php
include "../Model/ticketreply.php" ;
include_once "../controller/ticketC.php"; 
include_once "../controller/ticketreplyC.php";
$user_sender_id=3;
$ticketedit = new TicketED();
$ticket = $ticketedit->showTicket($_GET['id']);
$ticketreplyedit= new TicketReplyED();





if (isset($_POST["reply_content"])) {
    $admin_id = 1;
    $opened = 1;
    $created_datetime = date('Y-m-d H:i:s') ; // Current datetime    // Assuming you have a default ticket type ID
    $description_reply = $_POST['reply_content'];
    $media = "empty"; // Handle file upload separately if needed
    

    $ticketrep = new TicketReply( $_GET['id'], $user_sender_id, $media, $created_datetime, $description_reply);

    try {
        $ticketreplyedit->addTicketReply($ticketrep);
        // Redirect or perform other success actions
        
        exit();
        
    } catch (Exception $e) {
        $error = $e->getMessage();
    }

    
}



?>

<html>
<head >
<link rel="stylesheet" href="reply.css" />   

<title>Reply to Ticket</title>

</head>

<body>
    <!-- Display the initial ticket details -->
    <div class="khalil">
        <div class="ticket-details">
             <div class="ticketd">
                <h2>Ticket Details</h2>
                 <p><strong>Description:</strong><?php echo $ticket['descriptions'];?> </p>
                
                 <p><strong>Ticket ID:</strong> <?php echo $ticket['ticket_id'];?></p>
                <p><strong>User ID:</strong> <?php echo $ticket['user_sender_id'];?></p>
         </div>
        <!-- Add more ticket details as needed -->
    </div>

    <!-- Reply box -->
    <div class="reply-box">
        <h2>Reply to Ticket</h2>
        <form action="" method="POST">
            <textarea   name="reply_content" placeholder="Write your reply here"></textarea>
            <input type="hidden" name="ticket_idd" value="<?php echo $ticket['ticket_id'];?> ">
            <input type="submit" value="Submit Reply">
        </form>
    </div>
</div>
</body>
</html>