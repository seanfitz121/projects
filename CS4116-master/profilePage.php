
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="images/uniConnectLogo.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Profile Page</title>
</head>
<style>

  body {
    background-color: #868c93;
}
}
  .wrapper{
    display: flex;
}
  .container {
  flex: 1;
  width: 100%;
  height: 100%;
  background: #FFF;
  border-radius: 5px;
  box-shadow: 0 0 5px rgba(0,0,0,.3);
  padding: 50px 50px;
  margin-top: 20px;
  }

  .containera {
  flex: .4;
  width: 200px;
  height: 725px;
  box-shadow: 0 0 5px rgba(0,0,0,.3);
  padding-top: 20px;
  padding-left: 15px;
  padding-bottom: 50px;
  margin-top: 30px;
  
  }


</style>


<body>
    <?php
        require_once 'includes/dbh.inc.php';
        $conn = createConnection("sql100.epizy.com", "epiz_31242413", "WbIh2OaPZju", "epiz_31242413_project_database");
        session_start();
        if(empty($_SESSION['loggedin'])){ header("location: login.php");} //if user not logged in, send to login
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
   <nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
   <div class="container-fluid">
   <a class= "navbar-brand" href="index.php"><img src="images/uniConnectLogo.png"></a>
   <button class="navbar-toggler" type="button" data-toggle="collapse"
    data-target="#navbarResponsive">
        <span class="navbar-toggler-icon"></span>
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

    <br>

<div class="wrapper">
    <div class="container">
        <div class="row">
        <div class="col" id="div1" style="border-radius: 25px;">
            <h5>Update User Profile</h5>
            <form action="editProfile.php" method="POST" enctype="multipart/form-data">

            <?php
                $currUser = $_SESSION['username'];

                $sql = "SELECT * FROM profile WHERE email = '$currUser'";

                $results = mysqli_query($conn,$sql);

                if($results){
                    if(mysqli_num_rows($results)>0){ //IF user has previously set up profile, this form shows with current profile values
                        while($row = mysqli_fetch_array($results)){
                            //print_r($row);
                            ?>
                                <div class="form-group">
                        <input type="text" class="form-control" id="email" name="email" placeholder="email" value="<?php echo $_SESSION['username'];?>" readonly="true" style="color:#808080"/>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="Firstname" name="Firstname" placeholder="First Name" value="<?php echo $row['Firstname'];?>"/>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="Surname" name="Surname" placeholder="Surname" value="<?php echo $row['Surname'];?>"/>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="age" name="age" placeholder="Age" value="<?php echo $row['Age'];?>"/>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="snapchat" name="snapchat" placeholder="Snapchat" value="<?php echo $row['Snapchat'];?>"/>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="instagram" name="instagram" placeholder="Instagram" value="<?php echo $row['Instagram'];?>"/>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="university" name="university" placeholder="University" value="<?php echo $row['Institution'];?>"/>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="course" name="course" placeholder="Course" value="<?php echo $row['Course'];?>"/>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="location" name="location" placeholder="Location" value="<?php echo $row['Location'];?>"/>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="occupation" name="occupation" placeholder="Occupation" value="<?php echo $row['Occupation'];?>"/>
                    </div>
                    <div class="form-group">
                    <label>Smoker</label>
                        <input type="checkbox" class="form-control" id="smoker" name="smoker" value="1"/>
                    </div>
                    <div class="form-group">
                    <label>Drinker</label>
                        <select name="drinker">
                            <option value="" selected disabled hidden>Select</option>
                            <option value="Constantly">Always</option>
                            <option value="Social Drinker">Sometimes</option>
                            <option value="No">Never</option>
                        </select>
                    </div>
                    <div class="form-group">
                    <label>Gender</label>
                        <select name="gender">
                            <option value="" selected disabled hidden>Select</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                    <label>Seeking</label>
                        <select name="seeking">
                            <option value="" selected disabled hidden>Select</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <!-- Description -->
                        <input type="text" name="description" class="form-control" id="description" placeholder="Describe yourself" value="<?php echo $row['Description'];?>"/>
                    </div>
                    <div class="form-group">
                        <input type="file" name="userImage" id="userImage" class="form-control" required/>
                        <label for="file">Choose an image</label>
                    </div>


                    <!-- INTERESTS -->
                    <div>
                    <div class="form-group">
                    <label>Interests</label>
                        <select name="interests">
                            <option value="" selected disabled hidden>Select</option>
                            <option value="0">Reading</option>
                            <option value="1">Working Out</option>
                            <option value="2">Gaming</option>
                            <option value="3">Walking</option>
                            <option value="4">Cooking</option>
                            <option value="5">Dancing</option>
                            <option value="6">Netflix</option>
                        </select>
                    </div>
                    <div class="form-group">
                    <label>Interests</label>
                        <select name="interests2">
                            <option value="" selected disabled hidden>Select</option>
                            <option value="7">Fishing</option>
                            <option value="8">Dogs</option>
                            <option value="9">Cats</option>
                            <option value="10">Music</option>
                            <option value="11">Art</option>
                            <option value="12">Coffee</option>
                            <option value="13">Soccer</option>
                        </select>
                    </div>
                    <div class="form-group">
                    <label>Interests</label>
                        <select name="interests3">
                            <option value="" selected disabled hidden>Select</option>
                            <option value="14">Movies</option>
                            <option value="15">Travel</option>
                            <option value="16">Beer</option>
                            <option value="17">Wine</option>
                            <option value="18">Politics</option>
                            <option value="19">Baking</option>
                            <option value="20">Photography</option>
                        </select>
                    </div>
                    </div>

                    <div class="form-group">
                        <input type="submit" name="buttonSubmitProfile" class="button" value="Save Details"/>
                    </div>
                            <?php
                        }
                    } else { //IF user hasnt set up profile, this form shows
                        ?>
                        <div class="form-group">
                        <input type="text" class="form-control" id="email" name="email" placeholder="email" value="<?php echo $_SESSION['username'];?>" readonly="true" style="color:#808080"/>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="Firstname" name="Firstname" placeholder="First Name" value="<?php echo $row['Firstname'];?>"/>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="Surname" name="Surname" placeholder="Surname" value="<?php echo $row['Surname'];?>"/>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="age" name="age" placeholder="Age" value="<?php echo $row['Age'];?>"/>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="snapchat" name="snapchat" placeholder="Snapchat" value="<?php echo $row['Snapchat'];?>"/>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="instagram" name="instagram" placeholder="Instagram" value="<?php echo $row['Instagram'];?>"/>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="university" name="university" placeholder="University" value="<?php echo $row['Institution'];?>"/>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="course" name="course" placeholder="Course" value="<?php echo $row['Course'];?>"/>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="location" name="location" placeholder="Location" value="<?php echo $row['Location'];?>"/>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="occupation" name="occupation" placeholder="Occupation" value="<?php echo $row['Occupation'];?>"/>
                    </div>
                    <div class="form-group">
                    <label>Smoker</label>
                        <input type="checkbox" class="form-control" id="smoker" name="smoker" value="1"/>
                    </div>
                    <div class="form-group">
                    <label>Drinker</label>
                        <select name="drinker">
                            <option value="" selected disabled hidden>Select</option>
                            <option value="Constantly">Always</option>
                            <option value="Social Drinker">Sometimes</option>
                            <option value="No">Never</option>
                        </select>
                    </div>
                    <div class="form-group">
                    <label>Gender</label>
                        <select name="gender">
                            <option value="" selected disabled hidden>Select</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                    <label>Seeking</label>
                        <select name="seeking">
                            <option value="" selected disabled hidden>Select</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <!-- Description -->
                        <input type="text" name="description" class="form-control" id="description" placeholder="Describe yourself" value="<?php echo $row['Description'];?>"/>
                    </div>
                    <div class="form-group">
                        <input type="file" name="userImage" id="userImage" class="form-control" required/>
                    </div>


                    <!-- INTERESTS -->
                    <div class="form-group">
                    <label>Interests</label>
                        <select name="interests">
                            <option value="" selected disabled hidden>Select</option>
                            <option value="0">Reading</option>
                            <option value="1">Working Out</option>
                            <option value="2">Gaming</option>
                            <option value="3">Walking</option>
                            <option value="4">Cooking</option>
                            <option value="5">Dancing</option>
                            <option value="6">Netflix</option>
                        </select>
                    </div>
                    <div class="form-group">
                    <label>Interests2</label>
                        <select name="interests2">
                            <option value="" selected disabled hidden>Select</option>
                            <option value="7">Fishing</option>
                            <option value="8">Dogs</option>
                            <option value="9">Cats</option>
                            <option value="10">Music</option>
                            <option value="11">Art</option>
                            <option value="12">Coffee</option>
                            <option value="13">Soccer</option>
                        </select>
                    </div>
                    <div class="form-group">
                    <label>Interests3</label>
                        <select name="interests3">
                            <option value="" selected disabled hidden>Select</option>
                            <option value="14">Movies</option>
                            <option value="15">Travel</option>
                            <option value="16">Beer</option>
                            <option value="17">Wine</option>
                            <option value="18">Politics</option>
                            <option value="19">Baking</option>
                            <option value="20">Photography</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="buttonSubmitProfile" class="button" value="Save Details"/>
                    </div>
                        <?php
                    }
                }
            ?>

                </div>
                </form>
        <div class="containera">
                <div class="col" id="div2" style="border-radius: 25px;">
                    <h5>Profile Preview</h5>
                    <?php
                        $currUser = $_SESSION['username'];
                        $sql = "SELECT * FROM profile WHERE email = '$currUser'";
                        $results = mysqli_query($conn,$sql);
                        if($results){
                            if(mysqli_num_rows($results)>0){ //IF user has profile, shows details
                                while($row = mysqli_fetch_array($results)){
                                //print_r($row);

                    ?>

                    <!-- Profile Pic preview -->

                    <?php
                        echo '<img src="'.$row['Photo'].'" alt="Profile Image" style="width: 250px; height: 250px; border: 1px solid black;">';
                    ?>


                    <br>
                    <!-- Name+surname -->

                    <!-- Age -->
                    <div style="width: 250px; background: rgba(0,0,255,0.3); border: 1px solid purple; border-radius: 2px; padding: 5px; margin-top: 20px;">
                    <?php echo $row['Age'] . "<br>";?>
                    </div>
                    <!-- University -->
                    <div style="width: 250px; background: rgba(0,0,255,0.3); border: 1px solid purple; border-radius: 2px; padding: 5px; margin-top: 5px;">
                    <?php echo $row['Institution'] . "<br>";?>
                    </div>
                    <!-- Course -->
                    <div style="width: 250px; background: rgba(0,0,255,0.3); border: 1px solid purple; border-radius: 2px; padding: 5px; margin-top: 5px;">
                    <?php echo $row['Course'] . "<br>";?>
                    </div>
                    <!-- Description -->
                    <div style="width: 250px; background: rgba(0,0,255,0.3); border: 1px solid purple; border-radius: 2px; padding: 5px; margin-top: 5px;">
                    <?php echo $row['Description'] . "<br>";?>
                    </div>

                    <?php
                                }
                            }
                        }
                    ?>
                    <?php
                        $currUser = $_SESSION['username'];
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
                    <h5>Interested In..</h5>
                    <div style="width: 250px; background: rgba(0,0,255,0.3); border: 1px solid purple; border-radius: 2px; padding: 5px; margin-top: 20px;">
                        <?php echo $tempIntID . "<br>";?>
                    </div>
                    <div style="width: 250px; background: rgba(0,0,255,0.3); border: 1px solid purple; border-radius: 2px; padding: 5px; margin-top: 20px;">
                        <?php echo $tempIntID2 . "<br>";?>
                    </div>
                    <div style="width: 250px; background: rgba(0,0,255,0.3); border: 1px solid purple; border-radius: 2px; padding: 5px; margin-top: 20px;">
                        <?php echo $tempIntID3 . "<br>";?>
                    </div>
                    <?php
                                }
                            }
                        }
                    ?>
                </div>
              </div>
              </div>
        </div>
        </div>
    <!--Footer-->
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
