<style>
    .active {
        background-color: #F5F5F5;
        border-radius: 15px;
        box-shadow: 0px 0px 20px rgba(148, 136, 820, 9);
        }
    .active .nav-label {
        color: #007bff;

    }
    .active .glyphicon {
        color: #007bff;

    }
    
</style>
<?php
$route = "";
$url =  $_SERVER['REQUEST_URI'];
$new_urls = explode("/",$url);
$actual_url = $new_urls[1];
?>
<nav class="navbar-primary" style="background:#314C95;">
  <a href="#" class="btn-expand-collapse"><span class="glyphicon glyphicon-menu-left"></span></a>
  	<div align="center"><br>
	<img width="70" height="70" src="images/tsclogoblue.png" >
	</div>
  <ul class="navbar-primary-menu">
    <li>
      <a href="secA.php"class=<?php if(trim($actual_url) == "secA.php"){ echo "active";} else { echo "";}  ?>><span class="glyphicon glyphicon-list-alt"></span><span class="nav-label">Home</span></a>
      <a href="secOne.php"class=<?php if(trim($actual_url) == "secOne.php"){ echo "active";} else { echo "";}  ?>><span class="glyphicon glyphicon-list-alt"></span><span class="nav-label">Vacancies</span></a>
	    
	  

      <a href="#" class=<?php if(trim($actual_url) == "secThree.php"){ echo "active";} else { echo "";}  ?>><span class="glyphicon glyphicon-user "></span><span class="nav-label">Character</span></a>
      <a href="#" class=<?php if(trim($actual_url) == "secFour.php"){ echo "active";} else { echo "";}  ?>><span class="glyphicon glyphicon-film"></span><span class="nav-label">Academic Rider</span></a>
      <a href="#" class=<?php if(trim($actual_url) == "secFive.php"){ echo "active";} else { echo "";}  ?>><span class="glyphicon glyphicon-calendar"></span><span class="nav-label">Professional Rider</span></a>
	  <a href="#" class=<?php if(trim($actual_url) == "secSix.php"){ echo "active";} else { echo "";}  ?>><span class="glyphicon glyphicon-list-alt"></span><span class="nav-label">Courses/Training</span></a>
      <a href="#" class=<?php if(trim($actual_url) == "secSeven.php"){ echo "active";} else { echo "";}  ?>><span class="glyphicon glyphicon-envelope"></span><span class="nav-label">Membership</span></a>
      <a href="#" class=<?php if(trim($actual_url) == "secEight.php"){ echo "active";} else { echo "";}  ?>><span class="glyphicon glyphicon-cog"></span><span class="nav-label">Employment History</span></a>
      <a href="#" class=<?php if(trim($actual_url) == "secNine.php"){ echo "active";} else { echo "";}  ?>><span class="glyphicon glyphicon-film"></span><span class="nav-label">Employment Duties</span></a>
      <a href="#" class=<?php if(trim($actual_url) == "secReferee.php"){ echo "active";} else { echo "";}  ?>><span class="glyphicon glyphicon-user"></span><span class="nav-label">Referee</span></a>
	  <a href="secEleven.php" class=<?php if(trim($actual_url) == "secEleven.php"){ echo "active";} else { echo "";}  ?>><span class="glyphicon glyphicon-list-alt"></span><span class="nav-label">My Applications</span></a>
      <a href="userprofile.php" class=<?php if(trim($actual_url) == "userprofile.php"){ echo "active";} else { echo "";}  ?>><span class="glyphicon glyphicon-calendar"></span><span class="nav-label">Summary</span></a>
     
     


    </li>
    
  </ul>
</nav>