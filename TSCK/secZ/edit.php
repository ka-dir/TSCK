<?php
include('header.php');

?>
<body>
<br />

<div class="container">
<form class="form-horizontal" action="" method="post">
<?php
include('dbcon.php');
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
$result = mysqli_query($dbconnection, "SELECT * FROM member where member_id='$id[$i]'");
while($row = mysqli_fetch_array($result))
{ ?>
	<div class="thumbnail" style="margin:auto; width:600px;">
	<div style="margin-left: 70px; margin-top: 20px;">
		<div class="control-group">
		<label class="control-label" for="inputEmail" style="font-family:cursive; font-weight:bold; font-size:18px; color:blue;">Firstname</label>
		<div class="controls">
		<input name="member_id[]" type="hidden" value="<?php echo  $row['member_id'] ?>" />
			<input name="firstname[]" type="text" style="font-family:cursive; font-weight:bold;" value="<?php echo $row['firstname'] ?>" />
		</div>
		</div>

		<div class="control-group">
		<label class="control-label" for="inputEmail" style="font-family:cursive; font-weight:bold; font-size:18px; color:blue;">Lastname</label>
		<div class="controls">
			<input name="lastname[]" type="text" style="font-family:cursive; font-weight:bold;" value="<?php echo $row['lastname'] ?>" />
		</div>
		</div>

		<div class="control-group">
		<label class="control-label" for="inputEmail" style="font-family:cursive; font-weight:bold; font-size:18px; color:blue;">Middlename</label>
		<div class="controls">
			<input name="middlename[]" type="text" style="font-family:cursive; font-weight:bold;" value="<?php echo $row['middlename'] ?>" />
		</div>
		</div>

		<div class="control-group">
		<label class="control-label" for="inputEmail" style="font-family:cursive; font-weight:bold; font-size:18px; color:blue;">Address</label>
		<div class="controls">
			<input name="address[]" type="text" style="font-family:cursive; font-weight:bold;" value="<?php echo $row['address'] ?>" />
		</div>
		</div>

		<div class="control-group">
		<label class="control-label" for="inputEmail" style="font-family:cursive; font-weight:bold; font-size:18px; color:blue;">Email Address</label>
		<div class="controls">
			<input name="email[]" type="text" style="font-family:cursive; font-weight:bold;" value="<?php echo $row['email'] ?>" />
		</div>
		</div>
	</div>
	</div>

	<br />
<?php
}
}
?>
<input name="btnEditSave" class="btn btn-success" style="margin-left: 165px; font-family:cursive;" type="submit" value="Update">
</form>

</div>
</body>
</html>
