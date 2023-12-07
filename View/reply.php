<?php
include "../Model/ticketreply.php";
include_once "../controller/ticketC.php";
include_once "../controller/ticketreplyC.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$user_sender_id = 3;
$ticketedit = new TicketED();
$ticket = $ticketedit->showTicket($_GET['id']);
$ticketreplyedit = new TicketReplyED();

$errors = []; // To store validation errors

if (isset($_POST["reply_content"])) {
    $admin_id = 1;
    $opened = 1;
    $created_datetime = date('Y-m-d H:i:s');
    $description_reply = $_POST['reply_content'];
    $media = "empty";

    if (empty($description_reply)) {
        $errors[] = "Fill in your reply in order to send it";
    } else {
        $ticketrep = new TicketReply($_GET['id'], $user_sender_id, $media, $created_datetime, $description_reply);

        try {
            $ticketreplyedit->addTicketReply($ticketrep);
            $mail = new PHPMailer(true);

                try {
                    //Server settings
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.gmail.com'; // Your SMTP server
                    $mail->SMTPAuth   = true;
                    $mail->Username   = 'ashref.benamor@esprit.tn';    // Your SMTP username
                    $mail->Password   = 'goukspqgzvowxzyu';    // Your SMTP password
                    $mail->SMTPSecure = 'ssl';              // Enable TLS encryption
                    $mail->Port       = 465;                // TCP port to connect to

                    //Recipients
                    $mail->setFrom('ashref.benamor@esprit.tn');
                    $mail->addAddress('ashref.benamor@esprit.tn');

                    // Content
                    $mail->isHTML(true);
                    $mail->Subject = 'Une reponse a ete ajoute';
                    $mail->Body    = $_POST['reply_content'];

                    $mail->send();
                    header("location:../template/pages/Help/Help.php");
                    echo 'Email has been sent';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                     }
            
            exit();
        } 
        catch (Exception $e) {
            $error = $e->getMessage();
        }
        
        
    }
}

?>

<html>
<head>
    <link rel="stylesheet" href="reply.css"/>

    <title>Reply to Ticket</title>
</head>

<body>

<div class="khalil">
    <div class="ticket-details">
        <div class="ticketd">
            <h2>Ticket Details</h2>
            <p><strong>Description:</strong><?php echo $ticket['descriptions']; ?> </p>

            <p><strong>Ticket ID:</strong> <?php echo $ticket['ticket_id']; ?></p>
            <p><strong>User ID:</strong> <?php echo $ticket['user_sender_id']; ?></p>
        </div>
    </div>

    <!-- Reply box -->
    <div class="reply-box">
        <h2>Reply to Ticket</h2>
        <?php if (!empty($errors)) : ?>
            <div class="errors">
                <?php foreach ($errors as $error) : ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <form action="" method="POST">
            <textarea name="reply_content" placeholder="Write your reply here"></textarea>
            <input type="hidden" name="ticket_idd" value="<?php echo $ticket['ticket_id']; ?> ">
            <input type="submit" value="Submit Reply">
        </form>
    </div>
</div>
</body>
</html>
