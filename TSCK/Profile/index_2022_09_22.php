<?php
include('header.php');
//include('includes/topsection.php');

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
    $sql="SELECT DISTINCT * FROM `applicant_details` WHERE `id_no`='".$varIdNumber."'";
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

    <?php
    $s1="SELECT * FROM vacancy WHERE vacancy_id='".$_SESSION['vacancy_id']."'";
    $resultS1=$conn->query($s1);
    $arr1=mysqli_fetch_array($resultS1);
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

                    <label>Mobile No</label>
                    <p><?php echo $varMobile_no;?></p>
                </div>

            </div>
            <div style="margin-left: 0%;" class="row display">
                <div class="form-group col-md-3">

                    <label>Alternative contact person</label>
                    <p><?php echo $varAlt_person_name;?></p>
                </div>
                <div class="form-group col-md-2">

                    <label>Telephone No</label>
                    <p><?php echo $varAlt_tel_no;?></p>
                </div>
                <div class="form-group col-md-3">

                    <label>Email</label>
                    <p><?php echo $varEmail;?></p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h4><strong>Employment Details</strong></strong></h4></div>
            <div style="margin-left: 0%;" class="row display">
                <table id="myTable" border="0"  class="table table-borderless" style="width:99%; border:none;">
                    <thead>
                    <tr class="table-active">
                        <th style=" width: 20%;font-size:12px;" scope="col">Year:From</th>
                        <th style="width: 20%;font-size:12px;" scope="col">Year:To</th>
                        <th style=" width: 20%;font-size:12px;" scope="col">Designation</th>
                        <th style="width: 20%;font-size:12px;" scope="col">Gross Monthly salary-Range</th>

                        <th style="width: 20%;font-size:12px;" scope="col">Ministry/Department</th>
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
                            <td style="  width: 20%;  font-size:12px;"><?php echo $varDateFrom;?></td>
                            <td style=" width: 20%;  font-size:12px;"><?php echo $varDateTo; ?></td>
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
        <div class="card-header"><h4><strong>Other Personal Details</strong></strong></h4></div>
        <div style="margin-left: 0%;" class="row display">
            <div class="form-group col-md-2">

                <label>Conviction</label>
                <p><?php echo $varConvition; ?></p>
            </div>
            <?php
            $varNO='NO';
            $varYES	='YES';
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
            $varNO='NO';
            $varYES	='YES';
            if(trim($varDismissed) == 'YES' )
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
            <?php } ?>
        </div>

        <div style="margin-left: 0%;" class="row display">
            <div class="form-group col-md-2">

                <label>Crime/Corruption</label>
                <p><?php echo $varCorruption ?></p>
            </div>

            <?php
            $varNO='NO';
            $varYES	='YES';
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
                $sql2="SELECT a.id_number, a.date_from, a.date_to, a.university, b.award ,c.course_desc,d.name as specialization FROM academic_qualification a 
JOIN award b ON a.award_id=b.id
JOIN courses c ON a.course_id=c.course_id
JOIN specialization d ON a.specialization_id=d.id WHERE a.id_number='".$varIdNumber."'";
                $results2=$conn->query($sql2);

                while($aq=mysqli_fetch_array($results2))
                {
                    $varDateFrom=$aq['date_from'];
                    $varDateTo=$aq['date_to'];
                    $varUniversity=$aq['university'];
                    $varAward=$aq['award'];
                    $varCourse=$aq['course_desc'];
                    $varSpecialisation=$aq['specialization'];
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
                    <th style="width: 20%;font-size:12px;" scope="col">Year:From</th>
                    <th style="width: 20%;font-size:12px;" scope="col">Year:To</th>
                    <th style="width: 20%;font-size:12px;" scope="col">Institution</th>
                    <th style="width: 20%;font-size:12px;" scope="col">Award</th>
                    <th style="width: 20%;font-size:12px;" scope="col">Specialization</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $sql2="SELECT a.id_number, a.date_from,a.date_from, a.cert_year, a.institution, b.award ,d.name as specialization FROM professional_qualification a 
JOIN award b ON a.award_id=b.id
JOIN specialization d ON a.specialization_id=d.id WHERE `id_number`='".$varIdNumber."'";
                $results2=$conn->query($sql2);
                while($aq=mysqli_fetch_array($results2))
                {
                    $varDateFrom=$aq['date_from'];
                    $varDateTo=$aq['cert_year'];
                    $varInstitution=$aq['institution'];
                    $varAward=$aq['award'];
                    $varSpecialisation=$aq['specialization'];


                    ?>
                    <tr>
                        <td style="width: 20%; font-size:12px;"><?php echo $varDateFrom;?></td>
                        <td style="width: 20%; font-size:12px;"><?php echo $varDateTo; ?></td>
                        <td style="width: 20%;  font-size:12px;"><?php echo $varInstitution;?></td>
                        <td style="width: 20%;  font-size:12px;"><?php echo $varAward;?></td>
                        <td style="width: 20%; font-size:12px;"><?php echo $varSpecialisation;?></td>
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
                        <td border="0" style="width: 20%;  font-size:12px;"><?php echo $vardatefrom;?></td>
                        <td border="0" style="width: 20%;  font-size:12px;"><?php echo $vardateto;?></td>
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
</body>
</html>
