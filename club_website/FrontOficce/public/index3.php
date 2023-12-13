<?php 
session_start();
include "../../BackOffice/Back/Controller/EtudiantC.php";
include '../../BackOffice/Back/model/Etudiant.php';

 $RegEtud = null;


 // create an instance of the controller
 $EtuReg = new EtudiantC();
 $error = "";
 
 if (    
 
    
     isset($_POST["email"]) &&
     isset($_POST["password"])
     
 ) {
     if (
     
            !empty($_POST["email"]) &&
            !empty($_POST["password"])
         
 
     ) {
         $RegEtud = new Etudiant(
            null,
            null,
            null,
            $_POST["email"],
            $_POST["password"],
 
         );
       
         $result = $EtuReg->Login($RegEtud);
         if(isset($result["email"]) == $_POST["email"] && isset($result["password"]) == $_POST["password"]){
            $Msg = "Login successful!";
            $_SESSION["User"] = $result["email"];
            header("Location:index.php");
         } else 
             $error = "Error in login!";
           
          
 
   
 
     } else
         $error = "Missing information";
 }
  
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
      <div class="row col-md-6 col-md-offset-3">
        <div class="panel panel-primary">
          <div class="panel-heading text-center">
            <h1>Login Form</h1>
          </div>
          <div class="panel-body">
            <form action="" method="post">
              
              <div class="form-group">
                <label for="email">Email</label>
                <input
                  type="text"
                  class="form-control"
                  id="email"
                  name="email"
                />
              </div>
              <div class="form-group">
                <label for="password">password</label>
                <input
                  type="password"
                  class="form-control"
                  id="password"
                  name="password"
                />
              </div>
              <?php if(isset($Msg)) {?>
              <div class="alert alert-success" role="alert">
                <?php echo $Msg ;?>
            </div>
<?php 
              } else if(isset($error)) {

?>

<div class="alert alert-danger" role="alert">
                <?php echo $error ;?>
            </div>

<?php }?>
              <input type="submit" name="login" class="btn btn-primary" />
            </form>
          </div>
          
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

  </body>

</html>