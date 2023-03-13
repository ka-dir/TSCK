<?php
echo "shity man";
include('header.php');
$id_number=$_SESSION['id_number'];
  
  
$query=mysqli_query($dbconnection,"SELECT * FROM tblappliedjobs where advert_no='201812S1101'")or die(mysqli_error());
$count=mysqli_num_rows($query);	 
var_dump($count);exit; 
$dataPoints = array();




?>
