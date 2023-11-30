<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role = $_POST["role"];

    if ($role === "client") {
        header("Location: ../view/client_events.php");
        exit();
    } elseif ($role === "admin") {
        header("Location: ../view/admin_panel.php");
        exit();
    }
}
?>
