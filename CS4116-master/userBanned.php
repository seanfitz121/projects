<?php
    require_once 'includes/dbh.inc.php';
    $conn = createConnection("sql100.epizy.com", "epiz_31242413", "WbIh2OaPZju", "epiz_31242413_project_database");
    session_start();
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
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<p>User banned, please sign out.</p>

<form method="post">
             <input type="submit" name="buttonLogOut"
                     class="btn btn-primary" value="Logout" />
</form>
</body>
</html>