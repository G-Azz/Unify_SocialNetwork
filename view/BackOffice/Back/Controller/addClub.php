<?php
include './ClubC.php';
include '../model/Club.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
$mail = new PHPMailer(true);
$error = "";

// create client
$Club = null;

// create an instance of the controller
$ClubC = new ClubC();
if (
    isset($_POST["name"]) &&    
    isset($_POST["type"]) &&
    isset($_POST["description"])
    
) {
    if (
        !empty($_POST["name"]) &&
        !empty($_POST["type"]) &&
        !empty($_POST["description"])

    ) {
        $Club = new Club(
            $_POST['name'],
            $_POST['type'],
            $_POST['description'],

        );
        $ClubC->addClub($Club);
        
    } else
    $error = "Missing information";
        if($ClubC) {
            try {
                $name = $_POST['name'];
                $type = $_POST['type'];
                $description =$_POST['description'];
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host= 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth= true;                                   //Enable SMTP authentication
                $mail->Username= 'nesrine.nabli@esprit.tn';                     //SMTP username
                $mail->Password= 'Nes12345';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port = 465;  
                $mail->setFrom('nablinesrine113@gmail.com', 'NabliNesrine');
                $mail->addAddress('nesrine.nabli@esprit.tn', 'Test');
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Ajout Club';
                $mail->Body    = "Club a ete cree avec succes. Les données sont  .<br>. <b>Name:</b> $name .<br>. <b>type:</b> $type .<br>. <b>description:</b> $description";
                $mail->send();
               if($mail) header("Location:../../view/pages/evenement/evenement.php");
            } catch (Exception $th) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
         
        }

      // 

}


?>