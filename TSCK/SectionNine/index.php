<?php 
include('header.php');
include('includes/topsection.php');


//error_reporting (E_ALL ^ E_NOTICE);
$id_number=$_SESSION['id_number'];

$datasql="SELECT * FROM applicant_work_details WHERE id_number='".$id_number."' ";
$result_data=$conn->query($datasql);
$row=mysqli_fetch_array($result_data);
$responsbilities=$row['duties_and_responsbillities'];
$abilities=$row['competencies'];
$id_exist=$row['id_number'];

if(isset($_REQUEST['submit']))
{
//$textarea3=$_POST['textarea4'];
//$_SESSION['textarea4']=$textarea3;
$varIdNumber=$_SESSION['id_number'];
$varTxt3=$_POST['textarea3'];
$varTxt4=$_POST['textarea4'];
//$_SESSION['textarea3'];
//$textarea4=$_POST['textarea4'];
//$_SESSION['textarea4']=$textarea4;
if ($id_exist!=null)
{
# code...
$update_work_details_sql="UPDATE `applicant_work_details` SET `duties_and_responsbillities`='$varTxt3',`competencies`='$varTxt4',`id_number`='$varIdNumber' WHERE `id_number`='$varIdNumber'";
/*$sql="INSERT INTO `applicant_work_details`(`duties_and_responsbillities`,`competencies`,`id_number`) 
VALUES('".$varTxt3."','".$varTxt4."','".$varIdNumber."')";*/
$results=$conn->query($update_work_details_sql);
if($results!==true)
{
echo mysqli_error($conn);
}
?>
<script>
window.location.href = 'secReferee.php';
</script>
<?php
}
else
{
$sql="INSERT INTO `applicant_work_details`(`duties_and_responsbillities`,`competencies`,`id_number`) 
VALUES('".$varTxt3."','".$varTxt4."','".$varIdNumber."')";

$results1=$conn->query($sql);
if($results1!==true)
{
echo mysqli_error($conn);
}
?>
<script>
window.location.href = 'secReferee.php';
	</script>
	<?php


}
}else
//............................................................NEXT button................................................
if(isset($_REQUEST['btnSubmitProfile']))
{
//$textarea3=$_POST['textarea4'];
//$_SESSION['textarea4']=$textarea3;
$varIdNumber=$_SESSION['id_number'];
$varTxt3=$_POST['textarea3'];
$varTxt4=$_POST['textarea4'];
//$_SESSION['textarea3'];
//$textarea4=$_POST['textarea4'];
//$_SESSION['textarea4']=$textarea4;
if ($id_exist!=null)
{
# code...
$update_work_details_sql="UPDATE `applicant_work_details` SET `duties_and_responsbillities`='$varTxt3',`competencies`='$varTxt4',`id_number`='$varIdNumber' WHERE `id_number`='$varIdNumber'";
/*$sql="INSERT INTO `applicant_work_details`(`duties_and_responsbillities`,`competencies`,`id_number`) 
VALUES('".$varTxt3."','".$varTxt4."','".$varIdNumber."')";*/
$results=$conn->query($update_work_details_sql);
if($results!==true)
{
echo mysqli_error($conn);
}
?>
<script>
window.location.href = 'secReferee.php';
</script>
<?php
}
else
{
$sql="INSERT INTO `applicant_work_details`(`duties_and_responsbillities`,`competencies`,`id_number`) 
VALUES('".$varTxt3."','".$varTxt4."','".$varIdNumber."')";

$results1=$conn->query($sql);
if($results1!==true)
{
echo mysqli_error($conn);
}
?>
<script>
window.location.href = 'secReferee.php';
	</script>
	<?php


}
}
?>

<html>
<head>
<title> Application For Advertised Post </title>

<script type="text/javascript">
    function blockSpecialChar(e){
        var k;
        document.all ? k = e.keyCode : k = e.which;
        return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32 || (k >= 48 && k <= 57));
        }
    </script>



</head>
<body style="margin-top: -25px;">
<strong>
<h3> 9. Current Duties and Abilities </h3>
<p>Briefly state your current duties, responsibilities and assignments (if any)</p></strong>
<form  method="post" action="">
   <p>
  <textarea name="textarea3" style="width: 50%;" onkeypress="return blockSpecialChar(event)">
  	<?php echo $responsbilities;?>
  </textarea>
       <script>
           CKEDITOR.replace( 'textarea3' );
       </script>
   </p><strong>
  <h3> Details of your Abilities</h3>
<p>Please give details of your abilities, skills and experience which you consider relevant to the position applied for.This information may include an outline of your most recent achievements and your reasons for applying for this post.
    </strong><p>
        <textarea name="textarea4" required><?php echo $abilities;?></textarea>
        <script>
            CKEDITOR.replace( 'textarea4' );
        </script>
   </p>
   <div class="row">
	<div class="form-group col-md-2">
    <a href="./secEight.php" role="button" class="btn btn-success pull-left" style="margin-left:1%;background: #314C95;"> 
	<< Previous</a></div>
	<div class="form-group col-md-2">
	<input  style="margin-left:10%;width:70px;margin-left:30%; padding:5%;" type="submit" name="submit" value="Save" />
	</div>
	<div class="form-group col-md-2">
   <!--a href="./secTen.php" style="width:70px;background: #314C95; margin-left:77%;" role="button" class="btn btn-success pull-left"> 
	 Next >></a-->
	<input type="submit" name="btnSubmitProfile"   style="margin-left:65%;width:70px;"value="Next >>" onclick="window.location.href='secReferee.php'"> 
	</div>
	</div>


</form>
<!--  start editor script -->
  <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript">
//<![CDATA[
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
  //]]>
  </script>
  <!--  end editor script -->

</body>
</html>


