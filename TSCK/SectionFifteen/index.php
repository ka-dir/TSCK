<?php
include('header.php');
$id_number=$_SESSION['id_number'];

	


?>

    <!DOCTYPE html>
    <html lang="en">
    	<head>
    		<meta charset="UTF-8" name="viewport" content="width=device-width"/>
    		<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
    	</head>
    <body>
    	<nav class="navbar navbar-default">
    		<div class="container-fluid">
			<h3>Applied Jobs </h3>
   	</div>
    	</nav>
    	<div class="col-md-2"></div>
    	<div class="col-md-8 well">
    		<h4 class="text-primary">Search by id number</h4>
    		<hr style="border-top:1px dotted #ccc;"/>
    		<div class="col-md-1"></div>
    		<div class="col-md-11">
    			
    			<br />
    			<br />
    			<form class="form-inline" method="POST" action="">
    				<div class="input-group col-md-12">
    					<input type="text" class="form-control" placeholder="Search id number here..." name="keyword" required="required"/>
    					<span class="input-group-btn">
    						<button class="btn btn-primary" name="search"><span class="glyphicon glyphicon-search"></span></button>
    					</span>
    				</div>
    			</form>
    			<br />
    			<?php
			
				
				 if(ISSET($_POST['search']))
					{
					$stringRemovedLashes= stripslashes($_POST['keyword']);//The stripslashes() function is a built-in function in PHP. This function removes backslashes in a string.
					$keyword =$dbconnection ->real_escape_string(trim($stringRemovedLashes));
				
						
    			?>
    			<div>
    				<h4><?php 
					//.......................................query to pick name from application table......................
		$ApplicantDetails=mysqli_query($dbconnection,"SELECT S_name,F_name,O_name,title FROM applicant_details where id_no='".$keyword."'")or die(mysqli_error($dbconnection));
		$Applicantrow=mysqli_fetch_array($ApplicantDetails);
					echo "Result for ". $Applicantrow['title']." ".$Applicantrow['S_name']." ".$Applicantrow['F_name']." ".$Applicantrow['O_name']; ?></h4>
    				<hr style="border-top:2px dotted #ccc;"/>
    		<form action="" method="post">
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" >
		<thead style="background-color: #314C95;color:#FFFFFF;">
			<tr>
				<th style="text-align:center; font-size:12px;">ID No</th>
				<th style="text-align:center; font-size:12px;">Advert No</th>
				<th style="text-align:left; font-size:12px;">Post</th>
				<th style="text-align:center; font-size:12px;">Status</th>
				<th style="text-align:center; font-size:12px;">date</th>
				<th style="text-align:center; font-size:12px;">Action</th>
				<!--th style="text-align:center; font-size:12px;">Print</th>-->
			</tr>
		</thead>
		<tbody >
		<?php
			
		$query=mysqli_query($dbconnection,"SELECT * FROM tblappliedjobs where id_number='".$keyword."' order by DateTime desc")or die(mysqli_error());
				
		while($row=mysqli_fetch_array($query))
		{
		$id_number=$row['id_number'];
		$vacancy_id=$row['vacancy_id'];
		$advert_no=$row['advert_no'];
		$post_vacancy=$row['post_vacancy'];
		$directorate=$row['directorate'];
		$status=$row['status'];
		$DateTime=$row['DateTime'];
		$date=date('d-m-Y',strtotime($DateTime));
		$encode_advertno=base64_encode(urlencode($advert_no));
		$encode_idno=base64_encode(urlencode($id_number));
		
	
		
	
		?>
			<tr>
				<td style="text-align:center; font-size:12px;"><?php echo $row['id_number']; ?></td>
				<td style="text-align:center; font-size:12px;"><?php echo $row['advert_no']; ?></td>
				<td style="text-align:left; font-size:12px;"><?php echo $row['post_vacancy']; ?></td>
				<td style="text-align:center; font-size:12px;"><?php echo $row['status']; ?></td>
				<td style="text-align:center; font-size:12px;"><?php echo $date; ?></td>
				<!--td><a href="secSixteen.php?id_number=<!?php echo $encode_idno;?> & advert_no=<!?php echo$encode_advertno;?>">Profile</a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>-->
				<td><a target="_blank" href="secSeventeen.php?id_number=<?php echo $encode_idno;?> & advert_no=<?php echo$encode_advertno;?>">Print</a></td>


			</tr>
		<?php
		} ?>
		</tbody>
		 <tfoot>

		 </tfoot>
	</table>
	<br />
	
</form>
    		</div>
    	</div>
     </body>




    </html>
	<?php
					}
	?>
	
	
	
	






