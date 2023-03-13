<?php
session_start();

$cser=mysqli_connect("localhost","root","Servicestest2022","dev_secretariat") or die("connection failed:".mysqli_error());

 if(isset($_GET['del'])){
     $del_id=$_GET['del'];

     $query_del="DELETE FROM professional_qualification WHERE id='$del_id'";
     $query_result=mysqli_query($cser,$query_del);
     if($query_result){

         $_SESSION['message'] = "Success Record Deleted";
         $_SESSION['msg_type'] = "danger";
         header("location: ../secFive.php");
     }


 }

?>
