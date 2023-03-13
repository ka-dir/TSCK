 <?php
session_start();
 // server should keep session data for AT LEAST 1 hour
 ini_set('session.gc_maxlifetime', 3600);

 // each client should remember their session id for EXACTLY 1 hour
 session_set_cookie_params(3600);


include('dbConfig.php');

  /* //.........................................session timeout when inactive..........................
  if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 60)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time
    session_destroy();   // destroy session data in storage
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

*/





  if (!isset($_SESSION['id_number']))
  {
    $_SESSION['msg'] = "You must log in first";
    header('location: Auth/login.php');
  }


if(isset($_SESSION['user_type']))
 {
     $query = "SELECT * FROM users WHERE id_number='".$_SESSION['id_number']."'";
     $results = mysqli_query($conn, $query);
     $rows=mysqli_fetch_array($results);
 }

    ?>



  <nav class="navbar navbar-inverse navbar-global navbar-fixed-top" style="background:#314C95;">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Teachers Service Commission - Secretariat Recruitment Portal</a>
        </div>

        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-user navbar-right">
              <?php if(trim($rows['is_admin']) == 1)
              {
				  ?>
             <li>
              <a href="adverts.php"><span class="glyphicon glyphicon-cog"></span><span class="nav-label"> Manage Adverts</span></a>

			 </li>
			<li>
			 <a href="secFifteen.php"><span class="glyphicon glyphicon-cog"></span><span class="nav-label"> Manage Applications</span></a>
			</li>
			<li>
			 <a href="users.php"><span class="glyphicon glyphicon-cog"></span><span class="nav-label"> Manage Users</span></a>
			</li>
              <?php
			  }
			  ?>

            <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['id_number']; ?></a></li>

            <li><a href="Auth/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

