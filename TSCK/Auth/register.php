<?php 
include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>TSC||Register||Secretariat||Portal</title>
	<link rel="stylesheet" type="text/css" href="../css/style1.css">
</head>
<body>
	<div class="header">
	<img  src="../images/tsclogowhite.png" style="width: 100px; height: 100px; "/>
		<p class="" href="#"><h4>Teachers Service Commission<h4/> <br>
		<h5>Secretariat Recruitment Portal</h5></p>

	</div>

	
	<form method="post"name="formR" id="formR" action="register.php">

		<?php include('errors.php'); ?>

		<div class="input-group">
			<label>ID Number:</label>
			<input type="number"  id="idnumber"name="idnumber" pattern="/^-?\d+\.?\d*$/"  minlength="8"   maxlength="8"    onKeyPress="if(this.value.length ==8) return false;" placeholder="e.g 123456789" value="<?php echo $idnumber; ?>">
		</div>
		<div class="input-group">
			<label>Phone Number:</label>
			<input type="number" name="phonenumber" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;" placeholder="e.g 0722******" value="<?php echo $phonenumber; ?>">
		</div>
		<div class="input-group">
			<label>Email:</label>
			<input type="email" name="email" placeholder="e.g abc@mail.com" value="<?php echo $email; ?>">
		</div>

		<div class="input-group">
			<button type="submit" class="btn" onclick="stringlength(document.formR.idnumber,8,8)" name="reg_user">Register</button>
		</div>
		<p>
			Already a member? <a href="login.php">Sign in</a>
		</p>
	</form>
</body>
</html>


<script>
function stringlength(inputtxt, minlength, maxlength)
{ 
var field = inputtxt.value; 
var mnlen = minlength;
var mxlen = maxlength;

if(field.length<mnlen || field.length> mxlen)
{ 
alert("Please enter correct id number....");
document.getElementById("idnumber").focus();
return false;
}

}

</script>