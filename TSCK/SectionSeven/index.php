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
	$profession_body=addslashesifneeded(strtoupper($_POST['profession_body']));
	$membership_no=addslashesifneeded(strtoupper($_POST['membership_no']));
	$membership_type=addslashesifneeded(strtoupper($_POST['membership_type']));
	$date_of_renewal=$_POST['date_of_renewal'];

       $filename = $_FILES["uploadfile"]["name"];
       $encode_rnd_txt=substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10/strlen($x)) )),1,10);

       $save_file_expr = $_SESSION['id_number'].'_'.$encode_rnd_txt;

       $tempname = $_FILES["uploadfile"]["tmp_name"];
       $folder = "././SectionSeven/uploads/" . $save_file_expr;


	$sql = "INSERT INTO current_membership (id_number, profession_body, membership_no, upload_cert, membership_type, date_of_renewal)
	 VALUES ('$id_number','$profession_body','$membership_no','$save_file_expr','$membership_type','$date_of_renewal')";
	//$result=$conn->query($sql)or die(mysqli_error($conn));
	//header("location: secSeven.php");

       // Execute query
       mysqli_query($conn, $sql);

       // Now let's move the uploaded image into the folder: image
       if (move_uploaded_file($tempname, $folder)) {
           $_SESSION['message']="Success Record Saved";
           $_SESSION['msg_type']="info";

           header("location: secSeven.php");
       } else {
           $_SESSION['message']="Failed... Error Occurred";
           $_SESSION['msg_type']="danger";
           header("Location: secSeven.php");
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
	
	$current_membership_id=$_POST['current_membership_id'];
	$profession_body=addslashes_recursive($_POST['profession_body']);
	$membership_no=addslashes_recursive($_POST['membership_no']);
	$membership_type=addslashes_recursive($_POST['membership_type']);
	$date_of_renewal=$_POST['date_of_renewal'];

$N = count($current_membership_id);
for($i=0; $i < $N; $i++)
{
	$result = mysqli_query($dbconnection, "UPDATE current_membership SET profession_body='$profession_body[$i]', membership_no='$membership_no[$i]', membership_type='$membership_type[$i]' ,date_of_renewal='$date_of_renewal[$i]'   where current_membership_id='$current_membership_id[$i]'")or die(mysql_error());
}
header("location: secSeven.php");
}
   //.......................................... //next button ................................................................
 elseif(isset($_POST['btnSubmitProfile']))
{
	$profession_body=addslashesifneeded(strtoupper($_POST['profession_body']));
	$membership_no=addslashesifneeded(strtoupper($_POST['membership_no']));
	$membership_type=addslashesifneeded(strtoupper($_POST['membership_type']));
	$date_of_renewal=$_POST['date_of_renewal'];

	$sql = "INSERT INTO current_membership (id_number, profession_body, membership_no, membership_type, date_of_renewal)
	 VALUES ('$id_number','$profession_body','$membership_no','$membership_type','$date_of_renewal')";
	$result=$conn->query($sql)or die(mysqli_error($conn));
	header("location: secEight.php");
 

}
    
   // user is deleting stuff:
elseif(isset($_POST['btnDelete']))
   {
 $current_membership_id=$_POST['current_membership_id'];

$N =count($current_membership_id);
for($i=0; $i < $N; $i++)
{
	$sql="DELETE FROM `current_membership` where current_membership_id='".$current_membership_id[$i]."'";
	$result=$dbconnection->query($sql);
	if(!$result)
	{
	echo mysqli_error($dbconnection);	
	}
}
header("location: secSeven.php");

   }
   // user is doing nothing, it's his/her first time (ooer)
   else
   {
ob_end_flush();
?>
<head>

</head>

<body style="margin-top: -25px;">
<h3> 7. Current Registration/Membership to Professional Bodies. </h3>
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
<form name="frmAcademic7" action="" method="post" onsubmit="return validateForm()">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" >
	<thead style="background-color: #314C95;color:#FFFFFF;">
			<tr>
				<th style="text-align:center;  font-size:12px; ">Proffessional Body</th>
				<th style="text-align:center;  font-size:12px; ">Membership/Registration No</th>
				<th style="text-align:center;  font-size:12px;">Membership Type(e.g Associate,Full etc)</th>
				<th style="text-align:center;  font-size:12px;">Date of Renewal</th>
				<th style="text-align:center;  font-size:12px; ">Action</th>
				
			</tr>
		</thead>
		<tbody>
		<?php
		//$varTableName = 'testmember';
		$query=mysqli_query($dbconnection, "select * from current_membership WHERE id_number='".$id_number."'")or die(mysqli_error());
		while($row=mysqli_fetch_array($query)){
		$current_membership_id=$row['current_membership_id'];
		?>
			<tr>
				<td style="text-align:center;  font-size:12px;"><?php echo $row['profession_body'] ?></td>
				<td style="text-align:center;  font-size:12px;"><?php echo $row['membership_no'] ?></td>
				<td style="text-align:center;  font-size:12px;"><?php echo $row['membership_type'] ?></td>
				<td style="text-align:center;  font-size:12px;"><?php echo $row['date_of_renewal'] ?></td>
				
				<td style="text-align:center;  font-size:12px;">
                    <a href="././SectionSeven/uploads/<?php echo $row['upload_cert']; ?>" class="fa" style="font-size:24px;text-decoration: none" target="_blank">&#xf06e; </a>

					<!-- <input name="selector[]" id="r1" type="radio" value="<?php echo $current_membership_id; ?>"> -->
					<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                        
						<?php $res = mysqli_fetch_array($result) ?>
						<a href="./SectionSeven/delete.php?del=<?php echo $current_membership_id;?>" onClick="return confirm('Are you sure you want to delete?')"
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

<form class="form-vertical" action="" method="post" enctype="multipart/form-data" onsubmit="return Checkfiles(this);">

<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
		<thead style="background-color: #314C95;color:#FFFFFF;">
			<tr>
				<th style="text-align:center;  font-size:12px;">Proffessional Body</th>
				<th style="text-align:center;  font-size:12px; ">Membership/Registration No</th>
				<th style="text-align:center;  font-size:12px;">Membership Type(e.g Associate,Full etc)</th>
				<th style="text-align:center;  font-size:12px;">Upload Certificate</th>
				<th style="text-align:center;  font-size:12px; ">Date of Renewal</th>
			</tr>
		</thead>	
		<tbody>
		  <tr align="center">
			<td>
			  <input name="profession_body" required="required" type="text" value="<?php echo $row['profession_body'] ?>" />
<span class="controls">
			  
			</span></td>
			<td><span class="controls">
			  <input name="membership_no" required="required" type="text" value="<?php echo $row['membership_no'] ?>" />
			</span></td>
			<td><span class="controls">
			  <input name="membership_type" required="required" type="text" style=" font-weight:bold;" value="<?php echo $row['membership_type'] ?>" />
			</span></td><td><span class="controls">
                      <span class="controls">  <input id="upload" onchange="UploadFile()" name="uploadfile" type="file" required="required" style=" font-weight:bold;" value=""  /></span>
			</span></td>

			<td><span class="controls">
			  <input name="date_of_renewal"  id="txtEndDate" required="required" type="date" onchange="TDate()" style=" font-weight:bold;" value="<?php echo $row['date_of_renewal'] ?>" />
			</span></td>
						
		  </tr>
	  </tbody>
</table>
	</div>
	<div class="row">
	<div class="form-group col-md-4">
	   <a href="./secSix.php" role="button" class="btn btn-success pull-left" style="margin-left:1%;background: #314C95;"><< Previous</a>
	   </div>
	<div class="form-group col-md-4">
    <input name="btnIinsertNew" class="btn btn-success pull-right"  style="padding:20px;" type="submit" value="Save" onmouseover="DateCheck()" >
	</div>
	<div class="form-group col-md-4">
	<!--a href="./secEight.php" role="button" class="btn btn-success "  style="margin-left:77%; background: #314C95;">Next >></a-->
	<input type="submit" name="btnSubmitProfile"   style="margin-left:65%;"value="Next >>" onclick="window.location.href='secEight.php'">
	</div>

</div>
</form>


</body>

<script>
	
function TDate() {
    var UserDate = document.getElementById("txtEndDate").value;
    var ToDate = new Date();

    if (new Date(UserDate).getTime() <= ToDate.getTime())
		{
          alert("The renewal date must be greater than current date!!!!!!!!");
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
