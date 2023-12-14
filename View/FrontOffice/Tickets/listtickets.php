<?php
include "../../../Controller/ticketreplyC.php";
include "../../../Controller/ticketC.php"; 
session_start();
$user_sender_id = $_SESSION['user_data'] ['Id_User'];
$ticketedit = new TicketED();
$perPage = 10; // Number of tickets per page

// Get the current page or set a default
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Get total number of tickets
$total_tickets = $ticketedit->countTicketsByUser($user_sender_id);
$total_pages = ceil($total_tickets / $perPage);

// Calculate the starting ticket for the current page
$start = ($current_page - 1) * $perPage;

// Fetch tickets for the current page
$tab = $ticketedit->listTicketsByUserWithPagination($user_sender_id, $start, $perPage); 

$ticketreplyedit = new TicketReplyED();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="ticketliststyle.css">
    <link rel="stylesheet" href="styles.css" />
  <link rel="stylesheet" href="brand.css" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Tickets</title>

    <style>
        * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  flex-direction: row;
  font-family: Arial, Helvetica, sans-serif;
}
    
        canvas {
            position: fixed;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: -1;
        }
        h1 {
            text-align: center;
            color: #9b1c31;
            margin-bottom: 20px;
            font-size: 32px;
            text-transform: uppercase;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            background-color: rgba(255, 255, 255, 0.9);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            transition: all 0.3s ease;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #e9e9e9;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        a {
            text-decoration: none;
            color: #9b1c31;
            transition: color 0.3s ease;
        }
        a:hover {
            color: #b63443;
        }
        .status {
            font-weight: bold;
        }
        .replied {
            color: #27ae60;
        }
        .not-replied{
            color: #c0392b;
        }
        .update {
            padding: 8px 16px;
            background-color: #9b1c31;
            border: none;
            color: white;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .update:hover {
            background-color: #b63443;
            transform: translateY(-2px);
        }
        .back-to-help {
            display: block;
            text-align: center;
            margin-bottom: 20px;
            color: #9b1c31;
            transition: color 0.3s ease;
        }
        .back-to-help:hover {
            color: #b63443;
        }
    </style>
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
      <h1>List of tickets</h1>
      <form action="post" class="search_bar">

        <input type="text" placeholder="Search In Unify " name="q">
        <button type="submit" class="search_btn">
          <img src="./SVG/search.svg" alt="Search">
        </button>

      </form>
      
    </div>
    <a class="back-to-help" href="index.html">Back To Help Center</a>
    
    
    <table class="ticket-table" border="1" align="center">
        <tr>
            <th>Ticket ID</th>
            <th>User ID</th>
            <th>Description</th>
            <th>Date</th>
            
            <th>Delete</th>
            <th>Update</th>
            <th>Response</th>
            <th>Status</th>
        </tr>
        <?php foreach ($tab as $tickets) { 
            $responses = $ticketreplyedit->getRepliesForTicket($tickets['ticket_id']);
            $statusClass = (!empty($responses)) ? 'replied' : 'not-replied';
        ?>
        <tr>
            <td style="border: 1px solid #ddd; border-radius: 8px; padding: 12px;"><?= $tickets['ticket_id']; ?></td>
            <td style="border: 1px solid #ddd; border-radius: 8px; padding: 12px;"><?= $tickets['user_sender_id']; ?></td>
            <td style="border: 1px solid #ddd; border-radius: 8px; padding: 12px;"><?= $tickets['descriptions']; ?></td>
            <td style="border: 1px solid #ddd; border-radius: 8px; padding: 12px;"><?= $tickets['created_datetime']; ?></td>
            
            <td style="border: 1px solid #ddd; border-radius: 8px; padding: 12px;">
                <a style="text-decoration: none; color: #9b1c31; transition: color 0.3s ease;" href="deleteticket.php?id=<?= $tickets['ticket_id']; ?>">Delete</a> 
            </td>
            <td style="border: 1px solid #ddd; border-radius: 8px; padding: 12px;">
                <form method="POST" action="updateticket.php">
                    <input class="update" type="submit" name="update" value="Update" style="border: none; border-radius: 4px; padding: 8px 16px; background-color: #9b1c31; color: white; cursor: pointer; transition: background-color 0.3s ease, transform 0.2s ease; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                    <input type="hidden" value="<?= $tickets['ticket_id']; ?>" name="ticket_id">
                </form>
            </td>
            <td style="border: 1px solid #ddd; border-radius: 8px; padding: 12px;">
                <a style="text-decoration: none; color: #9b1c31; transition: color 0.3s ease;" href="ticketresponses.php?id=<?= $tickets['ticket_id']; ?>">See response</a>
            </td>
            <td style="border: 1px solid #ddd; border-radius: 8px; padding: 12px;">
                <span style="font-weight: bold; color: <?= (!empty($responses)) ? '#27ae60' : '#c0392b'; ?>;"><?= (!empty($responses)) ? 'Replied' : 'Not Replied'; ?></span>
            </td>
        </tr>
        <?php } ?>
    </table>
    <!-- Pagination controls -->
<div class="pagination">
    <?php if ($current_page > 1) { ?>
        <a href="?page=<?= $current_page - 1; ?>">Previous</a>
    <?php } ?>

    <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
        <a href="?page=<?= $i; ?>" <?= ($i === $current_page) ? 'class="active"' : ''; ?>>
            <?= $i; ?>
        </a>
    <?php } ?>

    <?php if ($current_page < $total_pages) { ?>
        <a href="?page=<?= $current_page + 1; ?>">Next</a>
    <?php } ?>
</div>
        </div>
    <!-- <canvas id="particles"></canvas> -->
    <script>
        const canvas = document.getElementById('particles');
        const ctx = canvas.getContext('2d');

        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;

        const particles = [];
        const particleCount = 50;

        for (let i = 0; i < particleCount; i++) {
            particles.push({
                x: Math.random() * canvas.width,
                y: Math.random() * canvas.height,
                radius: Math.random() * 5 + 1,
                color: '#9b1c31',
                speedX: Math.random() * 3 - 1.5,
                speedY: Math.random() * 3 - 1.5
            });
        }

        function drawParticles() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            particles.forEach(particle => {
                ctx.beginPath();
                ctx.arc(particle.x, particle.y, particle.radius, 0, Math.PI * 2);
                ctx.fillStyle = particle.color;
                ctx.fill();

                particle.x += particle.speedX;
                particle.y += particle.speedY;

                if (particle.x < 0 || particle.x > canvas.width) {
                    particle.speedX *= -1;
                }
                if (particle.y < 0 || particle.y > canvas.height) {
                    particle.speedY *= -1;
                }
            });

            requestAnimationFrame(drawParticles);
        }

        window.addEventListener('resize', () => {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;

            // Recreate particles on window resize
            particles.length = 0;
            for (let i = 0; i < particleCount; i++) {
                particles.push({
                    x: Math.random() * canvas.width,
                    y: Math.random() * canvas.height,
                    radius: Math.random() * 5 + 1,
                    color: '#9b1c31',
                    speedX: Math.random() * 3 - 1.5,
                    speedY: Math.random() * 3 - 1.5
                });
            }
        });

        drawParticles();
    </script>
</body>
</html>

