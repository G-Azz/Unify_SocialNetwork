<?php
include '../../../Controller/ticketC.php'; 
$ticketedit = new TicketED();
$ticketedit->deleteTicket($_GET["id"]); 
header("Location: {$_SERVER['HTTP_REFERER']}");


?>