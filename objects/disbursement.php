<?php
class Disbursement{

    // Connection instance
    private $connection;

    // table name
    private $table_name = "disbursement";

    // table columns
    public $id;
    public $amount;
    public $status;
    public $timestamp;
    public $remark;
    public $receipt;
    public $time_served;
    public $fee;
    public $bank_transfer_information_id;

    public function __construct($connection){
        $this->connection = $connection;
    }

    //C
    public function create(){

    }
    //R
    public function read(){
     // select all query
        $query = "SELECT id, amount, status, timestamp, remark, receipt, time_served, fee, bank_transfer_information_id
                  FROM disbursement;";

        // prepare query statement
        $stmt = $this->connection->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;

    }
    //U
    public function update(){}
    //D
    public function delete(){}
}