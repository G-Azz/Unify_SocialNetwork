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
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Twitter Clone - Final</title>
    <link rel="stylesheet" href="styles.css" />
    <link rel="stylesheet" href="brand.css" />
    <link rel="stylesheet" href="post.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />

</head>

<body>


    <!-- sidebar starts -->
    <div class="sidebar">
        <img src="./SVG/unifylogo.svg" class="logo" />
        <div class="sidebarOption active">
            <img class=" menu__items__icons " src="./SVG/home.svg" />
            <h2>Home</h2>
        </div>

        <div class="sidebarOption">
            <img class="menu__items__icons  " src="./SVG/discussions.svg" />
            <h2>Discussions</h2>
        </div>

        <!-- <div class="sidebarOption">
        <img class="menu__items__icons  " src="./SVG/notification.svg" />
        <h2>Notifications</h2>
      </div> -->

        <!-- <div class="sidebarOption">
        <img class="menu__items__icons  " src="./SVG/schedule.svg" />
        <h2>Schedule</h2>
      </div> -->

        <div class="sidebarOption" onclick="redirectToUpdatePage()">
            <img class="menu__items__icons" src="./SVG/profile.svg" />
            <h2>Profile</h2>
        </div>

        <script>
            function redirectToUpdatePage() {
                // Use the local server URL
                window.location.href = 'http://localhost/ss/View/FrontOfiice/View/Home/profileView.php';
            }
        </script>



        <div class="sidebarOption">
            <img class=" menu__items__icons " src="./SVG/clubs.svg" />
            <h2>Find clubs</h2>
        </div>

        <div class="sidebarOption">
            <img class="menu__items__icons  " src="./SVG/carpooling.svg" />
            <h2>Carpooling</h2>
        </div>
        <ul class="tree">
            <li>
                <details>
                    <summary>
                        <div class="sidebarOption" id="study" tabindex="0" name="study">
                            <img class="menu__items__icons  " src="./SVG/study.svg" />
                            <h2>Study with</h2>
                        </div>
                    </summary>
                    <ul>
                        <div class="lefty">
                            <li>
                                <div class="sidebarOption">
                                    <img class="menu__items__icons  " src="./SVG/tutor.svg" />
                                    <h4>Tutor</h4>
                                </div>
                            </li>
                            <li>

                                <div class="sidebarOption">
                                    <img class="menu__items__icons  " src="./SVG/group.svg" />
                                    <h4>Group</h4>
                                </div>
                            </li>
                        </div>


                </details>
            </li>
        </ul>

        <div class="sidebarOption">
            <img class="menu__items__icons  " src="./SVG/courses.svg" />
            <h2>Courses</h2>
        </div>

        <div class="sidebarOption">
            <img class="menu__items__icons  " src="./SVG/help.svg" />
            <h2>Help</h2>
        </div>

        <div class="sidebarOption" id="logoutOption">
            <img class="menu__items__icons  " src="./SVG/help.svg" />
            <h2>Logout</h2>
        </div>

        <script>
            // Get the logout element by its ID
            var logoutOption = document.getElementById('logoutOption');

            // Add a click event listener to the logout element
            logoutOption.addEventListener('click', function() {
                // Redirect to index.php when the logout element is clicked
                window.location.href = '../../../../View/index.php';
            });
        </script>

        <button class="sidebar__tweet">Discuss</button>
    </div>
    <div class="feed">
        <div class="feed__header">
            <h1>Home</h1>
            <form action="postD.php" class="search_bar">

                <input type="text" placeholder="Search In Unify " name="q">
                <button type="submit" class="search_btn">
                    <img src="./SVG/search.svg" alt="Search">
                </button>

            </form>
        </div>

        <?php if (isset($_SESSION['id'])) {
            $userID = validateInput($_SESSION['id']);
            $User = $UserC->showuser($userID);
        ?>
        
            <div class="pfeed">
                <div class="profile-info">

                    <div class="profile-info-item">
                        <span class="label">Profile Image:</span>
                        <img src="<?php echo htmlspecialchars($User['media'] ); ?>"  />
                        <?php echo ($User['media'] ); ?>
                        
                    </div>
                    <div class="profile-info-item">
                        <span class="label">Username:</span>
                        <span class="value"><?php echo $User['Username']; ?></span>
                    </div>
                    <div class="profile-info-item">
                        <span class="label">Email:</span>
                        <span class="value"><?php echo $User['Email']; ?></span>
                    </div>
                    <div class="profile-info-item">
                        <span class="label">University:</span>
                        <span class="value"><?php echo $User['University']; ?></span>
                    </div>
                    <div class="profile-info-item">
                        <span class="label">Class:</span>
                        <span class="value"><?php echo $User['classe']; ?></span>
                    </div>
                </div>
            </div>
            <style>
                .pfeed {
                    width: 100%;
                    margin: auto;
                    background-color: #fca1a1;
                    padding: 20px;
                    border-radius: 12px;
                    margin-top: 50px;
                    border: 1px solid #ddd;
                }

                .profile-info {
                    text-align: center;
                    margin-bottom: 20px;
                }

                .profile-info-item {
                    margin-bottom: 15px;
                    font-size: 18px;
                }

                .label {
                    font-weight: bold;
                    color: #555;
                    margin-right: 10px;
                }

                .value {
                    color: #333;
                }
            </style>
    </div>
<?php } ?>
</body>