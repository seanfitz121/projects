<!DOCTYPE html>
<html>
<head>
    <title>Auth</title>
    <link rel="icon" href="images/uniConnectLogo.png" />
    <!-- <meta http-equiv = "refresh" content = "3; url = http://14-cs4116.infinityfreeapp.com/profilePage.php" /> -->
</head>
<body>
<?php
    session_start();
    if(!empty($_SESSION['loggedin'])){ header("location: home.php");}  //check if user already logged in
    // print_r($_POST);
    $email = $_POST['email'];
    $password = $_POST['password'];

    require_once 'includes/dbh.inc.php';
    $conn = createConnection("sql100.epizy.com", "epiz_31242413", "WbIh2OaPZju", "epiz_31242413_project_database");

    if($conn->connect_error){
        die('Connection failed : '.$conn->connect_error);
    } else {
        $stmt = $conn->prepare("select * from user where handle = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt_result = $stmt->get_result();
        if($stmt_result->num_rows > 0){
            $data = $stmt_result->fetch_assoc();
            if($data['Password'] === $password) {
                echo "<h1>Login Success</h1>";
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $email;
                $_SESSION['userID'] = $data['UserID'];
                echo "Session variables are set.";
                print_r($_SESSION);
                if(!empty($_SESSION['loggedin'])){ header("location: home.php");}
            } else {
                echo "<h1>Incorrect email/password</h1>";
            }
        } else {
            echo "<h1>Incorrect email/password</h1>";
        }
    }
?>
</body>
</html>
