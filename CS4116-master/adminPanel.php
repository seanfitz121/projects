<?php
  session_start();
  if(empty($_SESSION['adminloggedin'])){ header("location: adminLogin.php");}  //check if user not logged in, re-direct to login

  if(array_key_exists('buttonLogOut', $_POST)) {
      logUserOut();
  }
  function logUserOut() {
      //echo "This is Button1 that is selected";
      $_SESSION = array();
      session_destroy();
      header("location: adminLogin.php");
  }
 ?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="icon" href="images/uniConnectLogo.png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- <meta http-equiv = "refresh" content = "3; url = http://14-cs4116.infinityfreeapp.com/profilePage.php" /> -->
    <style>
      h1 {text-align: center;}
      h4 {text-align: center;}
      p {text-align: center;}

      .navbarHeading {
          position: absolute;
          left: 50%;
          top: 50%;
          transform: translate(-50%, -50%);
          border: 2rem solid #FFFFFF;
          padding: 4rem;
      }

      /* .button {
        margin:0 auto;
        display:block;
        font-size: 1rem;
      } */

      /* div {text-align: center;} */
    </style>
</head>
<body>

  <!-- Navbar-->
       <nav class="navbar navbar-dark bg-dark">
         <div class="container">
         <!-- <div class="navbar-header">
           <a class="navbar-brand" href="#">WebSiteName</a>
         </div> -->
         <a class="navbar-left"><img src="images/uniConnectLogo.png"></a>

         <!-- <ul class="navbarHeading">
           <li>Admin Panel</li>
         </ul> -->

         <h1 style="color: white; border-width: 1rem;"> Admin Panel </h1>
         <!-- <ul class="nav navbar-nav">
           <li><a href="search.php">Search</a></li>
         </ul> -->
         <ul class="nav navbar-nav navbar-right">
           <!-- <li><a href="profilePage.php"><span class="glyphicon glyphicon-user"></span> Profile</a></li> -->
           <!-- <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li> -->
           <form method="post">
               <input type="submit" name="buttonLogOut"
                       class="btn btn-primary" value="Log out" />
           </form>
         </ul>
       </div>
       </nav>

         <!--Search Feed Here-->
              <!-- <div class="container-fluid">
         			 <h2>Search</h2>


              </div> -->

              <!--Search Feed Here-->
                   <div class="container-fluid">
              			 <h1>Search</h1>
              			 <form action="adminPanel.php" method="POST">
              			 	<input type="text" name="search" placeholder="Search for members..."/>
              			 	<button type="submit" name="Search">Search</button><br>
                                              <input type="number" name="age" min="18" placeholder="Max age.." value="22" required/>
                                              <label for="age">Max Age (18+)</label><br>
                                              <label>Smoker?</label><br>
                                              <input type="radio" name="smoker" value="0"/>
                                              <label for="smoker">No</label>
                                              <input type="radio" name="smoker" value="1"/>
                                              <label for="smoker">Yes</label><br>
                                              <label>Gender..</label><br>
                                              <input type="radio" name="gender" value="Male"/>
                                              <label for="gender">Male</label>
                                              <input type="radio" name="gender" value="Female"/>
                                              <label for="gender">Female</label>
                                              <select name="interestsSearch">
                                                  <option value="" selected disabled hidden>Select Interest</option>
                                                  <option value="0">Reading</option>
                                                  <option value="1">Working Out</option>
                                                  <option value="2">Gaming</option>
                                                  <option value="3">Walking</option>
                                                  <option value="4">Cooking</option>
                                                  <option value="5">Dancing</option>
                                                  <option value="6">Netflix</option>
              				    <option value="7">Fishing</option>
                                                  <option value="8">Dogs</option>
                                                  <option value="9">Cats</option>
                                                  <option value="10">Music</option>
                                                  <option value="11">Art</option>
                                                  <option value="12">Coffee</option>
                                                  <option value="13">Soccer</option>
              				    <option value="14">Movies</option>
                                                  <option value="15">Travel</option>
                                                  <option value="16">Beer</option>
                                                  <option value="17">Wine</option>
                                                  <option value="18">Politics</option>
                                                  <option value="19">Baking</option>
                                                  <option value="20">Photography</option>
                                              </select>
                                              <hr>
              			</form>

              			<?php 	if (isset($_POST["search"])) {
              				require "searchPage.php";
              				require_once 'profilePreview.php';

              				//This displays the profile tile for each result based on name
                                                  if (count($resultsFiltered) > 0) {

                                                      if(isset($interests)){ //If interest has been selected for search, do this modified search with filters and interests
                                                          $finalSearchIDs = array_intersect($tempFilterIDArray,$tempFilterInterestsArray); //Find UserIDs that have the searched interest and match the search filters by comparing the two arrays from                                                                                                                                       earlier
                                                          foreach($finalSearchIDs as $r){ //Here we iterate through each matching UserID and display the results
                                                              $tempUserID = $r;
                                                              $sql2 = "SELECT * FROM profile WHERE UserID = '$tempUserID'";
                                                              $results2 = mysqli_query($conn,$sql2);
                                                              $row2 = mysqli_fetch_array($results2);
                                                                  $tempMail = $row2['email'];
                                                                  getProfilePreview($tempMail);
                                                                  ?>
                                                                  <div class="row justify-content-center">
                                                                  <form action="adminProfileEdit.php" method="post">
                                                                  <input type="submit" name="buttonSelectUser" class="btn btn-primary" value="<?php echo $tempUserID;?>"/>
                                                                  
                                                                  </form>
                                                                  </div>
                                                                <?php
                                                                  printf("<br>");
                                                          }
                                                      } else { //If interest has not been selected, do the standard search with filters
                                                          foreach($resultsFiltered as $r) {
                                                              $tempUserID = $r['UserID'];
                                                              $sql2 = "SELECT * FROM profile WHERE UserID = '$tempUserID'";
                                                              $results2 = mysqli_query($conn,$sql2);
                                                              $row2 = mysqli_fetch_array($results2);
                                                                  $tempMail = $row2['email'];
                                                                  getProfilePreview($tempMail);
                                                                  // printf('<form action="search.php" method="POST">')
                                                                  // </form>?>
                                                                  <div class="row justify-content-center">
                                                                  <form action="adminProfileEdit.php" method="post">
                                                                  <input type="submit" name="buttonSelectUser" class="btn btn-primary" value="<?php echo $tempUserID;?>"/>
                                                                  
                                                                  </form>
                                                                  </div>
                                                                <?php

                                                                  printf("<br>");
              					    }
                                                      }

                                                  } else {
                                                      echo "No results found";
                                                  }
              				 }


              			?>
                   </div>

</body>
</html>
