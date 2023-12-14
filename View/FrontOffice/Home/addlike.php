<?php
session_start(); // Start the session at the beginning of the script
require_once '../../../Controller/likeED.php';

// Check if the user is logged in and the request is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_data'] ['Id_User'])) {
    $userId = $_SESSION['user_data'] ['Id_User']; // Retrieve the logged-in user's ID from the session

    // Assuming you're sending the liked ID and type via POST request
    if (isset($_POST['likedId']) && isset($_POST['likedType'])) {
        $likedId = $_POST['likedId'];
        $likedType = $_POST['likedType']; // 'post' or 'comment'

        $likeController = new LikeController();
        try {
            $lastInsertId = $likeController->addLike($userId, $likedId, $likedType);
            echo "Like added successfully. Like ID: " . $lastInsertId;
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    } else {
        echo "Required data not provided.";
    }
} else {
    echo "User not logged in or invalid request method.";
}
?>
