
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CLUB 1</title>
</head>
<body>
   
    <img src="téléchargement (1).jpg" alt="" class="club-img-hide" id="img"></div>
<i class="fas fa-times" onclick="hide()"></i>
<div class="col2">
    <h1 id="displayed-value">
        <!-- Displayed value will be updated by the JavaScript code -->
    </h1>
     <h3>Dynamic sports club promoting diverse sports, top facilities, and expert coaching for all ages</h3>
     <span><br>esprit.sportif@esprit.tn</span>
     <span><br>addresse : esrit ghazella bloc H </span><br>
     <br>
     <br>
     <a href="templates/indexformilaire.php">
            <button>s'inscrire</button>
        </a>
    
    </div> 
     

    <script>
        // Retrieve the data from the POST request
        var dataReceived = decodeURIComponent(new URLSearchParams(window.location.search).get('value'));

        // Display the data in the div
        document.getElementById('displayed-value').innerText = dataReceived;
    </script>
</body>
</html>
