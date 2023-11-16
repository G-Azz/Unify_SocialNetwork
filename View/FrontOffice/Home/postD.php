<?php
include '../../../Controller/postED.php';
include '../../../Model/post.php';

$error = "";
$postedit = new PostED();

if (isset($_POST["postContent"])) {
    // Retrieve user ID from session or other source

    $user_id = 1; // This is an example. Replace with actual user ID.
    $createtime = date('Y-m-d H:i:s'); // Current datetime

    // Assuming you have form inputs for channel_id, posttype, content, and media
    // If not, replace these with appropriate default values or other logic
    $channel_id = 1;
    $posttype = 1;
    $content = $_POST['postContent'];
    $media = "empty"; // Handle file upload separately if needed

    $post = new Post($user_id, $createtime, $channel_id, $posttype, $content, $media);


    try {
        $postedit->addPost($post);
        // Redirect or perform other success actions
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

// Additional logic or HTML here
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

        <div class="sidebarOption">
            <img class="menu__items__icons  " src="./SVG/profile.svg" />
            <h2>Profile</h2>
        </div>
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

        <button class="sidebar__tweet">Discuss</button>
    </div>
    <!-- sidebar ends -->

    <!-- feed starts -->
    <div class="feed">
        <div class="feed__header">
            <h1>Home</h1>
            <form action="post" class="search_bar">

                <input type="text" placeholder="Search In Unify " name="q">
                <button type="submit" class="search_btn">
                    <img src="./SVG/search.svg" alt="Search">
                </button>

            </form>
        </div>

        <!-- tweetbox starts -->
        <form action="postD.php" method="post">
            <div class="post-box">
                <div class="post-header">
                    <img src="path-to-your-profile-icon.png" alt="Profile Icon" width="32" height="32">
                    <textarea name="postContent" rows="2" placeholder="What is happening?!"
                        oninput="autoResizeTextarea(this); toggleButtonOpacity(this);"></textarea>
                </div>

                <div class="post-footer">
                    <div class="options">
                        
                        <span class="option">GIF</span>
                        <span class="option">📷</span>
                        <span class="option">📍</span>
                        <span class="option">🔒</span>
                    </div>
                    <button type="submit" id="postButton" style="opacity: 0.5;" disabled>Post</button>
                </div>
            </div>
        </form>
        <!-- tweetbox ends -->

        <!-- post starts -->
        <div class="post">
            <div class="post__avatar">
                <img src="path-to-user-avatar.png" alt="User Avatar" />
            </div>

            <div class="post__body">
                <div class="post__header">
                    <div class="post__headerText">
                        <h3>
                            User Name 
                            <span class="post__headerSpecial">
                                <span class="material-icons post__badge"> verified </span>
                                @username 
                            </span>
                        </h3>
                    </div>
                    <div class="post__headerDescription">
                        <p>
                            <?php echo htmlspecialchars($post->getContent()); ?>
                        </p>
                    </div>
                </div>
                <?php if ($post->getMedia() !== "empty"): ?>
                    <img src="<?php echo htmlspecialchars($post->getMedia()); ?>" alt="Post Media" />
                <?php endif; ?>
                <div class="post__footer">
                    <span class="material-icons"> repeat </span>
                    <span class="material-icons"> favorite_border </span>
                    <span class="material-icons"> publish </span>
                    <span class="material-icons" style="position: flex;">
                        
                            <span class="material-icons"> edit </span> 
                        <form method="post" action="postDD.php"
                            onsubmit="return confirm('Are you sure you want to delete this post?');">
                            <button type="submit" class="delete-button" style="background: none; border: none;">
                                <span class="material-icons">close</span>
                            </button>
                        </form>
                    </span>
                </div>
            </div>
        </div>

        <div class="post">
            <div class="post__avatar">
                <img src="https://i.pinimg.com/originals/a6/58/32/a65832155622ac173337874f02b218fb.png" alt="" />
            </div>

            <div class="post__body">
                <div class="post__header">
                    <div class="post__headerText">
                        <h3>
                            Somanath Goudar
                            <span class="post__headerSpecial"><span class="material-icons post__badge"> verified
                                </span>@somanathg</span>
                        </h3>
                    </div>
                    <div class="post__headerDescription">
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                </div>
                <img src="https://www.focus2move.com/wp-content/uploads/2020/01/Tesla-Roadster-2020-1024-03.jpg"
                    alt="" />
                <div class="post__footer">
                    <span class="material-icons"> repeat </span>
                    <span class="material-icons"> favorite_border </span>
                    <span class="material-icons"> publish </span>
                </div>
            </div>
        </div>
        <!-- post ends -->

        <!-- post starts -->
        <div class="post">
            <div class="post__avatar">
                <img src="https://i.pinimg.com/originals/a6/58/32/a65832155622ac173337874f02b218fb.png" alt="" />
            </div>

            <div class="post__body">
                <div class="post__header">
                    <div class="post__headerText">
                        <h3>
                            Somanath Goudar
                            <span class="post__headerSpecial"><span class="material-icons post__badge"> verified
                                </span>@somanathg</span>
                        </h3>
                    </div>
                    <div class="post__headerDescription">
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                </div>
                <img src="https://www.focus2move.com/wp-content/uploads/2020/01/Tesla-Roadster-2020-1024-03.jpg"
                    alt="" />
                <div class="post__footer">
                    <span class="material-icons"> repeat </span>
                    <span class="material-icons"> favorite_border </span>
                    <span class="material-icons"> publish </span>
                </div>
            </div>
        </div>
        <!-- post ends -->
    </div>
    <!-- feed ends -->

    <!-- widgets starts -->






    <!-- widgets ends -->
    <script src="./js/home.js"></script>
    <script>
        function autoResizeTextarea(textarea) {
            textarea.style.height = 'auto';
            textarea.style.height = textarea.scrollHeight + 'px';
        }
        function toggleButtonOpacity(textarea) {
            const button = document.getElementById('postButton');
            if (textarea.value.trim().length > 0) {
                button.style.opacity = 1;
                button.disabled = false;
            } else {
                button.style.opacity = 0.5;
                button.disabled = true;
            }
        }
        /* When the user clicks on the button, toggle between hiding and showing the dropdown content */
        function toggleDropdown() {
            document.getElementById("myDropdown").classList.toggle("show");
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function (event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }

        // Function to select or deselect all checkboxes
        function selectAll(source) {
            checkboxes = document.querySelectorAll('.dropdown-content input[type="checkbox"]');
            for (var i = 0, n = checkboxes.length; i < n; i++) {
                checkboxes[i].checked = source.checked;
            }
        }

    </script>
</body>

</html>