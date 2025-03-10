<?php
include('../includes/dbConfig.php');
// server should keep session data for AT LEAST 1 hour
ini_set('session.gc_maxlifetime', 3600);

// each client should remember their session id for EXACTLY 1 hour
session_set_cookie_params(3600);
include('server.php');

session_start();
session_unset();
session_destroy();
header("location:../");

?>