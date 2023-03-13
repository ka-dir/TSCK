<?php
include('header.php');
$id_number=$_SESSION['id_number'];

?>
<head>
<script>
function myFunction() {
  // Declare variables 
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("example");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }
}
</script>
</head>

<body style="margin-top: -30px;">
<h3>Administrator:My Applied Jobs </h3>
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search ID NO...." style="width:250px;background-color:white;margin-left:790px;" >
<div class="container" style="width:100%; margin-left:-5px;">
		
<form action="" method="post">
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" >
		<thead style="background-color: #314C95;color:#FFFFFF;">
			<tr>
				<th style="text-align:center; font-size:12px;">ID No</th>
				<th style="text-align:center; font-size:12px;">Advert No</th>
				<th style="text-align:left; font-size:12px;">Post</th>
				<th style="text-align:center; font-size:12px;">Date</th>
				<th style="text-align:center; font-size:12px;">Status</th>
			</tr>
		</thead>
		<tbody >
		<?php
		
		$query=mysqli_query($dbconnection, "select * from tblappliedjobs")or die(mysqli_error());
		while($row=mysqli_fetch_array($query)){
		$vacancy_id=$row['id_number'];
		$vacancy_id=$row['vacancy_id'];
		$advert_number=$row['advert_no'];
		$post_vacancy=$row['post_vacancy'];
		$directorate=$row['directorate'];
		$status=$row['status'];
		$DateTime=$row['DateTime'];
		$date=date('d-m-Y',strtotime($DateTime));
		?>
			<tr>
				<td style="text-align:center; font-size:12px;"><?php echo $row['id_number']; ?></td>
				<td style="text-align:center; font-size:12px;"><?php echo $row['advert_no']; ?></td>
				<td style="text-align:left; font-size:12px;"><?php echo $row['post_vacancy']; ?></td>
				<td style="text-align:center; font-size:12px;"><?php echo $date; ?></td>
				<td style="text-align:center; font-size:12px;"><?php echo $row['status']; ?></td>
				
			</tr>
		<?php  
		} ?>
		</tbody>
	</table>
	<br />
	
</form>

<br>

<div id="heading2"> KEY: </div>
<div id="notes2"> 
1. InComplete - means your application for the selected vacancy has not been submitted.<br/>
2. InProgress - means your application for the selectes vacancy was successfully submitted.<br/>
3. Shortlisted - means you have been shortlisted for the selected vacancy. <br/>
 
 
</div>
</body>
</html>
