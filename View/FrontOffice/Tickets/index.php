<?php
include("../../../Controller/UserC.php");
include("../../../Model/User.php");
session_start();
$error = '';
$User = isset($_SESSION['user_data']) ? $_SESSION['user_data'] : null;
$UserC = new UserC();


function validateInput($input)
{
    return filter_var($input, FILTER_VALIDATE_INT, array("options" => array("min_range" => 1)));
}


$User = $UserC->showuser($_SESSION['user_data']['Id_User']);


if (isset($_POST['submit']) && isset($_SESSION['id']) && $User) {
    // Form is submitted, update the user
    $UserC->updateuser($User, $_SESSION['id']);
    // Redirect or perform any other actions after updating the user
    header("Location: updateUser.php");
    exit();
}?>

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
        <div class="sidebarOption active"onclick="redirectToHomePage()" >
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

      <div class="sidebarOption" onclick="redirectToUpdatePage()">
            <img class="menu__items__icons" src="./SVG/profile.svg" />
            <h2>Profile</h2>
        </div>

        <script>
            function redirectToUpdatePage() {
                // Use the local server URL
                window.location.href = 'http://localhost/Unify_SocialNetwork/View/FrontOffice/Home/profile.php';
            }
            function redirectToHelpPage() {
                // Use the local server URL
                window.location.href = 'http://localhost/Unify_SocialNetwork/View/FrontOffice/Tickets/index.php';
            }
            function redirectToHomePage() {
                // Use the local server URL
                window.location.href = 'http://localhost/Unify_SocialNetwork/View/FrontOffice/Home/listpost.php';
            }
        </script>
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

       <div class="sidebarOption" onclick="redirectToHelpPage()">
            <img class="menu__items__icons  "  src="./SVG/help.svg" />
            <h2>Help</h2>
        </div>

        <button class="sidebar__tweet">Discuss</button>
    </div>
  <!-- sidebar ends -->

  <!-- feed starts -->
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
    <div class="aboutus">
    <h2 class="title"> About Us : </h2>
      <p>Unify est une plateforme en ligne conçue pour connecter plusieurs universités <br>
        au moyen d'une base de données centralisée. Les utilisateurs peuvent partager,<br> discuter,
         s'instruire, s'informer et établir des liens
        avec d'autres étudiants<br> et enseignants de manière efficace et organisée.<br></p>
      </div> 
    
    <h2 class ="title"> Frequently Asked Questions:</h2>
    <section>
      

  <div class="page1">
      
  


      <div class="faq">
          <div class="question">
                 <h3>  1. Comment puis-je m'inscrire sur Unify ? ? </h3>
                 <svg width="15" height="10" viewBox="0 0 42 25">
                     <path d="M3 3L21 21L39 3" stroke ="white" stroke-width="7" stroke-linecap="round"/>
                  </svg>
     </div>
 
     <div class="answer">
         <p>
          L'inscription à Unify est réservée aux étudiants et enseignants des universités partenaires. Contactez votre 
          université pour obtenir des informations sur le processus d'inscription.
         </p>


     </div>
      </div>


     <div class="faq">
      <div class="question">
             <h3>  2. Comment puis-je rechercher des informations sur Unify ? </h3>
             <svg width="15" height="10" viewBox="0 0 42 25">
                 <path d="M3 3L21 21L39 3" stroke ="white" stroke-width="7" stroke-linecap="round"/>
              </svg>
 </div>

 <div class="answer">
     <p>
      Vous pouvez utiliser la barre de recherche située en haut de la page pour rechercher des informations spécifiques. De plus, vous pouvez parcourir 
      les catégories ou les tags pour trouver des contenus pertinents.
     </p>

 </div>
 </div>

 <div class="faq">
  <div class="question">
         <h3>  3. Comment puis-je signaler un contenu inapproprié ou abusif ?

         </h3>
         <svg width="15" height="10" viewBox="0 0 42 25">
             <path d="M3 3L21 21L39 3" stroke ="white" stroke-width="7" stroke-linecap="round"/>
          </svg>
</div>

<div class="answer">
 <p>
  Si vous rencontrez un 
  contenu inapproprié ou suspectez un comportement abusif, utilisez l'option de signalement disponible sur la plateforme. Nous enquêterons sur toutes les plaintes et prendrons des mesures appropriées.
 </p>

</div>
</div>


</div>
<h3 class="title">Seek Costumer help</h3>
<div>
  <a href="addticket.php" class="link-button">
    From An Employee
</a>
<a href="addticket.php" class="link-button2">
  From A Bot
</a>
</div>










  <!-- widgets ends -->
  <script src="./js/home.js"></script>
  <script src="app.js"></script>
  <script>
    function autoResizeTextarea(textarea) {
  textarea.style.height = 'auto';
  textarea.style.height = textarea.scrollHeight + 'px';
}
function toggleButtonOpacity(textarea) {
  const button = document.getElementById('postButton');
  if (textarea.value.trim().length > 0) {
    button.style.opacity = 1;
    button.disabled = false;
  } else {
    button.style.opacity = 0.5;
    button.disabled = true;
  }
}
/* When the user clicks on the button, toggle between hiding and showing the dropdown content */
function toggleDropdown() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

// Function to select or deselect all checkboxes
function selectAll(source) {
  checkboxes = document.querySelectorAll('.dropdown-content input[type="checkbox"]');
  for(var i = 0, n = checkboxes.length; i < n; i++) {
    checkboxes[i].checked = source.checked;
  }
}

  </script>
</body>

</html>