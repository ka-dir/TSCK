<?php
include('header.php');

?>
<body>
<br />

<div class="container">
<form class="form-horizontal" action="" method="post">
<?php
$employment_detail_id=$_POST['selector'];
$N = count($employment_detail_id);
for($i=0; $i < $N; $i++)
{
$result = mysqli_query($dbconnection, "SELECT * FROM employment_detail where employment_detail_id='$employment_detail_id[$i]'");
while($row = mysqli_fetch_array($result))
{ ?>
	<div class="thumbnail" style="margin:auto; width:600px;">
	<div style="margin-left: 70px; margin-top: 20px;">
		<div class="control-group">
		<label class="control-label" for="inputEmail" style="font-family:cursive; font-weight:bold; font-size:18px; color:blue;">From</label>
		<div class="controls">
		<input name="employment_detail_id[]" type="hidden" value="<?php echo  $row['employment_detail_id'] ?>" />
			<input name="date_from[]" type="date" style="font-family:cursive; font-weight:bold;" value="<?php echo $row['date_from'] ?>" />
		</div>
		</div>

		<div class="control-group">
		<label class="control-label" for="inputEmail" style="font-family:cursive; font-weight:bold; font-size:18px; color:blue;">To</label>
		<div class="controls">
			<input name="date_to[]" type="date" style="font-family:cursive; font-weight:bold;" value="<?php echo $row['date_to'] ?>" />
		</div>
		</div>

		<div class="control-group">
		<label class="control-label" for="inputEmail" style="font-family:cursive; font-weight:bold; font-size:18px; color:blue;">Designation Position</label>
		<div class="controls">
			<input name="designation_position[]" type="text" style="font-family:cursive; font-weight:bold;" value="<?php echo $row['designation_position'] ?>" />
		</div>
		</div>

		<div class="control-group">
		<label class="control-label" for="inputEmail" style="font-family:cursive; font-weight:bold; font-size:18px; color:blue;">Job Group/Grade/Scale(Gross Monthly Salary)</label>
		<div class="controls">
			<input name="job_group[]" type="text" style="font-family:cursive; font-weight:bold;" value="<?php echo $row['job_group'] ?>" />
		</div>
		</div>

		<div class="control-group">
		<label class="control-label" for="inputEmail" style="font-family:cursive; font-weight:bold; font-size:18px; color:blue;">Ministry/State Department/Institution/Organization</label>
		<div class="controls">
			<input name="ministry[]" type="text" style="font-family:cursive; font-weight:bold;" value="<?php echo $row['ministry'] ?>" />
		</div>
		</div>
	</div>
	</div>

	<br />
<?php
}
}
?>
<input name="btnEditSave" class="btn btn-success" style="margin-left: 5px; width: 15%; font-family:cursive;" type="submit" value="Update">
</form>

</div>
</body>
</html>
