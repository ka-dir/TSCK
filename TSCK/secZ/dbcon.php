<?php
error_reporting (E_ALL ^ E_NOTICE);
ini_set('display_errors','1');

$dbconnection=mysqli_connect('localhost','root','');
mysqli_select_db($dbconnection, 'dbMultiEdit') or die ("Unable to connect!");



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbMultiEdit";
// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}




?>
