<?php
include('D:/Esprit 2eme/progs/xampp/htdocs/ss/config.php');
session_start();

$Username = $_POST['Username'];
$Password = $_POST['Password'];

$con = config::getConnexion();
$requete = "SELECT Id_User FROM user WHERE Username = :Username AND Pwd = :Pwd";
$stmt = $con->prepare($requete);
$stmt->bindParam(':Username', $Username);
$stmt->bindParam(':Pwd', $Password);

try {
    $stmt->execute();
} catch (PDOException $e) {
    die('Erreur: ' . $e->getMessage());
}

$row = $stmt->fetchAll();

if (!empty($row)) {
    $_SESSION['valide'] = true;
    $_SESSION['Username'] = $Username;
    if ($Username == "admin" && $Password == "admin") {
        header('Location: /ss/View/BackOffice/template/index.php');
    } else {
        header('Location: /Unify_SocialNetwork-aziz/View/FrontOffice/Home/postDD.php');
    }
    exit(); // Ensure that no further code is executed after the redirect
} else {
    echo '<script>alert("Username or Password is invalid");</script>';
    echo '<script>window.location.href="/ss/View/index.php";</script>';
    exit(); // Ensure that no further code is executed after the redirect
}
?>
