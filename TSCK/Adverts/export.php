<?php
//interns shortlist
session_start();
//include('header.php');

include('../includes/dbConfig.php');
$id_number=$_SESSION['id_number'];
if(isset($_POST['export']))
{

	if(isset($_POST['advert_no']))
	{
		@header("Content-Disposition: attachment; filename=Complied_candidates.csv");
		$advert_no=$_POST['advert_no'];

		$status='Submitted';
		$is_submitted=1;

		/*$status='InComplete';
		$is_submitted=0;*/


		$query=mysqli_query($dbconnection,"SELECT 
	tbl.id_number,
    CONCAT(a.title,' ',a.F_name,' ',a.S_name,' ',a.O_name) AS Name,
    tbl.tscNo,
    a.DOB AS Age,
    a.gender,
	a.KRA_pin,
    u.phone_number,
	u.email,
	CONCAT(a.postal_address,' ',a.postal_code,' ',a.town) as address,
    a.county,
    a.current_employer_name as current_employer_name,
    a.position_held  as position_held,
	tbl.advert_no,
    tbl.status,
    v.duDate,
    aq.university,
	aw.award,
    c.course_desc,
    s.name as specialization,
    aq.date_from,
    aq.date_to,   
   @yearsAftSch as   yearsAftSch,
    tbl.DateTime as submitted_time
	
	
	FROM tblappliedjobs as tbl 
	
	left outer join applicant_details as a on tbl.id_number=a.id_no
	left outer  join users as u on tbl.id_number=u.id_number
	left outer join vacancy as v on tbl.advert_no=v.advert_no
	left outer join employment_detail as ed on tbl.id_number=ed.id_number
	left outer join academic_qualification as aq  on a.id_no=aq.id_number
	left outer join award as aw  on aq.award_id=aw.id
	left outer join courses as c on aq.course_id=c.course_id
	left outer join specialization as s on aq.specialization_id=s.id
	left outer join professional_qualification pq on tbl.id_number=pq.id_number
	left outer join award as paw  on pq.award_id=paw.id
	left outer join specialization as pqs on pq.specialization_id=pqs.id
	
	


	where tbl.is_submitted='".$is_submitted."' AND tbl.status='".$status."' AND tbl.advert_no='".$advert_no."' ")
		or die(mysqli_error($dbconnection));
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
//.....................Calculate age based on the due date..............................................
				$varBirthdate=$row['Age'];
				$DUEDATE=$row['duDate'];
				//	$AGE=$DUEDATE-$varBirthdate;
				$from = new DateTime($varBirthdate);
				$to   = new DateTime($DUEDATE);
				$AGE=$from->diff($to)->y;
//.....................Calculate tarmacing years based on the due date..............................................

				$vardate_to=$row['date_to'];
				$DUEDATE=$row['duDate'];
				//	$AGE=$DUEDATE-$varBirthdate;
				$from = new DateTime($vardate_to);
				$to= new DateTime($DUEDATE);
				$yearsAftSch=$from->diff($to)->y;


//........................................................................................................
				$data.=$row['id_number'].",";
				$data.=$row['Name'].",";
				$data.=$row['tscNo'].",";
				$data.=$AGE.",";
				$data.=$row['gender'].",";
				$data.=$row['KRA_pin'].",";
				$data.=$row['phone_number'].",";
				$data.=$row['email'].",";
				$data.=$row['address'].",";
				$data.=$row['county'].",";
				$data.=$row['current_employer_name'].",";
				$data.=$row['position_held'].",";
				$data.=$row['advert_no'].",";
				$data.=$row['status'].",";
				$data.=$row['duDate'].",";
				$data.=$row['university'].",";
				$data.=$row['award'].",";
				$data.=$row['course_desc'].",";
				$data.=$row['specialization'].",";
				$data.=$row['date_from'].",";
				$data.=$row['date_to'].",";
				$data.=$yearsAftSch.",";
				$data.=$row['submitted_time']."\n";

			}

			echo " $data";
			//echo $header."\n".$data;
			exit();

		}

	}
}

?>














