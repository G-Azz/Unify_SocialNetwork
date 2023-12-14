<?php 
include '../../../Controller/postED.php';
session_start();
    echo $_POST["postId"];
    $postedit = new PostED();
    $postId=$_POST["postId"];
    $postedit->deletePost($postId);

    
    header('Location: ./listpost.php');
    exit;

?>