<?php
$id_number=$_SESSION['id_number'];
$sql="SELECT * FROM `applicant_details` WHERE `id_no`='$id_number'";
$result=$conn->query($sql);
$count=mysqli_num_rows($result);
if ($count < 1) 
{


		echo "<script>
		alert('Kindly select a Vacancy and complete your Profile before proceeding to the next section!'); window.location.href='secOne.php';  
		</script>";

}


?>