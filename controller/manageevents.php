<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Manage Events - Twitter Clone</title>
  <link rel="stylesheet" href="styles.css" />
  <link rel="stylesheet" href="brand.css" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
    crossorigin="anonymous" />
  <style>
    /* Additional styles specific to manageevents.php */
    .event-table-container {
      margin: 20px;
      padding: 20px;
      background-color: rgba(255, 255, 255, 0.9);
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }

    .action-links {
      display: flex;
      gap: 10px;
    }

    .delete-link, .update-link {
      color: #721524;
      cursor: pointer;
    }

    .delete-link:hover, .update-link:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>

  <!-- sidebar starts -->
  <div class="sidebar">
    <img src="/event_/view/SVG/unifylogo.svg" class="logo" />
    <!-- Sidebar options excluding the three buttons -->
    <div class="sidebarOption active">
      <img class="menu__items__icons" src="/event_/view/SVG/home.svg" />
      <h2>Home</h2>
    </div>



    <div class="sidebarOption">
      <img class="menu__items__icons" src="/event_/view/SVG/profile.svg" />
      <h2>Profile</h2>
    </div>



    <div class="sidebarOption">
      <img class="menu__items__icons" src="/event_/view/SVG/event.svg" />
      <h2>Event</h2>
    </div>

    <!-- Remaining Sidebar Options -->

  </div>
  <!-- sidebar ends -->

  <!-- feed starts -->
  <div class="feed">
    <div class="event-table-container">
      <h1>Manage Events</h1>
      <!-- Display a table of events -->
      <table>
         <thead>
           <tr>
             <th>ID</th>
             <th>Event Name</th>
             <th>Date</th>
             <th>Time</th>
             <th>Location</th>
             <th>Description</th>
             <th>Action</th>
           </tr>
         </thead>
         <tbody>
           <?php
           // Fetch events from the database and populate the table
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
               while ($row = $result->fetch_assoc()) {
                   echo "<tr>";
                   echo "<td>" . $row['event_id'] . "</td>";
                   echo "<td class='data-view'>" . $row['event_name'] . "</td>";
                   echo "<td class='data-view'>" . $row['event_date'] . "</td>";
                   echo "<td class='data-view'>" . $row['event_time'] . "</td>";
                   echo "<td class='data-view'>" . $row['event_location'] . "</td>";
                   echo "<td class='data-view'>" . $row['event_description'] . "</td>";
                   echo "<td class='action-links'>";
                   echo "<a class='delete-link' data-event-id='" . $row['event_id'] . "'>Delete</a>";
                   echo "<a class='update-link' data-event-id='" . $row['event_id'] . "'>Update</a>";
                   echo "</td>";
                   echo "</tr>";
                   // Edit form (hidden by default)
                   echo "<tr class='edit-form' style='display: none;'>";
                   echo "<td></td>"; // Empty cell for ID
                   echo "<td><input class='edit-event-name' type='text' value='" . $row['event_name'] . "'></td>";
                   echo "<td><input class='edit-event-date' type='text' value='" . $row['event_date'] . "'></td>";
                   echo "<td><input class='edit-event-time' type='text' value='" . $row['event_time'] . "'></td>";
                   echo "<td><input class='edit-event-location' type='text' value='" . $row['event_location'] . "'></td>";
                   echo "<td><input class='edit-event-description' type='text' value='" . $row['event_description'] . "'></td>";
                   echo "<td class='action-links'>";
                   echo "<a class='save-link' data-event-id='" . $row['event_id'] . "'>Save</a>";
                   echo "</td>";
                   echo "</tr>";
               }
           } else {
               echo "<tr><td colspan='7'>No events found</td></tr>";
           }

           $conn->close();
           ?>
         </tbody>
       </table>
     </div>
   </div>
   <!-- feed ends -->

   <!-- ... (Your existing HTML code) ... -->

   <!-- ... (Your existing HTML code) ... -->
   <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

   <!-- Add a button to go back to event_management.html -->
   <button class="goback-btn" onclick="goBack()">Back
   to
 main</button>

   <script>
       function goBack() {
           window.location.href = 'event_management.html';
       }
   </script>

   <style>
       /* Style for the "Go Back" button */
       .goback-btn {
           display: block;
           margin: 10px auto;
           padding: 5px 10px;
           font-size: 14px;
           background-color: #4CAF50;
           color: white;
           border: none;
           border-radius: 4px;
           cursor: pointer;
       }
   </style>
   <script>

       // Update action
       // JavaScript to handle delete and update actions
$(document).ready(function () {
  // Delete action
  $('.delete-link').click(function () {
    var row = $(this).closest('tr');
    var eventId = $(this).data('event-id');

    // Perform the delete using AJAX
    $.ajax({
      type: 'POST',
      url: 'delete_event.php',
      data: { event_id: eventId },
      success: function (response) {
        // Update the table if deletion is successful
        alert("Event deleted successfully!");
        location.reload(); // Reload the page to reflect changes
      },
      error: function (error) {
        alert("Error deleting event: " + error);
      }
    });
  });

  // Other code for update and save actions (if applicable)


       $('.update-link').click(function () {
         var row = $(this).closest('tr');
         console.log('Update link clicked:', row);

         // Log additional information
         console.log('data-view elements:', row.find('.data-view'));
         console.log('edit-form elements:', row.next('.edit-form')); // Use .next() to get the next sibling with class 'edit-form'
         console.log('Input fields:', row.next('.edit-form').find('.edit-event-name, .edit-event-date, .edit-event-time, .edit-event-location, .edit-event-description'));

         // Toggle between displaying data and edit form
         row.find('.data-view').each(function () {
           $(this).toggle();
         });

         row.next('.edit-form').each(function () {
           $(this).toggle();
         });

         // Enable input fields in the edit form
         // Enable input fields in the edit form
 row.next('.edit-form').find('.edit-event-name, .edit-event-date, .edit-event-time, .edit-event-location, .edit-event-description').prop('readonly', false);

       });

       // Save changes action
       // Save changes action
       // Save changes action
       $('.save-link').click(function () {
         var row = $(this).closest('tr');
         var eventId = row.data('event-id');
         var updatedData = {
           event_id: eventId,  // Add the event_id to the data
           event_name: row.next('.edit-form').find('.edit-event-name').val(),
           event_date: row.next('.edit-form').find('.edit-event-date').val(),
           event_time: row.next('.edit-form').find('.edit-event-time').val(),
           event_location: row.next('.edit-form').find('.edit-event-location').val(),
           event_description: row.next('.edit-form').find('.edit-event-description').val()
         };

         // Log data for debugging
         console.log('Data to be sent:', updatedData);

         // Perform the update using AJAX
         $.ajax({
           type: 'POST',
           url: 'update_event.php',
           data: updatedData,  // Send the data directly without destructuring
           success: function (response) {
             // Update the table if update is successful
             alert("Event updated successfully!");
             location.reload(); // Reload the page to reflect changes
           },
           error: function (error) {
             alert("Error updating event: " + error);
           }
         });
       });
});

   </script>






</body>

</html>
