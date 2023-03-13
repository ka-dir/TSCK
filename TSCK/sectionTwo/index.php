<?php
include('../TSCK/includes/dbConfig.php');


//session_start();
error_reporting(E_ALL ^ E_NOTICE);
$VarVacancy_id = $_SESSION['vacancy_id'];
$VarAdvert_no = $_SESSION['Advert_no'];
$VarTscNo = $_SESSION['TscNo'];
$VarID_No = $_SESSION['id_number'];
$VarPage = "2-Personal Details";
$in_applicant_details = 0;

if ($VarTscNo > 0) {

    $sql = "SELECT DISTINCT * FROM `staffreg` WHERE `Payroll_Num`='" . $VarTscNo . "'";
    $result = $conn->query($sql);
    while ($row = mysqli_fetch_array($result)) {
        $varTSCNo = intval($row['Payroll_Num']);
        $varTitle = $row['Salutation'];
        $varSurname = $row['Surname'];
        $varFirstName = $row['First-Name'];
        $varOtherNames = $row['Other-Names'];
        $varBirthdate = $row['Birth_Date'];
        $varIdNumber = $row['ID_Number'];
        $varGender = $row['Gender'];
        $varTaxPin = $row['Tax-PIN'];
        $varHomecounty = $row['Home-County'];
        $varPayrollNum = $row['Payroll_Num'];
        $varStationName = $row['Station-Name'];
        $varDesigName = $row['Desig-Code'];
        $varJobDesig = $row['Job-Desig'];
        $varDate = date('d-M-Y', strtotime($row['Birth_Date']));
        $varDateOfPost = date('d-M-Y', strtotime($row['Date_of_Post']));

        $sql1 = "SELECT DISTINCT * FROM `applicant_details` WHERE `id_no`='" . $VarID_No . "'";
        $result1 = $conn->query($sql1);
        while ($row1 = mysqli_fetch_array($result1)) {
            if (count($row1) > 0) {
                $in_applicant_details = 1;
            }
            $varPostalAddress = $row1['postal_address'];
            $varPostalCode = $row1['postal_code'];
            $varTownCode = $row1['town'];
            $varHomecounty = $row1['county'];
            $alt_person_name = $row1['alt_person_name'];
            $email = $row1['email'];
            $alt_tel_no = $row1['alt_tel_no'];
            $varGrade = $row1['grade'];

            // $varStationName = $row1['current_employer_name'];

        }

    }
} else {
    $sql = "SELECT DISTINCT * FROM `applicant_details` WHERE `id_no`='" . $VarID_No . "'";
    $result = $conn->query($sql);
    while ($row = mysqli_fetch_array($result)) {
        if (count($row) > 0) {
            $in_applicant_details = 1;
        }
        $varIdNumber = intval($row['id_no']);
        $varTitle = $row['Salutation'];
        $varSurname = $row['S_name'];
        $varFirstName = $row['F_name'];
        $varOtherNames = $row['O_name'];
        $varBirthdate = $row['DOB'];
        $varPostalAddress = $row['postal_address'];
        $varPostalCode = $row['postal_code'];
        $varTownCode = $row['town'];
        $varGender = $row['gender'];
        $varTaxPin = $row['KRA_pin'];
        $varHomecounty = $row['county'];
        $varPayrollNum = $row['null'];
        $varStationName = $row['current_employer_name'];
        $alt_person_name = $row['alt_person_name'];
        $email = $row['email'];
        $alt_tel_no = $row['alt_tel_no'];
        $varJobDesig = $row['position_held'];
        $varDate = date('d-M-Y', strtotime($row['null']));
        $varDateOfPost = date('d-M-Y', strtotime($row['effective_date']));
        $varGrade = $row['grade'];
    }
}


if (isset($_POST['btnSubmitProfile'])) {

    if ($VarTscNo > 0) {
        $DOB = $varBirthdate;
    } else {
        $DOB = $_POST['DOB'];
    }
    //

    if ($VarTscNo > 0) {
        $varTSCNoI = $varTSCNo;
    } else {
        $varTSCNoI = 0;
    }


    //ADDLASHES FUNCTION


    function addslashesifneeded($stringtocheck)
    {
        if (!get_magic_quotes_gpc()) {
            $goodstring = addslashes($stringtocheck);
        } else {
            $goodstring = $stringtocheck;
        }
        return $goodstring;
    }


    //NOTES
    //-addslashifneeded
    $surname = addslashesifneeded(strtoupper($_POST['surname']));
    $firstname = addslashesifneeded(strtoupper($_POST['firstname']));
    $othername = addslashesifneeded(strtoupper($_POST['othername']));
    $title = addslashesifneeded(strtoupper($_POST['title']));
    $idNo = $_POST['idNo'];
    $pinNo = addslashesifneeded(strtoupper($_POST['pinNo']));
    $gender = strtoupper($_POST['gender']);
    $nationality = addslashesifneeded(strtoupper($_POST['nationality']));
    $county = addslashesifneeded(strtoupper($_POST['county']));
    $subcounty = addslashesifneeded(strtoupper($_POST['subcounty']));
    $Constituency = addslashesifneeded(strtoupper($_POST['Constituency']));
    $postalAddress = addslashesifneeded(strtoupper($_POST['postal_address']));
    $postalCode = $_POST['postal_code'];
    $town_city = addslashesifneeded(strtoupper($_POST['town']));
    $mobile_no = $_POST['mobile_no'];
    $email = $_POST['email'];
    $contactPersonName = addslashesifneeded(strtoupper($_POST['contactPersonName']));
    $contactPersonNo = addslashesifneeded(strtoupper($_POST['mobile']));
    $contactPersonEmail = addslashesifneeded(strtoupper($_POST['email']));
    $disability = $_POST['yesno'];
    $detailOfDisability = $_POST['detailOfDisability'];
    $RegistrationDisabilityNo = $_POST['RegistrationDisabilityNo'];
    $dateOfDisabilityRegistration = date('Y-m-d', strtotime($_POST['dateOfDisabilityRegistration']));
    $currentEmployer = addslashesifneeded(strtoupper($_POST['currentEmployer']));
    $positionHeld = addslashesifneeded(strtoupper($_POST['positionHeld']));
    //$EffectiveDate=$_POST['EffectiveDate'];
    $EffectiveDate = date('Y-m-d', strtotime($_POST['EffectiveDate']));
    $GrossSalary = $_POST['GrossSalary'];
    $grade = addslashesifneeded(strtoupper($_POST['grade']));
    $filename = $_FILES["uploadfile"]["name"];
    $saved_file_name = $VarID_No . '_' . $surname;
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "././sectionTwo/uploads/" . $saved_file_name;
    $vid = $_SESSION['vacancy_id'];


    if ($in_applicant_details == 1) {

        $sql = "UPDATE applicant_details
            SET
            S_name='$surname',
            F_name='$firstname',
            O_name='$othername',
            DOB='$DOB',
            id_no= '$idNo',
            upload_id= '$saved_file_name',
            tscNo='$varTSCNoI',
            KRA_pin='$pinNo',
            gender='$gender',
            nationality='$nationality',
            county='$county',
            constituency='$Constituency',
            postal_address='$postalAddress',
            postal_code='$postalCode',
            town='$town_city',
            mobile_no='$mobile_no',
            email='$email',
            alt_person_name='$contactPersonName',
            alt_tel_no='$contactPersonNo',
            disability='$disability',
            disability_description='$detailOfDisability',
            disability_no='$RegistrationDisabilityNo',
            disability_reg_date='$dateOfDisabilityRegistration',
            current_employer_name='$currentEmployer',
            position_held='$positionHeld',
            effective_date='$EffectiveDate',
            grade='$grade' 
            
            WHERE  id_no= '$idNo'";

        mysqli_query($conn, $sql);

        //var_dump($sql);die();
    } else {
        //}

        //Insert
        $sql = "INSERT INTO applicant_details( 	
		S_name,F_name,O_name,title,DOB,id_no,upload_id,tscNo,KRA_pin,gender,nationality,county,sub_county,constituency,postal_address,postal_code,town,
		mobile_no,email,alt_person_name,alt_tel_no,disability,disability_description,disability_no,disability_reg_date,current_employer_name,
		position_held,effective_date,grade, gross_salary)
		VALUES(	
		'$surname',
		'$firstname',
		'$othername',
		'$title',
		'$DOB',
		'$idNo',
		'$saved_file_name',
		'$varTSCNoI',
		'$pinNo',
		'$gender',
		'$nationality',
		'$county',
		'$subcounty',
		'$Constituency',
		'$postalAddress',
		'$postalCode',
		'$town_city',
		'$mobile_no',
		'$email',
		'$contactPersonName',
		'$contactPersonNo',
		'$disability',
		'$detailOfDisability',
		'$RegistrationDisabilityNo',
		'$dateOfDisabilityRegistration',
		'$currentEmployer',
		'$positionHeld',
		'$EffectiveDate',
		'$grade',
		'$GrossSalary')
		";
    }
    mysqli_query($conn, $sql);

    // Now let's move the uploaded image into the folder: image
    if (move_uploaded_file($tempname, $folder)) {
        $_SESSION['message'] = "Success Record Saved";
        $_SESSION['msg_type'] = "info";

        header("Location: secThree.php");
    } else {
        $_SESSION['message'] = "Failed... Error Occurred";
        $_SESSION['msg_type'] = "danger";
        header("Location: secTwo.php");
    }

}

if ($_REQUEST['upload_id']) {
    $saved_file_name = $_REQUEST['upload_id'];

    $query = mysqli_query($conn, "SELECT * FROM `applicant_details` WHERE `id_no`='$saved_file_name'") or die(mysqli_error());
    $fetch = mysqli_fetch_array($query);
    $file_name = $fetch['upload_id'];
//

    $location = '././sectionTwo/uploads/' . $file_name;


//    if(unlink($location)){
//        $saved_file_name=$_REQUEST['upload_id'];
//        mysqli_query($conn, "UPDATE  `applicant_details` SET upload_id=Null WHERE `id_no`='$saved_file_name'") or die(mysqli_error());
//
//        header("Location: secTwo.php");
//    }

}

?>
<?php
if (isset($_REQUEST['upload_delete_id'])) {
    $saved_file_name = $_REQUEST['upload_delete_id'];

    $query = mysqli_query($conn, "SELECT * FROM `applicant_details` WHERE `id_no`='$saved_file_name'") or die(mysqli_error());
    $fetch = mysqli_fetch_array($query);
    $file_name = $fetch['upload_id'];
//

    $location = '././sectionTwo/uploads/' . $file_name;
    if (unlink($location)) {

        mysqli_query($conn, "UPDATE  `applicant_details` SET upload_id=Null WHERE `id_no`='$saved_file_name'") or die(mysqli_error());

        header("Location: secTwo.php");
    }
}
?>


<html>
<head>
    <title>
    </title>

    <script type="text/javascript">
        function yesnoCheck() {
            if (document.getElementById('yesCheck').checked) {
                document.getElementById('ifYes').style.visibility = 'visible';
            } else {
                document.getElementById('ifYes').style.visibility = 'hidden';
            }
        }

    </script>
    <script type="text/javascript"> /* script for only allowing alphabets  */

        function ValidateAlpha(evt) {
            var keyCode = (evt.which) ? evt.which : evt.keyCode
            if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32)

                return false;
            return true;
        }

    </script>
    <link href="../css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .btn {
            background-color: #F0FFFF; /* Blue background */

            color: #5D3FD3; /* White text */
            padding: 2px 1px; /* Some padding */
            font-size: 16px; /* Set a font size */
            cursor: pointer; /* Mouse pointer on hover */
            border-radius: 10px;

        }

        /* Darker background on mouse-over */
        .btn:hover {
            background-color: #F5F8FA;
            color: #EE1D52;

    </style>

</head>


<body style="margin-top: -50px;">


<?php
//include('includes/topsection.php');
?>
<div class="card-header">
    <h3 class="text-center">2. Personal Details </h3>
</div>
<?php //include('errors.php'); ?>
<div class="card-body" style="margin-left: 10vh;margin-right:-45vh;">
    <form method="post" action="" enctype="multipart/form-data">
        <div class="row">

            <div class="form-group col-md-2">
                <label for="country">Title</label><br>

                <?php if ($VarTscNo > 0) {
//echo $varTitle;
                    echo "<input name=\"title\" type=\"text\" readonly = \"\" value = \"$varTitle";
                    echo "\">";
                } else {
                    ?>

                    <select id="country" name="title">
                        <option value="Mr">Mr</option>
                        <option value="Mrs">Mrs</option>
                        <option value="Miss">Miss</option>
                        <option value="Prof">Prof</option>
                        <option value="Dr">Dr</option>
                        <option value="Rev">Rev</option>
                        <option value="Other">Other</option>
                    </select>

                    <?php
                } ?>

            </div>


            <div class="form-group col-md-2">
                <label for="inputCity">Surname</label>
                <?php

                echo "<input name=\"surname\" type=\"text\" value = \"$varSurname";
                echo "\">";
                ?>
                <script type="text/javascript">
                    $('.ValidateAlphaAndSpecialKeys').on('input', function () {
                        var node = $(this);

                        node.val(node.val().replace(/[^a-z\s'-]/gi, ''));
                    });
                </script>
            </div>
            <div class="form-group col-md-2">
                <label for="inputCity">First Name</label>
                <?php

                echo "<input name=\"firstname\" type=\"text\" value = \"$varFirstName";
                echo "\">";
                ?>
                <script type="text/javascript">
                    $('.ValidateAlphaAndSpecialKeys').on('input', function () {
                        var node = $(this);

                        node.val(node.val().replace(/[^a-z\s'-]/gi, ''));
                    });
                </script>
            </div>

            <div class="form-group col-md-2">
                <label for="inputCity">Other Name</label>
                <?php

                echo "<input name=\"othername\" type=\"text\" value = \"$varOtherNames";
                echo "\">";
                ?>
                <script type="text/javascript">
                    $('.ValidateAlphaAndSpecialKeys').on('input', function () {
                        var node = $(this);

                        node.val(node.val().replace(/[^a-z\s'-]/gi, ''));
                    });
                </script>
            </div>

        </div>
        <div class="row">
            <div class="form-group col-md-2">
                <label for="inputCity">Date of Birth</label><br>


                <?php
                if ($VarTscNo > 0) {
                    echo "<input name=\"DOB\" type=\"text\" readonly = \"\" value = \"$varDate";
                    echo "\">";

//echo "<input size = \"8\" name=\"DOB\" type=\"text\" readonly = \"\" style=\"background-color:#FF99FF\" value = \"$varDate";
//echo "\">";

                } else {
                    ?>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                    <script type="text/javascript">
                        $(function () {
                            var dtToday = new Date();
                            var month = dtToday.getMonth() + 1;// jan=0; feb=1 .......
                            var day = dtToday.getDate();
                            var year = dtToday.getFullYear() - 18;
                            if (month < 10)
                                month = '0' + month.toString();
                            if (day < 10)
                                day = '0' + day.toString();
                            var minDate = year + '-' + month + '-' + day;
                            var maxDate = year + '-' + month + '-' + day;
                            $('#DOB').attr('max', maxDate);
                        });
                    </script>

                    <input type="date" align="left" name="DOB" data-form-field="DOB" required="required" id="DOB"
                           placeholder="dd-mm-yyyy"
                           value="">
                <?php } ?>
            </div>

            <div class="form-group col-md-2">
                <label for="inputCity">ID Number</label>
                <input type="text" name="idNo" maxlength="8" required="required" readonly
                       value="<?php

                       echo $VarID_No;

                       ?>">
            </div>


            <div class="form-group col-md-2">
                <label for="inputCity">Gender</label><br>
                <?php if ($VarTscNo > 0) {
                    if (($varGender == "M") or ($varGender == "F")) {


                        echo "<input name=\"gender\" type=\"text\" readonly = \"\" value = \"$varGender";
                        echo "\">";

                    }

                } else {
                    ?>

                    <select id="country" name="gender">
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                    </select>

                    <?php
                } ?>
            </div>

            <script type="text/javascript">
                function blockSpecialChar(e) {
                    var k;
                    document.all ? k = e.keyCode : k = e.which;
                    return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32 || (k >= 48 && k <= 57));
                }
            </script>


            <div class="form-group col-md-2">
                <label for="inputCity">KRA Pin</label>
                <input type="text" onkeypress="return blockSpecialChar(event)" name="pinNo" maxlength="11"
                       placeholder="" required="required"
                       value="<?php
                       echo $varTaxPin;

                       ?>">

            </div>

        </div>


        <div class="row">
            <div class="form-group col-md-2">
                <label for="inputCity">Postal Address</label>
                <input type="text" onkeypress="return blockSpecialChar(event)" name="postal_address" maxlength="11"
                       placeholder="" required="required"
                       value="<?php
                       echo $varPostalAddress;

                       ?>">

            </div>


            <div class="form-group col-md-2">
                <label for="inputCity">Postal Code </label>
                <input type="text" onKeyPress="return blockSpecialChar(event);" name="postal_code"
                       placeholder="" required="required" value="<?php
                       echo $varPostalCode;

                       ?>">
            </div>


            <div class="form-group col-md-2">
                <label for="inputCity">Town/ City</label>
                <input type="text" onKeyPress="return ValidateAlpha(event);" name="town"
                       placeholder="<?php
                       echo $varTownCode;

                       ?>">
            </div>
            <div class="form-group col-md-2">
                <label for="inputCity">E-mail address</label>
                <input type="email" name="email" required="required" value="<?php echo $email ?>"
                       placeholder="e.g abc@tsc.go.ke">
            </div>

        </div>


        <div class="row">
            <div class="form-group col-md-2">
                <label for="inputCity">Nationality</label>
                <!--  <input type="text" name="nationality" required="required" placeholder="Nationality" > -->
                <select name="nationality">
                    <option>Kenyan</option>
                    <?php
                    $sql = mysqli_query($conn, "SELECT * FROM countries");
                    while ($row = $sql->fetch_assoc()) {
                        echo "<option value=" . $row['nationality'] . ">" . $row['nationality'] . "</option>";
                    }
                    ?>
                </select>
            </div>


            <div class="form-group col-md-2">
                <label for="inputCity">Home County</label><br>
                <?php if ($VarTscNo > 0) {
//echo $varHomecounty;

                    echo "<input name=\"county\" type=\"text\" readonly = \"\" value = \"$varHomecounty";
                    echo "\">";

                } else {
                    ?>

                    <select id="country" name="county" required="required">
                        <option value="">Select County</option>
                        <option value="Baringo">Baringo</option>
                        <option value="Bomet">Bomet</option>
                        <option value="Bungoma">Bungoma</option>
                        <option value="Busia">Busia</option>
                        <option value="Elgeyo Marakwet">Elgeyo Marakwet</option>
                        <option value="Embu">Embu</option>
                        <option value="Garissa">Garissa</option>
                        <option value="Homa Bay">Homa Bay</option>
                        <option value="Kajiado">Kajiado</option>
                        <option value="Kakamega">Kakamega</option>
                        <option value="Kericho">Kericho</option>
                        <option value="Kiambu">Kiambu</option>
                        <option value="Kilifi">Kilifi</option>
                        <option value="Kirinyaga">Kirinyaga</option>
                        <option value="Kisii">Kisii</option>
                        <option value="Kisumu">Kisumu</option>
                        <option value="Kitui">Kitui</option>
                        <option value="Kwale">Kwale</option>
                        <option value="Laikipia">Laikipia</option>
                        <option value="Lamu">Lamu</option>
                        <option value="Machakos">Machakos</option>
                        <option value="Makueni">Makueni</option>
                        <option value="Mandera">Mandera</option>
                        <option value="Meru">Meru</option>
                        <option value="Isiolo">Isiolo</option>
                        <option value="Migori">Migori</option>
                        <option value="Marsabit">Marsabit</option>
                        <option value="Mombasa">Mombasa</option>
                        <option value="Muranga">Muranga</option>
                        <option value="Nairobi">Nairobi</option>
                        <option value="Nakuru">Nakuru</option>
                        <option value="Nandi">Nandi</option>
                        <option value="Narok">Narok</option>
                        <option value="Nyamira">Nyamira</option>
                        <option value="Nyandarua">Nyandarua</option>
                        <option value="Nyeri">Nyeri</option>
                        <option value="Samburu">Samburu</option>
                        <option value="Taita Taveta">Taita Taveta</option>
                        <option value="Tana River">Tana River</option>
                        <option value="Tharaka Nithi">Tharaka Nithi</option>
                        <option value="Trans Nzoia">Trans Nzoia</option>
                        <option value="Turkana">Turkana</option>
                        <option value="Uasin Gishu">Uasin Gishu</option>
                        <option value="Vihiga">Vihiga</option>
                        <option value="Siaya">Siaya</option>
                        <option value="Wajir">Wajir</option>
                        <option value="West Pokot">West Pokot</option>
                    </select>

                    <?php
                }
                ?>
            </div>
            <div class="form-group col-md-2">

                <label for="inputCity">KCSE GRADE</label>
                <!--  <input type="text" name="nationality" required="required" placeholder="Nationality" > -->
                <select name="grade">
                    <option><?php echo $varGrade; ?></option>
                    <?php
                    $sql = mysqli_query($conn, "SELECT * FROM academic_grades");
                    while ($row = $sql->fetch_assoc()) {
                        echo "<option value=" . $row['grade'] . ">" . $row['grade'] . "</option>";
                    }
                    ?>
                </select>

            </div>
        </div>
        <hr>
        <div class="row">

            <div class="form-group col-md-2">
                <label for="inputCity">Alternative Contact Person</label>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                <input type="text" class="ValidateAlphaAndSpecialKeys" name="contactPersonName" required="required"
                       value="<?php echo $alt_person_name
                       ?>" placeholder="e.g. John Doe">
                <script type="text/javascript">
                    $('.ValidateAlphaAndSpecialKeys').on('input', function () {
                        var node = $(this);

                        node.val(node.val().replace(/[^a-z\s'-]/gi, ''));
                    });
                </script>
            </div>

            <div class="form-group col-md-2">
                <label for="inputCity">Telephone No</label>
                <input type="text" maxlength="10" pattern="\d{10}" value="<?php echo $alt_tel_no; ?>"
                       onkeypress="return blockSpecialChar(event)" name="mobile" maxlength="11"
                       placeholder="" required="required"
                >

            </div>


        </div>
        <hr>


        <?php
        if ($VarTscNo > 0) {
            ?>

            <div class="row">

                <div class="form-row">


                    <div class="form-group col-md-2">
                        <label for="inputPassword4">TSC No</label>
                        <input type="text" pattern="/^-?\d+\.?\d*$/"
                               onKeyPress="if(this.value.length==10) return false;" name="TSCNo" id="TSCNo"
                               placeholder="" readonly
                               value="<?php
                               if ($VarTscNo > 0) {
                                   echo $varPayrollNum;
                               } ?>">
                    </div>


                    <div class="form-group col-md-2">
                        <label for="inputPassword4">Present Submitive Post</label>
                        <input type="text" onKeyPress="return ValidateAlpha(event);" name="PresentSubmitivePost"
                               placeholder="" readonly
                               value="<?php
                               if ($VarTscNo > 0) {
                                   echo $varDesigName;
                               } ?>">
                    </div>


                    <div class="form-group col-md-2">
                        <label for="inputEmail4">Station</label>
                        <input type="text" onKeyPress="return ValidateAlpha(event);" name="station" placeholder=""
                               readonly
                               value="<?php

                               if ($VarTscNo > 0) {
                                   echo $varStationName;
                               } ?>">
                    </div>

                </div>
            </div>

            <div class="row">


                <div class="form-group col-md-2">
                    <label for="inputPassword4">Job group/Scale/Grade</label>
                    <input type="text" name="jobGroup" placeholder="" readonly
                           value="<?php
                           if ($VarTscNo > 0) {
                               echo $varJobDesig;
                           } ?>">
                </div>


                <div class="form-group col-md-2">
                    <label>Date Of Current Apointment</label>
                    <input type="text" onKeyPress="return ValidateAlpha(event);" name="DateOfCurrentApointment"
                           placeholder="" readonly
                           value="<?php
                           if ($VarTscNo > 0) {
                               echo $varDateOfPost;
                           } ?>">
                </div>

            </div>

            <?php
        } else {
            ?>

            <div class="row">

                <div class="form-row">
                    <div class="form-group col-md-2">

                        <label for="inputPassword4">Current employer(where applicable)</label>

                        <input type="text" onKeyPress="return ValidateAlpha(event);" name="currentEmployer"
                               placeholder="">
                    </div>
                    <div class="form-group col-md-2">
                        <label><strong>Position held:</strong></label>
                        <input type="text" onKeyPress="return ValidateAlpha(event);" name="positionHeld" placeholder="">
                        </tr>
                    </div>
                    <div class="form-group col-md-2">
                        <label><strong>Effective date:</strong></label>
                        <input type="date" name="EffectiveDate" placeholder="dd-mm-yyyy">
                    </div>
                    <div class="form-group col-md-2">
                        <label><strong>Gross Salary(monthly)Ksh:</strong></label>
                        <!--  <input type="text" name="GrossSalary" placeholder="" > -->
                        <select id="country" name="GrossSalary">
                            <option value="D">23,895-44,712</option>
                            <option value="E">26,458-49,352</option>
                            <option value="F">32,979-51,124</option>
                            <option value="G">41,628-69,817</option>
                            <option value="H">44,159-67,197</option>
                            <option value="J">56,725-89,538</option>
                            <option value="K">68,646-97,959</option>
                            <option value="L">89,474-128,654</option>
                            <option value="M">115,224-140,107</option>
                            <option value="N">143,222-169,445</option>
                            <option value="P">168,446-195,248</option>
                            <option value="Q">196,460-226,098</option>
                            <option value="R">229,896-282,774</option>
                            <option value="S">286,073-350,109</option>
                            <option value="T">352,300-429,873</option>
                            <option value="U">430,000-500,000</option>
                            <option value="above500000">Above 500,000</option>

                        </select>
                    </div>


                </div>

            </div>

            <?php
        }
        ?>

        <div class="row">
            <hr>

            <div class="form-group col-md-2">

                <label for="inputCity">Are you living with a Disability</label><br>
                <input type="radio" onclick="javascript:yesnoCheck();" name="yesno" id="yesCheck" required="required"
                       value="YES"/>Yes
                <input type="radio" onclick="javascript:yesnoCheck();" name="yesno" id="noCheck" value="NO" checked/>No
            </div>
        </div>


        <div class="row">
            <div class="col-md-6">
                <hr>

                <?php

                $sql_applicant_details = "SELECT upload_id FROM applicant_details WHERE id_no='$varIdNumber'";
                $results_applicant_details = mysqli_query($conn, $sql_applicant_details);
                $count1 = mysqli_num_rows($results_applicant_details);
                if ($count1 > 0){
                while ($row_applicant_details = mysqli_fetch_array($results_applicant_details)){

                ?>


                <?php
                if ($row_applicant_details['upload_id'] == 0) {
                    ?>
                    <p>Upload Your Identification Doc *</p>

                    <span class="controls">  <input name="uploadfile"
                                                    style="background-color: lavender; border-radius:20px" type="file"
                                                    id="upload_id" value=""/></span>
                    <?php
                } else {

                ?>

                <p>Uploaded ID</p>
                <div class="alert alert-success col-md-12">

                    <!--        <img style="height: 100%;width: 100%" src="././sectionTwo/uploads/-->
                    <?php //echo $row_applicant_details['upload_id'];  ?><!--"  </img>-->
                    <input name="uploadfile" style="background-color: lavender; border-radius:20px" type="hidden"
                           id="upload_id" required value="<?php echo $row_applicant_details['upload_id']; ?>"/>


                    <div class="col-md-4">
                        <strong><i class='fas fa-user-check'></i>Identification Document uploaded Successfully
                            !</strong>


                    </div>
                    <div class="col-md-4">
                        <a href="././sectionTwo/uploads/<?php echo $row_applicant_details['upload_id']; ?>"
                           class="btn btn-sm"><span class="glyphicon glyphicon-eye-close"></span> View Id </a>

                    </div>
                    <div class="col-md-4">
                        <a href="?upload_delete_id=<?php echo $varIdNumber ?>" class="btn btn-sm" onclick="myFunction()"
                           name="btndeleteid"><span class="glyphicon glyphicon-trash"></span> Delete Id</a>
                    </div>

                </div>

                <script>
                    function myFunction() {
                        confirm("Are you sure you want to remove your Id Document?");
                    }
                </script>
                <hr>


            </div>

            <hr>
            <?php
            }
            }
            ?>
            <?php

            }else{
                   ?>
                <p>Upload Your Identification Doc *</p>

                <span class="controls">  <input name="uploadfile"
                                                style="background-color: lavender; border-radius:20px" type="file"
                                                id="upload_id" value=""/></span>
            <?php
            }
            ?>


        </div>

        <hr>
</div>


<div class="row">
    <br>
    <div id="ifYes" style="visibility:hidden">

        <div class="form-group col-md-3">
            <label for="inputCity">i) Nature of disability</label>
            <input type="text" onKeyPress="return ValidateAlpha(event);" id='yes' name="detailOfDisability"
                   default="None">

        </div>
        <div class="form-group col-md-3">
            <label for="inputCity">ii) Details of Registration with the National council for people with
                disabilities</label>
            <div class="row">
                <div class="form-group col-md-3">
                    <label>Registration No</label>
                    <input type="text" id='yes' name="RegistrationDisabilityNo">
                </div>

            </div>


        </div>
        <div class="form-group col-md-3">
            <label>Registration Date</label>
            <input type="date" align="left" name="dateOfDisabilityRegistration"
                   data-form-field="dateOfDisabilityRegistration" id="dateOfDisabilityRegistration"
                   placeholder="dd-mm-yyyy">
        </div>


    </div>
</div>


<div class="row">
    <div class="form-group col-md-4">
        <a href="./secOne.php" class="btn"><< Previous</a>
    </div>
    <div class="form-group col-md-4">
        <input type="submit" class="btn" style="margin-left:-12%;" name="btnSubmitProfile" value="Save">
    </div>
    <div class="form-group col-md-4">
        <!--                <input type="submit" style="margin-left:10%;"name="btnSubmitProfile" value="Next >>" onclick="window.location.href='secThree.php'">-->
        <a id="btnCheck" class="btn">Next>></a>
    </div>

</div>


</form>
</div>
</div>

</body>
<script type="text/javascript">
    $(function () {
        $("#btnCheck").click(function () {
            if ($.trim($("#upload_id").val()) == "") {
                $("#upload_id").prop('required', true);
                alert("Please Upload Id to proceed!");
            } else {
                window.location.href = 'secThree.php';

            }
        });
    });
</script>

</html>


<?php
/*$submit=$_POST['btnSubmitProfile'];

if(isset($submit))
{
	include('../progressBar/index.php');
*/


?>


