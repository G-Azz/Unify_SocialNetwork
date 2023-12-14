<?php
session_start();

include("../../../Controller/UserC.php");
include("../../../Model/User.php");

$UserC = new UserC();
$User = NULL;
$media='';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (
        isset($_POST['Name'], $_POST['Lname'], $_POST['Email'], $_POST['Username'], $_POST['Password'], $_POST['Adress'], $_POST['University']) &&
        !empty($_POST['Name']) && !empty($_POST['Lname']) && !empty($_POST['Email']) &&
        !empty($_POST['Username']) && !empty($_POST['Password']) && !empty($_POST['Adress']) && !empty($_POST['University']) &&
        preg_match("/^[a-zA-Z ]*$/", $_POST['Name']) &&
        preg_match("/^[a-zA-Z ]*$/", $_POST['Lname']) &&
        filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL) &&
        preg_match("/^[a-zA-Z]*$/", $_POST['Username']) &&
        strlen($_POST['Password']) >= 8
    ) {

    

    // Check if image file is a actual image or fake image
    
    // Check if $uploadOk is set to 0 by an error
    

        // Form is valid, proceed with sign-up
        $User = new User(NULL, $_POST['Name'], $_POST['Lname'], $_POST['Email'], $_POST['Username'], $_POST['Password'], $_POST['Adress'], $_POST['University'], $_POST['classe'], $_POST['media']);
        
        // Store the user data in the session
        // After creating the $User object
        $_SESSION['user_data'] = $User;


        header("Location: confirmation.php");        // Redirect to the verification page
        exit();
    } else {
        // Display error messages
        echo '<script>alert("Fix the errors in the form");</script>';
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script defer src="script.js"></script>
    <script src="https://kit.fontawesome.com/dbd6142856.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Oswald&family=Pacifico&display=swap" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>UNIFY</title>
</head>

<body>
    <div class="logo">
        <h1 id="underLogo">Universities' Connected Network</h1>
        <img src="logouni.png" alt="LogoUni" id="logo">
    </div>
    <div class="container">
        <div class="form-box">
            <h1 id="title">Welcome</h1>
            <button id="signupBtn" class="button">Sign up</button>
            <button id="signinBtn" class="button">Sign in</button>
        </div>
    </div>
    <form action="mail.php" method="POST" onsubmit="return validateForm()" enctype="multipart/form-data">

        <div class="modal" id="signupModal">
            <div class="modal-content">
                <span class="close" id="closeModal">&times;</span>
                <h1>Step 1: Personal Information</h1>

                <div class="input-field">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" placeholder="First Name" id="Name" name="Name">
                    <?php
                    if (isset($_POST['Name']) && !preg_match("/^[a-zA-Z ]*$/", $_POST['Name'])) {
                        echo 'fix name';
                    }
                    ?>
                </div>

                <div class="input-field">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" placeholder="Last Name" id="Lname" name="Lname">
                    <?php
                    if (isset($_POST['Lname']) && !preg_match("/^[a-zA-Z ]*$/", $_POST['Lname'])) {
                        echo 'fix LastNom';
                    }
                    ?>
                </div>

                <div class="input-field">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email" placeholder="Email" id="Email" name="Email">
                    <?php
                    if (isset($_POST['Email']) && !filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL)) {
                        echo 'verfier lemail';
                    }
                    ?>
                </div>

                <div class="btn-field">
                    <button type="button" id="nextStep">Next</button>
                </div>

            </div>
        </div>

        <div class="modal" id="step2Modal">
            <div class="modal-content">
                <span class="close" id="closeStep2Modal">&times;</span>
                <h1>Step 2: Account Information</h1>

                <div class="input-field">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" placeholder="Username" id="Username" name="Username">
                    <?php
                    if (isset($_POST['Username']) && !preg_match("/^[a-zA-Z]*$/", $_POST['Username'])) {
                        echo ' Username can only contain letters';
                    }
                    ?>
                </div>

                <div class="input-field">
                    <i class="fa-solid fa-key"></i>
                    <input type="password" placeholder="Password" id="Password" name="Password">
                    <?php
                    if (isset($_POST['Password']) && strlen($_POST['Password']) < 8) {
                        echo 'Password must be at least 8 characters long';
                    }
                    ?>
                </div>

                <div class="input-field">
                    <i class="fa-solid fa-flag"></i>
                    <select id="country" class="input-field-select" name="Adress">
                        <option>Ariana</option>
                        <option>Béja</option>
                        <option>Ben Arous</option>
                        <option>Bizerte</option>
                        <option>Gabès</option>
                        <option>Gafsa</option>
                        <option>Jendouba</option>
                        <option>Kairouan</option>
                        <option>Kasserine</option>
                        <option>Kébili</option>
                    </select>
                </div>

                <div class="input-field">
                    <i class="fa-solid fa-university"></i>
                    <select id="university" class="input-field-select" name="University">
                        <option>Esprit</option>
                        <option>Isie</option>
                        <option>Insat</option>
                        <option>Medteck</option>
                        <option>Enit</option>
                    </select>
                </div>

                <div class="input-field">
                    <i class="fa-solid fa-people-roof"></i>
                    <input type="text" placeholder="classe" id="classe" name="classe">
                    <?php
                    if (isset($_POST['Username']) && !preg_match("/^[a-zA-Z]*$/", $_POST['Username'])) {
                        echo ' Username can only contain letters';
                    }
                    ?>
                </div>

                <div class="input-field">
                    <i class="fa-solid fa-portrait"></i>
                    <label for="profileImage">Profile Image</label>
                    <input type="file" id="profileImage" name="media" >
                    <?php
                    if (isset($_POST['media']) && empty($_POST['media'])) {
                        echo 'Please upload a profile image.';
                    }
                    ?>
                </div>


                <div class="input-field">
                    <label for="acceptTerms" class="TAC">I accept the terms and conditions</label>
                    <input type="checkbox" id="acceptTerms" name="acceptTerms">
                    <?php
                    if (isset($_POST['acceptTerms']) && !$_POST['acceptTerms']) {
                        echo '<span class="error-message">You must accept the terms and conditions</span>';
                    }
                    ?>
                </div>

                <div class="btn-field">
                    <button type="button" id="prevStep">Previous</button>
                    <input type="submit" id="signupBtnFinal" value="Sign up" name="signup">
                </div>

            </div>
        </div>
    </form>
    <script>
        function validateForm() {
            var name = document.getElementById('Name').value;
            var lname = document.getElementById('Lname').value;
            var email = document.getElementById('Email').value;
            var username = document.getElementById('Username').value;
            var password = document.getElementById('Password').value;
            var address = document.getElementById('country').value;
            var university = document.getElementById('university').value;

            // Basic validation - check if the required fields are not empty
            if (!name || !lname || !email || !username || !password || !address || !university) {
                alert('Please fill in all the required fields.');
                return false;
            }

            // Validate Name and Lname as strings with only characters
            var namePattern = /^[A-Za-z]+$/;
            if (!namePattern.test(name) || !namePattern.test(lname)) {
                alert('Name and Last Name must contain only characters.');
                return false;
            }

            // Validate email using a simple pattern
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                alert('Please enter a valid email address.');
                return false;
            }

            // Validate username as a string
            if (typeof username !== 'string' || username.length === 0) {
                alert('Username must be a non-empty string.');
                return false;
            }

            // Validate password as a string with at least 8 characters
            if (typeof password !== 'string' || password.length < 8) {
                alert('Password must be a string with at least 8 characters.');
                return false;
            }

            // Validate address and university as strings
            if (typeof address !== 'string' || address.length === 0 || typeof university !== 'string' || university.length === 0) {
                alert('Address and University must be non-empty strings.');
                return false;
            }

            return true; // Allow form submission
        }
    </script>
    </div>
    </div>

    <form action="../../../Controller/checkSi.php" method="POST" onsubmit="return validateForm1()">
        <div class="modal" id="signinModal">
            <div class="modal-content">
                <span class="close" id="closeSigninModal">&times;</span>
                <h1>Sign In</h1>
                <div class="input-field">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" placeholder="Username" name="Username">
                </div>
                <div class="input-field">
                    <i class="fa-solid fa-key"></i>
                    <input type="password" placeholder="Password" name="Password">
                </div>
                <div class="g-recaptcha" data-sitekey="6Ldv7yMpAAAAAAFNT0JBMZBbEfim6erUhW_-UC2I"></div>
                <div class="btn-field">
                    <button type="submit" name="signinBtn">Sign in</button>
                </div>
            </div>
        </div>
    </form>

    <script>
        function validateForm1() {
            // Check if the captcha is completed
            var response = grecaptcha.getResponse();
            if (response.length === 0) {
                alert("Please complete the captcha.");
                return false; // Prevent form submission
            }

            // Optionally, you can add additional validation logic here

            return true; // Allow form submission
        }
    </script>



</body>

</html>