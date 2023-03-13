<?php
include('header.php');
$id_number=$_SESSION['id_number'];

?>
<html>
<head>
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

function TDateGraduate() {
    var UserDate = document.getElementById("txtGRADDate").value;
    var ToDate = new Date();

    if (new Date(UserDate).getTime() >= ToDate.getTime())
		{
          alert("The GRADUATION year  must be less than todays date!!!!!!!!");
       document.getElementById("txtGRADDate").value = "";
     }
}


</script>
</head>
<body style="margin-top: -25px;">
<h3> 4. Academic Qualifications (Start with the Highest) </h3>
<br />

<div class="container">

<form class="form-horizontal" action="" method="post">
<?php
$id=$_POST['selector'];

$N = count($id);
for($i=0; $i < $N; $i++)
{
$sqlquery="select aq.id,aq.date_from,aq.date_to,aq.university,aq.cert_no,aq.cert_year,a.id as awardID,a.award,c.course_id,c.course_desc,s.id as specializationID,s.name
		from academic_qualification as aq
		join award as a on aq.award_id=a.id
		join courses as c on aq.course_id=c.course_id
		join specialization as s on aq.specialization_id=s.id
		where aq.id='$id[$i]'";
$result =$dbconnection->query($sqlquery);
while($row = mysqli_fetch_array($result))
{ ?>
	<div class="thumbnail" style=" width:600px;">
	<div style="margin-left: 70px; margin-top: 20px;">
		<div class="control-group">
		<label class="control-label" for="inputEmail" style="font-weight:bold; font-size:18px; color:blue;">Date From</label>
		<div class="controls">
		<input name="id[]" type="hidden" value="<?php echo  $row['id'] ?>" />
			<input name="date_from[]" id="txtStartDate" type="date" required="required" style="font-family:cursive; font-weight:bold;" value="<?php echo $row['date_from'] ?>" />
		</div>
		</div>

		<div class="control-group">
		<label class="control-label" for="inputEmail" style="font-weight:bold; font-size:18px; color:blue;">Date To</label>
		<div class="controls">
			<input name="date_to[]" id="txtEndDate" required="required" onchange="TDate()" type="date"required="required" style="font-family:cursive; font-weight:bold;" value="<?php echo $row['date_to'] ?>" />
		</div>
		</div>

		<div class="control-group">
		<label class="control-label" for="inputEmail" style="font-weight:bold; font-size:18px; color:blue;">University/School</label>
		<div class="controls">
			<input name="university[]" type="text" required="required" style="font-family:cursive; font-weight:bold;" value="<?php echo $row['university'] ?>" />
		</div>
		</div>

		<div class="control-group">
		<label class="control-label" for="inputEmail" style="font-weight:bold; font-size:18px; color:blue;">Award</label>
		<div class="controls">
		<input name="award_id[]" type="hidden" value="<?php echo  $row['awardID'] ?>" />
			<input type="text" required="required" style="font-family:cursive; font-weight:bold;" value="<?php echo $row['award'] ?>" readonly />
		</div>
		</div>
		

		<div class="control-group">
		<label class="control-label" for="inputEmail" style="font-weight:bold; font-size:18px; color:blue;">Course</label>
		<div class="controls">
		<input name="course_id[]" type="hidden" value="<?php echo  $row['course_id'] ?>" />
			<input  type="text" required="required" style="font-family:cursive; font-weight:bold;" value="<?php echo $row['course_desc'] ?>" readonly />
		</div>
		</div>
		<div class="control-group">
		<label class="control-label" for="inputEmail" style="font-weight:bold; font-size:18px; color:blue;">Specialisation</label>
		<div class="controls">
		<input name="specialization_id[]" type="hidden" value="<?php echo  $row['specializationID'] ?>" />
			<input type="text" required="required" style="font-family:cursive; font-weight:bold;" value="<?php echo $row['name'] ?>" readonly />
		</div>
		</div>
		<div class="control-group">
		<label class="control-label" for="inputEmail" style="font-weight:bold; font-size:18px; color:blue;">Certificate Number</label>
		<div class="controls">
			<input name="cert_no[]" type="text" required="required" style="font-family:cursive; font-weight:bold;" value="<?php echo $row['cert_no'] ?>" readonly />
		</div>
		</div>
		
		<div class="control-group">
		<label class="control-label" for="inputEmail" style="font-weight:bold; font-size:18px; color:blue;">Certificate year</label>
		<div class="controls">
			<input name="cert_year[]" type="date" id="txtGRADDate" onchange="TDateGraduate()" required="required"  style="font-family:cursive; font-weight:bold;" value="<?php echo $row['cert_year'] ?>" />
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
</div>


</form>



</div>
</body>
</html>

