<?php
include('./includes/dbConfig.php');

$id = mysqli_real_escape_string($conn, $_POST['id']);
echo $id;
//if (!empty($_POST["id"])) {
//    $id = $_POST['id'];
//    $query = "select * from state where country_id=$id";
//    $result = mysqli_query($con, $query);
//    if ($result->num_rows > 0) {
//        echo '<option value="">Select State</option>';
//        while ($row = mysqli_fetch_assoc($result)) {
//            echo '<option value="' . $row['id'] . '">' . $row['state'] . '</option>';
//        }
//    }
//} elseif (!empty($_POST['sid'])) {
//    $id = $_POST['sid'];
//    $query1 = "select * from city where state_id=$id";
//    $result1 = mysqli_query($con, $query1);
//    if ($result1->num_rows > 0) {
//        echo '<option value="">Select city</option>';
//        while ($row = mysqli_fetch_assoc($result1)) {
//            echo '<option value="' . $row['id'] . '">' . $row['city'] . '</option>';
//        }
//    }
//}


?>