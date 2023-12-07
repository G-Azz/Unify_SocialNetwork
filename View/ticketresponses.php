<?php
include "../controller/ticketreplyC.php"; 


if (isset($_GET['id'])) {
    $ticket_id = $_GET['id']; // Get the ticket ID from the URL parameter
    $ticketreplyedit = new TicketReplyED();
    $responses = $ticketreplyedit->getRepliesForTicket($ticket_id);
    $ticket = $ticketreplyedit->getTicketDetails($ticket_id); // Replace this with your method to fetch ticket details


    

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ticket Responses</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f6e0d5; /* Lighter shade of red */
            color: #333; /* Darker text color for better readability */
            animation: colorChange 5s infinite alternate; /* Animation for color change */
        }
        @keyframes colorChange {
            from { background-color: #f6e0d5; } /* Initial background color */
            to { background-color: #f9c7bb; } /* Another shade of red for animation */
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white background for container */
            backdrop-filter: blur(10px);
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 36px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            color: #e74c3c; /* Red color for title */
            animation: titleAnimation 3s ease-in-out infinite alternate; /* Animation for title */
        }
        @keyframes titleAnimation {
            from { transform: scale(1); } /* Initial scale */
            to { transform: scale(1.05); } /* Slight scale up for animation */
        }
        p {
            margin-bottom: 20px;
            font-size: 18px;
            line-height: 1.6;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            padding: 15px;
            margin-bottom: 15px;
            background-color: rgba(255, 255, 255, 0.8); /* Slightly transparent white background for list items */
            border-radius: 8px;
            border-left: 5px solid #e74c3c; /* Red border for contrast */
            font-size: 16px;
            line-height: 1.4;
            box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out; /* Transition effect */
        }
        li:hover {
            transform: scale(1.05); /* Scale up on hover */
        }
        li:last-child {
            margin-bottom: 0;
        }
        strong {
            color: #e74c3c; /* Red color for strong text */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Ticket Responses for ID: <?php echo $ticket_id; ?></h1>
        <?php if (!empty($ticket)) { ?>
            <p><strong>Ticket Description:</strong> <?php echo $ticket['descriptions']; ?></p>
        <?php } else { ?>
            <p>No ticket description found.</p>
        <?php } ?>
        <?php if (!empty($responses)) { ?>
            <ul>
                <?php foreach ($responses as $response) { ?>
                    <li><?php echo $response['description_reply']; ?></li>
                <?php } ?>
            </ul>
        <?php } else { ?>
            <p>No responses found for this ticket.</p>
        <?php } ?>
    </div>
</body>
</html>


