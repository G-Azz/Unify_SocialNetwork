<?php
    include("../../Controller/UserC.php");
    $UserC=new UserC();
    $UserC->listUser();
    $list=$UserC->listUser();

?>
<html>
<body>
    <h1>User</h1>
    <h2>
        <a href="index.php" >Add user</a>
    </h2>

<table border="1" align="center" width="70%">
    <tr>
        <th>Id user</th>
        <th>Name</th>
        <th>Lname</th>
        <th>Email</th>
        <th>Username</th>
        <th>Adress</th>
        <th>University</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>
    <?php
        foreach($list as $j){
    ?>

   

        


        <tr>
            <td><?php echo $j['Id_User'] ?></td>
            <td><?php echo $j['Nme'] ?></td>
            <td><?php echo $j['Lname'] ?></td>
            <td><?php echo $j['Email'] ?></td>
            <td><?php echo $j['Username'] ?></td>
            <td><?php echo $j['Adress'] ?></td>
            <td><?php echo $j['University'] ?></td>

            <td>
                
            </td>
            <td>
                <a href = "deleteUser.php?id=<?php echo $j['Id_User']?>">delete</a>
            </td>
        </tr>
    <?php
        }
    ?>
   
</table></body>
</html>