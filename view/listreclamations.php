<?php
include "../controller/ReclamationC.php"; // Include ReclamationC class file

$reclamationC = new ReclamationC();
$reclamations = $reclamationC->listReclamations(); // Fetch list of reclamations

?>

<center>
    <h1>List of Reclamations</h1>
</center>
<table border="1" align="center" width="70%">
    <tr>
        <th>Ticket ID</th>
        <th>User Sender ID</th>
        <th>Description</th>
        <th>Delete</th>
        <th>Update(READ/NOTREAD)</th>
    </tr>

    <?php foreach ($reclamations as $reclamation) { ?>
        <tr>
            <td><?= $reclamation['Ticket_id']; ?></td>
            <td><?= $reclamation['user_sender_id']; ?></td>
            <td><?= $reclamation['description']; ?></td>
            <td>
                <a href="deleteReclamation.php?id=<?= $reclamation['Ticket_id']; ?>">Delete</a>
            </td>
        </tr>
    <?php } ?>
</table>