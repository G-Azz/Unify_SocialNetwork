<?php

include '../controller/ReclamationC.php';
include '../model/reclamation.php';

$error = "";
$reclamationC = new ReclamationC();

// Checking if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["reclamationId"]) && isset($_POST["isRead"])) {
        
        $reclamationId = $_POST["reclamationId"];
        $isRead = $_POST["isRead"];

        
        $reclamationC->updateReclamationStatus($reclamationId, $isRead);

        header('Location: listReclamations.php');
        exit();
    } else {
        $error = "Missing information";
    }
}

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Reclamation</title>
</head>

<body>
    <form action="" method="POST">
        <input type="hidden" name="reclamationId" value="<?php echo $_GET['id']; ?>">
        <label for="isRead">Mark as Read:</label>
        <input type="checkbox" name="isRead" value="1">
        <br>
        <input type="submit" value="Update">
    </form>
    <div id="error">
        <?php echo $error; ?>
    </div>
</body>

</html>