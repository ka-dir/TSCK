<?php
ob_start();
include('header.php');
$id_number = $_SESSION['id_number'];
include('includes/topsection.php');
function addslashesifneeded($stringtocheck)
{
    if (!get_magic_quotes_gpc()) {
        $goodstring = addslashes($stringtocheck);
    } else {
        $goodstring = $stringtocheck;
    }
    return $goodstring;
}


//Insert New Record
if (isset($_POST['btnIinsertNew'])) {
    $date = date('Y-m-d');
    $date_from = $_POST['date_from'];
    $employer_telephone = addslashesifneeded(strtoupper($_POST['employer_telephone']));
    $date_to = isset($_POST['date_to'])  ? $_POST['date_to'] : $date;
    $employer_email = addslashesifneeded(strtoupper($_POST['employer_email']));
    $designation_position = addslashesifneeded(strtoupper($_POST['designation_position']));
    $state_status = $_POST['status'];
    $job_group = $_POST['job_group'];
    $ministry = addslashesifneeded(strtoupper($_POST['ministry']));

    $datetime1 = new DateTime($date_from);
    $datetime2 = new DateTime($date_to);
    $interval = $datetime1->diff($datetime2);
    $dateDiff = $interval->format('%y years %m months and %d days');
    //echo $dateDiff;


    $sql = "INSERT INTO employment_detail (id_number, date_from,employer_telephone, date_to,employer_email, designation_position,state_status, job_group, ministry,dateDiff)
	 VALUES ('$id_number','$date_from','$employer_telephone','$date_to','$employer_email','$designation_position','$state_status','$job_group','$ministry','$dateDiff')";
    $result = $conn->query($sql) or die(mysqli_error($conn));
    $_SESSION['message'] = "Success Record Saved";
    $_SESSION['msg_type'] = "info";
    header("location: secEight.php");
} // user is editing stuff:
elseif (isset($_POST['btnEdit'])) {
    include('edit.php');
    //die();

} //Edit Save

elseif (isset($_POST['btnEditSave'])) {

    function addslashes_recursive($data)
    {
        if (is_array($data)) {
            return array_map('addslashes', $data);
        } else {
            return addslashes($data);
        }
    }

    $employment_detail_id = $_POST['employment_detail_id'];
    $date_from = $_POST['date_from'];
    $employer_telephone = $_POST['employer_telephone'];
    $date_to = $_POST['date_to'];
    $employer_email = $_POST['employer_email'];
    $designation_position = addslashes_recursive($_POST['designation_position']);
    $state_status = $_POST['state_status'];
    $job_group = $_POST['job_group'];
    $ministry = addslashes_recursive($_POST['ministry']);

    $N = count($employment_detail_id);
    for ($i = 0; $i < $N; $i++) {
        $datetime1 = new DateTime($date_from[$i]);
        $datetime2 = new DateTime($date_to[$i]);
        $interval = $datetime1->diff($datetime2);
        $dateDiff[$i] = $interval->format('%y years %m months and %d days');
        //echo $dateDiff;

        $result = mysqli_query($dbconnection, "UPDATE employment_detail SET date_from='$date_from[$i]', employer_telephone='$employer_telephone[$i]',date_to='$date_to[$i]',employer_email='$employer_email[$i]', designation_position='$designation_position[$i]',state_status='$state_status[$i]' ,job_group='$job_group[$i]' , ministry='$ministry[$i]',dateDiff='$dateDiff[$i]'  where employment_detail_id='$employment_detail_id[$i]'") or die(mysqli_error($dbconnection));
    }
    $_SESSION['message'] = "Success Record Edited";
    $_SESSION['msg_type'] = "warning";
    header("location: secEight.php");
} //.......................................... //next button ................................................................
elseif (isset($_POST['btnSubmitProfile'])) {
    $date_from = $_POST['date_from'];
    $employer_telephone = addslashesifneeded(strtoupper($_POST['employer_telephone']));
    $date_to = $_POST['date_to'];
    $employer_email = addslashesifneeded(strtoupper($_POST['employer_email']));
    $designation_position = addslashesifneeded(strtoupper($_POST['designation_position']));
    $state_status = $_POST['state_status'];
    $job_group = $_POST['job_group'];
    $ministry = addslashesifneeded(strtoupper($_POST['ministry']));

    $datetime1 = new DateTime($date_from);
    $datetime2 = new DateTime($date_to);
    $interval = $datetime1->diff($datetime2);
    $dateDiff = $interval->format('%y years %m months and %d days');
    //echo $dateDiff;


    $sql = "INSERT INTO employment_detail (id_number, date_from,employer_telephone, date_to,employer_email, designation_position,state_status, job_group, ministry,dateDiff)
	 VALUES ('$id_number','$date_from','$employer_telephone','$date_to','$employer_email','$designation_position','$state_status','$job_group','$ministry','$dateDiff')";
    $result = $conn->query($sql) or die(mysqli_error($conn));
    header("location: secNine.php");


} // user is deleting stuff:
elseif (isset($_POST['btnDelete'])) {
    $employment_detail_id = $_POST['employment_detail_id'];

    $N = count($employment_detail_id);
    for ($i = 0; $i < $N; $i++) {
        $sql = "DELETE FROM `employment_detail` where employment_detail_id='" . $employment_detail_id[$i] . "'";
        $result = $dbconnection->query($sql);
        if (!$result) {
            echo mysqli_error($dbconnection);
        }
    }
    $_SESSION['message'] = "Success Record Deleted";
    $_SESSION['msg_type'] = "danger";
    header("location: secEight.php");

} // user is doing nothing, it's his/her first time (ooer)
else {
    ob_end_flush();
    ?>
    <head>


    </head>

    <body style="margin-top: -25px;">
    <h3>8. Employment Details </h3>
    <div class="container" style="width:100%; margin-left:-5px;">
        <?php
        if (isset($_SESSION['message'])):
            ?>
            <div class="alert alert-<?= $_SESSION['msg_type'] ?>">
                <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                ?>
            </div>
        <?php
        endif;
        ?>
        <form name="frmAcademic8" action="" method="post" onsubmit="return validateForm()">
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                <thead style="background-color: #314C95;color:#FFFFFF;">
                <tr>
                    <th style="text-align:center; font-size:12px; ">From</th>
                    <th style="text-align:center; font-size:12px; ">To</th>
                    <th style="text-align:center; font-size:12px; ">Designation/Position</th>
                    <th style="text-align:center; font-size:12px; ">Job Group/Grade/Scale(Gross Monthly Salary)</th>
                    <th style="text-align:center; font-size:12px; ">Ministry/State Department/Institution/Organization
                    </th>
                    <th style="text-align:center; font-size:12px; ">Employer Details</th>

                    <th style="text-align:center;  font-size:12px; ">Action</th>

                </tr>
                </thead>
                <tbody>
                <?php
                //$varTableName = 'testmember';
                $query = mysqli_query($dbconnection, "select * from employment_detail WHERE id_number='" . $id_number . "'ORDER BY date_to DESC") or die(mysqli_error());
                while ($row = mysqli_fetch_array($query)){
                $employment_detail_id = $row['employment_detail_id'];
                ?>
                <tr>
                    <td style="text-align:center; font-size:12px;"><?php echo $row['date_from'] ?></td>
                    <td style="text-align:center; font-size:12px;"><?php echo $row['date_to'] ?></td>
                    <td style="text-align:center; font-size:12px;"><?php echo $row['designation_position'] ?></td>
                    <td style="text-align:center; font-size:12px;"><?php echo $row['job_group'] ?></td>
                    <td style="text-align:center; font-size:12px;"><?php echo $row['ministry'] ?></td>
                    <td style="text-align:center; font-size:12px;">
                            <?php
                            echo $row['employer_telephone'] > 0? 'Email: '.$row['employer_email'].'<br>'.
                                'Mobile: '.$row['employer_telephone'].'' : 'N/A';
                            ?>
                    </td>
    </div>


    </td>
    <td style="text-align:center; font-size:12px;">
        <!-- <input name="selector[]" type="radio" id="r1" value="<?php echo $employment_detail_id; ?>"> -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                        
						<?php $res = mysqli_fetch_array($result) ?>
						<a href="./SectionEight/delete.php?del=<?php echo $employment_detail_id;?>" onClick="return confirm('Are you sure you want to delete?')"
						class="fa" style="font-size:24px;text-decoration: none">&#xf1f8;</a>
    </td>
    </tr>
    <?php } ?>
    </tbody>
    </table>
    <br/>
    <!-- <button name="btnEdit" class="btn btn-success pull-right" style="background: #314C95;" name="submit_mult"
            type="submit">
        Update
    </button> -->
    </form>

    <br>
    <br>

    <form class="form-vertical" action="" method="post">

        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
            <thead style="background-color: #314C95;color:#FFFFFF;">
            <tr>
                <th style="text-align:center; font-size:12px; ">From</th>
                <th style="text-align:center; font-size:12px; ">To</th>
                <th style="text-align:center; font-size:12px; ">Designation/Position</th>
                <th style="text-align:center; font-size:12px; ">Job Group/Grade/Scale(Gross Monthly Salary)</th>
                <th style="text-align:center; font-size:12px; ">Ministry/State Department/Institution/Organization</th>

            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="align: center">
                    <div class="form-row">
                        <div class="form-group col-md-12 mb-0">


                    <span class="controls">
			  <input name="date_from" id="txtStartDate" type="date" value="<?php echo $row['date_from'] ?>"/>
			  <input name="status" id="status" type="hidden" value="0"/>
                    </span>
                    <hr>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="current_employer">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Current Employer
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="latest_employer">
                        <label class="form-check-label" for="flexRadioDefault2">
                            Latest Employer
                        </label>
                    </div>

                    <div class="form-check" id="reset_div" style="display:none">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="reset">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Reset
                        </label>
                    </div>
                    <hr>
                    <div class="form-group" id="employer_telephone_div" style="display:none">
                        <label for="" style="background: darkblue;color: white;display: block">Employer
                            Telephone</label>
                        <input type="text" class="form-control" maxlength="10" pattern="\d{10}" name="employer_telephone" id="employer_telephone">
                    </div>

                    <div class="form-group" id="employer_email_div" style="display:none">
                        <label for="" style="background: darkblue;color: white;display: block">Employer Email</label>
                        <input type="email" class="form-control" name="employer_email" id="employer_email">
                    </div>

                    </span>
                        </div>
                    </div></td>
                <td><span class="controls">
			  <input name="date_to" id="txtEndDate" onchange="TDate()" required="required" type="date"
                     value="<?php echo $row['date_to'] ?>"/>
                     <hr>

			</span></td>
                <td><span class="controls">
			  <input name="designation_position" required="required" type="text"
                     style="font-family:cursive; font-weight:bold;" value="<?php echo $row['designation_position'] ?>"/>
			</span></td>


                <td><span class="controls">

<select id="country" name="job_group">
    	  <option value="23,895-44,712">23,895-44,712</option>
	  <option value="26,458-49,352">26,458-49,352</option>
    	  <option value="32,979-51,124">32,979-51,124</option>
	  <option value="41,628-69,817">41,628-69,817</option>
    	  <option value="44,159-67,197">44,159-67,197</option>
      	  <option value="56,725-89,538">56,725-89,538</option>
	  <option value="68,646-97,959">68,646-97,959</option>
	  <option value="89,474-128,654">89,474-128,654</option>
	  <option value="115,224-140,107">115,224-140,107</option>
	  <option value="143,222-169,445">143,222-169,445</option>
	  <option value="168,446-195,248">168,446-195,248</option>
	  <option value="196,460-226,098">196,460-226,098</option>
	  <option value="229,896-282,774">229,896-282,774</option>
	  <option value="286,073-350,109">286,073-350,109</option>
	  <option value="352,300-429,873">352,300-429,873</option>
	  <option value="430,000-500,000">430,000-500,000</option>
	  <option value="above500000">Above 500,000</option>
</select>

			</span></td>


                <td><span class="controls">
			  <input name="ministry" required="required" type="text" style="font-family:cursive; font-weight:bold;"
                     value="<?php echo $row['ministry'] ?>"/>
			</span></td>
            </tr>
            </tbody>
        </table>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <a href="./secSeven.php" role="button" class="btn btn-success pull-left"
                   style="margin-left:1%;background: #314C95;"><< Previous</a>
            </div>
            <div class="form-group col-md-4">
                <input name="btnIinsertNew" class="btn btn-success pull-right" style="padding:20px;" type="submit"
                       value="Save" onmouseover="DateCheck()">
            </div>
            <div class="form-group col-md-4">
                <!--a href="./secNine.php" role="button" class="btn btn-success " style="margin-left:77%; background: #314C95;"> Next >></a-->

                <input type="submit" name="btnSubmitProfile" style="margin-left:65%;" value="Next >>"
                       onclick="window.location.href='secNine.php'">

            </div>

        </div>
    </form>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

    </body>
    <script>
        $(document).ready(function () {

            $("#current_employer").click(function(){
                const radioValue = $("input[name=current_employer]:checked").val();
                $("#employer_telephone_div").css("display", "block");
                $("#reset_div").css("display", "block");
                $("#employer_telephone").prop('required', true);
                $("#txtEndDate").prop('required', false);
                $("#txtEndDate").attr("disabled", "disabled");
                $("#txtEndDate").val("");
                $("#status").val(1);

                $("#employer_email_div").css("display", "block");
                $("#employer_email").prop('required', true);

            });

            $("#latest_employer").click(function(){
                var radioValue = $("input[name=latest_employer]:checked").val();
                $("#employer_telephone_div").css("display", "block");
                $("#reset_div").css("display", "block");
                $("#employer_telephone").prop('required', true);
                $("#txtEndDate").attr("disabled", false);
                $("#txtEndDate").prop('required', false);
                $("#status").val(2);

                //$("#txtEndDate").val("");

                $("#employer_email_div").css("display", "block");
                $("#employer_email").prop('required', true);

            });

            $("#reset").click(function(){
                var radioValue = $("input[name=reset_div]:checked").val();
                $("#employer_telephone_div").css("display", "none");
                $("#reset_div").css("display", "none");
                $("#employer_telephone").prop('required', false);
                $("#txtEndDate").attr("disabled", false);
                $("#txtEndDate").prop('required', true);
                $("#reset").prop('required', false);
                $("#status").val(0);
                $("#employer_email_div").css("display", "none");
                $("#employer_email").prop('required', false);

            });
        });

        function DateCheck() {
            var StartDate = document.getElementById('txtStartDate').value;
            var EndDate = document.getElementById('txtEndDate').value;
            var eDate = new Date(EndDate);
            var sDate = new Date(StartDate);
            if (StartDate != '' && StartDate != '' && sDate > eDate) {
                alert("Please ensure that the year to Date is greater than the Start year Date!!!!!!.");

                document.getElementById("txtEndDate").value = "";
                document.getElementById("txtStartDate").value = "";
                setTimeout(function () {
                    document.getElementById("txtEndDate").innerHTML = "";
                }, 4000 * 1);
            }
        }

        function TDate() {
            var UserDate = document.getElementById("txtEndDate").value;
            var ToDate = new Date();

            if (new Date(UserDate).getTime() >= ToDate.getTime()) {
                alert("The year to must be less than todays date!!!!!!!!");
                document.getElementById("txtEndDate").value = "";
            }
        }

        function validateForm() {
            if ($('input[id=r1]:checked').length <= 0) {
                alert("No entry is selected");
                return false;
            }

        }

    </script>


    </html>
    <?php
} ?>
