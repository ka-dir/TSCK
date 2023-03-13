<?php
error_reporting(E_ERROR | E_PARSE);
include('header.php');
if(isset($_GET['id_number'],$_GET['advert_no'] ))
{
    $encode_idno=$_GET['id_number'];
    $varIdNumber=base64_decode(urldecode($encode_idno));
    $encode_advertno=$_GET['advert_no'];
    $advert_number=base64_decode(urldecode($encode_advertno));
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html"
      xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body style="margin-left: -13%;">
<div style="width: 10%; margin-left: 37%;margin-top:-5%;">
    <img src="images/tsclogowhite.png"  width="90" height="90"/>
</div>
<form  method="get" action="">
    <?php
    $sql="
SELECT DISTINCT
a.title,a.S_name,a.F_name,a.O_name,a.DOB,a.id_no,a.gender,a.nationality,a.county,a.sub_county,
a.constituency,a.postal_address,a.postal_code,a.town,a.email,a.alt_person_name,a.alt_tel_no,a.disability,
a.disability_description,a.KRA_pin,a.current_employer_name,a.position_held,a.effective_date,
a.convition,a.convition_description,a.dismissed,a.dismissed_description,a.dismission_date,
a.corruption,a.corruption_description,a.gross_salary,u.phone_number,u.email as user_email
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
        $varUserEmail=$row['user_email'];
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


    $s1="
SELECT tbj.id_number,tbj.tscNo,tbj.vacancy_id,tbj.advert_no,tbj.post_vacancy,
tbj.directorate,tbj.is_submitted,tbj.status,tbj.DateTime as SubmittedTime,
v.vacancy_id,v.advert_no,v.post_vacancy,v.no_of_post,v.duDate,v.category,
v.job_description,v.duties_and_responsibilities,v.requirements,v.pay_type,v.currency,
v.basic_salary,v.house_allowance,v.commuter_allowance,v.leave_allowance,v.medical_scheme,
v.is_Closed,v.advert_date,v.DateTime
FROM tblappliedjobs as tbj 
JOIN vacancy as v
ON tbj.advert_no=v.advert_no
WHERE tbj.advert_no='$advert_number' AND tbj.id_number='$varIdNumber'";

    $resultS1=$conn->query($s1);
    $arr1=mysqli_fetch_array($resultS1);
    $post=$arr1['post_vacancy']
    ?>
    <div class="card"></div>
    <div class="card">
        <div class="card-header"><h4><strong>Vacancies Applied For</strong></strong></h4></div>
        <div style="margin-left: 0%;" class="row display">
            <div class="form-group col-md-3">

                <label>Vacancy/Post</label>
                <p><?php echo $post;?></p>
            </div>
            <div class="form-group col-md-3">
                <label>Advert No</label>
                <p><?php
                    echo $arr1['advert_no'];
                    ?></p></div>
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

            <div class="form-group col-md-3">
                <label>Submitted On</label>
                <p>
                    <?php
                    //variableDUEDATE
                    $arr1['SubmittedTime'];
                    $SubmittedTime=$arr1['SubmittedTime'];
                    echo date('Y-m-d',strtotime($SubmittedTime));
                    ?>
                </p></div>
        </div>






        <div class="card"></div>
        <div class="card">
            <div class="card">
                <div class="card-header"><h4><strong>Personal Details</strong></strong></h4></div>


                <table>

                    <tr>
                        <td style="width: 5%;"><label>Name</label><p>
                                <?php
                                //variableNAME
                                echo $varTitle." ". $varSurname." ".$varFirstName." ".$varOtherNames;?>
                            </p>
                        </td>



                        <td style="width: 15%;">
                            <label>Age</label>
                            <p>
                                <?php
                                //variableDATEOFBIRTH
                                $varBirthdate;
                                $DUEDATE;




                                $from = new DateTime($varBirthdate);
                                $to = new DateTime($DUEDATE);
                                $AGE=$from->diff($to)->y;
                                echo $AGE;

                                ?>
                            </p>
                        </td>
                        <td style="width: 16%;"><label>Id-No</label><p><?php echo  $varIdNumber;?></p></td>
                        <td style="width: 16%;"><label>KRAPin</label><p><?php echo  $varKRA_pin;?></p></td>
                    </tr>
                    <tr>

                        <td style="width: 16%;"><label>Gender</label><p><?php echo  $varGender;?></p></td>
                        <td style="width: 10%;"><label>Nationality</label><p><?php echo $varNationality;?></p></td>
                        <td style="width: 10%;"><label>HomeCounty</label><p><?php echo $varCounty;?></p></td>
                        <td style="width: 10%;"><label>Disability</label><p><?php echo $varDisability;?></p></td>
                    </tr>

                    <?php
                    $varNO='NO';
                    $varYES	='YES';
                    if($varDisability!=$varNO)
                    {

                        ?>
                        <tr> <td style="width: 16%;"><label>Disability Details</label><p><?php echo $varDisability_description;?></p></td></tr>

                    <?php }
                    ?>
                    <tr><td style="width: 16%;"><label>Postal Address</label><p><?php echo $varPostal_address;?></p></td>
                        <td style="width: 16%;"><label>Code</label><p><?php echo $varPostal_code;?></p></td>
                        <td style="width: 16%;"><label>Town/City</label><p><?php echo $varTown;?></p></td>
                        <td style="width: 16%;"><label>Applicant Mobile No</label><p><?php echo $varMobile_no;?></p></td>
                        <td style="width: 16%;"><label>Applicant Email</label><p><?php echo $varUserEmail;?></p></td>

                        <table><tr>
                            </tr><tr><td style="width: 30%;"><label>Alternative contact person</label><p><?php echo $varAlt_person_name;?></p></td>

                                <td style="width: 30%;"><label>Alternative contact person Telephone No</label><p><?php echo $varAlt_tel_no;?></p></td>

                                <td style="width:30%;"><label>Alternative contact person Email</label><p><?php echo $varEmail;?></p></td></tr></table>

                        <div class="card">
                            <div class="card-header"><h4><strong>Employment Details</strong></strong></h4></div>
                            <div style="margin-left: 0%;" class="row display">
                                <table id="myTable" border="0"  class="table table-borderless table-responsive" style="width:99%; border:none;">
                                    <thead>
                                    <tr class="table-active">
                                        <th style=" width: 20%;font-size:12px;" scope="col">Year:From</th>
                                        <th style="width: 20%;font-size:12px;" scope="col">Year:To</th>
                                        <th style="width: 20%;font-size:12px;" scope="col">TEL</th>
                                        <th style="width: 20%;font-size:12px;" scope="col">Email</th>
                                        <th style="width: 20%;font-size:12px;" scope="col">Status</th>
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
                                        $employer_telephone=$eaq['employer_telephone'];
                                        $employer_email=$eaq['employer_email'];
                                        $state_status=$eaq['state_status'];
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
                                            <td style="  width: 20%;  font-size:12px;">
                                                <?php
                                                //employer telephone
                                                echo $employer_telephone;?>
                                            </td>
                                            <td style="  width: 20%;  font-size:12px;">
                                                <?php
                                                //employer email
                                                echo $employer_email;?>
                                            </td>
                                            <td style="  width: 20%;  font-size:12px;">
                                                <?php
                                                //employer status
                                                if($state_status==1){
                                                    echo "Current";
                                                }
                                                elseif($state_status==2){
                                                    echo "Latest";
                                                }
                                                else{
                                                    echo "-";
                                                }
                                                ?>
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
                <div class="card-header"><h4><strong>Work Details</strong></strong></h4></div>


                <div class="card">
                    <?php
                    $s3="SELECT  * FROM `staffreg` WHERE `ID_Number`='".$varIdNumber."'";
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
                    // 	$s3="SELECT * FROM `staffreg` WHERE `id_number`='".$varIdNumber."'";
                    // $resultS3=$conn->query($s3);
                    // while($row = mysqli_fetch_array($resultS3))
                    // 	{
                    // 		$varPayrollNum=$row['Payroll_Num'];
                    // 		$varStationName=$row['Station-Name'];
                    // 		$workcounty=$row['Work-County'];
                    // 		$stationcode=$row['Station-Code'];
                    // 		$desigcode=$row['Desig-Code'];
                    // 		$designame=$row['Desig-Name'];
                    // 		$paygroup=$row['Pay-Group'];
                    // 		$datehired=$row['Date-Hired'];



                    // 	}


                    if($varPayrollNum>0)
                    {
                        ?>
                        <div class="card-header"><h4><strong>Applicants in the Teacher Service Commission</strong></strong></h4></div>
                        <?php
                        ?>
                        <table><tr><td style="width: 16%;"><label>TSC No</label><p><?php echo $varPayrollNum; ?></p></td>
                                <td style="width: 16%;"><label>Work County</label><p><?php echo $workcounty; ?></p></td>
                                <td style="width: 16%;"><label>Station Code</label><p><?php echo $stationcode; ?></p></td>
                                <td style="width: 16%;"><label>Station Name</label><p><?php echo $varStationName;?></p></td>
                                <td style="width: 16%;"><label>Date Hired</label><p><?php echo date('Y-m-d',strtotime($datehired))?></p></td></tr>
                            </tr></table>
                        <table>
                            <tr><td style="width: 22%;"><label>Designation Code</label><p><?php echo $desigcode;?></p></td>
                                <td style="width: 22%;"><label>Designation Name</label><p><?php echo $designame;?></p></td>
                                <td style="width: 22%;"><label>Pay Group</label><p><?php echo $paygroup;?></p></td></tr></table>

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
                        <table><tr><td style="width: 16%;"><label>Current employer</label><p><?php echo $varCurrentEmployerName; ?></p></td>
                                <td style="width: 16%;"><label>Position held</label><p><?php echo $varPositionHeld; ?></p></td>
                                <td style="width: 16%;"><label>Effective date</label><p><?php echo $varEffectiveDate; ?></p></td>
                                <td style="width: 16%;"><label>Gross Salary(monthly)Ksh</label><p><?php echo $varEffectiveDate;?></p></td>
                            </tr></table>

                        <?php
                        }
                        ?>
                    </div>

                    <div class="card">
                        <div class="card-header"><h4><strong>Other Personal Details</strong></strong></h4></div>

                        <table><tr>
                                <td style="width: 13%;"><label>Conviction</label><p><?php echo $varConvition; ?></p></td>


                                <?php
                                $varNO='No';
                                $varYES	='Yes';
                                if($varConvition!=$varNO)
                                {
                                    ?>
                                    <td style="width: 16%;"><label>Nature of Offence</label><p><?php echo $varConvitionDescription; ?></p></td>



                                    <?php
                                }
                                ?>

                                <td style="width: 22%;"><label>Dismissal from Employment</label><p><?php echo $varDismissed; ?></p></td>

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
                                        <td style="width: 16%;"><label>Reasons for Dismissal</label><p><?php echo $varDismissedDescription; ?></p></td>
                                        <td style="width: 16%;"><label>Date of Dismissal</label><p><?php echo $varDismissionDate;?></p></td>


                                    <?php } }?>

                                <td style="width: 13%;"><label>Crime/Corruption</label><p><?php echo $varCorruption; ?></p></td>

                                <?php
                                $varNO='No';
                                $varYES	='Yes';
                                if($varCorruption!=$varNO)
                                {
                                ?>
                                <td style="width: 20%;"><label>Crime/Corruption details</label><p><?php echo $varCorruptionDescription;?></p></td>
                            </tr>
                            <?php
                            }
                            ?>
                        </table>
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
		WHERE aq.id_number='".$varIdNumber."'ORDER BY aq.date_to ASC")or die(mysqli_error($dbconnection));


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
                                    //	echo $YEARSsinceGrad;

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


                    <form method="post" action="" style="">
                        <div class="row">
                            <div></div>
                            <input class="btn btn-success" id="btnsuccess" type="submit" onclick="window.print()" value="PRINT" name="submitone">
                        </div>
                    </form>

                    <div class="form-group col-md-4">
                        <a href="./secFifteen.php" role="button" class="btn btn-success pull-left" style="margin-left:1%;background: #314C95;"><< Previous</a>
                    </div>



                    <?php
                    /*$s1="SELECT * FROM vacancy WHERE advert_no='".$advert_number."'";
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
                        }*/


                    ?>


</body>
</html>
