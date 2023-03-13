<?php
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


        $query=mysqli_query($dbconnection,"SELECT DISTINCT 
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
	tbl.advert_no,
    tbl.post_vacancy,
    tbl.status,
    v.duDate,
    aq.university,
	aw.award,
    c.course_desc,
    s.name as specialization,
    aq.date_from,
    aq.date_to,

  
    st.id_number as stID_NO, 
    tbl.id_number as tblID_NO, 
    st.Job_Desig as job_designation,            
    st.Date_Hired as first_appointment,
    st.Date_of_Post as current_appointment,
    @YearsAfterFirstAppointment as YearsAfterFirstAppointment,
    @YearsAfterCurrentPost as YearsAfterCurrentPost,       
	
    tbl.DateTime as submitted_time
	
	
	FROM tblappliedjobs as tbl 
	JOIN staffreg as st ON tbl.id_number=st.id_number
	join applicant_details as a on tbl.id_number=a.id_no
	join users as u on tbl.id_number=u.id_number
	join vacancy as v on tbl.advert_no=v.advert_no
	join employment_detail as ed on tbl.id_number=ed.id_number
	join academic_qualification as aq  on a.id_no=aq.id_number
	join award as aw  on aq.award_id=aw.id
	join courses as c on aq.course_id=c.course_id
	join specialization as s on aq.specialization_id=s.id
	


	where tbl.is_submitted='".$is_submitted."' AND tbl.status='".$status."' AND tbl.advert_no='".$advert_no."' ")
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

//.....................Calculate years  after first appointment based on the due date..............................................

                $vardate_to=$row['first_appointment'];
                $DUEDATE=$row['duDate'];
                //	$AGE=$DUEDATE-$varBirthdate;
                $from = new DateTime($vardate_to);
                $to= new DateTime($DUEDATE);
                $yearsAftFirstAppointment=$from->diff($to)->y;
//.....................Calculate years  after current appointment based on the due date..............................................

                $vardate_to=$row['current_appointment'];
                $DUEDATE=$row['duDate'];
                //	$AGE=$DUEDATE-$varBirthdate;
                $from = new DateTime($vardate_to);
                $to= new DateTime($DUEDATE);
                $yearsAftCurrentAppointment=$from->diff($to)->y;
//......................Calculate the Total Years of Work Experience......................................
                $TotalYearsWorked= 0;
                $sql2="SELECT date_from,date_to FROM employment_detail WHERE id_number='".$row['id_number']."'ORDER BY date_to DESC";
                $results2=$conn->query($sql2);
                while($eaq=mysqli_fetch_array($results2))
                {
                    $varDateFrom=$eaq['date_from'];
                    $varDateTo=$eaq['date_to'];
                    $diff = abs(strtotime($varDateTo) - strtotime($varDateFrom));

                    $TotalYearsWorked+=$diff;
                }
                $years =$TotalYearsWorked / (365*60*60*24);
                $months = floor(($TotalYearsWorked - $years * 365*60*60*24) / (30*60*60*24));
                $days = floor(($TotalYearsWorked - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
//printf("%d years, %d months, %d days\n", $years, $months, $days);
                $year=$years;
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
                //$data.=$row['sub_county'].",";

                $data.=$row['advert_no'].",";
                $data.=$row['post_vacancy'].",";
                $data.=$row['status'].",";
                $data.=$row['duDate'].",";

                $data.=$row['university'].",";
                $data.=$row['award'].",";
                $data.=$row['course_desc'].",";
                $data.=$row['specialization'].",";
                $data.=$row['date_from'].",";
                $data.=$row['date_to'].",";

                /*$data.=$row['pq_institution'].",";
                $data.=$row['pq_award'].",";
                $data.=$row['pq_specialization'].",";

                $data.=$year.",";*/
                $data.=$row['stID_NO'].",";
                $data.=$row['tblID_NO'].",";
                $data.=$row['job_designation'].",";

                $data.=$row['first_appointment'].",";
                $data.=$row['current_appointment'].",";

                $data.=$yearsAftFirstAppointment.",";
                $data.=$yearsAftCurrentAppointment.",";
                //$data.=$yearsAftSch.",";
                $data.=$row['submitted_time']."\n";

            }

            echo " $data";
            //echo $header."\n".$data;
            exit();

        }

    }
}

?>














