<?php
session_start();
include('../includes/dbConfig.php');

// variable declaration
// advert_no
//post_vacancy is the post title
//no_of_post
//duDate is the closing date
//category is the select category
//job_description
//duties_and_responsibilities
//requirements
//pay_type
//currency
//basic_salary
//house_allowance
//commuter_allowance
//leave_allowance
//medical_scheme
// variables not from input form
//is_Closed
//advert_date
//DateTime


//if submit button is clicked
if(isset($_POST['btn_add_advert'])) {
	//receive all inputs
	//in the order of filling the form
	$advert_no = $_POST['advert_no'];
	$no_of_post = $_POST['no_of_post'];
	$pay_type = $_POST['pay_type'];
	$currency = $_POST['currency'];
	$basic_salary = $_POST['basic_salary'];
	$house_allowance = $_POST['house_allowance'];
	$commuter_allowance = $_POST['commuter_allowance'];
	$leave_allowance = $_POST['leave_allowance'];
	$medical_scheme = $_POST['medical_scheme'];
	$post_vacancy = $_POST['post_vacancy'];
	$duDate = $_POST['duDate'];
	$category = $_POST['category'];
	$job_description = $_POST['job_description'];
	$duties_and_responsibilities = $_POST['duties_and_responsibilities'];
	$requirements = $_POST['requirements'];


	mysqli_query($dbconnection,"INSERT INTO   vacancy (advert_no,post_vacancy,no_of_post,	duDate,category,job_description,duties_and_responsibilities,requirements,pay_type,currency,basic_salary,house_allowance,commuter_allowance,leave_allowance,medical_scheme)
	VALUES ('$advert_no','$post_vacancy','$no_of_post','$duDate','$category','$job_description','$duties_and_responsibilities','$requirements','$pay_type','$currency','$basic_salary','$house_allowance','$commuter_allowance','$leave_allowance','$medical_scheme')" );

	if(mysqli_affected_rows($dbconnection)>0)
	{
		echo 'Advert is Successfully Posted and Published </br>';
		echo '<a href="../adverts.php">Add Advert </a>';
		$_SESSION['message']="Advert is Successfully Posted and Published";
		$_SESSION['alert']="alert alert-success";

		header("Location:../adverts.php");
		exit();



	}
	else
	{
		$_SESSION['message']="Error Posting and Publishing Advert, Please Try Again";
		$_SESSION['alert']="alert alert-danger";

		header("Location:../adverts.php");
		exit();

	}



}

?>


