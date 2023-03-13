<?php
include('header.php');
if(isset($_REQUEST['id_number'],$_REQUEST['advert_no'] ))
{
$varIdNumber=$_REQUEST['id_number'];

$advert_number=$_REQUEST['advert_no'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>


<form  method="post" action="">
<?php 
$s1="SELECT * FROM vacancy WHERE advert_no='".$advert_number."'";
$resultS1=$conn->query($s1);
$arr1=mysqli_fetch_array($resultS1);
?>
<div class="card"></div>
<div class="card">
	<div class="card-header"><h4><strong>Vacancies Applied For</strong></strong></h4></div>
<div style="margin-left: 0%;" class="row display">
	<div class="form-group col-md-3">
	
	<label>Vacancy/Post</label>
	<p><?php echo $arr1['post_vacancy'];?></p>
</div>
<div class="form-group col-md-3">
<label>Advert No</label>
<p><?php echo $arr1['advert_no']; ?></p></div>



</div>



<?php 

$usersql="SELECT * FROM users WHERE id_number='$varIdNumber'";
$userresult=$conn->query($usersql);
$userrow=mysqli_fetch_array($userresult);
$phone_number=$userrow['phone_number'];
$user_email=$userrow['email'];

$sql="SELECT DISTINCT * FROM `applicant_details` WHERE `id_no`='$varIdNumber'";
	$result=$conn->query($sql);
	while($row = mysqli_fetch_array($result))
	{
		$varTitle=$row['title'];
		$varSurname=$row['S_name'];
		$varFirstName=$row['F_name'];
		$varOtherNames=$row['O_name'];
		$varBirthdate=$row['DOB'];
		$varIdNumber=$row['id_no'];
		$varGender=$row['gender'];
		$varNationality=$row['nationality'];
		$varCounty=$row['county'];
		$varSub_county=$row['sub_county'];
		$varConstituency=$row['constituency'];
		$varPostal_address=$row['postal_address'];
		$varPostal_code=$row['postal_code'];
		$varTown=$row['town'];
		$varMobile_no=$row['mobile_no'];
		$varEmail=$row['email'];
		$varAlt_person_name=$row['alt_person_name'];
		$varAlt_tel_no=$row['alt_tel_no'];
		$varDisability=$row['disability'];
		$varDisability_description=$row['disability_description'];
		$varKRA_pin=$row['KRA_pin'];
		$varCurrentEmployerName=$row['current_employer_name'];
		$varPositionHeld=$row['position_held'];
		$varEffectiveDate=$row['effective_date'];
		$varConvition=$row['convition'];
		$varConvitionDescription=$row['convition_description'];
		$varDismissed=$row['dismissed'];
		$varDismissedDescription=$row['dismissed_description'];
		$varDismissionDate=$row['dismission_date'];
		$varCorruption=$row['corruption'];
		$varCorruptionDescription=$row['corruption_description'];		
		$varGrossSalary=$row['gross_salary'];
		$varImageName=$row['image_name'];	
		
	}
?>


<div class="card"></div>
<div class="card">
	<div class="card">
	<div class="card-header"><h4><strong>Personal Details</strong></strong></h4></div>


	
	
	
<div style="margin-left: 0%;" class="row display">




<div class="form-group col-md-2">
	
	<label>Title</label>
	<p><?php echo $varTitle;?></p>
</div>
<div class="form-group col-md-2">
	
	<label>Name</label>
	<p><?php echo $varSurname." ".$varFirstName." ".$varOtherNames;?></p>
</div>
<div class="form-group col-md-2">
	
	<label>Date Of Birth</label>
	<p><?php echo $varBirthdate;?></p>
</div>
<div class="form-group col-md-2">
	
	<label>Id No</label>
	<p><?php echo $varIdNumber;?></p>
</div>
<div class="form-group col-md-2">
<label>KRA Pin</label>
	<p><?php echo $varKRA_pin ;?></p>
</div>
<div class="form-group col-md-2">
	
	<label>Gender</label>
	<p><?php echo $varGender;?></p>
</div>
</div>
<div style="margin-left: 0%;" class="row display">

<div class="form-group col-md-2">
	
	<label>Nationality</label>
	<p><?php echo $varNationality;?></p>
</div>
<div class="form-group col-md-2">
	
	<label>HomeCounty</label>
	<p><?php echo $varCounty;?></p>
</div>
<div class="form-group col-md-2">
	
	<label>Disability</label>
	<p><?php echo $varDisability;?></p>
</div>
<?php
$s3="SELECT * FROM `applicant_details` WHERE `id_no`='".$varIdNumber."'";
$resultS3=$conn->query($s3);
while($row = mysqli_fetch_array($resultS3))
	{
		$varDisability=$row['disability'];
		$varDisabilitydescription=$row['disability_description'];
		$varNO='NO';
		$varYES	='YES';	

		$varConvition=$row['convition'];
		$varConvitiondescription=$row['convition_description'];
		$varDismissed=$row['dismissed'];
		$varDismissedDescription=$row['dismissed_description'];
		$varDismissionDate=$row['dismission_date'];
		$varCorruption=$row['corruption'];
		$varCorruptionDescription=$row['corruption_description'];			
	}
			
	
  if($varDisability!=$varNO)
    {
	
?>

<div class="form-group col-md-2">
	
	<label>Disability Details</label>
	<p><?php echo $varDisability_description;?></p>
</div>
	<?php }
	?>
</div>
<div style="margin-left: 0%;" class="row display">
	<div class="form-group col-md-2">
	
	<label>Postal Address</label>
	<p><?php echo $varPostal_address;?></p>
</div>
	<div class="form-group col-md-2">
	
	<label>Code</label>
	<p><?php echo $varPostal_code;?></p>
</div>
<div class="form-group col-md-2">
	
	<label>Town/City</label>
	<p><?php echo $varTown;?></p>
</div>
<div class="form-group col-md-2">
	
	<label>Applicant Mobile No</label>
	<p><?php echo $phone_number;?></p>
</div>
<div class="form-group col-md-2">
	
	<label>Applicant Email</label>
	<p><?php echo $user_email;?></p>
</div>

</div>
<div style="margin-left: 0%;" class="row display">
<div class="form-group col-md-3">
	
	<label>Alternative contact person</label>
	<p><?php echo $varAlt_person_name;?></p>
</div>
<div class="form-group col-md-2">
	
	<label>Alternative contact person Telephone No</label>
	<p><?php echo $varAlt_tel_no;?></p>
</div>
<div class="form-group col-md-3">
	
	<label>Alternative contact person Email</label>
	<p><?php echo $varEmail;?></p>
</div>
	</div>
</div>

<div class="card">
<div class="card-header"><h4><strong>Employment Details</strong></strong></h4></div>
<div style="margin-left: 0%;" class="row display">
<table id="myTable" border="0"  class="table table-borderless" style="width:99%; border:none;">
  <thead>
    <tr class="table">
       <th style="width:7%; font-size:13px;" >Year:From</th>
      <th style="width:8%; font-size:13px;">Year:To</th>
      <th style=" width:20%; font-size:13px;">Designation</th>
      <th style="width:20%; font-size:13px;">Gross Monthly salary-Range</th>
	 
	  <th style="width:20%; font-size:13px;">Ministry/Department</th>
	</tr>
  </thead>
<tbody>

	<?php 	
$sql2="SELECT * FROM `employment_detail` WHERE `id_number`='".$varIdNumber."'";
$results2=$conn->query($sql2);
while($eaq=mysqli_fetch_array($results2))
{	
	$varDateFrom=$eaq['date_from'];
	$varDateTo=$eaq['date_to'];
	$varDesignationPosition=$eaq['designation_position'];
	$varJobGroup=$eaq['job_group'];
	$varGrossSalary=$eaq['gross_salary'];
	$varMinistry=$eaq['ministry'];
?>

		<tr>
				<td style="  width: 7%;  font-size:12px;"><?php echo $varDateFrom;?></td>
				<td style=" width: 8%;  font-size:12px;"><?php echo $varDateTo; ?></td>
				<td style=" width: 20%;  font-size:12px;"><?php echo $varDesignationPosition;?></td>
				<td style=" width: 20%;  font-size:12px;"><?php echo $varJobGroup;?></td>
				
				<td style=" width: 20%;  font-size:12px;"><?php echo $varMinistry;?></td>
			</tr>
		<?php  } ?>
		</tbody>
		</table>
</div>
</div>
</div>


<div class="card">
	<div class="card-header"><h4><strong>Work Details</strong></strong></h4></div>
	
	
<div class="card">
<?php
	$s3="SELECT * FROM `staffreg` WHERE `ID_Number`='".$varIdNumber."'";
$resultS3=$conn->query($s3);
while($row = mysqli_fetch_array($resultS3))
	{
		$varPayrollNum=$row['Payroll_Num'];
		$varStationName=$row['Station-Name'];
		$workcounty=$row['Work-County'];
		$stationcode=$row['Station-Code'];
		$desigcode=$row['Desig-Code'];
		$designame=$row['Desig-Name'];
		$paygroup=$row['Pay-Group'];
		$datehired=$row['Date-Hired'];

					
					
	}
			
	
  if($varPayrollNum>0)
    {
  ?>
<div class="card-header"><h4><strong>Applicants in the Teacher Service Commission</strong></strong></h4></div>
<?php 
?>
<div style="margin-left: 0%;" class="row display">
	<div class="form-group col-md-2">
	
	<label>TSC No</label>
	<p><?php echo $varPayrollNum;?></p>
</div>
<div class="form-group col-md-2">
	
	<label>Work County</label>
	<p><?php echo $workcounty;?></p></div>
	<div class="form-group col-md-2">
	
	<label>Station Code</label>
	<p><?php echo $stationcode;?></p>
</div>
	

<div class="form-group col-md-3">
	
	<label>Station Name</label>
	<p><?php echo $varStationName;?></p>
</div>
<div class="form-group col-md-2">
	
	<label>Date Hired</label>
	<p><?php echo $datehired;?></p>
</div>

</div><div style="margin-left: 0%;" class="row display">
	<div class="form-group col-md-2">
	
	<label>Designation Code</label>
	<p><?php echo $desigcode;?> </p>
</div>
<div class="form-group col-md-2">
	
	<label>Designation Name</label>
	<p><?php echo $designame;?> </p>
</div>
<div class="form-group col-md-2">
	
	<label>Pay Group</label>
	<p><?php echo $paygroup;?> </p>
</div>
</div>


<?php
  }
  else
  {
?>

<div class="card">
	<div class="card-header"><h4><strong>All Other Applicants</strong></strong></h4></div>
	
	
<?php 
$s4="SELECT * FROM  non_tsc_applicant WHERE id_number='".$varIdNumber."'";
$resultS4=$conn->query($s4);
$arr4=mysqli_fetch_array($resultS4);
?>
	
<div style="margin-left: 0%;" class="row display">
	<div class="form-group col-md-3">
	
	<label>Current employer</label>
	<p><?php echo $varCurrentEmployerName;?></p>
</div>
<div class="form-group col-md-3">
	
	<label>Position held</label>
	<p><?php echo $varPositionHeld;?></p>
</div>
<div class="form-group col-md-3">
	
	<label>Effective date</label>
	<p><?php echo $varEffectiveDate;?></p>
</div>
<div class="form-group col-md-3">
	
	<label>Gross Salary(monthly)Ksh</label>
	<p><?php echo $varGrossSalary;?></p>
</div>
</div>
</div>
<?php
  }
?>
</div>
   
<div class="card">
	<div class="card-header"><h4><strong>Other Personal Details</strong></strong></h4></div>
	<div style="margin-left: 0%;" class="row display">
<div class="form-group col-md-2">
	
	<label>Conviction</label>
	<p><?php echo $varConvition; ?></p>
</div>
<?php
$varNO='No';
$varYES	='Yes';	
 if($varConvition!=$varNO)
    {
?>



<div class="form-group col-md-2">
	
	<label>Nature of Offence</label>
	<p><?php echo $varConvitionDescription; ?></p>
</div>
<?php
	}
?>
<div class="form-group col-md-3">
	
	<label>Dismissal from Employment</label>
	<p><?php echo $varDismissed; ?></p>
</div>

<?php
$varNO='No';
$varYES	='Yes';	
 if($varDismissed!=$varNO)
    {
?>

	<?php
if($varDismissionDate!='1970-01-01')
{

	?>
<div class="form-group col-md-2">
	
	<label>Reasons for Dismissal</label>
	<p><?php echo $varDismissedDescription; ?></p>
</div>

<div class="form-group col-md-2">

	<label>Date of Dismissal</label>
	<p><?php echo $varDismissionDate; ?></p>
</div>
	<?php } }?>
</div>

<div style="margin-left: 0%;" class="row display">
<div class="form-group col-md-2">
	
	<label>Crime/Corruption</label>
	<p><?php echo $varCorruption ?></p>
</div>

<?php
$varNO='No';
$varYES	='Yes';	
 if($varCorruption!=$varNO)
    {
?>

<div class="form-group col-md-2">
	
	<label>Crime/Corruption details</label>
	<p><?php echo $varCorruptionDescription ?></p>
</div>

<?php
	}
	?>
</div>
</div>

<div class="card">
<div class="card-header"><h4><strong>Academic Qualification</strong></strong></h4></div>

<div style="margin-left: 0%;" class="row display">
<table id="myTable" border="0"  class="table table-borderless" style="width:99%; border:none;">
  <thead>
    <tr class="table-active">
       <th style="width: 5%;font-size:12px;" scope="col">Year:From</th>
      <th style="width: 8%;font-size:12px;" scope="col">Year:To</th>
      <th style="width: 20%;font-size:12px;" scope="col">University/High School</th>
      <th style="width: 20%;font-size:12px;" scope="col">Award</th>
      <th style="width: 20%;font-size:12px;" scope="col">Course</th>
	  <th style="width: 20%;font-size:12px;" scope="col">Specialization</th>
	</tr>
  </thead>
<tbody>
<?php
$sql2="SELECT * FROM `academic_qualification` WHERE `id_number`='".$varIdNumber."'";
$results2=$conn->query($sql2);

while($aq=mysqli_fetch_array($results2))
{	
$varDateFrom=$aq['date_from'];
$varDateTo=$aq['date_to'];
$varUniversity=$aq['university'];
$varAward=$aq['award'];
$varCourse=$aq['course'];
$varSpecialisation=$aq['specialisation'];
?>
	<tr>
				<td style="font-size:12px;"><?php echo $varDateFrom;?></td>
				<td style="font-size:12px;"><?php echo $varDateTo; ?></td>
				<td style="font-size:12px;"><?php echo $varUniversity;?></td>
				<td style="font-size:12px;"><?php echo $varAward;?></td>
				<td style="font-size:12px;"><?php echo $varCourse;?></td>
				<td style="font-size:12px;"><?php echo $varSpecialisation;?></td>
			</tr>
		<?php  } ?>

</tbody>
</table>
</div>
</div>


<div class="card">
<div class="card-header"><h4><strong>Professional/Technical Qualification</strong></strong></h4></div>
<div style="margin-left: 0%;" class="row display">
<table id="myTable" border="0"  class="table table-borderless" style="width:99%; border:none;">
  <thead>
    <tr class="table-active">
       <th style="width: 5%;font-size:12px;" scope="col">Year:From</th>
      <th style="width: 8%;font-size:12px;" scope="col">Year:To</th>
      <th style="width: 20%;font-size:12px;" scope="col">Institution</th>
      <th style="width: 10%;font-size:12px;" scope="col">Award</th>
      <th style="width: 10%;font-size:12px;" scope="col">Specialization</th>
       </tr>
  </thead>
<tbody>
	<?php
 $sql2="SELECT * FROM `professional_qualification` WHERE `id_number`='".$varIdNumber."'";
$results2=$conn->query($sql2);
while($aq=mysqli_fetch_array($results2))
{	
$varDateFrom=$aq['date_from'];
$varDateTo=$aq['date_to'];
$varInstitution=$aq['institution'];
$varAward=$aq['award'];
$varSpecialisation=$aq['specialization'];


?>
	<tr>
				<td style="width: 5%; font-size:12px;"><?php echo $varDateFrom;?></td>
				<td style="width: 8%; font-size:12px;"><?php echo $varDateTo; ?></td>
				<td style="width: 20%;  font-size:12px;"><?php echo $varInstitution;?></td>
				<td style="width: 10%;  font-size:12px;"><?php echo $varAward;?></td>
				<td style="width: 10%; font-size:12px;"><?php echo $varSpecialisation;?></td>
			</tr>
		<?php  } ?>
</tbody>
</table>
</div>
</div>


<div class="card">
<div class="card-header"><h4><strong>Courses and Training attended lasting not less than Two (2)week</strong></strong></h4></div>
<div style="margin-left: 0%;" class="row display">
<table id="myTable" border="0"  class="table table-borderless" style="width:99%; border:none;">
  <thead border="0">
    <tr border="0" class="table-active">
      <th style="width: 7%;font-size:12px;" scope="col">Date From</th>
      <th style="width: 8%;font-size:12px;" scope="col">Date To</th>
      <th style="width: 20%;font-size:12px;" scope="col">University/College</th>
      <th style="width: 20%;font-size:12px;" scope="col">Name Of Course</th>
      <th style="width: 20%;font-size:12px;" scope="col">Details and duration</th>
	</tr>
  </thead>
<tbody>
	<?php
$sql2="SELECT * FROM `relevant_courses` WHERE `id_number`='".$varIdNumber."'";
$results2=$conn->query($sql2);
while($caq=mysqli_fetch_array($results2))
{	
$vardatefrom=$caq['date_from'];
$vardateto=$caq['date_to'];
$varUniversity=$caq['university'];
$varCourseName=$caq['course_name'];
$varDetailsAndDuration=$caq['details_and_duration'];



?>

<tr border="0">
	<td border="0" style="width: 7%;  font-size:12px;"><?php echo $vardatefrom;?></td>
	<td border="0" style="width: 8%;  font-size:12px;"><?php echo $vardateto;?></td>
	<td style="width: 20%;  font-size:12px;"><?php echo $varUniversity; ?></td>
	<td style="width: 20%; font-size:12px;"><?php echo $varCourseName;?></td>
	<td style="width: 20%;  font-size:12px;"><?php echo $varDetailsAndDuration;?></td>
</tr>
		<?php  } ?>
</tbody>
</table>
</div>
</div>

<div class="card">
	<div class="card-header"><h4><strong>Membership to professional bodies</strong></strong></h4></div>
	
	<div style="margin-left: 0%;" class="row display">
	
<table id="myTable" border="0"  class="table table-borderless" style="width:98%; border:none;">
  <thead border="0">
    <tr border="0" class="table">
       <th style="width: 20%; font-size:12px;" scope="col">Professional Body</th>
      <th style="width: 20%; font-size:12px;" scope="col">Membership No</th>
      <th style="width: 20%; font-size:12px;" scope="col">Membership type</th>
      <th style="width: 20%; font-size:12px;" scope="col">Date of Renewal</th>
	</tr>
  </thead>
<tbody>
<?php
$sql2="SELECT * FROM `current_membership` WHERE `id_number`='".$varIdNumber."'";
$results2=$conn->query($sql2);
while($maq=mysqli_fetch_array($results2))
{	
$varProfessionBody=$maq['profession_body'];
$varMembershipNo=$maq['membership_no'];
$varMembershipType=$maq['membership_type'];
$varDateOfRenewal=$maq['date_of_renewal'];
	?>
			<tr border="0">
				<td style="width: 20%; font-size:12px;"><?php echo $varProfessionBody;?></td>
				<td style="width: 20%;  font-size:12px;"><?php echo $varMembershipNo; ?></td>
				<td style="width: 20%;  font-size:12px;"><?php echo $varMembershipType;?></td>
				<td style="width: 20%;  font-size:12px;"><?php echo $varDateOfRenewal;?></td>
			</tr>
		<?php  } ?>
</tbody>
</table>
</div>
</div>




	
<div class="card">
	<div class="card-header"><h4><strong>Competencies</strong></strong></h4></div>
	<?php 	
$sql="SELECT * FROM applicant_work_details WHERE id_number='".$varIdNumber."'";
$results=$conn->query($sql);
while($aq1=mysqli_fetch_array($results))
{


		//$string = rtrim(implode(',', $aq1), ',');
	$varDutiesAndResponsbillities=$aq1['duties_and_responsbillities'];
	$varCompetencies=$aq1['competencies'];
}
	?>
	<div style="margin-left: 0%;" class="row display">
<div class="form-group col-md-12">
	
	<label>Duties and Responsbilities</label>
	<p><?php echo $varDutiesAndResponsbillities;?></p>
</div>
</div>
<div style="margin-left: 0%;" class="row display">
<div class="form-group col-md-12">
	
	<label>Abilities</label>
	<p><?php echo $varCompetencies;?></p>
</div>
</div>
</div>
</div>
</div>

<form method="post" action="" style="">
	<div class="row">
		<div></div>

</form>

<!--<a href="secSeventeen.php" class="btn btn-warning" role="button">PRINT</a>-->

		<script>
function printFunction() {
    window.print();
}
</script>
<input onclick="printFunction()" class="btn btn-success" id="btnsuccess" type="submit"  value="PRINT" name="print"> 


<?php
$s1="SELECT * FROM vacancy WHERE advert_no='".$advert_number."'";
$resultS1=$conn->query($s1);
$arr1=mysqli_fetch_array($resultS1);
$vacancy_id=$arr1['vacancy_id'];
$post=$arr1['post_vacancy'];
$advertno=$arr1['advert_no'];
$directorate=$arr1['directorate'];

$phonesql="SELECT * FROM users WHERE id_number='".$varIdNumber."'";
$phoneresult=$conn->query($phonesql);
while ($row=mysqli_fetch_array($phoneresult)) {
	# code...

	$phonenumber=$row['phone_number'];
}
function sendTPayOTP($MSISDNTo, $Message)
{
  $Password = "dd2a2868f69dd54721922ae49acf57a7";
  $Host = "http://197.248.226.42:8080/sms/?";
  
  $Results = file($Host . "&api_key=".urlencode($Password)."&phone=".urlencode($MSISDNTo)."&message=".urlencode($Message));
  print_r($Results);
}
if(isset($_POST['submit']))
{
	$check_if_submitted="SELECT * FROM tblappliedjobs WHERE id_number='".$varIdNumber."' AND  advert_no='".$advert_number."'";
	$check_if_submitted_result=$conn->query($check_if_submitted);
	$check_submission=mysqli_fetch_array($check_if_submitted_result);
	$is_submitted=$check_submission['is_submitted'];

	
$s2='UPDATE tblappliedjobs SET status="Shortlisted" WHERE id_number="'.$varIdNumber.'" AND  advert_no="'.$advert_number.'"';
$resultS2=$conn->query($s2) or die(mysqli_error($conn));
sendTPayOTP($phonenumber, 'CONGRATULATIONS!!! You Have been Shortlisted for the Position of '.$post.', Advert Number '.$advertno.'');
//session_destroy($_SESSION['vacancy_id']);

		?>
		<script>
		
		window.alert('You Shortlisted Applicant ID:<?php echo $varIdNumber?> For Post <?php echo $post; ?> Advert Number <?php echo $advertno;?>');
        window.location.href='secFifteen.php';
		//alert("your application has been successfully submitted.Thank you.");
		</script>
		<?php
	}
		

?>
</body>
</html>