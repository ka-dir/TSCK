<?php
// Include the database config file
include_once 'header.php';

if(!empty($_POST["id"])){
    // Fetch state data based on the specific country
    $query = "SELECT * FROM courses WHERE id = ".$_POST['id']." ";
    $result = $db->query($query);

    // Generate HTML of state options list
    if($result->num_rows > 0){
        echo '<option value="">Select Courses!</option>';
        while($row = $result->fetch_assoc()){
            echo '<option value="'.$row['$course_id'].'">'.$row['$course_desc'].'</option>';
        }
    }else{
        echo '<option value="">Courses not available</option>';
    }
}
