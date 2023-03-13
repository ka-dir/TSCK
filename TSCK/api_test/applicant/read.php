<?php
ini_set('display_errors', 1);
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 // include database and object files
include_once '../config/database.php';
include_once '../objects/applicant.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$applicant = new Applicant($db);
// query products
$stmt = $applicant->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0)
{
 
    // products array
    $applicants_arr=array();
    $applicants_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $app_item=array(
			
			"F_name"	=>$F_name,
            "id_number" => $id_number,
            "advert_no" => $advert_no,
            "post_vacancy" =>$post_vacancy,
            "is_submitted" => $is_submitted,
			"status"		=>$status
        );
 
        array_push($applicants_arr["records"], $app_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show products data in json format
    echo json_encode($applicants_arr);
}
else
{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No applicant found.")
    );
}
 
// no products found will be here