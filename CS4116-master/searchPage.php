<?php
require_once 'includes/dbh.inc.php';
    $conn = createConnection("sql100.epizy.com", "epiz_31242413", "WbIh2OaPZju", "epiz_31242413_project_database");
    session_start();

    $search = $_POST['search'];
    $ageMin = $_POST['ageMin'];
    $ageMax = $_POST['ageMax'];
    $smoker = $_POST['smoker'];
    $gender = $_POST['gender'];
    $interests = $_POST['interestsSearch']; //Gets ID value of searched interest

    if($conn->connect_error){
        die('Connection failed : '.$conn->connect_error);
    } else {
        $sql = "SELECT * FROM user WHERE Firstname LIKE '%$search%' OR Surname LIKE '%$search%'";
        $results = mysqli_query($conn,$sql);
        
        //Filters
        if(isset($search)){ //Search bar + age set
            $sqlFiltered = "SELECT * FROM profile WHERE (Firstname LIKE '%$search%' OR Surname LIKE '%$search%')";
            if(isset($ageMax)){
                $sqlFiltered = $sqlFiltered .  " AND Age <= '$ageMax' AND Age >= '$ageMin'";
                if(isset($smoker)){
                    $sqlFiltered = $sqlFiltered . " AND Smoker = '$smoker'";
                    if(isset($gender)){
                        $sqlFiltered = $sqlFiltered . " AND Gender = '$gender'";
                    } 
                } else if(isset($gender)){
                    $sqlFiltered = $sqlFiltered . " AND Gender = '$gender'";
                }  
            }
            if(isset($interests)){ //Interests has been searched, do this
                $sqlInterests = "SELECT UserID FROM Interests WHERE InterestID = '$interests' OR InterestID2 = '$interests' OR InterestID3 = '$interests'";
                $resultsInterests = mysqli_query($conn,$sqlInterests); //This holds an object the UserIDs of whoever has this interest
                $tempFilterInterestsArray = array();
                foreach($resultsInterests as $tempRow1){
                    $tempFilterInterestsArray[] = $tempRow1['UserID'];
                } //Here we place the UserIDs of the interests search into an array for later

            }   
        }
        $tempFilterIDArray = array();
        $resultsFiltered = mysqli_query($conn,$sqlFiltered);
        foreach($resultsFiltered as $tempRow){
            $tempFilterIDArray[] = $tempRow['UserID'];
        } //Here we place the UserIDs of the filter search into an array for later 
    }
    
    
?>