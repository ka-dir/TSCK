<?php
include('../includes/dbConfig.php');

 if(isset($_GET['del'])){
     $del_id=$_GET['del'];

     $query_del="DELETE FROM current_membership WHERE current_membership_id='$del_id'";
     $query_result=mysqli_query($conn,$query_del);
     if($query_result){

         $_SESSION['message'] = "Success Record Deleted";
         $_SESSION['msg_type'] = "danger";
         header("location: ../secSeven.php");
     }


 }

?>
