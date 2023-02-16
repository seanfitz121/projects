<!DOCTYPE html>
 <html>
 <head>
    <title>Profile change</title>
    <meta http-equiv = "refresh" content = "2; url = http://14-cs4116.infinityfreeapp.com/adminPanel.php" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="images/uniConnectLogo.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
 </head>
 <body>

    <!-- Navbar-->
     <nav class="navbar navbar-dark bg-dark">
       <div class="container">
       <!-- <div class="navbar-header">
         <a class="navbar-brand" href="#">WebSiteName</a>
       </div> -->
       <a href="home.php" class="navbar-left"><img src="images/uniConnectLogo.png"></a>
       <ul class="nav navbar-nav">
         <li class="active"><a href="home.php">Home</a></li>
       </ul>
       <ul class="nav navbar-nav">
         <li><a href="connections.php">Matches</a></li>
       </ul>
       <ul class="nav navbar-nav">
         <li><a href="search.php">Search</a></li>
       </ul>
       <ul class="nav navbar-nav navbar-right">
         <li><a href="profilePage.php"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
         <!-- <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li> -->
         <form method="post">
             <input type="submit" name="buttonLogOut"
                     class="btn btn-primary" value="Log out" />
         </form>
       </ul>
     </div>
     </nav>

    <br>

   <?php
    require_once 'includes/dbh.inc.php';
    $conn = createConnection("sql100.epizy.com", "epiz_31242413", "WbIh2OaPZju", "epiz_31242413_project_database");
    session_start();

    //if(!empty($_SESSION['loggedin'])){ header("location: home.php");}  //check if user already logged in
    //$currUserID = $_SESSION['username'];
    $tempUserID = $_SESSION['selectedProfile'];
                $sql1 = "SELECT Handle FROM user WHERE UserID = '$tempUserID'";
                $results1 = mysqli_query($conn,$sql1);
                $row1 = mysqli_fetch_array($results1);
                $userEmail = $row1['Handle'];
    //echo $currUserID;
    //Profile Update Variables
    $firstName = $_POST['Firstname'];
    $surname = $_POST['Surname'];
    $age = $_POST['age'];
    $snapchat = $_POST['snapchat'];
    $instagram = $_POST['instagram'];
    $university = $_POST['university'];
    $course = $_POST['course'];
    $location = $_POST['location'];
    $occupation = $_POST['occupation'];
    $course = $_POST['course'];
    $location = $_POST['location'];
    $smoker = 0;
        if($_POST['smoker'] == 1){
            $smoker = 1;
        }
    $drinker = $_POST['drinker'];
    $gender = $_POST['gender'];
    $seeking = $_POST['seeking'];
    $description = $_POST['description'];
    $InterestID = $_POST['interests'];
    $InterestID2 = $_POST['interests2'];
    $InterestID3 = $_POST['interests3'];

    //Upload file + path
    $targetDirectory = "userImages/";
    if(isset($_FILES['userImage'])){
            $targetFile = $targetDirectory . basename($_FILES["userImage"]["name"]);
    } else {
        $targetFile = $targetDirectory . "defaultProfilePic.png";
    }
    
    $uploadSuccess = 1;
    $fileTypesAllowed = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

    
    if($fileTypesAllowed != "jpg" && $fileTypesAllowed != "png" && $fileTypesAllowed != "jpeg"){
        echo "<p><center>File type not allowed</center></p>";
        $uploadSuccess = 0;
    }
    if($uploadSuccess == 0){
        echo "<p><center>File was not uploaded</center></p>";
    } else {
        if(move_uploaded_file($_FILES["userImage"]["tmp_name"], $targetFile)){
            
        } else {   
            echo "<center><p>There was an issue with uploading the file</center></p>";
        }
    }


    if($conn->connect_error){
        die('Connection failed : '.$conn->connect_error);
    } else {
        $sql = "SELECT * FROM profile WHERE UserID = '$tempUserID'";
        $results = mysqli_query($conn, $sql);
        if($results){
            if(mysqli_num_rows($results)>0){ //IF UserID exists in profile table, update data in corresponding row
                if(empty($_FILES['userImage'])){
                    $stmt = $conn->prepare("UPDATE profile SET Firstname = '$firstName', Surname = '$surname', Age='$age', Smoker='$smoker', Drinker='$drinker', Gender='$gender', Seeking='$seeking', Institution='$university',                                               Course='$course', Location='$location', Instagram='$instagram', Snapchat='$snapchat', Occupation='$occupation', Description='$description', email='$userEmail' WHERE UserID='$tempUserID'");
                } else {
                    $stmt = $conn->prepare("UPDATE profile SET Firstname = '$firstName', Surname = '$surname', Age='$age', Smoker='$smoker', Drinker='$drinker', Gender='$gender', Seeking='$seeking', Institution='$university',                                               Course='$course', Location='$location', Instagram='$instagram', Snapchat='$snapchat', Occupation='$occupation', Description='$description', email='$userEmail', Photo='$targetFile' WHERE UserID='$tempUserID'");
                }
                $stmt->execute();
                echo "<center><p>User Profile Updated</center></p>";
                $stmt->close();

                
            } else { //ELSE UserID doesnt exist, insert new row
                $stmt = $conn->prepare("INSERT INTO profile (UserID, Firstname, Surname, Age, Smoker, Drinker, Gender, Seeking, Institution, Course, Location, Instagram, Snapchat, Occupation, Description, email, Photo)
                    values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                $stmt->bind_param('issiisssssssssbss',$tempUserID, $firstName, $surname, $age, $smoker, $drinker, $gender, $seeking, $university, $course, $location, $instagram, $snapchat, $occupation, $description, $userEmail, $targetFile);
                $stmt->execute();
                echo "<center><p>User Profile Updated!</center></p>";
                $stmt->close();
                
            }
        }
    }
    if($conn->connect_error){
        die('Connection failed : '.$conn->connect_error);
    } else {
        $sql = "SELECT * FROM Interests WHERE UserID = '$tempUserID'";
        $results = mysqli_query($conn, $sql);
        if($results){
            if(mysqli_num_rows($results)>0){ //IF UserID exists in Interests table, update data in corresponding row
                $stmt = $conn->prepare("UPDATE Interests SET InterestID='$InterestID', InterestID2 = '$InterestID2', InterestID3 = '$InterestID3' WHERE UserID='$tempUserID'");
                $stmt->execute();
                $stmt->close();
            } else { //ELSE UserID doesnt exist, insert new row
                $stmt = $conn->prepare("INSERT INTO Interests (UserID, InterestID, InterestID2, InterestID3)
                    values(?,?,?,?)");
                $stmt->bind_param('iiii',$tempUserID, $InterestID, $InterestID2, $InterestID3);
                $stmt->execute();
                $stmt->close();
            }
        }
        $conn->close();
    }
?>

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