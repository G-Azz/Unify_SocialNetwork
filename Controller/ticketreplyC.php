
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

public function getRepliesForTicket($ticket_id) {
    $db = config::getConnexion(); // Obtain your database connection

    // Fetch responses for the given ticket_id from ticket_reply table
    $sql = "SELECT * FROM ticket_reply WHERE ticket_id = :ticket_id";
    $query = $db->prepare($sql);
    $query->bindParam(':ticket_id', $ticket_id);
    $query->execute();

    $responses = $query->fetchAll(PDO::FETCH_ASSOC);
    return $responses;
}
public function updateTicketReply($description_reply, $ticket_reply_id) {
    $sql = "UPDATE ticket_reply SET description_reply = :description_reply WHERE ticket_reply_id = :ticket_reply_id";
    $db = config::getConnexion();

    try {
        $query = $db->prepare($sql);
        $query->execute([
            'description_reply' => $description_reply,
            'ticket_reply_id' => $ticket_reply_id,
        ]);
        echo $query->rowCount() . " records UPDATED successfully <br>";
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

};
?>