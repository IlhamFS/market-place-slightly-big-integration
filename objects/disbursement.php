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
        $query = "SELECT d.id, d.amount, d.status, d.timestamp, b.bank_code, b.account_number, b.beneficiary_name, d.remark, d.receipt, d.time_served, d.fee, d.bank_transfer_information_id
                  FROM disbursement d JOIN bank_transfer_information b ON bank_transfer_information_id = b.id;";

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