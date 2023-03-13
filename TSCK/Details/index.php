<?php 
include ('header.php');
$encode_advertno=$_GET['n'];
$advertno=$_GET['id'];
$advert_no=base64_decode($encode_advertno);

$detailssql="SELECT * FROM vacancy WHERE advert_no='".$advert_no."'";
$result=$conn->query($detailssql);
$row=mysqli_fetch_array($result);
	# code...
	$vacancyid=$row['vacancy_id'];
	$category=$row['category'];
	$advertno=$row['advert_no'];
	$post_vacancy=$row['post_vacancy'];
	$no_of_post=$row['no_of_post'];
	$job_description=$row['job_description'];
	$duties_and_responsbilities=$row['duties_and_responsibilities'];
	$requirements=$row['requirements'];
	$paytype=$row['pay_type'];
	$basic_salary=$row['basic_salary'];
	$house_allowance=$row['house_allowance'];
	$commuter_allowance=$row['commuter_allowance'];
	$leave_allowance=$row['leave_allowance'];
	$medical_scheme=$row['medical_scheme'];
	$due_date=$row['duDate'];
	$date=date('d-m-Y',strtotime($due_date));

	
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 	
 </head>
 <body style="margin-top: -6%; margin-left: -13%;">
 
 
 
<div class="main-content">


 
 <h3 style="margin-left: 2%;background-color: green;color: whitesmoke"  >VACANCY: <?php echo $post_vacancy; ?></h3>
 <h3 style="margin-left: 2%; background-color: darkorange; color: black">CATEGORY: <?php echo $category; ?></h3>

 <div class="card" style="margin-top: -1%; margin-bottom:3%;">
 	

 	<div class="card-title"></div>
 	<div style="margin-left: 2%; margin-top: 3%; margin-bottom: 3%;">
 	<div class="block" style="margin-top: 2%;">
 		
 	</div>
 
 	<div class="block">
 		<p><strong>Advert Number:</strong>
 		<?php echo $advertno; ?></p>
 	</div>
 	<div class="block">
 		<p><strong>No of Posts:</strong>
 		<?php echo $no_of_post; ?></p>
 	</div>
 	<div class="row">
 		<div class="form-row col-md-12">
 			<p><strong>Job Description</strong></p>
 			<p><?php echo $job_description; ?></p>
 		</div>

 	</div>
 		<div class="row">
 		<div class="form-row col-md-12">
 			<p><strong>Duties and Responsbilities</strong></p>
 			<p><?php echo $duties_and_responsbilities; ?></p>
 		</div>

 	</div>
 	<div class="row">
 		<div class="form-row col-md-12">
 			<p><strong>Requirements</strong></p>
 			<p><?php echo $requirements; ?></p>
 		</div>

 	</div>

 <p><strong>Remuneration Package:</strong></p>
 	<div class="block">
 		<p><strong><i>Basic Salary:</i></strong>
 		<?php echo $basic_salary; ?></p>
 	</div>
 	<div class="block">
 		<p><strong><i>House Allowance:</i></strong>
 		<?php echo $house_allowance; ?></p>
 	</div>
 	<div class="block">
 		
 		<p><strong><i> Commuter Allowance:</i></strong>
 		<?php echo $commuter_allowance; ?></p>
 	</div>
 
 	<div class="block">
 		<p><strong><i>Leave Allowance:</i></strong>
 		<?php echo $leave_allowance; ?></p>
 	</div>

 
 	<div class="block">
 		<p><strong><i>Medical Cover:</i></strong>
 		<?php echo $medical_scheme; ?></p>
 	</div>
 		<div class="block">
 		<p>This Position will Close on  
 		<strong><?php echo $date; ?></strong></p>
 	</div>
	</div>
 </div>
 <div class="row">
	<div class="form-group col-md-4">
     	



<a href="./secOne.php" role="button" style="background-color:#314C95;" class="btn btn-success pull-left" style="margin-left:2%;"><< Back to Vacancies</a>
</div>

 </div>
 </body>
 </html>
