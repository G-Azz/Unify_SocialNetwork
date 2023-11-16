<?php
include("../Controller/UserC.php");
include("../Model/User.php");

$UserC = new UserC();
$User = NULL;

if (isset($_POST['Name']) && isset($_POST['Lname']) && isset($_POST['Email']) && isset($_POST['Username']) && isset($_POST['Password']) && isset($_POST['Adress']) && isset($_POST['University'])) {
    if (!empty($_POST['Name']) && !empty($_POST['Lname']) && !empty($_POST['Email']) && !empty($_POST['Username']) && !empty($_POST['Password']) && !empty($_POST['Adress']) && !empty($_POST['University'])) {
        // Validate form fields
        if (
            preg_match("/^[a-zA-Z ]*$/", $_POST['Name']) &&
            preg_match("/^[a-zA-Z ]*$/", $_POST['Lname']) &&
            filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL) &&
            preg_match("/^[a-zA-Z]*$/", $_POST['Username']) &&
            strlen($_POST['Password']) >= 8 
            // Add other validations for Adress and University if needed
        ) {
            // Form is valid, proceed with sign-up
            $User = new User(NULL, $_POST['Name'], $_POST['Lname'], $_POST['Email'], $_POST['Username'], $_POST['Password'], $_POST['Adress'], $_POST['University']);
            $UserC->addUser($User);
        } else {
            // Display error messages
            echo '<script>alert("Fix the errors in the form");</script>';
        }
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
    <form action="" method="POST" onsubmit="return validateForm()">
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
                        <option value="Tunis">Tunis</option>
                        <option value="Jandouba">Jandouba</option>
                        <option value="Touzeur">Touzeur</option>
                    </select>
                </div>

                <div class="input-field">
                    <i class="fa-solid fa-university"></i>
                    <select id="university" class="input-field-select" name="University">
                        <option value="Esprit">Esprit</option>
                        <option value="Beauart">Beauart</option>
                        <option value="ISIE Jandouba">ISIE Jandouba</option>
                    </select>
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
                    <input type="submit" id="signupBtnFinal" value="Sign up">
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
    <div class="modal" id="signinModal">
        <div class="modal-content">
            <span class="close" id="closeSigninModal">&times;</span>
            <h1>Sign In</h1>
            <form>
                <div class="input-field">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" placeholder="Username">
                </div>
                <div class="input-field">
                    <i class="fa-solid fa-key"></i>
                    <input type="password" placeholder="Password">
                </div>
                <div class="btn-field">
                    <button type="submit">Sign in</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>