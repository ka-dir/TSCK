<?php
session_start();
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('header.php');
$id_number=$_SESSION['id_number'];

include('includes/topsection.php');

function addslashesifneeded ($stringtocheck)
{
    if (!get_magic_quotes_gpc()) {
        $goodstring = addslashes($stringtocheck);
    } else {
        $goodstring = $stringtocheck;
    }
    return $goodstring;
}
//Insert New Record
if(isset($_POST['btnIinsertNew']))
{

    $varToday=date('l jS \of F Y h:i:s A');
    $datefrom=$_POST['date_from'];
    $dateto=$_POST['date_to'];
    $university=addslashesifneeded(strtoupper($_POST['university']));
    $award=addslashesifneeded(strtoupper($_POST['award']));
    $course=addslashesifneeded(strtoupper($_POST['course']));
    $specialisation=addslashesifneeded(strtoupper($_POST['specialisation']));
    $cert_no=$_POST['cert_no'];
    $cert_year=$_POST['cert_year'];
    $datetime1 = new DateTime($datefrom);
    $datetime2 = new DateTime($dateto);
    $interval = $datetime1->diff($datetime2);
    $dateDiff=$interval->format('%y years %m months and %d days');
    //echo $dateDiff;

    $filename = $_FILES["uploadfile"]["name"];

    /* $saved_file_name=$id_number .'_'.$award. '_'.$course;*/

    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "././sectionFour/uploads/" . $filename;

    $sql = "INSERT INTO academic_qualification 
	(
	id_number, 
	date_from,
	date_to, 
	university,
	award_id,
	course_id,
	specialization_id,
	upload_cert,
	cert_no,
	cert_year,
	dateDiff)
	 VALUES (
	 '$id_number',
	 '$datefrom',
	 '$dateto',
	 '$university',
	 '$award',
	'$course',  
	'$specialisation',
	'$filename',
	 '$cert_no',
	 '$cert_year',
	 '$dateDiff'
	 )";
    // Execute query
    mysqli_query($conn, $sql);

    // Now let's move the uploaded image into the folder: image
    if (move_uploaded_file($tempname, $folder)) {
        $_SESSION['message']="Success Record Saved";
        $_SESSION['msg_type']="info";

        header("Location: secFour.php");
    } else {
        $_SESSION['message']="Failed... Error Occurred";
        $_SESSION['msg_type']="danger";
        header("Location: secFour.php");
    }

}

// user is editing stuff:
elseif(isset($_POST['btnEdit']))
{
    include('edit.php');
    //die();
}

//Edit Save

elseif(isset($_POST['btnEditSave']))
{

    function addslashes_recursive( $data )
    {
        if ( is_array( $data ) )
        {
            return array_map( 'addslashes', $data );
        }
        else
        {
            return addslashes( $data );
        }
    }
    $id=$_POST['id'];
    $datefrom=$_POST['date_from'];
    $dateto=$_POST['date_to'];
    $university=addslashes_recursive($_POST['university']);
    $award=addslashes_recursive($_POST['award_id']);
    $course=addslashes_recursive($_POST['course_id']);
    $specialisation=addslashes_recursive($_POST['specialization_id']);
    $cert_no=$_POST['cert_no'];
    $cert_year=$_POST['cert_year'];


    $N = count($id);
    for($i=0; $i < $N; $i++)
    {

        $datetime1 = new DateTime($datefrom[$i]);
        $datetime2 = new DateTime($dateto[$i]);
        $interval = $datetime1->diff($datetime2);
        $dateDiff[$i]=$interval->format('%y years %m months and %d days');
        //echo $dateDiff;
        $result = mysqli_query($dbconnection, "UPDATE academic_qualification SET id_number='$id_number', date_from='$datefrom[$i]', date_to='$dateto[$i]', university='$university[$i]' ,award_id='$award[$i]',course_id='$course[$i]',specialization_id='$specialisation[$i]',cert_no='$cert_no[$i]',cert_year='$cert_year[$i]',dateDiff='$dateDiff[$i]' where id='$id[$i]'")or die(mysqli_error($dbconnection));
    }
    header("Location: secFour.php");
}
//.......................................... //next button ................................................................
elseif(isset($_POST['btnSubmitProfile']))
{
    $varToday=date('l jS \of F Y h:i:s A');
    $datefrom=$_POST['date_from'];
    $dateto=$_POST['date_to'];
    $university=addslashesifneeded(strtoupper($_POST['university']));
    $award=addslashesifneeded(strtoupper($_POST['award']));
    $course=addslashesifneeded(strtoupper($_POST['course']));
    $specialisation=addslashesifneeded(strtoupper($_POST['specialisation']));
    $cert_no=$_POST['cert_no'];
    $cert_year=$_POST['cert_year'];
    $datetime1 = new DateTime($datefrom);
    $datetime2 = new DateTime($dateto);
    $interval = $datetime1->diff($datetime2);
    $dateDiff=$interval->format('%y years %m months and %d days');
    //echo $dateDiff;

    $sql = "INSERT INTO academic_qualification 
	(
	id_number, 
	date_from,
	date_to, 
	university,
	award_id,
	course_id,
	specialization_id,
	cert_no,
	cert_year,
	dateDiff)
	 VALUES (
	 '$id_number',
	 '$datefrom',
	 '$dateto',
	 '$university',
	 '$award',
	 '$course',
	 '$specialisation',
	 '$cert_no',
	 '$cert_year',
	 '$dateDiff'
	 )";
    if(mysqli_query($conn, $sql))
    {
        echo "Records inserted successfully.";
        header("Location: secFive.php");
    } else
    {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
        //trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);
    }

    //$conn->query($sql);
    //header("location: secFour.php");

}



// user is deleting stuff:
elseif(isset($_POST['btnDelete']))
{


    $id=$_POST['id'];

    $N =count($id);
    for($i=0; $i < $N; $i++)
    {
        $sql="DELETE FROM `academic_qualification` WHERE `id`='".$id[$i]."'";
        $result=$dbconnection->query($sql);
        if(!$result)
        {
            echo mysqli_error($dbconnection);
        }
    }
    header("location: secFour.php");

}
// user is doing nothing, it's his/her first time (ooer)
else
{
    ob_end_flush();
    ?>
    <head>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



    </head>

    <body style="margin-top: -25px;">
    <h3> 4. Academic Qualifications (Start with the Highest) </h3>
    <div class="container" style="width:100%; margin-left:-5px;">

        <?php
        if(isset($_SESSION['message'])):
            ?>
            <div class="alert alert-<?=$_SESSION['msg_type']?>">
                <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                ?>
            </div>
        <?php
        endif;
        ?>
        <form name="frmAcademic4" action="" method="post" onsubmit="return validateForm()">

            <table cellpadding="0"  cellspacing="0" border="0" class="table table-striped table-bordered" id="example" >
                <thead style="background-color: #314C95;color:#FFFFFF;">
                <tr>
                    <th style="text-align:center; font-size:12px; ">From Year</th>
                    <th style="text-align:center;  font-size:12px; ">To Year</th>
                    <th style="text-align:center; font-size:12px; ">University/School</th>
                    <th style="text-align:center;  font-size:12px; ">Award/Attainment(masters,bachelors) </th>
                    <th style="text-align:center;  font-size:12px; ">Course/Program(e.g PhD,MSc,BA,O'Level etc</th>
                    <th style="text-align:center;  font-size:12px; ">Specialization/Subject (e.g Econ,Math,Sociology etc)</th>
                    <th style="text-align:center;  font-size:12px; ">Certicate Number</th>
                    <th style="text-align:center;  font-size:12px; ">Certificate year</th>
                    <th style="text-align:center; font-family:cursive; font-size:12px; ">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                //$varTableName = 'testmember';
                $query=mysqli_query($dbconnection,
                    "select aq.id as aqID,aq.date_from,aq.date_to,aq.university,aq.cert_no,aq.cert_year,aq.upload_cert,a.award,c.course_desc,s.name
		from academic_qualification as aq
		join award as a on aq.award_id=a.id
		join courses as c on aq.course_id=c.course_id
		join specialization as s on aq.specialization_id=s.id
		
		WHERE aq.id_number='".$id_number."'

		ORDER BY 	aq.date_to desc")or die(mysqli_error($dbconnection));

                while($row=mysqli_fetch_array($query))
                {
                    $id=$row['aqID'];
                    ?>
                    <tr>
                        <td style="text-align:center;  font-size:12px;"><?php echo $row['date_from'] ?></td>
                        <td style="text-align:center;  font-size:12px;"><?php echo $row['date_to'] ?></td>
                        <td style="text-align:center;  font-size:12px;"><?php echo $row['university'] ?></td>
                        <td style="text-align:center;  font-size:12px;"><?php echo $row['award'] ?></td>

                        <td style="text-align:center; font-size:12px;"><?php echo $row['course_desc'] ?></td>

                        <td style="text-align:center; font-size:12px;"><?php echo $row['name'] ?></td>
                        <!--<td style="text-align:center; font-size:12px;"><?php /*echo $row['upload_cert'] */?></td>-->



                        <td style="text-align:center;  font-size:12px;"><?php echo $row['cert_no'] ?></td>
                        <td style="text-align:center;  font-size:12px;"><?php echo $row['cert_year'] ?></td>
                        <td style="text-align:center; font-size:12px;">

                            <a href="././sectionFour/uploads/<?php echo $row['upload_cert']; ?>" class="fa" style="font-size:24px;text-decoration: none" target="_blank">&#xf06e; </a>

                            <input name="selector[]"  id="r1" type="radio" value="<?php echo $id; ?>">
                        </td>
                    </tr>
                <?php  } ?>
                </tbody>
            </table>
            <br />
            <button name="btnEdit" class="btn btn-success pull-right" style="background-color:#314C95" name="submit_mult" type="submit">
                Update
            </button>
        </form>

        <br>
        <p style="color:red">KINDLY PROVIDE THE ACADEMIC REQUIREMENTS PER THE ADVERT SELECTED</p>
        <br>

        <form class="form-vertical" action="" method="post" enctype="multipart/form-data">

            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                <thead style="background-color: #314C95;color:#FFFFFF;">
                <tr>
                    <th style="text-align:center; font-size:12px; ">From Year</th>
                    <th style="text-align:center; font-size:12px; ">To Year</th>
                    <th style="text-align:center; font-size:12px; ">University/School</th>
                    <th style="text-align:center; font-size:12px;">Award/Attainment(masters,bachelors)uu</th>
                    <th style="text-align:center; font-size:12px;">Course/Program(e.g PhD,MSc,BA,O'Level etc</th>
                    <th style="text-align:center; font-size:12px;">Specialization/Subject (e.g Econ,Math,Sociology etc)</th>
                    <th style="text-align:center; font-size:12px;">Upload Certificate</th>
                    <th style="text-align:center;  font-size:12px; ">Certificate Number</th>
                    <th style="text-align:center;  font-size:12px; ">Certificate year</th>

                </tr>
                </thead>
                <tbody>
                <tr align="center">
                    <td><span class="controls">
			  <input name="date_from" id="txtStartDate"  type="date" required="required" value="<?php echo $row['date_from'] ?>" />
			</span></td>
                    <td><span class="controls">
			  <input name="date_to" id="txtEndDate"  onchange="TDate()" type="date" required="required" value="<?php echo $row['date_to'] ?>" />
			</span></td>
                    <td><span class="controls">
			  <input name="university" type="text" required="required" style=" font-weight:bold;" value="<?php echo $row['university'] ?>" />
			</span></td>
                    <td>
			<span class="controls">
			<select name="award">
				<?php
                $sql = mysqli_query($conn, "SELECT id,award FROM award where status=0 ORDER BY award ASC");
                while ($row = $sql->fetch_assoc())
                {
                    $award=$row['award'];
                    $id=$row['id'];
                    ?>
                    <option value="<?php echo $id  ;?>" >
				<?php echo $award ;?>
				</option>
                    <?php
                }
                ?>
			</select>

			</span>
                    </td>
                    <td><span class="controls">
			 <!-- <input name="course" type="text" required="required"style=" font-weight:bold;" value="<?php echo $row['course'] ?>" /> -->

			<select name="course">
			<?php
            $sql = mysqli_query($conn, "SELECT course_id,course_desc FROM courses ORDER BY course_desc ASC");
            while ($row = $sql->fetch_assoc())
            {
                $course_desc=$row['course_desc'];
                $course_id=$row['course_id'];
                ?>
                <option value="<?php echo $course_id;?>">
			<?php echo $course_desc; ?>
			</option>
                <?php
            }
            ?>
			</select>
			</span></td>

                    <td><span class="controls">
			  <!--<input name="specialisation" type="text" required="required" style="font-weight:bold;" value="<?php echo $row['specialisation'] ?>" />-->

			    <select name="specialisation">
				<?php
                $sql = mysqli_query($conn, "SELECT id,name FROM specialization ORDER BY name ASC");
                while ($row = $sql->fetch_assoc()){
                    $name=$row['name'];
                    $id=$row['id'];
                    ?>
                    <option value="<?php echo $id; ?>">
				<?php echo $name; ?>
				</option>
                    <?php
                }
                ?>
				</select>

			</span></td>
                    <td>
                        <span class="controls">  <input name="uploadfile" type="file" required="required" style=" font-weight:bold;" value=""  /></span>
                    </td>
                    <td>
                        <span class="controls">  <input name="cert_no" type="text" required="required" style=" font-weight:bold;" value="<?php echo $row['cert_no'] ?>" /></span>
                    </td>

                    <td><span class="controls">
<input name="cert_year" id="txtGRADDate"  onchange="TDateGraduate()" type="date" required="required" value="<?php echo $row['cert_year'] ?>" />
</span>
                    </td>

                </tr>
                </tbody>
            </table>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <a href="./secThree.php" role="button" class="btn btn-success pull-left" style="margin-left:1%;background: #314C95;"><< Previous</a>
        </div>
        <div class="form-group col-md-4">
            <input name="btnIinsertNew" class="btn btn-success pull-right"  style="padding:20px;" type="submit" value="Save" onmouseover="DateCheck()" >
        </div>

        <div class="form-group col-md-4">
            <input type="submit" name="btnSubmitProfile"   style="margin-left:65%;"value="Next >>" onclick="window.location.href='secFive.php'">
        </div>
    </div>
    </form>
    </body>


    <script>
        function DateCheck()
        {
            var StartDate= document.getElementById('txtStartDate').value;
            var EndDate= document.getElementById('txtEndDate').value;
            var eDate = new Date(EndDate);
            var sDate = new Date(StartDate);
            if(StartDate!= '' && StartDate!= '' && sDate> eDate)
            {
                alert("Please ensure that the year to Date is greater than the Start year Date!!!!!!.");

                document.getElementById("txtEndDate").value = "";
                document.getElementById("txtStartDate").value = "";
                setTimeout(function(){document.getElementById("txtEndDate").innerHTML="";},4000*1);
            }
        }
        function TDate() {
            var UserDate = document.getElementById("txtEndDate").value;
            var ToDate = new Date();

            if (new Date(UserDate).getTime() >= ToDate.getTime())
            {
                alert("The year to must be less than todays date!!!!!!!!");
                document.getElementById("txtEndDate").value = "";
            }
        }

        function TDateGraduate() {
            var UserDate = document.getElementById("txtGRADDate").value;
            var ToDate = new Date();

            if (new Date(UserDate).getTime() >= ToDate.getTime())
            {
                alert("The GRADUATION year  must be less than todays date!!!!!!!!");
                document.getElementById("txtGRADDate").value = "";
            }
        }



        function validateForm()
        {
            if ($('input[id=r1]:checked').length <= 0) {
                alert("No entry is selected");
                return false;
            }

        }
    </script>
    </html>
    <?php
}?>



