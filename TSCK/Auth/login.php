<?php 
//include('incUseChrome.php');
include('server.php') 

 




?>
<!DOCTYPE html>
<html>
<head>
	<title>TSC</title>
	<link rel="stylesheet" type="text/css" href="../css/style1.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>

<body>

	<div class="header">
	<img  src="../images/tsclogowhite.png" style="width: 100px; height: 100px; "/>
		<p class="" href="#"><h4>Teachers Service Commission<h4/> <br>
		<h5> Secretariat Recruitment Portal</h5></p>

	</div>
	
	<form method="post" action="login.php">

		<?php include('errors.php'); ?>

		<div class="input-group">
			<label>ID Number:</label>
			<input type="number"  name="idnumber"  pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==8) return false;" >
		</div>
		<div class="input-group">
			<label>Password:</label>
			<input type="password" name="password">
		</div>
<div class="input-group">
			<button type="submit" class="btn" name="login_user">Login</button>
			<a href="register.php" class="btn btn-primary" role="button" style="margin-left: 67%;text-decoration: none;">Register</a>
	
		</div>


			<div>
				<p>
			 <a href="resetpasswordg.php" style="color:#05A1F9; text-decoration: none;font-size: 14px"><b>Forgot Password ?</b></a>
				</p>
		</div>
	
	</form>

</body>
</html>