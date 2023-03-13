<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>TSC</title>
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'>
  <link rel="stylesheet" href="css/style.css"> 
</head>

<body>
<?php include('includes/header.php');?>
<?php include('includes/leftMenu.php');?>

<div class="main-content">
<h3> Application Instructions:</h3>

<div id="notes2"><p >
    1. Agree to comply with the instructions below to proceed with your application.<br/>
    2. From the Vacancies Section select the position you wish to apply for and click the "Apply" button.<br/>
	3. Upon completion of each section ensure you click the "Save" button to save your entries before moving to the "Next" section.<br>
        4. Upon completion of your application ensure you click the <strong> <u>"Submit my Application" </u> </strong> to complete your application for the selected vacancy.<br>
    5. You can monitor the status of your job application from "My Applications" section<br/>
    6. If your application is  <strong> <u> Incomplete </u> </strong> makes sure you click <strong> <u>"Submit my Application" </u> </strong><br/>
    
    <br/></p>
    <div class="alert alert-danger">
        <style>
            .blinking {
                -webkit-animation: 1s blink ease infinite;
                -moz-animation: 1s blink ease infinite;
                -ms-animation: 1s blink ease infinite;
                -o-animation: 1s blink ease infinite;
                animation: 1s blink ease infinite;

            }

            @keyframes "blink" {
                from, to {
                    opacity: 0;
                }
                50% {
                    opacity: 1;
                }
            }

            @-moz-keyframes blink {
                from, to {
                    opacity: 0;
                }
                50% {
                    opacity: 1;
                }
            }

            @-webkit-keyframes "blink" {
                from, to {
                    opacity: 0;
                }
                50% {
                    opacity: 1;
                }
            }

            @-ms-keyframes "blink" {
                from, to {
                    opacity: 0;
                }
                50% {
                    opacity: 1;
                }
            }

            @-o-keyframes "blink" {
                from, to {
                    opacity: 0;
                }
                50% {
                    opacity: 1;
                }
            }
        </style>
        <div class="row">
            <div class="col-sm-1">
                <svg height="18" width="100" class="blinking">
                    <circle cx="10" cy="10" r="5" fill="red" />
                    Sorry, your browser does not support inline SVG.
                </svg>

            </div>

            <div class="col-sm-11">
                <p style="font-weight: bolder"> <br/> &#8226; Upon successful submission of Application you will get SMS Confirmation from TSC-Kenya.</p>
                <p style="font-weight: bolder"> <br/> &#8226; In case of any challenge or queries, Email: <u> secretariatrecruitment@tsc.go.ke  </u> ;Ensure you provide your TSC No, ID No, Mobile No, Official Names and nature of the problem.</p>
            </div>
        </div>
    </div>
</div>
<div id="heading2"> 
    <strong>NOTES FOR APPLICANTS</strong> </div>
<div id="notes2"> 
    1. It is a serious offence to willfully give false information to the Teachers Service Commission.<br/>
    2. All parts of this form must be completed by all applicants.<br/>
    3. Do not apply for any post unless you possess all the qualifications given in the advertisement.<br/>
    4. If you are invited for an interview by the Commission, bring your original certificates and testimonials<br/> 
        &nbsp;&nbsp; but make sure that they are returned to you before you leave.
    <br/>
    5. Canvassing in any form will lead to automatic disqualification.<br/> 
    <br/></div>
    <div id="heading2">
        REQUIREMENTS </div>
    
    <div id="notes2"> <b>NB:</b> Refer to the requirements as stated under the job you wish to apply. </div>

	<div>
	
<input type="submit" class="btn btn-success " style="background-color:#314C95;margin-left:10%;" name="btnSubmitProfile" value="Agree to the above Instructions" onclick="window.location.href='secOne.php'">

</div>
</div>

<script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>
<script  src="js/index.js"></script>
</body>

</html>

