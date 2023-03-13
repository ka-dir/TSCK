<?php
class AppliedJobs{

    // Connection instance
    private $connection;

    // table name
    private $table_name = "tblappliedjobs";

    // table columns
    public $appliedjobs_index;
    public $id_number;
    public $advert_no;
    public $post_vacancy;
    public $status;
    public $DateTime;

    public function __construct($connection){
        $this->connection = $connection;
    }
    //READ FUNCTION
    public function read($id){
        $query = "SELECT id_number, advert_no, post_vacancy, status, `DateTime` FROM  ".$this->table_name." WHERE id_number = '".$id."'";

        $stmt_jobs = $this->connection->prepare($query);

        $stmt_jobs->execute();

        return $stmt_jobs;
    }

}

?>