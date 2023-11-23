

<?php
include '../Controller/ticketC.php';
include '../Model/ticket.php';


$error = "";
$ticketedit = new TicketED();


if (isset($_POST["descriptions"])) {
    $admin_id = 1;
    $opened = 0;
    $user_sender_id = 3; // This is an example. Replace with actual user ID.
    $created_datetime = date('Y-m-d H:i:s'); // Current datetime
    $ticketType = $_POST['ticketType'];
    // Assuming you have a default ticket type ID
    $descriptions = $_POST['descriptions'];
    $media = "empty"; // Handle file upload separately if needed

    $ticketTypeID = ($ticketType === 'feedback') ? 1 : 2;

    $ticket = new Ticket($user_sender_id, $admin_id, $descriptions, $media, $created_datetime, $ticketTypeID, $opened);

    try {
        $ticketedit->addTicket($ticket);
        // Redirect or perform other success actions
        header('Location:listtickets.php');
        exit();
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>



<html lang="en">

<head>
<link rel="stylesheet" href="faqstyle.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap">




    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="app.js"></script>

    <title>Reclamation </title>
</head>

<body>
    
    <a class="back-to-list" href="listtickets.php">Back To List </a>
    <a class="back-to-help" href="index.html">Back To Help Center </a>
    

    <div id="error">
        <?php echo $error; ?>
    </div>
    <form action="" method="POST" onsubmit="return validateDescription(event)">
    <div class="input-wrapper">
        <label for="descriptions" class="label-reclamation">Reclamation:</label>
        <input type="text" id="descriptions" name="descriptions" />
        <span id="charCount" style="color: red"></span>
    </div>

    <div class="tickettype-wrapper">
        <label for="ticketType" class="label-tickettype">  Ticket Type:  </label>
        <select id="ticketType" name="ticketType">
            <option value="feedback">Feedback</option>
            <option value="report">Report</option>
        </select>
    </div>

    <div class="buttons-wrapper">
        <input type="submit" value="Save">
        <input type="reset" value="Reset">
    </div>
</form>

<script>
    function validateDescription(event) {
        const description = document.getElementById('descriptions').value;
        const maxLength = 100;
        const charCount = document.getElementById('charCount');

        if (description.length > maxLength) {
            charCount.innerText = 'Ticket description should not exceed 100 characters.';
            event.preventDefault(); // Prevent form submission
            return false;
        }

        return true; // Allow form submission
    }
</script>

    
</body>

</html>









