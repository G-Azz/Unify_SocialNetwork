<?php

include("../Controller/UserC.php");
include("../Model/User.php");

$error = "";


$User = null;

$UserC = new UserC();
if (
    isset($_POST["Name"]) &&
    isset($_POST["Lname"]) &&
    isset($_POST["Email"]) &&
    isset($_POST["Username"]) &&
    isset($_POST["Password"]) &&
    isset($_POST["Adress"]) &&
    isset($_POST["University"]) &&
    isset($_POST["classe"])

) {
    if (
        !empty($_POST["Name"]) &&
        !empty($_POST["Lname"]) &&
        !empty($_POST["Email"]) &&
        !empty($_POST["Username"]) &&
        !empty($_POST["Password"]) &&
        !empty($_POST["Adress"]) &&
        !empty($_POST["University"]) &&
        !empty($_POST["classe"])
    ) {

        $User = new User(NULL, $_POST['Name'], $_POST['Lname'], $_POST['Email'], $_POST['Username'], md5($_POST['Password']), $_POST['Adress'], $_POST['University'] ,$_POST['classe'], $_POST['image']);
        var_dump($User);
        $UserC->updateuser($User, $_GET['id']);
        header('Location:/ss/View/BackOffice/template/pages/tables/basic-table.php');
    } else $error =
        "Missing information";
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CodingDung | Profile Template</title>
    <link rel="stylesheet" href="styleU.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(135deg, #ff9999, #ffffff);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            transition: background 0.5s ease-in-out;
        }
        @keyframes gradientBG {
            0% {
                background-position: 0% 0%;
            }
            50% {
                background-position: 100% 0%;
            }
            100% {
                background-position: 0% 0%;
            }
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            padding: 20px;
            transition: background-color 0.5s ease-in-out;
        }

        .card {
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .list-group-item {
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .list-group-item:hover {
            background-color: #f8f9fa;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ced4da;
            border-radius: 5px;
        }

        select {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ced4da;
            border-radius: 5px;
            background-color: #fff;
        }

        .btn-primary,
        .btn-default {
            border-radius: 5px;
        }

        hr {
            margin: 20px 0;
            border: none;
            border-top: 1px solid #ced4da;
        }

        .tab-pane {
            animation: fadeIn 0.5s ease;
            transition: opacity 0.5s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .tab-content {
            background-color: #fff;
            border-radius: 5px;
            overflow: hidden;
            transition: background-color 0.5s ease-in-out;
        }

        .tab-content #account-general {
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>
    <?php
    if (isset($_GET["id"])) {
        $userID = $_GET['id'];
        $User = $UserC->showuser($userID);
    ?>

        <form method="POST" action="" onsubmit="return validateForm()">
            <div class="container">
                <h4 class="font-weight-bold py-3 mb-4">Account settings</h4>
                <div class="card overflow-hidden">
                    <div class="row no-gutters row-bordered row-border-light">
                        <div class="col-md-3 pt-0">
                            <div class="list-group list-group-flush account-settings-links">
                                <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account-general">General</a>
                                <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-info">Info</a>
                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="account-general">
                                    <hr class="border-light m-0" />
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label class="form-label">Username</label>
                                            <input type="text" placeholder="Username" id="Username" name="Username" value="<?php echo $User['Username']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Name</label>
                                            <input type="text" placeholder="First Name" id="Name" name="Name" value="<?php echo $User['Nme']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Last name</label>
                                            <input type="text" placeholder="Last Name" id="Lname" name="Lname" value="<?php echo $User['Lname'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Email</label>
                                            <input type="text" placeholder="Email" id="Email" name="Email" value="<?php echo $User['Email'] ?>">
                                        </div>

                                        

                                        <div class="form-group">
                                            <label class="form-label">Password</label>
                                            <input type="text" placeholder="Password" id="Password" name="Password" value="">
                                        </div>

                                        
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="account-info">
                                    <div class="card-body pb-2">
                                        <div class="form-group">
                                            <label class="form-label">University</label>
                                            <select id="university" class="input-field-select" name="University">
                                                <option>Esprit</option>
                                                <option>Isie</option>
                                                <option>Insat</option>
                                                <option>Medteck</option>
                                                <option>Enit</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Country</label>
                                            <select class="custom-select" name="Adress" id="adress">
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
                                            <i class="fa-solid fa-people-roof"></i>
                                            <input type="text" placeholder="classe" id="classe" name="classe" value="<?php echo $User['classe'] ?>">
                                            <?php
                                            if (isset($_POST['Username']) && !preg_match("/^[a-zA-Z]*$/", $_POST['Username'])) {
                                                echo ' Username can only contain letters';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <hr class="border-light m-0" />
                                </div>
                                <div class="text-right mt-3">
                                    <input type="submit" id="signupBtnFinal" class="btn btn-primary" value="Save changes">
                                    <button type="button" class="btn btn-default">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    <?php } ?>

    <script>
        function validateForm() {
            var name = document.getElementById('Name').value;
            var lname = document.getElementById('Lname').value;
            var email = document.getElementById('Email').value;
            var username = document.getElementById('Username').value;
            var password = document.getElementById('Password').value;
            var address = document.getElementById('adress').value;
            var university = document.getElementById('university').value;

            if (!name || !lname || !email || !username || !password || !address || !university) {
                alert('Please fill in all the required fields.');
                return false;
            }

            var namePattern = /^[A-Za-z]+$/;
            if (!namePattern.test(name) || !namePattern.test(lname)) {
                alert('Name and Last Name must contain only characters.');
                return false;
            }

            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                alert('Please enter a valid email address.');
                return false;
            }

            if (typeof username !== 'string' || username.length === 0) {
                alert('Username must be a non-empty string.');
                return false;
            }

            if (typeof password !== 'string' || password.length < 8) {
                alert('Password must be a string with at least 8 characters.');
                return false;
            }

            if (typeof address !== 'string' || address.length === 0 || typeof university !== 'string' || university.length === 0) {
                alert('Address and University must be non-empty strings.');
                return false;
            }

            return true;
        }
    </script>

    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

