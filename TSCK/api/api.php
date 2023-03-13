<?php
// SET HEADER
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

// INCLUDING DATABASE AND MAKING OBJECT
require 'DBClass.php';
$db_connection = new Database();
$conn = $db_connection->dbConnection();

// CHECK GET ID PARAMETER OR NOT
if(isset($_GET['api_key']) && isset($_GET['id']))
{
    //IF HAS ID PARAMETER
    $id = filter_var($_GET['api_key'], FILTER_VALIDATE_INT,[
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

}
else{
    echo json_encode(['status' => 401, 'message'=>'invalid request']);
}

// MAKE SQL QUERY
// IF GET POSTS ID, THEN SHOW POSTS BY ID OTHERWISE SHOW ALL POSTS
$sql = is_numeric($id) ? "SELECT * FROM `posts` WHERE id='$post_id'" : "SELECT * FROM `posts`"; 
$sql_api = is_numeric($id) ? "SELECT * FROM `posts` WHERE id='$post_id'" : "SELECT * FROM `posts`"; 
$stmt = $conn->prepare($sql);

$stmt->execute();
var_dump($stmt);
die();
//CHECK WHETHER THERE IS ANY POST IN OUR DATABASE
if($stmt->rowCount() > 0){
    // CREATE POSTS ARRAY
    $posts_array = [];
    
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        
        $post_data = [
            'id' => $row['id'],
            'title' => $row['title'],
            'body' => html_entity_decode($row['body']),
            'author' => $row['author']
        ];
        // PUSH POST DATA IN OUR $posts_array ARRAY
        array_push($posts_array, $post_data);
    }
    //SHOW POST/POSTS IN JSON FORMAT
    echo json_encode($posts_array);
 

}
else{
    //IF THER IS NO POST IN OUR DATABASE
    echo json_encode(['message'=>'No post found']);
}
?>
