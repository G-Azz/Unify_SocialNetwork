<?php 
include __DIR__ . '../../../Controller/postED.php';
    session_start();
    $postedit = new PostED();
    $postId=$_POST["postId"];
    $postedit->deletePost($postId);
    $userId = $_SESSION['UserId'];
    $user_data=$_SESSION['user_data'];
    
    header('Location: /ss/View/FrontOfiice/View/Home/index.php');
    exit;

?>