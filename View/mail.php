<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include("../Controller/UserC.php");
include_once '../Model/User.php';
// ... (your existing code)
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


function generateVerificationCode()
{
    // Generate a unique verification code (you can customize this as needed)
    return md5(uniqid(rand(), true));
}

if (isset($_POST["signup"])) {
    try {
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 2; // 2 for detailed debug output

        // Server settings
        $mail->isSMTP();                        // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';   // Set the SMTP server to send through
        $mail->SMTPAuth   = true;               // Enable SMTP authentication
        $mail->Username   = 'amine.kerfai@esprit.tn';   // SMTP write your email
        $mail->Password   = 'zxrpnvvvxgzyggnb';           // SMTP password
        $mail->SMTPSecure = 'ssl';              // Enable implicit SSL encryption
        $mail->Port       = 465;

        // ... (your existing code)
        $verificationCode = generateVerificationCode();

        // Store the verification code in a session for later validation
        $_SESSION['verification_code'] = $verificationCode;

        // Store other user data in the session
        $_SESSION['user_data'] = array(
            'Name' => $_POST['Name'],
            'Lname' => $_POST['Lname'],
            'Email' => $_POST['Email'],
            'Username' => $_POST['Username'],
            'Password' => $_POST['Password'],
            'Adress' => $_POST['Adress'],
            'University' => $_POST['University']
        );

        // Recipients
        $mail->setFrom($_POST["Email"], $_POST["Name"]);
        $mail->addAddress($_POST["Email"]);
        $mail->addReplyTo($_POST["Email"], $_POST["Name"]);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Email Verification';
        $mail->Body    = 'Your verification code is: ' . $verificationCode;

        // Send the email
        $mail->send();
        
        // Redirect to the verification page
        header("Location: confirmation.php");
        exit();
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
}
?>
