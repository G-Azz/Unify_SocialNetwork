<?php

require "../config.php";

class ReclamationC {

    public function listReclamations() {
        $sql = "SELECT * FROM tickets";
        $db = config::getConnexion();
        try {
            $reclamations = $db->query($sql);
            return $reclamations;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function addReclamation($reclamation) {
        $sql = "INSERT INTO tickets 
                VALUES (NULL, :user_sender_id, :admin_id, :description, :media, NOW(), :ticket_type_id, :Open)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'user_sender_id' => $reclamation->getUserSenderId(),
                'description' => $reclamation->getDescription(),
                'media' => $reclamation->getMedia(),
                'ticket_type_id' => $reclamation->getTicketTypeId(),
                'Open' => $reclamation->isOpen(),
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function deleteReclamation($id) {
        $sql = "DELETE FROM tickets WHERE Ticket_id = :ticketId";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':ticketId', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    public function updateReclamationStatus($reclamationId, $isRead) {
        $sql = "UPDATE tickets SET isRead = :isRead WHERE Ticket_id = :reclamationId";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'isRead' => $isRead,
                'reclamationId' => $reclamationId,
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
};
?>