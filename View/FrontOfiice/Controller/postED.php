<?php 
require_once 'D:\Esprit 2eme\progs\xampp\htdocs\Unify_SocialNetwork\Config.php';
// Make sure the path to Config.php is correct

class PostED {
    // Method to add a post
    public function addPost($post) {
        $sql = $sql = "INSERT INTO post (id_user, created_datetime, channel_id, posttype_id, content, media) VALUES (:user, :created_datetime, :channel_id, :posttype, :content, :media)";
        ;
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'user' => $post->getUserId(),
                'created_datetime' => $post->getCreateTime()->format('Y-m-d H:i:s'),
                'channel_id' => $post->getChannelId(),
                'posttype' => $post->getPostType(),
                'content' => $post->getContent(),
                'media' => $post->getMedia()
            ]);
            // Get the last inserted ID
        $lastInsertId = $db->lastInsertId();
        return $lastInsertId;
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Method to delete a post
    public function deletePost($postId) {
        $sql = "DELETE FROM post WHERE post_id = :post_id";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'post_id' => $postId
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}

// Usage
// $postED = new PostED();
// $postED->addPost($postObject); // Assuming $postObject is an instance of the Post class
// $postED->deletePost($postId); // Assuming $postId is the ID of the post to be deleted

?>
