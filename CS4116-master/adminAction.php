<?php

require_once 'includes/dbh.inc.php';
        $conn = createConnection("sql100.epizy.com", "epiz_31242413", "WbIh2OaPZju", "epiz_31242413_project_database");
        session_Start();    
        $selectedProfileDel = $_SESSION['selectedProfile'];
  if(isset($_POST['deleteUser'])){
    //$sqlDel = "DELETE FROM user WHERE UserID = '$_SESSION['selectedProfile']';
    //            DELETE FROM profile WHERE UserID = '$_SESSION['selectedProfile']';
    //            DELETE FROM Interests WHERE UserID = '$_SESSION['selectedProfile']';
    //            DELETE FROM Connections WHERE userID1 = '$_SESSION['selectedProfile']' OR userID2 = '$_SESSION['selectedProfile']'";

    

    $sqlDel = "DELETE FROM user WHERE UserID = '$selectedProfileDel';
               DELETE FROM profile WHERE UserID = '$selectedProfileDel';
               DELETE FROM Interests WHERE UserID = '$selectedProfileDel';
               DELETE FROM Connections WHERE userID1 = '$selectedProfileDel' OR userID2 = '$selectedProfileDel'";
    $conn->query($sqlDel);
    
    //echo "User Deleted";
    header("location: adminPanel.php");
  }

  if(isset($_POST['banUser'])){
      $stmt = $conn->prepare("UPDATE profile SET Banned = 1 WHERE UserID = '$selectedProfileDel'");
      $stmt->execute();
      $stmt->close();
      echo "User Banned, redirecting...";
      header( "refresh:3;url=adminPanel.php" );
  }
  if(isset($_POST['unbanUser'])){
      $stmt = $conn->prepare("UPDATE profile SET Banned = 0 WHERE UserID = '$selectedProfileDel'");
      $stmt->execute();
      $stmt->close();
      echo "User Unbanned, redirecting...";
      header( "refresh:3;url=adminPanel.php" );
  }
 ?>
