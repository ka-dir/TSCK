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

    <br><br>


    <br>
    <style>
        .center {
            margin: auto;
            width: 60%;
            border: 3px solid #73AD21;
            padding: 10px;
        }
    </style>
    <div class="center" >
        <h5 class="fw-light" style="background: gray;display: block;align-content: center;text-decoration: underline overline dotted red;font-weight: bolder;font-size: medium;font-family: 'Agency FB'"> Academic Qualification attachment</h5>



        <?php

        $sql_academic_qualification = "SELECT upload_cert FROM academic_qualification WHERE id_number='$varIdNumber'";
        $results_academic_qualification =  mysqli_query($conn,$sql_academic_qualification);
        while($row_academic_qualification = mysqli_fetch_array($results_academic_qualification)){

            $out_upload_cert = $row_academic_qualification['upload_cert'];

        if($out_upload_cert == 0){


            ?>

            <embed type="application/pdf" width="100%" height="1000px";   src="././sectionFour/uploads/noImageUploaded.png#toolbar=1&navpanes=0&scrollbar=0"  </embed>
        <?php
        } else{
            ?>

            <embed type="application/pdf" width="100%" height="1000px";   src="././sectionFour/uploads/<?php echo $out_upload_cert;  ?>#toolbar=1&navpanes=0&scrollbar=0"  </embed>
        <?php } } ?>

    </div>
    </div>



                <!--end academics attachment !-->

                <!--start  Professional/Technical Qualifications/Certifications attachment !-->
                <br><br>


                <br>
                <style>
                    .center {
                        margin: auto;
                        width: 60%;
                        border: 3px solid #73AD21;
                        padding: 10px;
                    }
                </style>
                <div class="center" >
                    <h5 class="fw-light" style="background: gray;display: block;align-content: center;text-decoration: underline overline dotted red;font-weight: bolder;font-size: medium;font-family: 'Agency FB'">Professional/Technical Qualifications/Certifications attachment</h5>



                    <?php

                    $sql_prof_qualification = "SELECT upload_cert FROM professional_qualification WHERE id_number='$varIdNumber'";
                    $results_prof_qualification =  mysqli_query($conn,$sql_prof_qualification);
                    while($row_prof_qualification = mysqli_fetch_array($results_prof_qualification)){

                    $out_upload_cert_prof = $row_prof_qualification['upload_cert'];

                    if($out_upload_cert_prof == 0){

                        ?>

                        <embed type="application/pdf" width="100%" height="1000px";   src="././sectionFive/uploads/noImageUploaded.png#toolbar=1&navpanes=0&scrollbar=0"  </embed>
                        <?php
                    } else{
                        ?>





                        <embed type="application/pdf" width="100%" height="1000px";   src="././sectionFive/uploads/<?php echo $out_upload_cert_prof;  ?>#toolbar=1&navpanes=0&scrollbar=0"  </embed>
                    <?php } } ?>

                </div>
            </div>
            <!--end  Professional/Technical Qualifications/Certifications attachment !-->

            <!--start  Relevant Courses and Training attended Lasting not Less than Two (2) Weeks attachment !-->
            <br><br>


            <br>
            <style>
                .center {
                    margin: auto;
                    width: 60%;
                    border: 3px solid #73AD21;
                    padding: 10px;
                }
            </style>
            <div class="center" >
                <h5 class="fw-light" style="background: gray;display: block;align-content: center;text-decoration: underline overline dotted red;font-weight: bolder;font-size: medium;font-family: 'Agency FB'">Relevant Courses and Training attended Lasting not Less than Two (2) Weeks attachment</h5>



                <?php

                $sql_relevant_courses = "SELECT upload_cert FROM relevant_courses WHERE id_number='$varIdNumber'";
                $results_relevant_courses =  mysqli_query($conn,$sql_relevant_courses);
                while($row_relevant_courses = mysqli_fetch_array($results_relevant_courses)){

                $out_upload_cert_relevant = $row_relevant_courses['upload_cert'];

                if($out_upload_cert_relevant == 0){

                    ?>

                    <embed type="application/pdf" width="100%" height="1000px";   src="././sectionSix/uploads/noImageUploaded.png#toolbar=1&navpanes=0&scrollbar=0"  </embed>


                    <?php
                } else{
                    ?>

                    <embed type="application/pdf" width="100%" height="1000px";   src="././SectionSix/uploads/<?php echo $out_upload_cert_relevant;  ?>#toolbar=1&navpanes=0&scrollbar=0"  </embed>
                <?php } } ?>

            </div>
        </div>
        <!--end  Relevant Courses and Training attended Lasting not Less than Two (2) Weeks attachment !-->

        <!--start  Current Registration/Membership to Professional Bodies attachment !-->
        <br><br>


        <br>
        <style>
            .center {
                margin: auto;
                width: 60%;
                border: 3px solid #73AD21;
                padding: 10px;
            }
        </style>
        <div class="center" >
            <h5 class="fw-light" style="background: gray;display: block;align-content: center;text-decoration: underline overline dotted red;font-weight: bolder;font-size: medium;font-family: 'Agency FB'"> Current Registration/Membership to Professional Bodies attachment</h5>



            <?php

            $sql_current_membership = "SELECT upload_cert FROM current_membership WHERE id_number='$varIdNumber'";
            $results_current_membership =  mysqli_query($conn,$sql_current_membership);
            while($row_current_membership = mysqli_fetch_array($results_current_membership)){

                $out_upload_current_membership = $row_current_membership['upload_cert'];
            if($out_upload_current_membership == 0){

                ?>

                <embed type="application/pdf" width="100%" height="1000px";   src="././sectionSeven/uploads/noImageUploaded.png#toolbar=1&navpanes=0&scrollbar=0"  </embed>


                <?php
            } else{
                ?>


                <embed type="application/pdf" width="100%" height="1000px";   src="././SectionSeven/uploads/<?php echo $row_current_membership['upload_cert'];  ?>#toolbar=1&navpanes=0&scrollbar=0"  </embed>
            <?php } } ?>

        </div>
    </div>
    <!--end    Current Registration/Membership to Professional Bodies attachment !-->
    <!--start  ID attachment !-->
    <br><br>


    <br>
    <style>
        .center {
            margin: auto;
            width: 60%;
            border: 3px solid #73AD21;
            padding: 10px;
        }
    </style>
    <div class="center" >
        <div class="row" >


            <h5 class="fw-light" style="background: gray;display: block;align-content: center;text-decoration: underline overline dotted red;font-weight: bolder;font-size: medium;font-family: 'Agency FB'">  National Identification attachment</h5>



            <?php


            $sql_applicants_national_id = "SELECT upload_id FROM applicant_details WHERE id_no='$varIdNumber'";
            $results_applicants_national_id =  mysqli_query($conn,$sql_applicants_national_id);
            while($row_applicants_national_id = mysqli_fetch_array($results_applicants_national_id)){

                $out_upload_id = $row_applicants_national_id['upload_id'];
              

                if($out_upload_id == ""){


                ?>

            <embed type="application/pdf" width="100%" height="1000px";   src="././sectionTwo/uploads/noImageUploaded.png#toolbar=1&navpanes=0&scrollbar=0"  </embed>
            <?php
            } else {

            ?>


                <embed type="application/pdf" width="100%" height="1000px";   src="././sectionTwo/uploads/<?php echo $out_upload_id ;  ?>#toolbar=1&navpanes=0&scrollbar=0"  </embed>
            <?php  } }?>
            <i class="fa fa-reply-all " style="color: red;"></i>
        </div>


    </div>
    </div>





    <!--end    ID attachment !-->


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
