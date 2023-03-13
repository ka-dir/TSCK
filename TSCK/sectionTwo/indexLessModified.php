
<?php

include('../TSCKTEST/includes/dbConfig.php');



//session_start();
error_reporting (E_ALL ^ E_NOTICE);
$VarVacancy_id=$_SESSION['vacancy_id'];
$VarAdvert_no=$_SESSION['Advert_no'];
$VarTscNo=$_SESSION['TscNo'];
$VarID_No=$_SESSION['id_number'];
$VarPage="2-Personal Details";

//get phone number & email from users 

 $VarID_No=$_SESSION['id_number'];
 
  $sql = "SELECT phone_number,email FROM users WHERE id_number='$VarID_No'";
  $results=$conn->query($sql);
 
  while ($userdetails= mysqli_fetch_array($results))
  {
	 $_SESSION['phone_number']=$userdetails['phone_number']; 

	 $_SESSION['email']=$userdetails['email']; 
	
	 
  }
 $email=$_SESSION['email'];
$phonenum=$_SESSION['phone_number'];

if($VarTscNo>0)
{
//the login user who has a TSC no,their bio details are collected from the staffreg and will populate the form below in section two.
//while for the non-tsc user..they will input their bio data in the same form below

	$sql="SELECT DISTINCT * FROM `staffreg` WHERE `Payroll_Num`='".$VarTscNo."'";
	$result=$conn->query($sql);
	while($row = mysqli_fetch_array($result))
	{
		$varTSCNo=intval($row['Payroll_Num']);
		$varTitle=$row['Salutation'];
		$varSurname=$row['Surname'];
		$varFirstName=$row['First-Name'];
		$varOtherNames=$row['Other-Names'];
		$varBirthdate=$row['Birth_Date'];
		$varIdNumber=$row['ID_Number'];
		$varGender=$row['Gender'];
		$varTaxPin=$row['Tax-PIN'];
		$varHomecounty=$row['County-Name'];
		$varPayrollNum=$row['Payroll_Num'];
		$varStationName=$row['Station-Name'];
		$varDesigName=$row['Desig-Name'];
		$varJobDesig=$row['Job-Desig'];
		$varDate=date('d-M-Y',strtotime($row['Birth_Date']));
		$varDateOfPost=date('d-M-Y',strtotime($row['Date_of_Post']));
		
	}
}
//this is to populated details of an applicant who had already made and saved entries in secTwo
elseif($VarID_No>0)
{
$sql="SELECT DISTINCT * FROM `applicant_details` WHERE `id_no`='".$VarID_No."'";
$resultA=$conn->query($sql)or die(mysqli_error($conn));

	while($row = mysqli_fetch_array($resultA))
	{
		$varS_name=$row['S_name'];
		$varF_name=$row['F_name'];
		$varO_name=$row['O_name'];
		$vartitle=$row['title'];
		$varBirthdateA=$row['DOB'];
		$varid_no=$row['id_no'];
		$vartscNo=intval($row['tscNo']);
		$varKRA_pin=$row['KRA_pin'];
		$varmobile_no=$row['mobile_no'];
		$vargender=$row['gender'];
		$varnationality=$row['nationality'];
		$varcounty=$row['county'];
		$varsub_county=$row['sub_county'];
		$varconstituency=$row['constituency'];
		$varpostal_address=$row['postal_address'];
		$varpostal_code=$row['postal_code'];
		$vartown=$row['town'];
		$varemail=$row['email'];
		$varalt_person_name=$row['alt_person_name'];
		$varalt_tel_no=$row['alt_tel_no'];
		$vardisability=$row['disability'];
		$vardisability_description=$row['disability_description'];
		$vardisability_no=$row['disability_no'];
		$vardisability_reg_date=$row['disability_reg_date'];
		$varconvition=$row['convition'];
		$varconvition_description=$row['convition_description'];
		$varcurrent_employer_name=$row['current_employer_name'];
		$varposition_held=$row['position_held'];
		$vareffective_date=$row['effective_date'];
		$vargross_salary=$row['gross_salary'];
		$varDOB=date('d-M-Y',strtotime($row['DOB']));
	
	}


}



if(isset($_POST['btnSubmitProfile']))
{
		if($VarTscNo>0)
		{
		$DOB=$varDate;	
		}
	elseif($VarID_No>0)
		{
		$DOB=$varDOB;		
		}
		else
		{
		$DOB=$dob;
		}	

	
		if($VarTscNo>0)
		{
		$varTSCNoI=$varTSCNo;	
		}
	elseif($VarID_No>0)
		{
		$varTSCNoI=$vartscNo;		
		}
		else
		{
		$varTSCNoI=0;
		}
		
	
	//ADDLASHES FUNCTION


function addslashesifneeded ($stringtocheck)
{
	if (!get_magic_quotes_gpc())
	{
	   $goodstring = addslashes($stringtocheck);
	} 
	else
	{
	   $goodstring = $stringtocheck;
	}
	return $goodstring;
}

	//NOTES
	//-addslashifneeded
	$surname=addslashesifneeded(strtoupper($_POST['surname']));
	$firstname=addslashesifneeded(strtoupper($_POST['firstname']));
	$othername=addslashesifneeded(strtoupper($_POST['othername']));
	$title=addslashesifneeded(strtoupper($_POST['title']));
	$idNo=$_POST['idNo'];
	$pinNo=addslashesifneeded(strtoupper($_POST['pinNo']));
	$mobile_no=addslashesifneeded(strtoupper($_POST['mobile-no']));
	$gender=strtoupper($_POST['gender']);
	$nationality=addslashesifneeded(strtoupper($_POST['nationality']));	
	$county=addslashesifneeded(strtoupper($_POST['county']));
	$subcounty=addslashesifneeded(strtoupper($_POST['subcounty']));
	$Constituency=addslashesifneeded(strtoupper($_POST['Constituency']));
	$postalAddress=addslashesifneeded(strtoupper($_POST['postalAddress']));
	$postalCode=$_POST['postalCode'];
	$town_city=addslashesifneeded(strtoupper($_POST['town_city']));	
	//$mobile_no=$_POST['mobile_no'];
	$email=$_POST['email'];	
	$contactPersonName=addslashesifneeded(strtoupper($_POST['contactPersonName']));
	$contactPersonNo=addslashesifneeded(strtoupper($_POST['contactPersonNo']));	
	$disability=$_POST['yesno'];
	$detailOfDisability=$_POST['detailOfDisability'];
	$RegistrationDisabilityNo=$_POST['RegistrationDisabilityNo'];
	$dateOfDisabilityRegistration=date('Y-m-d',strtotime($_POST['dateOfDisabilityRegistration']));
	$currentEmployer=addslashesifneeded(strtoupper($_POST['currentEmployer']));
	$positionHeld=addslashesifneeded(strtoupper($_POST['positionHeld']));
	//$EffectiveDate=$_POST['EffectiveDate'];
	$EffectiveDate=date('Y-m-d',strtotime($_POST['EffectiveDate']));
	$GrossSalary=$_POST['GrossSalary'];
	$vid=$_SESSION['vacancy_id'];
	$dob=date('Y-m-d',strtotime($_POST['DOB']));
	

	//details inserted into the applicant_details table..section2
	$count = mysqli_num_rows($resultA);
	if($count!=1)
	{
	$sql="INSERT INTO applicant_details
	( 	
	S_name,F_name,O_name,title,DOB,id_no,tscNo,KRA_pin,mobile_no,gender,nationality,county,sub_county,constituency,postal_address,postal_code,town,
	email,alt_person_name,alt_tel_no,disability,disability_description,disability_no,disability_reg_date,current_employer_name,
	position_held,effective_date,gross_salary
	)

		VALUES(	
		'$surname',
		'$firstname',
		'$othername',
		'$title',
		'$dob',
		'$idNo',
		'$varTSCNoI',
		'$pinNo',
		'$mobile_no',
		'$gender',
		'$nationality',
		'$county',
		'$subcounty',
		'$Constituency',
		'$postalAddress',
		'$postalCode',
		'$town_city',
		'$email',
		'$contactPersonName',
		'$contactPersonNo',
		'$disability',
		'$detailOfDisability',
		'$RegistrationDisabilityNo',
		'$dateOfDisabilityRegistration',
		'$currentEmployer',
		'$positionHeld',
		'$EffectiveDate',
		'$GrossSalary')
		";
	
//	$results = mysqli_query($conn,$sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);
	if($sql)
	{
		echo "Records inserted successfully.";
		header("location: secThree.php");
	}
	}
	elseif($count==1)
	{
//.......................for the already existing records,then update.....................................................
	$sqlU="UPDATE applicant_details SET
	S_name='$surname',
	F_name='$firstname',
	O_name='$othername',
	title='$title',
	DOB='$dob',
	id_no='$idNo',
	tscNo='$varTSCNoI',
	KRA_pin='$pinNo',
	mobile_no='$mobile_no',
	gender='$gender',
	nationality='$nationality',
	county='$county',
	sub_county='$subcounty',
	constituency='$Constituency',
	postal_address='$postalAddress',
	postal_code='$postalCode',
	town='$town_city',
	email='$email',
	alt_person_name='$contactPersonName',
	alt_tel_no='$contactPersonNo',
	disability='$disability',
	disability_description='$detailOfDisability',
	disability_no='$RegistrationDisabilityNo',
	disability_reg_date='$dateOfDisabilityRegistration',
	current_employer_name='$currentEmployer',
	position_held='$positionHeld',
	effective_date='$EffectiveDate',
	gross_salary='$GrossSalary'
	WHERE `id_no`='".$VarID_No."'
	";
		
	$resultsU = mysqli_query($conn,$sqlU) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR);
	 	
		if($resultsU)
		{
		echo "Records updated successfully.";
		header("location: secThree.php");
		}
		else
		{
		echo "ERROR: Could not able to execute " . mysqli_error($conn);
		//trigger_error("Error: ".mysqli_error(), E_USER_ERROR);		
			
		}
		
	}

	//$sql="INSERT INTO tbl_logs SET 
	//id_number='".$idNo."',vacancy_id='".$VarVacancy_id."',advert_number='".$VarAdvert_no."',Page='".$VarPage."'";
	//$results = mysqli_query($conn,$sql) or trigger_error("Error: ".mysqli_error(), E_USER_ERROR); -->
}

?>



<!-- section 2 form -->


<html>
<head>
<title>
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
<script type="text/javascript"> /* script for only allowing alphabets  */
   		   
    function ValidateAlpha(evt)
    {
        var keyCode = (evt.which) ? evt.which : evt.keyCode
        if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32)
         
        return false;
            return true;
    }

</script>
<link href="../css/style.css" rel="stylesheet">

</head>
<body style="margin-top: -25px;">

<?php		
//include('includes/topsection.php');
?>

<h3>2. Personal Details </h3>

<!--?php include('errors.php'); ?-->

<form  method="post" action="">
<div class="row">

<div class="form-group col-md-2">
		<label for="country">Title</label><br>
		
<?php 
if($VarTscNo>0)
{
//echo $varTitle; 
echo "<input name=\"title\" type=\"text\" readonly = \"\" value = \"$varTitle";
echo "\">";
}
elseif($VarID_No>0)
{
echo "<input name=\"title\" type=\"text\" readonly = \"\" value = \"$vartitle";
echo "\">";	
}
else
{
?>	
		
     <select id="country" name="title">
      <option value="Mr">Mr</option>
      <option value="Mrs">Mrs</option>
      <option value="Miss">Miss</option>
	  <option value="Prof">Prof</option>
      <option value="Dr">Dr</option>
      <option value="Rev">Rev</option>
	  <option value="Other">Other</option>
    </select>
	
<?php
}?>
		
</div>
  

<div class="form-group col-md-2">
<label for="inputCity">Surname</label>
<?php
	if($VarTscNo>0)
	{
	echo "<input name=\"surname\" type=\"text\" readonly = \"\" value = \"$varSurname";
	echo "\">";
	}
	elseif($VarID_No>0)
	{
	echo "<input name=\"surname\" type=\"text\" readonly = \"\" value = \"$varS_name";
	echo "\">";	
	}
	else
	{
	?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<input type="text" class="ValidateAlphaAndSpecialKeys" name="surname" placeholder="Surname" required="required">	
<?php }?>
<script type="text/javascript">
    $('.ValidateAlphaAndSpecialKeys').on('input', function() {
  var node = $(this);

  node.val(node.val().replace(/[^a-z\s'-]/gi, ''));
});
</script>
</div>



<div class="form-group col-md-2">
<label for="inputCity">First Name</label>
<?php
	if($VarTscNo>0)
	{
	echo "<input name=\"firstname\" type=\"text\" readonly = \"\" value = \"$varFirstName";
	echo "\">";
	}
	elseif($VarID_No>0)
	{
	echo "<input name=\"firstname\" type=\"text\" readonly = \"\" value = \"$varF_name";
	echo "\">";	
	}
	else
	{
	?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<input type="text" class="ValidateAlphaAndSpecialKeys" name="firstname" placeholder="First Name" required="required">	
<?php }?>
<script type="text/javascript">
    $('.ValidateAlphaAndSpecialKeys').on('input', function() {
  var node = $(this);

  node.val(node.val().replace(/[^a-z\s'-]/gi, ''));
});
</script>
</div>
	

<div class="form-group col-md-2">
<label for="inputCity">Other Names</label>
<?php
	if($VarTscNo>0)
	{
	echo "<input name=\"othername\" type=\"text\" readonly = \"\" value = \"$varOtherNames";
	echo "\">";
	}
	elseif($VarID_No>0)
	{
	echo "<input name=\"othername\" type=\"text\" readonly = \"\" value = \"$varO_name";
	echo "\">";
	}
	else
	{
	?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<input type="text" class="ValidateAlphaAndSpecialKeys" name="othername" placeholder="Other Names" >	
<?php }?>
<script type="text/javascript">
    $('.ValidateAlphaAndSpecialKeys').on('input', function() {
  var node = $(this);

  node.val(node.val().replace(/[^a-z\s'-]/gi, ''));
});
</script>
</div>
	
</div>
<div class="row">
<div class="form-group col-md-2">
<label for="inputCity">Date of Birth</label><br>
  
<?php 
if($VarTscNo>0)
{
echo "<input name=\"DOB\" type=\"date\" readonly = \"\" value = \"$varBirthdate";
echo "\">";

//echo "<input size = \"8\" name=\"DOB\" type=\"text\" readonly = \"\" style=\"background-color:#FF99FF\" value = \"$varDate";
//echo "\">";
}
elseif($VarID_No>0)
{
echo "<input name=\"DOB\" type=\"date\" readonly = \"\" value = \"$varBirthdateA";
echo "\">";	
}
else
{	
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">
	    $(function(){
        var dtToday = new Date();   
        var month = dtToday.getMonth() + 1;// jan=0; feb=1 .......
        var day = dtToday.getDate();
        var year = dtToday.getFullYear() - 18;
        if(month < 10)
            month = '0' + month.toString();
        if(day < 10)
            day = '0' + day.toString();
    	var minDate = year + '-' + month + '-' + day;
        var maxDate = year + '-' + month + '-' + day;
    	$('#DOB').attr('max', maxDate);
    });
</script>
	  
      <input type="date" align="left" name="DOB" data-form-field="DOB" required="required" id="DOB" placeholder="dd-mm-yyyy"
	  value="">
	  <?php } ?>
    </div>


     <div class="form-group col-md-2">
      <label for="inputCity">ID Number</label>
      <input  type="text"  name="idNo" maxlength="8" required="required" readonly
	  value="<?php 

	  echo $VarID_No; 
	  
	  ?>" >
    </div>
	
	

	
	
	
<div class="form-group col-md-2">
<label for="inputCity">Gender</label><br>		
<?php 
if($VarTscNo>0)
{
if(($varGender=="M") OR ($varGender=="F"))
{


	echo "<input name=\"gender\" type=\"text\" readonly = \"\" value = \"$varGender";
	echo "\">";

}
 
}
elseif($VarID_No>0)
{
echo "<input name=\"gender\" type=\"text\" readonly = \"\" value = \"$vargender";
	echo "\">";	
}
else
{
?>	
		
     <select id="country" name="gender">
      <option value="Male">Male</option>
      <option value="Female">Female</option>
    </select>
	
<?php
}?>		
</div>
	 
	<script type="text/javascript">
    function blockSpecialChar(e){
        var k;
        document.all ? k = e.keyCode : k = e.which;
        return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32 || (k >= 48 && k <= 57));
        }
    </script>

	
	
	<!--div class="form-group row">
    <label for="staticEmail" class="col-sm-4 col-form-label">KRA PIN</label>
    <div class="col-sm-8">
        <input type="text" name="kra_pin" class="form-control validate[required]" required maxlength="11" minlength="11" pattern="[a-zA-Z]{1}[0-9]{9}[a-zA-Z]{1}" placeholder="e.g..N123456789G">
    </div>
	</div!-->

<div class="form-group col-md-2">
      <label for="inputCity">KRA Pin</label>
	  
<?php 
	  if($VarTscNo>0)
	  {
	echo "<input name=\"pinNo\" type=\"text\" readonly = \"\" value = \"$varTaxPin";
	echo "\">";	  
	 //echo $varTaxPin;
	  }
	  elseif($VarID_No>0)
	  {
	echo "<input name=\"pinNo\" type=\"text\" readonly = \"\" value = \"$varKRA_pin";
	echo "\">";  
	 // echo $varKRA_pin;
	  }
	 else
	 {		 
	  ?>	  

      <input type="text" onkeypress="return blockSpecialChar(event)" 
	  class="form-control validate[required]" required maxlength="11" minlength="11" pattern="[a-zA-Z]{1}[0-9]{9}[a-zA-Z]{1}"
	  name="pinNo"  placeholder="e.g..N123456789G" required="required">
	<?php }?>
	
</div>

</div>
 
<div class="row">
  	 <div class="form-group col-md-2">
      <label for="inputCity">Postal Address</label>
	  <?php
	if($VarID_No>0)
	  {
	echo "<input name=\"postalAddress\" type=\"text\" readonly = \"\" value = \"$varpostal_address";
	echo "\">";  
	//echo $varpostal_address;
	  }
	 else
	 {
	  ?>
	    
      <input type="text" name="postalAddress"required="required" placeholder="e.g. 75929"value="">
	  <?php
	 }
	  ?>
    </div>
	
	
     <div class="form-group col-md-2">
      <label for="inputCity"> Postal Code</label>
	  <?php
	  if($VarID_No>0)
	  {
	echo "<input name=\"postalCode\" type=\"text\" readonly = \"\" value = \"$varpostal_code";
	echo "\">";  
	//echo $varpostal_code;
	  }
	 else
	 {
	  ?>
      <input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==5) return false;" name="postalCode"required="required" placeholder="e.g. 00200"
	  value="">
	 <?php } ?>
    </div>
	
	
	
     <div class="form-group col-md-2">
      <label for="inputCity">Town/City</label>
	  
	  <?php
	  if($VarID_No>0)
	  {
	echo "<input name=\"town_city\" type=\"text\" readonly = \"\" value = \"$vartown";
	echo "\">";  
	 // echo $vartown;
	  }
	 else
	 {
	  ?>
	  
      <input type="text" onKeyPress="return ValidateAlpha(event);" name="town_city"required="required" placeholder="e.g. Nairobi"
	   value="">
	 <?php } ?>
    </div>
	
	
	
	
</div>

<div class="row">

<div class="form-group col-md-2">
<label for="inputCity">Nationality</label>
<?php 
if($VarID_No>0)
{
	echo "<input name=\"nationality\" type=\"text\" required\"required\" readonly = \"\" value = \"$varnationality";
	echo "\">";
	
}
else
{
?>	
<!--  <input type="text" name="nationality" required="required" placeholder="Nationality" > -->
<select name="nationality">
<option>Kenyan</option>
<?php 
$sql = mysqli_query($conn, "SELECT * FROM countries");
while ($row = $sql->fetch_assoc())
{
echo "<option value=".$row['nationality'].">" . $row['nationality'] . "</option>";
}
}
?>
</select>
</div>
    
	
<div class="form-group col-md-2">
<label for="inputCity">Home County</label><br>		
<?php 
if($VarTscNo>0)
{
//echo $varHomecounty;

	echo "<input name=\"county\" type=\"text\" readonly = \"\" value = \"$varHomecounty";
	echo "\">";

}
elseif($VarID_No>0)
{
	echo "<input name=\"county\" type=\"text\" readonly = \"\" value = \"$varcounty";
	echo "\">";
	
}
else
{
?>	
		
<select id="country" name="county" required="required">
<option value="">Select County</option>
<option value="Baringo">Baringo</option>
<option value="Bomet">Bomet</option>
<option value="Bungoma">Bungoma</option>      
<option value="Busia">Busia</option>
<option value="Elgeyo Marakwet">Elgeyo Marakwet</option>
<option value="Embu">Embu</option>
<option value="Garissa">Garissa</option>
<option value="Homa Bay">Homa Bay</option>
<option value="Kajiado">Kajiado</option>
<option value="Kakamega">Kakamega</option>
<option value="Kericho">Kericho</option>
<option value="Kiambu">Kiambu</option>
<option value="Kilifi">Kilifi</option>
<option value="Kirinyaga">Kirinyaga</option>
<option value="Kisii">Kisii</option>
<option value="Kisumu">Kisumu</option>
<option value="Kitui">Kitui</option>
<option value="Kwale">Kwale</option>
<option value="Laikipia">Laikipia</option>
<option value="Lamu">Lamu</option>
<option value="Machakos">Machakos</option>
<option value="Makueni">Makueni</option>
<option value="Mandera">Mandera</option>
<option value="Meru">Meru</option>
<option value="Migori">Migori</option>
<option value="Marsabit">Marsabit</option>
<option value="Mombasa">Mombasa</option>
<option value="Muranga">Muranga</option>
<option value="Nairobi">Nairobi</option>
<option value="Nakuru">Nakuru</option>
<option value="Nandi">Nandi</option>
<option value="Narok">Narok</option>
<option value="Nyamira">Nyamira</option>
<option value="Nyandarua">Nyandarua</option>
<option value="Nyeri">Nyeri</option>
<option value="Samburu">Samburu</option> 
<option value="Taita Taveta">Taita Taveta</option>
<option value="Tana River">Tana River</option>
<option value="Tharaka Nithi">Tharaka Nithi</option>
<option value="Trans Nzoia">Trans Nzoia</option>
<option value="Turkana">Turkana</option>
<option value="Uasin Gishu">Uasin Gishu</option>
<option value="Vihiga">Vihiga</option>
<option value="Wajir">Wajir</option>
<option value="West Pokot">West Pokot</option>
    </select>
	
<?php
}
?>		
</div>
	
</div>

  
<div class="row">

<div class="form-group col-md-2">
<label for="inputCity">Alternative Contact Person</label>

<?php 
	 if($VarID_No>0)
	  {
	echo "<input name=\"contactPersonName\" type=\"text\" readonly = \"\" value = \"$varalt_person_name";
	echo "\">";	  
		  
	//  echo $varalt_person_name;
	  }
	  else
	  {
		  ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<input type="text" class="ValidateAlphaAndSpecialKeys" name="contactPersonName"required="required" placeholder="e.g. John Doe"
	  value="">
	  <?php } ?>
      <script type="text/javascript">
    $('.ValidateAlphaAndSpecialKeys').on('input', function() {
  var node = $(this);

  node.val(node.val().replace(/[^a-z\s'-]/gi, ''));
});
</script>
</div>
	
<div class="form-group col-md-2">
<label for="inputCity">Telephone No</label>
<?php 
	 if($VarID_No>0)
	  {
	echo "<input name=\"contactPersonNo\" type=\"tel\" readonly = \"\" value = \"$varalt_tel_no";
	echo "\">";	 
	 // echo $varalt_tel_no;
	  }
	  else
	  {
	  ?>


<input type="tel" name="contactPersonNo" id="mobile-no" required="required"maxlength="10" minlength="10"
onkeydown="if(event.key ==='.'){event.preventDefault();}"
onpaste="let pasteData = event.clipboardData.getData('text'); if(pasteData){pasteData.replace(/[^0-9]*/g,'');} " placeholder="e.g..0712345678"
onchange="return validation()"
 value=""> 
	  <?php } ?>
</div>
	
<div class="form-group col-md-2">
<label for="inputCity">E-mail address</label>
<?php 
	 if($VarID_No>0)
	  {
	echo "<input name=\"email\" type=\"tel\" readonly = \"\" value = \"$varemail";
	echo "\">";	 
	//echo $varemail;
	  }
	  else
	  {
	  ?>
<input type="email" name="email"required="required" placeholder="e.g abc@tsc.go.ke"
 value="">
	  <?php } ?>
</div>
	
</div>
  
  
  
  
  
  
  <?php
  if($VarTscNo>0)
  
  {
  ?>
  
   <div class="row">
   
	<div class="form-row">

	
	<div class="form-group col-md-2">
      <label for="inputPassword4">TSC No</label>
      <input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;" name="TSCNo"id="TSCNo" placeholder="" readonly
	   value="<?php 
	  if($VarTscNo>0)
	  {
	  echo $varPayrollNum;}?>">
    </div>
	
	  	   <div class="form-group col-md-2">
      <label for="inputPassword4">Present Submitive Post</label>
      <input type="text" onKeyPress="return ValidateAlpha(event);" name="PresentSubmitivePost" placeholder="" readonly 
	  value="<?php 
	  if($VarTscNo>0)
	  {
	  echo $varDesigName;}?>">
    </div>
	
	
    <div class="form-group col-md-2">
      <label for="inputEmail4">Station</label>
      <input type="text" onKeyPress="return ValidateAlpha(event);"  name="station" placeholder="" readonly
	  value="<?php 
	    
	  if($VarTscNo>0)
	  {
	  echo $varStationName;}?>">
    </div>

	</div>
	</div>
	
	  <div class="row">

	
  	<div class="form-group col-md-2">
      <label for="inputPassword4">Job group/Scale/Grade</label>
      <input type="text"  name="jobGroup" placeholder="" readonly
	  value="<?php 
	  if($VarTscNo>0)
	  {
	  echo $varJobDesig;}?>">
    </div>
	
	
	  	<div class="form-group col-md-2">
      <label>Date Of Current Apointment</label>
      <input type="text" onKeyPress="return ValidateAlpha(event);" name="DateOfCurrentApointment" placeholder="" readonly
	  value="<?php 
	  if($VarTscNo>0)
	  {
	  echo $varDateOfPost;}?>">
    </div>
	
  </div>

 <?php
  }
  else
  {
?>  
  
<div class="row">
<div class="form-row">


<div class="form-group col-md-2">
<label for="inputPassword4">Current employer(where applicable)</label>
<?php 
	  if($VarID_No>0)
	  {
		  
	echo "<input name=\"currentEmployer\" type=\"tel\" readonly = \"\" value = \"$varcurrent_employer_name";
	echo "\">";	 
	 // echo $varcurrent_employer_name;
	  }
	  else
	  {?>


<input type="text" onKeyPress="return ValidateAlpha(event);" name="currentEmployer" placeholder=""
value="">
<?php
	  }
	  ?>
</div>


<div class="form-group col-md-2">
<label><strong>Position held:</strong></label>
<?php 
	  if($VarID_No>0)
	  {
	echo "<input name=\"positionHeld\" type=\"tel\" readonly = \"\" value = \"$varposition_held";
	echo "\">";	   
	  //echo $varposition_held;
	  }
	  else
	  {
	  ?>
<input type="text" onKeyPress="return ValidateAlpha(event);" name="positionHeld"  placeholder=""
value="">
<?php
}
?>
</tr>
</div>

<div class="form-group col-md-2">
<label><strong>Effective date:</strong></label>
<?php 
	  if($VarID_No>0)
	  {
	echo "<input name=\"EffectiveDate\" type=\"tel\" readonly = \"\" value = \"$vareffective_date";
	echo "\">";	
	 // echo $vareffective_date;
	  }
	  else
	  {
		  ?>

<input type="date" name="EffectiveDate" placeholder="dd-mm-yyyy"
value="">
<?php
  }
  ?>
</div>

<div class="form-group col-md-2">
<label><strong>Gross Salary(monthly)Ksh:</strong></label>


<?php 
if($VarTscNo>0)
{
	echo "<input name=\"GrossSalary\" type=\"text\" readonly = \"\" value = \"$vargross_salary";
	echo "\">";
//echo $vargross_salary;
}
elseif($VarID_No>0)
{
	echo "<input name=\"GrossSalary\" type=\"text\" readonly = \"\" value = \"$vargross_salary";
	echo "\">";
	//echo $vargross_salary;
}
else
{
?>	







<!--  <input type="text" name="GrossSalary" placeholder="" > -->
<select id="country" name="GrossSalary" required="required">
	  <option value="">	  </option>
      <option value="D">23,895-44,712</option>
	  <option value="E">26,458-49,352</option>
      <option value="F">32,979-51,124</option>
	  <option value="G">41,628-69,817</option>
      <option value="H">44,159-67,197</option>
	  <option value="J">56,725-89,538</option>
	  <option value="K">68,646-97,959</option>
	  <option value="L">89,474-128,654</option>
	  <option value="M">115,224-140,107</option>
	  <option value="N">143,222-169,445</option>
	  <option value="P">168,446-195,248</option>
	  <option value="Q">196,460-226,098</option>
	  <option value="R">229,896-282,774</option>
	  <option value="S">286,073-350,109</option>
	  <option value="T">352,300-429,873</option>
	  <option value="U">430,000-500,000</option>
	  <option value="above500000">Above 500,000</option>

</select>
<?php
}
?>
</div>



</div>
</div>
  
  <?php
  }
  ?>

<div class="row">
<div class="form-group col-md-2">
<label for="inputCity">Are you living with a Disability</label><br>
<input type="radio" onclick="javascript:yesnoCheck();" name="yesno" id="yesCheck" required="required" value="YES"/>Yes
<input type="radio" onclick="javascript:yesnoCheck();" name="yesno" id="noCheck" required="required" value="NO"/>No
</div>
</div>
     	 
<div id="ifYes" style="visibility:hidden" class="row">
  	 <div class="form-group col-md-2">
      <label for="inputCity">i) Nature of disability</label>
	  <?php 
	  if($VarID_No>0)
	  {
		echo "<input name=\"detailOfDisability\" type=\"text\" readonly = \"\" value = \"$vardisability_description";
	echo "\">";	  
	  //echo $vardisability_description;
	  }
	  else
	  {?>
	  
	  
      <input type="text" onKeyPress="return ValidateAlpha(event);" id='yes' name="detailOfDisability" default="None"
	  value="">
	  <?php
	  }
	  ?>
     </div>
<div class="form-group col-md-3">
      <label for="inputCity">ii) Details of Registration with the National council for people with disabilities</label>
      <div class="row">
<div class="form-group col-md-6">
    <label>Registration No</label>
	
	<?php 
	  if($VarID_No>0)
	  {
	echo "<input name=\"RegistrationDisabilityNo\" type=\"text\" readonly = \"\" value = \"$vardisability_no";
	echo "\">";  
	 // echo $vardisability_no;
	  }
	  else
	  {  
	  ?>
	
	
    <input type="text" id='yes'name="RegistrationDisabilityNo"
	 value="">
	 
	  <?php } ?>
</div>
</div>
</div>
<div class="form-group col-md-2">
	<label>Registration Date</label>
	<?php 
	  if($VarID_No>0)
	  {
	echo "<input name=\"dateOfDisabilityRegistration\" type=\"text\" readonly = \"\" value = \"$vardisability_reg_date";
	echo "\">";  
	  //echo $vardisability_reg_date;
	  }
	  else
	  {  
	  ?>
	
	<input type="date" align="left" name="dateOfDisabilityRegistration" data-form-field="dateOfDisabilityRegistration" id="dateOfDisabilityRegistration" placeholder="dd-mm-yyyy"
	value="">
	<?php } ?>
</div> 
</div>

  
	
	<div class="row">
	<div class="form-group col-md-4">
     	



<a href="./secOne.php" role="button" style="background-color:#314C95;" class="btn btn-success pull-left" style="margin-left:2%;"><< Previous</a>
</div>
<div class="form-group col-md-4">
     	 <input type="submit" style="margin-left:10%;"name="btnSubmitProfile" value="Save"> 
</div>	
<div class="form-group col-md-4">	 
     	 <input   type="submit" style="margin-right:7%;width:80px;height=2%;"name="btnSubmitProfile" value="Next >>" class="btn btn-success pull-right">
		 </div>
		<!-- <input type="submit" style="margin-left:10%;"name="btnSubmitProfile" value="Next >>" onclick="window.location.href='secThree.php'"-->
 </div>  


</form>

</body>
</html>


<script type="text/javascript">

    function ShowHideDiv()

    {

        var reg_type = "<?php echo $title['reg_type']?>";

        if(reg_type !=2 && reg_type != 1){

          var sel1 = document.getElementById("sel1");

          var dvteachpractice = document.getElementById("dvteachpractice");

          dvteachpractice.style.display = sel1.value == "ECDE" ? "none" : "block";

        }

    }

   

    validateForm = function ()

    {

    return checkName();

    }

 

function nospaces(t)

{

  if(t.value.match(/\s/g)){

    t.value=t.value.replace(/\s/g,'');

  }

}

  

function validation()

{

  var phoneNumber = document.getElementById('mobile-no').value;

  var phoneno = /^(?=\d{10}$)(07)\d+/;

  if(!phoneNumber.match(phoneno))

  {

    document.getElementById("mobile-no").focus();

    alert("phone number MUST start with 07");

    return false;

  }

  else {

  }

}

 

 

function removeSpaces(string) {

return string.split(' ').join('');

}

 

function isNumberKey(evt){

    var charCode = (evt.which) ? evt.which : event.keyCode

    if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;

    return true;

}

</script>
