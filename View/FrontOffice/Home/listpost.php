<?php


// Assuming you have a Controller class that can fetch posts
include("../../../Controller/UserC.php");
include("../../../Model/User.php");
require_once '../../../Controller/postED.php';
require_once '../../../Controller/functions.php';
include "../../../Model/comment.php";
include "../../../Controller/commentED.php";

session_start();

$error = '';
$User = isset($_SESSION['user_data']) ? $_SESSION['user_data'] : null;
$UserC = new UserC();

// Uncomment the next line if you want to debug and see the current user data


function validateInput($input)
{
    return filter_var($input, FILTER_VALIDATE_INT, array("options" => array("min_range" => 1)));
}

if (isset($_SESSION['id'])) {
    $userID = validateInput($_SESSION['id']);

    // Only create a new User object if the data is being updated
    // You might need additional checks here to see if a POST request is being made
    $User = $UserC->showuser($userID);


} else {
    echo "No user ID found in session.";
}

$postController = new PostED(); // Replace with your actual controller class
$posts = $postController->listPosts(); // Replace with the actual method to fetch posts
$commentController = new CommentED(); // Replace with your actual controller class
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Unify| Home</title>
    <link rel="stylesheet" href="styles.css" />
    <link rel="stylesheet" href="brand.css" />
    <link rel="stylesheet" href="post.css" />
    <link rel="stylesheet" href="comment.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" />

</head>

<body>
    <!--Modal Delete -->

    <!--Modal Delete -->
    <div id="deleteConfirmationModal" class="modal">
        <div class="modal-content">
            <h2>Delete Post?</h2>
            <p>This can’t be undone and it will be removed from your profile, the timeline of any accounts that follow
                you, and from search results.</p>
            <form id="deleteForm" method="post" action="postDD.php" onsubmit="return true">
                <input type="hidden" name="postId" id="postId_delete">
                <button type="submit" class="delete-btn">Delete</button>
                <button type="button" onclick="closeModal()" class="cancel-btn">Cancel</button>
            </form>

        </div>
    </div>
    <div id="deleteConfirmationModalComment" class="modal">
        <div class="modal-content">
            <h2>Delete Comment?</h2>
            <p>This can’t be undone and it will be removed from your profile, the timeline of any accounts that follow
                you, and from search results.</p>
            <form id="deleteFormcomment" method="post" action="deletecomment.php" onsubmit="return true">
                <input type="hidden" name="commentId" id="commentId_delete" value="">
                <button type="submit" class="delete-btn">Delete</button>
                <button type="button" onclick="closeModalcomment()" class="cancel-btn">Cancel</button>
            </form>
        </div>
    </div>
    <!--Modal edit -->
    <div id="editPostModal" class="modal" style="display:none;">
        <div class="modal-content-edit">
            <h2>Edit post</h2>
            <form id="EditFormControl" action="PostDedit.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="postd" id="postId_edit">
                <div class="post-box">
                    <div class="post-header">
                        <?php
                        // Split the path and the filename
                        $path_parts = explode('/', $User['media']);
                        $filename = array_pop($path_parts); // Get the filename
                        $directory = implode('/', $path_parts); // Get the directory path
                        
                        // Combine them with rawurlencode applied only to the filename
                        $image_path = "../Login/" . $directory . '/' . rawurlencode($filename);
                        ?>
                        <img src="<?php echo $image_path; ?>" alt="Profile Icon" width="32" height="32">
                        <div class="dropdown-container">
                            <div>
                                <p>Chat Channels :</p>
                                <div class="dropdown">
                                    <div class="dropbtn" id="dropbtn-edit">
                                        <span class="plus-sign"><svg width="19" height="19" viewBox="0 0 24 24"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12 5V19" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M5 12H19" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="dropdown-content" id="dropdown-content-edit">
                                        <a href="#" data-value="All_Channels">All Channels</a>
                                        <a href="#" data-value="General_Chat">General Chat</a>
                                        <a href="#" data-value="Area_Chat">Area Chat</a>
                                        <a href="#" data-value="University_Chat">University Chat</a>
                                        <a href="#" data-value="Class_Chat">Class Chat</a>
                                        <a href="#" data-value="Private_Chat">Private Chat</a>
                                    </div>
                                </div>
                                <div id="selected-options-edit" class="selected-options"></div>
                                <!-- Container for displaying selected options -->
                            </div>
                            <div>
                                <div class="dropdown">
                                    <div class="dropbtn" id="dropbtn2-edit">
                                        <span class="hashtag-sign" id="hashtag-sign-edit">#topic</span>
                                    </div>
                                    <div class="dropdown-content" id="dropdown-content2-edit">
                                        <a href="#" data-value="#General_Discussion">#General Discussion</a>
                                        <a href="#" data-value="#Missing_items">#Missing Items</a>
                                        <a href="#" data-value="#Advertising">#Advertising</a>
                                        <a href="#" data-value="#Other">#Other</a>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>


                    <!-- Hidden Inputs for Selected Channel and Topic -->
                    <input type="hidden" name="selectedChannel" id="selectedChannel-edit">
                    <input type="hidden" name="selectedTopic" id="selectedTopic-edit">
                    <input id="gif-url" name="gif-url" type="text" style="display:none;" class="gif-url" />

                    <!-- Textarea for Post Content -->
                    <textarea name="editPostContent" rows="2" placeholder="Edit your post..." id="content-edit"
                        oninput="autoResizeTextarea(this); "></textarea>

                    <!-- Image Preview Container-->

                    <div id="image-preview-container-edit" style="position: relative;display:none;"
                        class="image-preview-container">
                        <span id="remove-image-btn-edit">&times;</span>
                        <div id="progress-container-edit" style="position: relative;display:none;"
                            class="progress-container">

                            <img id="image-preview-edit" class="image-preview"
                                style="position: relative; top: 0; left: 0; width: 100%; height: 100%; object-fit: contain;" />
                            <svg id="svg-progress-bar-edit" class="svg-progress-bar" width="75" height="75"
                                viewbox="0 0 100 100"
                                style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                                <circle cx="50" cy="50" r="45" stroke="#eca9ae" stroke-width="5" fill="none" />
                                <circle id="progress-bar-edit" cx="50" cy="50" r="45" stroke="#c41318" stroke-width="5"
                                    stroke-dasharray="282.74" stroke-dashoffset="282.74" fill="none" />
                            </svg>
                        </div>
                    </div>


                    <!-- Post Footer -->
                    <div class="post-footer">
                        <div class="options" style="cursor:pointer">
                            <!-- Options here can be inputs as well, depending on what they do -->
                            <span class="option" onclick="toggleGiphyMenu(this,1)">GIF
                                <div class="giphy-menu" style="display: none;">
                                    <input type="text" class="giphy-search" placeholder="Search for GIFs"
                                        value="trending">
                                </div>


                            </span>

                            <div id="giphy-display"></div>
                            <label for="file-upload-edit" class="option">
                                📷
                            </label>
                            <input id="file-upload-edit" name="file-upload-edit" type="file" style="display:none;"
                                class="file-upload" />
                            <span class="option" onclick="toggleEmoteMenu(this,0)">😊
                                <div class="emote-container" style="display: none;"></div>
                            </span>
                            <span class="option">📍</span>
                            <span class="option">🔒</span>
                        </div>
                        <button type="button" onclick="closeEditModal()" class="cancel-btn">Cancel</button>
                        <button type="submit" id="postContent-edit" style="opacity: 1;">Confirme</button>
                    </div>

                </div>
        </div>
        </form>
    </div>
    </div>
    <!--allahu akba-->
    <div id="editPostModalcomment" class="modal" style="display:none;">
        <div class="modal-content-edit">
            <h2>Edit Comment</h2>
            <form id="EditFormControlcomment" action="commentedit.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="commentid" id="commentId_edit">
                <div class="post-box">
                    <div class="post-header">
                        <?php
                        // Split the path and the filename
                        $path_parts = explode('/', $User['media']);
                        $filename = array_pop($path_parts); // Get the filename
                        $directory = implode('/', $path_parts); // Get the directory path
                        
                        // Combine them with rawurlencode applied only to the filename
                        $image_path = "../Login/" . $directory . '/' . rawurlencode($filename);
                        ?>
                        <img src="<?php echo $image_path; ?>" alt="Profile Icon" width="32" height="32">
                    </div>

                    <!-- Textarea for Post Content -->
                    <textarea name="editCommentContent" rows="2" placeholder="Edit your post..."
                        id="content-editcomment" oninput="autoResizeTextarea(this); "></textarea>

                    <!-- Post Footer -->
                    <div class="post-footer">
                        <div class="options" style="cursor:pointer">
                            <!-- Options here can be inputs as well, depending on what they do -->
                            <span class="option" onclick="toggleGiphyMenu(this,1)">GIF
                                <div class="giphy-menu" style="display: none;">
                                    <input type="text" class="giphy-search" placeholder="Search for GIFs">
                                </div>

                            </span>


                            <span class="option">📍</span>
                            <span class="option">🔒</span>

                        </div>
                        <button type="button" onclick="closeEditModalcomment()" class="cancel-btn">Cancel</button>
                        <button type="submit" id="commentContent-edit" style="opacity: 1;">Confirme</button>
                    </div>

                </div>
        </div>
        </form>
    </div>
    </div>
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
    <!-- sidebar ends -->

    <!-- feed starts -->
    <div class="feed" id="feed">
        <div class="feed__header" id="head">
            <h1>Home</h1>
            <form action="postD.php" class="search_bar">

                <input type="text" placeholder="Search In Unify " name="q">
                <button type="submit" class="search_btn">
                    <img src="./SVG/search.svg" alt="Search">
                </button>

            </form>
        </div>

        <!-- tweetbox starts -->
        <form id="FormControl" action="postD.php" method="post" enctype="multipart/form-data"
            onsubmit="return validateForm();">
            <div class="post-box">
                <div class="post-header">
                    <?php
                    // Split the path and the filename
                    $path_parts = explode('/', $User['media']);
                    $filename = array_pop($path_parts); // Get the filename
                    $directory = implode('/', $path_parts); // Get the directory path
                    
                    // Combine them with rawurlencode applied only to the filename
                    $image_path = "../Login/" . $directory . '/' . rawurlencode($filename);
                    ?>
                    <img src="<?php echo $image_path; ?>" alt="Profile Icon" width="32" height="32">
                    <div class="dropdown-container">
                        <div>
                            <p>Chat Channels :</p>
                            <div class="dropdown">
                                <div class="dropbtn" id="dropbtn">
                                    <span class="plus-sign"><svg width="19" height="19" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 5V19" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M5 12H19" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="dropdown-content" id="dropdown-content">
                                    <a href="#" data-value="All_Channels">All Channels</a>
                                    <a href="#" data-value="General_Chat">General Chat</a>
                                    <a href="#" data-value="Area_Chat">Area Chat</a>
                                    <a href="#" data-value="University_Chat">University Chat</a>
                                    <a href="#" data-value="Class_Chat">Class Chat</a>
                                    <a href="#" data-value="Private_Chat">Private Chat</a>
                                </div>
                            </div>
                            <div id="selected-options" class="selected-options"></div>
                            <!-- Container for displaying selected options -->
                        </div>
                        <div>
                            <div class="dropdown">
                                <div class="dropbtn" id="dropbtn2">
                                    <span class="hashtag-sign" id="hashtag-sign">#topic</span>
                                </div>
                                <div class="dropdown-content" id="dropdown-content2">
                                    <a href="#" data-value="#General_Discussion">#General Discussion</a>
                                    <a href="#" data-value="#Missing_items">#Missing Items</a>
                                    <a href="#" data-value="#Advertising">#Advertising</a>
                                    <a href="#" data-value="#Other">#Other</a>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <input type="hidden" name="selectedChannel" id="selectedChannel" value="">
                <input type="hidden" name="selectedTopic" id="selectedTopic" value="">

                <textarea id="postContent" name="postContent" rows="2" placeholder="What is happening?!"
                    oninput="autoResizeTextarea(this); toggleButtonOpacity(this);"></textarea>

                <div id="image-preview-container" class="image-preview-container"
                    style="position: relative; display: none;">
                    <span id="remove-image-btn" class="remove-image-btn">&times;</span>
                    <div id="progress-container" class="progress-container" style="display: none; position: relative;">
                        <img id="image-preview" class="image-preview"
                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: contain;" />
                        <svg id="svg-progress-bar" class="svg-progress-bar" width="75" height="75" viewbox="0 0 100 100"
                            style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                            <circle cx="50" cy="50" r="45" stroke="#eca9ae" stroke-width="5" fill="none" />
                            <circle id="progress-bar" class="progress-bar" cx="50" cy="50" r="45" stroke="#c41318"
                                stroke-width="5" stroke-dasharray="282.74" stroke-dashoffset="282.74" fill="none" />
                        </svg>
                    </div>
                </div>

                <div class="post-footer">
                    <div class="options" style="cursor:pointer;">
                        <!-- Options here can be inputs as well, depending on what they do -->
                        <span class="option" onclick="toggleGiphyMenu(this, 1)">GIF

                            <div class="giphy-menu" style="display: none;">
                                <input type="text" class="giphy-search" placeholder="Search for GIFs">
                                <!-- Other content here -->
                            </div>
                        </span>



                        </span>
                        <!-- GIFs will be loaded here -->

                        <label for="file-upload" class="option">
                            📷
                        </label>
                        <input id="gif-url" name="gif-url" type="text" style="display:none;" class="gif-url" />
                        <input id="file-upload" name="file-upload" type="file" style="display:none;"
                            onchange="toggleUploadButton(this)" class="file-upload" />
                        <span class="option">📍</span>
                        <span class="option">🔒</span>
                        <span class="option" onclick="toggleEmoteMenu(this,0)">😊
                            <div class="emote-container" style="display: none;"></div>
                        </span>
                    </div>
                    <button type="submit" id="postButton" style="opacity: 0.5;" disabled>Post</button>
                </div>
            </div>
        </form>
        <!-- tweetbox ends -->
        <!-- post starts -->
        <?php foreach ($posts as $post) { ?>
            <?php
            $userpost = $UserC->showuser($post['id_user']);
            ?>
            <div class="post">
                <div class="post__avatar">
                    <?php
                    // Split the path and the filename
                    $path_parts = explode('/', $userpost['media']);
                    $filename = array_pop($path_parts); // Get the filename
                    $directory = implode('/', $path_parts); // Get the directory path
                
                    // Combine them with rawurlencode applied only to the filename
                    $image_path = "../Login/" . $directory . '/' . rawurlencode($filename);
                    ?>
                    <img src="<?php echo $image_path; ?>" alt="" />


                </div>

                <div class="post__body">
                    <div class="post__header">
                        <div class="post__headerText">
                            <h3>
                                <?php echo $userpost['Nme'] ?>
                                <?php echo $userpost['Lname'] ?>
                                <span class="post__headerSpecial"><span class="material-icons post__badge"> verified
                                    </span>@
                                    <?php echo $userpost['Username'] ?>
                                    <span class="post__date"
                                        data-creation-time="<?php echo (new DateTime($post['Created_DateTime']))->format('c'); ?>">
                                        <?php echo htmlspecialchars(timeElapsedString(new DateTime($post['Created_DateTime']))); ?>
                                    </span>
                                </span>
                                <span class="dropdown-menu-post">
                                    <svg class="dropdown-menu-post__icon" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="4" cy="12" r="2" fill="currentColor" />
                                        <circle cx="12" cy="12" r="2" fill="currentColor" />
                                        <circle cx="20" cy="12" r="2" fill="currentColor" />
                                    </svg>
                                    <ul class="dropdown-menu-post__content">

                                        <li class="delete-option" onclick="confirmDelete(<?php echo $post['post_id']; ?>);">

                                            <svg class="icon delete-icon" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" fill="rgba(244,33,46,5)" class="bi bi-trash"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M7 21q-.825 0-1.412-.587Q5 19.825 5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413Q17.825 21 17 21ZM17 6H7v13h10ZM9 17h2V8H9Zm4 0h2V8h-2ZM7 6v13Z" />
                                            </svg>
                                            Delete
                                        </li>
                                        <li>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="icon"
                                                fill="black" class="bi bi-pin" viewBox="0 0 16 16">
                                                <path
                                                    d="M4.146 4.146a.5.5 0 0 1 .708 0L8 7.293l3.146-3.147a.5.5 0 0 1 .708.708L8.707 8l3.147 3.146a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708 0L8 9.707l-3.146 3.147a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 0-.708L7.293 8 4.146 4.854a.5.5 0 0 1 0-.708z" />
                                                <path
                                                    d="M5.5 5.5a.5.5 0 0 1 .5.5v.634l.549-.317 2-1.155V3.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1.634l2 1.155.549.317V6a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H10v.293l.854.853-.708.708-2-2-.708-.708-.708.708-2 2-.708-.708L6 8.293V8H1.5A.5.5 0 0 1 1 7.5v-1a.5.5 0 0 1 .5-.5h4V6a.5.5 0 0 1 .5-.5z" />
                                            </svg>

                                            Pin to your profile
                                        </li>

                                        <li data-post-id="<?php echo $post['post_id']; ?>"
                                            data-channel-id="<?php echo htmlspecialchars($post['channel_id'], ENT_QUOTES); ?>"
                                            data-posttype-id="<?php echo htmlspecialchars($post['posttype_id'], ENT_QUOTES); ?>"
                                            data-content="<?php echo htmlspecialchars($post['content'], ENT_QUOTES); ?>"
                                            data-media="<?php echo $post['media'] ? htmlspecialchars($post['media'], ENT_QUOTES) : ''; ?>"
                                            onclick="handleClickModalEdit(this)">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" height="24" width="24"
                                                fill="black">
                                                <path
                                                    d="M20.125 15 18 12.875l.725-.725q.275-.275.7-.275.425 0 .7.275l.725.725q.275.275.275.7 0 .425-.275.7ZM12 21v-2.125l5.3-5.3 2.125 2.125-5.3 5.3Zm-9-5v-2h7v2Zm0-4v-2h11v2Zm0-4V6h11v2Z" />
                                            </svg>
                                            Edit Post
                                        </li>





                                    </ul>
                                </span>

                            </h3>

                        </div>
                    </div>
                    <div class="post__content">
                        <p class="post__headerchannels">Channels :
                            <?php echo htmlspecialchars($post['channel_id']); ?>
                        </p>
                        <p class="post__headertopic">
                            <?php echo htmlspecialchars($post['posttype_id']) ?>
                        </p>
                        <p class="post__headerDescription">
                            <?php echo htmlspecialchars($post['content']); ?>
                        </p>

                    </div>
                    <?php if ($post['media'] !== ""): ?>
                        <img src="<?php echo htmlspecialchars($post['media']); ?>" alt="Post Media" />
                    <?php endif; ?>
                    <div class="post__footer">
                        <span class="material-icons"> repeat </span>
                        <span class="heartButton likeButton" style="cursor:pointer" data-post-type='post'
                            data-post-id="<?= $post['post_id']; ?>"><span class="likeCount">0</span> <svg class="heartIcon"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" enable-background="new 0 0 50 50">
                                <path
                                    d="M25 39.7l-.6-.5C11.5 28.7 8 25 8 19c0-5 4-9 9-9 4.1 0 6.4 2.3 8 4.1 1.6-1.8 3.9-4.1 8-4.1 5 0 9 4 9 9 0 6-3.5 9.7-16.4 20.2l-.6.5zM17 12c-3.9 0-7 3.1-7 7 0 5.1 3.2 8.5 15 18.1 11.8-9.6 15-13 15-18.1 0-3.9-3.1-7-7-7-3.5 0-5.4 2.1-6.9 3.8L25 17.1l-1.1-1.3C22.4 14.1 20.5 12 17 12z" />
                            </svg> </span>


                        <span class="material-icons"> publish </span>
                    </div>
                </div>
            </div>


            <div class="comment-wrapper">
                <form class="comment-box" action="commentD.php" method="post" id="commentForm">
                    <input type="hidden" name="postId" value="<?php echo $post['post_id']; ?>" />
                    <input type="text" name="commentContent" placeholder="Écrivez un commentaire…" class="input-comment">
                    <input id="gif-url" name="gif-url" type="text" style="display:none;" class="gif-url" />
                    <div id="image-preview-container-edit" style="position: relative;display:none;"
                        class="image-preview-container">
                        <span id="remove-image-btn-edit" class="remove-image-btn-cmnt">&times;</span>
                        <div id="progress-container-edit" style="position: relative;display:none;"
                            class="progress-container">

                            <img id="image-preview-edit" class="image-preview"
                                style="position: relative; top: 0; left: 0; width: 100%; height: 100%; object-fit: contain;" />
                            <svg id="svg-progress-bar-edit" class="svg-progress-bar" width="75" height="75"
                                viewbox="0 0 100 100"
                                style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                                <circle cx="50" cy="50" r="45" stroke="#eca9ae" stroke-width="5" fill="none" />
                                <circle id="progress-bar-edit" cx="50" cy="50" r="45" stroke="#c41318" stroke-width="5"
                                    stroke-dasharray="282.74" stroke-dashoffset="282.74" fill="none" />
                            </svg>
                        </div>
                    </div>
                    <div class="icons-comment">
                        <!-- Insert your icons here -->
                        <span class="option" onclick="toggleEmoteMenu(this,1)">😊
                            <div class="emote-container" style="display: none; left: 400px;"></div>
                        </span>
                        <span class="icon-comment">📷</span>
                        <span class="option" onclick="toggleGiphyMenu(this,1)">GIF
                            <div class="giphy-menu" style="display: none;left: 300px;">
                                <input type="text" class="giphy-search" placeholder="Search for GIFs"
                                    style="  width: 450px; border: raduis 100%;">
                            </div>
                        </span>
                    </div>
                    <svg id="sendIcon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="submit-comment">
                        <line x1="22" y1="2" x2="11" y2="13"></line>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                    </svg>
                </form>
            </div>
            <?php // Replace with your actual controller class
                $comments = $commentController->listCommentsById($post['post_id']); ?>
            <?php foreach ($comments as $comment) { ?>
                <?php $usercomment = $UserC->showuser($comment['created_by_user_id']); ?>
                <div class="comment-container" style="background-color:#FFFBFB;">
                    <div class="vertical-line"></div>
                    <div class="post" style="padding-bottom: 3px;margin-left: 20px;">
                        <div class="post__avatar">
                            <?php
                            // Split the path and the filename
                            $path_parts = explode('/', $usercomment['media']);
                            $filename = array_pop($path_parts); // Get the filename
                            $directory = implode('/', $path_parts); // Get the directory path
                    
                            // Combine them with rawurlencode applied only to the filename
                            $image_path = "../Login/" . $directory . '/' . rawurlencode($filename);
                            ?>
                            <img src="<?php echo $image_path; ?>" alt="" />
                        </div>

                        <div class="post__body">
                            <div class="post__header">
                                <div class="post__headerText">
                                    <h3 style="font-size: 15px;">
                                        <?php echo $usercomment['Nme'] ?>
                                        <?php echo $usercomment['Lname'] ?>
                                        <span class="post__headerSpecial"><span class="material-icons post__badge"> verified
                                            </span>@
                                            <?php echo $usercomment['Username'] ?>
                                        </span>
                                        <span class="post__date"
                                            data-creation-time="<?php echo (new DateTime($comment['datetime_creation']))->format('c'); ?>">
                                            <?php echo htmlspecialchars(timeElapsedString(new DateTime($comment['datetime_creation']))); ?>
                                        </span>
                                        <span class="dropdown-menu-post">
                                            <svg class="dropdown-menu-post__icon" width="24" height="24" viewBox="0 0 24 24"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="4" cy="12" r="2" fill="currentColor" />
                                                <circle cx="12" cy="12" r="2" fill="currentColor" />
                                                <circle cx="20" cy="12" r="2" fill="currentColor" />
                                            </svg>

                                        </span>
                                        <ul class="dropdown-menu-post__content">


                                            <li class="delete-option"
                                                onclick="confirmDeleteComment(<?php echo $comment['comment_id']; ?>);">

                                                <svg class="icon delete-icon" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" fill="rgba(244,33,46,5)" class="bi bi-trash"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M7 21q-.825 0-1.412-.587Q5 19.825 5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413Q17.825 21 17 21ZM17 6H7v13h10ZM9 17h2V8H9Zm4 0h2V8h-2ZM7 6v13Z" />
                                                </svg>
                                                Delete
                                            </li>

                                            <li data-comment-id="<?php echo $comment['comment_id']; ?>"
                                                data-content-comment="<?php echo htmlspecialchars($comment['comment_content'], ENT_QUOTES); ?>"
                                                onclick="handleClickModalEditcomment(this)">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" height="24" width="24"
                                                    fill="black">
                                                    <path
                                                        d="M20.125 15 18 12.875l.725-.725q.275-.275.7-.275.425 0 .7.275l.725.725q.275.275.275.7 0 .425-.275.7ZM12 21v-2.125l5.3-5.3 2.125 2.125-5.3 5.3Zm-9-5v-2h7v2Zm0-4v-2h11v2Zm0-4V6h11v2Z" />
                                                </svg>
                                                Edit Comment
                                            </li>





                                        </ul>

                                    </h3>

                                </div>
                                <div class="post__headerDescription" style="font-size: 14px;">
                                    <p>
                                        <?php echo htmlspecialchars($comment['comment_content']); ?>
                                    </p>
                                    <?php if ($comment['media'] !== ""): ?>
                                        <img style="width:250px" src="<?php echo htmlspecialchars($comment['media']); ?>"
                                            alt="Post Media" />
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="post__footer">
                                <span class="heartButton likeButton" style="cursor:pointer" data-post-type='comment'
                                    data-post-id="<?= $comment['comment_id']; ?>"><span class="likeCount">0</span> <svg
                                        class="heartIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50"
                                        enable-background="new 0 0 50 50">
                                        <path
                                            d="M25 39.7l-.6-.5C11.5 28.7 8 25 8 19c0-5 4-9 9-9 4.1 0 6.4 2.3 8 4.1 1.6-1.8 3.9-4.1 8-4.1 5 0 9 4 9 9 0 6-3.5 9.7-16.4 20.2l-.6.5zM17 12c-3.9 0-7 3.1-7 7 0 5.1 3.2 8.5 15 18.1 11.8-9.6 15-13 15-18.1 0-3.9-3.1-7-7-7-3.5 0-5.4 2.1-6.9 3.8L25 17.1l-1.1-1.3C22.4 14.1 20.5 12 17 12z" />
                                    </svg> </span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>


        <!-- widgets starts -->





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

        <script>
            const orderedOptions = ['General_Chat', 'Area_Chat', 'University_Chat', 'Class_Chat', 'Private_Chat'];
            function updatePostTimes() {
                var posts = document.querySelectorAll('.post__date');
                posts.forEach(function (post) {
                    var creationTime = new Date(post.getAttribute('data-creation-time'));
                    post.textContent = timeSince(creationTime);
                });
            }

            console.log(document.querySelectorAll('.submit-comment'));
            document.addEventListener('DOMContentLoaded', function () {
                // Select the SVG icon by its class
                document.querySelectorAll('.submit-comment').forEach(item => {
                    // Add a click event listener to each icon
                    item.addEventListener('click', function () {
                        // Find the closest form to the clicked icon and submit it
                        this.closest('form').submit();
                    });
                });
            });


            document.getElementById('EditFormControl').addEventListener('keypress', function (event) {
                if (event.key === 'Enter') {
                    event.preventDefault(); // Prevent form submission
                }
            });



            function timeSince(date) {
                var seconds = Math.floor((new Date() - date) / 1000);

                var interval = seconds / 31536000;

                if (interval > 1) {
                    return Math.floor(interval) + "Y";
                }
                interval = seconds / 2592000;
                if (interval > 1) {
                    return Math.floor(interval) + "Mon";
                }
                interval = seconds / 86400;
                if (interval > 1) {
                    return Math.floor(interval) + "Days";
                }
                interval = seconds / 3600;
                if (interval > 1) {
                    return Math.floor(interval) + "H";
                }
                interval = seconds / 60;
                if (interval > 1) {
                    return Math.floor(interval) + "Min";
                }
                return Math.floor(seconds) + " Sec";
            }

            setInterval(updatePostTimes, 60000); // Update every second
        </script>

</body>

</html>