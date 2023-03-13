<?php
include('header.php');
error_reporting (E_ALL ^ E_NOTICE);
ini_set('display_errors','1');

//Insert New Record
   if(isset($_POST['btnIinsertNew']))
   {
	$firstname=$_POST['firstname'];
	$lastname=$_POST['lastname'];
	$middlename=$_POST['middlename'];
	$email=$_POST['email'];
	$address=$_POST['address'];

	$sql = "INSERT INTO member (firstname, lastname, middlename, address, email)
	 VALUES ('$firstname','$lastname','$middlename','$address','$email')";
	$conn->query($sql);
	header("location: secB.php");
	
   }
   
   // user is editing stuff:
   elseif(isset($_POST['btnEdit']))
   {
   	include('edit.php');
	//die();
	
   }
   
//Edit Save
   
elseif(isset($_POST['btnEditSave']))
{
$member_id=$_POST['member_id'];
$firstname=$_POST['firstname'];
$lastname=$_POST['lastname'];
$middlename=$_POST['middlename'];
$email=$_POST['email'];
$address=$_POST['address'];

$N = count($member_id);
for($i=0; $i < $N; $i++)
{
	$result = mysqli_query($dbconnection, "UPDATE member SET firstname='$firstname[$i]', lastname='$lastname[$i]', middlename='$middlename[$i]' ,address='$address[$i]' , email='$email[$i]'  where member_id='$member_id[$i]'")or die(mysql_error());
}
header("location: secB.php");
}
   
    
   // user is deleting stuff:
   elseif(isset($_POST['delete']))
   {
   	// 1: do some error checking here
   	// 2: throw an error or do DB DELETE here
   	// 3: set variable that displays "add" button:
   	$display_button_valu = "add";
   	$display_button_name = "add";
   	// 4: set a confirmation message:
   	$msg = "Your stuff has been DELETED";
   }
   // user is doing nothing, it's his/her first time (ooer)
   else
   {

?>
<head>
</head>

<body>
<div class="container" style="width:94%; margin-left:-5px;">
<form action="" method="post">
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" >
		<thead>
			<tr>
				<th style="text-align:center; font-family:cursive; font-size:12px; color:blue;">FirstName</th>
				<th style="text-align:center; font-family:cursive; font-size:18px; color:blue;">LastName</th>
				<th style="text-align:center; font-family:cursive; font-size:18px; color:blue;">MiddleName</th>
				<th style="text-align:center; font-family:cursive; font-size:18px; color:blue;">Address</th>
				<th style="text-align:center; font-family:cursive; font-size:18px; color:blue;">Email</th>
				<th style="text-align:center; font-family:cursive; font-size:18px; color:blue;">Action</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$query=mysqli_query($dbconnection, "select * from member ORDER BY member_id DESC")or die(mysqli_error());
		while($row=mysqli_fetch_array($query)){
		$id=$row['member_id'];
		?>
			<tr>
				<td style="text-align:center; font-family:cursive; font-size:12px;"><?php echo $row['firstname'] ?></td>
				<td style="text-align:center; font-family:cursive; font-size:18px;"><?php echo $row['lastname'] ?></td>
				<td style="text-align:center; font-family:cursive; font-size:18px;"><?php echo $row['middlename'] ?></td>
				<td style="text-align:center; font-family:cursive; font-size:18px;"><?php echo $row['address'] ?></td>
				<td style="text-align:center; font-family:cursive; font-size:18px;"><?php echo $row['email'] ?></td>
				<td style="text-align:center; font-family:cursive; font-size:18px;">
					<input name="selector[]" type="checkbox" value="<?php echo $id; ?>">
				</td>
			</tr>
		<?php  } ?>
		</tbody>
	</table>
	<br />
	<button name="btnEdit" class="btn btn-success pull-right" style="font-family:cursive;" name="submit_mult" type="submit">
		Update Data
	</button>
</form>


<br>
<br>



<form class="form-horizontal" action="" method="post" >

	<div class="thumbnail" style="margin:auto; width:600px;" >
	<div style="margin-left: 70px; margin-top: 20px;">
		
		<div class="control-group">
		<label class="control-label" for="inputEmail" style="font-family:cursive; font-weight:bold; font-size:12px; color:blue;">Firstname</label>
		<div class="controls">
			<input name="firstname" type="text" style="font-family:cursive; font-weight:bold;" value="<?php echo $row['firstname'] ?>" />
		</div>
		</div>

		<div class="control-group">
		<label class="control-label" for="inputEmail" style="font-family:cursive; font-weight:bold; font-size:18px; color:blue;">Lastname</label>
		<div class="controls">
			<input name="lastname" type="text" style="font-family:cursive; font-weight:bold;" value="<?php echo $row['lastname'] ?>" />
		</div>
		</div>

		<div class="control-group">
		<label class="control-label" for="inputEmail" style="font-family:cursive; font-weight:bold; font-size:18px; color:blue;">Middlename</label>
		<div class="controls">
			<input name="middlename" type="text" style="font-family:cursive; font-weight:bold;" value="<?php echo $row['middlename'] ?>" />
		</div>
		</div>

		<div class="control-group">
		<label class="control-label" for="inputEmail" style="font-family:cursive; font-weight:bold; font-size:18px; color:blue;">Address</label>
		<div class="controls">
			<input name="address" type="text" style="font-family:cursive; font-weight:bold;" value="<?php echo $row['address'] ?>" />
		</div>
		</div>

		<div class="control-group">
		<label class="control-label" for="inputEmail" style="font-family:cursive; font-weight:bold; font-size:18px; color:blue;">Email Address</label>
		<div class="controls">
			<input name="email" type="text" style="font-family:cursive; font-weight:bold;" value="<?php echo $row['email'] ?>" />
		</div>
		</div>
	</div>
	</div>

	<br />

<input name="btnIinsertNew" class="btn btn-success" style="margin-left: 165px; font-family:cursive;" type="submit" value="Submit">
</form>
</div>

</body>
</html>
<?php
   }?>