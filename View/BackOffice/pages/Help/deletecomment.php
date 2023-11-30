<?php 
include "../../../../Model/comment.php"; include "../../../../Controller/commentED.php"; 
    $postedit = new CommentED();
 
    $postId=$_GET['id'];
    $postedit->deleteComment($postId);

    
    header('Location: ./post.php');
    exit;

?>