<!DOCTYPE html>
 <html>
 <head>
   <title>User Registration</title>
   <link rel="icon" href="images/uniConnectLogo.png" />
   
 </head>
 <body>

   <?php
   session_start();
   //if(!empty($_SESSION['loggedin'])){ header("location: home.php");}  //check if user already logged in


    $email = $_POST['email'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $surname = $_POST['surname'];
    $cpassword = $_POST['cpassword'];

    /*echo $email;
    echo $password;
    echo $firstname;
    echo $surname;*/

    require_once 'includes/dbh.inc.php';
    $conn = createConnection("sql100.epizy.com", "epiz_31242413", "WbIh2OaPZju", "epiz_31242413_project_database");

    if($conn->connect_error){
        die('Connection failed : '.$conn->connect_error);
    } else {
        if (empty($email)) {
          // code...
          echo "email is empty";
        } else if (empty($password)) {
          // code...
          echo "password is empty";
        } else if (empty($firstname)) {
          // code...
          echo "firstname is empty";
        } else if (empty($surname)) {
          // code...
          echo "surname is empty";
        } else if(empty($_POST['password']) || (preg_match("/^.*(?=.{8,32})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $_POST['password']) === 0)) {
            $errPass = '<p class="errText">Password must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit</p>';
            echo '<div class="alert alert-danger alert-dismissisble fade show" role="alert"><strong>Uh Oh! </strong>Password must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit
                  <a href="/index.php"><button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    Try Again
                    </button></a>
                    </div>'; 
        } else if($_POST['password'] != $_POST['cpassword']){      
            echo '<div class="alert alert-danger alert-dismissisble fade show" role="alert"><strong>Uh Oh! </strong>Passwords Do Not Match
                  <a href="/index.php"><button type="button" class="close" data-dismiss="alert" aria-label="Close" style="color:#FFFF00; font-size:20px; border:none">
                    Try Again
                    </button></a>
                    </div>';   
        } else {
            $stmt = $conn->prepare("insert into user(handle, Password, Firstname, Surname)
            values(?,?,?,?)");
            $stmt->bind_param("ssss",$email, $password, $firstname, $surname);
            $stmt->execute();
            header("Refresh:2; url=login.php");
            echo "User registered, redirecting to login";
            $stmt->close();
            $conn->close();
        }
    }
?>

 </body>
 </html>
