<?php
include("../../../../Controller/UserC.php");
include("../../../../Model/User.php");
session_start();
$error = '';
$User = isset($_SESSION['user_data']) ? $_SESSION['user_data'] : null;
$UserC = new UserC();


function validateInput($input)
{
    return filter_var($input, FILTER_VALIDATE_INT, array("options" => array("min_range" => 1)));
}

if (isset($_GET["id"])) {
    $userID = validateInput($_GET['id']);
    if (!$userID) {
        echo "Invalid user ID";
        exit();
    }
    $User = $UserC->showuser($userID);
} else {
    if (isset($_SESSION['id'])) {
        $userID = validateInput($_SESSION['id']);
        $user_data = $_SESSION['user_data'];
        
        $User = new User(
            $userID,
            isset($_POST['Name']) ? $_POST['Name'] : '',
            isset($_POST['Lname']) ? $_POST['Lname'] : '',
            isset($_POST['Email']) ? $_POST['Email'] : '',
            isset($_POST['Username']) ? $_POST['Username'] : '',
            isset($_POST['Password']) ? md5($_POST['Password']) : '',
            isset($_POST['Adress']) ? $_POST['Adress'] : '',
            isset($_POST['University']) ? $_POST['University'] : '',
            isset($_POST['classe']) ? $_POST['classe'] : '',
            isset($_POST['image']) ? $_POST['image'] : ''
        );
    }
}

if (isset($_POST['submit']) && isset($_SESSION['id']) && $User) {
    // Form is submitted, update the user
    $UserC->updateuser($User, $_SESSION['id']);
    // Redirect or perform any other actions after updating the user
    header("Location: updateUser.php");
    exit();
}
?>
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

        .tab-pane {
            animation: fadeIn 0.5s ease;
            transition: opacity 0.5s ease;
        }

        .tab-content {
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            transition: background-color 0.5s ease-in-out, box-shadow 0.3s ease-in-out;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            padding: 20px;
        }

        .tab-content #account-general {
            background-color: #f8f9fa;
        }

        .list-group-item {
            border: 1px solid rgba(0, 0, 0, 0.125);
            border-radius: 5px;
        }

        .card {
            border: 1px solid rgba(0, 0, 0, 0.125);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .text-right {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <?php
    if (isset($_SESSION['id'])) {
        $userID = validateInput($_SESSION['id']);
        $User = $UserC->showuser($userID);
    ?>
        <form method="POST" action="" onsubmit="return validateForm()">
            <div class="container light-style flex-grow-1 container-p-y">
                <h4 class="font-weight-bold py-3 mb-4">Account settings</h4>
                <div class="card overflow-hidden">
                    <div class="row no-gutters row-bordered row-border-light">
                        <div class="col-md-3 pt-0">
                            <div class="list-group list-group-flush account-settings-links">
                                <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account-general">General</a>
                                <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-info">Info</a>
                                <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-social-links">Social Links</a>
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

                                <div class="tab-pane fade" id="account-social-links">
                                    <div class="card-body pb-2">
                                        <div class="form-group">
                                            <label class="form-label">Twitter</label>
                                            <input type="text" class="form-control" value="https://twitter.com/user" />
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Facebook</label>
                                            <input type="text" class="form-control" value="https://www.facebook.com/user" />
                                        </div>
                                        <!-- Add more social links as needed -->
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-right mt-3">
                    <input type="submit" id="signupBtnFinal" class="btn btn-primary" value="Save changes" name="submit">
                    <button type="button" class="btn btn-default">Cancel</button>
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

    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript"></script>
</body>

</html>