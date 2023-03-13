<?php
session_start();
//include('header.php');
include('../includes/dbConfig.php');
$id_number=$_SESSION['id_number'];
if(isset($_POST['export']))
{

if(isset($_POST['advert_no']))
	{

@header("Content-Disposition: attachment; filename=shortlisted_candidates.csv");
	$advert_no=$_POST['advert_no'];
	$status='Shortlisted';
	$is_submitted=2;
	
	$query=mysqli_query($dbconnection,"SELECT
	tbl.id_number,tbl.tscNo,tbl.advert_no,tbl.post_vacancy,tbl.status,tbl.DateTime,
	CONCAT(a.title,' ',a.F_name,' ',a.S_name,' ',a.O_name) AS NAMES,a.DOB,a.id_no,a.KRA_pin,a.gender,a.county,a.sub_county,CONCAT(a.postal_address,' ',a.postal_code,' ',a.town) as address,u.phone_number
	
	FROM tblappliedjobs as tbl 
	join applicant_details as a on tbl.id_number=a.id_no
	join users as u on tbl.id_number=u.id_number
	where tbl.advert_no='".$advert_no."' and tbl.is_submitted='".$is_submitted."' and tbl.status='".$status."'")
	or die(mysqli_error());
	if($query)
	{
 $sep = "\t"; //tabbed character

 if($query)
 {
   while($finfo = $query->fetch_field())
   {
     printf($finfo->name.",");
   }
 }

 print("\n");   
	
	
	
	while($row=mysqli_fetch_assoc($query))
		{
			$data.=$row['id_number'].",";
			$data.=$row['tscNo'].",";
			$data.=$row['advert_no'].",";
			$data.=$row['post_vacancy'].",";
			$data.=$row['status'].",";
			$data.=$row['DateTime'].",";
			$data.=$row['NAMES'].",";
			$data.=$row['DOB'].",";
			$data.=$row['id_no'].",";
			$data.=$row['KRA_pin'].",";
			$data.=$row['gender'].",";
			$data.=$row['county'].",";
			$data.=$row['sub_county'].",";
			$data.=$row['address'].",";
			$data.=$row['phone_number']."\n";
		}
		
		echo " $data";
		//echo $header."\n".$data;
		exit();	
	
	}
		
	}
}

?>	
	