<?php
include('header.php');
$id_number=$_SESSION['id_number'];


?>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>




<script>
function myFunction() 
{
  // Declare variables 
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("example");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) 
  {
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
<body style="margin-top:-40px;">
<h4><b>Manage users</b></h4>
<div class="container" style="width:auto; margin-left:-5px;">
<?php
//pagination 
if (isset($_GET['pageno']))
{
    $pageno = $_GET['pageno'];
} 
else 
{
    $pageno = 1;
}


$no_of_records_per_page = 10;
$offset = ($pageno-1) * $no_of_records_per_page; 

//$result=mysqli_query($dbconnection, "SELECT COUNT(*) FROM applicant_details")or die(mysqli_error());
$result=mysqli_query($dbconnection, "SELECT COUNT(*) FROM users")or die(mysqli_error());
$total_rows = mysqli_fetch_array($result)[0];

$total_pages = ceil($total_rows / $no_of_records_per_page);

?>
 <ul class="pagination">
        <li><a href="?pageno=1">First</a></li>
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
        </li>
        <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
</ul>



<div class="navbar-default sidebar" role="navigation">
<div class="sidebar-nav navbar-collapse">
<ul class="nav" id="side-menu">
<li class="sidebar-search">
<div class="input-group custom-search-form">
	<form class="form-inline" method="POST" action="">
    				<div class="input-group col-md-12">
    					<input type="text" class="form-control" placeholder="Search ID NO..." name="keyword" required="required">
    					<span class="input-group-btn">
    						<button class="btn btn-primary" name="search">
							<span class="glyphicon glyphicon-search"></span>
							</button>
    					</span>
    				</div>
    </form>
</div>
</li>
</ul>
</div>
</div>

	
<?php echo "Total Applicants:".$total_rows; ?>



<div id="user_table">
<table id="employee_grid" class="table table-condensed table-hover table-striped" width="90%" cellspacing="0" data-toggle="bootgrid">
	<thead style="background-color:#314C95;color:#FFFFFF;">
			<tr>
				<th style="text-align:center; font-size:12px;">ID No</th>
				<th style="text-align:center; font-size:12px;">Email</th>
				<th style="text-align:center; font-size:12px;">Mobile Number</th>
				<!--th style="text-align:center; font-size:12px;">Role granted</th>
				<th style="text-align:center; font-size:12px;">Created at</th>-->
				<th style="text-align:center; font-size:12px;">Action</th>
			</tr>
	</thead>
		<tbody>
		<?php
		if(ISSET($_POST['search']))
		{
					$stringRemovedLashes= stripslashes($_POST['keyword']);//The stripslashes() function is a built-in function in PHP. This function removes backslashes in a string.
					$keyword =$dbconnection ->real_escape_string(trim($stringRemovedLashes));
					
	$query=mysqli_query($dbconnection,
	"select 
	
	u.phone_number,u.is_admin,u.id_number,u.email,u.DateTime
	from users as u
	
	WHERE u.id_number='$keyword'")or die(mysqli_error());
	
	
	
	
	
	
	
	
	while($row=mysqli_fetch_array($query))
		{
		$id_no=$row['id_number'];
		$email=$row['email'];
		$phone_number=$row['phone_number'];
		$permission=$row['is_admin'];
		$DateTime=$row['DateTime'];
		$date=date('d-m-Y',strtotime($DateTime));
		$encode_idno=base64_encode(urlencode($id_no));
//..................permission...........		
		if($permission==1)
		{
		$permission_granted='Admin';	
		}
		else
		{
		$permission_granted='User';
		}
		
		
		?>
		<form action="" method="post" name="userView" id="userView" >
<tr>
				<td style="text-align:center; font-size:12px;"><?php echo $id_no; ?></td>
				<td style="text-align:center; font-size:12px;"><?php echo $email; ?></td>
				<td style="text-align:left; font-size:12px;"><?php echo $phone_number; ?></td>
				<!--td style="text-align:left; font-size:12px;"><?php //echo $permission_granted; ?></td>
				<td style="text-align:left; font-size:12px;"><?php //echo $date; ?></td>-->
		

<td><button data-id="<?php echo $id_no; ?>" class='btn btn-info btn-xs userinfo'><span class="glyphicon glyphicon-user"></span> View</button></td>	


</tr>
</form>

<?php

		}		

		}
		else
		{

	
	$query=mysqli_query($dbconnection,
	"select 
	u.phone_number,u.is_admin,u.id_number,u.email,u.DateTime
	from users as u
	ORDER BY DateTime desc LIMIT $offset, $no_of_records_per_page
	")
	or die(mysqli_error());
	
	while($row=mysqli_fetch_array($query))
		{
		$id_no=$row['id_number'];
		$email=$row['email'];
		$phone_number=$row['phone_number'];
		$permission=$row['is_admin'];
		$DateTime=$row['DateTime'];
		$date=date('d-m-Y',strtotime($DateTime));
		$encode_idno=base64_encode(urlencode($id_no));
//..................permission...........		
		if($permission==1)
		{
		$permission_granted='Admin';	
		}
		else
		{
		$permission_granted='User';
		}
		
		
		?>
		<form action="" method="post" name="userView" id="userView" >
<tr>
				<td style="text-align:center; font-size:12px;"><?php echo $id_no; ?></td>
				<td style="text-align:center; font-size:12px;"><?php echo $email; ?></td>
				<td style="text-align:left; font-size:12px;"><?php echo $phone_number; ?></td>
				<!--td style="text-align:left; font-size:12px;"><?php //echo $permission_granted; ?></td>
				<td style="text-align:left; font-size:12px;"><?php //echo $date; ?></td>-->
		

<td><button data-id="<?php echo $id_no; ?>" class='btn btn-info btn-xs userinfo'><span class="glyphicon glyphicon-user"></span> View</button></td>	


</tr>
</form>

<?php

		}}?>		
</tbody>


</table>

</div>

<br>

<!--model start edit-->


<div class="modal fade" id="empModal" role="dialog">
	
		<div class="modal-dialog">
			<div class="modal-content">
	
     <!-- Modal content-->
  
	
	
	<!-- Modal header-->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">User Details</h4>
      </div>
	  <!-- Modal body-->
      <div class="modal-body">
	
 
     <form method="post" id="insert_form" >  
                          <label>Id number</label>  
                          <input type="text" name="id_no" id="id_no" class="form-control" readonly />  
                          <br/>  
                          <label>Email Address</label>  
                          <input type="text" name="email" id="email" class="form-control" readonly />  
                          <br/>  
                          <label>Mobile Number</label>  
                          <input type="text" name="mobile_no" id="mobile_no" class="form-control"  />   
                          <br/>  
                          <label>Role granted</label>  
                          <input type="text" name="role_granted" id="role_granted" class="form-control" />  
                          <br/>  
						  <label>Created at</label> 
						  <input type="text" name="created_at" id="created_at" class="form-control" readonly />  
                          <br/>
                        <input type="hidden" name="id_number" id="id_number" />  
                          <input type="submit" name="insert" id="insert" value="update" class="btn btn-success" />   
						  	
						  
    </form> 
 
 
 
 
 
 
 
 
 
 
 
 
 


</div>
  <span id="span1"></span>
	  <!-- Modal footer-->
	   <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>


			</div>
		</div>
</div>









</div>



</body>

<!--Jquery -->




</html>
<script src="https://services.tsc.go.ke/TSCK/users/js/sweetalert.min.js"></script>

    <script type='text/javascript'>
	
	
	
	
	
	
$(document).ready(function(){ 
    
            $(document).ready(function(){

                $('.userinfo').click(function(){
                   
                    var userid = $(this).data('id');
					//alert(userid);

                    // AJAX request
                    $.ajax({
                        url: "https://services.tsc.go.ke/TSCK/users/editUserprocess.php",
                        type: "POST",
                        data: {id_number:userid},
						dataType:"json", 
					    success:function(data){ 
					$('#id_no').val(data.id_number);  
                     $('#email').val(data.email);  
                     $('#mobile_no').val(data.phone_number);  
                     $('#role_granted').val(data.is_admin);  
                     $('#created_at').val(data.DateTime);  
                    $('#id_number').val(data.id_number);  
                    $('#empModal').val("Update"); 
			             // Add response in Modal body
                          //  $('.modal-body').html(response); 

                            // Display Modal
                            $('#empModal').modal('show'); 
							//alert(success);
                        },
					 error: function(data)
	 {
			 swal("Sorry!","try again later","warning");
		 }   
                    })
					// stop the form from submitting the normal way and refreshing the page
        event.preventDefault();
                });
            });
			
		$('#insert_form').on("submit", function(event){  
           event.preventDefault();  
        
                $.ajax({  
                     url:"https://services.tsc.go.ke/TSCK/users/Edituser.php",  
                     method:"POST",  
                    data:$('#insert_form').serialize(), 
					//data: {id_number:userid},
										
                     beforeSend:function(){  
                          $('#insert').val("Updating");  
                     },  
                     success:function(data){  
				
                       //$('#insert_form')[0].reset();  
						$('#empModal').modal('hide');  
                      // $('#employee_grid').html(data); 
						swal("Good!","succesfully updated!","success");				   
					   
					  
                     },

				 error: function(data)
	 {
			 swal("Sorry!","try again later","warning");	
		
		 }
					 
                });  
            
      });  
	}); 
	    
    </script>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	


