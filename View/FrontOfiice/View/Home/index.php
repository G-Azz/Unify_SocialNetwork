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
  <!-- sidebar ends -->

  <!-- feed starts -->
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

    <!-- tweetbox starts -->
    <form id="FormControl" action="postD.php" method="post" enctype="multipart/form-data">
      <div class="post-box">
        <div class="post-header">

          <img src="https://i.pinimg.com/originals/a6/58/32/a65832155622ac173337874f02b218fb.png" alt="Profile Icon" width="32" height="32">
          <div class="dropdown-container">
            <div>
              <p>Chat Channels :</p>
              <div class="dropdown">
                <div class="dropbtn" id="dropbtn">
                  <span class="plus-sign"><svg width="19" height="19" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M12 5V19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                      <path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
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

        <textarea name="postContent" rows="2" placeholder="What is happening?!" oninput="autoResizeTextarea(this); toggleButtonOpacity(this);"></textarea>

        <div id="image-preview-container" style="display: none;">
          <div id="progress-container" style="display: none; position: relative;">
            <img id="image-preview" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: contain;" />
            <svg id="svg-progress-bar" width="75" height="75" viewbox="0 0 100 100" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
              <circle cx="50" cy="50" r="45" stroke="#eca9ae" stroke-width="5" fill="none" />
              <circle id="progress-bar" cx="50" cy="50" r="45" stroke="#c41318" stroke-width="5" stroke-dasharray="282.74" stroke-dashoffset="282.74" fill="none" />
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
            <input id="file-upload" name="file-upload" type="file" style="display:none;" onchange="toggleUploadButton(this)" />



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
        <img src="https://www.focus2move.com/wp-content/uploads/2020/01/Tesla-Roadster-2020-1024-03.jpg" alt="" />
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
        <img src="https://www.focus2move.com/wp-content/uploads/2020/01/Tesla-Roadster-2020-1024-03.jpg" alt="" />
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

</body>

</html>