<?php
class ApiKey{

    // Connection instance
    private $connection;

    // table name
    private $table_name = "api_auth";

    // table columns
    public $user;
    public $api_key;
    public $active;
    public $request_count;

    public function __construct($connection){
        $this->connection = $connection;
    }
    //READ FUNCTION
    public function read($api_key){
        $query = "SELECT user, api_key, status, request_count FROM  ".$this->table_name." WHERE api_key = '".$api_key."'";

        $stmt_jobs = $this->connection->prepare($query);

        $stmt_jobs->execute();

        return $stmt_jobs;
    }

    public function create(){}

}

?>