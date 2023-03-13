<?php

class DBClass {

    private $db_host = 'localhost';
    private $db_name = 'dbrecruitmentTEST';
    private $db_username = 'root';
    private $db_password = '?!dbtscservices1967!(^&';

    public $connection;

    // get the database connection
    public function getConnection(){

        $this->connection = null;

        try{
            $this->connection = new PDO("mysql:host=" . $this->db_host . ";dbname=" . $this->db_name, $this->db_username, $this->db_password);
            $this->connection->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Error: " . $exception->getMessage();
        }

        return $this->connection;
    }
}
?>