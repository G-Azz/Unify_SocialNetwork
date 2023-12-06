<?php
// Assuming you have a Controller class that can fetch posts
require_once '../../../Controller/postED.php';
require_once '../../../Controller/functions.php';
$postController = new PostED(); // Replace with your actual controller class
$posts = $postController->listPosts(); // Replace with the actual method to fetch posts
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
    <link rel="stylesheet" href="comment.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" />

</head>

<body>
    <!--Modal Delete -->
    <div id="deleteConfirmationModal" class="modal">
        <div class="modal-content">
            <h2>Delete post?</h2>
            <p>This can’t be undone and it will be removed from your profile, the timeline of any accounts that follow
                you, and from search results.</p>
            <form id="deleteForm" method="post" action="postDD.php" onsubmit="return true">
                <input type="hidden" name="postId" id="postId_delete">
                <button type="submit" class="delete-btn">Delete</button>
                <button type="button" onclick="closeModal()" class="cancel-btn">Cancel</button>
            </form>
        </div>
    </div>
    <div id="deleteConfirmationModal" class="modal">
        <div class="modal-content">
            <h2>Delete post?</h2>
            <p>This can’t be undone and it will be removed from your profile, the timeline of any accounts that follow
                you, and from search results.</p>
            <form id="deleteForm" method="post" action="postDD.php" onsubmit="return confirmDelete();">
                <input type="hidden" name="postId" value="<?php echo $lastInsertId; ?>">
                <button type="submit" class="delete-btn">Delete</button>
                <button type="button" onclick="closeModal()" class="cancel-btn">Cancel</button>
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
                        <img src="https://i.pinimg.com/originals/a6/58/32/a65832155622ac173337874f02b218fb.png"
                            alt="Profile Icon" width="32" height="32">
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

                    <!-- Textarea for Post Content -->
                    <textarea name="editPostContent" rows="2" placeholder="Edit your post..." id="content-edit"
                        oninput="autoResizeTextarea(this); "></textarea>

                    <!-- Image Preview Container-->

                    <div id="image-preview-container-edit" style="position: relative;display:none;">
                        <span id="remove-image-btn-edit">&times;</span>
                        <div id="progress-container-edit" style="position: relative;display:none;">

                            <img id="image-preview-edit"
                                style="position: relative; top: 0; left: 0; width: 100%; height: 100%; object-fit: contain;" />
                            <svg id="svg-progress-bar-edit" width="75" height="75" viewbox="0 0 100 100"
                                style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                                <circle cx="50" cy="50" r="45" stroke="#eca9ae" stroke-width="5" fill="none" />
                                <circle id="progress-bar-edit" cx="50" cy="50" r="45" stroke="#c41318" stroke-width="5"
                                    stroke-dasharray="282.74" stroke-dashoffset="282.74" fill="none" />
                            </svg>
                        </div>
                    </div>


                    <!-- Post Footer -->
                    <div class="post-footer">
                        <div class="options">
                            <!-- Options here can be inputs as well, depending on what they do -->
                            <span class="option">GIF</span>
                            <label for="file-upload-edit" class="option">
                                📷
                            </label>
                            <input id="file-upload-edit" name="file-upload-edit" type="file" style="display:none;" />
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

                    <img src="https://i.pinimg.com/originals/a6/58/32/a65832155622ac173337874f02b218fb.png"
                        alt="Profile Icon" width="32" height="32">
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

                <div id="image-preview-container" style="position: relative; display: none;">
                    <span id="remove-image-btn">&times;</span>
                    <div id="progress-container" style="display: none; position: relative;">
                        <img id="image-preview"
                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: contain;" />
                        <svg id="svg-progress-bar" width="75" height="75" viewbox="0 0 100 100"
                            style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                            <circle cx="50" cy="50" r="45" stroke="#eca9ae" stroke-width="5" fill="none" />
                            <circle id="progress-bar" cx="50" cy="50" r="45" stroke="#c41318" stroke-width="5"
                                stroke-dasharray="282.74" stroke-dashoffset="282.74" fill="none" />
                        </svg>
                    </div>
                </div>

                <div class="post-footer">
                    <div class="options">
                        <!-- Options here can be inputs as well, depending on what they do -->
                        <span class="option">GIF</span>
                        <label for="file-upload" class="option">
                            📷
                        </label>
                        <input id="file-upload" name="file-upload" type="file" style="display:none;"
                            onchange="toggleUploadButton(this)" />



                        <span class="option">📍</span>
                        <span class="option">🔒</span>
                    </div>
                    <button type="submit" id="postButton" style="opacity: 0.5;" disabled>Post</button>
                </div>
            </div>
        </form>
        <!-- tweetbox ends -->
        <!-- post starts -->
        <?php foreach ($posts as $post) { ?>
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
                                    </span>@somanathg
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
                                        <?php echo $post['post_id']; ?>
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
                                        <script>
                                            var cnt = <?php echo json_encode($post['content']); ?>;
                                            var Medi = <?php echo json_encode($post['media']); ?>;
                                            var chaid = <?php echo json_encode(explode(',', htmlspecialchars($post['channel_id']))); ?>;
                                        </script>

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
                        <span class="material-icons"> favorite_border </span>
                        <span class="material-icons"> publish </span>
                    </div>
                </div>
            </div>
            <div class="comment-section">
    <!-- Comment input area -->
    <div class="reply-input container">
      <img src="images/avatars/image-juliusomo.webp" alt="" class="usr-img">
      <textarea class="cmnt-input" placeholder="Add a comment..."></textarea>
      <button class="bu-primary">SEND</button>
    </div> <!--reply input-->
  </div> <!--comment sectio-->
  

    <!-- Example Comment -->
   

        <?php } ?>
      

        <!-- widgets starts -->






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