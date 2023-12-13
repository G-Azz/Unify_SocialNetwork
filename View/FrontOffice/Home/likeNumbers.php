<?php
session_start(); // Start the session at the beginning of the script
require_once '../../../Controller/likeED.php';

if (isset($_GET['postId'])) {
    $postId = $_GET['postId'];
    $type =$_GET['likedType'];
    $likeController = new LikeController();
    $likeCount = $likeController->countLikes($postId, $type);

    echo $likeCount;
} else {
    echo "Post ID not provided";
}
?>

