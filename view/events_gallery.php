<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Twitter Clone - Final</title>
  <link rel="stylesheet" href="styles.css" />
  <link rel="stylesheet" href="brand.css" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
    crossorigin="anonymous" />
  <style>
    /* Add your custom styles here */
    .event-container {
      border: 1px solid #ddd;
      padding: 10px;
      margin-bottom: 20px;
      position: relative;
    }

    .event-container img {
      max-width: 100%;
      height: auto;
    }

    .even {
      background-color: #f9f9f9; /* Light gray */
    }

    .odd {
      background-color: #e1e1e1; /* Lighter gray */
    }

    /* Styles for the comment form */
    .comment-form {
      margin-top: 10px;
    }

    .comment-form textarea {
      width: 100%;
      margin-bottom: 10px;
    }
  </style>
</head>

<body>
  <!-- sidebar starts -->
  <div class="sidebar">
  <img src="./SVG/unifylogo.svg" class="logo" />

  <div class="sidebarOption active">
    <img class="menu__items__icons" src="./SVG/home.svg" />
    <h2>Home</h2>
  </div>

  <div class="sidebarOption">
    <img class="menu__items__icons" src="./SVG/discussions.svg" />
    <h2>Discussions</h2>
  </div>

  <div class="sidebarOption">
    <img class="menu__items__icons" src="./SVG/profile.svg" />
    <h2>Profile</h2>
  </div>


  <div class="sidebarOption">
    <img class="menu__items__icons" src="./SVG/clubs.svg" />
    <h2>Find clubs</h2>
  </div>

  <div class="sidebarOption">
    <img class="menu__items__icons" src="./SVG/carpooling.svg" />
    <h2>Carpooling</h2>
  </div>
  <div class="sidebarOption">
        <img class="menu__items__icons" src="./SVG/event.svg" />
        <h2>Event</h2>
      </div>



  <!-- Remaining Sidebar Options -->

  <ul class="tree">
    <li>
      <details>
        <summary>
          <div class="sidebarOption" id="study" tabindex="0" name="study">
            <img class="menu__items__icons" src="./SVG/study.svg" />
            <h2>Study with</h2>
          </div>
        </summary>
        <ul>
          <div class="lefty">
            <li>
              <div class="sidebarOption">
                <img class="menu__items__icons" src="./SVG/tutor.svg" />
                <h4>Tutor</h4>
              </div>
            </li>
            <li>
              <div class="sidebarOption">
                <img class="menu__items__icons" src="./SVG/group.svg" />
                <h4>Group</h4>
              </div>
            </li>
          </div>
        </ul>
      </details>
    </li>
  </ul>

  <div class="sidebarOption">
    <img class="menu__items__icons" src="./SVG/courses.svg" />
    <h2>Courses</h2>
  </div>

  <div class="sidebarOption">
    <img class="menu__items__icons" src="./SVG/help.svg" />
    <h2>Help</h2>
  </div>

  <button class="sidebar__tweet">Discuss</button>
</div>
  <!-- ... (Your existing sidebar code) ... -->

  <!-- feed starts -->
  <div class="feed">
    <?php
    // Fetch events from the database and populate the page
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "event_management";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM event";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      $counter = 0;
      while ($row = $result->fetch_assoc()) {
        $class = ($counter % 2 == 0) ? 'even' : 'odd';

        // Display event information and poster in separate containers
        echo "<div class='event-container $class'>";
        echo "<h2>{$row['event_name']}</h2>";
        echo "<p>Date: {$row['event_date']}</p>";
        echo "<p>Time: {$row['event_time']}</p>";
        echo "<p>Location: {$row['event_location']}</p>";
        echo "<p>Description: {$row['event_description']}</p>";
        echo "<img src='{$row['event_poster']}' alt='{$row['event_name']} Poster'>";

        // Comment and Rating Form
        echo "<div class='comment-form'>";
        echo "<form action='/event_/model/submit_comment.php' method='post'>";
        echo "<textarea name='comment' placeholder='Your comment'></textarea><br>";
        echo "Rating: <input type='number' name='rating' min='1' max='5'><br>";
        echo "<input type='hidden' name='event_id' value='{$row['event_id']}'>";
        echo "<input type='submit' value='Submit'>";
        echo "</form>";
        echo "</div>";

            // Display existing comments and ratings
            echo "<div class='comments-ratings'>";
            $eventId = $row['event_id'];
            $commentSql = "SELECT * FROM comments WHERE event_id = '$eventId'";
            $commentResult = $conn->query($commentSql);

            if ($commentResult->num_rows > 0) {
                while ($commentRow = $commentResult->fetch_assoc()) {
                    echo "<p>Comment: {$commentRow['comment']}</p>";
                    echo "<p>Rating: {$commentRow['rating']}</p>";
                }
            } else {
                echo "<p>No comments yet</p>";
            }

            echo "</div>";
        echo "</div>";

        $counter++;
      }
    } else {
      echo "<p>No events found</p>";
    }

    $conn->close();
    ?>
    <button onclick="goBack()">Go Back</button>

    <script>
        function goBack() {
            window.location.href = '/event_/view/index.html';
        }
    </script>
  </div>
  <!-- feed ends -->

  <!-- widgets starts -->
  <!-- ... (Your existing widgets content) ... -->
  <!-- widgets ends -->
</body>

</html>
