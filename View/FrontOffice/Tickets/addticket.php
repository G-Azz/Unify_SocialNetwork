

<?php
include '../../../Controller/ticketC.php';
include '../../../Model/ticket.php';

session_start();

$error = "";
$ticketedit = new TicketED();


if (isset($_POST["descriptions"])) {
  // Existing code...
  $admin_id = 1;
  $opened = '0'; // Ensure $opened is a string

  $user_sender_id =$_SESSION['user_data'] ['Id_User']; // This is an example. Replace with actual user ID.
  $created_datetime = date('Y-m-d H:i:s'); // Current datetime

  $ticketType = $_POST['ticketType'];
  $descriptions = $_POST['descriptions'];
  $email = $_POST['email']; // Retrieve the email from the form
  $media = "empty"; // Handle file upload separately if needed

  $ticketTypeID = ($ticketType === 'feedback') ? 1 : 2;

  $ticket = new Ticket($user_sender_id, $admin_id, $descriptions, $media, $created_datetime, $ticketTypeID, $opened, $email);

  try {
      $ticketedit->addTicket($ticket);
      // Redirect or perform other success actions
      header('Location:addticket.php');
      exit();
  } catch (Exception $e) {
      $error = $e->getMessage();
  }
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
  <link rel="stylesheet" href="post.css"/>
  <link rel="stylesheet" href="faqstyle.css">

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
    crossorigin="anonymous" />

</head>

<body>

  <!-- sidebar starts -->
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
  
  <div class="feed">
    <div class="feed__header">
      <h1>Help</h1>
      <form action="post" class="search_bar">

        <input type="text" placeholder="Search In Unify " name="q">
        <button type="submit" class="search_btn">
          <img src="./SVG/search.svg" alt="Search">
        </button>

      </form>
      
    </div>
    
    <a class="back-to-list" href="listtickets.php">View your tickets </a>
    <a class="back-to-help" href="index.html">Back To Help Center </a>
    

    <div id="error">
        <?php echo $error; ?>
    </div>
    
<!-- ... previous HTML code ... -->

<div class="form-wrapper">
    <form action="" method="POST" onsubmit="return validateForm(event)">
        <div class="input-wrapper">
            <label for="email" class="label-reclamation">Email Address:</label>
            <input type="email" id="email" name="email" class="reclamation-input"  />
        </div>
      
        <div class="input-wrapper">
            <label for="descriptions" class="label-reclamation">Reclamation:</label>
            <input type="text" id="descriptions" name="descriptions" />
            <span id="charCount" style="color: red"></span>
        </div>
    

        <div class="tickettype-wrapper">
            <label for="ticketType" class="label-tickettype">Ticket Type:</label>
            <select class="tickettype" id="ticketType" name="ticketType">
                <option value="feedback">Feedback</option>
                <option value="report">Report</option>
            </select>
        </div>

        <div class="buttons-wrapper">
            <input type="submit" value="Save">
            <input type="reset" value="Reset">
        </div>
    </form>
</div>


</div>

<script>
    function validateDescription(event) {
    const description = document.getElementById('descriptions').value.trim(); // Trim whitespace
    const maxLength = 100;
    const charCount = document.getElementById('charCount');

    if (description === '') {
        charCount.innerText = 'Please provide a description.';
        event.preventDefault(); // Prevent form submission
        return false;
    }

    if (description.length > maxLength) {
        charCount.innerText = 'Ticket description should not exceed 100 characters.';
        event.preventDefault(); // Prevent form submission
        return false;
    }

    return true; // Allow form submission
}
</script>

    
</body>

</html>









