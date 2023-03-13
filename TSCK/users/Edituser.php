<?php
//include('header.php');
$id_number=$_SESSION['id_number'];
$dbHost="localhost";
$dbUsername="root";
$dbPassword="?!dbtscservices1967!(^&";
$dbName="dbrecruitmentTEST";

//One
$dbconnection=mysqli_connect("$dbHost","$dbUsername","$dbPassword");
mysqli_select_db($dbconnection, "$dbName") or die ("Unable to connect!");

//Two
$conn=new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

if($conn->connect_error)
{
	die("Unable to connect database: " .$conn->connect_error);
}
else
{
	//echo "Successfull";
}

//............................................................................................................


 if(!empty($_POST))  
 {  
      $output = '';  
      $message = '';  
      $id_no = mysqli_real_escape_string($dbconnection, $_POST["id_no"]);  
      $email = mysqli_real_escape_string($dbconnection, $_POST["email"]);  
      $mobile_no = mysqli_real_escape_string($dbconnection, $_POST["mobile_no"]);  
      $role_granted = mysqli_real_escape_string($dbconnection, $_POST["role_granted"]);  
      $created_at = mysqli_real_escape_string($dbconnection, $_POST["created_at"]);  
 
 
   if($_POST["id_number"] != '')  
      {  
           $query = mysqli_query($dbconnection,"  
           UPDATE users SET phone_number='$mobile_no',is_admin='$role_granted',email='$email',DateTime = '$created_at',id_number ='$id_no'   
           WHERE id_number='".$_POST["id_number"]."'");  
           $message = 'Data Updated';  
	
      } 



  
	  
	   
 }         



 ?>



































 