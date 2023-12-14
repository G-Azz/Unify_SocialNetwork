<?php
include '../../../Controller/commentED.php';
include '../../../Model/comment.php';
include '../../../Model/post.php';
include '../../../Controller/functions.php';
include '../../../Controller/postED.php';
session_start();
$error = "";
$media = ""; // Initialize $media variable
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['gif-url']) && $_POST['gif-url']) {
        // Handle Giphy URL
        $media = $_POST['gif-url'];}
   else if (isset($_FILES['file-upload']) && $_FILES['file-upload']['error'] == 0) {
        $file = $_FILES['file-upload'];
        $targetDirectory = "uploads/";
        $targetFile = $targetDirectory . basename($file['name']);

        // Security: Check if the file type is allowed
        $allowedTypes = ['image/jpeg', 'image/png', 'application/pdf']; // Add or remove file types as needed
        if (!in_array($file['type'], $allowedTypes)) {
            echo "Error: Unsupported file type.";
            exit;
        }

        // Security: Prevent overwriting existing files
        if (file_exists($targetFile)) {
            echo "Error: File already exists.";
            exit;
        }

        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            echo "The file " . htmlspecialchars(basename($file['name'])) . " has been uploaded.";
            $media = $targetFile; // Assign the target file path to $media
        } else {
            echo "Sorry, there was an error uploading your file.";
            exit; // Stop script execution if upload fails
        }
    }
}
$commentedit = new CommentED();
$postedit = new PostED();
if (isset($_POST["commentContent"])) {
    $user_id = $_SESSION['user_data'] ['Id_User']; // Replace with actual user ID (e.g., from session)
    $post_id = $_POST['postId'];
    $createtime = date('Y-m-d H:i:s');
    $content = $_POST['commentContent'];
    $post = $postedit->showPost($post_id);



    $comment = new comment($post_id, $user_id, $content, $user_id, $createtime, $media);
    try {
        $lastInsertId = $commentedit->addComment($comment);
        echo "hello";
        // Redirect or other success actions
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
header('Location: ./listpost.php');
    exit;
?>
