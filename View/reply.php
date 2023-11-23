<?php



?>

<html>
<head>
<title>Reply to Ticket</title>
<style>
        /* Add your CSS styles for the ticket and reply box here */
        .ticket-details {
            border: 1px solid #ccc;
            padding: 20px;
            margin-bottom: 20px;
        }
        .reply-box {
            border: 1px solid #ccc;
            padding: 20px;
        }
        .reply-box textarea {
            width: 100%;
            height: 100px;
            resize: vertical;
            margin-bottom: 10px;
        }
        /* Add more styles as needed */
    </style>
</head>

<body>
    <!-- Display the initial ticket details -->
    <div class="ticket-details">
        <h2>Ticket Details</h2>
        <p><strong>Ticket ID:</strong> <?php $tickets['ticket_id'];?></p>
        <p><strong>User ID:</strong> [User ID here]</p>
        <p><strong>Description:</strong> [Description here]</p>
        <!-- Add more ticket details as needed -->
    </div>

    <!-- Reply box -->
    <div class="reply-box">
        <h2>Reply to Ticket</h2>
        <form action="process_reply.php" method="POST">
            <textarea name="reply_content" placeholder="Write your reply here"></textarea>
            <!-- You may include additional fields here -->
            <input type="submit" value="Submit Reply">
        </form>
    </div>
</body>
</html>