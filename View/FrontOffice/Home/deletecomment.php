<?php 
session_start();
include "../../../Model/comment.php"; include "../../../Controller/commentED.php"; 
    $postedit = new CommentED();
 
    $postId=$_POST['commentId'];
    $postedit->deleteComment($postId);
    header('Location: ./listpost.php');
    exit;
    
  
    

?>