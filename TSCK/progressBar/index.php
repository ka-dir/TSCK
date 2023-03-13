<?php
include('header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
      
  </style><link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<body>

<div class="container">

    <?php 
if(isset($_POST['submit']))
{
 $total= "1000";

$count=$_POST['count'];
 $to= ($count/$total)*100;
}
?>
    
 <div class="progress progress-striped active">
<div class="progress-bar progress-bar-warning" style="width: <?php echo $to; ?>%"></div>
</div>

<form method="post" action="#">
   <input type="number" name="count">
   <input type="submit" name="submit"> 
</form>
</body>
</html>


<?php 


                                    $qry="SELECT COUNT(*) FROM  tblappliedjobs;";
                                     $result= mysqli_query($conn,$qry);
                                      $row= mysqli_fetch_array($result);
                                      $total=  $row['COUNT(*)'] ;
				 $to= ($total/1000)*100;

?>


                    <!--p style="font-size: 1.7vw">Total:<?php //echo $total; ?></p>
                    <div class="container1">
                           <div class="progress progress-striped active">
<div class="progress-bar progress-bar-warning" style="width: <?php //echo $to; ?>%"></div>
</div>
                          </div-->





