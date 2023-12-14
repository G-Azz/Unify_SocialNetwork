<?php
include '../../../Controller/TicketC.php'; // Assuming you have a Ticket Controller
include '../../../Model/Ticket.php'; // Assuming you have a Ticket Model
$error = "";
session_start();
$user_id = $_SESSION['user_data'] ['Id_User'];

$ticketedit = new TicketED(); // Instantiate the Ticket Controller

if (isset($_POST["descriptions"]) && isset($_POST["ticket_id"])) {
    if (!empty($_POST['descriptions']) && !empty($_POST["ticket_id"])) {
        $ticket_id = $_POST['ticket_id']; // Retrieve ticket_id from the form
        $descriptions = $_POST['descriptions'];

        // Retrieve existing ticket details based on the ID
        $existing_ticket = $ticketedit->showTicket($ticket_id);

        // Create a Ticket instance with updated descriptions and existing details
        $ticket = new Ticket(
            $existing_ticket['user_sender_id'], // Assuming this value exists in the fetched ticket details
            $existing_ticket['admin_id'], // Assuming this value exists in the fetched ticket details
            $descriptions,
            $existing_ticket['media'], // Assuming this value exists in the fetched ticket details
            $existing_ticket['created_datetime'], // Assuming this value exists in the fetched ticket details
            $existing_ticket['ticket_typeid'], // Assuming this value exists in the fetched ticket details
            $existing_ticket['opened'],
            $existing_ticket ['email']

             // Assuming this value exists in the fetched ticket details
            
        );

        try {
            // Call the updateTicket method in your Ticket Controller
            $ticketedit->updateTicket($ticket, $ticket_id);
            header('Location:listtickets.php'); // Redirect to the ticket list page after update
            exit();
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    } else {
        $error = "Missing information";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="faqstyle.css">
    <link rel="stylesheet" href="brand.css" />
    <link rel="stylesheet" href="updateticketanimation.css" />

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Reclamation</title>

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
    
    <div class="feed__header">
      <h1>Edit your ticket!</h1>
      
      <form action="post" class="search_bar">

        <input type="text" placeholder="Search In Unify " name="q">
        <button type="submit" class="search_btn">
          <img src="./SVG/search.svg" alt="Search">
        </button>

      </form>
      
    </div>
    

    <div class="container ticket-box">
    <a class="back-to-list" href="listtickets.php">Back To Sent Tickets</a>
    <a class="back-to-help" href="index.html">Back To Help Center</a>
        <div id="error">
            <?php echo $error; ?>
        </div>

        <?php
        if (isset($_POST['ticket_id'])) {
            // Retrieve ticket data based on the ID
            $ticket = $ticketedit->showTicket($_POST['ticket_id']);
        ?>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="ticket_id">Ticket ID:<span></span></label>
                    <input type="text" id="ticket_id" name="ticket_id" value="<?php echo $_POST['ticket_id'] ?>" readonly />
                    <span id="errorTicketId"></span>
                </div>

                <div class="form-group">
                    <label for="descriptions">Description:<span></span></label>
                    <input type="text" id="descriptions" name="descriptions" value="<?php echo $ticket['descriptions'] ?>" />
                    <span id="errorDescriptions"></span>
                </div>

                <div class="form-group">
                    <input type="submit" value="Save">
                    <input type="reset" value="Reset">
                </div>
            </form>
        <?php
        }
        ?>
    </div>
</body>

</html>
