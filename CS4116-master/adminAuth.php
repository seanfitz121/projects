<?php
session_start();
require_once 'includes/dbh.inc.php';
$conn = createConnection("sql100.epizy.com", "epiz_31242413", "WbIh2OaPZju", "epiz_31242413_project_database");

function test_input($data) {

	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

$adminname = test_input($_POST['adminname']);
$adminpassword = test_input($_POST['password']);

if($conn->connect_error){
    die('Connection failed : '.$conn->connect_error);
} else {

    $stmt = $conn->prepare("SELECT * FROM admin");
    //$stmt->bind_param("s", $adminname);
    $stmt->execute();
    $users = $stmt->get_result();

    if($users->num_rows > 0){
      foreach($users as $row) {
        // echo "Name is ".$row['adminname']."<br>";
        if(($row['adminname'] == $adminname) &&
          ($row['password'] == $adminpassword)) {
            //header("location: adminPanel.php");
            //echo "login success";
            $_SESSION['adminloggedin'] = true;
            $_SESSION['username'] = $username;
            //$_SESSION['admin'] = true;
            // echo "Session variables are set.";
            // print_r($_SESSION);
            //header("location: adminPanel.php");
            if(!empty($_SESSION['adminloggedin'])){ header("location: adminPanel.php");}
        }
        else {
          //echo "login failed";
          echo "<script language='javascript'>";
          echo "alert('Incorrect Username or Password')";
          echo "</script>";
          die();
        }
      }
    }else {
      echo "<h1>Incorrect email/password</h1>";
    }
}
?>
