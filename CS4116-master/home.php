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

  if(array_key_exists('buttonSwipeRight', $_POST)) {
      swipeRight();
  }

  function swipeRight(){
    // $_POST['connectProfile'] = $currentFeedProfile;
    //$_SESSION['username'] = $currentProfile1;
    //check for existing entry in connection table
    require_once 'includes/dbh.inc.php';
    $conn = createConnection("sql100.epizy.com", "epiz_31242413", "WbIh2OaPZju", "epiz_31242413_project_database");

    if($conn->connect_error){
        die('Connection failed : '.$conn->connect_error);
    } else {

    $tempUserID = $_SESSION['username'];
                $sql1 = "SELECT UserID FROM user WHERE Handle = '$tempUserID'";
                $results1 = mysqli_query($conn,$sql1);
                $row1 = mysqli_fetch_array($results1);
                $User1ID = $row1['UserID']; //initiated connection
                //echo $User1ID;

                //echo $_POST['postUserEmail'];
                $currUser = $_POST['postUserEmail'];
                        $sql = "SELECT UserID FROM user WHERE Handle = '$currUser'";
                        $results = mysqli_query($conn,$sql);
                        $row1 = mysqli_fetch_array($results);
                        $User2ID = $row1['UserID'];
                // //$currentFeedProfile = $_POST['connectProfile'];
                // $currentFeedProfile = $_SESSION['currentFeedProfile'];
                // $sql1 = "SELECT UserID FROM user WHERE Handle = '$currentFeedProfile'";
                // $results1 = mysqli_query($conn,$sql1);
                // $row1 = mysqli_fetch_array($results1);
                // $User2ID = $row1['UserID']; //received connection
                // //echo $User2ID;


                $sql = "SELECT * FROM Connections WHERE userID1  = '$User2ID' AND userID2  = '$User1ID'"; //check if user2 has already attempted to connect with user1 previously
                $results = mysqli_query($conn, $sql);
                // echo "connecting to db";
                if($results){ //alter incomplete connection to be complete
                  // echo "found results";
                  if(mysqli_num_rows($results)>0){ //IF UserID exists in profile table, update data in corresponding row
                    //echo "found already existing connection". "<br>";
                    //INSERT INTO Connections (ConnectionID, userID1, userID2, ConnectionDate, isAccepted)

                      //$stmt = $conn->prepare("");
                      $date = date("Y-m-d");
                      $sql = "UPDATE Connections SET ConnectionDate='$date', isAccepted=1 WHERE userID1='$User2ID' AND userID2  = '$User1ID'";

                      if (mysqli_query($conn, $sql)) {
                        //echo "Connection Updated";
                      } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                      }
                      // $stmt->execute();
                      // echo "Connection Updated";
                      // $stmt->close();

                  } else { //ELSE no previous connection attempt, insert new row
                    //echo "inserting new connection". "<br>";
                      // $stmt = $conn->prepare("INSERT INTO Connections (userID1, userID2, isAccepted) values(?,?,?)");
                      // $stmt->bind_param('iii', $User1ID, $User2ID, 0);
                      // $stmt->execute();
                      // echo "Connections Updated";
                      // $stmt->close();

                      $sql = "INSERT INTO Connections (userID1, userID2, isAccepted) VALUES (".$User1ID.",".$User2ID.",0)";

                        if (mysqli_query($conn, $sql)) {
                          //echo "New Connection Added";
                        } else {
                          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                        }
                  }

                }
                $conn->close();
              }
  }

 ?>
<?php
    require_once 'includes/dbh.inc.php';
    $tempUserID = $_SESSION['username'];
    $conn = createConnection("sql100.epizy.com", "epiz_31242413", "WbIh2OaPZju", "epiz_31242413_project_database");
    $sqlBanned = "SELECT * FROM profile WHERE email = '$tempUserID'";
    $sqlBannedRes = mysqli_query($conn,$sqlBanned);
    $rowBan = mysqli_fetch_array($sqlBannedRes);
    $isBanned = $rowBan['Banned'];
    if($isBanned == NULL || $isBanned == 0){
        //Do nothing, user is not banned
    } else if($isBanned == 1){
        //User is banned, redirect
        header("location: userBanned.php");
    }
    $conn->close();

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


<!--User Feed Here-->
     <div class="container-fluid">
       <!--<p>User Feed here</p>-->
       <!-- Add feed functionality here, show user random or specific profiles that the user has not connected with -->
       <?php
          require_once 'profilePreview.php';
          //$currentFeedProfile = 'elfbar@email.com';
          //$_POST['connectProfile'] = $currentFeedProfile;
          //$_SESSION['currentFeedProfile'] = $currentFeedProfile;
          //getProfilePreview($currentFeedProfile);
          //getSwipeBar($currentFeedProfile);
        ?>
         <!-- Also need to add buttons so a user can swipe on profiles -->
     </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm">
                <h4> Suggested Users </h4>
                <!--Suggested users bar/box -->
                <?php
                require_once 'includes/dbh.inc.php';
                $conn = createConnection("sql100.epizy.com", "epiz_31242413", "WbIh2OaPZju", "epiz_31242413_project_database");

                $tempUserID = $_SESSION['username'];
                $sql1 = "SELECT UserID FROM user WHERE Handle = '$tempUserID'";
                $results1 = mysqli_query($conn,$sql1);
                $row1 = mysqli_fetch_array($results1);
                $UserID = $row1['UserID'];
                $sql2 = "SELECT * FROM profile WHERE UserID = '$UserID'";
                $results2 = mysqli_query($conn,$sql2);
                $row2 = mysqli_fetch_array($results2);
                $currUserAge = $row2['Age'];

                //Suggested users based on age
                //$sqlSugg1 = "SELECT * FROM profile WHERE Age <= ('$currUserAge'+3) AND Age >= ('$currUserAge'-3)";
                //$sqlSugg1Result = mysqli_query($conn,$sqlSugg1);

                //foreach($sqlSugg1Result as $userResults){
                //    $userDisplay = $userResults['email'];
                //    getProfilePreview($userDisplay);
                //    getSwipeBar($userDisplay);
                //}

                //Suggested users based on interest and age combined
                $sql3 = "SELECT * FROM Interests WHERE UserID = '$UserID'";
                $results3 = mysqli_query($conn,$sql3);
                $row3 = mysqli_fetch_array($results3);
                //Select logged in users interests
                $currUserInterest1 = $row3['InterestID'];
                $currUserInterest2 = $row3['InterestID2'];
                $currUserInterest3 = $row3['InterestID3'];

                //Query database for UserIDs matching user interests above
                $sql4 = "SELECT * From Interests WHERE ('$currUserInterest1' = InterestID OR '$currUserInterest1' = InterestID2 OR '$currUserInterest1' = InterestID3 OR
                                                                '$currUserInterest2' = InterestID OR '$currUserInterest2' = InterestID2 OR '$currUserInterest2' = InterestID3 OR
                                                                '$currUserInterest3' = InterestID OR '$currUserInterest3' = InterestID2 OR '$currUserInterest3' = InterestID3) AND UserID != '$UserID'";
                $results4 = mysqli_query($conn,$sql4);
                //Iterate through results
                foreach($results4 as $userInterestResults){
                    //Reduce results based on age
                    $userDisplay1 = $userInterestResults['UserID'];
                    // print_r($userInterestResults);
                    // $sql51 = "SELECT UserID FROM profile WHERE Age <= ('$currUserAge'+3) AND Age >= ('$currUserAge'-3) AND UserID = '$userDisplay1'";
                    // $sql51Result = mysqli_query($conn,$sql51);
                    // //Iterate through results
                    // foreach($finalResult as $userIDTemp){

                      //Check if existing connection
                       //print_r($userInterestResults);

                      $currUserID = $_SESSION['userID'];
                      $sql6 = "SELECT * FROM Connections WHERE userID1 = '$currUserID' AND userID2 = '$userDisplay1'"; //check if user2 has already attempted to connect with user1 previously
                      $checkMatch = mysqli_query($conn, $sql6); //do not add ids from this query to home page as they have existing connection

                        //foreach ($finalResult as $finalUserIDTemp) {

                           //print_r($finalUserIDTemp);
                          // foreach ($sql51Result as $moreUserIdTemp) {
                          //
                          // }
                          if(mysqli_num_rows($checkMatch)>0){


                          foreach ($checkMatch as $previousMatch) {
                            if ($userDisplay1 == $previousMatch) {
                                //already existing connection sent, do nothing
                            }else {
                              $sqlFinal = "SELECT * FROM Connections WHERE userID1 = '$userDisplay1' AND userID2 = '$currUserID'"; //check if user2 has already attempted to connect with user1 previously
                              $checkMatch2 = mysqli_query($conn, $sqlFinal);
                              foreach ($checkMatch2 as $previousMatch2) {
                                if ($userDisplay1 == $previousMatch2) {
                                        //do nothing
                                }else {
                                  $sql5 = "SELECT Handle FROM user WHERE UserID = '$userDisplay1'";
                                  $results5 = mysqli_query($conn,$sql5);
                                  $handle = mysqli_fetch_array($results5);
                                  $handleFinal = $handle['Handle'];
                                  getProfilePreview($handleFinal);
                                  getSwipeBar($handleFinal);
                                }
                              }
                              //Display users who match interest and age requirement
                              //$finalUserID = $finalUserIDTemp['UserID'];
                              // $sql5 = "SELECT Handle FROM user WHERE UserID = '$userDisplay1'";
                              // $results5 = mysqli_query($conn,$sql5);
                              // $handle = mysqli_fetch_array($results5);
                              // $handleFinal = $handle['Handle'];
                              // getProfilePreview($handleFinal);
                              // getSwipeBar($handleFinal);
                            }
                          }
                        }else {
                          //$finalUserID = $finalUserIDTemp['UserID'];
                          $sql5 = "SELECT Handle FROM user WHERE UserID = '$userDisplay1'";
                          $results5 = mysqli_query($conn,$sql5);
                          $handle = mysqli_fetch_array($results5);
                          $handleFinal = $handle['Handle'];
                          getProfilePreview($handleFinal);
                          getSwipeBar($handleFinal);
                        }


                        //}
                        // //Display users who match interest and age requirement
                        // $finalUserID = $finalUserIDTemp['UserID'];
                        // $sql5 = "SELECT Handle FROM user WHERE UserID = '$finalUserID'";
                        // $results5 = mysqli_query($conn,$sql5);
                        // $handle = mysqli_fetch_array($results5);
                        // $handleFinal = $handle['Handle'];
                        // getProfilePreview($handleFinal);
                        // getSwipeBar($handleFinal);

                        //}

                    //}
                }

                ?>
            </div>
            <div class="col-sm">
                <h4> Random Users </h4>
                <?php
                    $sqlRand = "SELECT email FROM profile WHERE UserID != '$UserID'";
                    $sqlRandRes = mysqli_query($conn,$sqlRand);
                    foreach($sqlRandRes as $allUsers){
                        $userMail = $allUsers['email'];
                        $randomNum = rand(0,1);
                        if($randomNum <= 6){

                        //   //check if existing connection
                        //   $currUserID = $_SESSION['userID'];
                        //   $sql6 = "SELECT * FROM Connections WHERE userID1 = '$currUserID' AND userID2 = '$userDisplay1'"; //check if user2 has already attempted to connect with user1 previously
                        //   $checkMatch = mysqli_query($conn, $sql6);
                        //
                        //   if(mysqli_num_rows($checkMatch)>0){
                        //
                        //
                        //   foreach ($checkMatch as $previousMatch) {
                        //     if ($userDisplay1 == $previousMatch) {
                        //         //already existing connection sent, do nothing
                        //     }else {
                        //       $sqlFinal = "SELECT * FROM Connections WHERE userID1 = '$userDisplay1' AND userID2 = '$currUserID'"; //check if user2 has already attempted to connect with user1 previously
                        //       $checkMatch2 = mysqli_query($conn, $sqlFinal);
                        //       foreach ($checkMatch2 as $previousMatch2) {
                        //         if ($userDisplay1 == $previousMatch2) {
                        //                 //do nothing
                        //         }else {
                        //           getProfilePreview($userMail);
                        //           getSwipeBar($userMail);
                        //         }
                        //       }
                        //     }
                        //   }
                        // }




                            getProfilePreview($userMail);
                            getSwipeBar($userMail);
                        } else if($randomNum > 6 && $randomNum <= 10){
                            //Do nothing
                        }
                    }
                ?>
            </div>
        </div>
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
