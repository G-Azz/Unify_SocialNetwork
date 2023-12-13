<?php 
require_once 'C:\xampp\htdocs\Unify_SocialNetwork\Config.php';
// Make sure the path to Config.php is correct

class CommentED {
    // Method to add a comment
    public function addComment($comment) {
        // Updated SQL query to include the media field
        $sql = "INSERT INTO comments (post_id, created_by_user_id, comment_content, datetime_creation, media) VALUES (:post_id, :created_by_user_id, :comment_content, :dateTime_Creation, :media)";
        
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            // Execute the query with the media parameter
            $query->execute([
                'post_id' => $comment->getPostId(),
                'created_by_user_id' => $comment->getCreatedByUserId(),
                'comment_content' => $comment->getCommentContent(),
                'dateTime_Creation' => $comment->getDateTimeCreation()->format('Y-m-d H:i:s'),
                'media' => $comment->getMedia()
            ]);
            $lastInsertId = $db->lastInsertId();
            return $lastInsertId;
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    

    // Method to delete a comment
    public function deleteComment($commentId) {
        $sql = "DELETE FROM comments WHERE comment_id = :comment_id";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'comment_id' => $commentId
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Method to update a comment
    public function updateComment($comment_id, $comment_content, $dateTime_Creation) {
        try {
            $db = Config::getConnexion();
    
            // Check if $dateTime_Creation is a DateTime object, if not convert it
            if (!$dateTime_Creation instanceof DateTime) {
                $dateTime_Creation = new DateTime($dateTime_Creation);
            }
    
            $query = $db->prepare(
                'UPDATE comments SET 
                    comment_content = :comment_content,
                    datetime_creation = :dateTime_Creation
                WHERE comment_id = :comment_id'
            );
    
            $query->execute([
                'comment_content' => $comment_content,
                'dateTime_Creation' => $dateTime_Creation->format('Y-m-d H:i:s'),
                'comment_id' => $comment_id
            ]);
    
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    

    // Method to list all comments
    public function listComments() {
        $sql = "SELECT * FROM comments";
        $db = Config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    public function listCommentsById($post_id) {
        $sql = "SELECT * FROM comments WHERE post_id = :post_id ORDER BY `datetime_creation` DESC";
        $db = Config::getConnexion();
    
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            // Ideally log this error and then:
            return false; // Or handle the error as appropriate
        }
    }

}



// Usage example:
// $commentED = new CommentED();
// $commentED->addComment($commentObject); // Assuming $commentObject is an instance of the Comment class
// $commentED->deleteComment($commentId); // Assuming $commentId is the ID of the comment to be deleted
?>
