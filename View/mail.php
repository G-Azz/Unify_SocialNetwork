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

$media = '';
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
        
        $target_dir = "D:/Esprit 2eme/progs/xampp/htdocs/ss/View/FrontOfiice/View/Home/uploads/";
        $target_file = $target_dir . basename($_FILES["media"]["name"]);
        print_r($target_file);

        // Check file type
        $allowedTypes = ['image/jpeg', 'image/png']; // Add or remove file types as needed
        if (!in_array($_FILES['media']['type'], $allowedTypes)) {
            echo "Error: Unsupported file type.";
            exit;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Error: File already exists.";
            exit;
        }

        // Check and move uploaded file
        if (move_uploaded_file($_FILES['media']['tmp_name'], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES['media']['name'])) . " has been uploaded.";
            $media = $target_file; // Assign the target file path to $media
        } else {
            echo "Sorry, there was an error uploading your file.";
            exit; // Stop script execution if upload fails
        }

        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


        // Store other user data in the session
        $_SESSION['user_data'] = array(
            'Name' => $_POST['Name'],
            'Lname' => $_POST['Lname'],
            'Email' => $_POST['Email'],
            'Username' => $_POST['Username'],
            'Password' => $_POST['Password'],
            'Adress' => $_POST['Adress'],
            'University' => $_POST['University'],
            'classe' => $_POST['classe'],
            'media' => $media

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
