<?php

include('header.php');


$varIdNumber=$_SESSION['id_number'];
//echo $varIdNumber;

if(isset($_POST['submit']))
{
//part1
$_SESSION['vacancy_id'];
//part2	
$varIdNumber=$_SESSION['id_number'];
//echo $varIdNumber;
//part3	
$_SESSION['tscid'];
//part4	
$_SESSION['currentEmployer'];
$_SESSION['positionHeld'];
$_SESSION['EffectiveDate'];
$_SESSION['GrossSalary'];
//part5
$_SESSION['convicted'];
$_SESSION['textarea1'];
$_SESSION['dismissed'];
$_SESSION['textarea2'];
$_SESSION['dismissalDate'];
$_SESSION['NONtscid'];
//echo $id_number;

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
include('includes/topsection.php');
$sql="
SELECT DISTINCT
a.title,a.S_name,a.F_name,a.O_name,a.DOB,a.id_no,a.gender,a.nationality,a.county,a.sub_county,
a.constituency,a.postal_address,a.postal_code,a.town,a.email,a.alt_person_name,a.alt_tel_no,a.disability,
a.disability_description,a.KRA_pin,a.current_employer_name,a.position_held,a.effective_date,
a.convition,a.convition_description,a.dismissed,a.dismissed_description,a.dismission_date,
a.corruption,a.corruption_description,a.gross_salary,u.phone_number
FROM applicant_details as a JOIN users as u ON a.id_no=u.id_number
WHERE a.id_no='".$varIdNumber."'";
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
		$varMobile_no=$row['phone_number'];
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
		//$varImageName=$row['image_name'];	
		
	}
?>

<?php

$s1="SELECT * FROM vacancy WHERE vacancy_id='".$_SESSION['vacancy_id']."'";


$resultS1=$conn->query($s1);
$arr1=mysqli_fetch_array($resultS1);
?>
<div class="card"></div>
<div class="card">
	<div class="card-header"><h4><strong>Vacancies Applied For</strong></strong></h4></div>
<div style="margin-left: 0%;" class="row display">
	<div class="form-group col-md-3">
	
	<label>Vacancy/Post</label>
	<p><?php 
	//variableVACANCY
	echo $arr1['post_vacancy'];
	
	
	//echo $arr1['vacancy_id'];
	
	if($arr1['vacancy_id']<1)
	{
					echo '<div>';
						//echo"no match found";
					echo "<script>alert('ERROR: Kindly Select a Vacancy!');
					window.location.href='secOne.php';
					</script>";
					echo '</div>';
	}	
	
	
	?></p>
</div>
<div class="form-group col-md-3">
<label>Advert No</label>
<p>
<?php 
//variableADVERTNUMBER
echo $arr1['advert_no']; 

?>

</p></div>

<div class="form-group col-md-3">
<label>Due Date</label>
<p>
<?php 
//variableDUEDATE
$arr1['duDate']; 
$DUEDATE=$arr1['duDate']; 
echo $DUEDATE;


?>

</p></div>


</div>

<div class="card">
	<div class="card-header"><h4><strong>Personal Details Of The Applicant</strong></strong></h4></div>


	
	
	
<div style="margin-left: 0%;" class="row display">


<div class="form-group col-md-2">
	
	<label>Name</label>
	<p>
	<?php
	//variableNAME
	echo $varTitle." ". $varSurname." ".$varFirstName." ".$varOtherNames;?>
	</p>
</div>
<div class="form-group col-md-2">
	
	<label>AGE</label>
	<p>
	<?php
    //variableDATEOFBIRTH

    $from = new DateTime($varBirthdate);
    $to = new DateTime($DUEDATE);
    $AGE=$from->diff($to)->y;
    echo $AGE;


/*
 $varBirthdate;
 $AGE=$DUEDATE-$varBirthdate;
 echo $AGE;*/
	?>
	</p>
</div>

<div class="form-group col-md-2">
	
	<label>Id No</label>
	<p>
		<?php 
		//variableIDNO
		echo $varIdNumber;
		?>
	</p>
</div>
<div class="form-group col-md-2">
<label>KRA Pin</label>
	<p>
	<?php
//variableKRAPIN
	echo $varKRA_pin ;?>
	</p>
</div>
<div class="form-group col-md-2">
	
	<label>Gender</label>
	<p>
		<?php 
		//variableGENDER
		echo $varGender;?>
	</p>
</div>
</div>
<div style="margin-left: 0%;" class="row display">

<div class="form-group col-md-2">
	
	<label>Nationality</label>
	<p>
	<?php 
	//variableNATIONALITY
	echo $varNationality;?>
	</p>
</div>
<div class="form-group col-md-2">
	
	<label>HomeCounty</label>
	<p>
	<?php 
	//variableHOMECOUNTY
	echo $varCounty;?>
	</p>
</div>
<div class="form-group col-md-2">
	
	<label>Disability</label>
	<p>
	<?php 
	//variable1DISABILITY
	echo $varDisability;?>
	</p>
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
	<p>
	<?php 
	//variableDISABILITYDESCRIPTION
	echo $varDisability_description;?>
	</p>
</div>
	<?php 
	}
	?>
</div>
<div style="margin-left: 0%;" class="row display">
	<div class="form-group col-md-2">
	
	<label>Postal Address</label>
	<p>
	<?php
	//variablePOSTALADDRESS
	echo $varPostal_address;?>
	</p>
</div>
	<div class="form-group col-md-2">
	
	<label>Code</label>
	<p>
	<?php 
	//variablePOSTALCODE
	echo $varPostal_code;?>
	</p>
</div>
<div class="form-group col-md-2">
	
	<label>Town/City</label>
	<p>
	<?php
	//variableTOWN
	echo $varTown;?>
	</p>
</div>
<div class="form-group col-md-2">
	
	<label>Mobile No</label>
	<p>
	<?php
	//variableMOBILENO
	echo $varMobile_no;?>
	</p>
</div>

</div>
<div style="margin-left: 0%;" class="row display">
<div class="form-group col-md-3">
	
	<label>Alternative contact person</label>
	<p>
	<?php 
	//variableALTERNATIVEPERSONAlt_person_name
	echo $varAlt_person_name;
	?>
	</p>
</div>
<div class="form-group col-md-2">
	
	<label>Telephone No</label>
	<p>
	<?php 
	//variableALTERNATIVEPERSONAlt_tel_no
	echo $varAlt_tel_no;?>
	</p>
</div>
<div class="form-group col-md-3">
	
	<label>Email</label>
	<p>
	<?php
	//variableALTERNATIVEPERSONEmail
	echo $varEmail;?>
	</p>
</div>
	</div>
</div>

<!---	
<div class="card">
	<div class="card-header"><h4><strong>Work Details</strong></strong></h4></div>
	
	
<div class="card">
<?php
	$s3="SELECT * FROM `staffreg` WHERE `ID-Number`='".$varIdNumber."'";
$resultS3=$conn->query($s3);
while($row = mysqli_fetch_array($resultS3))
	{
		$varPayrollNum=$row['Payroll-Num'];
		$varStationName=$row['Station-Name'];
					
	}
			
	
  if($varPayrollNum>0)
    {
  ?>
<div class="card-header"><h4><strong></strong></strong></h4></div>
<?php 
?>
<div style="margin-left: 0%;" class="row display">
	<div class="form-group col-md-2">
	
	<label>TSC No</label>
	<p><?php echo $varPayrollNum;?></p>
</div>
<div class="form-group col-md-2">
	
	<label>Directorate</label>
	<p><?php echo " ";?></p>
</div>
<div class="form-group col-md-2">
	
	<label>Station</label>
	<p><?php echo $varStationName;?></p>
</div>
<div class="form-group col-md-2">
	
	<label>Present Post</label>
	<p><?php echo "";?></p>
</div>
<div class="form-group col-md-2">
	
	<label>Job group/Scale/Grade</label>
	<p><?php echo"";?> </p>
</div>
<div class="form-group col-md-2">
	
	<label>Date Of Apointment</label>
	<p><?php echo " ";?> </p>
</div>
</div>

<?php
  }
  else
  {
?>

<div class="card">
	<div class="card-header"><h4><strong></strong></strong></h4></div>
	
	
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

</div>

<?php
  }
?>
</div>-->
<div class="card">
<div class="card-header"><h4><strong>Employment Details</strong></strong></h4></div>
<div style="margin-left: 0%;" class="row display">
<table id="myTable" border="0"  class="table table-borderless" style="width:99%; border:none;">
  <thead>
    <tr class="table-active">
       <th style=" width: 20%;font-size:12px;" scope="col">Year:From</th>
      <th style="width: 20%;font-size:12px;" scope="col">Year:To</th>
      <th style=" width: 20%;font-size:12px;" scope="col">Designation</th>
      <th style="width: 20%;font-size:12px;" scope="col">Gross Monthly Salary Range</th>
	
	  <th style="width: 20%;font-size:12px;" scope="col">Ministry/Department</th>
	</tr>
  </thead>
<tbody>

	<?php 	
$TotalYearsWorked= 0;
$sql2="SELECT * FROM `employment_detail` WHERE `id_number`='".$varIdNumber."'ORDER BY date_to DESC";
$results2=$conn->query($sql2);
while($eaq=mysqli_fetch_array($results2))
{	
	$varDateFrom=$eaq['date_from'];
	$varDateTo=$eaq['date_to'];
	$varDesignationPosition=$eaq['designation_position'];
	$varJobGroup=$eaq['job_group'];
	$varGrossSalary=$eaq['gross_salary'];
	$varMinistry=$eaq['ministry'];
	$diff = abs(strtotime($varDateTo) - strtotime($varDateFrom));

/*$years = floor($diff / (365*60*60*24));
$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
$days = floor(($diff- $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
printf("%d years, %d months, %d days\n", $years, $months, $days);*/

$TotalYearsWorked+=$diff;
?>

		<tr>
				<td style="  width: 20%;  font-size:12px;">
				<?php 
				//variableEMPLOYMENTDETAILSDateFrom
				echo $varDateFrom;?>
				</td>
				<td style=" width: 20%;  font-size:12px;">
				<?php 
				//variableEMPLOYMENTDETAILSDateTo
				echo $varDateTo; ?>
				</td>
				<td style=" width: 20%;  font-size:12px;">
				<?php 
				//variableEMPLOYMENTDETAILSDesignationPosition
				echo $varDesignationPosition;?>
				</td>
				<td style=" width: 20%;  font-size:12px;">
				<?php 
				//variableEMPLOYMENTDETAILSJobGroup
				echo $varJobGroup;?>
				</td>
			
				<td style=" width: 20%;  font-size:12px;">
				<?php
				//variableEMPLOYMENTDETAILSMinistry
				echo $varMinistry;?>
				</td>
			</tr>
		<?php
		} 
$years = floor($TotalYearsWorked / (365*60*60*24));
$months = floor(($TotalYearsWorked - $years * 365*60*60*24) / (30*60*60*24));
$days = floor(($TotalYearsWorked - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
printf("%d years, %d months, %d days\n", $years, $months, $days);
		
		?>
		</tbody>
		</table>
</div>
</div>
</div>
   
<div class="card">
	<div class="card-header"><h4><strong>Other Personal Details</strong></strong></h4></div>
	<div style="margin-left: 0%;" class="row display">
<div class="form-group col-md-2">
	
	<label>Conviction</label>
	<p>
	<?php 
	//variableCONVICTION
	echo $varConvition; ?>
	</p>
</div>
<?php
$varNO='NO';
$varYES	='YES';	
 if($varConvition!=$varNO)
    {
?>



<div class="form-group col-md-2">
	
	<label>Nature of Offence</label>
	<p><?php
	//variableNATUREOFOFFENCE
	echo $varConvitionDescription; 
	?></p>
</div>
<?php
	}
?>
<div class="form-group col-md-3">
	
	<label>Dismissal from Employment</label>
	<p>
	<?php
	//variableDISMISSED
	echo $varDismissed; ?>
	</p>
</div>

<?php
$varNO='NO';
$varYES	='YES';
echo $varDismissed;
 if(trim($varDismissed) == 'YES')
    {
?>


<div class="form-group col-md-2">
	
	<label>Reasons for Dismissal</label>
	<p>
	<?php 
	//variableREASONSFORDISMISSAL
	echo $varDismissedDescription; ?>
	</p>
</div>
<div class="form-group col-md-2">
	
	<label>Date of Dismissal</label>
	<p>
	<?php
	//variableDATEOFDISMISSAL
	echo $varDismissionDate; ?>
	</p>
</div>
	<?php } ?>
</div>

<div style="margin-left: 0%;" class="row display">
<div class="form-group col-md-2">
	
	<label>Crime/Corruption</label>
	<p>
	<?php 
	//variableCORRUPTION
	echo $varCorruption ?>
	
	</p>
</div>

<?php
$varNO='NO';
$varYES	='YES';	
 if($varCorruption!=$varNO)
    {
?>

<div class="form-group col-md-2">
	
	<label>Crime/Corruption details</label>
	<p>
	<?php 
	//variableCORRUPTIONDETAILS
	echo $varCorruptionDescription ?>
	</p>
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
       <th style="width: 20%;font-size:12px;" scope="col">Year:From</th>
      <th style="width: 20%;font-size:12px;" scope="col">Year:To</th>
      <th style="width: 20%;font-size:12px;" scope="col">University/High School</th>
      <th style="width: 20%;font-size:12px;" scope="col">Award</th>
      <th style="width: 20%;font-size:12px;" scope="col">Course</th>
	  <th style="width: 20%;font-size:12px;" scope="col">Specialization</th>
	</tr>
  </thead>
<tbody>
<?php
/*$sql2="SELECT * FROM `academic_qualification` WHERE `id_number`='".$varIdNumber."'";
$results2=$conn->query($sql2);*/
$results2=mysqli_query($dbconnection,
		"select aq.id,aq.date_from,aq.date_to,aq.university,aq.cert_no,aq.cert_year,a.id as awardID,a.award,c.course_id,c.course_desc,s.id as specializationID,s.name
		from academic_qualification as aq
		join award as a on aq.award_id=a.id
		join courses as c on aq.course_id=c.course_id
		join specialization as s on aq.specialization_id=s.id
		WHERE aq.id_number='".$id_number."'ORDER BY aq.date_to asc")or die(mysqli_error($dbconnection));

while($aq=mysqli_fetch_array($results2))
{	
$varDateFrom=$aq['date_from'];
$varDateTo=$aq['date_to'];
$varUniversity=$aq['university'];
//award id help in linking with criteria
$varAwardID=$aq['awardID'];
$varAward=$aq['award'];
//course id help in linking with criteria
$varCourseID=$aq['course_id'];
$varCourse=$aq['course_desc'];
//specialization id help in linking with criteria
$varSpecialisationID=$aq['specializationID'];
$varSpecialisation=$aq['name'];
//year of graduation help us calculate how long seens graduation;
$varcert_year=$aq['cert_year'];
		$YEARSsinceGrad=$DUEDATE-$varcert_year;
	//echo $YEARSsinceGrad;

?>
	<tr>
				<td style="font-size:12px;">
				<?php
				//variableACADEMICQUALIFICATIONDateFrom
				echo $varDateFrom;?>
				</td>
				<td style="font-size:12px;">
				<?php
				//variableACADEMICQUALIFICATIONDateTo
				echo $varDateTo; ?>
				</td>
				<td style="font-size:12px;">
				<?php 
				//variableACADEMICQUALIFICATIONUniversity
				echo $varUniversity;?>
				</td>
				<td style="font-size:12px;">
				<?php 
				//variableACADEMICQUALIFICATIONAward
				echo $varAward;?>
				</td>
				<td style="font-size:12px;">
				<?php 
				//variableACADEMICQUALIFICATIONCourse
				echo $varCourse;?>
				</td>
				<td style="font-size:12px;">
				<?php 
				//variableACADEMICQUALIFICATIONSpecialisation
				echo $varSpecialisation;?>
				</td>
			</tr>
		<?php  } 
		

		
		
		 
		?>

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
      <th style="width: 20%;font-size:12px;" scope="col">Year:From</th>
      <th style="width: 20%;font-size:12px;" scope="col">Year:To</th>
      <th style="width: 20%;font-size:12px;" scope="col">Institution</th>
      <th style="width: 20%;font-size:12px;" scope="col">Award</th>
      <th style="width: 20%;font-size:12px;" scope="col">Specialization</th>
       </tr>
  </thead>
<tbody>
	<?php
/*$sql2="SELECT * FROM `professional_qualification` WHERE `id_number`='".$varIdNumber."'";
$results2=$conn->query($sql2);*/
$results2=$result = mysqli_query($dbconnection,

"select pq.id,pq.id_number, pq.date_from,pq.date_to,pq.institution,pq.cert_no,pq.cert_year,a.award,s.name,a.id as awardID,
s.id as specializationID
from professional_qualification as pq
join award as a on pq.award_id=a.id
join specialization as s on pq.specialization_id=s.id
WHERE pq.id_number='".$varIdNumber."'");


while($pq=mysqli_fetch_array($results2))
{	
$varDateFrom=$pq['date_from'];
$varDateTo=$pq['date_to'];
$varInstitution=$pq['institution'];
////award id help in linking with criteria
$varawardID=$pq['awardID'];
$varAward=$pq['award'];
//specialization id help in linking with criteria
$varspecializationID=$pq['specializationID'];
$varSpecialisation=$pq['name'];
//year of graduation help us calculate how long seens graduation;
$varcert_year=$pq['cert_year'];
		$YEARSsinceGrad=$DUEDATE-$varcert_year;
	//	echo $YEARSsinceGrad;

?>
	<tr>
				<td style="width: 20%; font-size:12px;">
				<?php
			//variablePROFESSIONALQUALIFICATIONDateFrom				
				echo $varDateFrom;
				?>
				</td>
				<td style="width: 20%; font-size:12px;">
				<?php
			//variablePROFESSIONALQUALIFICATIONDateTo						
				echo $varDateTo;
				?>
				</td>
				<td style="width: 20%;  font-size:12px;">
				<?php
			//variablePROFESSIONALQUALIFICATIONInstitution
				echo $varInstitution;
				?>
				</td>
				<td style="width: 20%;  font-size:12px;">
				<?php
			//variablePROFESSIONALQUALIFICATIONAward
				echo $varAward;?>
				</td>
				<td style="width: 20%; font-size:12px;">
				<?php 
			//variablePROFESSIONALQUALIFICATIONSpecialisation
				echo $varSpecialisation;?>
				</td>
			</tr>
		<?php }?>
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
      <th style="width: 20%;font-size:12px;" scope="col">Date From</th>
      <th style="width: 20%;font-size:12px;" scope="col">Date To</th>
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
	<td border="0" style="width: 20%;  font-size:12px;">
	<?php 
	//varRELEVANTCOURSESdatefrom
	echo $vardatefrom;?>
	</td>
	<td border="0" style="width: 20%;  font-size:12px;">
	<?php 
	//varRELEVANTCOURSESdateto
	echo $vardateto;?>
	</td>
	<td style="width: 20%;  font-size:12px;">
	<?php
	//varRELEVANTCOURSESUniversity
	echo $varUniversity; ?>
	</td>
	<td style="width: 20%; font-size:12px;">
	<?php 
	//varRELEVANTCOURSESCourseName
	echo $varCourseName;?>
	</td>
	<td style="width: 20%;  font-size:12px;">
	<?php
	//varRELEVANTCOURSESDetailsAndDuration
	echo $varDetailsAndDuration;?>
	</td>
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
				<td style="width: 20%; font-size:12px;">
				<?php
				//varMEMBERSHIPProfessionBody
				echo $varProfessionBody;?>
				</td>
				<td style="width: 20%;  font-size:12px;">
				<?php 
				//varMEMBERSHIPMembershipNo
				echo $varMembershipNo; ?>
				</td>
				<td style="width: 20%;  font-size:12px;">
				<?php 
				//varMEMBERSHIPMembershipType
				echo $varMembershipType;?>
				</td>
				<td style="width: 20%;  font-size:12px;">
				<?php
				//varMEMBERSHIPDateOfRenewal
				echo $varDateOfRenewal;?>
				</td>
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
	$varDutiesAndResponsbillities=$aq1['duties_and_responsbillities'];
	$varCompetencies=$aq1['competencies'];
}
	?>
	<div style="margin-left: 0%;" class="row display">
		<div class="form-group col-md-12">
	
	<label>Duties</label>
	<p>
	<?php
//varWORKDETAILSDutiesAndResponsbillities
	echo $varDutiesAndResponsbillities;?>
	</p>
</div>
</div>
<div style="margin-left: 0%;" class="row display">
<div class="form-group col-md-12">
	
	<label>Abilities</label>
	<p>
	<?php
//varWORKDETAILSCompetencies
	echo $varCompetencies;?>
	</p>
</div>
</div>

</div>
    <!--    Referees-->
    <div class="card">
        <div class="card-header"><h4><strong>Referees</strong></strong></h4></div>

        <div style="margin-left: 0%;" class="row display">

            <table id="myTable" border="0"  class="table table-borderless" style="width:98%; border:none;">
                <thead border="0">
                <tr border="0" class="table">
                    <th style="width: 20%; font-size:12px;" scope="col">Referee Name</th>
                    <th style="width: 20%; font-size:12px;" scope="col">Organization</th>
                    <th style="width: 20%; font-size:12px;" scope="col">Position</th>
                    <th style="width: 20%; font-size:12px;" scope="col">Referee Address</th>
                    <th style="width: 20%; font-size:12px;" scope="col">Referee Email</th>
                    <th style="width: 20%; font-size:12px;" scope="col">Referee Phone No</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $sql3="SELECT * FROM `referee_detail` WHERE `id_number`='".$varIdNumber."'";
                $results3=$conn->query($sql3);
                while($maqq=mysqli_fetch_array($results3))
                {
                   
                    $varName=$maqq['name'];
                    $varOrganization=$maqq['organization'];
                    $varPosition=$maqq['position'];
                    $varAddress=$maqq['address'];
                    $varEmail=$maqq['email'];
                    $varPhoneNo=$maqq['phone_no'];
                    ?>
                    <tr border="0">
                       
                        <td style="width: 20%; font-size:12px;">
                            <?php

                            echo $varName;?>
                        </td>
                        <td style="width: 20%; font-size:12px;">
                            <?php

                            echo $varOrganization;?>
                        </td>
                        <td style="width: 20%;  font-size:12px;">
                            <?php

                            echo $varPosition; ?>
                        </td>
                        <td style="width: 20%;  font-size:12px;">
                            <?php

                            echo $varAddress;?>
                        </td>
                        <td style="width: 20%;  font-size:12px;">
                            <?php

                            echo $varEmail;?>
                        </td>
                        <td style="width: 20%;  font-size:12px;">
                            <?php

                            echo $varPhoneNo;?>
                        </td>
                    </tr>
                <?php  } ?>
                </tbody>
            </table>
        </div>
    </div>
    <!--    Referees-->
</div>



<form method="post" action="">
	<div class="row">
		<div></div>
 
<input class="btn btn-success" type="submit" value="SUBMIT MY APPLICATION" name="submit"> 
</div>
</form>




<?php
$s1="SELECT * FROM vacancy WHERE vacancy_id='".$_SESSION['vacancy_id']."'";
$resultS1=$conn->query($s1);
$arr1=mysqli_fetch_array($resultS1);
$vacancy_id=$arr1['vacancy_id'];
$post=$arr1['post_vacancy'];
$advertno=$arr1['advert_no'];
$directorate=$arr1['directorate'];

$phonesql="SELECT * FROM users WHERE id_number='".$varIdNumber."'";
$phoneresult=$conn->query($phonesql);
while ($row=mysqli_fetch_array($phoneresult))
 {
	# code...

	$phonenumber=$row['phone_number'];
}
function sendTPayOTP($MSISDNTo, $Message)
{
    $Password = "dd2a2868f69dd54721922ae49acf57a7";
    $Host = "https://tpay.tsc.go.ke/tp/v1/api/sms/?";
  
  $Results = file($Host . "&api_key=".urlencode($Password)."&phone=".urlencode($MSISDNTo)."&message=".urlencode($Message));
  print_r($Results);
}
if(isset($_POST['submit']))
{
	$check_if_submitted="SELECT * FROM tblappliedjobs WHERE id_number='".$varIdNumber."' AND  vacancy_id='".$vacancy_id."'";
	$check_if_submitted_result=$conn->query($check_if_submitted);
	$check_submission=mysqli_fetch_array($check_if_submitted_result);
	$is_submitted=$check_submission['is_submitted'];

if ($is_submitted==0) 
{
$status="Submitted";	
$s2='UPDATE tblappliedjobs SET is_submitted="1",status="'.$status.'" WHERE id_number="'.$varIdNumber.'" AND  vacancy_id="'.$vacancy_id.'"';
$resultS2=mysqli_query($conn,$s2) or die(mysqli_error($conn));
$numROWS=mysqli_affected_rows($resultS2);




sendTPayOTP($phonenumber, 'Your Application for the Position of '.$post.'-'.$directorate.', Advert Number '.$advertno.' Has been Successfuly Received.');

//........................................//shortlist...................................................................................
if($numROWS>=1)
	{
	include('./shortlist/index.php');
	}

//session_destroy($_SESSION['vacancy_id']);




//.......................................................................................................................................
		?>
			<script>
		
		window.alert("Your application has been successfully submitted.Thank You.");
    	window.location.href='secOne.php';
		//alert("your application has been successfully submitted.Thank you.");
		
		</script>
		<?php

}
else
{
			?>
			<script>
		
		window.alert("You Already applied this Job.Thank You.");
    	window.location.href='secOne.php';
		//alert("your application has been successfully submitted.Thank you.");
		
		</script>
		<?php
}
}

?>
</body>
</html>














