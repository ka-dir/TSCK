<?php
$dbHost="localhost";
$dbUsername="root";
$dbPassword="Servicestest2022";
$dbName="dev_secretariat";

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

?>
