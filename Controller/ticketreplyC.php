
<?php

require "../config.php";
class TicketReplyED {

public function addTicketReply($ticketReply) {
    $sql = "INSERT INTO ticket_reply (ticket_id, user_sender_id, media, created_datetime, description_reply) 
    VALUES (:ticket_id, :user_sender_id, :media, :created_datetime, :description_reply)";
    $db = config::getConnexion();

    try {
        $query = $db->prepare($sql);
        $query->execute([
            'ticket_id' => $ticketReply->getTicketId(),
            'user_sender_id' => $ticketReply->getUserSenderId(),
            'media' => $ticketReply->getMedia(),
            'created_datetime' => $ticketReply->getCreatedDatetime()->format('Y-m-d H:i:s'),
            'description_reply' => $ticketReply->getDescriptionReply(),
        ]);
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

public function deleteTicketReply($id) {
    $sql = "DELETE FROM ticket_reply WHERE ticket_reply_id = :ticket_reply_id";
    $db = config::getConnexion();
    $req = $db->prepare($sql);
    $req->bindValue(':ticket_reply_id', $id);

    try {
        $req->execute();
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}

public function listTicketReplies($ticketId) {
    $sql = "SELECT tr.*, t.user_sender_id AS ticket_user_id, t.descriptions AS ticket_description
            FROM ticket_reply AS tr
            JOIN tickets AS t ON tr.ticket_id = t.ticket_id
            WHERE tr.ticket_id = :ticket_id";
    $sql = "SELECT * FROM ticket_reply WHERE ticket_reply_id = :ticket_reply_id";
    $db = config::getConnexion();

    try {
        $query = $db->prepare($sql);
        $query->bindValue(':ticket_reply_id', $ticketId);
        $query->execute();
        $ticketReplies = $query->fetchAll();
        return $ticketReplies;
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}
public function listTickets()
    {
        $sql = "SELECT * FROM tickets"; 
        $db = config::getConnexion(); 
       
        try {
            $list = $db->query($sql);  
            return $list;
        } catch (Exception $e) 
         {
            die('Error:' . $e->getMessage());
        }
    }

    public function showTicket($id) {
        $sql = "SELECT * FROM tickets WHERE ticket_id = :ticket_id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindParam(':ticket_id', $id); // Bind the ticket_id parameter
            $query->execute();
            $ticket = $query->fetch();
            return $ticket;
        } catch (PDOException $e) {
            throw new Exception('Error: ' . $e->getMessage());
        }
    }

// Add more methods as needed, like updateTicketReply, showTicketReply, etc.
};
?>