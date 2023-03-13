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
            $Password = "dd2a2868f69dd54721922ae49acf57a7";
            $Host = "http://197.156.132.45:8080/sms/?";

            $Results = file($Host . "&api_key=" . urlencode($Password) . "&phone=" . urlencode($MSISDNTo) . "&message=" . urlencode($Message));
            print_r($Results);
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

            $query = "UPDATE users SET OTP='$OTP' WHERE id_number='".$_SESSION['id_number']."'";

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
            header('location: reset-password-verification.php');
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
