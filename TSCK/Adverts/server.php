<?php 
include('../includes/dbConfig.php');
session_start();
// variable declaration
    $advert_no = "";
    $no_of_post = "";
    $pay_type = "";
    $currency = "";
    $basic_salary = "";
    $house_allowance = "";
    $commuter_allowance = "";
    $leave_allowance = "";
    $medical_scheme = "";
    $post_vacancy = "";
    $duDate = "";
    $category = "";
    $job_description = "";
    $duties_and_responsibilities = "";
    $requirements = "";

// connect to database
//$db = mysqli_connect('localhost', 'root', '', 'budgetsystem');
// REGISTER USER
if (isset($_POST['add_advert'])) {
    // receive all input values from the form
    echo $_POST['advert_no'];
    exit();
    $advert_no = mysqli_real_escape_string($conn, $_POST['advert_no']);
    $no_of_post = mysqli_real_escape_string($conn, $_POST['no_of_post']);
    $pay_type = mysqli_real_escape_string($conn, $_POST['pay_type']);
    $currency = mysqli_real_escape_string($conn, $_POST['currency']);
    $basic_salary = mysqli_real_escape_string($conn, $_POST['basic_salary']);
    $house_allowance = mysqli_real_escape_string($conn, $_POST['house_allowance']);
    $commuter_allowance = mysqli_real_escape_string($conn, $_POST['commuter_allowance']);
    $leave_allowance = mysqli_real_escape_string($conn, $_POST['leave_allowance']);
    $medical_scheme = mysqli_real_escape_string($conn, $_POST['medical_scheme']);
    $post_vacancy = mysqli_real_escape_string($conn, $_POST['post_vacancy']);
    $duDate = mysqli_real_escape_string($conn, $_POST['duDate']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $job_description = mysqli_real_escape_string($conn, $_POST['job_description']);
    $duties_and_responsibilities = mysqli_real_escape_string($conn, $_POST['duties_and_responsibilities']);
    $requirements = mysqli_real_escape_string($conn, $_POST['requirements']);


        $query = "INSERT INTO vacancy (advert_no, post_vacancy, no_of_post, duDate, category, job_description, duties_and_responsibilities, requirements, pay_type, currency, basic_salary, house_allowance, commuter_allowance, leave_allowance, medical_scheme) VALUES ('$advert_no', '$post_vacancy', '$no_of_post', '$duDate', '$category', '$job_description', '$duties_and_responsibilities', '$requirements', '$pay_type', '$currency', '$basic_salary', '$house_allowance', '$commuter_allowance', '$leave_allowance', '$medical_scheme')"
        $resultreg=$conn->query($query) or die( mysqli_error($conn));
					  
        header('location: ../adverts.php'); 
}
?>