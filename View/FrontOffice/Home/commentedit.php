<?php
include '../../../Controller/commentED.php';
include '../../../Model/post.php';
session_start();
var_dump($_POST);
$error = "";
$media = ""; // Initialize $media variable
$editCommentContent=$_POST['editCommentContent'];
$commentid=$_POST['commentid'];
$createtime = date('Y-m-d H:i:s');
 $commentEdit = new CommentED();


    try {
        // Update the post in the database
        $commentEdit->updateComment($commentid,$editCommentContent,$createtime);
        echo "Post updated successfully.";
    } catch (PDOException $e) {
        $error = $e->getMessage();
        echo "Error updating post: " . $error;
    }
    header('Location: ./listpost.php');
    exit;
  
?>