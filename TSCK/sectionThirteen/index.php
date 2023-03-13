<?php
include('header.php');
$id_number=$_SESSION['id_number'];


//Insert New Record
   if(isset($_POST['btnIinsertNew']))
   {
	$varToday=date("l jS \of F Y h:i:s A"); 
	$datefrom=$_POST['date_from'];
	$dateto=$_POST['date_to'];
	$university=$_POST['university'];
	$award=$_POST['award'];
	$course=$_POST['course'];
	$specialisation=$_POST['specialisation'];

	$sql = "INSERT INTO academic_qualification (id_number, date_from, date_to, university, award,course,specialisation)
	 VALUES ('$id_number','$datefrom','$dateto','$university','$award','$course','$specialisation')";
	$conn->query($sql);
	header("location: secThirteen.php");
	
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
	$aq_id=$_POST['aq_id'];
	$datefrom=$_POST['date_from'];
	$dateto=$_POST['date_to'];
	$university=$_POST['university'];
	$award=$_POST['award'];
	$course=$_POST['course'];
	$specialisation=$_POST['specialisation'];

$N = count($aq_id);
for($i=0; $i < $N; $i++)
{
	$result = mysqli_query($dbconnection, "UPDATE academic_qualification SET id_number='$id_number', date_from='$datefrom[$i]', date_to='$dateto[$i]', university='$university[$i]' ,award='$award[$i]' , course='$course[$i]',specialisation='$specialisation[$i]'  where aq_id='$aq_id[$i]'")or die(mysql_error());
}


//header("location: secThirteen.php");
}
   
    
   // user is deleting stuff:
   elseif(isset($_POST['delete']))
   {
   	// 1: do some error checking here
   	// 2: throw an error or do DB DELETE here
   	// 3: set variable that displays "add" button:
   	$display_button_valu = "add";
   	$display_button_name = "add";
   	// 4: set a confirmation message:
   	$msg = "Your stuff has been DELETED";
   }
   // user is doing nothing, it's his/her first time (ooer)
   else
   {

?>
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
 
 
 


function validateRadio (radios)
{
    for (i = 0; i < radios.length; ++ i)
    {
        if (radios [i].checked) return true;
    }
    return false;
}

function validateForm()
{
    if(validateRadio (document.forms["frmAcademic4"]["r1"]))
    {
        return true;
    }
    else
    {
        alert('Please Select the Row you want to Update!');
        return false;
    }
}

</script>
 

</head>

<body style="margin-top: -25px;">

<?php include('topMenu.php');?>
<div class="container" style="width:100%; margin-left:-5px;">
<form name="frmAcademic4" action="" method="post" onsubmit="return validateForm()">
	<table cellpadding="0"  cellspacing="0" border="0" class="table table-striped table-bordered" id="example" >
		<thead style="background-color: #314C95;color:#FFFFFF;">
			<tr>
				<th style="text-align:center; font-size:12px; ">From Year</th>
				<th style="text-align:center;  font-size:12px; ">To Year</th>
				<th style="text-align:center; font-size:12px; ">University/School</th>
				<th style="text-align:center;  font-size:12px; ">Award/Attainment(masters,bachelors)</th>
				<th style="text-align:center;  font-size:12px; ">Course/Program(e.g PhD,MSc,BA,O'Level etc</th>
				<th style="text-align:center;  font-size:12px; ">Specialization/Subject (e.g Econ,Math,Sociology etc)</th>
				<th style="text-align:center; font-family:cursive; font-size:12px; ">Action</th>
			</tr>
		</thead>
		<tbody>
		<?php
		//$varTableName = 'testmember';
		$query=mysqli_query($dbconnection, "select * from academic_qualification WHERE id_number='".$id_number."'")or die(mysqli_error());
		while($row=mysqli_fetch_array($query)){
		$aq_id=$row['aq_id'];
		?>
			<tr>
				<td style="text-align:center;  font-size:12px;"><?php echo $row['date_from'] ?></td>
				<td style="text-align:center;  font-size:12px;"><?php echo $row['date_to'] ?></td>
				<td style="text-align:center;  font-size:12px;"><?php echo $row['university'] ?></td>
				<td style="text-align:center;  font-size:12px;"><?php echo $row['award'] ?></td>
				<td style="text-align:center; font-size:12px;"><?php echo $row['course'] ?></td>
				<td style="text-align:center; font-size:12px;"><?php echo $row['specialisation'] ?></td>
				<td style="text-align:center; font-size:12px;">
					<input name="selector[]"  id="r1" type="radio" value="<?php echo $aq_id; ?>">
				</td>
			</tr>
		<?php  } ?>
		</tbody>
	</table>
	<br />
	<button name="btnEdit" class="btn btn-success pull-right" style="background-color:#314C95" name="submit_mult" type="submit">
		Update 
	</button>
		</form>

<br>
<br>

<form class="form-vertical" action="" method="post">

<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
		<thead style="background-color: #314C95;color:#FFFFFF;">
			<tr>
				<th style="text-align:center; font-size:12px; ">From Year</th>
				<th style="text-align:center; font-size:12px; ">To Year</th>
				<th style="text-align:center; font-size:12px; ">University/School</th>
				<th style="text-align:center; font-size:12px;">Award/Attainment(Doctorate, Masters, Bachelors)</th>
				<th style="text-align:center; font-size:12px;">Course/Program(e.g Commerce, Information Techmology, Engineering etc</th>
				<th style="text-align:center; font-size:12px;">Specialization/Subject (e.g Econ,Math,Sociology etc)</th>
				
			</tr>
		</thead>	
		<tbody>
		  <tr align="center">
			<td><span class="controls">
			  <input name="date_from" id="txtStartDate"  type="date" required="required" value="<?php echo $row['date_from'] ?>" />
			</span></td>
			<td><span class="controls">
			  <input name="date_to" id="txtEndDate"  onchange="TDate()" type="date" required="required" value="<?php echo $row['date_to'] ?>" />
			</span></td>
			<td><span class="controls">
			  <input name="university" type="text" required="required" style=" font-weight:bold;" value="<?php echo $row['university'] ?>" />
			</span></td>
			<td><span class="controls">
			  <input name="award" type="text" required="required" style=" font-weight:bold;" value="<?php echo $row['award'] ?>" />
			</span></td>
						<td><span class="controls">
			  <input name="course" type="text" required="required"style=" font-weight:bold;" value="<?php echo $row['course'] ?>" />
			</span></td>
						<td><span class="controls">
			  <input name="specialisation" type="text" required="required" style="font-weight:bold;" value="<?php echo $row['specialisation'] ?>" />
			</span></td>
		  </tr>
	  </tbody>
</table>
	</div>
	<div class="row">
	<div class="form-group col-md-4">
	   <a href="./secThree.php" role="button" class="btn btn-success pull-left" style="margin-left:1%;background: #314C95;"><< Previous</a>
	   </div>
	<div class="form-group col-md-4">
    <input name="btnIinsertNew" class="btn btn-success pull-right"  style="padding:20px;" type="submit" value="Save" onmouseover="DateCheck()" >
	</div>
	
	   <div class="form-group col-md-4">
<input type="submit" name="btnSubmitProfile"  style="margin-left:65%;"value="Next >>" onclick="window.location.href='secFive.php'">
</div>
</div>
</form>







</body>
</html>
<?php
   }?>