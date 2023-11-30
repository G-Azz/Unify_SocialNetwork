<?php 
include "../../../../Model/post.php"; include "../../../../Controller/postED.php"; 
    $postedit = new PostED();
 
    $postId=$_GET['id'];
    $postedit->deletePost($postId);

    
    header('Location: ./post.php');
    exit;

?>