<?php
require_once 'C:\xampp\htdocs\Unify_SocialNetwork\Config.php';


class TicketED {

    

    public function addTicket($ticket) {
        $sql = "INSERT INTO tickets (user_sender_id, admin_id, descriptions, media, created_datetime, ticket_typeid, opened, email) 
                VALUES (:user_senderid, :admin_id, :descriptions, :media, :created_datetime, :ticket_typeid, :opened, :email)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([  
                'user_senderid' => $ticket->getUserSenderId(),
                'admin_id' => $ticket->getAdminId(),
                'descriptions' => $ticket->getdescriptions(),
                'media' => $ticket->getMedia(),
                'created_datetime' => $ticket->getCreatedDatetime()->format('Y-m-d H:i:s'),
                'ticket_typeid' => $ticket->getTicketTypeId(),
                'opened' => $ticket->getopened(),
                'email' => $ticket->getemail(), // Include the email field
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    
    public function getLastInsertedId() {
        $db = config::getConnexion(); // Assuming this method gets the database connection

        // Run a query to get the last inserted ID
        $query = $db->query("SELECT LAST_INSERT_ID() AS last_id");
        $result = $query->fetch(PDO::FETCH_ASSOC);

        // Fetch and return the last inserted ID
        return $result['last_id'];
    }

    public function deleteTicket($id) {
        $sql = "DELETE FROM tickets WHERE ticket_id = :ticketId";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':ticketId', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function listTicketsByUser($user_sender_id) {
        $sql = "SELECT * FROM tickets WHERE user_sender_id = :user_sender_id";
        $db = config::getConnexion(); 
    
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':user_sender_id', $user_sender_id);
            $query->execute();
            $tickets = $query->fetchAll();
            return $tickets;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    public function listTickets($start, $perPage)
{
    $sql = "SELECT * FROM tickets LIMIT :start, :perPage";
    $db = config::getConnexion();

    try {
        $query = $db->prepare($sql);
        $query->bindParam(':start', $start, PDO::PARAM_INT);
        $query->bindParam(':perPage', $perPage, PDO::PARAM_INT);
        $query->execute();
        $tickets = $query->fetchAll();
        return $tickets;
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
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
    public function updateTicket($ticket, $id) {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE tickets SET 
                    descriptions = :descriptions
                WHERE ticket_id = :ticket_id'
            );
            
            $query->execute([
                'ticket_id' => $id,
                'descriptions' => $ticket->getDescriptions(),
            ]);
            
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
    public function listTicketsByUserWithPagination($user_sender_id, $start, $perPage) {
        try {
            // Establish the database connection
            $pdo = config::getConnexion();
    
            // Prepare the SQL query with placeholders for pagination
            $stmt = $pdo->prepare("SELECT * FROM tickets WHERE user_sender_id = :user_id LIMIT :start, :per_page");
            $stmt->bindParam(':user_id', $user_sender_id, PDO::PARAM_INT);
            $stmt->bindParam(':start', $start, PDO::PARAM_INT);
            $stmt->bindParam(':per_page', $perPage, PDO::PARAM_INT);
            $stmt->execute();
    
            // Fetch the result as an associative array
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle any database connection or query errors here
            die('Error: ' . $e->getMessage());
        }
    }

    // Method to count total tickets for a user
    public function countTicketsByUser($user_sender_id) {
        try {
            // Establish the database connection
            $pdo = config::getConnexion();

            // Prepare the query
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM tickets WHERE user_sender_id = :user_sender_id");
            $stmt->bindParam(':user_sender_id', $user_sender_id);
            $stmt->execute();

            // Fetch the count
            $count = $stmt->fetchColumn();

            return $count;
        } catch (PDOException $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
    
};
?>