<?php
include('../includes/dbConfig.php');
session_start();

include('header.php');
$id_number = $_SESSION['id_number'];

if(isset($_GET['delete'])){

    $advert_id =$_GET['delete'];
    $delete_query=mysqli_query($conn,"DELETE FROM vacancy WHERE vacancy_id='".$advert_id."'") or die (mysqli_error($conn));
   if($delete_query){
      // echo "deleted successfully";

       $_SESSION['message']="Advert Successfully Deleted";
       $_SESSION['alert']="alert alert-danger";

       header("Location:../adverts.php");
       exit();
   }else{
       $_SESSION['message']="Failed to delete the Advert, Please retry again";
       $_SESSION['alert']="alert alert-warning";
       header("Location:../adverts.php");
       exit();
   }
}
