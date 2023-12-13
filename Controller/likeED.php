<?php
require_once 'C:\xampp\htdocs\Unify_SocialNetwork\Config.php';
// Make sure the path to Config.php is correct

class LikeController {

    // Method to add a like
    public function addLike($userId, $likedId, $likedType) {
        $sql = "INSERT INTO likes (user_id, liked_id, liked_type) VALUES (:user_id, :liked_id, :liked_type)";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'user_id' => $userId,
                'liked_id' => $likedId,
                'liked_type' => $likedType
            ]);
            return $db->lastInsertId();
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Method to delete a like
    public function deleteLike($userId, $likedId, $likedType) {
        $sql = "DELETE FROM likes WHERE user_id = :user_id AND liked_id = :liked_id AND liked_type = :liked_type";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'user_id' => $userId,
                'liked_id' => $likedId,
                'liked_type' => $likedType
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Method to count likes for a specific post or comment
    public function countLikes($likedId, $likedType) {
        $sql = "SELECT COUNT(*) as totalLikes FROM likes WHERE liked_id = :liked_id AND liked_type = :liked_type";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'liked_id' => $likedId,
                'liked_type' => $likedType
            ]);
            $result = $query->fetch();
            return $result['totalLikes'];
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function checkLiked($userId, $likedId, $likedType) {
        $sql = "SELECT COUNT(*) as likeCount FROM likes WHERE user_id = :user_id AND liked_id = :liked_id AND liked_type = :liked_type";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'user_id' => $userId,
                'liked_id' => $likedId,
                'liked_type' => $likedType
            ]);
            $result = $query->fetch();
            return $result['likeCount'] > 0;
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }
}

// Usage
// $likeController = new LikeController();
// $likeController->addLike($userId, $postId, 'post'); // To add a like
// $likeController->deleteLike($userId, $postId, 'post'); // To delete a like
// $likeCount = $likeController->countLikes($postId, 'post'); // To count likes for a post
?>
