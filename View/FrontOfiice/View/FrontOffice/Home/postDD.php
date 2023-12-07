<?php 
include '../../../Controller/postED.php';

    $postedit = new PostED();
    $postId=$_POST["postId"];
    $postedit->deletePost($postId);

    
    header('Location: ./index.php');
    exit;

?>