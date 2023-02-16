<?php


// $servername = "sql100.epizy.com";
// $username = "epiz_31242413";
// $password = "WbIh2OaPZju";
// $dbname = "epiz_31242413_testDB";
$servername = "sql100.epizy.com";
$username = "epiz_31242413";
$dbpassword = "WbIh2OaPZju";
$dbname = "epiz_31242413_project_database";

function createConnection($servername, $username, $dbpassword, $dbname) {

  $connection = new mysqli($servername, $username, $dbpassword, $dbname);
  //$connection = new mysqli("sql100.epizy.com", "epiz_31242413", "WbIh2OaPZju", "epiz_31242413_testDB");

  // Check connection
  if ($connection -> connect_error) {
   die("Connection failed: " . $connection ->connect_errno);
   //echo "Failed to connect to MySQL: " . $connection -> connect_error;
   exit();
  }else {
    // echo "Connected to DB successfully";
    // echo "<br>"; // break line
    // printf("Success... %s\n", mysqli_get_host_info($connection));
    // echo "<br>"; // break line
  }
  return $connection;
}

//echo getConnected();
 //$mysqli = createConnection("sql100.epizy.com", "epiz_31242413", "WbIh2OaPZju", "epiz_31242413_project_database");

 function closeConnection($connectionInstance){
   $connectionInstance->close();
 }

// $connection = new mysqli($servername, $username, $password, $dbname); //new mysqli     mysqli_connect
//
// // Check connection
// if ($connection -> connect_error) {
//  die("Connection failed: " . $connection ->connect_errno);
//  exit();
// }else {
//   echo "Connected to DB successfully";
//   echo "<br>"; // break line
//   printf("Success... %s\n", mysqli_get_host_info($connection));
//   echo "<br>"; // break line
// }

//$sql = "SELECT * FROM information_schema.tables;";





// $listdbtables = array_column($connection->query('SHOW TABLES')->fetch_all(),0);
// echo 'DB tables: ';
// echo '<pre>';
// print_r($listdbtables);
// echo '</pre>';
//
// $listdbprofile = array_column($connection->query('SHOW COLUMNS FROM profile;')->fetch_all(),0);
// echo 'Profile Table Schema: ';
// echo '<pre>';
// print_r($listdbprofile);
// echo '</pre>';
//
// $connection->close();

 ?>
