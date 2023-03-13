<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
$key =escape($_REQUEST["api_key"]);
$reference_number=escape($_REQUEST["reference_number"]);
$data=userDetails($reference_number);
echo $data;
function userDetails($reference_number)
{
    global $key;
    global $reference_number;
    $response = array();
    $current_month = date('Y-m');

    if($key !=md5(RAINBOW_RAINS))
    {
        $response=json_encode(['status'=>0,'message'=>'Request Failed,Invalid Authentication']);
        return $response;
    }
    else
    {
        $dbHost="localhost";
        $dbUsername="root";
        $dbPassword='?!dbtscservices1967!(^&';
        $dbName="payments";
        $dbconnection=mysqli_connect("$dbHost","$dbUsername","$dbPassword");
        mysqli_select_db($dbconnection, "$dbName") or die ("Unable to connect!");

//Two
        $conn=new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

        if($conn->connect_error){
            die("Unable to connect database:s    " .$conn->connect_error);
        }
        else{
            //echo "Successfull";
        }
        $var="SELECT * FROM posting";
        $resulta = mysqli_query($conn,$var);
        $row=mysqli_fetch_all($resulta);

//
//        if(!$row)
//        {
//
//            $response=json_encode(['status'=>201,'message'=>'no records found']);
//        }
//
//        else {
        $responses = array();
        foreach ($row  as $data) {
            $responses[] =
                array(
                    'id' => $data[0],
                    'reference_number' => $data[1],
                    'biller_code' => $data[2],
                    'amount' => $data[3],
                    'currency_code' => $data[4],
                    'customer_name'=>$data[5],
                    'description'=>$data[6],
                    'customer_ref_number'=>$data[7],
                    'response_status' => $data[8],
                    'date_time' => $data[9],
                    'username' => $data[10],
                    'password' => $data[11]

                    //'number' => $row['case_number']

            );
            //  var_dump($response);die();
        }
        //var_dump($responses);
        return json_encode($responses,true);
    }
    // return $response;
    //}
}
function escape($value) {

    $return = '';

    for($i = 0; $i < strlen($value); ++$i) {

        $char = $value[$i];

        $ord = ord($char);

        if($char !== "'" && $char !== "\"" && $char !== '\\' && $ord >= 32 && $ord <= 126)

            $return .= $char;

        else

            $return .= '\\x' . dechex($ord);

    }

    return $return;

}






?>