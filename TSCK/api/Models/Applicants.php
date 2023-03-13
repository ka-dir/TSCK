<?php
class Applicants{

    // Connection instance
    private $connection;

    // table name
    private $table_name = "applicant_details";

    // table columns
    public $title;
    public $S_name;
    public $F_name;
    public $O_name;
    public $id_no;
    public $phone_number;
    public $email;
    public $DOB;
    public $tscNo;
    public $KRA_pin;
    public $gender;


    public function __construct($connection){
        $this->connection = $connection;
    }

    //READ FUNCTION
    public function read($id){
        $query = "SELECT a.S_name, a.F_name, a.O_name, a.title, a.DOB, a.id_no, a.tscNo, a.KRA_pin, a.gender,u.phone_number,u.email FROM " . $this->table_name . " a LEFT JOIN users u ON a.id_no = u.id_number WHERE id_no = '".$id."'";

        $stmt = $this->connection->prepare($query);

        $stmt->execute();

        return $stmt;
    }

}