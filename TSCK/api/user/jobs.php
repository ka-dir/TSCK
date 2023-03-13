<?php
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

include_once '../Config/DBClass.php';
include_once '../Models/AppliedJobs.php';

$dbclass = new DBClass();
$connection = $dbclass->getConnection();

if(isset($_GET['api_key']) && isset($_GET['id']))
{
    //IF HAS ID PARAMETER
    $api_key = filter_var($_GET['api_key'], FILTER_VALIDATE_INT,[
        'options' => [
            'default' => 'all_jobs',
            'min_range' => 1
        ]
    ]);

    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT,[
        'options' => [
            'default' => 'all_jobs',
            'min_range' => 1
        ]
    ]);
    $applied_jobs = new AppliedJobs($connection);
    $stmt_jobs = $applied_jobs->read($id);
    $count = $stmt_jobs->rowCount();

    if($count > 0){
        $applied_jobs = array();
        $applied_jobs['post'] = array();
        $applied_jobs['count'] = $count;



            while ($row = $stmt_jobs->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                $jobs = array(
                    "advert_no" => $advert_no,
                    "post_vacancy" => $post_vacancy,
                    "status" => $status,
                    "date" => $DateTime
                );

            array_push($applied_jobs["post"], $jobs);
        }


        echo json_encode(['status' => 200, 'data' => $applied_jobs["post"]]);
    }

    else {

        echo json_encode(['status' => 204, 'Message' => 'Data no Found']);

    }

}
else{
    echo json_encode(['status' => 401, 'message'=>'invalid request']);
}



?>