<?php
include("../../../Controller/UserC.php");
include("../../../Model/User.php");
session_start();
$error = '';
$User = isset($_SESSION['user_data']) ? $_SESSION['user_data'] : null;
$UserC = new UserC();


function validateInput($input)
{
    return filter_var($input, FILTER_VALIDATE_INT, array("options" => array("min_range" => 1)));
}


$User = $UserC->showuser($_SESSION['user_data']['Id_User']);


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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" />

</head>

<body>


    <!-- sidebar starts -->
    <div class="sidebar">
        <img src="./SVG/unifylogo.svg" class="logo" />
        <div class="sidebarOption active"onclick="redirectToHomePage()" >
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
                window.location.href = 'http://localhost/Unify_SocialNetwork/View/FrontOffice/Home/profile.php';
            }
            function redirectToHelpPage() {
                // Use the local server URL
                window.location.href = 'http://localhost/Unify_SocialNetwork/View/FrontOffice/Tickets/index.php';
            }
            function redirectToHomePage() {
                // Use the local server URL
                window.location.href = 'http://localhost/Unify_SocialNetwork/View/FrontOffice/Home/listpost.php';
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

       <div class="sidebarOption" onclick="redirectToHelpPage()">
            <img class="menu__items__icons  "  src="./SVG/help.svg" />
            <h2>Help</h2>
        </div>

        <button class="sidebar__tweet">Discuss</button>
    </div>
    <div class="feed">
        <div class="feed__header">
            <h1>Profile</h1>
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
            <?php
            // Split the path and the filename
            $path_parts = explode('/', $User['media']);
            $filename = array_pop($path_parts); // Get the filename
            $directory = implode('/', $path_parts); // Get the directory path
        
            // Combine them with rawurlencode applied only to the filename
            $image_path = "../Login/" . $directory . '/' . rawurlencode($filename);
            ?>
           
            
            <div class="pfeed">
                
                <img src="<?php echo $image_path; ?>" alt="Figen" class="profile-image">
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
        </div>



        </div>
        <div class="widgets">
        <div class="profile-container">
            <?php
            // Split the path and the filename
            $path_parts = explode('/', $User['media']);
            $filename = array_pop($path_parts); // Get the filename
            $directory = implode('/', $path_parts); // Get the directory path
            
            // Combine them with rawurlencode applied only to the filename
            $image_path = "../Login/" . $directory . '/' . rawurlencode($filename);
            ?>
            <img src="<?php echo $image_path; ?>" alt="Profile Icon"
                style=" border-radius: 50%;height: 40px;width: 40px;">
            <div class="user-info">
                <span class="name" >
                    <?php echo $User['Nme'] ?> <?php echo $User['Lname'] ?>

                </span>
                <span class="username">@
                    <?php echo $User['Username'] ?>
                </span>
            </div>
            <span class="dropdown-menu-post">
                <svg class="dropdown-menu-post__icon" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <circle cx="4" cy="12" r="2" fill="currentColor" />
                    <circle cx="12" cy="12" r="2" fill="currentColor" />
                    <circle cx="20" cy="12" r="2" fill="currentColor" />
                </svg>

            </span>
            <h3>
                <ul class="dropdown-menu-post__content" style="top:70px;left:1230px">


                    <li>
                        <svg fill="#000000" height="24px" width="24px" version="1.1" id="Capa_1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            viewBox="0 0 482.568 482.568" xml:space="preserve">
                            <g>
                                <g>
                                    <path d="M116.993,203.218c13.4-1.8,26.8,2.8,36.3,12.3l24,24l22.7-22.6l-32.8-32.7c-5.1-5.1-5.1-13.4,0-18.5s13.4-5.1,18.5,0
            l32.8,32.8l22.7-22.6l-24.1-24.1c-9.5-9.5-14.1-23-12.3-36.3c4-30.4-5.7-62.2-29-85.6c-23.8-23.8-56.4-33.4-87.3-28.8
            c-4.9,0.7-6.9,6.8-3.4,10.3l30.9,30.9c14.7,14.7,14.7,38.5,0,53.1l-19,19c-14.7,14.7-38.5,14.7-53.1,0l-31-30.9
            c-3.5-3.5-9.5-1.5-10.3,3.4c-4.6,30.9,5,63.5,28.8,87.3C54.793,197.518,86.593,207.218,116.993,203.218z" />
                                    <path d="M309.193,243.918l-22.7,22.6l134.8,134.8c5.1,5.1,5.1,13.4,0,18.5s-13.4,5.1-18.5,0l-134.8-134.8l-22.7,22.6l138.9,138.9
            c17.6,17.6,46.1,17.5,63.7-0.1s17.6-46.1,0.1-63.7L309.193,243.918z" />
                                    <path d="M361.293,153.918h59.9l59.9-119.7l-29.9-29.9l-119.8,59.8v59.9l-162.8,162.3l-29.3-29.2l-118,118
            c-24.6,24.6-24.6,64.4,0,89s64.4,24.6,89,0l118-118l-29.9-29.9L361.293,153.918z" />
                                </g>
                            </g>
                        </svg>
                        Settings
                    </li>


                    <li class="delete-option" id="logoutOption">


                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24" fill="rgba(244,33,46,5)"
                            viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                            <g id="XMLID_1_">
                                <path id="XMLID_5_" d="M400.3,320.2V256H240.2v-64.2h160.1v-64.2l95.9,95.9L400.3,320.2z M367.7,287.7v128.5H207.6V512L15.8,416.1
        V0h351.9v160.1h-31.7V31.7h-256l128.5,64.2v287.7H337v-95.9H367.7z" />
                            </g>
                        </svg>
                        Logout

                    </li>






                </ul>
            </h3>

        </div>






        <!-- widgets ends -->
        <script src="./js/home.js"></script>
        <script src="./js/postedit.js"></script>
        <style>
            .profile-image{
                width: 120px;
                height: 120px;
                border-radius: 50%;
              margin: 20px 10px;
            }
                .pfeed {
                    display: flex;
                    flex-direction: column;
                    width: 100%;
                    margin: auto;
                    background-color: #fca1a1;
                    align-items: center;
                    padding: 20px;
                    border-radius: 12px;
                   
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
    <?php } ?>
</body>