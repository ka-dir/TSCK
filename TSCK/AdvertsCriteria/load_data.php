<?php
include('../includes/dbConfig.php');

$id = mysqli_real_escape_string($conn, $_POST['id']);
$filter_type = mysqli_real_escape_string($conn, $_POST['filter_type']);
$results = "";
echo 'djkjkdjkf' . $filter_type;

//if ($filter_type == 1) {
//    $query = "select * from courses where award_id='$id'";
//    $result = mysqli_query($conn, $query);
//    if ($result->num_rows > 0) {
//        echo '<option value="">Select Course</option>';
//        while ($row = mysqli_fetch_assoc($result)) {
//            echo '<option value="' . $row['course_id'] . '">' . $row['course_desc'] . '</option>';
//        }
//    }
//}elseif ($filter_type == 2) {
//    $query = "select * from specialization where course_id='$id'";
//    $result = mysqli_query($conn, $query);
//    if ($result->num_rows > 0) {
//        echo '<option value="">Select Specialisation</option>';
//        while ($row = mysqli_fetch_assoc($result)) {
//            echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
//        }
//    }
//}elseif ($filter_type == 3) {
//    $query = "select * from specialization where award_id='$id'";
//    $result = mysqli_query($conn, $query);
//    if ($result->num_rows > 0) {
//        echo '<option value="">Select Specialisation</option>';
//        while ($row = mysqli_fetch_assoc($result)) {
//            echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
//        }
//    }
//}
//echo $results;

//function getCourses($id)
//{
//    global $conn;
//
//}


?>