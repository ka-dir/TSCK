<?php
include('header.php');

?>
<html>
<head>

</head>
<body style="margin-top: -25px;">
<h3>10. Referee Details</h3>
<br />

<div class="container">
<form class="form-horizontal" action="" method="post">
<?php
$referee_detail_id=$_POST['selector'];

$N = count($referee_detail_id);
for($i=0; $i < $N; $i++)
{
    $result = mysqli_query($dbconnection, "SELECT * FROM referee_detail where referee_detail_id='$referee_detail_id[$i]'");
    while($row = mysqli_fetch_array($result))
    { ?>
            
	<div class="thumbnail" style=" width:600px;">
	<div style="margin-left: 70px; margin-top: 20px;">
	<div class="control-group">
            <label class="control-label" for="inputEmail" style="font-weight:bold; font-size:18px; color:blue;">Referee Name</label>
            <div class="controls">
                <input name="name[]" type="text" required=required style="font-weight:bold;" value="<?php echo $row['name'] ?>" />
            </div>
        </div>

		

        <div class="control-group">
            <label class="control-label" for="inputEmail" style="font-weight:bold; font-size:18px; color:blue;">Organization</label>
            <div class="controls">
                <input name="organization[]" type="text" required=required style="font-weight:bold;" value="<?php echo $row['organization'] ?>" />
            </div>
        </div>

		<div class="control-group">
		<label class="control-label" for="inputEmail" style="font-weight:bold; font-size:18px; color:blue;">Position</label>
		<div class="controls">
			<input name="position[]" type="text" required=required style="font-weight:bold;" value="<?php echo $row['position'] ?>" />
		</div>
		</div>
        <div class="control-group">
            <label class="control-label" for="inputEmail" style="font-weight:bold; font-size:18px; color:blue;">Address</label>
            <div class="controls">
                <input name="address[]" type="text" required=required style="font-weight:bold;" value="<?php echo $row['address'] ?>" />
            </div>
        </div>
		<div class="control-group">
		<label class="control-label" for="inputEmail" style="font-weight:bold; font-size:18px; color:blue;">Email</label>
		<div class="controls">
			<input name="email[]" type="text" required=required style="font-weight:bold;" value="<?php echo $row['email'] ?>" readonly />
		</div>
		</div>

		<div class="control-group">
		<label class="control-label" for="inputEmail" style="font-weight:bold; font-size:18px; color:blue;">Phone Number</label>
		<div class="controls">
			<input name="phone_no[]" type="text" required=required style="font-weight:bold;" value="<?php echo $row['phone_no'] ?>" />
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
<input name="btnDelete"class="btn btn-success" style="margin-left: 1%; font-family:cursive;" type="submit" value="Delete">
</div>
<div class="form-group col-md-6">
<input name="btnEditSave" class="btn btn-success" style="margin-left: 1%; font-family:cursive;" type="submit" value="Update" onmouseover="DateCheck()">
</form>
</div>
</div>

</div>
</body>





</html>
