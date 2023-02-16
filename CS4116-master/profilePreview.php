<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <link rel="icon" href="images/uniConnectLogo.png" />
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
 <title>Register</title>

  <style>
    h1 {text-align: center;}
    h4 {text-align: center;}
    p {text-align: center;}

    .croppedProfile {
        width: 16rem; /* width of container */
        height: 16rem; /* height of container */
        object-fit: cover;
        /*border: 5px solid black;*/
    }
    /* div {text-align: center;} */
  </style>
</head>
<body>

  <?php
      // require_once 'includes/dbh.inc.php';
      // $conn = createConnection("sql100.epizy.com", "epiz_31242413", "WbIh2OaPZju", "epiz_31242413_project_database");
      session_start();
      if(empty($_SESSION['loggedin'])){ header("location: login.php");} //if user not logged in, send to login


      // if(array_key_exists('buttonSwipeLeft', $_POST)) {
      //     logUserOut();
      // }
      //
      // function logUserOut() {
      //     //echo "This is Button1 that is selected";
      //     $_SESSION = array();
      //     session_destroy();
      //     header("location: login.php");
      // }

      // if(array_key_exists('buttonLogOut', $_POST)) {
      //     logUserOut();
      // }
      // function logUserOut() {
      //     //echo "This is Button1 that is selected";
      //     $_SESSION = array();
      //     session_destroy();
      //     header("location: login.php");
      // }


      // $userEmail = 'test@gmail.com';
      //
      // $sqlQuery1 = "SELECT * FROM profile WHERE email = ".$userEmail;
      //
      // echo $sqlQuery1;
      //
      // $results = mysqli_query($conn,$sqlQuery1);
      // echo $results;

      // echo 'hello';
      //getProfilePreview('test@gmail.com');
      // echo 'finished running';

      function getProfilePreview($userEmail){
        // echo 'start testConnect()';
        require_once 'includes/dbh.inc.php';
        $conn = createConnection("sql100.epizy.com", "epiz_31242413", "WbIh2OaPZju", "epiz_31242413_project_database");

        $sqlQuery1 = "SELECT * FROM profile WHERE email = '".$userEmail."'";
        $queryResults = mysqli_query($conn, $sqlQuery1);

        if (mysqli_num_rows($queryResults) == 0) {
        // The query returned 0 rows!
          echo 'no result';
        } else {
          // the query returned ATLEAST one row
          while($row = mysqli_fetch_array($queryResults)){
              //print_r($row);
              ?>
              <div class="container pt-3">
                   <div class="row justify-content-center" style="padding-top: 15px">
              <?php
                  // echo '<img src="'.$row['Photo'].'" alt="Profile Image" style="width: 250px; height: 250px; border: 1px solid black;">';
                  echo '<img class="croppedProfile" src="'.$row['Photo'].'">';
              ?>
            </div>

            <!-- Name -->
               <?php

                   $sqlQuery = "SELECT Firstname FROM user WHERE UserID = ".$row["UserID"];

                   $userResults = mysqli_query($conn,$sqlQuery);
                   $row1 = mysqli_fetch_array($userResults);
                   $firstName = $row1[0];

                   if($firstName){
                     ?>

                     <div class="row justify-content-center">
                      <!-- Name -->
                       <div style="width: 8rem; background: rgba(0,0,255,0.3); border: 1px solid purple; border-radius: 2px; padding: 5px; margin-top: 5px;">
                       <?php echo $firstName . "<br>";?>
                       </div>
                        <!-- Age -->
                       <div style="width: 8rem; background: rgba(0,0,255,0.3); border: 1px solid purple; border-radius: 2px; padding: 5px; margin-top: 5px;">
                       <?php echo $row['Age'] . "<br>";?>
                       </div>
                     </div>

                 <?php
                   }
                   ?>


            <!-- University -->
            <div class="row justify-content-center">
              <div style="width: 16rem; background: rgba(0,0,255,0.3); border: 1px solid purple; border-radius: 2px; padding: 5px; margin-top: 5px;">
              <?php echo $row['Institution'] . "<br>";?>
              </div>
            </div>
            <!-- Course -->
            <div class="row justify-content-center">
              <div style="width: 16rem; background: rgba(0,0,255,0.3); border: 1px solid purple; border-radius: 2px; padding: 5px; margin-top: 5px;">
              <?php echo $row['Course'] . "<br>";?>
              </div>
            </div>
            <!-- Description -->
            <div class="row justify-content-center">
              <div style="width: 16rem; background: rgba(0,0,255,0.3); border: 1px solid purple; border-radius: 2px; padding: 5px; margin-top: 5px;">
              <?php echo $row['Description'] . "<br>";?>
              </div>
            </div>

            <!--TEST-->
            <?php
                        $currUser = $userEmail;
                        $sql = "SELECT UserID FROM user WHERE Handle = '$currUser'";
                        $results = mysqli_query($conn,$sql);
                        $row1 = mysqli_fetch_array($results);
                        $tempUserID = $row1[0];

                        $sql2 = "SELECT * FROM Interests WHERE UserID = '$tempUserID'";
                        $results2 = mysqli_query($conn,$sql2);
                        if($results2){
                            if(mysqli_num_rows($results2)>0){ //IF user has profile, shows details
                                while($row = mysqli_fetch_array($results2)){
                                //print_r($row);
                                $sql3 = "SELECT InterestName FROM AvailableInterests WHERE InterestID = '$row[1]'";
                                    $results3 = mysqli_query($conn,$sql3);
                                    $row3 = mysqli_fetch_array($results3);
                                    $tempIntID = $row3[0];
                                $sql4 = "SELECT InterestName FROM AvailableInterests WHERE InterestID = '$row[2]'";
                                    $results4 = mysqli_query($conn,$sql4);
                                    $row4 = mysqli_fetch_array($results4);
                                    $tempIntID2 = $row4[0];
                                $sql5 = "SELECT InterestName FROM AvailableInterests WHERE InterestID = '$row[3]'";
                                    $results5 = mysqli_query($conn,$sql5);
                                    $row5 = mysqli_fetch_array($results5);
                                    $tempIntID3 = $row5[0];


                    ?>
                    <!-- Interested In -->
                    <br>
                    <div class="row justify-content-center" style="margin-top:-20px">
                    <h5>Interested In..</h5>
                    </div>
                    <div class="row justify-content-center">
                    <div style="width: 250px; background: rgba(0,0,255,0.3); border: 1px solid purple; border-radius: 2px;">
                        <?php echo $tempIntID . "<br>";?>
                    </div>
                    </div>
                    <div class="row justify-content-center">
                    <div style="width: 250px; background: rgba(0,0,255,0.3); border: 1px solid purple; border-radius: 2px;">
                        <?php echo $tempIntID2 . "<br>";?>
                    </div>
                    </div>
                    <div class="row justify-content-center">
                    <div style="width: 250px; background: rgba(0,0,255,0.3); border: 1px solid purple; border-radius: 2px;">
                        <?php echo $tempIntID3 . "<br>";?>
                    </div>
                    </div>
                    <?php
                                }
                            }
                        }
                    ?>
            <!--TEST-->

         </div>

              <?php
          }
        }
        $conn->close();
        // echo 'finish testConnect()';
      }

      // getProfilePreview('test@gmail.com');

      function getSwipeBar($userEmail){
        ?>
        <!-- <form action="editProfile.php" method="POST" enctype="multipart/form-data">
          <div class="container pt-3">
            <div class="row justify-content-center"> -->
             <!-- Swipe Left -->
              <!-- <div style="height: 8rem; width: 8rem; background: rgba(0,0,255,0.3); border: 1px solid purple; border-radius: 2px; padding: 5px; margin-top: 5px;">
                <button type="button" class="btn btn-outline-danger" type="submit" name="buttonSwipeLeft">Dislike</button>
              </div> -->
               <!-- Swipe Right -->
              <!-- <div style="height: 8rem; width: 8rem; background: rgba(0,0,255,0.3); border: 1px solid purple; border-radius: 2px; padding: 5px; margin-top: 5px;">
                <button type="button" class="btn btn-outline-success" type="submit" name="buttonSwipeRight">Like</button>
              </div>
            </div>
          </div>
        </form> -->
        <div class="container pt-3">
          <div class="row justify-content-center" style="margin-top: -10px">
            <form method="post">
                <input type="submit" name="buttonSwipeLeft"
                        class="btn btn-primary" value="Swipe Left" id="dislike"/>
                <input type="hidden" id="postUserEmail" name="postUserEmail" value="<?php echo $userEmail;?>">
            </form>

            <form method="post">
                <input type="submit" name="buttonSwipeRight"
                        class="btn btn-primary" value="Swipe Right" id="like"/>
                <input type="hidden" id="postUserEmail" name="postUserEmail" value="<?php echo $userEmail;?>">
            </form>
          </div>

        </div>
        <?php
      }
  ?>



 <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
