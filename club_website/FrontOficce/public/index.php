<?php 
include "../Back/Controller/ClubC.php";
include "../Back/Controller/typeclubC.php";

$c = new ClubC();
$tab = $c->listClub();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> CLUB WEBSITE </title>
        <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <!---lINK TO CSS -->
        <link rel="stylesheet" href="style.css">
        <!--box icons-->
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
        <link rel="icon" type="image/png" href="./favicon-16x16.png"/>
 
         
     </head>
     <body>
        <!--header-->
        <header>
            <!--nav-->
            <div href="#"class="logo">
                <img src="unify.png" alt="" class="unifylogo">UNIFY - CLUB Website</div>
                
            <!--cart-icon-->
            
        </header>
        
           <section class="head"><h2 class="section-title">List of unify Club</h2></section>
           <!--About club -->
           <section id="page" class="about-product" ></section>
        <!--shop-->
        <section class="shop contrainer" id="home">
            <!--content-->
            <div class="shop-content">
                <!--box 1-->


                <?php
                foreach($tab as $key=>$value) {
                  ?>
             
                
                <div class="product-box" id="p-1"  onclick='loadHtml("page","product1.php","p-1","<?php echo $value["name"]; ?>")'>
                    <img  src="../../BackOffice/view/pages/evenement/uploads/<?php echo $value["image"] ?>" class="club-img"  >
                    <h2 class="product-title"><?php echo $value["name"] ?></h2>
                    <div class="rating">
                     <img src="star.svg" alt="" srcset="" class="star--taille" />
                       <span class="clubrating">4.0</span>
                     </div>
                    <h3><?php echo $value["name"] ?></h3>
                    <p><?php echo $value["type"] ?></p>
                    <p><?php echo $value["description"] ?></p>
                    
                    
                    </div>
                  <?php    } ?>
            </div>
            
        </section>
        
        <!-- custom js file link  -->
        <script src="main.js" defer></script>
     </body>
</html>  