<?php
include('header.php');

?>
<html>
<head>
</head>
<body style="margin-top: -25px;">
<h3>6. Relevant Courses and Training attended Lasting not Less than Two (2) Weeks.</h3>
<br />

<div class="container">
<form class="form-horizontal" action="" method="post">
<?php
$rc_id=$_POST['selector'];
$N = count($rc_id);
for($i=0; $i < $N; $i++)
{
$result = mysqli_query($dbconnection, "SELECT * FROM relevant_courses where rc_id='$rc_id[$i]'");
while($row = mysqli_fetch_array($result))
{ ?>
	<div class="thumbnail" style=" width:600px;">
	<div style="margin-left: 70px; margin-top: 20px;">
		<div class="control-group">
		<label class="control-label" for="inputEmail" style="font-weight:bold; font-size:18px; color:blue;">Date From</label>
		<div class="controls">
		<input name="rc_id[]" type="hidden" value="<?php echo  $row['rc_id'] ?>" />
		<input name="date_from[]" id="txtStartDate" type="date"required=required style="font-family:cursive; font-weight:bold;" value="<?php echo $row['date_from'] ?>" />
		</div>
		</div>
		
		<div class="control-group">
		<label class="control-label" for="inputEmail" style="font-weight:bold; font-size:18px; color:blue;">Date To</label>
		<div class="controls">
			<input name="date_to[]" id="txtEndDate" onchange="TDate()" type="date" required=required style="font-family:cursive; font-weight:bold;" value="<?php echo $row['date_to'] ?>" />
		</div>
		</div>

		<div class="control-group">
		<label class="control-label" for="inputEmail" style="font-weight:bold; font-size:18px; color:blue;">University/College/Institution</label>
		<div class="controls">
			<input name="university[]" type="text" required=required style="font-family:cursive; font-weight:bold;" value="<?php echo $row['university'] ?>" />
		</div>
		</div>

		<div class="control-group">
		<label class="control-label" for="inputEmail" style="font-weight:bold; font-size:18px; color:blue;">Name of Course</label>
		<div class="controls">
			<input name="course_name[]" type="text" required=required style="font-family:cursive; font-weight:bold;" value="<?php echo $row['course_name'] ?>" />
		</div>
		</div>

		<div class="control-group">
		<label class="control-label" for="inputEmail" style="font-weight:bold; font-size:18px; color:blue;">Details and Duration</label>
		<div class="controls">
			<input name="details_and_duration[]" type="text" required=required style="font-family:cursive; font-weight:bold;" value="<?php echo $row['details_and_duration'] ?>" />
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
<input name="btnEditSave" class="btn btn-success" style="margin-left: 1%;" type="submit" value="Update" onmouseover="DateCheck()">
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
