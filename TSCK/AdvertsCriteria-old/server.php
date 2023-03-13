<?php 
include('../includes/dbConfig.php');
session_start();


// variable declaration
$idnumber = "";
$phonenumber = "";
$email = "";
$errors = array();
$_SESSION['success'] = "";
$_SESSION['OTPMessage']="";

// connect to database
//$db = mysqli_connect('localhost', 'root', '', 'budgetsystem');
// REGISTER USER
if (isset($_POST['add_criteria'])) {
    // receive all input values from the form
    $advert_id = mysqli_real_escape_string($conn, $_POST['advert_id']);
    $criteria_type = mysqli_real_escape_string($conn, $_POST['criteria_type']);
    $award = mysqli_real_escape_string($conn, $_POST['award']);
    $course = mysqli_real_escape_string($conn, $_POST['course']);
    $specialization = mysqli_real_escape_string($conn, $_POST['specialization']);


        $query = "INSERT INTO `advert_criteria` (`vacancy_id`,`criteria_type_id`, `award_id`, `course_id`,specialization_id) 
					  VALUES('$advert_id','$criteria_type', '$award', '$course','$specialization')";
					  $resultreg=$conn->query($query) or die( mysqli_error($conn));
   
					  
        header('location: ../adverts-criteria.php?id='.$advert_id);  
    
   
    
}

if (isset($_POST['otpverify'])) {

    # code...
    //Receive input from the form
    $otp = mysqli_real_escape_string($conn, $_POST['otp_code']);
    $password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);

    //validates form
    if (empty($password_1)) {
        array_push($errors, "Password is required");
    }

    //Confirms Password
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }

    //Verifies if OTP code is already in use
    if ($otp != $_SESSION['OTP']) {
        # code...
        array_push($errors, "Please Enter Valid Code");
    }


    // updates user password after verifying OTP
    if (count($errors) == 0) {
        $password = md5($password_1); //encrypt the password before saving in the database
        $passwordquery = "UPDATE users SET password='$password' WHERE id_number='" . $_SESSION['id_number'] . "'";
        $resultpassword = mysqli_query($conn, $passwordquery);
        if ($resultpassword) {
            $_SESSION['success'] = "You are now logged in";
            header('location:../secA.php');
        } else {

            array_push($errors, "Please you havent created your password,Thank you");
        }
    }
}




?>