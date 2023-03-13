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

$id_number=$_SESSION['id_number'];

if(ISSET($_POST['id_number']))
{
$userid =$_POST['id_number'];
//echo $userid ;
//$query=mysqli_query($dbconnection,"select * from users where id_number='".$userid."'");
$query=mysqli_query($dbconnection,"select u.phone_number,u.is_admin,u.id_number,u.email,u.DateTime	from users as u where u.id_number='".$userid."'");
  $row = mysqli_fetch_array($query);  
      echo json_encode($row);  

}






 ?>
 



