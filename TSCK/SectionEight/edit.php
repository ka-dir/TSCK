<?php
include('header.php');

?>
<html>
<head>

</head>
<body style="margin-top: -25px;">
<h3>8. Employment Details</h3>
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
	<div class="thumbnail" style=" width:600px;">
	<div style="margin-left: 70px; margin-top: 20px;">
		<div class="control-group">
		<label class="control-label" for="inputEmail" style="font-weight:bold; font-size:18px; color:blue;">From</label>
		<div class="controls">
		<input name="employment_detail_id[]" type="hidden" value="<?php echo  $row['employment_detail_id'] ?>" />
			<input name="date_from[]" type="date" required=required id="txtStartDate" style="font-weight:bold;" value="<?php echo $row['date_from'] ?>" />
		</div>
		</div>

		<div class="control-group">
		<label class="control-label" for="inputEmail" style="font-weight:bold; font-size:18px; color:blue;">To</label>
		<div class="controls">
			<input name="date_to[]" type="date" required=required id="txtEndDate" onchange="TDate()"style="font-family:cursive; font-weight:bold;" value="<?php echo $row['date_to'] ?>" />
		</div>
		</div>

		<div class="control-group">
		<label class="control-label" for="inputEmail" style="font-weight:bold; font-size:18px; color:blue;">Designation Position</label>
		<div class="controls">
			<input name="designation_position[]" type="text" required=required style="font-weight:bold;" value="<?php echo $row['designation_position'] ?>" />
		</div>
		</div>

		<div class="control-group">
		<label class="control-label" for="inputEmail" style="font-weight:bold; font-size:18px; color:blue;">Job Group/Grade/Scale(Gross Monthly Salary)</label>
		<div class="controls">
			<input name="job_group[]" type="text" required=required style="font-weight:bold;" value="<?php echo $row['job_group'] ?>" readonly />
		</div>
		</div>

		<div class="control-group">
		<label class="control-label" for="inputEmail" style="font-weight:bold; font-size:18px; color:blue;">Ministry/State Department/Institution/Organization</label>
		<div class="controls">
			<input name="ministry[]" type="text" required=required style="font-weight:bold;" value="<?php echo $row['ministry'] ?>" />
		</div>
		</div>
        <div class="control-group">
            <label class="control-label" for="inputEmail" style="font-weight:bold; font-size:18px; color:blue;">Employer Telephone</label>
            <div class="controls">
                <input name="employer_telephone[]" type="text" required=required style="font-weight:bold;" value="<?php echo $row['employer_telephone'] ?>" />
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputEmail" style="font-weight:bold; font-size:18px; color:blue;">Employer Email</label>
            <div class="controls">
                <input name="employer_email[]" type="text" required=required style="font-weight:bold;" value="<?php echo $row['employer_email'] ?>" />
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputEmail" style="font-weight:bold; font-size:18px; color:blue;">Employer Status</label>
            <div class="controls">
               <!-- <input name="employer_email[]" type="text" required=required style="font-weight:bold;" value="<?php /*echo $row['employer_email'] */?>" />-->
                <select class="form-select form-control"  name="state_status[]" required>
                <option  value=""  selected="true" disabled="disabled" >Open this select menu</option>
                <option value="Current Employer">Current Employer</option>
                <option value="Former Employer">Former Employer</option>
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
</script>



</html>
