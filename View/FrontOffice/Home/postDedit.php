<?php
include '../../../Controller/postED.php';
include '../../../Model/post.php';
session_start();
$error = "";
$media = ""; // Initialize $media variable

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['gif-url']) && $_POST['gif-url']) {
        $media = $_POST['gif-url'];
    }
    // Proceed with file upload if no GIF URL is provided
    else if (isset($_FILES['file-upload-edit']) && $_FILES['file-upload-edit']['error'] == 0) {
        $file = $_FILES['file-upload-edit'];
        $targetDirectory = "uploads/";
        $targetFile = $targetDirectory . basename($file['name']);

        // Security: Check if the file type is allowed
        $allowedTypes = ['image/jpeg', 'image/png', 'application/pdf']; // Add or remove file types as needed
        if (!in_array($file['type'], $allowedTypes)) {
            echo "Error: Unsupported file type.";
            exit;
        }

        // Security: Prevent overwriting existing files
     

        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            echo "The file " . htmlspecialchars(basename($file['name'])) . " has been uploaded.";
            $media = $targetFile; // Assign the target file path to $media
        } else {
            echo "Sorry, there was an error uploading your file.";
            exit; // Stop script execution if upload fails
        }
    }
}

$user_id = 1; // Replace with actual user ID (e.g., from session)
$createtime = date('Y-m-d H:i:s');
echo htmlspecialchars($_POST['selectedChannel']);
$channel_id = $_POST['selectedChannel']; // Provide a default value if not set
$posttype = $_POST['selectedTopic']; // Provide a default value if not set

$content = $_POST['editPostContent'] ;
$post = new Post($user_id, $createtime, $channel_id, $posttype, $content, $media);

$post->setPostId($_POST['postd']);
echo $post->getPostId() ;

if ($post->getPostId() ) {
    $postEdit = new PostED();

    // // Create a Post object with the updated data
    // $post = new Post();
    // $post->setPostId($postId);
    // $post->setContent($updatedContent);
    // $post->setMedia($media); // Set media if updated

    try {
        // Update the post in the database
        $postEdit->updatePost($post);
        echo "Post updated successfully.";
    } catch (PDOException $e) {
        $error = $e->getMessage();
        echo "Error updating post: " . $error;
    }
} else {
    echo "Error: Post ID or content missing.";
}
header('Location: ./listpost.php');
    exit;
?>
