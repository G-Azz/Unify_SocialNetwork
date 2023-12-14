<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Add Event - Twitter Clone</title>
  <link rel="stylesheet" href="styles.css" />
  <link rel="stylesheet" href="brand.css" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
    crossorigin="anonymous" />
  <style>
    /* Additional styles specific to addevent.php */
    .event-info-container {
      margin: 20px;
      padding: 20px;
      background-color: rgba(255, 255, 255, 0.9);
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Adjustments to utilize the entire width */
    .feed {
      margin-left: 0;
    }
  </style>
  <script>
      document.addEventListener('DOMContentLoaded', function () {
          const form = document.querySelector('form');

          form.addEventListener('submit', function (event) {
              let isValid = true;

              // Validate event_name
              const eventName = document.getElementById('event_name');
              const eventNameError = document.getElementById('event_name_error');
              if (eventName.value.trim() === '') {
                  eventNameError.textContent = 'Please enter the event name';
                  eventNameError.style.color = 'red'; // Set the error message color
                  isValid = false;
              } else {
                  eventNameError.textContent = '';
              }

              // Validate event_date
              const eventDate = document.getElementById('event_date');
              const eventDateError = document.getElementById('event_date_error');
              if (eventDate.value === '') {
                  eventDateError.textContent = 'Please enter the event date';
                  eventDateError.style.color = 'red';
                  isValid = false;
              } else {
                  eventDateError.textContent = '';
              }

              // Validate event_time
              const eventTime = document.getElementById('event_time');
              const eventTimeError = document.getElementById('event_time_error');
              if (eventTime.value === '') {
                  eventTimeError.textContent = 'Please enter the event time';
                  eventTimeError.style.color = 'red';
                  isValid = false;
              } else {
                  eventTimeError.textContent = '';
              }

              // Validate event_location
              const eventLocation = document.getElementById('event_location');
              const eventLocationError = document.getElementById('event_location_error');
              if (eventLocation.value === '') {
                  eventLocationError.textContent = 'Please enter the event location';
                  eventLocationError.style.color = 'red';
                  isValid = false;
              } else {
                  eventLocationError.textContent = '';
              }

              // Validate event_image (file)
              const eventImage = document.querySelector('input[type="file"]');
              const eventImageError = document.getElementById('event_image_error');
              if (eventImage.value === '') {
                  eventImageError.textContent = 'Please choose an event poster image';
                  eventImageError.style.color = 'red';
                  isValid = false;
              } else {
                  eventImageError.textContent = '';
              }

              // Validate event_description
              const eventDescription = document.getElementById('event_description');
              const eventDescriptionError = document.getElementById('event_description_error');
              if (eventDescription.value.trim() === '') {
                  eventDescriptionError.textContent = 'Please enter the event description';
                  eventDescriptionError.style.color = 'red';
                  isValid = false;
              } else {
                  eventDescriptionError.textContent = '';
              }

              if (!isValid) {
                  event.preventDefault(); // Prevent the default form submission
              }
          });
      });
    </script>

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
    <div class="event-info-container">
      <!-- Add your event information form or content here -->
      <h1>Add Event</h1>
      <form action="/event_/model/process_event.php" method="post" novalidate>
    <!-- Your event form fields go here -->
    <label for="event_name">Event Name:</label>
    <input type="text" id="event_name" name="event_name" required>
    <span class="error-message" id="event_name_error"></span>

    <label for="event_date">Date:</label>
    <input type="date" id="event_date" name="event_date" required>
    <span class="error-message" id="event_date_error"></span>

    <label for="event_time">Time:</label>
    <input type="time" id="event_time" name="event_time" required>
    <span class="error-message" id="event_time_error"></span>

    <label for="event_location">Location:</label>
    <select id="event_location" name="event_location" required>
        <option value="Ariana">Ariana</option>
        <option value="Tunis">Tunis</option>
        <option value="Mahdia">Mahdia</option>
    </select>
    <span class="error-message" id="event_location_error"></span>

    <label for="event_image">Event Poster (Image):</label>
    <input type="file" name="event_image" accept="image/*" required><br><br>
    <span class="error-message" id="event_image_error"></span>

    <label for="event_description">Description:</label>
    <textarea id="event_description" name="event_description" rows="4" required></textarea>
    <span class="error-message" id="event_description_error"></span>

    <input type="submit" value="Add Event">
</form>

    </div>
  </div>

  <!-- Add a button to go back to event_management.html -->



</body>

</html>
