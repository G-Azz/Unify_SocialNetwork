<?php
include '../../../Controller/ticketreplyC.php'; 
$ticketedit = new TicketReplyED();
$ticketedit->deleteTicketReply($_GET["id"]); 
header("Location: {$_SERVER['HTTP_REFERER']}");


?>