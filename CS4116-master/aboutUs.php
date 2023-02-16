<?php
  // require_once 'includes/dbh.inc.php';
  // $mysqli = createConnection("sql100.epizy.com", "epiz_31242413", "WbIh2OaPZju", "epiz_31242413_project_database");

  session_start();
  //if(empty($_SESSION['loggedin'])){ header("location: login.php");}  //check if user not logged in, re-direct to login

  if(array_key_exists('buttonLogOut', $_POST)) {
      logUserOut();
  }
  function logUserOut() {
      //echo "This is Button1 that is selected";
      $_SESSION = array();
      session_destroy();
      header("location: login.php");
  }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" href="images/uniConnectLogo.png" />
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
 <title>Home</title>
 <style>
   /* h1 {text-align: center;} */
   h4 {text-align: center;}
   p {text-align: center;}
   /* div {text-align: center;} */
 </style>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
   <div class="container-fluid">
   <a class= "navbar-brand" href="index.php"><img src="images/uniConnectLogo.png"></a>
   <button class="navbar-toggler" type="button" data-toggle="collapse"
   data-target="#navbarResponsive">
        <span class="navbar=toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="profilePage.php"><span class="glyphicon glyphicon-user"></span> Profile</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="search.php"><span class="glyphicon glyphicon-user"></span> Search</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="connections.php"><span class="glyphicon glyphicon-user"></span> Matches</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="aboutUs.php">About Us</a>
            </li>

            <form method="post">
             <input type="submit" name="buttonLogOut"
                     class="btn btn-primary" value="Logout" />
         </form>
 </div>
 </nav>


<!--Connections Feed Here-->
<div class="container-fluid">
  <h4 style="padding: 3em 0em 1em 0em;">What is Uni-Connect?</h4>
     <div class="row justify-content-center">
       <p style="padding: 1em 0em 1em 0em;border-width: 2px;">
         Uni-connect is a dating application tailored for third level students.
       </p>
      <p style="padding: 1em 0em 1em 0em;border-width: 2px;">
         There are dating apps for a plethora of niches, as a university student,
          you have specific needs and probably don't want to wade through all of the older people trying to get married.
        </p>
       <p style="padding: 1em 0em 1em 0em;border-width: 2px;">
            You need dating apps that are specifically tailored for your lifestyle like Uni-Connect!
       </p>
     </div>
  </div>


<!-- Footer and spacing -->
    <br>
    <footer class="bg-light text-center text-lg-start">
   <!-- Copyright -->
   <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
     © 2022 Copyright:
     <a class="text-dark" href="https://github.com/Chedz/CS4116">Group-14 Git Repo</a>
   </div>
   <!-- Copyright -->
 </footer>

</body>
</html>
