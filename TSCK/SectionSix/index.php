<?php
session_start();
ob_start();
include('header.php');
$id_number=$_SESSION['id_number'];
include('includes/topsection.php');
function addslashesifneeded ($stringtocheck){
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

	$varToday=date("l jS \of F Y h:i:s A"); 
	$datefrom=$_POST['date_from'];
	$dateto=$_POST['date_to'];
	$university=addslashesifneeded(strtoupper($_POST['university']));

	$course_name=addslashesifneeded(strtoupper($_POST['course_name']));
	$details_and_duration=addslashesifneeded(strtoupper($_POST['details_and_duration']));
	
	$datetime1 = new DateTime($datefrom);
	$datetime2 = new DateTime($dateto);
	$interval = $datetime1->diff($datetime2);
	$dateDiff=$interval->format('%y years %m months and %d days');
	//echo $dateDiff;
       $filename = $_FILES["uploadfile"]["name"];

       $encode_rnd_txt=substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10/strlen($x)) )),1,10);

       $save_file_expr = $_SESSION['id_number'].'_'.$encode_rnd_txt;

       $tempname = $_FILES["uploadfile"]["tmp_name"];
       $folder = "././SectionSix/uploads/" . $save_file_expr;


       // Execute query

       $sql = "INSERT INTO relevant_courses (id_number, date_from, date_to, university,upload_cert, course_name, details_and_duration,dateDiff)
	VALUES ('$id_number','$datefrom','$dateto','$university','$save_file_expr','$course_name','$details_and_duration','$dateDiff')";
	//$result=$conn->query($sql)or die(mysqli_error($conn));
	//header("location: secSix.php");

       mysqli_query($conn, $sql);

       // Now let's move the uploaded image into the folder: image
       if (move_uploaded_file($tempname, $folder)) {
           $_SESSION['message']="Success Record Saved";
           $_SESSION['msg_type']="info";

           header("Location: secSix.php");
       } else {
           $_SESSION['message']="Failed... Error Occurred";
           $_SESSION['msg_type']="danger";
           header("Location: secSix.php");
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
	
	$rc_id=$_POST['rc_id'];
	$date_from=$_POST['date_from'];
	$date_to=$_POST['date_to'];
	$year=$_POST['year'];
	$university=addslashes_recursive($_POST['university']);
	$course_name=addslashes_recursive($_POST['course_name']);
	$details_and_duration=addslashes_recursive($_POST['details_and_duration']);

$N = count($rc_id);
for($i=0; $i < $N; $i++)
{
	
	$datetime1 = new DateTime($date_from[$i]);
	$datetime2 = new DateTime($date_to[$i]);
	$interval = $datetime1->diff($datetime2);
	$dateDiff[$i]=$interval->format('%y years %m months and %d days');
	//echo $dateDiff;
	
	$result = mysqli_query($dbconnection, "UPDATE relevant_courses SET date_from='$date_from[$i]',date_to='$date_to[$i]', university='$university[$i]', course_name='$course_name[$i]' ,details_and_duration='$details_and_duration[$i]',dateDiff='$dateDiff[$i]' where rc_id='$rc_id[$i]'")or die(mysql_error());
}
header("location: secSix.php");
}
 
 //.......................................... //next button ................................................................
 elseif(isset($_POST['btnSubmitProfile']))
{
	$varToday=date("l jS \of F Y h:i:s A"); 
	$datefrom=$_POST['date_from'];
	$dateto=$_POST['date_to'];
	$university=addslashesifneeded(strtoupper($_POST['university']));
	$course_name=addslashesifneeded(strtoupper($_POST['course_name']));
	$details_and_duration=addslashesifneeded(strtoupper($_POST['details_and_duration']));
	
	$datetime1 = new DateTime($datefrom);
	$datetime2 = new DateTime($dateto);
	$interval = $datetime1->diff($datetime2);
	$dateDiff=$interval->format('%y years %m months and %d days');
	//echo $dateDiff;

	$sql = "INSERT INTO relevant_courses (id_number, date_from, date_to, university, course_name, details_and_duration,dateDiff)
	VALUES ('$id_number','$datefrom','$dateto','$university','$course_name','$details_and_duration','$dateDiff')";
	$result=$conn->query($sql)or die(mysqli_error($conn));
	header("location: secSeven.php");
 

}





 
    
   // user is deleting stuff:
elseif(isset($_POST['btnDelete']))
   {
 $rc_id=$_POST['rc_id'];

$N =count($rc_id);
for($i=0; $i < $N; $i++)
{
	$sql="DELETE FROM `relevant_courses` where rc_id='".$rc_id[$i]."'";
	$result=$dbconnection->query($sql);
	if(!$result)
	{
	echo mysqli_error($dbconnection);	
	}
}
header("location: secSix.php");

   }
   // user is doing nothing, it's his/her first time (ooer)
   else
   {
ob_end_flush();
?>
<head>

</head>

<body style="margin-top: -25px;">
<h3> 6. Relevant Courses and Training attended Lasting not Less than Two (2) Weeks. </h3>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<form name="frmAcademic6" action="" method="post" onsubmit="return validateForm()">
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" >

		<thead style="background-color: #314C95;color:#FFFFFF;">
			<tr>
				<th style="text-align:center; font-size:12px; ">From Year</th>
				<th style="text-align:center; font-size:12px; ">To Year</th>
				<th style="text-align:center;  font-size:12px; ">University/College/Institution</th>
				<th style="text-align:center;  font-size:12px; ">Name of Course</th>
				<th style="text-align:center;  font-size:12px; ">Description</th>
				<th style="text-align:center;  font-size:12px;">Action</th>
			</tr>
		</thead>
		<tbody>
		<?php
		//$varTableName = 'testmember';
		$query=mysqli_query($dbconnection, "select * from relevant_courses WHERE id_number='".$id_number."'")or die(mysqli_error());
		while($row=mysqli_fetch_array($query)){
		$rc_id=$row['rc_id'];
		?>
			<tr>
				<td style="text-align:center;  font-size:12px;"><?php echo $row['date_from'] ?></td>
				<td style="text-align:center;  font-size:12px;"><?php echo $row['date_to'] ?></td>
				<td style="text-align:center;  font-size:12px;"><?php echo $row['university'] ?></td>
				<td style="text-align:center;  font-size:12px;"><?php echo $row['course_name'] ?></td>
				<td style="text-align:center;  font-size:12px;"><?php echo $row['details_and_duration'] ?></td>
				
				<td style="text-align:center;  font-size:12px;">
                    <a href="././SectionSix/uploads/<?php echo $row['upload_cert']; ?>" class="fa" style="font-size:24px;text-decoration: none" target="_blank">&#xf06e; </a>
					<!-- <input name="selector[]" id="r1" type="radio" value="<?php echo $rc_id; ?>"> -->
					<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                        
						<?php $res = mysqli_fetch_array($result) ?>
						<a href="./SectionSix/delete.php?del=<?php echo $rc_id;?>" onClick="return confirm('Are you sure you want to delete?')"
						class="fa" style="font-size:24px;text-decoration: none">&#xf1f8;</a>

				</td>
			</tr>
		<?php  } ?>
		</tbody>
	</table>
	<br />
	<!-- <button name="btnEdit" class="btn btn-success pull-right" style="background: #314C95;" name="submit_mult" type="submit">
		Update 
	</button> -->
</form>

<br>
<br>

<form class="form-vertical" action="" method="post"  enctype="multipart/form-data" onsubmit="return Checkfiles(this);">

<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
		<thead style="background-color: #314C95;color:#FFFFFF;">
			<tr>
				<th style="text-align:center; font-size:12px; ">From Year</th>
				<th style="text-align:center; font-size:12px; ">To Year</th>
				<th style="text-align:center;  font-size:12px; ">University/College/Institution</th>
				<th style="text-align:center;  font-size:12px;">Name of Course</th>
				<th style="text-align:center;  font-size:12px;">Upload Certificate</th>
				<th style="text-align:center;  font-size:12px; ">Description</th>
				
				
			</tr>
		</thead>	
		<tbody>
		  <tr align="center">
			<td><span class="controls">
			  <input name="date_from" id="txtStartDate"  type="date" required="required" value="<?php echo $row['date_from'] ?>" />
			</span>
			</td>
			<td><span class="controls">
			  <input name="date_to" id="txtEndDate"  onchange="TDate()" type="date" required="required" value="<?php echo $row['date_to'] ?>" />
			</span>
			</td>
			
			<td><span class="controls">
			  <input name="university"  required="required" type="text" value="<?php echo $row['university'] ?>" />
			</span>
			</td>
			<td><span class="controls">
			  <input name="course_name"  required="required" type="text" style=" font-weight:bold;" value="<?php echo $row['course'] ?>" />
			</span>
			</td><td><span class="controls">
			 <span class="controls">  <input id="upload" onchange="UploadFile()" name="uploadfile" type="file" required="required" style=" font-weight:bold;" value=""  /></span>
			</span>
			</td>
			<td><span class="controls">
			  <input name="details_and_duration" required="required" type="text" style=" font-weight:bold;" value="<?php echo $row['details_and_duration'] ?>" />
			</span>
			</td>
						
		  </tr>
	  </tbody>
</table>
	</div>
	<div class="row">
	<div class="form-group col-md-4">
	   <a href="./secFive.php" role="button" class="btn btn-success pull-left" style="margin-left:1%;background: #314C95;"><< Previous</a>
	</div>
	<div class="form-group col-md-4">
	<input name="btnIinsertNew" class="btn btn-success pull-right"  style="padding:20px;" type="submit" value="Save" onmouseover="DateCheck()" >
	</div>
	
	<div class="form-group col-md-4">
	  <!-- <a href="./secSeven.php" role="button" class="btn btn-success " style="margin-left:77%; background: #314C95;">Next >></a>-->
	<input type="submit" name="btnSubmitProfile"   style="margin-left:65%;"value="Next >>" onclick="window.location.href='secSeven.php'">
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
 
 


 function validateForm()
 {
        if ($('input[id=r1]:checked').length <= 0) {
            alert("No entry is selected");
            return false;
        }
       
    }
	function UploadFile(){
            var sizef = document.getElementById('upload').files[0].size;
                if(sizef > 1048576){
                    alert('Upload a file less than 1MB');
                    upload.value = "";
                }else {
                    //action
                }
                

        }
        function Checkfiles()
        {
        var fup = document.getElementById('upload');
        var fileName = fup.value;
        var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
        if(ext == "pdf" || ext == "PDF"|| ext == "png" || ext == "PNG" || ext == "jpeg" || ext == "JPEG"|| ext == "jpg" || ext == "JPG" )
        {
        return true;
        } 
        else
        {
        alert("Upload PDF,PNG,JPEG or JPG files only");
        upload.value = "";
        fup.focus();
        return false;
        }
        }
</script>




</html>
<?php
   }?>
