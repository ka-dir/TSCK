<?php 
include('header.php'); 
include('includes/topsection.php');
?>


<html>
<head>
<title> Application For Advertised Post </title>
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
 
 function yesnoCheck1()
 {
    if (document.getElementById('yesCheck1').checked)
		{
        document.getElementById('ifYes1').style.visibility = 'visible';
		} 
	else 
		{
        document.getElementById('ifYes1').style.visibility = 'hidden';
		}
 }
 
 function yesnoCheck2()
 {
    if (document.getElementById('yesCheck2').checked)
		{
        document.getElementById('ifYes2').style.visibility = 'visible';
		} 
	else 
		{
        document.getElementById('ifYes2').style.visibility = 'hidden';
		}
 }
 

</script>
</head>
<body style="margin-top: -25px;">


<h3> 3.Other Personal Details </h3>


<form  method="post" action="">

<p>Have you ever been convicted of any criminal offence or  a subject of probation order?                                                                             
<input type="radio" onclick="javascript:yesnoCheck();" name="yesno" id="yesCheck" value="Yes" >Yes
<input type="radio" onclick="javascript:yesnoCheck();" name="yesno" id="noCheck" checked value="No">No
   </p>
   <div id="ifYes" style="visibility:hidden">

   <p>
   If Yes, State nature of offence, the year and the of conviction.

   <!--<input type="text" name="textarea1" style="width: 50%;" rows="10" cols="10"></textarea>-->
  
   </p>
     <textarea name="textarea1" style="width: 50%;"></textarea>
   </div>

   <p>Have you ever been dismissed or otherwise removed from employment ? 
   <input type="radio"  onclick="javascript:yesnoCheck1();" name="yesno1" id="yesCheck1"  value="yes">Yes
	<input type="radio" onclick="javascript:yesnoCheck1();" name="yesno1" id="yesCheck1" checked value="No">No
   </p>
   <div id="ifYes1" style="visibility:hidden">
   <p>
   If Yes, State reason(s) for dismissal/removal.
 
   </p>
   <textarea name="textarea2" style="width: 50%;" rows="10" cols="10"></textarea><br>
   <!--<input type="text" name="textarea2" style="width: 50%;" rows="10" cols="10"></textarea>-->
   <i>Effective date of dismissal &nbsp;</i>
   <input  style="width:20%;"type="date" name="dismissalDate">
</div>
     <p>Do you have any ongoing criminal or corruption case ? 
   <input type="radio"  onclick="javascript:yesnoCheck2();" name="yesno2" id="yesCheck2"  value="yes">Yes
	<input type="radio" onclick="javascript:yesnoCheck2();" name="yesno2" id="yesCheck2" checked  value="No">No
   </p>
    <div id="ifYes2" style="visibility:hidden">
    <p>
   If Yes, Elaborate.
 
   </p>
   <textarea name="textarea3" style="width: 50%;" rows="10" cols="10"></textarea><br>
      <!--<input type="text" name="textarea3" style="width: 50%;" rows="10" cols="10"></textarea>-->
</div>
   <p> <b>(Declaring the above information will not necessarily debar an applicant from employment <br>in the Teacher Service Commission, Each case will be considered on its own merit)</b></p>

  	
<div><a href="./secTwo.php" role="button" style="background-color:#314C95;" class="btn btn-success pull-left" style="margin-left:10%;"><< Previous</a>
  <input type="submit"  style="margin-right:7%;width:80px;height=2%;"onclick="window.location.href='secFour.php'" align="left"  name="submit" value="Next >>">
		<!-- <input type="submit" style="margin-left:10%;"name="btnSubmitProfile" value="Next >>" onclick="window.location.href='secThree.php'"-->
 </div>  

 </form>
 
   
</body>
</html>

<?php
//include('../TSCK/includes/dbConfig.php');
//session_start();
if(isset($_REQUEST['submit']))
{
	//ADDLASHES FUNCTION


function addslashesifneeded ($stringtocheck){
	if (!get_magic_quotes_gpc()) {
	   $goodstring = addslashes($stringtocheck);
	} else {
	   $goodstring = $stringtocheck;
	}
	return $goodstring;
}
	$convicted=($_POST['yesno']);
	$textarea1=addslashesifneeded(strtoupper($_POST['textarea1']));
	$dismissed=($_POST['yesno1']);
	$textarea2=addslashesifneeded(strtoupper($_POST['textarea2']));
	$corruption=($_POST['yesno2']);
	$textarea3=addslashesifneeded(strtoupper($_POST['textarea3']));
	
	$dismissalDate=date('Y-m-d',strtotime($_POST['dismissalDate']));
	
	
	//echo $_SESSION['convicted']." ".$_SESSION['textarea1']." ".$_SESSION['dismissed']." ".$_SESSION['textarea2']." ".$_SESSION['dismissalDate'];

	
	$sql="UPDATE applicant_details set convition='".$convicted."',convition_description='".$textarea1."',dismissed='".$dismissed."',dismissed_description='".$textarea2."',dismission_date='".$dismissalDate."', corruption='".$corruption."',corruption_description='".$textarea3."'
	WHERE id_no='".$_SESSION['id_number']."'";
	$results=$conn->query($sql);
	if(mysqli_query($conn, $sql))
	{
		?>	
			
	<script>
	window.location.href = 'secFour.php';
	</script>
		
		<?php
		
		
		//echo "Records inserted successfully.";
		//header("location: secFour.php");
	} else
	{
		
		echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
		//trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);
	}
	
	

}

?>


