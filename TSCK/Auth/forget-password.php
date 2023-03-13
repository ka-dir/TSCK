<?php
include ('reset-password-server');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Forget Password Secretariat Recruitment Portal</title>

    <link rel="stylesheet" type="text/css" href="../css/style1.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>

<div class="header">
    <img  src="../images/tsclogowhite.png" style="width: 100px; height: 100px; "/>
    <p class="" href="#"><h4>Teachers Service Commission<h4/> <br>
        <h5> Secretariat Recruitment Portal</h5></p>
    <div class="form-section pb0 text-center" style="margin-top: 8vh">
        <div class="bs-callout bs-callout-info text-left" style="text-align: center">
            <h4 class="md-18" style="color: red">Lost Password Recovery</h4>
            <p>If you have forgotten your password, you can request to reset it. Fill in your ID number below to reset your password.</p>

    </div>
    </div>

</div>


<form method="post" action="reset-password-verification.php">

    <?php include('errors.php'); ?>


    <div class="form-group">
        <label>Enter your ID Number</label>
        <input type="number" pattern="/^-?\d+\.?\d*$/" class="form-control mb10" onKeyPress="if(this.value.length==8) return false;"   placeholder="e.g 12345678" name="idnumber" required="required" >

    </div>

    <div class="input-group">
        <button type="submit" class="btn btn-primary btn-block btn-lg" name="forgetpassword_user" >Reset My Password</button>
    </div>

</form>
</body>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>