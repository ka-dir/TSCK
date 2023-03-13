<?php
$is_admin = $_SESSION['user_type'];
/*if($is_admin != 1)
{
    header('location: ../secA.php');
}*/
session_start();
//include('header.php');
include('../includes/dbConfig.php');
$id_number=$_SESSION['id_number'];

?>

<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <?php
    if(isset($_POST['dashboard']))
    {
        if(isset($_POST['advert_no']))
        {
            $sql=mysqli_query($dbconnection,"SELECT advert_no,post_vacancy FROM tblappliedjobs WHERE advert_no='".$_POST['advert_no']."'")or die(mysqli_error());
            $result=mysqli_fetch_array($sql);
            $advertName=$result['post_vacancy'];

            // advert number
            $advert_no=$_POST['advert_no'];
            //shortlisted
            //$statusShortlist='Completed';
            //$is_submittedShortlist=2;
            //submitted
            $statusSubmitted='Submitted';
            $is_submittedSubmit=1;
            //incomplete
            $statusInComplete='InComplete';
            $is_submittedInComplete=0;
            //Gender
            $male = 'M';
            $female = 'F';
			
			
           /* $sqlShortlisted=mysqli_query($dbconnection,"SELECT * FROM tblappliedjobs WHERE advert_no='".$advert_no."'
            and is_submitted='".$is_submittedShortlist."' and status='".$statusShortlist."'")or die(mysqli_error());
            $countShortlist=mysqli_num_rows($sqlShortlisted);

            $sqlSubmitted=mysqli_query($dbconnection,"SELECT  * FROM tblappliedjobs WHERE advert_no='".$advert_no."'
            and is_submitted='".$is_submittedSubmit."' and status='".$statusSubmitted."'")or die(mysqli_error());
            $countSubmitted=mysqli_num_rows($sqlSubmitted);

            $sqlIncomplete=mysqli_query($dbconnection,"SELECT * FROM tblappliedjobs WHERE advert_no='".$advert_no."'
            and is_submitted='".$is_submittedInComplete."' and status='".$statusInComplete."'")or die(mysqli_error());
            $countIncomplete=mysqli_num_rows($sqlIncomplete);


           $sqlMale=mysqli_query($dbconnection,"SELECT * FROM applicant_details WHERE gender ='".$male."' AND id_no IN (SELECT id_number FROM tblappliedjobs WHERE advert_no='".$advert_no."')")or die(mysqli_error());
            $countMale=mysqli_num_rows($sqlMale);

            $sqlFemale=mysqli_query($dbconnection,"SELECT * FROM applicant_details WHERE gender ='".$female."' AND id_no IN (SELECT id_number FROM tblappliedjobs WHERE advert_no='".$advert_no."')")or die(mysqli_error());
            $countFemale=mysqli_num_rows($sqlFemale);*/



	
	
	$sqlSubmitted=mysqli_query($dbconnection,"SELECT DISTINCT 
	tbl.id_number,CONCAT(a.title,' ',a.F_name,' ',a.S_name,' ',a.O_name) AS Name,tbl.tscNo,a.DOB AS Age,a.gender,a.KRA_pin,u.phone_number,
	CONCAT(a.postal_address,' ',a.postal_code,' ',a.town) as address,a.county,
	tbl.advert_no,tbl.post_vacancy,tbl.status,v.duDate,@WorkExperience as WorkExperience,aq.university,
	aw.award,c.course_desc,s.name as specialization,aq.date_from,aq.date_to,
	@YearsAfterGraduation as YearsAfterGraduation,tbl.DateTime as submitted_time
	
	
	FROM tblappliedjobs as tbl 
	join applicant_details as a on tbl.id_number=a.id_no
	join users as u on tbl.id_number=u.id_number
	join vacancy as v on tbl.advert_no=v.advert_no
	join employment_detail as ed on tbl.id_number=ed.id_number
	join academic_qualification as aq  on a.id_no=aq.id_number
	join award as aw  on aq.award_id=aw.id
	join courses as c on aq.course_id=c.course_id
	join specialization as s on aq.specialization_id=s.id
	where tbl.is_submitted='".$is_submittedSubmit."' AND tbl.status='".$statusSubmitted."' AND tbl.advert_no='".$advert_no."' ")
	or die(mysqli_error());
	
 $countSubmitted=mysqli_num_rows($sqlSubmitted);

$sqlIncomplete=mysqli_query($dbconnection,"SELECT DISTINCT 
	tbl.id_number,CONCAT(a.title,' ',a.F_name,' ',a.S_name,' ',a.O_name) AS Name,tbl.tscNo,a.DOB AS Age,a.gender,a.KRA_pin,u.phone_number,
	CONCAT(a.postal_address,' ',a.postal_code,' ',a.town) as address,a.county,
	tbl.advert_no,tbl.post_vacancy,tbl.status,v.duDate,@WorkExperience as WorkExperience,aq.university,
	aw.award,c.course_desc,s.name as specialization,aq.date_from,aq.date_to,
	@YearsAfterGraduation as YearsAfterGraduation,tbl.DateTime as submitted_time
	
	
	FROM tblappliedjobs as tbl 
	join applicant_details as a on tbl.id_number=a.id_no
	join users as u on tbl.id_number=u.id_number
	join vacancy as v on tbl.advert_no=v.advert_no
	join employment_detail as ed on tbl.id_number=ed.id_number
	join academic_qualification as aq  on a.id_no=aq.id_number
	join award as aw  on aq.award_id=aw.id
	join courses as c on aq.course_id=c.course_id
	join specialization as s on aq.specialization_id=s.id
	where tbl.is_submitted='".$is_submittedInComplete."' AND tbl.status='".$statusInComplete."' AND tbl.advert_no='".$advert_no."' ")
	or die(mysqli_error());
$countIncomplete=mysqli_num_rows($sqlIncomplete);



	$sqlMale=mysqli_query($dbconnection,"SELECT DISTINCT 
	tbl.id_number,CONCAT(a.title,' ',a.F_name,' ',a.S_name,' ',a.O_name) AS Name,tbl.tscNo,a.DOB AS Age,a.gender,a.KRA_pin,u.phone_number,
	CONCAT(a.postal_address,' ',a.postal_code,' ',a.town) as address,a.county,
	tbl.advert_no,tbl.post_vacancy,tbl.status,v.duDate,@WorkExperience as WorkExperience,aq.university,
	aw.award,c.course_desc,s.name as specialization,aq.date_from,aq.date_to,
	@YearsAfterGraduation as YearsAfterGraduation,tbl.DateTime as submitted_time
	
	
	FROM tblappliedjobs as tbl 
	join applicant_details as a on tbl.id_number=a.id_no
	join users as u on tbl.id_number=u.id_number
	join vacancy as v on tbl.advert_no=v.advert_no
	join employment_detail as ed on tbl.id_number=ed.id_number
	join academic_qualification as aq  on a.id_no=aq.id_number
	join award as aw  on aq.award_id=aw.id
	join courses as c on aq.course_id=c.course_id
	join specialization as s on aq.specialization_id=s.id
	where a.gender='$male' AND tbl.advert_no='".$advert_no."' ")
	or die(mysqli_error());
$countMale=mysqli_num_rows($sqlMale);

	$sqlFemale=mysqli_query($dbconnection,"SELECT DISTINCT 
	tbl.id_number,CONCAT(a.title,' ',a.F_name,' ',a.S_name,' ',a.O_name) AS Name,tbl.tscNo,a.DOB AS Age,a.gender,a.KRA_pin,u.phone_number,
	CONCAT(a.postal_address,' ',a.postal_code,' ',a.town) as address,a.county,
	tbl.advert_no,tbl.post_vacancy,tbl.status,v.duDate,@WorkExperience as WorkExperience,aq.university,
	aw.award,c.course_desc,s.name as specialization,aq.date_from,aq.date_to,
	@YearsAfterGraduation as YearsAfterGraduation,tbl.DateTime as submitted_time
	
	
	FROM tblappliedjobs as tbl 
	join applicant_details as a on tbl.id_number=a.id_no
	join users as u on tbl.id_number=u.id_number
	join vacancy as v on tbl.advert_no=v.advert_no
	join employment_detail as ed on tbl.id_number=ed.id_number
	join academic_qualification as aq  on a.id_no=aq.id_number
	join award as aw  on aq.award_id=aw.id
	join courses as c on aq.course_id=c.course_id
	join specialization as s on aq.specialization_id=s.id
	where a.gender='$female' AND tbl.advert_no='".$advert_no."'")
	or die(mysqli_error());
	$countFemale=mysqli_num_rows($sqlFemale);









            $dataPoints = array
            (
              //  array("label"=>"Submitted - Criteria Compliance","y"=>$countShortlist),
                array("label"=>"Submitted ","y"=>$countSubmitted),
                array("label"=>"Incomplete","y"=>$countIncomplete)
            );

           $dataPoints1 = array
            (
            array("label"=>"Male","y"=>$countMale),
            array("label"=>"Female","y"=>$countFemale),
            ) ;



            ?>

            <script>
                window.onload = function() {


                    var chart = new CanvasJS.Chart("chartContainer", {
                        theme: "light2",
                        animationEnabled: true,
                        title: {
                            text: "Advert Status Analysis Dashboard"
                        },
                        data: [{
                            type: "pie",
                            indexLabel: "{y}",
                            yValueFormatString: "#,##0.00",
                            indexLabelPlacement: "inside",
                            indexLabelFontColor: "#36454F",
                            indexLabelFontSize: 18,
                            indexLabelFontWeight: "bolder",
                            showInLegend: true,
                            legendText: "{label}",
                            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                        }]
                    });
                    chart.render();

                    var genderChart = new CanvasJS.Chart("genderChartContainer", {
                         theme: "light2",
                         animationEnabled: true,
                         title: {
                             text: "Gender Dashboard"
                         },
                         data: [{
                             type: "pie",
                             indexLabel: "{y}",
                             yValueFormatString: "##00",
                             indexLabelPlacement: "inside",
                             indexLabelFontColor: "#36454F",
                             indexLabelFontSize: 18,
                             indexLabelFontWeight: "bolder",
                             showInLegend: true,
                             legendText: "{label}",
                             dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
                 }]
             });

                genderChart.render();

                }
            </script>

            <?php
        }
    }
    ?>
</head>
<body>
<div class="card">
    <div class="card-header align-center">
        <h3>Advert Status Chart</h3>
    </div>
    <div class="card-body">
        <div class="card">
            <div class="card-body">
                <div id="chartContainer" style="height: 370px; width: 100%;"></div>
            </div>
        </div>
        <div class="card">
             <div class="card-body">
                 <div id="genderChartContainer" style="height: 370px; width: 100%;"></div>
             </div>
    </div>
</div>
</div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>



















