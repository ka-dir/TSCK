<?php
include('header.php');

?>
<html>
<head>
</head>
<body style="margin-top: -25px;">
<h3>7. Current Registration/Membership to Professional Bodies.</h3>
<br />

<div class="container">
<form class="form-horizontal" action="" method="post">
<?php
$current_membership_id=$_POST['selector'];
$N = count($current_membership_id);
for($i=0; $i < $N; $i++)
{
$result = mysqli_query($dbconnection, "SELECT * FROM current_membership where current_membership_id='$current_membership_id[$i]'");
while($row = mysqli_fetch_array($result))
{ ?>
	<div class="thumbnail" style=" width:600px;">
	<div style="margin-left: 70px; margin-top: 20px;">
		<div class="control-group">
		<label class="control-label" for="inputEmail" style="font-weight:bold; font-size:18px; color:blue;">Professional Body</label>
		<div class="controls">
		<input name="current_membership_id[]" type="hidden" value="<?php echo  $row['current_membership_id'] ?>" />
			<input name="profession_body[]" type="text" required=required style="font-family:cursive; font-weight:bold;" value="<?php echo $row['profession_body'] ?>" />
		</div>
		</div>

		<div class="control-group">
		<label class="control-label" for="inputEmail" style="font-weight:bold; font-size:18px; color:blue;">Membership/Registration No</label>
		<div class="controls">
			<input name="membership_no[]" type="text" required=required style="font-family:cursive; font-weight:bold;" value="<?php echo $row['membership_no'] ?>" />
		</div>
		</div>

		<div class="control-group">
		<label class="control-label" for="inputEmail" style="font-weight:bold; font-size:18px; color:blue;">Membership type</label>
		<div class="controls">
			<input name="membership_type[]" type="text" required=required style="font-family:cursive; font-weight:bold;" value="<?php echo $row['membership_type'] ?>" />
		</div>
		</div>

		<div class="control-group">
		<label class="control-label" for="inputEmail" style="font-weight:bold; font-size:18px; color:blue;">Date of Renewal</label>
		<div class="controls">
			
			<input name="date_of_renewal[]" type="date" required=required id="txtEndDate" onchange="TDate()"  style="font-family:cursive; font-weight:bold;" value="<?php echo $row['date_of_renewal'] ?>" />
		</div>
		</div>

		
	</div>
	</div>

	<br />
<?php
}
}
?>

<div class="row">
<div class="form-group col-md-6">
<input name="btnDelete"class="btn btn-success" style="margin-left: 1%;" type="submit" value="Delete">
</div>
<div class="form-group col-md-6">
<input name="btnEditSave" class="btn btn-success" style="margin-left: 1%;" type="submit" value="Update">
</form>
</div>
</div>
</div>
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
</script>
</html>
