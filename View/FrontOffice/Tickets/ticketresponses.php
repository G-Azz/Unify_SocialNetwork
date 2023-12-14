<?php
include "../../../controller/ticketreplyC.php"; 
session_start();
$user_id = $_SESSION['user_data'] ['Id_User'];

if (isset($_GET['id'])) {
    $ticket_id = $_GET['id']; // Get the ticket ID from the URL parameter
    $ticketreplyedit = new TicketReplyED();
    $responses = $ticketreplyedit->getRepliesForTicket($ticket_id);
    $ticket = $ticketreplyedit->getTicketDetails($ticket_id); // Replace this with your method to fetch ticket details


    

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ticket Responses</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="brand.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
    <link href="ticketresponses.css" rel="stylesheet">
  
</head>
<body>
<div class="sidebar">
    <img src="./SVG/unifylogo.svg" class="logo" />
    <div class="sidebarOption ">
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

    <div class="sidebarOption active">
      <img class="menu__items__icons  " src="./SVG/help.svg" />
      <h2>Help Center</h2>
    </div>

    <button class="sidebar__tweet">Discuss</button>
    
  </div>
  <!-- sidebar ends -->
    
    <div class="feed">
    <a class="back-to-help" href="index.html">Back To Help Center</a>
    <a class="back-to-list" href="listtickets.php">View your tickets</a>


      
    
    <div class="feed__header">
      
      <h1>Answers</h1>
      <form action="post" class="search_bar">

        <input type="text" placeholder="Search In Unify " name="q">
        <button type="submit" class="search_btn">
          <img src="./SVG/search.svg" alt="Search">
        </button>

      </form>
      
    </div>
    
    <div class="container">
    
        <h1>Ticket Responses for ID: <?php echo $ticket_id; ?></h1>
        <?php if (!empty($ticket)) { ?>
            <p><strong>Ticket Description:</strong> <?php echo $ticket['descriptions']; ?></p>
        <?php } else { ?>
            <p>No ticket description found.</p>
        <?php } ?>
        <?php if (!empty($responses)) { ?>
            <ul>
                <?php foreach ($responses as $response) { ?>
                    <li><?php echo $response['description_reply']; ?></li>
                <?php } ?>
            </ul>
        <?php } else { ?>
            <p>No responses found for this ticket.</p>
        <?php } ?>
        
    </div>
</body>
</html>


