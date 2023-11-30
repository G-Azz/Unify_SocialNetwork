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
    isset($_POST["University"])

) {
    if (
        !empty($_POST["Name"]) &&
        !empty($_POST["Lname"]) &&
        !empty($_POST["Email"]) &&
        !empty($_POST["Username"]) &&
        !empty($_POST["Password"]) &&
        !empty($_POST["Adress"]) &&
        !empty($_POST["University"])
    ) {

        $User = new User(NULL, $_POST['Name'], $_POST['Lname'], $_POST['Email'], $_POST['Username'], $_POST['Password'], $_POST['Adress'], $_POST['University']);
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
</head>

<body>
<?php
        if (isset($_GET["id"])) {
            $userID = $_GET['id'];
            $User = $UserC->showuser($userID);
        
        ?>

    <form method="POST" action="">
        <div class="container light-style flex-grow-1 container-p-y">
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
                                        <input type="text" placeholder="First Name" id="Name" name="Name"  value="<?php echo $User['Nme']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Last name</label>
                                        <input type="text" placeholder="Last Name" id="Lname" name="Lname" value="<?php echo $User['Lname'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Email</label>
                                        <input type="email" placeholder="Email" id="Email" name="Email" value="<?php echo $User['Email'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Password</label>
                                        <input type="text" placeholder="Password" id="Password" name="Password" value="<?php echo $User['Pwd'] ?>">
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
                                        <select class="custom-select" name="Adress">
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
                                    <div class="form-group">
                                        <label class="form-label">Google+</label>
                                        <input type="text" class="form-control" value />
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">LinkedIn</label>
                                        <input type="text" class="form-control" value />
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Instagram</label>
                                        <input type="text" class="form-control" value="https://www.instagram.com/user" />
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="account-connections">
                                <div class="card-body">
                                    <button type="button" class="btn btn-twitter">
                                        Connect to <strong>Twitter</strong>
                                    </button>
                                </div>
                                <hr class="border-light m-0" />
                                <div class="card-body">
                                    <h5 class="mb-2">
                                        <a href="javascript:void(0)" class="float-right text-muted text-tiny"><i class="ion ion-md-close"></i> Remove</a>
                                        <i class="ion ion-logo-google text-google"></i>
                                        You are connected to Google:
                                    </h5>
                                    <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="f9979498818e9c9595b994989095d79a9694">[email&#160;protected]</a>
                                </div>
                                <hr class="border-light m-0" />
                                <div class="card-body">
                                    <button type="button" class="btn btn-facebook">
                                        Connect to <strong>Facebook</strong>
                                    </button>
                                </div>
                                <hr class="border-light m-0" />
                                <div class="card-body">
                                    <button type="button" class="btn btn-instagram">
                                        Connect to <strong>Instagram</strong>
                                    </button>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="account-notifications">
                                <div class="card-body pb-2">
                                    <h6 class="mb-4">Activity</h6>
                                    <div class="form-group">
                                        <label class="switcher">
                                            <input type="checkbox" class="switcher-input" checked />
                                            <span class="switcher-indicator">
                                                <span class="switcher-yes"></span>
                                                <span class="switcher-no"></span>
                                            </span>
                                            <span class="switcher-label">Email me when someone comments on my article</span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="switcher">
                                            <input type="checkbox" class="switcher-input" checked />
                                            <span class="switcher-indicator">
                                                <span class="switcher-yes"></span>
                                                <span class="switcher-no"></span>
                                            </span>
                                            <span class="switcher-label">Email me when someone answers on my forum thread</span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="switcher">
                                            <input type="checkbox" class="switcher-input" />
                                            <span class="switcher-indicator">
                                                <span class="switcher-yes"></span>
                                                <span class="switcher-no"></span>
                                            </span>
                                            <span class="switcher-label">Email me when someone follows me</span>
                                        </label>
                                    </div>
                                </div>
                                <hr class="border-light m-0" />
                                <div class="card-body pb-2">
                                    <h6 class="mb-4">Application</h6>
                                    <div class="form-group">
                                        <label class="switcher">
                                            <input type="checkbox" class="switcher-input" checked />
                                            <span class="switcher-indicator">
                                                <span class="switcher-yes"></span>
                                                <span class="switcher-no"></span>
                                            </span>
                                            <span class="switcher-label">News and announcements</span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="switcher">
                                            <input type="checkbox" class="switcher-input" />
                                            <span class="switcher-indicator">
                                                <span class="switcher-yes"></span>
                                                <span class="switcher-no"></span>
                                            </span>
                                            <span class="switcher-label">Weekly product updates</span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="switcher">
                                            <input type="checkbox" class="switcher-input" checked />
                                            <span class="switcher-indicator">
                                                <span class="switcher-yes"></span>
                                                <span class="switcher-no"></span>
                                            </span>
                                            <span class="switcher-label">Weekly blog digest</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-right mt-3">

                <input type="submit" id="signupBtnFinal" class="btn btn-primary" value="Save changes">
                <button type="button" class="btn btn-default">Cancel</button>
            </div>
        </div>
    </form>
    <?php } ?>

    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript"></script>
</body>

</html>