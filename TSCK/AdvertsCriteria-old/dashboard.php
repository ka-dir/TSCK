<?php
session_start();
//include('header.php');
include('../includes/dbConfig.php');
$id_number=$_SESSION['id_number'];
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
	$statusShortlist='Shortlisted';
	$is_submittedShortlist=2;
	//submitted
	$statusSubmitted='Submitted';
	$is_submittedSubmit=1;
	//incomplete
	$statusInComplete='InComplete';
	$is_submittedInComplete=0;
		
$sqlShortlisted=mysqli_query($dbconnection,"SELECT * FROM tblappliedjobs WHERE advert_no='".$advert_no."'
and is_submitted='".$is_submittedShortlist."' and status='".$statusShortlist."'")or die(mysqli_error());
$countShortlist=mysqli_num_rows($sqlShortlisted);
//echo $countShortlist;


$sqlSubmitted=mysqli_query($dbconnection,"SELECT  * FROM tblappliedjobs WHERE advert_no='".$advert_no."'
and is_submitted='".$is_submittedSubmit."' and status='".$statusSubmitted."'")or die(mysqli_error());
$countSubmitted=mysqli_num_rows($sqlSubmitted);
//echo $countSubmitted;

$sqlIncomplete=mysqli_query($dbconnection,"SELECT * FROM tblappliedjobs WHERE advert_no='".$advert_no."'
and is_submitted='".$is_submittedInComplete."' and status='".$statusInComplete."'")or die(mysqli_error());
$countIncomplete=mysqli_num_rows($sqlIncomplete);
//echo $countIncomplete;

    $dataPoints = array
	( 
    	array("label"=>"Shortlisted","y"=>$countShortlist),
    	array("label"=>"Submitted","y"=>$countSubmitted),
    	array("label"=>"Incomplete","y"=>$countIncomplete)
    )
     
    ?>
    <!DOCTYPE HTML>
    <html>
    <head>
    <script>
        window.onload = function() {
     
     
    var chart = new CanvasJS.Chart("chartContainer", {
    	theme: "light2",
    	animationEnabled: true,
    	title: {
    		text: "Advert: <?php echo $advertName;?>"
    	},
    	data: [{
    		type: "pie",
    		indexLabel: "{y}",
    		yValueFormatString: "#,##0.00\"%\"",
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
     
    }
    </script>
    </head>
    <body>
    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    </body>
    </html>                              
<?php
}}
?>






      











