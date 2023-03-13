<?php

include('../includes/dbConfig.php');
    session_start();

// variable declaration
$idnumber = "";
$phonenumber = "";
$email = "";
$errors = array();
$_SESSION['success'] = "";
$_SESSION['OTPMessage']="";

// connect to database
//$db = mysqli_connect('localhost', 'root', '', 'budgetsystem');
// REGISTER USER
if (isset($_POST['reg_user'])) {
    // receive all input values from the form
    $idnumber = mysqli_real_escape_string($conn, $_POST['idnumber']);
    $phonenumber = mysqli_real_escape_string($conn, $_POST['phonenumber']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);


    // form validation: ensure that the form is correctly filled
    if (empty($idnumber)) {
        array_push($errors, "ID Number is required");
    }
    if (empty($phonenumber)) {
        array_push($errors, "Phone Number is required");
    }
    if (empty($email)) {
        array_push($errors, "Email is required");
    }

    //Checks if id Numer and Phone Number exists in database
    $userquery = "SELECT * FROM users";
    $resultuser = mysqli_query($conn, $userquery);
    while ($row = mysqli_fetch_array($resultuser)) {
        $id_number = $row['id_number'];
        $phone_number = $row['phone_number'];
        if ($idnumber == $id_number) {
            # code...
            array_push($errors, "ID NumberAlready in Use. Please use Different Credentials!");
        } elseif ($phonenumber == $phone_number) {
            # code...
            array_push($errors, "Phone Number Already in User. Please Try Again!");
        }
    }

    function sendTPayOTP($MSISDNTo, $Message) {
     /*   $Password = "dd2a2868f69dd54721922ae49acf57a7";
        $Host = "http://192.168.100.161:8080/sms/?";*/

        $Password = "dd2a2868f69dd54721922ae49acf57a7";
        $Host = "https://tpay.tsc.go.ke/tp/v1/api/sms/?";

        $Results = file($Host . "&api_key=" . urlencode($Password) . "&phone=" . urlencode($MSISDNTo) . "&message=" . urlencode($Message));
        return $Results;
    }

//echo('Init SMS...<br>');
    // register user if there are no errors in the form
    // function to generate random
function generatePIN($digits = 6){
    $i = 0; //counter
    $OTP = ""; //our default pin is blank.
    while($i < $digits){
        //generate a random number between 0 and 9.
        $OTP .= mt_rand(1, 9);
        $i++;
    }
    return $OTP;
}
    if (count($errors) == 0) {
        //$password = md5($password_1);//encrypt the password before saving in the database
       // $OTP = 123456;
            $OTP=generatePIN(6);

        $query = "INSERT INTO `users` (`id_number`,`phone_number`, `email`, `OTP`) 
                      VALUES('$idnumber','$phonenumber', '$email', '$OTP')";
                      $resultreg=$conn->query($query) or die( mysqli_error($conn));
                      
        $sendSMS = sendTPayOTP($phonenumber, 'Your Verification Code is ' . $OTP . ' expires at 12:00:00 AM');
        // var_dump($sendSMS);
        // die();

        $_SESSION['id_number'] = $idnumber;

        $_SESSION['phone_number'] = $phonenumber;
        $_SESSION['OTPMessages']="Enter the Verification Code Sent to Your Mobile Phone Number";
        $otpmessage=$_SESSION['OTPMessages'];
        $_SESSION['success'] = "You are now logged in";
        header('location: verifyaccount.php');
        //echo $_SESSION['id_number'];
        $otpquery = "SELECT * FROM users WHERE id_number='" . $_SESSION['id_number'] . "'";
        $resultotp1 = mysqli_query($conn, $otpquery);
        while ($rowotp = mysqli_fetch_array($resultotp1)) {
            # code...
            $_SESSION['OTP'] = $rowotp['OTP'];
            $_SESSION['email'] = $rowotp['email'];
            $_SESSION['user_type'] = $rowotp['is_admin'];
        }
    }
    
   
    
}
//forget password


//Verify User through OTP
//User Creates password
if (isset($_POST['otpverify'])) {

    # code...
    //Receive input from the form
    $otp = mysqli_real_escape_string($conn, $_POST['otp_code']);
    $password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);

    //validates form
    if (empty($password_1)) {
        array_push($errors, "Password is required");
    }

    //Confirms Password
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }

    //Verifies if OTP code is already in use
    if ($otp != $_SESSION['OTP']) {
        # code...
        array_push($errors, "Please Enter Valid Code");
    }


    // updates user password after verifying OTP
    if (count($errors) == 0) {
        $password = md5($password_1); //encrypt the password before saving in the database
        $passwordquery = "UPDATE users SET password='$password' WHERE id_number='" . $_SESSION['id_number'] . "'";
        $resultpassword = mysqli_query($conn, $passwordquery);
        if ($resultpassword) {
            $_SESSION['success'] = "You are now logged in";
            header('location:../secA.php');
        } else {

            array_push($errors, "Please you havent created your password,Thank you");
        }
    }
}



// ... 
// LOGIN USER
if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($conn, $_POST['idnumber']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM users WHERE id_number='$username' AND password='$password'";
        $results = mysqli_query($conn, $query);
        $rows=mysqli_fetch_array($results);

        if (mysqli_num_rows($results) == 1) {
            $_SESSION['id_number'] = $username;
            $_SESSION['phone_number'] = $phonenumber;
            $_SESSION['user_type'] = $rows['is_admin'];
            
            $_SESSION['success'] = "You are now logged in";
            header('location: ../secA.php');
        } else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}
if (isset($_POST['forgetpassword_user'])) {
    // receive all input values from the form
    $idnumber = mysqli_real_escape_string($conn, $_POST['idnumber']);



    // form validation: ensure that the form is correctly filled
  

    //Checks if id Numer and Phone Number exists in database
 $userquery = "SELECT id_number,phone_number FROM users WHERE id_number=' $idnumber'";
    $resultuser = mysqli_query($conn, $userquery);
    $count = mysqli_num_rows($resultuser);
   
        
        if ($count!=1) {
            # code...
            array_push($errors, "Your ID Number Does NOT Exist , Please Register!");
        }else{
    
    function sendTPayOTP($MSISDNTo, $Message) {
       /* $Password = "dd2a2868f69dd54721922ae49acf57a7";
        $Host = "http://192.168.100.161:8080/sms/?";*/
        
        $Password = "dd2a2868f69dd54721922ae49acf57a7";
        $Host = "https://tpay.tsc.go.ke/tp/v1/api/sms/?";

        $Results = file($Host . "&api_key=" . urlencode($Password) . "&phone=" . urlencode($MSISDNTo) . "&message=" . urlencode($Message));
        print_r($Results);
    }
	
	/* function sendTPayOTP($MSISDNTo, $Message) {
        $Password = "dd2a2868f69dd54721922ae49acf57a7";
        $Host = "http://197.248.226.42:8080/sms/?";

        $Results = file($Host . "&api_key=" . urlencode($Password) . "&phone=" . urlencode($MSISDNTo) . "&message=" . urlencode($Message));
        print_r($Results);
    }*/

	
	
	
	
//echo('Init SMS...<br>');
    // register user if there are no errors in the form
    // function to generate random
function generatePIN($digits = 6){
    $i = 0; //counter
    $OTP = ""; //our default pin is blank.
    while($i < $digits){
        //generate a random number between 0 and 9.
        $OTP .= mt_rand(1, 9);
        $i++;
    }
    return $OTP;
}

    if (count($errors) == 0) {
        //$password = md5($password_1);//encrypt the password before saving in the database
       // $OTP = 123456;
            $OTP=generatePIN(6);




      //  $query = "UPDATE users SET OTP='$OTP' WHERE id_number='".$_SESSION['id_number']."'";
       $query = "UPDATE users SET OTP='$OTP' WHERE id_number='$idnumber'";

                      $resultreg=$conn->query($query) or die( mysqli_error($conn));


        $phonequery='SELECT * FROM users WHERE id_number="'.$_SESSION['id_number'].'"';
        $result=$conn->query($phonequery) or die($conn);
        $rowphone=mysqli_fetch_array($result);
        $phonenumber=$rowphone['phone_number'];
        $_SESSION['phone_number']=$phone;
        //echo $phonenumber;
                      
        sendTPayOTP($phonenumber, 'Your Verification Code For Reset Password is ' . $OTP . ' expires at 12:00:00 AM');
           
        $_SESSION['id_number'] = $idnumber;
        $_SESSION['phone_number'] = $phonenumber;
        $_SESSION['OTPMessages']= "Enter the Verification Code For Reset Password Sent to Your Mobile Phone Number";
        $otpmessage=$_SESSION['OTPMessages'];
        $_SESSION['success'] = "You are now logged in";
        header('location: resetpasswordv.php');
        //echo $_SESSION['id_number'];
        $otpquery = "SELECT * FROM users WHERE id_number='" . $_SESSION['id_number'] . "'";
        $resultotp1 = mysqli_query($conn, $otpquery);
        while ($rowotp = mysqli_fetch_array($resultotp1)) {
            # code...
            $_SESSION['OTP'] = $rowotp['OTP'];
            $_SESSION['email'] = $rowotp['email'];
        }
    }
    
   
    
}

}
//Verify User through OTP
//User Creates password
if (isset($_POST['otpreset'])) {

    # code...
    //Receive input from the form
    $otp = mysqli_real_escape_string($conn, $_POST['otp_code']);
    $password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);

    //validates form
    if (empty($password_1)) {
        array_push($errors, "Password is required");
    }

    //Confirms Password
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }

    //Verifies if OTP code is already in use
    if ($otp != $_SESSION['OTP']) {
        # code...
        array_push($errors, "Please Enter Valid Code");
    }


    // updates user password after verifying OTP
    if (count($errors) == 0) {
        $password = md5($password_1); //encrypt the password before saving in the database
        $passwordquery = "UPDATE users SET password='$password' WHERE id_number='" . $_SESSION['id_number'] . "'";
        $resultpassword = mysqli_query($conn, $passwordquery);
        if ($resultpassword) {
            $_SESSION['success'] = "You are now logged in";
            header('location:../secA.php');
        } else {

            array_push($errors, "Please you havent created your password,Thank you");
        }
    }
}


?>
