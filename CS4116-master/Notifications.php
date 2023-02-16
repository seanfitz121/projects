<?php     
   require_once 'includes/dbh.inc.php';
   $conn = createConnection("sql100.epizy.com", "epiz_31242413", "WbIh2OaPZju", "epiz_31242413_project_database");

   //get userid of current user
   $tempUserID = $_SESSION['username'];
                $sql1 = "SELECT UserID FROM user WHERE Handle = '$tempUserID'";
                $results1 = mysqli_query($conn,$sql1);
                $row1 = mysqli_fetch_array($results1);
                $UserID = $row1['UserID'];

  //If a connection already exists with the user update the value of isAccepted to 1 
  $ifconnections = "SELECT * FROM connections WHERE userID2 = '$UserID'"; 
  $connectionresults = mysqli_query($conn,$ifconnections);
  if ($connectionresults){
     $stmt = $conn->prepare("UPDATE connections SET isAccepted = '1'  "); 
  }
  $sql = $conn->prepare("INSERT INTO connections (Connectionid, userID1, userID2, ConnectionDate, isAccepted) 
          values(?,?,?,?,?)"); 
  $sql->bind_param('iiibb', $UserID, )
  $sql->execute();
  $sql->close();

?>