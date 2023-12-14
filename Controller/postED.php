<?php 
require_once 'C:\xampp\htdocs\Unify_SocialNetwork\Config.php';
// Make sure the path to Config.php is correct

class PostED {
    // Method to add a post
    function showPost($postId)
    {
        $sql = "SELECT * from post where post_id = $postId";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $rec = $query->fetch();
            return $rec;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    function showPostbyuser($postId)
    {
        $sql = "SELECT * from post where id_user = $postId";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $rec = $query->fetch();
            return $rec;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
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

 function updatePost($post)
{   
    try {
        $db = config::getConnexion();
        $query = $db->prepare(
            'UPDATE post SET
                created_datetime= :created_datetime,
                channel_id= :channel_id,
                posttype_id= :posttype,
                content = :content,
                media= :media
            WHERE post_id = :postId'
        );
        
        $query->execute([
                'created_datetime' => $post->getCreateTime()->format('Y-m-d H:i:s'),
                'channel_id' => $post->getChannelId(),
                'posttype' => $post->getPostType(),
                'content' => $post->getContent(),
                'postId' =>$post->getPostId(),
                'media' =>$post->getMedia()
        ]);
        
        echo $query->rowCount() . " records UPDATED successfully <br>";
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
public function listPosts()
{
    $sql = "SELECT * FROM `post` ORDER BY `post`.`Created_DateTime` DESC";
    $db = config::getConnexion();
    try {
        $liste = $db->query($sql);
        return $liste;
    } catch (Exception $e) {
        die('Error:' . $e->getMessage());
    }
}
}




// Usage
// $postED = new PostED();
// $postED->addPost($postObject); // Assuming $postObject is an instance of the Post class
// $postED->deletePost($postId); // Assuming $postId is the ID of the post to be deleted

?>
