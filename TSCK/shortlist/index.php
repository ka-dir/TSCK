<?php

//academic_qualification
$queryA=mysqli_query($dbconnection,"SELECT * FROM advert_criteria a 
WHERE a.vacancy_id ='".$_SESSION['vacancy_id']."' and a.criteria_type_id=1")or die(mysqli_error($dbconnection));
while($ACrowA=mysqli_fetch_array($queryA))
{
		$ACidA = $ACrowA['id'];
		$ACvacancy_idA=$ACrowA['vacancy_id'];
		$ACcriteria_type_idA=$ACrowA['criteria_type_id'];
		$ACaward_idA=$ACrowA['award_id'];
		$ACcourse_idA=$ACrowA['course_id'];
		//$ACspecialization_idA=$ACrowA['specialization_id'];
}

/*$queryP=mysqli_query($dbconnection,"SELECT * FROM advert_criteria a 
WHERE a.vacancy_id ='".$_SESSION['vacancy_id']."' and a.criteria_type_id=2")or die(mysqli_error($dbconnection));
while($ACrowP=mysqli_fetch_array($queryP))
{
		$ACidP = $ACrowP['id'];
		$ACvacancy_idP=$ACrowP['vacancy_id'];
		$ACcriteria_type_idP=$ACrowP['criteria_type_id'];
		$ACaward_idP=$ACrowP['award_id'];
		$ACspecialization_idP=$ACrowP['specialization_id'];
}*/

$query2=mysqli_query($dbconnection,"SELECT
tbj.vacancy_id,
a.title,a.F_name,a.S_name,a.O_name,a.DOB,
a.id_no,a.tscNo,a.KRA_pin,a.gender,a.county,a.sub_county,
aq.university,aq.award_id,aq.course_id,aq.specialization_id,aq.cert_no,aq.cert_year,
pq.institution,pq.award_id,pq.specialization_id,pq.cert_no,pq.cert_year
FROM 
applicant_details a
JOIN tblappliedjobs tbj on a.id_no=tbj.id_number
JOIN academic_qualification aq ON a.id_no=aq.id_number
JOIN professional_qualification pq ON a.id_no=pq.id_number

WHERE

tbj.vacancy_id IN (SELECT vacancy_id  FROM advert_criteria ac
                   WHERE ac.vacancy_id='".$_SESSION['vacancy_id']."'
                  )
and 
aq.award_id in (select award_id from advert_criteria ac where ac.award_id='".$ACaward_idA."')
and 
aq.course_id in (select course_id from advert_criteria ac where ac.course_id='".$ACcourse_idA."')

and 
aq.specialization_id in (select specialization_id from advert_criteria ac where ac.specialization_id='".$ACspecialization_idA."')

and			  
pq.award_id in (select award_id from advert_criteria ac where ac.award_id='".$ACaward_idP."')
and
pq.specialization_id in(select specialization_id from advert_criteria ac WHERE ac.specialization_id='".$ACspecialization_idP."')
and

tbj.is_submitted=1
and 
a.id_no='".$varIdNumber."'



ORDER BY a.F_name ASC
")or die(mysqli_error($dbconnection));

$num=mysqli_num_rows($query2);

if($num>=1)
{
//$status="Shortlisted";	
//echo "shortlisted";
$status="Completed";

$queryUpdate=mysqli_query($dbconnection,"UPDATE tblappliedjobs SET status='".$status."',is_submitted='2' WHERE id_number='".$varIdNumber."' AND vacancy_id='".$_SESSION['vacancy_id']."'")or die(mysqli_error($dbconnection));



?>
			<script>
		
		window.alert("your application has been successfully submitted.Thank you.");
    	window.location.href='secOne.php';
		//alert("your application has been successfully submitted.Thank you.");
		
		</script>
		<?php





}


?>