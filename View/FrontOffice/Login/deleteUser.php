<?php 
    include '../../../Controller/UserC.php';
    $UserC=new UserC();
    $UserC->deleteUser($_GET['id']);
    header('Location: /ss/View/BackOffice/template/pages/tables/basic-table.php');





?>