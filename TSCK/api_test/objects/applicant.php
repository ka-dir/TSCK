<?php
ini_set('display_errors', 1);
class Applicant
{
    // database connection and table name
    private $conn;
    private $table_name = "tblappliedjobs";
 
    // object properties
    public $id_number;
    public $advert_no;
    public $post_vacancy;
    public $is_submitted;
	public $F_name;
	public $status;
 
    // constructor with $db as database connection
    public function __construct($db)
	{
        $this->conn = $db;
    }
	
// read products
function read()
{
	$status='Submitted';
	$isSubmitted=1;
    // select all query
    $query = "SELECT tj.id_number,tj.advert_no,tj.post_vacancy,tj.is_submitted,tj.status
			 ,a.F_name
	
	FROM tblappliedjobs as tj
	join applicant_details as a ON tj.id_number=a.id_no
	
	WHERE is_submitted='$isSubmitted' and status='$status'";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
	 
}	
	
	
	
}
?>