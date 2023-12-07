<?php
include "../Controller/ticketreplyC.php";
include "../controller/ticketC.php"; 
$user_sender_id = 3;
$ticketedit = new TicketED();
$tab = $ticketedit->listTicketsByUser($user_sender_id); 
$ticketreplyedit = new TicketReplyED();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="ticketliststyle.css">
    <link rel="stylesheet" href="faqstyle.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Tickets</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            overflow: auto;
            position: relative;
            background-color: #f8f8f8;
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
        .solved {
            color: #27ae60;
        }
        .not-solved {
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
    <canvas id="particles"></canvas>
    <a class="back-to-help" href="index.html">Back To Help Center</a>
    <h1>List of tickets</h1>
    <table class="ticket-table" border="1" align="center">
        <tr>
            <th>Ticket ID</th>
            <th>User ID</th>
            <th>Description</th>
            <th>Date</th>
            <th>Type</th>
            <th>Delete</th>
            <th>Update</th>
            <th>Response</th>
            <th>Status</th>
        </tr>
        <?php foreach ($tab as $tickets) { 
            $responses = $ticketreplyedit->getRepliesForTicket($tickets['ticket_id']);
            $statusClass = (!empty($responses)) ? 'solved' : 'not-solved';
        ?>
        <tr>
            <td style="border: 1px solid #ddd; border-radius: 8px; padding: 12px;"><?= $tickets['ticket_id']; ?></td>
            <td style="border: 1px solid #ddd; border-radius: 8px; padding: 12px;"><?= $tickets['user_sender_id']; ?></td>
            <td style="border: 1px solid #ddd; border-radius: 8px; padding: 12px;"><?= $tickets['descriptions']; ?></td>
            <td style="border: 1px solid #ddd; border-radius: 8px; padding: 12px;"><?= $tickets['created_datetime']; ?></td>
            <td style="border: 1px solid #ddd; border-radius: 8px; padding: 12px;"><?= $tickets['ticket_typeid']; ?></td>
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
                <span style="font-weight: bold; color: <?= (!empty($responses)) ? '#27ae60' : '#c0392b'; ?>;"><?= (!empty($responses)) ? 'Solved' : 'Not Solved'; ?></span>
            </td>
        </tr>
        <?php } ?>
    </table>
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

