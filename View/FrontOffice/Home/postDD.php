<?php 
include '../../../Controller/postED.php';

    $postedit = new PostED();
    $postedit->deletePost($postId);

    
    header('Location: ./index.html');
    exit;

?>