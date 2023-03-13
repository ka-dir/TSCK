<?php
include('header.php');

?>
<html>
<head>
</head>
<body style="margin-top: -25px;">
<h3> 5. Proffessional/Technical Qualifications/Cerifications Relevant to the Post (Start with the Highest)</h3>
<br />

<div class="container">
<form class="form-horizontal" action="" method="post">
<?php
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
$result = mysqli_query($dbconnection,

"select pq.id, pq.date_from,pq.date_to,pq.institution,pq.cert_no,pq.cert_year,a.award,s.name,a.id as awardID,
s.id as specializationID
from professional_qualification as pq
join award as a on pq.award_id=a.id
join specialization as s on pq.specialization_id=s.id
where pq.id='$id[$i]'");
while($row = mysqli_fetch_array($result))
{ ?>
	<div class="thumbnail" style=" width:600px;">
	<div style="margin-left: 70px; margin-top: 20px;">
		<div class="control-group">
		<label class="control-label" for="" style="font-weight:bold; font-size:18px; color:blue;">Date From</label>
		<div class="controls">
		<input name="id[]" type="hidden" value="<?php echo  $row['id'] ?>" />
			<input name="date_from[]"  id="txtStartDate"type="date" required="required"  style="font-family:cursive; font-weight:bold;" value="<?php echo $row['date_from'] ?>" />
		</div>
		</div>

		<div class="control-group">
		<label class="control-label" for="inputEmail" style="font-weight:bold; font-size:18px; color:blue;">Date To</label>
		<div class="controls">
			<input name="date_to[]"  id="txtEndDate" onchange="TDate()" type="date" required="required"  style="font-family:cursive; font-weight:bold;" value="<?php echo $row['date_to'] ?>" />
		</div>
		</div>

		<div class="control-group">
		<label class="control-label" for="inputEmail" style="font-weight:bold; font-size:18px; color:blue;">Institution</label>
		<div class="controls">
			<input name="institution[]" type="text" required="required"  style="font-family:cursive; font-weight:bold;" value="<?php echo $row['institution'] ?>" />
		</div>
		</div>

		<div class="control-group">
		<label class="control-label" for="inputEmail" style="font-weight:bold; font-size:18px; color:blue;">Award</label>
		<div class="controls">
		<input name="award_id[]"  type="hidden" value="<?php echo  $row['awardID'] ?>" />
		<input  type="text" required="required"  style="font-family:cursive; font-weight:bold;" value="<?php echo $row['award'] ?>" readonly />
		</div>
		</div>

		

		<div class="control-group">
		<label class="control-label" for="inputEmail" style="font-weight:bold; font-size:18px; color:blue;">Specialization</label>
		<div class="controls">
		<input name="specialization_id[]" type="hidden" value="<?php echo  $row['specializationID'] ?>" />
		<input  type="text" required="required"  style="font-family:cursive; font-weight:bold;" value="<?php echo $row['name'] ?>" readonly />
		</div>
		</div>
		<div class="control-group">
		<label class="control-label" for="inputEmail" style="font-weight:bold; font-size:18px; color:blue;">Certificate Number</label>
		<div class="controls">
			<input name="cert_no[]" type="text" required="required"  style="font-family:cursive; font-weight:bold;" value="<?php echo $row['cert_no'] ?>" />
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
</html>
