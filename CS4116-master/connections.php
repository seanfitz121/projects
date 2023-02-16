<?php
  // require_once 'includes/dbh.inc.php';
  // $mysqli = createConnection("sql100.epizy.com", "epiz_31242413", "WbIh2OaPZju", "epiz_31242413_project_database");

  session_start();
  if(empty($_SESSION['loggedin'])){ header("location: login.php");}  //check if user not logged in, re-direct to login

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
   /* h1 {text-align: center;}
   h4 {text-align: center;} */
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
      <p>Connections here</p>

    <?php
     require 'includes/dbh.inc.php';
     $matchConn = createConnection("sql100.epizy.com", "epiz_31242413", "WbIh2OaPZju", "epiz_31242413_project_database");
     require_once 'profilePreview.php';
     //Function to get the social media accounts (Instagram and Snapchat) of a user given an userID
     function getSocials($userID){
      $socialConn = createConnection("sql100.epizy.com", "epiz_31242413", "WbIh2OaPZju", "epiz_31242413_project_database");
      $sqlSocial = "SELECT * FROM profile WHERE UserID = '$userID'";
      $socialResults = mysqli_query($socialConn, $sqlSocial);

      if($socialResults){
        $socialRow = mysqli_fetch_array($socialResults);
        // echo "Instagram";
        // echo $socialRow["Instagram"];
        // echo "Snapchat";
        // echo $socialRow["Snapchat"];
        //echo "<br>" . $socialRow['Instagram'] . "<br>" . $socialRow['Snapchat'];

        echo '<div class="container pt-3">';
        echo '<div class="row justify-content-center">';
        echo '  <div style="width: 16rem; background: rgba(0,0,255,0.3); border: 1px solid purple; border-radius: 2px; padding: 5px; margin-top: 5px;">';
        echo "Instagram: " . $socialRow['Instagram'] . "<br>";
        echo '  </div>';
        echo '</div>';
        echo '<div class="row justify-content-center">';
        echo '  <div style="width: 16rem; background: rgba(0,0,255,0.3); border: 1px solid purple; border-radius: 2px; padding: 5px; margin-top: 5px;">';
        echo "Snapchat: " . $socialRow['Snapchat'] . "<br>";
        echo '  </div>';
        echo '</div>';
        echo '</div>';
      }else {
        echo "no socials found";
      }

      //Prints out Instagram and Snapchat of user put into function
      //echo "<br>" . $socialRow['Instagram'] . "<br>" . $socialRow['Snapchat'];


      $socialConn->close();
     }

     // $tempUserID = $_SESSION['username'];
     //            $sql1 = "SELECT UserID FROM user WHERE Handle = '$tempUserID'";
     //            $results1 = mysqli_query($matchConn,$sql1);
     //            $row1 = mysqli_fetch_array($results1);
     //            $currUserID = $row1['UserID']; //initiated connection

    $currUserID = $_SESSION['userID'];



     //Get all the Connections made by the user that have been accepted
     $sqlconnections = "SELECT * FROM Connections WHERE (userID1  = '$currUserID' OR userID2 = '$currUserID') AND isAccepted = 1";
     $matchResults = mysqli_query($matchConn, $sqlconnections);
     // if (mysqli_num_rows($results) == 0){
     //   // The query returned 0 rows!
     //   echo 'no Matches';
     // } else {
     //    echo "Found a match(s)";
     //    printf($results);

     $totalMatchIds = array();

     if ($matchResults) {
       if(mysqli_num_rows($matchResults)>0){
         // echo "Matches found";
         // echo count($matchResults);
         while($row = mysqli_fetch_array($matchResults)){ //loop through each result and store as row var
             //print_r($row);
             // $user1 = $row['userID1'];
             // $user2 = $row['userID2'];
             // echo $user1;
             // echo " , ";
             // echo $user2;

             if ($currUserID = $row['userID1']){ //select id of user that is not curUser
               $matchUserId = $row['userID2'];
             } else {
               $matchUserId = $row['userID1'];
             }
             array_push($totalMatchIds, $row['userID2']); //push userId of other user within match to array
             // echo "pushed row ";
             // echo $matchUserId;
           }

           //print_r($totalMatchIds);


           foreach($totalMatchIds as $id) {
             $otherUserID = $id;
             $sql2 = "SELECT * FROM profile WHERE UserID = '$otherUserID'";
             $results2 = mysqli_query($matchConn,$sql2);

             $row2 = mysqli_fetch_array($results2);
             $tempMail = $row2['email'];

             //echo $tempMail;
             getProfilePreview($tempMail);
             printf("<br>");
             getSocials($id);
             printf("<br>");
           }


       }else {
         echo "You currently have no Matches!";
       }
     }

      // echo implode( ", ", $results );
      //Present profile preview of the users that have made connections with the current user
      // foreach($isAcceptedArray as $id) {
      //   $otherUserID = $id;
      //   $sql2 = "SELECT * FROM profile WHERE UserID = '$otherUserID'";
      //   $results2 = mysqli_query($conn,$sql2);
      //   $row2 = mysqli_fetch_array($results2);
      //   $tempMail = $row2['email'];
      //   getProfilePreview($tempMail);
      //   printf("<br>");
      //   getsocials($otherUserID);
      //   printf("<br>");
      // }
     //}
     $matchConn->close();

    ?>
</div>

    <!-- <form action="profilePage.php">
        <input type="submit" value="Profile" />
    </form>

    <form method="post">
        <input type="submit" name="buttonLogOut"
                class="button" value="Log out" />
    </form> -->
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
