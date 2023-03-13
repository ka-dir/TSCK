<?php
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST, GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

include_once '../Config/DBClass.php';
include_once '../Models/Applicants.php';
include_once '../Models/AppliedJobs.php';
include_once '../Models/ApiKey.php';


$dbclass = new DBClass();
$connection = $dbclass->getConnection();

if(isset($_GET['api_key']) && isset($_GET['id']))
{
    //IF HAS ID PARAMETER
    $api_key = filter_var($_GET['api_key'], FILTER_SANITIZE_STRING,[
        'options' => [
            'default' => 'all_jobs',
            'min_range' => 0
        ]
    ]);

    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT,[
        'options' => [
            'default' => 'all_jobs',
            'min_range' => 1
        ]
    ]);

    $api_keys = new ApiKey($connection);
    $stmt_api = $api_keys->read($api_key);
    $count_api_key = $stmt_api->rowCount();

    if($count_api_key > 0)
    {
        while ($row_api = $stmt_api->fetch(PDO::FETCH_ASSOC)) {

            extract($row_api);
            if($status == 0)
            {
                echo json_encode(['status' => "error", 'message'=>'Access Denied']);
                die();
            }
            $requests_track = $request_count + 1;

            $api_keys->request_count =  $requests_track;
            $api_keys->create();
        }
    }
    else
    {
        echo json_encode(['status' => "error", 'message'=>'Authentication Error']);
        die();
    }

    $applicant= new Applicants($connection);
    $stmt = $applicant->read($id);
    $count = $stmt->rowCount();
    $applied_jobs = new AppliedJobs($connection);
    $stmt_jobs = $applied_jobs->read($id);
    $count_jobs = $stmt_jobs->rowCount();



    if($count > 0){
        $applicant = array();
        $applicant["data"] = array();
        $applicant["count"] = $count;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                extract($row);
                if($tscNo > 0)
                {
                    $p = array(
                        "title" => $title,
                        "surname" => $S_name,
                        "first_name" => $F_name,
                        "last_name" => $O_name,
                        "id_number" => $id_no,
                        "phone_number" => $phone_number,
                        "email" => $email,
                        "tscNo" => $tscNo,
                        "gender" => $gender,
                        'applied_jobs' => array()
                    );
                }
                else
                {
                    $p = array(
                        "title" => $title,
                        "surname" => $S_name,
                        "first_name" => $F_name,
                        "last_name" => $O_name,
                        "id_number" => $id_no,
                        "phone_number" => $phone_number,
                        "email" => $email,
                        "gender" => $gender,
                        'applied_jobs' => array()
                    );
                }

            while ($row2 = $stmt_jobs->fetch(PDO::FETCH_ASSOC)) {
                extract($row2);
                $p['applied_jobs'][]['post'] = array(
                    'advert_no' => $advert_no,
                    'post_applied' => $post_vacancy,
                    'status' => $status,
                    'date_of_application' => date('Y-m-d',strtotime($DateTime)),
                );
            }

                array_push($applicant["data"], $p);

        }

        echo json_encode(['status' => "success", 'data' => $applicant['data']]);
    }

    else {

        echo json_encode(['status' => "error", 'Message' => 'Data no Found']);
        die();

    }

}
else{
    echo json_encode(['status' => error, 'message'=>'invalid request']);
    die();
}



?>