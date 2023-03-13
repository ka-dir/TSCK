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
    $name=addslashesifneeded(strtoupper($_POST['name']));
    $organization=addslashesifneeded(strtoupper($_POST['organization']));
    $position=addslashesifneeded(strtoupper($_POST['position']));
    $address=addslashesifneeded(strtoupper($_POST['address']));
    $email=$_POST['email'];
    $phone_no=addslashesifneeded(strtoupper($_POST['phone_no']));


    $sql = "INSERT INTO referee_detail (id_number, name, organization, position, address, email, phone_no)
	 VALUES ('$id_number','$name','$organization','$position','$address','$email','$phone_no')";
    $result=$conn->query($sql)or die(mysqli_error($conn));
    $_SESSION['message'] = "Success Record Saved";
    $_SESSION['msg_type'] = "success";
    header("location: secReferee.php");
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

    $referee_detail_id=$_POST['referee_detail_id'];
    $name=addslashesifneeded(strtoupper($_POST['name']));
    $organization=addslashes_recursive($_POST['organization']);
    $position=addslashes_recursive($_POST['position']);
    $address=addslashes_recursive($_POST['address']);
    $email=$_POST['email'];
    $phone_no=addslashes_recursive($_POST['phone_no']);

    $N = count($referee_detail_id);
    for($i=0; $i < $N; $i++)
    {
        // $datetime1 = new DateTime($date_from[$i]);
        // $datetime2 = new DateTime($date_to[$i]);
        // $interval = $datetime1->diff($datetime2);
        // $dateDiff[$i]=$interval->format('%y years %m months and %d days');
        //echo $dateDiff;

        $result = mysqli_query($dbconnection, "UPDATE referee_detail SET name='$name[$i]', organization='$organization[$i]' ,position='$position[$i]' ,address='$address[$i]' ,email='$email[$i]' , phone_no='$phone_no[$i]'  where referee_detail_id='$referee_detail_id[$i]'")or die(mysql_error());
    }
    header("location: secReferee.php");
}


//.......................................... //next button ................................................................
elseif(isset($_POST['btnSubmitProfile']))
{
  $name=$_POST['name'];
    $organization=$_POST['organization'];
    $position=$_POST['position'];
    $address=$_POST['address'];
    $email=$_POST['email'];
    $phone_no=$_POST['phone_no'];



    $sql = "INSERT INTO referee_detail (id_number, name, organization, position, address, email, phone_no)
	 VALUES ('$id_number','$name','$organization','$position','$address','$email','$phone_no')";
    $result=$conn->query($sql)or die(mysqli_error($conn));
    header("location: secTen.php");


}



// user is deleting stuff:
elseif(isset($_POST['btnDelete']))
{
    $referee_detail_id=$_POST['referee_detail_id'];
   

    $N =count($referee_detail_id);
    for($i=0; $i < $N; $i++)
    {
        $sql="DELETE FROM `referee_detail` where referee_detail_id='".$referee_detail_id[$i]."'";
        $result=$dbconnection->query($sql);
        if(!$result)
        {
            echo mysqli_error($dbconnection);
        }
    }
    header("location: secReferee.php");

}
// user is doing nothing, it's his/her first time (ooer)
else
{

    ob_end_flush();
    ?>
<head>

<link rel="stylesheet" href="./assets/font_awesome.min.css">


</head>

<body style="margin-top: -25px;">
<h3>10. Referee Details (If Any) </h3>
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
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" >
	<thead style="background-color: #314C95;color:#FFFFFF;">
			<tr>
				<th style="text-align:center; font-size:12px; ">Referee Name </th>
				<th style="text-align:center; font-size:12px; ">Organization</th>
				<th style="text-align:center; font-size:12px; ">Position</th>
				<th style="text-align:center; font-size:12px; ">Referee Address</th>
				<th style="text-align:center; font-size:12px; ">Referee Email</th>
				<th style="text-align:center; font-size:12px; ">Referee Phone No</th>
				<th style="text-align:center;  font-size:12px; ">Action</th>
			
			</tr>
		</thead>
		<tbody>
		<?php
		//$varTableName = 'testmember';
		$query=mysqli_query($dbconnection, "select * from referee_detail WHERE id_number='".$id_number."'")or die(mysqli_error());
		while($row=mysqli_fetch_array($query)){
		$referee_detail_id=$row['referee_detail_id'];
		?>
			<tr>
				
				<td style="text-align:center; font-size:12px;"><?php echo $row['name'] ?></td>
				<td style="text-align:center; font-size:12px;"><?php echo $row['organization'] ?></td>
				<td style="text-align:center; font-size:12px;"><?php echo $row['position'] ?></td>
				<td style="text-align:center; font-size:12px;"><?php echo $row['address'] ?></td>
				<td style="text-align:center; font-size:12px;"><?php echo $row['email'] ?></td>
				<td style="text-align:center; font-size:12px;"><?php echo $row['phone_no'] ?></td>
        <td style="text-align:center; font-size:12px;">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                        
                               <?php $res = mysqli_fetch_array($result) ?>
							   <a href="./SectionReferee/delete.php?del=<?php echo $referee_detail_id;?>" onClick="return confirm('Are you sure you want to delete?')"
							   class="fa" style="font-size:24px;text-decoration: none">&#xf1f8;</a>
							   
                        </td>
				<!-- <td style="text-align:center; font-size:12px;">
					<input name="selector[]" type="radio" id="r1" value="<?php echo $referee_detail_id; ?>">
				</td> -->
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

<?php
$id_number=$_SESSION['id_number'];
   $sql_total="SELECT COUNT(referee_detail_id) AS total FROM referee_detail WHERE id_number= '$id_number'";
   $result_total=mysqli_query($conn,$sql_total);
  $data_total=mysqli_fetch_assoc($result_total);
  //echo $data_total['total'];

  if(($data_total['total']) >= 2){
  ?>
<form class="form-vertical" action="" method="post" hidden>

<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered"  id="example">
	<thead style="background-color: #314C95;color:#FFFFFF;">
			<tr>
				<th style="text-align:center; font-size:12px; ">Referee Name </th>
				<th style="text-align:center; font-size:12px; ">Organization</th>
				<th style="text-align:center; font-size:12px; ">Position</th>
				<th style="text-align:center; font-size:12px; ">Referee Address</th>
				<th style="text-align:center; font-size:12px; ">Referee Email</th>
				<th style="text-align:center; font-size:12px; ">Referee Phone No</th>
				
			</tr>
		</thead>	
		<tbody>
		  <tr align="center">
			<td><span class="controls">
			  <input name="name" required="required" type="text" style="font-family:cursive; font-weight:bold;" value="<?php echo $row['name'] ?>" />
			</span></td>
			<td><span class="controls">
			  <input name="organization" required="required" type="text" style="font-family:cursive; font-weight:bold;" value="<?php echo $row['organization'] ?>" />
			</span></td>
			<td><span class="controls">
			  <input name="position" required="required" type="text" style="font-family:cursive; font-weight:bold;" value="<?php echo $row['position'] ?>" />
			</span></td>
			<td><span class="controls">
			  <input name="address" required="required" type="text" style="font-family:cursive; font-weight:bold;" value="<?php echo $row['address'] ?>" />
			</span></td>
			<td><span class="controls">
			  <input name="email" required="required" type="text" style="font-family:cursive; font-weight:bold;" value="<?php echo $row['email'] ?>" />
			</span></td>
			<td><span class="controls">
			  <input name="phone_no" required="required" type="text" style="font-family:cursive; font-weight:bold;" value="<?php echo $row['phone_no'] ?>" />
			</span></td>
		  </tr>
	  </tbody>
</table>
	</div>
	<div class="row">
	<div class="form-group col-md-4">
	   <a href="./secNine.php" role="button" class="btn btn-success pull-left" style="margin-left:1%;background: #314C95;"><< Previous</a>
	   </div>
	<div class="form-group col-md-4">
    <input name="btnIinsertNew" class="btn btn-success pull-right"  style="padding:20px;" type="submit" value="Save" onmouseover="DateCheck()" >
	</div>
	<div class="form-group col-md-4">
	  <!--a href="./secNine.php" role="button" class="btn btn-success " style="margin-left:77%; background: #314C95;"> Next >></a-->
	  
	 <input type="submit" name="btnSubmitProfile"   style="margin-left:65%;"value="Next >>" onclick="window.location.href='secTen.php'">
	  
	</div>

</div>
</form>
<?php }else{ ?>

  <form class="form-vertical" action="" method="post">

<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered"  id="example">
	<thead style="background-color: #314C95;color:#FFFFFF;">
			<tr>
			
				<th style="text-align:center; font-size:12px; ">Referee Name </th>
				<th style="text-align:center; font-size:12px; ">Organization</th>
				<th style="text-align:center; font-size:12px; ">Position</th>
				<th style="text-align:center; font-size:12px; ">Referee Address</th>
				<th style="text-align:center; font-size:12px; ">Referee Email</th>
				<th style="text-align:center; font-size:12px; ">Referee Phone No</th>
				
			</tr>
		</thead>	
		<tbody>
		  <tr align="center">
			<td><span class="controls">
			  <input name="name" required="required" type="text" style="font-family:cursive; font-weight:bold;" value="<?php echo $row['name'] ?>" />
			</span></td>
			<td><span class="controls">
			  <input name="organization" required="required" type="text" style="font-family:cursive; font-weight:bold;" value="<?php echo $row['organization'] ?>" />
			</span></td>
			<td><span class="controls">
			  <input name="position" required="required" type="text" style="font-family:cursive; font-weight:bold;" value="<?php echo $row['position'] ?>" />
			</span></td>
			<td><span class="controls">
			  <input name="address" required="required" type="text" style="font-family:cursive; font-weight:bold;" value="<?php echo $row['address'] ?>" />
			</span></td>
			<td><span class="controls">
			  <input name="email" id="email" required="required" type="email" pattern="[a-zA-Z0-9.]+\@[a-zA-Z0-9.]+\.[a-zA-Z]+" style="font-family:cursive; font-weight:bold;" value="<?php echo $row['email'] ?>" />
			</span></td>
			<td><span class="controls">
			  <input name="phone_no" required="required" maxlength="10" type="phone" onkeypress="return isNumber(event)" style="font-family:cursive; font-weight:bold;" value="<?php echo $row['phone_no'] ?>" />
			</span></td>
		  </tr>
	  </tbody>
</table>
	</div>
	<div class="row">
	<div class="form-group col-md-4">
	   <a href="./secNine.php" role="button" class="btn btn-success pull-left" style="margin-left:1%;background: #314C95;"><< Previous</a>
	   </div>
	<div class="form-group col-md-4">
    <input name="btnIinsertNew" class="btn btn-success pull-right"  style="padding:20px;" type="submit" value="Save" onmouseover="DateCheck()" >
	</div>
	<div class="form-group col-md-4">
	  <!--a href="./secNine.php" role="button" class="btn btn-success " style="margin-left:77%; background: #314C95;"> Next >></a-->
	  
	 <input type="submit" name="btnSubmitProfile"   style="margin-left:65%;"value="Next >>" onclick="window.location.href='secTen.php'">
	  
	</div>

</div>
</form>
<?php } ?>

</body>
<script>

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
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
