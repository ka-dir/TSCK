<?php
include('header.php');

?>
<body style="margin-top: -25px;">
<h3> 4. Academic Qualifications (Start with the Highest) </h3>
<br />

<div class="container">

<form class="form-horizontal" action="" method="post">
<?php
$aq_id=$_POST['selector'];
$N = count($aq_id);
for($i=0; $i < $N; $i++)
{
	$sqlquery="SELECT * FROM academic_qualification where aq_id='$aq_id[$i]'";
$result =$dbconnection->query($sqlquery);
while($row = mysqli_fetch_array($result))
{ ?>
	<div class="thumbnail" style=" width:600px;">
	<div style="margin-left: 70px; margin-top: 20px;">
		<div class="control-group">
		<label class="control-label" for="inputEmail" style="font-family:cursive; font-weight:bold; font-size:18px; color:blue;">Date From</label>
		<div class="controls">
		<input name="aq_id[]" type="hidden" value="<?php echo  $row['aq_id'] ?>" />
			<input name="date_from[]" type="text" style="font-family:cursive; font-weight:bold;" value="<?php echo $row['date_from'] ?>" />
		</div>
		</div>

		<div class="control-group">
		<label class="control-label" for="inputEmail" style="font-family:cursive; font-weight:bold; font-size:18px; color:blue;">Date To</label>
		<div class="controls">
			<input name="date_to[]" type="text" style="font-family:cursive; font-weight:bold;" value="<?php echo $row['date_to'] ?>" />
		</div>
		</div>

		<div class="control-group">
		<label class="control-label" for="inputEmail" style="font-family:cursive; font-weight:bold; font-size:18px; color:blue;">University</label>
		<div class="controls">
			<input name="university[]" type="text" style="font-family:cursive; font-weight:bold;" value="<?php echo $row['university'] ?>" />
		</div>
		</div>

		<div class="control-group">
		<label class="control-label" for="inputEmail" style="font-family:cursive; font-weight:bold; font-size:18px; color:blue;">Award</label>
		<div class="controls">
			<input name="award[]" type="text" style="font-family:cursive; font-weight:bold;" value="<?php echo $row['award'] ?>" />
		</div>
		</div>

		<div class="control-group">
		<label class="control-label" for="inputEmail" style="font-family:cursive; font-weight:bold; font-size:18px; color:blue;">Course</label>
		<div class="controls">
			<input name="course[]" type="text" style="font-family:cursive; font-weight:bold;" value="<?php echo $row['course'] ?>" />
		</div>
		</div>
		<div class="control-group">
		<label class="control-label" for="inputEmail" style="font-family:cursive; font-weight:bold; font-size:18px; color:blue;">Specialisation</label>
		<div class="controls">
			<input name="specialisation[]" type="text" style="font-family:cursive; font-weight:bold;" value="<?php echo $row['specialisation'] ?>" />
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
<input type="submit" name="btnSubmitProfile"  style="margin-left:2%;"value="<<Back " onclick="window.location.href='secFour.php'">
</div>
	<div class="form-group col-md-6">
<input name="btnEditSave" class="btn btn-success" style="margin-left: 1%; font-family:cursive;" type="submit" value="Update">
</div>


</form>

</div>
</body>
</html>
