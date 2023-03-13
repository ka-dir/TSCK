<?php
include('reset-password-server.php');
error_reporting (E_ALL ^ E_NOTICE);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Verification</title>
    <link rel="stylesheet" type="text/css" href="../css/style1.css">

</head>
<body>
<?php
$_SESSION['phone_number'];

?>
<div class="header">
    <img  src="../images/tsclogowhite.png" style="width: 100px; height: 100px; "/>
    <p class="" href="#"><h4>Teachers Service Commission<h4/> <br>
        <h5>Recruitment Portal</h5></p>

</div>

<form method="post" action="reset-password-verification.php">

    <?php if (isset($_SESSION['OTPMessage'])) : ?>
        <div class="error success" >
            <h5>
                <?php
                $otpmessage=$_SESSION['OTPMessages'];
                echo $otpmessage;
                unset($_SESSION['OTPMessages']);
                ?>
            </h5>
        </div>
    <?php endif ?>

    <?php include('errors.php'); ?>
    <div class="input-group">
        <label>Verification Code For Reset Password:</label>
        <input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==6) return false;"  name="otp_code">
    </div>
    <div class="input-group">
        <label>New Password:</label>
        <input type="password" name="password_1">
    </div>
    <div class="input-group">
        <label>Confirm  New password:</label>
        <input type="password" name="password_2">
    </div>
    <div class="input-group">
        <button type="submit" class="btn" name="otpreset">Submit</button>
    </div>
</form>
</body>
</html>