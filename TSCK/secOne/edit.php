<html>
<head>

<title>
<?php
include('header.php');
?>
</title>
<script type="text/javascript" >
function yesnoCheck()
 {
    if (document.getElementById('yesCheck').checked)
		{
        document.getElementById('ifYes').style.visibility = 'visible';
      
		} 
	else 
		{
        document.getElementById('ifYes').style.visibility = 'hidden';
       
       
		}
 }

</script>

<script>

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
    if(validateRadio (document.forms["TscOrNot"]["yesno"]))
    {
        return true;
    }
    else
    {
        alert('Please Confirm Whether you are TSC Employee or Not!');
        return false;
    }
}

</script>
</head>
<body style="margin-top: -25px;">


<div class="form-vertical">
<form class="form-horizontal" name="TscOrNot" action="" method="post" onsubmit="return validateForm()">
<?php
$id=$_POST['btnEdit'];



unset($_SESSION['vacancy_id']);
unset($_SESSION['Advert_no']);
$N =$id;
//for($i=0; $i < $N; $i++)
//{
$result = mysqli_query($dbconnection, "SELECT * FROM $varTableName where vacancy_id='$N'");
while($row = mysqli_fetch_array($result))
{
$varVacancy_id=$row['vacancy_id'];
$varAdvert_no=$row['advert_no'];
$_SESSION['vacancy_id']=$varVacancy_id;
$_SESSION['Advert_no']=$varAdvert_no;


	?>

<h3> 1.Vacancy: Apply for <?php echo $row['post_vacancy'] ?> ? </h3>




	<div class="thumbnail" style="margin-left:0px; width:800px;" align="left">
	<div style="margin-left: 20px; margin-top: 20px;">
	<div class="row">
	<div class="form-group col-md-3">
		<label class="control-label" for="inputEmail" style="font-weight:bold; font-size:14px; color:black;">Advert Number: </label>

		<input   name="vacancy_id" type="hidden" value="<?php echo  $row['vacancy_id'] ?>" readonly />
		
		<input name="advert_no" type="text" style="font-weight:bold; font-size:14px; color:black;" value="<?php echo $row['advert_no'] ?>" readonly />
</div>
</div>
<div class="row">
 <div class="form-group col-md-3">
		<label class="control-label" for="inputEmail" style="font-weight:bold; font-size:14px; color:black;">Due Date: </label>

			<input name="duedate" type="text" style="font-weight:bold; font-size:14px; color:black;" value="<?php echo $row['duDate'] ?>" readonly />
			<input name="post_vacancy" type="hidden" value="<?php echo  $row['post_vacancy'] ?>" />
</div>
	</div>	
		
		
		<label class="control-label"  style="font-weight:bold; font-size:14px; color:black;">
		<td><strong>Are you or an existing Teachers Service Commission employee?</strong></td>
		<td>
		<input type="radio" onclick="javascript:yesnoCheck();" name="yesno" id="yesCheck"   value="1" />Yes
		<input type="radio" onclick="javascript:yesnoCheck();" name="yesno" id="noCheck"  value="0"/>No<br>
		</td>
	
		</label><br>
				
		<label class="control-label" for="inputEmail" style="font-weight:bold; font-size:14px; color:black; visibility:hidden;"id="ifYes">
		<div align="left">
		<tr>
			<td><strong>If Yes,Enter Your Payroll TSC Number here: </strong></td><br>
			 
			<td>
			<div class="form-group col-md-5">
			<input  name="tscNo" maxlength="10" min="6" id='yes'oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" style=" font-weight:bold;" />
			</div>
			
			</td>

		</tr>
		</div>
		</label>

	


	</div>
	</div>

<?php
}
//}
?>
<a href="./secA.php" role="button" class="btn btn-success pull-left" style="background-color:#314C95;"><< Previous</a>
<input name="btnInsertVacancy" class="btn btn-success pull-left" style="margin-left: 165px;width:180px; background-color:#314C95;" type="submit" value="Apply for above Position">
</form>

</div>


</body>
</html>
