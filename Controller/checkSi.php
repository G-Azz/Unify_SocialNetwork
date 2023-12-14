<?php
require_once 'C:\xampp\htdocs\Unify_SocialNetwork\Config.php';
session_start();

$Username = $_POST['Username'];
$Password = $_POST['Password'];
$Password =md5($Password);


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
    
    

    if ($Username == "admin" && $Password == "21232f297a57a5a743894a0e4a801fc3") {
        header('Location: /ss/View/BackOffice/template/index.php');
    } else {
        $userId = $row[0]['Id_User'];
        $_SESSION['user_data'] = $row[0];
        $_SESSION['id'] = $userId;
        header('Location: ..\View\FrontOffice\Home\listpost.php');
        
        
    }
    exit(); // Ensure that no further code is executed after the redirect
} else {
    echo '<script>alert("Username or Password is invalid");</script>';
    echo '<script>window.location.href="/ss/View/index.php";</script>';
    exit(); // Ensure that no further code is executed after the redirect
}
